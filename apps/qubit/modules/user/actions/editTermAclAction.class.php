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

class UserEditTermAclAction extends sfAction
{
  /**
   * Define form field names
   *
   * @var string
   */
  public static $NAMES = array(
    'taxonomy'
  );

  public function addField($name)
  {
    switch ($name)
    {
      case 'taxonomy':
        $choices = array();
        $choices[null] = null;

        foreach (QubitTaxonomy::getEditableTaxonomies() as $taxonomy)
        {
          $choices[$this->context->routing->generate(null, array($taxonomy, 'module' => 'taxonomy'))] = $taxonomy;
        }

        $this->form->setDefault($name, null);
        $this->form->setValidator($name, new sfValidatorPass);
        $this->form->setWidget($name, new sfWidgetFormSelect(array('choices' => $choices)));

        break;
    }
  }

  public function execute($request)
  {
    $this->form = new sfForm;

    $this->user = new QubitUser;

    if (isset($this->request->id))
    {
      $this->user = QubitUser::getById($this->request->id);

      if (!isset($this->user))
      {
        $this->forward404();
      }
    }

    $this->form->getValidatorSchema()->setOption('allow_extra_fields', true);

    // HACK: Use static::$NAMES in PHP 5.3,
    // http://php.net/oop5.late-static-bindings
    $class = new ReflectionClass($this);
    foreach ($class->getStaticPropertyValue('NAMES') as $name)
    {
      $this->addField($name);
    }

    $this->permissions = array();
    if (null != $this->user->id)
    {
      // Get info object permissions for this group
      $criteria = new Criteria;
      $criteria->addJoin(QubitAclPermission::OBJECT_ID, QubitObject::ID, Criteria::LEFT_JOIN);
      $criteria->add(QubitAclPermission::USER_ID, $this->user->id);
      $c1 = $criteria->getNewCriterion(QubitAclPermission::OBJECT_ID, null, Criteria::ISNULL);
      $c2 = $criteria->getNewCriterion(QubitObject::CLASS_NAME, 'QubitTerm');
      $c1->addOr($c2);
      $criteria->add($c1);

      $criteria->addAscendingOrderByColumn(QubitAclPermission::CONSTANTS);
      $criteria->addAscendingOrderByColumn(QubitAclPermission::OBJECT_ID);

      if (0 < count($permissions = QubitAclPermission::get($criteria)))
      {
        $this->permissions = $permissions;
      }
    }

    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getPostParameters());

      if ($this->form->isValid())
      {
        $this->processForm();
        $this->redirect(array($this->user, 'module' => 'user', 'action' => 'indexTermAcl'));
      }
    }
  }

  protected function processForm()
  {
    $this->processTermAcl('termAcl');

    if ($this->request->hasParameter('taxonomyAcl'))
    {
      $this->processTermAcl('taxonomyAcl');
    }

    // Save changes
    $this->user->save();

    return $this;
  }

  protected function processTermAcl($name)
  {
    foreach ($this->request->getParameter($name) as $key => $value)
    {
      // If key has an underscore, then we are creating a new permission
      if (1 == preg_match('/([\w]+)_(.*)/', $key, $matches))
      {
        list ($action, $uri) = array_slice($matches, 1, 2);
        $params = $this->context->routing->parse(Qubit::pathInfo($uri));
        if (!isset($params['id']))
        {
          continue;
        }

        if (QubitAcl::INHERIT != $value && isset(QubitAcl::$ACTIONS[$action]))
        {
          $aclPermission = new QubitAclPermission;
          $aclPermission->action = $action;
          $aclPermission->grantDeny = (QubitAcl::GRANT == $value) ? 1 : 0;

          if ('taxonomyAcl' == $name)
          {
            // Taxonomy specific rules
            $aclPermission->objectId = QubitTerm::ROOT_ID;
            $aclPermission->setTaxonomy(QubitTaxonomy::getById($params['id']));
          }
          else
          {
            $aclPermission->objectId = $params['id'];
          }

          $this->user->aclPermissions[] = $aclPermission;
        }
      }

      // Otherwise, update an existing permission
      else if (null !== $aclPermission = QubitAclPermission::getById($key))
      {
        if ($value == QubitAcl::INHERIT)
        {
          $aclPermission->delete();
        }
        else
        {
          $aclPermission->grantDeny = (QubitAcl::GRANT == $value) ? 1 : 0;

          $this->user->aclPermissions[] = $aclPermission;
        }
      }
    }

    return $this;
  }
}
