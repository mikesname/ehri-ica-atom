<?php use_helper('Date') ?>

<h1><?php echo __('Edit resource metadata - MODS') ?></h1>

<h1 class="label"><?php echo render_title(QubitMods::getLabel($object)) ?></h1>

<?php if (isset($sf_request->source)): ?>
  <div class="messages status">
    <?php echo __('This is a duplicate of record %1%', array('%1%' => $sourceInformationObjectLabel)) ?>
  </div>
<?php endif; ?>

<?php if (isset($sf_request->id)): ?>
  <?php echo $form->renderFormTag(url_for(array($object, 'module' => 'informationobject', 'action' => 'edit')), array('id' => 'editForm')) ?>
<?php else: ?>
  <?php echo $form->renderFormTag(url_for(array('module' => 'informationobject', 'action' => 'create')), array('id' => 'editForm')) ?>
<?php endif; ?>

  <?php echo $form->renderHiddenFields() ?>

  <?php echo input_hidden_tag('collection_type_id', QubitTerm::PUBLISHED_MATERIAL_ID) ?>

  <?php echo $form->identifier->renderRow() ?>

  <?php echo render_field($form->title, $object) ?>

  <?php if (0 < count($object->events)): ?>
    <div class="form-item">
      <label for="events"><?php echo __('Names and origin info') ?></label>
      <?php echo get_partial('informationobject/relatedEvents', array('informationObject' => $object)) ?>
    </div>
  <?php endif; ?>

  <div class="form-item">
    <label for=""><?php echo __('Add new name and/or origin info') ?></label>
    <?php echo get_component('informationobject', 'eventForm') ?>
  </div>

  <?php echo $form->types
    ->label(__('Type of resource'))
    ->renderRow() ?>

  <div class="form-item">
    <label for=""><?php echo __('Add new child levels (if describing a collection)') ?></label>
    <table class="inline multiRow">
      <thead>
        <tr>
          <th style="width: 20%">
            <?php echo __('Identifier') ?>
          </th><th style="width: 80%">
            <?php echo __('Title') ?>
          </th>
        </tr>
      </thead><tbody>
        <tr>
          <td>
            <?php echo input_tag('updateChildLevels[0][identifier]') ?>
          </td><td>
            <?php echo input_tag('updateChildLevels[0][title]') ?>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <?php echo $form->language->renderRow(array('class' => 'form-autocomplete')) ?>

  <div class="form-item">
    <?php echo $form->subjectAccessPoints
      ->label(__('Subject'))
      ->renderLabel() ?>
    <?php echo $form->subjectAccessPoints->render(array('class' => 'form-autocomplete')) ?>
    <?php if (QubitAcl::check(QubitTaxonomy::getById(QubitTaxonomy::SUBJECT_ID), 'createTerm')): ?>
      <input class="add" type="hidden" value="<?php echo url_for(array('module' => 'term', 'action' => 'create', 'taxonomyId' => QubitTaxonomy::SUBJECT_ID)) ?> #name"/>
    <?php endif; ?>
    <input class="list" type="hidden" value="<?php echo url_for(array('module' => 'term', 'action' => 'autocomplete', 'taxonomyId' => QubitTaxonomy::SUBJECT_ID)) ?>"/>
  </div>

  <?php echo render_field($form->accessConditions, $object, array('class' => 'resizable')) ?>

  <div class="form-item">
    <?php echo $form->repository->renderLabel() ?>
    <?php echo $form->repository->render(array('class' => 'form-autocomplete')) ?>
    <input class="add" type="hidden" value="<?php echo url_for(array('module' => 'repository', 'action' => 'create')) ?> #authorizedFormOfName"/>
    <input class="list" type="hidden" value="<?php echo url_for($repoAcParams) ?>"/>
  </div>

  <?php echo get_partial('informationobject/adminInfo', array('form' => $form, 'informationObject' => $object)) ?>

  <?php echo get_partial('informationobject/editActions', array('informationObject' => $object)) ?>

</form>
