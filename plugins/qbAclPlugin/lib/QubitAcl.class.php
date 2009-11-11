<?php

/*
 * This file is part of Qubit Toolkit.
 *
 * Qubit Toolkit is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * (at your option) any later version.
 *
 * Qubit Toolkit is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Qubit Toolkit.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Access Control List (ACL) functionality
 *
 * @package    qbAclPlugin
 * @subpackage acl
 * @author     David Juhasz <david@artefactual.com>
 * @version    svn:$Id$
 */
class QubitAcl
{
  const GRANT = 2;
  const INHERIT = 1;
  const DENY  = 0;

  /**
   * Test user access to the given access control object (aco).
   *
   * Note: Current sf_user is assumed, but can be overridden with
   * $options['userId'].
   *
   * @param mixed   $aco object to which user is requesting access
   * @param integer $actionId requested action key
   * @param array   $options optional parameters
   */
  public static function check($aco, $actionId, $options = array())
  {
    if (isset($options['userId']))
    {
      $user = QubitUser::getById($options['userId']);
    }
    else
    {
      $user = sfContext::getInstance()->getUser()->getQubitUser();
    }

    // TODO: Rely on ACO hierarchy exclusively for determining access, this
    // requires having a ROOT object for all ACOs (Actor, Repository, etc.)
    $hasAccess = false;
    switch (get_class($aco))
    {
      // Check permissions with repository condition
      case 'QubitInformationObject':
        if (null !== ($repository = $aco->getRepository(array('inherit' => true))))
        {
          $options['parameters']['repositoryId'] = $repository->id;
        }
        else
        {
          $options['parameters']['repositoryId'] = null;
        }

        $hasAccess = self::allowAccess($user, $aco, $actionId, $options);
        break;

        // Allow to *any* user that is logged in, or if action is "read"
      case 'QubitActor':
      case 'QubitRepository':
        $hasAccess = (null != $user || QubitAclAction::READ_ID == $actionId);
        break;

        // Administrator or editor
      case 'QubitTerm':
        $hasAccess = $user->hasGroup(array(
        QubitAclGroup::ADMINISTRATOR_ID,
        QubitAclGroup::EDITOR_ID
        ));
        break;

        // Administrator only
      case 'QubitUser':
      case 'QubitMenu':
      case 'QubitStaticPage':
      case 'QubitAclGroup':
      case 'QubitAclUser':
        $hasAccess = $user->hasGroup(QubitAclGroup::ADMINISTRATOR_ID);
    }

    return $hasAccess;
  }

  protected static function evalGrantDeny($grantDeny)
  {
    switch ($grantDeny)
    {
      case '1':
        return self::GRANT;
      case '0':
        return self::DENY;
      default:
        return self::INHERIT;
    }
  }

  protected static function getAcoChain($aco)
  {
    foreach ($aco->getAncestors()->andSelf()->orderBy('rgt') as $node)
    {
      $chain[] = $node;
    }

    return $chain;
  }

  protected static function allowAccess($user, $aco, $actionId, $options = array())
  {
    $permission = self::INHERIT;

    // For creating new objects, use the permission set from the root object
    // TODO: Handle an expanded list of classes elegantly (e.g. not 'switch')
    if ('QubitInformationObject' == get_class($aco) && null === $aco->id)
    {
      $aco = QubitInformationObject::getRoot();
    }

    $acoChain = self::getAcoChain($aco);

    // Check user permissions first
    $permission = self::checkUserPermissions($user, $acoChain, $actionId, $options);

    // Then check group permissions
    if (self::INHERIT == $permission)
    {
      $permission = self::checkGroupPermissions($user, $acoChain, $actionId, $options);
    }

    return (self::GRANT == $permission);
  }

  protected static function checkUserPermissions($user, $acoChain, $actionId, $options = array())
  {
    // Anonymous users, check (anonymous) group permissions
    if (null == $user)
    {

      return self::INHERIT;
    }

    $criteria = new Criteria;
    $criteria->add(QubitAclPermission::USER_ID, $user->id, Criteria::EQUAL);
    $criteria->add(QubitAclPermission::ACTION_ID, $actionId, Criteria::EQUAL);

    // Check 'last-in' permissions first
    $criteria->addDescendingOrderByColumn(QubitAclPermission::ID);

    return self::checkAcoPermissionChain($acoChain, $criteria, $options);
  }

  protected static function addObjectCriteria($criteria, $objectId)
  {
    if (null == $objectId)
    {
      $criteria->add(QubitAclPermission::OBJECT_ID, null, Criteria::ISNULL);
    }
    else
    {
      $criteria->add(QubitAclPermission::OBJECT_ID, $objectId, Criteria::EQUAL);
    }

    return $criteria;
  }

  protected static function checkAcoPermissionChain($acoChain, $criteria, $options = array())
  {
    $authorize = self::INHERIT;

    $parameters = array();
    if (isset($options['parameters']))
    {
      $parameters = $options['parameters'];
    }
    $aco = array_shift($acoChain);

    $acoCriteria = clone $criteria;
    $acoCriteria = self::addObjectCriteria($acoCriteria, $aco->id);
    if (0 < count($permissions = QubitAclPermission::get($acoCriteria)))
    {
      $authorize = self::checkPermissionList($permissions, $parameters);
    }

    // If 'inherit' work way up aco chain
    if (self::INHERIT == $authorize && null != $acoChain)
    {
      if (0 < count($acoChain))
      {
        $authorize = self::checkAcoPermissionChain($acoChain, $criteria, $options);
      }
      else
      {
        // Check for global (objectId == null) permissions if specific
        // permissions for ACO chain are not found
        $authorize = self::checkAcoPermissionChain(null, $criteria, $options);
      }
    }

    return $authorize;
  }

  protected static function checkGroupPermissions($user, $acoChain, $actionId, $options = array())
  {
    $authorize = self::INHERIT;
    $groupsByGeneration = self::getGroupsByGeneration($user);

    // Test siblings from youngest (last) to oldest (first) generation
    while ($currentGeneration = array_pop($groupsByGeneration))
    {
      foreach ($currentGeneration as $groupId)
      {
        $group = QubitAclGroup::getById($groupId);

        $criteria = new Criteria;
        $criteria->add(QubitAclPermission::GROUP_ID, $groupId, Criteria::EQUAL);
        $criteria->add(QubitAclPermission::ACTION_ID, $actionId, Criteria::EQUAL);

        $groupAuthorize = self::checkAcoPermissionChain($acoChain, $criteria, $options);

        if (self::GRANT == $groupAuthorize)
        {
          // If *any* sibling group returns "grant" reponse, then grant access
          $authorize = self::GRANT;
          break 2;
        }
        else if (self::DENY == $groupAuthorize)
        {
          // If siblings return one (or more) 'deny' reponses, and no 'grant'
          // responses then deny access
          $authorize = self::DENY;
        }
      }

      // If the current generation gives 'grant' or 'deny' result, don't check
      // ancestor generations
      if (self::INHERIT != $authorize)
      {
        break;
      }
    }

    return $authorize;
  }

  protected static function getGroupsByGeneration($user)
  {
    $groupsByGeneration = array();

    if ($user == null)
    {

      // If user is not logged in, then 'anonymous' group is only one
      return array(0 => array(0 => QubitAclGroup::ANONYMOUS_ID));
    }

    // Get 1st order groups (link directory from user)
    // Note: may be mixed generations (e.g. parents and children)
    $criteria = new Criteria;
    $criteria->add(QubitAclUserGroup::USER_ID, $user->id, Criteria::EQUAL);
    $criteria->addJoin(QubitAclUserGroup::GROUP_ID, QubitAclGroup::ID, Criteria::INNER_JOIN);

    if (0 == count($linkedGroups = QubitAclGroup::get($criteria)))
    {
      // user always belongs to the 'authenticated' group
      $linkedGroups = array(QubitAclGroup::getById(QubitAclGroup::AUTHENTICATED_ID));
    }

    // Build a list of groups, organized by generation (siblings together)
    foreach ($linkedGroups as $group)
    {
      $generation = 0;
      $lineage = $group->getAncestors()->andSelf()->orderBy('lft');

      foreach ($lineage as $node)
      {
        // Ignore the root node
        if (QubitAclGroup::ROOT_ID != $node->id)
        {
          // Don't re-add siblings already in array
          if (!isset($groupsByGeneration[$generation]) || !in_array($node->id, $groupsByGeneration[$generation]))
          {
            $groupsByGeneration[$generation][] = $node->id;
          }

          $generation++;
        }
      }
    }

    return $groupsByGeneration;
  }

  protected static function checkPermissionList($permissions, $parameters = array())
  {
    $grantDeny = null;

    // Evaluate permission in descending order (last permission entered takes
    // precedence)
    foreach ($permissions as $permission)
    {
      $grantDeny = $permission->check($permission->userId, $permission->objectId, $permission->actionId, $parameters);
      //$permission->debug($parameters);

      if (null != $grantDeny)
      {
        break;
      }
    }

    return self::evalGrantDeny($grantDeny);
  }

  /**
   * Add permissions to repository access array
   *
   * @param $repositoryAccess input access array
   * @param $permissions QubitQuery permission list
   * @return array output access array
   */
  public static function addRepositoryAccess($repositoryAccess, $permissions)
  {
    foreach ($permissions as $permission)
    {
      if (null === $permission->grantDeny)
      {
        continue;
      }

      $access = (1 == $permission->grantDeny) ? self::GRANT : self::DENY;

      // If no repository specified, then apply rule to all repositories
      if (null === ($repository = $permission->getRepository()))
      {
        $repositoryAccess[] = array('id' => '*', 'access' => $access);
        break;
      }

      // Add repository access if there is no pre-existing rule for that repo
      else
      {
        $preExistingRule = false;
        foreach ($repositoryAccess as $rule)
        {
          if ($repository->id == $rule['id'])
          {
            $preExistingRule = true;
            break;
          }
        }

        if (!$preExistingRule)
        {
          $repositoryAccess[] = array('id' => $repository->id, 'access' => $access);
        }
      }
    }

    return $repositoryAccess;
  }

  /**
   * List the repository access rules for the current user
   *
   * @param $actionId integer Access privilige being requested
   * @param $options array optional parameters
   * @return array
   */
  public static function getRepositoryAccess($actionId, $options = array())
  {
    $repositoryAccess = array();
    $userGroupIds = array();

    // If user is logged in
    if (null !== ($userId = sfContext::getInstance()->getUser()->getUserId()))
    {
      // Test user permissions
      $criteria = new Criteria;
      $criteria->add(QubitAclPermission::ACTION_ID, $actionId);
      $criteria->add(QubitAclPermission::USER_ID, $userId);
      $criteria->addDescendingOrderByColumn(QubitAclPermission::ID);

      if (0 < count($permissions = QubitAclPermission::get($criteria)))
      {
        $repositoryAccess = self::addRepositoryAccess($repositoryAccess, $permissions);
      }
    }
    else
    {
      // Add anonymous group if user is not logged in
      $userGroupIds[] = QubitAclGroup::ANONYMOUS_ID;
    }

    if (0 == count($repositoryAccess) || '*' != $repositoryAccess[count($repositoryAccess) - 1]['id'])
    {
      // Test user group permissions
      foreach (sfContext::getInstance()->getUser()->listGroups() as $group)
      {
        $userGroupIds[] = $group->id;
      }

      $criteria = new Criteria;
      $criteria->add(QubitAclPermission::ACTION_ID, $actionId);
      $criteria->add(QubitAclPermission::GROUP_ID, $userGroupIds, Criteria::IN);
      $criteria->addDescendingOrderByColumn(QubitAclPermission::ID);

      if (0 < count($permissions = QubitAclPermission::get($criteria)))
      {
        $repositoryAccess = self::addRepositoryAccess($repositoryAccess, $permissions);
      }
    }

    // Default is to deny access if no permissions specified
    if (0 == count($repositoryAccess) || '*' != $repositoryAccess[count($repositoryAccess) - 1]['id'])
    {
      $repositoryAccess[] = array('id' => '*', 'access' => self::DENY);
    }

    // Collapse access rules so that e.g.
    // ('1' => deny, '2' => allow, '*' => deny) -> ('2' => allow, '*' => deny)
    // ('1' => deny, '2' => allow, '*' => allow) -> (1' => deny, '*' => allow)
    $globalPermission = $repositoryAccess[count($repositoryAccess) - 1]['access'];
    $collapsedRules = array();
    foreach ($repositoryAccess as $i => $val)
    {
      if ('*' == $val['id'] || $globalPermission != $val['access'])
      {
        $collapsedRules[] = $val;
      }
    }

    return $collapsedRules;
  }

  public static function forwardUnauthorized()
  {
    if (!sfContext::getInstance()->getUser()->isAuthenticated())
    {
      self::forwardToLoginAction();
    }
    else
    {
      self::forwardToSecureAction();
    }
  }

  /**
   * Forwards the current request to the secure action.
   *
   * Copied from sfBasicSecurityFilter
   *
   * @see lib/vendor/symfony/lib/filter/sfBasicSecurityFilter.class.php
   * @throws sfStopException
   */
  public static function forwardToSecureAction()
  {
    sfContext::getInstance()->getController()->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));

    throw new sfStopException();
  }

  /**
   * Forwards the current request to the login action.
   *
   * Copied from sfBasicSecurityFilter
   *
   * @see lib/vendor/symfony/lib/filter/sfBasicSecurityFilter.class.php
   * @throws sfStopException
   */
  public static function forwardToLoginAction()
  {
    sfContext::getInstance()->getController()->forward(sfConfig::get('sf_login_module'), sfConfig::get('sf_login_action'));

    throw new sfStopException();
  }

  public static function searchFilterByRepository($query, $action)
  {
    $repositoryAccess = QubitAcl::getRepositoryAccess($action);
    if (1 == count($repositoryAccess))
    {
      // If all repositories are denied access, re-route user to login
      if (QubitAcl::DENY == $repositoryAccess[0]['access'])
      {
        QubitAcl::forwardUnauthorized();
      }
    }
    else
    {
      $subquery = new Zend_Search_Lucene_Search_Query_MultiTerm();
      while ($repo = array_shift($repositoryAccess))
      {
        if ('*' != $repo['id'])
        {
          $subquery->addTerm(new Zend_Search_Lucene_Index_Term($repo['id'], 'repositoryid'));
        }
        else
        {
          if (QubitAcl::DENY == $repo['access'])
          {
            // Require repos to be specifically allowed (all others prohibited)
            $query->addSubquery($subquery, true /* required */);
          }
          else
          {
            // Prohibit specified repos (all others allowed)
            $query->addSubquery($subquery, false /* prohibited */);
          }
        }
      }
    }

    return $query;
  }

  public static function searchFilterDrafts($query)
  {
    // Filter out 'draft' items by repository
    $repositoryViewDrafts = QubitAcl::getRepositoryAccess(QubitAclAction::VIEW_DRAFT_ID);
    if (1 == count($repositoryViewDrafts))
    {
      if (QubitAcl::DENY == $repositoryViewDrafts[0]['access'])
      {
        // Don't show *any* draft info objects
        $query->addSubquery(new Zend_Search_Lucene_Search_Query_Term(new Zend_Search_Lucene_Index_Term(QubitTerm::PUBLICATION_STATUS_PUBLISHED_ID, 'publicationStatusId')), true);
      }
    }
    else
    {
      // Get last rule in list, it will be the global rule with the opposite
      // access of the preceeding rules (e.g. if last rule is "DENY ALL" then
      // preceeding rules will be "ALLOW" rules)
      $globalRule = array_pop($repositoryViewDrafts);

      // If global rule is GRANT, then listed repos are exceptions so remove
      // from results
      if (QubitAcl::GRANT == $globalRule['access'])
      {
        while ($repo = array_shift($repositoryViewDrafts))
        {
          $subquery = new Zend_Search_Lucene_Search_Query_MultiTerm();
          $subquery->addTerm(new Zend_Search_Lucene_Index_Term($repo['id'], 'repositoryid'), true);
          $subquery->addTerm(new Zend_Search_Lucene_Index_Term(QubitTerm::PUBLICATION_STATUS_DRAFT_ID, 'publicationStatusId'), true);

          // Filter rule should look like: "-(+id:356 +status:draft) -(+id:357 +status:draft)"
          $query->addSubquery($subquery, false /* prohibited */);
        }
      }

      // If global rule is DENY, then only show the listed repo drafts
      else
      {
        $subquery = new Zend_Search_Lucene_Search_Query_MultiTerm();

        while ($repo = array_shift($repositoryViewDrafts))
        {
          $subquery->addTerm(new Zend_Search_Lucene_Index_Term($repo['id'], 'repositoryid'), null);
        }
        $subquery->addTerm(new Zend_Search_Lucene_Index_Term(QubitTerm::PUBLICATION_STATUS_PUBLISHED_ID, 'publicationStatusId'), null);

        // Filter rule should look like "+(id:(356 357 358) status:published)"
        $query->addSubquery($subquery, true /* required */);
      }
    }

    return $query;
  }
}
