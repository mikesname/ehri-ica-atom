<div style="position: relative; left: 50px; top: 50px; text-align: left">
<?php echo '<b class="capitalize">'.__('title').'</b>:'.$informationObject->getTitle(array('sourceCulture'=>true)); ?><br />
<?php echo '<b class="capitalize">'.__('identifier').'</b>:'.$informationObject->getIdentifier(); ?><br />
<div style="width: auto; text-align: left; text-size: 14px; margin: 5px 0 5px 0; padding-bottom: 3px; ">
  <?php echo link_to('<< '.__('back'), $referer) ?>
</div>
<?php include_component('digitalobject','show',array(
  'digitalObject'=>$digitalObject,
  'usageType'=>$digitalObject->getUsageId(),
  'link'=>null,
  'iconOnly'=>true)); ?><br />
