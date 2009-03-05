<?php use_helper('DateForm') ?>
<?php use_helper('Javascript') ?>

<div class="pageTitle"><?php echo __('edit archival description - ISAD(G)'); ?></div>
<form method="post" action="<?php echo url_for($sf_data->getRaw('postAction')) ?>" enctype="multipart/form-data" id="editForm">
  <?php echo object_input_hidden_tag($informationObject, 'getId') ?>
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
      <table class="inline">
        <tr>
          <th style="width: 90%;"><?php echo __('title note(s)'); ?></th>
          <th style="width: 10%; text-align: right"><?php echo image_tag('delete', array('align' => 'top', 'class' => 'deleteIcon')) ?></th>
        </tr>
        <?php if ($titleNotes): ?>
        <?php foreach ($titleNotes as $titleNote): ?>
        <tr class="<?php echo 'related_obj_'.$titleNote->getId() ?>">
          <td><div class="animateNicely">
            <?php echo $titleNote->getContent(array('cultureFallback' => 'true')) ?>
          </div></td>
          <td style="text-align: right;"><div class="animateNicely">
            <input type="checkbox" name="delete_notes[<?php echo $titleNote->getId() ?>]" value="delete" class="multiDelete" />
          </div></td>
        </tr>
        <?php endforeach; ?>
        <?php endif; ?>
        <tr>
          <td colspan="2"><?php echo input_tag('new_title_note') ?></td>
        </tr>
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

      <table id="actorEvents" class="inline" style="margin-top: 25px;">
        <tr>
          <th style="width: 35%;"><?php echo __('Name') ?></th>
          <th style="width: 25%;"><?php echo __('Role').'/'.__('Event') ?></th>
          <th style="width: 30%;"><?php echo __('Date(s)') ?></th>
          <th style="width: 10%; text-align: right;"><?php echo image_tag('delete', array('align' => 'top', 'class' => 'deleteIcon')) ?></th>
        </tr>
        <?php if(count($actorEvents)): ?>
        <?php foreach ($actorEvents as $actorEvent): ?>
        <tr class="<?php echo 'related_obj_'.$actorEvent->getId() ?>">
          <td><div class="animateNicely">
            <?php echo ($actorEvent->getActor()) ? render_title($actorEvent->getActor()) : '&nbsp;' ?>
          </div></td>
          <td><div class="animateNicely">
            <?php echo ($actorEvent->getActor()) ? $actorEvent->getType()->getRole() : $actorEvent->getType() ?>
          </div></td>
          <td><div class="animateNicely">
            <?php echo $actorEvent->getDateDisplay(array('cultureFallback' => 'true')) ?>
          </div></td>
          <!-- <td><a href="javascript:editActorEventDialog(<?php echo $actorEvent->getId()?>)"><?php echo image_tag('pencil', 'align=top') ?></a></td> -->
          <td style="text-align: right"><div class="animateNicely">
            <input type="checkbox" name="delete_actor_events[<?php echo $actorEvent->getId()?>]" value="delete" class="multiDelete" />
          </div></td>
        </tr>
        <?php endforeach; ?>
        <?php endif; ?>
      </table>

    <!-- add new creation event yui dialog object -->
    <?php echo include_partial('newActorEventDialog') ?>

    <div class="form-item">
      <fieldset id="newActorEventFields" style="border: 1px solid #cccccc; padding: 1px; background: #fff">
      <label for="newActorEvent"><?php echo __('new event'); ?></label>

      <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *  -->
      <!-- NOTE: The newActorEventDialog script cuts this *entire*          -->
      <!-- "newActorEvent" table and pastes it in a YUI dialog object.      -->
      <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *  -->
      <table id="newActorEvent" class="inline">
        <tr>
          <td colspan ="2" class="headerCell" style="width: 55%;"><?php echo __('name'); ?></td>
          <td class="headerCell" style="width: 40%;"><i><?php echo __('or'); ?> </i><?php echo __('add new name'); ?></td>
        </tr>
        <tr>
          <td colspan ="2">
            <?php echo select_tag('newActorEvent[actorId]', QubitActor::getOptionsForSelectList(QubitTerm::CREATION_ID, 
              array('include_blank' => true, 'cultureFallback' => true))) ?>
          </td>
          <td class="noline"><?php echo input_tag('newActorEvent[newActorAuthorizedName]') ?></td>
        </tr>
        <tr>
          <td colspan="2" class="headerCell" style="width: 55%;"><?php echo __('event type') ?></td><td class="headerCell" style="width: 40%;"><?php echo __('place') ?></td>
        </tr>
        <tr>
          <td class="noline" colspan="2"><?php echo select_tag('newActorEvent[eventTypeId]', options_for_select($isadEventTypes, $defaultActorEventType))?></td>
          <td class="noline"><?php echo select_tag('newActorEvent[placeId]', options_for_select($actorEventPlaces))?></td>
        </tr>
        <tr>
          <td class="headerCell"><?php echo __('year'); ?></td><td class="headerCell"><?php echo __('end year'); ?></td>
          <td class="headerCell"><?php echo __('date display (defaults to date range)'); ?></td></tr>
        <tr>
          <td class="noline"><?php echo input_tag('newActorEvent[year]', '', 'maxlength=4 style="width:35px;"') ?></td>
          <td class="noline"><?php echo input_tag('newActorEvent[endYear]', '', 'maxlength=4 style="width:35px;"') ?></td>
          <td class="noline"><?php echo input_tag('newActorEvent[dateDisplay]') ?></td>
        </tr>
        <tr>
          <td colspan="3" class="headerCell"><?php echo __('note'); ?></td>
        </tr>
        <tr>
          <td class="noline" colspan="3"><?php echo input_tag('newActorEvent[description]') ?></td>
        </tr>
      </table>
      </fieldset>
    </div>

    <?php if ($creators): ?>
      <?php foreach ($creators as $creator): ?>
      <div class="form-item">
      <label>
        <?php $entityTypeId = $creator->getEntityTypeId() ?>
        <?php if ($entityTypeId == QubitTerm::CORPORATE_BODY_ID): ?>
        <?php echo __('Administrative').' ' ?>
        <?php elseif (($entityTypeId == QubitTerm::PERSON_ID) || ($entityTypeId == QubitTerm::FAMILY_ID)): ?>
        <?php echo __('Biographic').' ' ?>
        <?php endif; ?>
        <?php echo __('history').': ' ?><?php echo $creator ?>
      </label>
        <table class="inline" style="margin: 0;">
          <tr>
            <td><?php echo nl2br($creator->getHistory(array('cultureFallback' => 'true'))) ?></td>
            <td style="width: 20px;">
              <?php echo link_to(image_tag('pencil', 'align=top'), 'actor/edit?id='.$creator->getId().'&informationObjectReroute='.$informationObject->getId()) ?>
            </td>
         </tr>
        </table>
       </div>
      <?php endforeach; ?>
    <?php endif; ?>

    <div class="form-item">
      <label for="repository_id"><?php echo __('repository'); ?></label>
      <?php echo select_tag('repository_id', QubitRepository::getOptionsForSelectList($informationObject->getRepositoryId(),
        array('include_blank' => true, 'cultureFallback' => true))) ?>
    </div>

    <div class="form-item">
      <label for="acquisition"><?php echo __('immediate source of acquisition'); ?></label>
      <?php if (strlen($sourceCultureValue = $informationObject->getAcquisition(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $informationObject->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_textarea_tag($informationObject, 'getAcquisition', array('class' => 'resizable', 'size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="archival_history"><?php echo __('archival history'); ?></label>
      <?php if (strlen($sourceCultureValue = $informationObject->getArchivalHistory(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $informationObject->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
       <?php echo object_textarea_tag($informationObject, 'getArchivalHistory', array('class' => 'resizable', 'size' => '30x3')) ?>
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
      <label for="physical_characteristics"><?php echo __('physical characteristics'); ?></label>
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
      <label for="location_of_originals"><?php echo __('location of originals'); ?></label>
      <?php if (strlen($sourceCultureValue = $informationObject->getLocationOfOriginals(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $informationObject->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_textarea_tag($informationObject, 'getLocationOfOriginals', array('class' => 'resizable', 'size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="location_of_copies"><?php echo __('location of copies'); ?></label>
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
          <th style="width: 90%;"><?php echo __('publication note'); ?></th>
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
            <?php echo textarea_tag('new_publication_note', '', 'size=30x2') ?>
          </td>
        </tr>
      </table>
    </div>
  </fieldset>

  <fieldset class="collapsible collapsed">
    <legend><?php echo __('notes area'); ?></legend>
    <div class="form-item">
      <label for="notes"><?php echo __('notes'); ?></label>
      <table class="inline">
        <tr>
          <th style="width: 65%;"><?php echo __('note'); ?></th>
          <th style="width: 30%"><?php echo __('note type'); ?></th>
          <th style="width: 5%;"><?php echo image_tag('delete', array('align' => 'top', 'class' => 'deleteIcon')) ?></th>
        </tr>
        <?php if ($notes): ?>
        <?php foreach ($notes as $note): ?>
        <tr class="<?php echo 'related_obj_'.$note->getId() ?>">
          <td><div class="animateNicely">
          <?php echo nl2br($note->getContent(array('cultureFallback' => 'true'))) ?><br/>
          <span class="note"><?php echo $note->getUser() ?>, <?php echo $note->getUpdatedAt() ?></span>
          </div></td>
          <td><div class="animateNicely"><?php echo $note->getType() ?></div></td>
          <td style="text-align: center;"><div class="animateNicely">
            <input type="checkbox" name="delete_notes[<?php echo $note->getId() ?>]" value="delete" class="multiDelete" />
          </div></td>
        </tr>
        <?php endforeach; ?>
        <?php endif; ?>
        <tr valign="top">
          <td><?php echo input_tag('note')?></td>
          <td><?php echo select_tag('note_type_id', options_for_select($noteTypes))?></td>
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
          <th style="width: 90%;"><?php echo __('subject access points'); ?><span id="addSubjectAccessPointLink" style="font-weight:normal"></span></th>
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
          <th style="width: 90%;"><?php echo __('place access points'); ?><span id="addPlaceAccessPointLink" style="font-weight:normal"></span></th>
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
    <legend><?php echo __('control area'); ?></legend>

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
      <?php echo my_submit_tag(__('save'), array('style' => 'width: auto;')) ?>
    <?php else: ?>
      <?php echo my_submit_tag(__('create'), array('style' => 'width: auto;')) ?>
    <?php endif; ?>
  </div>

  <?php // Don't show add/list buttons for new info objects ?>
  <?php if ($informationObject->getId()): ?>
  <div class="menu-extra">
    <?php echo link_to(__('add new'), 'informationobject/createIsad'); ?>
    <?php echo link_to(__('list all'), 'informationobject/list'); ?>
  </div>
  <?php endif; ?>
</div>

</form>
