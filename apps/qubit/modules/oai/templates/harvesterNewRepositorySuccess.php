<div class="pageTitle"><?php __('Repository Insertion')?></div>
<?php if(isset($preExistingRepository)): ?>
  <?php echo __('Repository could not be added because it already exists.')?>
<?php elseif(isset($parsingErrors)):?>
  <?php echo __('Errors while trying to add Repository')?>
<?php else: ?>
New Repository Added
<?php endif ?>
<br>
<?php echo link_to(__('Click here to return to harvester main page'),'oai/harvesterList')?>
