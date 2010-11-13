<div class="section" id="mainMenu">

  <h2 class="element-invisible"><?php echo __('Main menu') ?></h2>

  <div class="content">
    <?php echo QubitMenu::displayHierarchyAsList($mainMenu, 0, array('overrideVisibility' => array('admin' => $sf_user->hasCredential('administrator')))) ?>
  </div>

</div>
