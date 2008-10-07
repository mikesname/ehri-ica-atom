<div class="form-item">
  <label for="usagetype">
    <?php echo $representation->getUsage(); ?>
    <?php $confirmDeleteString = __('Delete this %1%? This cannot be undone!', array('%1%'=>sfConfig::get('app_ui_label_digitalobject'))) ?>
    <?php echo link_to(
      image_tag('/images/delete.png', array('style'=>'vertical-align: middle')),
      'digitalobject/delete?id='.$representation->getId(), array('confirm'=>$confirmDeleteString)); ?>
  </label>
  <div style="margin: 5px 5px 0px 0px; float: left">
    <div class="digitalObjectRep">
      <?php include_component('digitalobject', 'show', array(
        'digitalObject'=>$representation,
        'usageType'=>QubitTerm::THUMBNAIL_ID,
        'link'=>$link,
        'iconOnly'=>true
      )); ?>
    </div>
  </div>
</div>

<div class="form-item">
  <label for="filename"><?php echo __('filename'); ?></label>
  <?php echo $representation->getName(); ?>
</div>

<div class="form-item">
  <label for="filesize"><?php echo __('filesize'); ?></label>
  <?php echo $representation->getHRfileSize(); ?>
</div>

<br style="clear:both" />