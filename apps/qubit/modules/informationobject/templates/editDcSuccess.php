<?php use_helper('DateForm') ?>
<?php use_helper('Javascript') ?>

<div class="pageTitle"><?php echo __('edit resource metadata - Dublin Core') ?></div>

<?php if (isset($sf_request->id)): ?>
  <?php echo $form->renderFormTag(url_for(array('module' => 'informationobject', 'action' => 'edit', 'id' => $sf_request->id)), array('id' => 'editForm')) ?>
<?php else: ?>
  <?php echo $form->renderFormTag(url_for(array('module' => 'informationobject', 'action' => 'create')), array('id' => 'editForm')) ?>
<?php endif; ?>

  <?php echo $form->renderHiddenFields() ?>

  <div class="formHeader">
    <?php echo render_title(QubitDc::getLabel($informationObject)) ?>
  </div>

    <?php echo $form->identifier->renderRow() ?>

    <?php echo render_field($form->title, $informationObject) ?>

    <label for="actors"><?php echo __('creator').', '.__('publisher').', '.__('contributor').'   '.__('and/or dates') ?></label>
    <table id="relatedEvents" class="inline" style="margin-top: 1px;">
      <tr>
        <th style="width: 35%;"><?php echo __('Name') ?></th>
        <th style="width: 25%;"><?php echo __('Role').'/'.__('Event') ?></th>
        <th style="width: 30%;"><?php echo __('Date(s)') ?></th>
        <th style="width: 10%">&nbsp;</th>
      </tr>
      <?php if(count($actorEvents)): ?>
      <?php foreach ($actorEvents as $actorEvent): ?>
      <tr id="<?php echo 'event_'.$actorEvent->getId() ?>" class="<?php echo 'related_obj_'.$actorEvent->getId() ?>">
        <td><div class="animateNicely">
        <?php if ($actorEvent->getActor()): ?>
          <?php echo render_title($actorEvent->getActor()); ?>
        <?php endif; ?>
        </div></td>
        <td><div class="animateNicely">
        <?php if ($actorEvent->getActor()): ?>
          <?php echo $actorEvent->getType()->getRole() ?>
        <?php else: ?>
          <?php echo $actorEvent->getType() ?>
        <?php endif; ?>
        </div></td>
        <td><div class="animateNicely">
          <?php echo date_display($actorEvent) ?>
        </div></td>
        <td style="text-align: right"><div class="animateNicely">
          <input type="checkbox" name="deleteEvents[<?php echo $actorEvent->getId() ?>]" value="delete" class="multiDelete" />
        </div></td>
      </tr>
      <?php endforeach; ?>
      <?php endif; ?>
    </table>

    <div class="form-item">
      <!-- add new creation event yui dialog object -->
      <?php echo include_component('informationobject', 'eventForm') ?>
    </div>

    <?php echo $form->types->renderRow() ?>

    <div class="form-item">
      <label for=""><?php echo __('add new child levels') ?></label>
      <table class="inline multiRow">
        <thead>
          <tr>
            <th style="width: 20%"><?php echo __('identifier') ?></th>
            <th style="width: 80%"><?php echo __('title') ?></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><?php echo input_tag('updateChildLevels[0][identifier]') ?></td>
            <td><?php echo input_tag('updateChildLevels[0][title]') ?></td>
          </tr>
        </tbody>
      </table>
    </div>

    <?php echo render_field($form->extentAndMedium->label(__('Format')), $informationObject, array('class' => 'resizable')) ?>

    <?php echo render_field($form->scopeAndContent->label(__('Description')), $informationObject, array('class' => 'resizable')) ?>

    <?php echo render_field($form->relation, $relation, array('name' => 'value')) ?>

    <?php echo $form->language->renderRow(array('class' => 'form-autocomplete')) ?>

    <div class="form-item">
      <?php echo $form->subjectAccessPoints->label(__('Subject'))->renderLabel() ?>
      <?php echo $form->subjectAccessPoints->render(array('class' => 'form-autocomplete')) ?>
      <input class="add" type="hidden" value="<?php echo url_for(array('module' => 'term', 'action' => 'create', 'taxonomyId' => QubitTaxonomy::SUBJECT_ID)) ?> #name"/>
      <input class="list" type="hidden" value="<?php echo url_for(array('module' => 'term', 'action' => 'autocomplete', 'taxonomyId' => QubitTaxonomy::SUBJECT_ID)) ?>"/>
    </div>
    
    <div class="form-item">
      <?php echo $form->placeAccessPoints->label(__('Coverage - spatial'))->renderLabel() ?>
      <?php echo $form->placeAccessPoints->render(array('class' => 'form-autocomplete')) ?>
      <input class="add" type="hidden" value="<?php echo url_for(array('module' => 'term', 'action' => 'create', 'taxonomyId' => QubitTaxonomy::PLACE_ID)) ?> #name"/>
      <input class="list" type="hidden" value="<?php echo url_for(array('module' => 'term', 'action' => 'autocomplete', 'taxonomyId' => QubitTaxonomy::PLACE_ID)) ?>"/>
    </div>

    <?php echo render_field($form->locationOfOriginals->label(__('Source')), $informationObject, array('class' => 'resizable')) ?>

    <?php echo render_field($form->accessConditions->label(__('Rights')), $informationObject, array('class' => 'resizable')) ?>

    <div class="form-item">
      <?php echo $form->repository->renderLabel() ?>
      <?php echo $form->repository->render(array('class' => 'form-autocomplete')) ?>
      <input class="add" type="hidden" value="<?php echo url_for(array('module' => 'repository', 'action' => 'create')) ?> #authorized_form_of_name"/>
      <input class="list" type="hidden" value="<?php echo url_for($repoAcParams) ?>"/>
    </div>

  <div class="admin-info">
    <table><tr><td><?php echo $form->publicationStatus->label(__('Publication Status'))->renderRow() ?></td>
    <td><div class="form-item"><label for="source language"><?php echo __('source language') ?></label>
    <?php if ($sourceLanguage = $informationObject->getSourceCulture()): ?>
      <?php if ($sourceLanguage == $sf_user->getCulture()): ?>
        <?php echo format_language($sourceLanguage) ?>
      <?php else: ?>
        <div class="default-translation">
        <?php echo link_to(format_language($sourceLanguage), $sf_data->getRaw('sf_context')->getRouting()->getCurrentInternalUri(), array('query_string' => 'sf_culture='.$sourceLanguage)) ?>
        </div>
      <?php endif; ?>
    <?php else: ?>
      <?php echo format_language($sf_user->getCulture()) ?>
    <?php endif;?>
    </div></td></tr></table>
  </div>

  <?php if ($sf_context->getActionName() == 'create'): ?>
  <!--set initial form focus -->
  <?php echo javascript_tag(<<<EOF
  $('[name=title]').focus();
EOF
  ) ?>
  <?php endif; ?>

  <?php echo get_partial('editActions', array('informationObject' => $informationObject)) ?>

</form>
