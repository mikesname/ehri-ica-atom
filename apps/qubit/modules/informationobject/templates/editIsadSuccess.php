<?php use_helper('Date') ?>
<?php use_helper('Javascript') ?>

<div class="pageTitle"><?php echo __('edit archival description - ISAD(G)') ?></div>
<?php if (isset($sf_request->id)): ?>
  <?php echo $form->renderFormTag(url_for(array('module' => 'informationobject', 'action' => 'edit', 'id' => $sf_request->id)), array('id' => 'editForm')) ?>
<?php else: ?>
  <?php echo $form->renderFormTag(url_for(array('module' => 'informationobject', 'action' => 'create')), array('id' => 'editForm')) ?>
<?php endif; ?>

  <?php echo $form->renderHiddenFields() ?>

  <?php echo input_hidden_tag('collection_type_id', QubitTerm::ARCHIVAL_MATERIAL_ID) ?>

    <div class="formHeader">
      <?php echo render_title(QubitIsad::getLabel($informationObject)) ?>
    </div>

  <fieldset class="collapsible collapsed" id="identityArea">

  <legend><?php echo __('identity area') ?></legend>

    <?php if ($informationObject->getIdentifier()): ?>
      <div class="form-item">
        <label for="reference code"><?php echo __('reference code') ?></label>
        <?php echo QubitIsad::getReferenceCode($informationObject) ?>
      </div>
    <?php endif; ?>

    <?php echo $form->identifier->renderRow() ?>

    <?php echo render_field($form->title->help(__('Provide either a formal title or a concise supplied title in accordance with the rules of multilevel description and national conventions.')), $informationObject) ?>

    <div class="form-item">
      <label for="dates"><?php echo __('date(s)') ?></label>
      <table class="inline">
      <thead>
        <tr>
          <th style="width: 25%"><?php echo __('type') ?></th>
          <th style="width: 20%"><?php echo __('date') ?></th>
          <th style="width: 20%"><?php echo __('end date') ?></th>
          <th style="width: 30%"><?php echo __('date display') ?></th>
          <th style="width: 5%"><?php echo image_tag('delete', array('align' => 'top', 'class' => 'deleteIcon')) ?></th>
        </tr>
      </thead>
      <tbody>
        <?php if (0 < count($eventDates)): ?>
        <?php foreach ($eventDates as $i => $eventDate): ?>
        <tr class="<?php echo 'related_obj_'.$eventDate->getId() ?>">
          <td><div class="animateNicely">
            <input type="hidden" name="updateEvents[<?php echo $i ?>][id]" value="<?php echo $eventDate->getId() ?>" />
            <?php echo object_select_tag($eventDate, 'getTypeId', array(
              'name' => 'updateEvents['.$i.'][typeId]',
              'related_class' => 'QubitTerm',
              'peer_method' => 'getIsadEventTypes')) ?>
          </div></td>
          <td><div class="animateNicely">
            <?php echo input_tag('updateEvents['.$i.'][startDate]', collapse_date($eventDate->getStartDate())) ?>
          </div></td>
          <td><div class="animateNicely">
            <?php echo input_tag('updateEvents['.$i.'][endDate]', collapse_date($eventDate->getEndDate())) ?>
          </div></td>
          <td><div class="animateNicely">
            <?php echo input_tag('updateEvents['.$i.'][dateDisplay]', $eventDate->getDateDisplay(array('cultureFallback' => true)),
              array('width: 15em')) ?>
          </div></td>
          <td style="text-align: right;"><div class="animateNicely">
            <input type="checkbox" name="deleteEvents[<?php echo $eventDate->getId() ?>]" value="delete" class="multiDelete" />
          </div></td>
        </tr>
        <?php endforeach; ?>
        <?php endif; ?>
        <tr>
          <td><div class="animateNicely">
            <?php echo select_tag('updateEvents[new][typeId]', options_for_select($isadEventTypes, QubitTerm::CREATION_ID)) ?>
          </div></td>
          <td><?php echo input_tag('updateEvents[new][startDate]') ?></td>
          <td><?php echo input_tag('updateEvents[new][endDate]') ?></td>
          <td><?php echo input_tag('updateEvents[new][dateDisplay]') ?></td>
          <td>&nbsp;</td>
        </tr>
      </tbody>
      </table>
    </div>

    <?php echo $form->levelOfDescription->help(__('Record the level of this unit of description.'))->renderRow() ?>

    <div class="form-item">
      <label for=""><?php echo __('add new child levels') ?></label>
      <table class="inline multiRow">
        <thead>
          <tr>
            <th style="width: 20%"><?php echo __('identifier') ?></th>
            <th style="width: 20%"><?php echo __('level') ?></th>
            <th style="width: 60%"><?php echo __('title') ?></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><?php echo input_tag('updateChildLevels[0][identifier]') ?></td>
            <td>
              <?php echo object_select_tag(new QubitInformationObject, 'getLevelOfDescriptionId', array(
                'include_blank' => true,
                'name' => 'updateChildLevels[0][levelOfDescription]',
                'related_class' => 'QubitTerm',
                'peer_method' => 'getLevelsOfDescription')) ?>
            </td>
            <td><?php echo input_tag('updateChildLevels[0][title]') ?></td>
          </tr>
        </tbody>
      </table>
    </div>

    <?php echo render_field($form->extentAndMedium->help(__('Record the extent of the unit of description by giving the number of physical or logical units in arabic numerals and the unit of measurement. Give the specific medium (media) of the unit of description.')), $informationObject, array('class' => 'resizable')) ?>

  </fieldset>

  <fieldset class="collapsible collapsed" id="contextArea">
    <legend><?php echo __('context area') ?></legend>

    <div class="form-item">
      <?php echo $form->creators->label(__('Name of creator(s)'))->renderLabel() ?>
      <?php echo $form->creators->render(array('class' => 'form-autocomplete')) ?>
      <?php echo $form->creators->help(__('Record the name of the organization(s) or the individual(s) responsible for the creation, accumulation and maintenance of the records in the unit of description. The name should given in the standardized form as prescribed by international or national conventions in accordance with the principles of ISAAR(CPF).'))->renderHelp() ?>
      <input class="add" type="hidden" value="<?php echo url_for(array('module' => 'actor', 'action' => 'create')) ?> #authorized_form_of_name"/>
      <input class="list" type="hidden" value="<?php echo url_for(array('module' => 'actor', 'action' => 'autocomplete')) ?>"/>
    </div>

    <div class="form-item">
      <?php echo $form->repository->renderLabel() ?>
      <?php echo $form->repository->render(array('class' => 'form-autocomplete')) ?>
      <input class="add" type="hidden" value="<?php echo url_for(array('module' => 'repository', 'action' => 'create')) ?> #authorized_form_of_name"/>
      <input class="list" type="hidden" value="<?php echo url_for($repoAcParams) ?>"/>
    </div>

    <?php echo render_field($form->archivalHistory->help(__('Record the successive transfers of ownership, responsibility and/or custody of the unit of description and indicate those actions, such as history of the arrangement, production of contemporary finding aids, re-use of the records for other purposes or software migrations, that have contributed to its present structure and arrangement. Give the dates of these actions, insofar as they can be ascertained. If the archival history is unknown, record that information.')), $informationObject, array('class' => 'resizable')) ?>

    <?php echo render_field($form->acquisition->help(__('Record the source from which the unit of description was acquired and the date and/or method of acquisition if any or all of this information is not confidential. If the source is unknown, record that information. Optionally, add accession numbers or codes.'))->label(__('Immediate source of acqusition or transfer')), $informationObject, array('class' => 'resizable')) ?>

  </fieldset>

  <fieldset class="collapsible collapsed" id="contentAndStructureArea">
    <legend><?php echo __('content and structure area') ?></legend>

    <?php echo render_field($form->scopeAndContent->help(__('Give a summary of the scope (such as, time periods, geography) and content, (such as documentary forms, subject matter, administrative processes) of the unit of description, appropriate to the level of description.')), $informationObject, array('class' => 'resizable')) ?>

    <?php echo render_field($form->appraisal->help(__('Record appraisal, destruction and scheduling actions taken on or planned for the unit of description, especially if they may affect the interpretation of the material.'))->label(__('Appraisal, destruction and scheduling')), $informationObject, array('class' => 'resizable')) ?>

    <?php echo render_field($form->accruals->help(__('Indicate if accruals are expected. Where appropriate, give an estimate of their quantity and frequency.')), $informationObject, array('class' => 'resizable')) ?>

    <?php echo render_field($form->arrangement->help(__('Specify the internal structure, order and/or the system of classification of the unit of description. Note how these have been treated by the archivist. For electronic records, record or reference information on system design.'))->label(__('System of arrangement')), $informationObject, array('class' => 'resizable')) ?>

  </fieldset>

  <fieldset class="collapsible collapsed" id="conditionsOfAccessAndUseArea">
    <legend><?php echo __('conditions of access and use area') ?></legend>

    <?php echo render_field($form->accessConditions->help(__('Specify the law or legal status, contract, regulation or policy that affects access to the unit of description. Indicate the extent of the period of closure and the date at which the material will open when appropriate.'))->label(__('Conditions governing access')), $informationObject, array('class' => 'resizable')) ?>

    <?php echo render_field($form->reproductionConditions->help(__('Give information about conditions, such as copyright, governing the reproduction of the unit of description after access has been provided. If the existence of such conditions is unknown, record this. If there are no conditions, no statement is necessary.'))->label(__('Conditions governing reproduction')), $informationObject, array('class' => 'resizable')) ?>

    <?php echo $form->language->renderRow(array('class' => 'form-autocomplete')) ?>

    <?php echo $form->script->renderRow(array('class' => 'form-autocomplete')) ?>

    <?php echo render_field($form->physicalCharacteristics->help(__('Indicate any important physical conditions, such as preservation requirements, that affect the use of the unit of description. Note any software and/or hardware required to access the unit of description.'))->label(__('Physical characteristics and technical requirements')), $informationObject, array('class' => 'resizable')) ?>

    <?php echo render_field($form->findingAids->help(__('Give information about any finding aids that the repository or records creator may have that provide information relating to the context and contents of the unit of description. If appropriate, include information on where to obtain a copy.')), $informationObject, array('class' => 'resizable')) ?>

 </fieldset>

 <fieldset class="collapsible collapsed" id="alliedMaterialsArea">
    <legend><?php echo __('allied materials area') ?></legend>

    <?php echo render_field($form->locationOfOriginals->help(__('If the original of the unit of description is available (either in the institution or elsewhere) record its location, together with any significant control numbers. If the originals no longer exist, or their location is unknown, give that information.'))->label(__('Existence and location of originals')), $informationObject, array('class' => 'resizable')) ?>

    <?php echo render_field($form->locationOfCopies->help(__('If the copy of the unit of description is available (either in the institution or elsewhere) record its location, together with any significant control numbers.'))->label(__('Existence and location of copies')), $informationObject, array('class' => 'resizable')) ?>

    <?php echo render_field($form->relatedUnitsOfDescription->help(__('Record information about units of description in the same repository or elsewhere that are related by provenance or other association(s). Use appropriate introductory wording and explain the nature of the relationship . If the related unit of description is a finding aid, use the finding aids element of description (3.4.5) to make the reference to it.'))->label(__('Related units of description')), $informationObject, array('class' => 'resizable')) ?>

    <div class="form-item">
      <table class="inline">
        <tr>
          <th style="width: 90%;"><?php echo __('Publication notes') ?></th>
          <th style="width: 10%; text-align: right;"><?php echo image_tag('delete', array('align' => 'top', 'class' => 'deleteIcon')) ?></th>
        </tr>
        <?php if ($publicationNotes): ?>
        <?php foreach ($publicationNotes as $publicationNote): ?>
        <tr class="<?php echo 'related_obj_'.$publicationNote->getId() ?>">
          <td><div class="animateNicely">
            <?php echo nl2br($publicationNote->getContent(array('cultureFallback' => 'true'))) ?>
          </div></td>
          <td style="text-align: right;"><div class="animateNicely">
            <input type="checkbox" name="delete_notes[<?php echo $publicationNote->getId() ?>]" value="delete" class="multiDelete" />
          </div></td>
        </tr>
        <?php endforeach; ?>
        <?php endif; ?>
        <tr>
          <td><?php echo textarea_tag('new_publication_note', '', array('class' => 'multiInstanceTr', 'size' => '30x2')) ?></td>
          <td style="text-align: right;">&nbsp;</td>
        </tr>
      </table>
    </div>
  </fieldset>

  <fieldset class="collapsible collapsed" id="notesArea">
    <legend><?php echo __('notes area') ?></legend>
    <div class="form-item">
      <table class="inline">
        <tr>
          <th style="width: 90%;"><?php echo __('Notes') ?></th>
          <th style="width: 10%; text-align: right"><?php echo image_tag('delete', array('align' => 'top', 'class' => 'deleteIcon')) ?></th>
        </tr>
        <?php if ($notes): ?>
        <?php foreach ($notes as $note): ?>
        <tr class="<?php echo 'related_obj_'.$note->getId() ?>">
          <td><div class="animateNicely">
            <?php echo $note->getContent(array('cultureFallback' => 'true')) ?>
          </div></td>
          <td style="text-align: right;"><div class="animateNicely">
            <input type="checkbox" name="delete_notes[<?php echo $note->getId() ?>]" value="delete" class="multiDelete" />
          </div></td>
        </tr>
        <?php endforeach; ?>
        <?php endif; ?>
        <tr>
          <td><?php echo textarea_tag('new_note', '', array('class' => 'multiInstanceTr resizable', 'size' => '30x2')) ?></td>
          <td style="text-align: right">&nbsp;</td>
        </tr>
      </table>
    </div>
  </fieldset>

  <fieldset class="collapsible collapsed">
    <legend><?php echo __('access points') ?></legend>

    <div class="form-item">
      <?php echo $form->subjectAccessPoints->label(__('subject access points'))->renderLabel() ?>
      <?php echo $form->subjectAccessPoints->render(array('class' => 'form-autocomplete')) ?>
      <input class="add" type="hidden" value="<?php echo url_for(array('module' => 'term', 'action' => 'create', 'taxonomyId' => QubitTaxonomy::SUBJECT_ID)) ?> #name"/>
      <input class="list" type="hidden" value="<?php echo url_for(array('module' => 'term', 'action' => 'autocomplete', 'taxonomyId' => QubitTaxonomy::SUBJECT_ID)) ?>"/>
    </div>

    <div class="form-item">
      <?php echo $form->placeAccessPoints->label(__('place access points'))->renderLabel() ?>
      <?php echo $form->placeAccessPoints->render(array('class' => 'form-autocomplete')) ?>
      <input class="add" type="hidden" value="<?php echo url_for(array('module' => 'term', 'action' => 'create', 'taxonomyId' => QubitTaxonomy::PLACE_ID)) ?> #name"/>
      <input class="list" type="hidden" value="<?php echo url_for(array('module' => 'term', 'action' => 'autocomplete', 'taxonomyId' => QubitTaxonomy::PLACE_ID)) ?>"/>
    </div>

    <div class="form-item">
      <?php echo $form->nameAccessPoints->label(__('name access points'))->renderLabel() ?>
      <?php echo $form->nameAccessPoints->render(array('class' => 'form-autocomplete')) ?>
      <input class="add" type="hidden" value="<?php echo url_for(array('module' => 'actor', 'action' => 'create')) ?> #authorized_form_of_name"/>
      <input class="list" type="hidden" value="<?php echo url_for(array('module' => 'actor', 'action' => 'autocomplete')) ?>"/>
    </div>
  </fieldset>

  <fieldset class="collapsible collapsed" id="descriptionControlArea">
    <legend><?php echo __('description control area') ?></legend>

    <div class="form-item">
      <table class="inline">
        <tr>
          <th style="width: 90%;"><?php echo __('Archivist\'s Notes') ?></th>
          <th style="width: 10%; text-align: right"><?php echo image_tag('delete', array('align' => 'top', 'class' => 'deleteIcon')) ?></th>
        </tr>
        <?php if ($archivistsNotes): ?>
        <?php foreach ($archivistsNotes as $archivistsNote): ?>
        <tr class="<?php echo 'related_obj_'.$archivistsNote->getId() ?>">
          <td><div class="animateNicely">
            <?php echo $archivistsNote->getContent(array('cultureFallback' => 'true')) ?>
          </div></td>
          <td style="text-align: right;"><div class="animateNicely">
            <input type="checkbox" name="delete_notes[<?php echo $archivistsNote->getId() ?>]" value="delete" class="multiDelete" />
          </div></td>
        </tr>
        <?php endforeach; ?>
        <?php endif; ?>
        <tr>
          <td><?php echo textarea_tag('new_archivist_note', '', array('class' => 'multiInstanceTr', 'size' => '30x2')) ?></td>
          <td style="text-align: right">&nbsp;</td>
        </tr>
      </table>
    </div>

    <?php echo $form->descriptionIdentifier->label(__('Description record identifier'))->renderRow() ?>

    <?php echo render_field($form->institutionResponsibleIdentifier->label(__('Institution identifiers')), $informationObject) ?>

    <?php echo render_field($form->rules->help(__('Record the international, national and/or local rules or conventions followed in preparing the description.'))->label(__('Rules or conventions')), $informationObject, array('class' => 'resizable')) ?>

    <?php echo $form->descriptionStatus->label(__('Status'))->renderRow() ?>

    <?php echo $form->descriptionDetail->label(__('Level of detail'))->renderRow() ?>

    <?php echo render_field($form->revisionHistory->label(__('Dates of creation, revision and deletion')), $informationObject, array('class' => 'resizable')) ?>

    <?php echo $form->languageOfDescription->renderRow(array('class' => 'form-autocomplete')) ?>

    <?php echo $form->scriptOfDescription->renderRow(array('class' => 'form-autocomplete')) ?>

    <?php echo render_field($form->sources, $informationObject, array('class' => 'resizable')) ?>

  </fieldset>

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
