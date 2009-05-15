<?php use_helper('DateForm') ?>
<?php use_helper('Javascript') ?>

<div class="pageTitle"><?php echo __('edit archival description - ISAD(G)'); ?></div>
<?php if (isset($sf_request->id)): ?>
  <form method="post" action="<?php echo url_for(array('module' => 'informationobject', 'action' => 'edit', 'id' => $sf_request->id)) ?>" enctype="multipart/form-data" id="editForm">
<?php else: ?>
  <form method="post" action="<?php echo url_for(array('module' => 'informationobject', 'action' => 'create')) ?>" enctype="multipart/form-data" id="editForm">
<?php endif; ?>
  <?php echo input_hidden_tag('collection_type_id', QubitTerm::ARCHIVAL_MATERIAL_ID) ?>

  <?php if ($label = QubitIsad::getLabel($informationObject, array())): ?>
    <div class="formHeader">
      <?php echo link_to($label, 'informationobject/showIsad/?id='.$informationObject->getId()) ?>
    </div>
  <?php else: ?>
    <div class="formHeader" style="height: 20px;"></div>
  <?php endif; ?>

  <?php if ($sf_context->getActionName() == 'createIsad'): ?>
  <fieldset class="collapsible">
  <?php else : ?>
  <fieldset class="collapsible collapsed">
  <?php endif; ?>

  <legend><?php echo __('identity area'); ?></legend>

    <?php if ($informationObject->getIdentifier()): ?>
      <div class="form-item">
        <label for="reference code"><?php echo __('reference code'); ?></label>
        <?php echo QubitIsad::getReferenceCode($informationObject) ?>
      </div>
    <?php endif; ?>

    <div class="form-item">
      <label for="identifier"><?php echo __('identifier'); ?></label>
      <?php echo object_input_tag($informationObject, 'getIdentifier', array('size' => 20)) ?>
    </div>

    <div class="form-item">
      <label for="title"><?php echo __('title'); ?></label>
      <?php if (strlen($sourceCultureValue = $informationObject->getTitle(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $informationObject->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_input_tag($informationObject, 'getTitle', array('size' => 20)) ?>
    </div>

    <div class="form-item">
      <label for="dates"><?php echo __('date(s)'); ?></label>
      <table class="inline">
      <thead>
        <tr>
          <th style="width: 27%"><?php echo __('type'); ?></th>
          <th style="width: 15%"><?php echo __('start year'); ?></th>
          <th style="width: 13%"><?php echo __('end year'); ?></th>
          <th style="width: 40%"><?php echo __('date display'); ?></th>
          <th style="width: 5%"><?php echo image_tag('delete', array('align' => 'top', 'class' => 'deleteIcon')) ?></th>
        </tr>
      </thead>
      <tbody>
        <?php if (0 < count($eventDates)): ?>
        <?php foreach ($eventDates as $i => $eventDate): ?>
        <tr class="<?php echo 'related_obj_'.$eventDate->getId() ?>">
          <td><div class="animateNicely">
            <input type="hidden" name="editActorEvents[<?php echo $i ?>][id]" value="<?php echo $eventDate->getId() ?>" />
            <?php echo object_select_tag($eventDate, 'getTypeId', array(
              'name' => 'editActorEvents['.$i.'][eventTypeId]',
              'related_class' => 'QubitTerm',
              'peer_method' => 'getEventTypes')) ?>
          </div></td>
          <td><div class="animateNicely">
            <?php echo input_tag('editActorEvents['.$i.'][year]', format_date('Y', $eventDate->getStartDate()),
              array('maxlength' => 4, 'style' => 'width: 4em')) ?>
          </div></td>
          <td><div class="animateNicely">
            <?php echo input_tag('editActorEvents['.$i.'][endYear]', format_date('Y', $eventDate->getEndDate()),
              array('maxlength' => 4, 'style' => 'width: 4em')) ?>
          </div></td>
          <td><div class="animateNicely">
            <?php echo input_tag('editActorEvents['.$i.'][dateDisplay]', $eventDate->getDateDisplay(array('cultureFallback' => true)),
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
            <?php echo select_tag('editActorEvents[new][eventTypeId]',
              objects_for_select(QubitTerm::getEventTypes(), 'getId', '__toString', null, array('include_blank' => true))) ?>
          </div></td>
          <td><?php echo input_tag('editActorEvents[new][year]', '', array('maxlength' => 4, 'style' => 'width: 4em')) ?></td>
          <td><?php echo input_tag('editActorEvents[new][endYear]', '', array('maxlength' => 4, 'style' => 'width: 4em')) ?></td>
          <td><?php echo input_tag('editActorEvents[new][dateDisplay]', '', array('width: 15em')) ?></td>
          <td>&nbsp;</td>
        </tr>
      </tbody>
      </table>
    </div>

    <table style="border: 0; width: 98%; margin: 0; padding: 0;"><tr><td style="width: 150px;">
    <div class="form-item">
      <label for="level_of_description_id"><?php echo __('level of description'); ?></label>
      <?php echo object_select_tag($informationObject, 'getLevelOfDescriptionId', array('related_class' => 'QubitTerm', 'include_blank' => true, 'peer_method' => 'getLevelsOfDescription')) ?>
    </div>

    </td><td style="padding-left: 10px;">

    <div class="form-item">
      <label for="parent_id"><?php echo __('parent level'); ?></label>
      <?php echo object_select_tree($informationObject, 'getParentId', array('disabled' => $informationObject->getDescendants()->andSelf()->indexBy('id'), 'include_blank' => true, 'peer_method' => 'getDescendants', 'related_class' => QubitInformationObject::getOne(QubitInformationObject::addRootsCriteria(new Criteria)))) ?>
    </div>

  </td></tr></table>

    <div class="form-item">
      <label for="extent_and_medium"><?php echo __('extent and medium'); ?></label>
      <?php if (strlen($sourceCultureValue = $informationObject->getExtentAndMedium(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $informationObject->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_textarea_tag($informationObject, 'getExtentAndMedium', array('class' => 'resizable', 'size' => '30x3')) ?>
    </div>
  </fieldset>

  <fieldset class="collapsible collapsed">
    <legend><?php echo __('context area'); ?></legend>

    <label for="creators"><?php echo __('Name of creator(s)'); ?></label>
    <?php if(count($creatorEvents)): ?>
    <ul class="linked-object">
    <?php foreach ($creatorEvents as $creatorEvent): ?>
      <?php if(null !== $creator = $creatorEvent->getActor()): ?>
      <li class="<?php echo 'related_obj_'.$creatorEvent->getId() ?>"><div>
        <div style="float: left"><?php echo ($creator->getAuthorizedFormOfName(array('cultureFallback' => true))) ?></div>
        <div style="float: right"><input type="checkbox" name="deleteEvents[<?php echo $creatorEvent->getId() ?>]" value="delete" class="multiDelete" /></div>
        <br style="clear: both;">
      </div></li>
      <?php endif; ?>
    <?php endforeach; ?>
    </ul>
    <?php endif; ?>
    <table class="inline" id="add_creator">
      <thead>
        <tr>
          <th style="width: 50%"><?php echo __('Select a creator name') ?></th>
          <th style="width: 50%"><?php echo __('or, type a new name'); ?></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo select_tag('addCreator[0][actorId]', QubitActor::getOptionsForSelectList(QubitTerm::CREATION_ID,
              array('include_blank' => true, 'cultureFallback' => true))) ?></td>
          <td><?php echo input_tag('addCreator[0][newName]', '', array('style' => 'width: 18em')) ?></td>
        </tr>
      </tbody>
    </table>

    <div class="form-item">
      <label for="repository_id"><?php echo __('repository'); ?></label>
      <?php echo select_tag('repository_id', QubitRepository::getOptionsForSelectList($informationObject->getRepositoryId(),
        array('include_blank' => true, 'cultureFallback' => true))) ?>
    </div>

    <div class="form-item">
      <label for="archival_history"><?php echo __('archival history'); ?></label>
      <?php if (strlen($sourceCultureValue = $informationObject->getArchivalHistory(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $informationObject->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
       <?php echo object_textarea_tag($informationObject, 'getArchivalHistory', array('class' => 'resizable', 'size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="acquisition"><?php echo __('immediate source of acquisition or transfer'); ?></label>
      <?php if (strlen($sourceCultureValue = $informationObject->getAcquisition(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $informationObject->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_textarea_tag($informationObject, 'getAcquisition', array('class' => 'resizable', 'size' => '30x3')) ?>
    </div>
  </fieldset>

  <fieldset class="collapsible collapsed">
    <legend><?php echo __('content and structure area'); ?></legend>

    <div class="form-item">
      <label for="scope_and_content"><?php echo __('scope and content'); ?></label>
      <?php if (strlen($sourceCultureValue = $informationObject->getScopeAndContent(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $informationObject->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_textarea_tag($informationObject, 'getScopeAndContent', array('class' => 'resizable', 'size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="appraisal"><?php echo __('appraisal, destruction and scheduling'); ?></label>
      <?php if (strlen($sourceCultureValue = $informationObject->getAppraisal(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $informationObject->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_textarea_tag($informationObject, 'getAppraisal', array('class' => 'resizable', 'size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="accruals"><?php echo __('accruals'); ?></label>
      <?php if (strlen($sourceCultureValue = $informationObject->getAccruals(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $informationObject->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_textarea_tag($informationObject, 'getAccruals', array('class' => 'resizable', 'size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="arrangement"><?php echo __('system of arrangement'); ?></label>
      <?php if (strlen($sourceCultureValue = $informationObject->getArrangement(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $informationObject->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_textarea_tag($informationObject, 'getArrangement', array('class' => 'resizable', 'size' => '30x3')) ?>
    </div>
  </fieldset>

  <fieldset class="collapsible collapsed">
    <legend><?php echo __('conditions of access and use area'); ?></legend>

    <div class="form-item">
      <label for="access_conditions"><?php echo __('conditions governing access'); ?></label>
      <?php if (strlen($sourceCultureValue = $informationObject->getAccessConditions(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $informationObject->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_textarea_tag($informationObject, 'getAccessConditions', array('class' => 'resizable', 'size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="reproduction_conditions"><?php echo __('conditions governing reproduction'); ?></label>
      <?php if (strlen($sourceCultureValue = $informationObject->getReproductionConditions(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $informationObject->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_textarea_tag($informationObject, 'getReproductionConditions', array('class' => 'resizable', 'size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <table class="inline">
        <tr>
          <th style="width: 90%;"><?php echo __('language of material'); ?></th>
          <th style="width: 10%; text-align: right;"><?php echo image_tag('delete', array('align' => 'top', 'class' => 'deleteIcon')) ?></th>
        </tr>
      <?php if ($languageCodes): ?>
        <?php foreach ($languageCodes as $languageCode): ?>
        <tr class="<?php echo 'related_obj_'.$languageCode->getId() ?>">
          <td><div class="animateNicely">
            <?php echo format_language($languageCode->getValue(array('sourceCulture'=>true))) ?>
          </div></td>
          <td style="text-align: right"><div class="animateNicely">
            <input type="checkbox" name="delete_properties[<?php echo $languageCode->getId() ?>]" value="delete" class="multiDelete" />
          </div></td>
        </tr>
        <?php endforeach; ?>
      <?php endif; ?>
        <tr>
          <td colspan="2">
            <?php echo select_language_tag('language_code', null, array('include_blank' => true, 'class'=>'multiInstance')) ?>
          </td>
        </tr>
      </table>
    </div>

    <div class="form-item">
      <table class="inline">
        <tr>
          <th style="width: 90%;"><?php echo __('script of material'); ?></th>
          <th style="width: 10%; text-align: right;"><?php echo image_tag('delete', array('align' => 'top', 'class' => 'deleteIcon')) ?></th>
        </tr>
      <?php if ($scriptCodes): ?>
        <?php foreach ($scriptCodes as $scriptCode): ?>
        <tr class="<?php echo 'related_obj_'.$scriptCode->getId() ?>">
          <td><div class="animateNicely">
              <?php echo format_script($scriptCode->getValue(array('sourceCulture'=>true))) ?>
          </div></td>
          <td style="text-align: right"><div class="animateNicely">
            <input type="checkbox" name="delete_properties[<?php echo $scriptCode->getId() ?>]" value="delete" class="multiDelete" />
          </div></td>
        </tr>
        <?php endforeach; ?>
      <?php endif; ?>
        <tr>
          <td colspan="2">
            <?php echo select_script_tag('script_code', null, array('include_blank' => true, 'class'=>'multiInstance')) ?>
          </td>
        </tr>
      </table>
    </div>

    <div class="form-item">
      <label for="physical_characteristics"><?php echo __('physical characteristics and technical requirements'); ?></label>
      <?php if (strlen($sourceCultureValue = $informationObject->getPhysicalCharacteristics(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $informationObject->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_textarea_tag($informationObject, 'getPhysicalCharacteristics', array('class' => 'resizable', 'size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="finding_aids"><?php echo __('finding aids'); ?></label>
      <?php if (strlen($sourceCultureValue = $informationObject->getFindingAids(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $informationObject->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_textarea_tag($informationObject, 'getFindingAids', array('class' => 'resizable', 'size' => '30x3')) ?>
    </div>
 </fieldset>

 <fieldset class="collapsible collapsed">
    <legend><?php echo __('allied materials area'); ?></legend>
    <div class="form-item">
      <label for="location_of_originals"><?php echo __('existence and location of originals'); ?></label>
      <?php if (strlen($sourceCultureValue = $informationObject->getLocationOfOriginals(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $informationObject->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_textarea_tag($informationObject, 'getLocationOfOriginals', array('class' => 'resizable', 'size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="location_of_copies"><?php echo __('existence and location of copies'); ?></label>
      <?php if (strlen($sourceCultureValue = $informationObject->getLocationOfCopies(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $informationObject->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_textarea_tag($informationObject, 'getLocationOfCopies', array('class' => 'resizable', 'size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="related_units_of_description"><?php echo __('related units of description'); ?></label>
      <?php if (strlen($sourceCultureValue = $informationObject->getRelatedUnitsOfDescription(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $informationObject->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_textarea_tag($informationObject, 'getRelatedUnitsOfDescription', array('class' => 'resizable', 'size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <table class="inline">
        <tr>
          <th style="width: 90%;"><?php echo __('Publication notes'); ?></th>
          <th style="width: 10%; text-align: right;"><?php echo image_tag('delete', array('align' => 'top', 'class' => 'deleteIcon')) ?></th>
        </tr>
      <?php if ($publicationNotes): ?>
        <?php foreach ($publicationNotes as $publicationNote): ?>
        <tr class="<?php echo 'related_obj_'.$publicationNote->getId() ?>">
          <td><div class="animateNicely">
            <?php echo nl2br($publicationNote->getContent(array('cultureFallback' => 'true'))) ?>
          </div></td>
          <td style="text-align: right"><div class="animateNicely">
            <input type="checkbox" name="delete_notes[<?php echo $publicationNote->getId() ?>]" value="delete" class="multiDelete" />
          </div></td>
        </tr>
        <?php endforeach; ?>
      <?php endif; ?>
        <tr>
          <td colspan="2">
            <?php echo textarea_tag('new_publication_note', '', array('class' => 'multiInstanceTr resizable', 'size' => '30x2')) ?>
          </td>
        </tr>
      </table>
    </div>
  </fieldset>

  <fieldset class="collapsible collapsed">
    <legend><?php echo __('notes area'); ?></legend>
    <div class="form-item">
      <table class="inline">
        <tr>
          <th style="width: 90%;"><?php echo __('Notes'); ?></th>
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
    <legend><?php echo __('access points'); ?></legend>

    <?php include_partial('addAccessPointTermDialog') ?>

    <div class="form-item" id="subjectAccessPoints">
      <table class="inline">
        <tr>
          <th style="width: 90%;"><?php echo __('subject access points'); ?><?php if($editTaxonomyCredentials): ?><span id="addSubjectAccessPointLink" style="font-weight:normal"></span><?php endif; ?></th>
          <th style="width: 10%; text-align: right;"><?php echo image_tag('delete', array('align' => 'top', 'class' => 'deleteIcon')) ?></th>
        </tr>
      <?php if ($subjectAccessPoints): ?>
        <?php foreach ($subjectAccessPoints as $subject): ?>
        <tr class="<?php echo 'related_obj_'.$subject->getId() ?>">
          <td><div class="animateNicely">
            <?php echo $subject->getTerm() ?>
          </div></td>
          <td style="text-align: right"><div class="animateNicely">
            <input type="checkbox" name="delete_object_term_relations[<?php echo $subject->getId() ?>]" value="delete" class="multiDelete" />
          </div></td>
        </tr>
        <?php endforeach; ?>
      <?php endif; ?>
        <tr>
          <td colspan="2">
            <?php echo object_select_tag($newSubjectAccessPoint, 'getTermId', array(
              'name' => 'subject_id', 'id' => 'subject_id', 'include_blank' => true, 'peer_method' => 'getSubjects', 'class'=>'multiInstance')) ?>
          </td>
        </tr>
      </table>
    </div>

    <div class="form-item" id="placeAccessPoints">
      <table class="inline">
        <tr>
          <th style="width: 90%;"><?php echo __('place access points'); ?><?php if($editTaxonomyCredentials): ?><span id="addPlaceAccessPointLink" style="font-weight:normal"></span><?php endif; ?></th>
          <th style="width: 10%; text-align: right;"><?php echo image_tag('delete', array('align' => 'top', 'class' => 'deleteIcon')) ?></th>
        </tr>
      <?php if ($placeAccessPoints): ?>
        <?php foreach ($placeAccessPoints as $place): ?>
        <tr class="<?php echo 'related_obj_'.$place->getId() ?>">
          <td><div class="animateNicely">
            <?php echo $place->getTerm() ?>
          </div></td>
          <td style="text-align: right"><div class="animateNicely">
            <input type="checkbox" name="delete_object_term_relations[<?php echo $place->getId() ?>]" value="delete" class="multiDelete" />
          </div></td>
        </tr>
        <?php endforeach; ?>
      <?php endif; ?>
        <tr>
          <td colspan="2">
            <?php echo object_select_tag($newPlaceAccessPoint, 'getTermId', array(
              'name' => 'place_id', 'id' => 'place_id', 'include_blank' => true, 'peer_method' => 'getPlaces', 'class'=>'multiInstance')) ?>
          </td>
        </tr>
      </table>
    </div>

    <div class="form-item" id="nameAccessPoints">
      <table class="inline">
        <tr>
          <th style="width: 60%;"><?php echo __('name access points'); ?></th>
          <th style="width: 30%;"><?php echo __('role'); ?></th>
          <th style="width: 10%; text-align: right;"><?php echo image_tag('delete', array('align' => 'top', 'class' => 'deleteIcon')) ?></th>
        </tr>
      <?php if ($nameAccessPoints): ?>
        <?php foreach ($nameAccessPoints as $name): ?>
        <tr class="<?php echo 'related_obj_'.$name->getId() ?>">
          <td><div class="animateNicely"><?php echo render_title($name->getActor()) ?></div></td>
          <td><div class="animateNicely"><?php echo $name->getType()->getRole() ?></div></td>
          <td style="text-align: right"><div class="animateNicely">
            <?php if ($name->getTypeId() == QubitTerm::SUBJECT_ID): ?>
              <input type="checkbox" name="delete_actor_events[<?php echo $name->getId() ?>]" value="delete" class="multiDelete" />
            <?php else: ?>
              &nbsp;
            <?php endif; ?>
          </div></td>
        </tr>
        <?php endforeach; ?>
      <?php endif; ?>
        <tr>
          <td colspan="3">
            <?php echo select_tag('name_id', options_for_select($nameSelectList, null, array('include_blank' => true)), array('class'=>'multiInstance')) ?>
          </td>
        </tr>
      </table>
    </div>
  </fieldset>

  <fieldset class="collapsible collapsed">
    <legend><?php echo __('description control area'); ?></legend>

    <div class="form-item">
      <table class="inline">
        <tr>
          <th style="width: 90%;"><?php echo __('Archivist\'s Notes'); ?></th>
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

    <div class="form-item">
      <label for="description_identifier"><?php echo __('description record identifier'); ?></label>
      <?php echo object_input_tag($informationObject, 'getDescriptionIdentifier', array('size' => 20)) ?>
    </div>

    <div class="form-item">
      <label for="institution_identifier"><?php echo __('institution identifier'); ?></label>
      <?php if (strlen($sourceCultureValue = $informationObject->getInstitutionResponsibleIdentifier(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $informationObject->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_input_tag($informationObject, 'getInstitutionResponsibleIdentifier', array('size' => 20)) ?>
    </div>

    <div class="form-item">
      <label for="rules"><?php echo __('rules or conventions'); ?></label>
      <?php if (strlen($sourceCultureValue = $informationObject->getRules(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $informationObject->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_textarea_tag($informationObject, 'getRules', array('class' => 'resizable', 'size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="status_id"><?php echo __('status'); ?></label>
      <?php echo object_select_tag($informationObject, 'getDescriptionStatusId', array('related_class' => 'QubitTerm', 'include_blank' => true, 'peer_method' => 'getDescriptionStatuses')) ?>
    </div>

    <div class="form-item">
      <label for="level_of_detail_id"><?php echo __('level of detail'); ?></label>
      <?php echo object_select_tag($informationObject, 'getDescriptionDetailId', array('related_class' => 'QubitTerm', 'include_blank' => true, 'peer_method' => 'getDescriptionDetailLevels')) ?>
    </div>

    <div class="form-item">
      <label for="dates"><?php echo __('dates of creation, revision and deletion'); ?></label>
      <?php if (strlen($sourceCultureValue = $informationObject->getRevisionHistory(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $informationObject->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_textarea_tag($informationObject, 'getRevisionHistory', array('class' => 'resizable', 'size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <table class="inline">
        <tr>
          <th style="width: 90%;"><?php echo __('languages of archival description'); ?></th>
          <th style="width: 10%; text-align: right;"><?php echo image_tag('delete', array('align' => 'top', 'class' => 'deleteIcon')) ?></th>
        </tr>
      <?php if ($descriptionLanguageCodes): ?>
        <?php foreach ($descriptionLanguageCodes as $languageCode): ?>
        <tr class="<?php echo 'related_obj_'.$languageCode->getId() ?>">
          <td><div class="animateNicely">
            <?php echo format_language($languageCode->getValue(array('sourceCulture'=>true))) ?>
          </div></td>
          <td style="text-align: right"><div class="animateNicely">
            <input type="checkbox" name="delete_properties[<?php echo $languageCode->getId() ?>]" value="delete" class="multiDelete" />
          </div></td>
        </tr>
        <?php endforeach; ?>
      <?php endif; ?>
        <tr>
          <td colspan="2">
            <?php echo select_language_tag('description_language_code', null, array('include_blank' => true, 'class'=>'multiInstance')) ?>
          </td>
        </tr>
      </table>
    </div>

    <div class="form-item">
      <table class="inline">
        <tr>
          <th style="width: 90%;"><?php echo __('scripts of archival description'); ?></th>
          <th style="width: 10%; text-align: right;"><?php echo image_tag('delete', array('align' => 'top', 'class' => 'deleteIcon')) ?></th>
        </tr>
      <?php if ($descriptionScriptCodes): ?>
        <?php foreach ($descriptionScriptCodes as $scriptCode): ?>
        <tr class="<?php echo 'related_obj_'.$scriptCode->getId() ?>">
          <td><div class="animateNicely">
            <?php echo format_script($scriptCode->getValue(array('sourceCulture'=>true))) ?>
          </div></td>
          <td style="text-align: right"><div class="animateNicely">
            <input type="checkbox" name="delete_properties[<?php echo $scriptCode->getId() ?>]" value="delete" class="multiDelete" />
          </div></td>
        </tr>
        <?php endforeach; ?>
      <?php endif; ?>
        <tr>
          <td colspan="2">
            <?php echo select_script_tag('description_script_code', null, array('include_blank' => true, 'class'=>'multiInstance')) ?>
          </td>
        </tr>
      </table>
    </div>

    <div class="form-item">
      <label for="sources"><?php echo __('sources'); ?></label>
      <?php if (strlen($sourceCultureValue = $informationObject->getSources(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $informationObject->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_textarea_tag($informationObject, 'getSources', array('class' => 'resizable', 'size' => '30x3')) ?>
    </div>
  </fieldset>

  <fieldset class="collapsible collapsed">
    <legend><?php echo sfConfig::get('app_ui_label_digitalobject'); ?></legend>
    <?php if(isset($warnings['upload_file'])): ?>
      <ul class="validation_error">
      <?php foreach($warnings['upload_file'] as $message): ?>
        <li><?php echo $message ?></li>
      <?php endforeach; ?>
      </ul>
    <?php endif; ?>
    <?php include_component('digitalobject', 'edit', array('informationObject'=>$informationObject)); ?>
  </fieldset>

  <fieldset class="collapsible collapsed">
    <legend><?php echo sfConfig::get('app_ui_label_physicalobject'); ?></legend>
    <?php include_component('physicalobject', 'edit', array('informationObject'=>$informationObject)); ?>
  </fieldset>

  <?php if ($sf_context->getActionName() == 'create'): ?>
  <!--set initial form focus -->
  <?php echo javascript_tag(<<<EOF
  $('[name=title]').focus();
EOF
  ) ?>
  <?php endif; ?>

<!-- include empty div at bottom of form to bump the fixed button-block and allow user to scroll past it -->
<div id="button-block-bump"></div>

<div id="button-block">
  <div class="menu-action">
    <?php if ($informationObject->getId()): ?>

    <?php if (($descendantCount = count($informationObject->getDescendants())) > 0): ?>
         <?php $deleteWarning = __('Warning: this archival description has %1% descendants. If you proceed, these lower levels will also be deleted. Are you sure you want to delete this archival description?', array ('%1%' => $descendantCount)) ?>
         &nbsp;<?php echo link_to(__('delete'), 'informationobject/delete?id='.$informationObject->getId(), 'post=true&confirm='.$deleteWarning) ?>
      <?php else: ?>
      <?php $deleteWarning = __('Are you sure you want to delete this archival description permanently?'); ?>
      <?php if ($digitalObjectCount > 0): ?>
        <?php $deleteWarning .= ' '.__('This will also delete the related %1%.', array('%1%'=>sfConfig::get('app_ui_label_digitalobject'))); ?>
      <?php endif; ?>
      &nbsp;<?php echo link_to(__('delete'), 'informationobject/delete?id='.$informationObject->getId(), 'post=true&confirm='.$deleteWarning) ?>
      <?php endif; ?>

       &nbsp;<?php echo link_to(__('cancel'), 'informationobject/showIsad?id='.$informationObject->getId()) ?>
    <?php else: ?>
      &nbsp;<?php echo link_to(__('cancel'), 'informationobject/list') ?>
    <?php endif; ?>

    <?php if ($informationObject->getId()): ?>
      <?php echo submit_tag(__('save')) ?>
    <?php else: ?>
      <?php echo submit_tag(__('create')) ?>
    <?php endif; ?>
  </div>

  <?php // Don't show add/list buttons for new info objects ?>
  <?php if ($informationObject->getId()): ?>
  <div class="menu-extra">
    <?php echo link_to(__('add new'), array('module' => 'informationobject', 'action' => 'create')) ?>
    <?php echo link_to(__('list all'), array('module' => 'informationobject', 'action' => 'list')) ?>
  </div>
  <?php endif; ?>
</div>

</form>
