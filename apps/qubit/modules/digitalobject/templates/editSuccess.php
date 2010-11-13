<h1><?php echo __('Edit digital object') ?></h1>

<h1 class="label"><?php echo render_title(new sfIsadPlugin($informationObject)) ?></h1>

<?php echo $form->renderGlobalErrors() ?>

<?php if (isset($resource)): ?>
  <div class="form-item">
    <?php echo get_component('digitalobject', 'show', array('resource' => $resource, 'usageType' => QubitTerm::REFERENCE_ID)) ?>
  </div>
<?php endif; ?>

<?php echo $form->renderFormTag(url_for(array($resource, 'module' => 'digitalobject', 'action' => 'edit'))) ?>

  <?php echo $form->renderHiddenFields() ?>

  <fieldset class="collapsible">

    <legend><?php echo __('Master') ?></legend>

    <?php echo render_show(__('Filename'), $resource->name) ?>

    <?php echo render_show(__('Filesize'), hr_filesize($resource->byteSize)) ?>

    <?php echo $form->mediaType->renderRow() ?>

    <?php if ($showCompoundObjectToggle): ?>
      <?php echo $form->displayAsCompound->label(__('View children as a compound digital object?'))->renderRow() ?>
    <?php endif; ?>

  </fieldset>

  <fieldset class="collapsible collapsed">

    <legend><?php echo __('Representations') ?></legend>

    <?php foreach ($representations as $usageId => $representation): ?>
      <?php if (isset($representation)): ?>
        <?php echo get_component('digitalobject', 'editRepresentation', array('resource' => $resource, 'representation' => $representation)) ?>
      <?php else: ?>
        <table>
          <thead>
            <tr>
              <th>
                <?php echo __('Add a new %1% representation', array('%1%' => QubitTerm::getById($usageId))) ?>
              </th>
            </tr>
          </thead><tbody>
            <tr>
              <td>

                <?php echo __('Select a digital object to upload') ?>

                <?php if (-1 < $maxUploadSize): ?>
                  <span class="note"><?php echo __('Max. size ~%1%', array('%1%' => hr_filesize($maxUploadSize))) ?></span>
                <?php endif; ?>

                <?php echo $form["repFile_$usageId"] ?>

                <?php if ($resource->canThumbnail()): ?>
                  <?php echo __('<em>or</em> Auto-generate a new representation from master image') ?>
                  <?php echo $form["generateDerivative_$usageId"] ?>
                <?php endif; ?>

              </td>
            </tr>
          </tbody>
        </table>
      <?php endif; ?>
    <?php endforeach; ?>

  </fieldset>

  <div class="actions section">

    <h2 class="element-invisible"><?php echo __('Actions') ?></h2>

    <div class="content">
      <ul class="clearfix links">

        <?php if (isset($sf_request->getAttribute('sf_route')->resource)): ?>
          <li><?php echo link_to(__('Delete'), array($resource, 'module' => 'digitalobject', 'action' => 'delete')) ?></li>
        <?php endif; ?>

        <li><?php echo link_to(__('Cancel'), array($informationObject, 'module' => 'informationobject')) ?></li>
        <li><input class="form-submit" type="submit" value="<?php echo __('Save') ?>"/></li>

      </ul>
    </div>

  </div>

</form>
