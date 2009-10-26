<h1><?php echo __('Upload digital object') ?></h1>
<div class="headerCell"><?php if (0 < (strlen($label = $informationObject->getLabel()))): ?><?php echo $label ?><?php endif; ?></div>

<?php echo $form->renderFormTag(url_for(array('module' => 'digitalobject', 'action' => 'create'))) ?>
<input type="hidden" name="informationObject" value="<?php echo $informationObject->id ?>" />

<div class="form-item">
<?php echo $form->file->label(__('Select a digital object to upload'))->renderLabel() ?>
<?php echo $form->file->render() ?>
<span class="note"><?php echo __('max. file size ~%1%', array('%1%' => hr_filesize($maxUploadSize))) ?></span>
</div>

<ul class="actions">
  <li><?php echo link_to(__('Cancel'), array('module' => 'informationobject', 'action' => 'show', 'id' => $informationObject->id)) ?></li>
  <li><?php echo submit_tag(__('Create')) ?></li>
</ul>

</form>
