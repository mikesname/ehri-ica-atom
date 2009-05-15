<div id="menu-main-block">
  <div id="menu-main">

    <div class='versionNumber' style='visibility:<?php echo $versionNumberVisibility ?>;'>
      <?php echo $versionNumber ?>
    </div>

    <?php echo QubitMenu::displayHierarchyAsList($mainMenu, 0, $sf_data->getRaw('options')) ?>
  </div>
</div>

  <?php if($showSecondaryMenu): ?>
  <div id="menu-secondary-block">
  <div class="menu-secondary">
    <?php echo QubitMenu::displayHierarchyAsList($mainMenu, 0, $sf_data->getRaw('options')) ?>

  </div>
  </div>
  <?php endif; ?>