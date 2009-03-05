<div id="menu-main">
  <?php echo QubitMenu::displayHierarchyAsList($mainMenu, 0, $sf_data->getRaw('options')) ?>
</div>
  
<?php if($showSecondaryMenu): ?>
<div class="menu-secondary">
  <?php echo QubitMenu::displayHierarchyAsList($mainMenu, 0, $sf_data->getRaw('options')) ?>

  <div class='versionNumber' style='visibility:<?php echo $versionNumberVisibility ?>;'>
    <?php echo $versionNumber ?>
  </div>
</div>
<?php endif; ?>
