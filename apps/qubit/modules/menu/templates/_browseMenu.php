<div class="browse section">

  <h2 class="element-invisible"><?php echo QubitMenu::getById(QubitMenu::BROWSE_ID)->getLabel(array('cultureFallback' => true)) ?></h2>

  <div class="content">
    <?php echo QubitMenu::displayHierarchyAsList($browseMenu, 0) ?>
  </div>

</div>
