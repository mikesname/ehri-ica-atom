<div id='menu-main'>
<?php echo $sf_data->getRaw('mainmenu') ?>
</div>

<?php if ($secondary_menu): ?>
<div class="menu-secondary" style='visibility:<?php echo $secondaryMenuVisibility ?>;'>
<?php echo $sf_data->getRaw('secondary_menu') ?>

<div class='versionNumber' style='visibility:<?php echo $versionNumberVisibility ?>;'>
<?php echo $versionNumber ?></div>

</div>
<?php endif; ?>
