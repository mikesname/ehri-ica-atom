<?php use_helper('Date') ?>

<div class="section">

  <?php echo link_to_if(SecurityPriviliges::editCredentials($sf_user, 'informationObject'), '<h2>'.__('Digital object metadata').'</h2>', array($resource, 'module' => 'digitalobject', 'action' => 'edit'), array('title' => __('Edit digital object'))) ?>

  <?php if (!QubitAcl::check($resource->informationObject, 'readReference')): ?>
    <?php echo render_show(__('Access'), __('Restricted')) ?>
  <?php endif; ?>

<?php if (QubitAcl::check($resource->informationObject, 'readMaster')): ?>
  <?php if (QubitTerm::EXTERNAL_URI_ID == $resource->usageId): ?>
    <?php echo render_show(__('URL'), render_value($resource->path)) ?>
  <?php else: ?>
    <?php echo render_show(__('Filename'), $resource->name) ?>
  <?php endif; ?>
<?php endif; ?>

  <?php echo render_show(__('Media type'), $resource->mediaType) ?>

  <?php echo render_show(__('Mime-type'), $resource->mimeType) ?>

  <?php echo render_show(__('Filesize'), hr_filesize($resource->byteSize)) ?>

  <?php echo render_show(__('Uploaded'), format_date($resource->createdAt, 'f')) ?>

</div>
