<div id="menu-main-block">
  <div id="menu-main">
    <?php echo QubitMenu::displayHierarchyAsList($mainMenu, 0, $sf_data->getRaw('options')) ?>
  </div>
</div>

  <?php if($showSecondaryMenu): ?>
  <div id="menu-secondary-block">
  <div class="menu-secondary">
    <?php echo QubitMenu::displayHierarchyAsList($mainMenu, 0, $sf_data->getRaw('options')) ?>

    <div class='versionNumber' style='visibility:<?php echo $versionNumberVisibility ?>;'>
      <?php echo $versionNumber ?>
    </div>
  </div>
  </div>
  <?php endif; ?>