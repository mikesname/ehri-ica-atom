<div class="multiFileUpload">
  <div class="multiFileUploadItem">
    <div class="multiFileUploadThumbItem">
      <?php echo get_component('digitalobject', 'show', array(
        'digitalObject' => $representation,
        'usageType' => QubitTerm::THUMBNAIL_ID,
        'link' => public_path($representation->getFullPath()),
        'iconOnly' => true
      )) ?>
    </div>
    <div class="multiFileUploadInfo">
      <div>
        <span class="title"><?php echo __('%1% representation', array('%1%' => $representation->usage)) ?></span>
      </div>
      <div class="multiFileUploadFilename">
        <span class="title"><?php echo __('Filename') ?>:</span>
        <span class="value"><?php echo $representation->name ?></span>
      </div>
      <div class="multiFileUploadFilesize">
        <span class="title"><?php echo __('Filesize') ?>:</span>
        <span class="value"><?php echo hr_filesize($representation->byteSize); ?></span>
      </div>
      <div class="multiFileUploadInfoActions">
        <?php echo link_to(__('Delete'), array($representation, 'module' => 'digitalobject', 'action' => 'delete')) ?>
      </div>
    </div>
  </div>
</div>
