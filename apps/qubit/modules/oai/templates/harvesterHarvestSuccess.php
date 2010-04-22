<h1><?php __('Repository Harvest')?></h1>
<h3><?php echo __('Repository: ').$repositoryName ?></h3>
<?php echo __('Repository harvested successfuly') ?>
<br/>
<?php if($noRecordsMatch == true):?>
  <?php echo __('No new records') ?>
<?php elseif(isset($recordCount)): ?>
<?php echo $recordCount.__(' Records Imported') ?>
<?php $index = 0 ?>
<?php foreach($errorsFound as $errorFound): ?>
  <?php echo __('Error found in record: ')?>
  <?php echo __('XML: ') ?>
<?php endforeach ?>
<?php else :?>
  <?php echo __('An error occured during harvest') ?>
<?php endif ?>
<br>
<?php echo link_to(__('Click here to return to harvester main page'),'oai/harvesterList')?>
