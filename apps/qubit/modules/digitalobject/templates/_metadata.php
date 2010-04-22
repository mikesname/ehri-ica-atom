<div class="section">

  <?php echo link_to_if(SecurityPriviliges::editCredentials($sf_user, 'informationObject'), '<h2>'.__('Digital object metadata').'</h2>', array($digitalObject, 'module' => 'digitalobject', 'action' => 'edit'), array('title' => __('Edit digital object'))) ?>

  <?php if (!QubitAcl::check($digitalObject->informationObject, 'readReference')): ?>
    <?php echo render_show(__('Access'), __('Restricted')) ?>
  <?php endif; ?>

<?php if (QubitAcl::check($digitalObject->informationObject, 'readMaster')): ?>
  <?php if (QubitTerm::EXTERNAL_URI_ID == $digitalObject->usageId): ?>
    <?php echo render_show(__('URL'), render_value($digitalObject->path)) ?>
  <?php else: ?>
    <?php echo render_show(__('Filename'), $digitalObject->name) ?>
  <?php endif; ?>
<?php endif; ?>

  <?php echo render_show(__('Media type'), $digitalObject->mediaType) ?>

  <?php echo render_show(__('Mime-type'), $digitalObject->mimeType) ?>

  <?php echo render_show(__('Filesize'), hr_filesize($digitalObject->byteSize)) ?>

  <?php echo render_show(__('Uploaded'), $digitalObject->createdAt) ?>

</div>
