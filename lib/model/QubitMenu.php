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

class QubitMenu extends BaseMenu
{
  // The following Menu ids are assigned constant values because they are used
  // in application code and can't rely on database id values, since these could
  // be changed

  // Root menu
  const ROOT_ID = 1;

  // 2nd generation constant ids
  const MAIN_MENU_ID = 2;
  const QUICK_LINKS_ID  = 3;
  const BROWSE_ID = 4;

  // 3rd generation constant ids
  const ADD_EDIT_ID = 5;
  const TAXONOMY_ID = 6;
  const IMPORT_ID = 7;
  const TRANSLATE_ID = 8;
  const ADMIN_ID = 9;

  /**
   * Wrapper for BaseMenu::getPath() call to allow additional functionality
   *  option 'resolveAlias' - resolve aliases into full path
   *  option 'getUrl' - resolve path to internal or external URL
   *
   * @param array $options Optional parameters
   * @return string Path or url for menu
   */
  public function getPath($options = array())
  {
    $aliases = array(
      '%profile%' => sfContext::getInstance()->routing->generate(null, array('module' => 'user', 'id' => sfContext::getInstance()->getUser()->getUserId())),
      '%currentId%' => sfContext::getInstance()->getRequest()->id
    );

    $path = parent::offsetGet('path', $options);

    if (isset($options['resolveAlias']) && $options['resolveAlias'])
    {
      foreach ($aliases as $alias => $target)
      {
        if (false !== strpos($path, $alias))
        {
          $path = str_replace($alias, $target, $path);
        }
      }
    }

    if (isset($options['getUrl']) && true == $options['getUrl'])
    {
      // Catch any exceptions thrown from url_for() to prevent ugly errors when
      // admin puts in a bad route
      try
      {
        $url = url_for($path);
      }
      catch (Exception $e)
      {
        // if exception caught then return a blank route (home page)
        $url = url_for('');
      }

      $path = $url;
    }

    return $path;
  }

  /**
   * Test if this menu is protected (can't delete)
   *
   * @return boolean
   */
  public function isProtected()
  {
    return $this->getId() == QubitMenu::ROOT_ID ||
    $this->getId() == QubitMenu::MAIN_MENU_ID ||
    $this->getId() == QubitMenu::QUICK_LINKS_ID ||
    $this->getId() == QubitMenu::ADD_EDIT_ID ||
    $this->getId() == QubitMenu::ADMIN_ID;
  }

  /**
   * Return name of menu if object is cast as string
   *
   * @return string menu name
   */
  public function __toString()
  {
    return (string) $this->name;
  }

  /**
   * Find menu by name
   *
   * @param string $topMenuName name of top ancestor
   * @param array $options optional parameters
   * @return array of menu columns, with an additional 'depth' column
   */
  public static function getByName($menuName, $options = array())
  {
    $criteria = new Criteria;
    $criteria->add(QubitMenu::NAME, $menuName, Criteria::EQUAL);

    return QubitMenu::getOne($criteria);
  }

  /**
   * Test if menu has children
   *
   * @return boolean true if menu has children
   */
  public function hasChildren()
  {
    return ($this->getRgt() - $this->getLft() > 1);
  }

  /**
   * Test if this menu is selected (based on current module/action)
   *
   * @return boolean
   */
  public function isSelected()
  {
    $currentModule = sfContext::getInstance()->getModuleName();
    $currentAction = sfContext::getInstance()->getActionName();
    $currentUrl = url_for($currentModule.'/'.$currentAction);
    $isSelected = false;

    // Yucky Hack: Don't display "static" menu as selected when displaying a
    // staticpage (See FIXME below)
    if ($currentModule == 'staticpage' && $currentAction == 'static')
    {

      return false;
    }
    // Yucky Hack, Part Deux: Don't display any active menu options when
    // displaying search results
    if ($currentModule == 'search' && $currentAction == 'search')
    {

      return false;
    }
    // 'Hacks 3: Return of the Hack' Select the 'archival description' button
    // when uploading digital object
    if ($currentModule == 'digitalobject' && $currentAction == 'edit')
    {

      return ($this->getPath() == 'informationobject/list');
    }
    // And even more hacks
    else if (in_array($currentModule, array('sfIsadPlugin', 'sfRadPlugin', 'sfDcPlugin', 'sfModsPlugin')))
    {

      return ($this->getPath() == 'informationobject/list');
    }

    // son of hack
    if ($currentModule == 'term')
    {

      return ($this->getPath() == 'term/list');
    }

    // If passed $url matches the url for this menu AND is not the base url
    // for the application (url_for()), return true
    $menuUrl = $this->getPath(array('getUrl' => true, 'resolveAlias' => true));
    if ($menuUrl == $currentUrl && $currentUrl != url_for(''))
    {
      $isSelected = true;
    }

    /***
     * FIXME Implement a better way to determine if a menu is selected than
     * the "current module = menu module" paradigm
     ***/

    // if 'module/action' is returned from getPath, then test if module matches
    // current module
    if (preg_match('|^([a-zA-Z]+)/(.+)|', $this->getPath(), $matches))
    {
      if ($matches[1] == $currentModule)
      {
        $isSelected = true;
      }
    }

    return $isSelected;
  }

  /**
   * Test if a descendant of this menu is selected.
   *
   * @return boolean
   */
  public function isDescendantSelected()
  {
    foreach ($this->getDescendants() as $menu)
    {
      if ($menu->isSelected())
      {

        return true;
      }
    }

    return false;
  }

  /**
   * Get children (only 1st generation) of current menu.
   *
   * @return QubitQuery found children
   */
  public function getChildren()
  {
    $c = new Criteria;
    $c->add(QubitMenu::PARENT_ID, $this->getId(), Criteria::EQUAL);
    $c->addAscendingOrderByColumn(QubitMenu::LFT);

    return QubitMenu::get($c);
  }

  /**
   * Called as a method of the intended *parent* menu of the $newMenu object,
   * inserts $newMenu in position right before $referenceMenu
   *
   * @param QubitMenu $newMenu new menu to create or move
   * @param QubitMenu $referenceMenu reference object for positioning $newMenu
   * @return QubitMenu $newMenu object
   */
  public function insertBefore(QubitMenu $newMenu, $referenceMenu = null)
  {
    // TODO: Test if object already exists in hierarchy
    //$sql = "SELECT count(*) as exists FROM q_menu WHERE id = ".$newMenu->getId();

    // Lock db, start transaction
    $sql = 'LOCK TABLE q_menu WRITE;';

    // TODO: Currently NOT testing for $existingObject
    $existingObject = false;
    if ($existingObject || true)
    {
      if (!is_null($referenceMenu))
      {
        // If referenceMenu is set, then insert $newMenu just before it
        $newLft = $referenceMenu->getLft();
      }
      else
      {
        // If $referenceMenu is null then insert $newMenu as last child
        $newLft = $this->getRgt();
      }

      $sql .= 'SELECT @oldlft := lft, @oldrgt := rgt FROM q_menu WHERE id = '.$newMenu->getId().';';
      $sql .= 'SELECT @width  := @oldrgt - @oldlft + 1;';
      $sql .= 'SELECT @newlft := '.$newLft.';';
      $sql .= 'SELECT @newrgt := @newlft + @width - 1;';
      $sql .= 'SELECT @shift  := @newlft - @oldlft;';

      // Make room for $newMenu in new location
      $sql .= 'UPDATE q_menu SET lft = lft + @width WHERE lft >= @newlft;';
      $sql .= 'UPDATE q_menu SET rgt = rgt + @width WHERE rgt >= @newlft;';

      if ($newMenu->getLft() < $newLft)
      {
        // Move $newMenu (+ children) to new location
        $sql .= 'UPDATE q_menu SET lft = lft + @shift WHERE lft >= @oldlft AND lft <= @oldrgt;';
        $sql .= 'UPDATE q_menu SET rgt = rgt + @shift WHERE rgt >= @oldlft AND rgt <= @oldrgt;';

        // Close gap left in $newMenu's old location
        $sql .= 'UPDATE q_menu SET lft = lft - @width WHERE lft > @oldrgt;';
        $sql .= 'UPDATE q_menu SET rgt = rgt - @width WHERE rgt > @oldrgt;';
      }
      else
      {
        // Move $newMenu (+ children) to new location (taking into account that
        // current lft/right values of $newMenu are + $width)
        $sql .= 'UPDATE q_menu SET lft = lft + @shift - @width WHERE lft >= @oldlft + @width AND lft <= @oldrgt + @width;';
        $sql .= 'UPDATE q_menu SET rgt = rgt + @shift - @width WHERE rgt >= @oldlft + @width AND rgt <= @oldrgt + @width;';

        // Close gap left in $newMenu's old location
        $sql .= 'UPDATE q_menu SET lft = lft - @width WHERE lft > @oldrgt + @width;';
        $sql .= 'UPDATE q_menu SET rgt = rgt - @width WHERE rgt > @oldrgt + @width;';
      }

      // Update parent_id
      $sql .= 'UPDATE q_menu SET parent_id = '.$this->getId().' WHERE id = '.$newMenu->getId().';';
    }

    $sql .= 'UNLOCK TABLES';

    $conn = Propel::getConnection();
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $stmt->closeCursor();

    $conn->clearStatementCache();

    // TODO: return id for newly inserted $newMenu (last insert id?)
    return QubitMenu::getById($newMenu->getId());
  }

  /**
   * Move this menu before $referenceMenu
   *
   * @param integer reference menu id
   * @return QubitMenu $this object
   */
  public function moveBeforeById($referenceMenuId)
  {
    // Limit re-sorting to list of siblings
    $parent = $this->getParent();

    $criteria = new Criteria;
    $criteria->add(QubitMenu::ID, $referenceMenuId, Criteria::EQUAL);
    $criteria->addAnd(QubitMenu::LFT, $parent->getLft(), Criteria::GREATER_THAN);
    $criteria->addAnd(QubitMenu::RGT, $parent->getRgt(), Criteria::LESS_THAN);

    if ($referenceMenu = QubitMenu::getOne($criteria))
    {
      $parent->insertBefore($this, $referenceMenu);

      // Refresh moved object to get up-to-date data from db
      $this->clear();
    }

    return $this;
  }

  /**
   * Move this menu after $referenceMenu
   *
   * @param integer reference menu id
   * @return QubitMenu $this object
   */
  public function moveAfterById($referenceMenuId)
  {
    // Limit re-sorting to list of siblings
    $parent = $this->getParent();

    $criteria = new Criteria;
    $criteria->add(QubitMenu::ID, $referenceMenuId, Criteria::EQUAL);
    $criteria->addAnd(QubitMenu::LFT, $parent->getLft(), Criteria::GREATER_THAN);
    $criteria->addAnd(QubitMenu::RGT, $parent->getRgt(), Criteria::LESS_THAN);

    if ($nextMenu = QubitMenu::getOne($criteria))
    {
      // Need to get menu *after* the "next" menu, because we only have an
      // insertBefore() method
      $criteria = new Criteria;
      $criteria->add(QubitMenu::LFT, $nextMenu->getRgt(), Criteria::GREATER_THAN);
      $criteria->addAnd(QubitMenu::LFT, $parent->getLft(), Criteria::GREATER_THAN);
      $criteria->addAnd(QubitMenu::RGT, $parent->getRgt(), Criteria::LESS_THAN);
      $criteria->addAscendingOrderByColumn(QubitMenu::LFT);

      if ($referenceMenu = QubitMenu::getOne($criteria))
      {
        $parent->insertBefore($this, $referenceMenu);
      }
      else
      {
        // If no referenceMenu found, then move to end of sibling list
        $parent->insertBefore($this, null);
      }

      // Refresh moved object to get up-to-date data from db
      $this->clear();
    }

    return $this;
  }

  /**
   * Find top menu by id, then get all descendents with relative depth
   *
   * @param string $topMenuName name of top ancestor
   * @param array $options optional parameters
   * @return array of menu columns, with an additional 'depth' column
   */
  public static function getTreeById($id, $options=array())
  {
    // Attempt to grab topMenu object via id
    if (null === $topMenu = QubitMenu::getById($id))
    {

      return false;
    }

    return QubitMenu::getTree($topMenu, $options);
  }

  /**
   * Retrieve the current menu hierarchy as a two-dimensional array. Each row in
   * the array includes a 'depth' column (relative to the root of the tree) to
   * aid in formatting the tree for display.
   *
   * @param QubitMenu $topMenu top ancestor
   * @param array $options optional parameters
   * @return array of menu columns, with an additional 'depth' column
   */
  public static function getTree(QubitMenu $topMenu, $options=array())
  {
    $maxDepth = 0;

    if (isset($options['maxDepth']) && is_int($options['maxDepth']))
    {
      $maxDepth = ($options['maxDepth'] > 0) ? $options['maxDepth'] : 0;
    }

    // Get all descendents of "top" menu
    $criteria = new Criteria;
    $criteria->add(QubitMenu::LFT, $topMenu->getLft(), Criteria::GREATER_THAN);
    $criteria->addAnd(QubitMenu::RGT, $topMenu->getRgt(), Criteria::LESS_THAN);
    $criteria->addAscendingOrderByColumn(QubitMenu::LFT);
    $menus = QubitMenu::get($criteria);

    // labouriously calculate depth of current menu from top of hierarchy by
    // looping through results and tracking "ancestors"
    $ancestors = array($topMenu->getId());
    foreach ($menus as $menu)
    {
      $thisParentId = $menu->getParentId();
      if ($ancestors[count($ancestors) - 1] != $thisParentId)
      {
        if (!in_array($thisParentId, $ancestors))
        {
          array_push($ancestors, $thisParentId);
        }
        else
        {
          while ($ancestors[count($ancestors) - 1] != $thisParentId)
          {
            array_pop($ancestors);
          }
        }
      }

      // Limit depth of descendants to $maxDepth
      $depth = count($ancestors);
      if ($maxDepth == 0 || $depth <= $maxDepth)
      {
        $menuTree[] = array(
          'id' => $menu->getId(),
          'parentId' => $menu->getParentId(),
          'name' => $menu->getName(array('cultureFallback' => true)),
          'label' => $menu->getLabel(array('cultureFallback' => true)),
          'depth' => $depth,
          'protected' => ($menu->isProtected()) ? true : false
        );
      }
    }

    return $menuTree;
  }

  /**
   * Display a menu hierarchy as a nested XHTML list.
   *
   * NOTE: This function is a hack that violates the rules of MVC code/template
   * separation; unfortunately, this was by far the cleanest method I could devise
   * for accurately representing a menu heirarchy as a nested XHTML list.
   *
   * @param QubitMenu $parent parent menu object for hierarchy branch
   * @param integer $depth current (relative) depth from top of tree (for styling)
   * @param array $options optional parameters
   * @return string an indented, nested XHTML list
   */
  public static function displayHierarchyAsList($parent, $depth = 0, $options = array())
  {
    $li = array();
    foreach ($parent->getChildren() as $child)
    {
      // Skip this menu and children if marked "hidden"
      if (isset($options['overrideVisibility'][$child->getName()])
        && !$options['overrideVisibility'][$child->getName()])
      {
        continue;
      }

      $class = array();
      if ($child->isSelected() || $child->isDescendantSelected())
      {
        $class[] = 'active';
      }

      $a = link_to($child->getLabel(array('cultureFallback'=>true)), $child->getPath(array('getUrl' => true, 'resolveAlias' => true)));

      if ($child->hasChildren())
      {
        $a .= self::displayHierarchyAsList($child, $depth + 1, $options);
      }
      else
      {
        $class[] = 'leaf';
      }

      $class = implode(' ', $class);
      if (0 < strlen($class))
      {
        $class = ' class="'.$class.'"';
      }

      $li[] = '<li'.$class.'>'.$a.'</li>';
    }

    return '<ul class="clearfix links">'.implode($li).'</ul>';
  }
}
