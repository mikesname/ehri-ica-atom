<h1><?php echo __('Edit digital object') ?></h1>

<div class="headerCell"><?php if (0 < (strlen($label = $informationObject->getLabel()))): ?><?php echo $label ?><?php endif; ?></div>

<?php if ($form->hasGlobalErrors()): ?>
<div><?php echo $form->renderGlobalErrors() ?></div>
<?php endif; ?>

<?php if (null !== $digitalObject): ?>
  <div class="form-item" style="text-align: center">
    <?php include_component('digitalobject', 'show', array(
      'digitalObject' => $digitalObject, 'usageType' => QubitTerm::REFERENCE_ID)) ?>
  </div>
<?php endif; ?>

<?php echo $form->renderFormTag(url_for(array('module' => 'digitalobject', 'action' => 'edit', 'id' => $sf_request->id))) ?>
<?php echo $form->renderHiddenFields() ?>
<fieldset class="collapsible">
  <legend><?php echo __('Master') ?></legend>

  <div class="form-item">
    <label for="filename"><?php echo __('filename'); ?></label>
    <?php echo $digitalObject->getName() ?>
  </div>

  <div class="form-item">
    <label for="filesize"><?php echo __('filesize'); ?></label>
    <?php echo hr_filesize($digitalObject->getByteSize()) ?>
  </div>

  <div class="form-item">
    <?php echo $form->mediaType->renderRow() ?>
  </div>

  <?php if ($showCompoundObjectToggle): ?>
  <div class="form-item">
    <?php $form->displayAsCompound->label(__('view children as a compound digital object?')) ?>
    <?php echo $form->displayAsCompound->renderRow() ?>
  </div>
  <?php endif; ?>
</fieldset>

<fieldset class="collapsible collapsed">
  <legend><?php echo __('Representations') ?></legend>

  <?php foreach ($representations as $usageId => $representation): ?>
  <?php if (null !== $representation): ?>
    <?php include_component('digitalobject', 'editRepresentation',
      array('digitalObject'=>$digitalObject, 'representation'=>$representation)); ?>
  <?php else: ?>
    <div class="form-item">
      <table class="inline">
        <tr>
          <th><?php echo __('Add a new %1% representation', array('%1%'=>QubitTerm::getById($usageId))); ?></th>
        </tr>
        <tr style="border-bottom: 1px solid #CCC">
          <td>
            <?php echo __('Select a digital object to upload') ?>
            <span class="note"><?php echo __('max. size ~%1%', array('%1%' => hr_filesize($maxUploadSize))) ?></span>
            <?php echo $form['repFile_'.$usageId]->render() ?><br />

            <?php if ($digitalObject->canThumbnail()): ?>
              <?php echo __('<i>or</i> Auto-generate a new representation from master image'); ?>
              <?php echo $form['generateDerivative_'.$usageId]->render() ?>
            <?php endif; ?>
          </td>
        </tr>
      </table>
    </div>
  <?php endif; ?>
  <?php endforeach; ?>
</fieldset>

  <ul class="actions">
    <?php if (isset($sf_request->id)): ?>
    <li><?php echo link_to(__('Delete'), array('module' => 'digitalobject', 'action' => 'delete', 'id' => $digitalObject->id)) ?></li>
    <?php endif; ?>
    <li><?php echo link_to(__('Cancel'), array('module' => 'informationobject', 'action' => 'show', 'id' => $informationObject->id)) ?></li>
    <li><?php echo submit_tag(__('Save')) ?></li>
  </ul>

</form>
