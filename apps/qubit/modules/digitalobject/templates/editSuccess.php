<h1><?php echo __('Edit digital object') ?></h1>

<h1 class="label"><?php echo render_title($informationObject->getLabel()) ?></h1>

<?php echo $form->renderGlobalErrors() ?>

<?php if (isset($digitalObject)): ?>
  <div class="form-item">
    <?php echo get_component('digitalobject', 'show', array('digitalObject' => $digitalObject, 'usageType' => QubitTerm::REFERENCE_ID)) ?>
  </div>
<?php endif; ?>

<?php echo $form->renderFormTag(url_for(array($digitalObject, 'module' => 'digitalobject', 'action' => 'edit'))) ?>

  <?php echo $form->renderHiddenFields() ?>

  <fieldset class="collapsible">

    <legend><?php echo __('Master') ?></legend>

    <div class="form-item">
      <label for="filename"><?php echo __('Filename'); ?></label>
      <?php echo $digitalObject->getName() ?>
    </div>

    <div class="form-item">
      <label for="filesize"><?php echo __('Filesize'); ?></label>
      <?php echo hr_filesize($digitalObject->getByteSize()) ?>
    </div>

    <?php echo $form->mediaType->renderRow() ?>

    <?php if ($showCompoundObjectToggle): ?>
      <?php echo $form->displayAsCompound->label(__('View children as a compound digital object?'))->renderRow() ?>
    <?php endif; ?>

  </fieldset>

  <fieldset class="collapsible collapsed">

    <legend><?php echo __('Representations') ?></legend>

    <?php foreach ($representations as $usageId => $representation): ?>
      <?php if (isset($representation)): ?>
        <?php echo get_component('digitalobject', 'editRepresentation', array('digitalObject' => $digitalObject, 'representation' => $representation)) ?>
      <?php else: ?>
        <div class="form-item">
          <table class="inline">
            <tr>
              <th>
                <?php echo __('Add a new %1% representation', array('%1%' => QubitTerm::getById($usageId))) ?>
              </th>
            </tr><tr>
              <td>

                <?php echo __('Select a digital object to upload') ?>
                <?php if (-1 < $maxUploadSize): ?>
                  <span class="note"><?php echo __('Max. size ~%1%', array('%1%' => hr_filesize($maxUploadSize))) ?></span>
                <?php endif; ?>

                <?php echo $form['repFile_'.$usageId] ?>

                <?php if ($digitalObject->canThumbnail()): ?>
                  <?php echo __('<i>or</i> Auto-generate a new representation from master image') ?>
                  <?php echo $form['generateDerivative_'.$usageId] ?>
                <?php endif; ?>

              </td>
            </tr>
          </table>
        </div>
      <?php endif; ?>
    <?php endforeach; ?>

  </fieldset>

  <div class="actions section">

    <h2 class="element-invisible"><?php echo __('Actions') ?></h2>

    <div class="content">
      <ul class="clearfix links">

        <?php if (isset($sf_request->id)): ?>
          <li><?php echo link_to(__('Delete'), array($digitalObject, 'module' => 'digitalobject', 'action' => 'delete')) ?></li>
        <?php endif; ?>

        <li><?php echo link_to(__('Cancel'), array($informationObject, 'module' => 'informationobject')) ?></li>
        <li><?php echo submit_tag(__('Save')) ?></li>

      </ul>
    </div>

  </div>

</form>
