<?php echo __('Select a %1% to upload', array('%1%'=>sfConfig::get('app_ui_label_digitalobject'))) ?>
<span class="note"><?php echo __('max. size ~%1%', array('%1%' => hr_filesize($maxUploadSize))) ?></span>
<?php echo input_file_tag('upload_file['.$usageId.']', 'size=40'); ?>