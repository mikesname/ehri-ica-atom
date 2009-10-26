<div class="pageTitle">
  <?php echo __('browse %1%', array('%1%' => sfConfig::get('app_ui_label_digitalobject'))) ?>
  - <?php echo $mediaType->getName(); ?>
</div>
<?php include_component('digitalobject', 'browse', array('mediaTypeId'=>$mediaType->getId(), 'page'=>$page)); ?>
