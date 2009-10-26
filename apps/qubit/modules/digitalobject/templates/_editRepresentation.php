<?php $confirmDeleteString = __('Delete this %1%? This cannot be undone!', array('%1%'=>sfConfig::get('app_ui_label_digitalobject'))) ?>

<table class="inline" style="width: 98%">
  <tr>
    <th colspan="2">
      <?php echo __('%1% representation', array('%1%' => $representation->getUsage())); ?>
      <?php echo link_to(
        image_tag('/images/delete.png', array('style'=>'vertical-align: middle')),
        'digitalobject/delete?id='.$representation->getId(), array('confirm'=>$confirmDeleteString)); ?>
    </th>
  </tr>
  <tr>
    <td>
      <div class="digitalObjectRep">
      <?php include_component('digitalobject', 'show', array(
        'digitalObject'=>$representation,
        'usageType'=>QubitTerm::THUMBNAIL_ID,
        'link'=>$link,
        'iconOnly'=>true
      )); ?>
      </div>
    </td>
    <td style="padding: 0px; margin: 0px;">
      <table style="width: 350px; padding: 0px; margin: 0px">
        <tr>
          <td>
            <label for="filename"><?php echo __('filename'); ?></label>
            <div><?php echo $representation->getName(); ?></div>
          </td>
        </tr>
        <tr>
          <td>
            <label for="filesize"><?php echo __('filesize'); ?></label>
            <?php echo hr_filesize($representation->getByteSize()); ?>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
