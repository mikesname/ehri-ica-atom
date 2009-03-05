<div class="pageTitle"><?php echo __('view %1%', array('%1%' => sfConfig::get('app_ui_label_digitalobject'))); ?></div>

<table class="detail">
<tbody>

<?php if ($informationObject->getTitle(array('sourceCulture' => true))): ?>
<tr><td colspan="2" class="headerCell">
<?php if ($editCredentials): ?>
  <?php echo link_to($informationObject->getLabel(), 'informationobject/edit/?id='.$informationObject->getId()); ?>
<?php else: ?>
  <?php echo $informationObject->getLabel(); ?>
<?php endif; ?>
</td></tr>
<?php endif; ?>

<tr><td align="center" style="text-align: center;" colspan="2">
  <?php include_component('digitalobject', 'show', array(
    'digitalObject'=>$digitalObject,
    'usageType'=>QubitTerm::REFERENCE_ID,
    'link'=>$link)); ?>
</td></tr>

<?php if ($digitalObject->getMimeType()): ?>
<tr>
<th><?php echo __('mime-type'); ?></th>
<td><?php echo $digitalObject->getMimeType(); ?></td>
</tr>
<?php endif; ?>

<?php if ($digitalObject->getMediaType()): ?>
<tr>
<th><?php echo __('media type'); ?></th>
<td><?php echo $digitalObject->getMediaType(); ?></td>
</tr>
<?php endif; ?>

<?php if ($digitalObject->getHRfileSize()): ?>
<tr>
<th><?php echo __('filesize'); ?></th>
<td><?php echo $digitalObject->getHRfileSize(); ?></td>
</tr>
<?php endif; ?>

<?php if ($digitalObject->getCreatedAt()): ?>
<tr>
<th><?php echo __('uploaded'); ?></th>
<td><?php echo $digitalObject->getCreatedAt(); ?></td>
</tr>
<?php endif; ?>

<?php if (count($derivatives) && $editCredentials): ?>
<tr>
<th><?php echo __('derivatives'); ?></th>
<td>
<?php foreach ($derivatives as $derivative): ?>
<div style="float:left; margin: 5px">
  <?php include_component('digitalobject', 'show', array(
    'digitalObject'=>$digitalObject,
    'usageType'=>QubitTerm::THUMBNAIL_ID,
    'link'=>'digitalobject/showFullScreen?id='.$derivative->getId(),
    'iconOnly'=>true
  )); ?><br />
  <?php echo '<b>'.__('usage').'</b>: '.$derivative->getUsage(); ?><br />
  <?php echo '<b>'.__('filesize').'</b>: '.$derivative->getHRfileSize(); ?><br />
  <?php // echo '<b>'.__('dimensions').'</b>:100x200px'; ?>
</div>
<?php endforeach; ?>

</td>
</tr>
<?php endif; ?>
</tbody>
</table>

<?php if ($editCredentials): ?>
<div class="menu-action">
     <?php echo link_to (__('edit %1%', array('%1%' => sfConfig::get('app_ui_label_digitalobject'))), 'informationobject/edit?id='.$informationObject->getId()) ?>
</div>
<?php endif; ?>

<div class="menu-extra">
  <?php echo link_to (__('view %1%', array('%1%' => sfConfig::get('app_ui_label_informationobject'))), 'informationobject/show?id='.$informationObject->getId()) ?>
</div>