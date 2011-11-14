<li class="menu add">
  <a href="#" class="menu"><?php echo $addMenu->getLabel(array('cultureFallback' => true)) ?></a>
  <?php echo QubitMenu::displayHierarchyAsList($addMenu, 0, array('overrideVisibility' => array('admin' => $sf_user->hasCredential('administrator')))) ?>
</li>

<li class="menu">
  <a href="#" class="menu"><?php echo $manageMenu->getLabel(array('cultureFallback' => true)) ?></a>
  <?php echo QubitMenu::displayHierarchyAsList($manageMenu, 0, array('overrideVisibility' => array('admin' => $sf_user->hasCredential('administrator')))) ?>
</li>

<li class="menu">
  <a href="#" class="menu"><?php echo $importMenu->getLabel(array('cultureFallback' => true)) ?></a>
  <?php echo QubitMenu::displayHierarchyAsList($importMenu, 0, array('overrideVisibility' => array('admin' => $sf_user->hasCredential('administrator')))) ?>
</li>

<li class="menu">
  <a href="#" class="menu"><?php echo $adminMenu->getLabel(array('cultureFallback' => true)) ?></a>
  <?php echo QubitMenu::displayHierarchyAsList($adminMenu, 0, array('overrideVisibility' => array('admin' => $sf_user->hasCredential('administrator')))) ?>
</li>
