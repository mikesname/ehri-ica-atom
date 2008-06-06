<?php echo __('Select a %1% to upload', array('%1%'=>sfConfig::get('app_ui_label_digitalobject'))) ?></label>
<?php echo input_file_tag('upload_file['.$usageId.']', 'size=40'); ?>