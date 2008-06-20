<div style="position: relative; left: 50px; top: 50px; text-align: left">
<div style="width: auto; text-align: left; text-size: 14px">
  <?php echo link_to('<< '.__('back'), $referer) ?>
</div>
<?php include_component('digitalobject','show',array(
  'digitalObject'=>$digitalObject,
  'usageType'=>$digitalObject->getUsageId(),
  'link'=>null,
  'iconOnly'=>true)); ?><br />
<?php echo '<b class="capitalize">'.__('title').'</b>:'.$informationObject->getTitle(array('sourceCulture'=>true)); ?><br />
<?php echo '<b class="capitalize">'.__('usage type').'</b>: '.$digitalObject->getUsage(); ?>