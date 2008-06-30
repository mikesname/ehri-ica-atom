<?php use_helper('DateForm') ?>
<?php use_helper('Javascript') ?>

<div class="pageTitle"><?php echo __('edit %1%', array('%1%' => sfConfig::get('app_ui_label_informationobject'))); ?></div>

<?php echo form_tag('informationobject/update', 'multipart=true') ?>
  <?php echo object_input_hidden_tag($informationObject, 'getId') ?>
  <?php echo input_hidden_tag('collection_type_id', QubitTerm::ARCHIVAL_MATERIAL_ID) ?>

  <?php if ($informationObject->getTitle(array('sourceCulture' => true))): ?>
    <div class="formHeader">
      <?php echo link_to($informationObject->getLabel(), 'informationobject/show/?id='.$informationObject->getId()) ?>
    </div>
  <?php else: ?>
    <table class="list" style="height: 25px;"><thead><tr><th></th></tr></table>
  <?php endif; ?>

  <?php if ($sf_context->getActionName() == 'create'): ?>
  <fieldset class="collapsible">
  <?php else : ?>
  <fieldset class="collapsible collapsed">
  <?php endif; ?>

  <legend><?php echo __('identity area'); ?></legend>

    <?php if ($informationObject->getIdentifier()): ?>
      <div class="form-item">
        <label for="reference code"><?php echo __('reference code'); ?></label>
        <?php echo $informationObject->getReferenceCode(array('standard' => 'isad')) ?>
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
      <label for="new_title_note"><?php echo __('title note'); ?></label>

      <?php if ($titleNotes): ?>
        <?php foreach ($titleNotes as $titleNote): ?>
          <?php echo $titleNote->getContent(array('cultureFallback' => 'true')) ?>
          <?php echo link_to(image_tag('delete', 'align=top'), 'informationobject/deleteNote?noteId='.$titleNote->getId()) ?><br />
        <?php endforeach; ?>
      <?php endif; ?>

      <?php echo input_tag('new_title_note') ?>
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
      <?php echo object_textarea_tag($informationObject, 'getExtentAndMedium', array('size' => '30x3')) ?>
    </div>
  </fieldset>

  <fieldset class="collapsible collapsed">
    <legend><?php echo __('context area'); ?></legend>
    <div class="form-item">
      <label for="newCreationDateNote"><?php echo __('creation context'); ?></label>
      <table class="inline">

         <tr>
         <td colspan ="2" class="headerCell" style="width: 55%;"><?php echo __('creator'); ?></td>
         <td class="headerCell" style="width: 40%;"><i><?php echo __('or'); ?> </i><?php echo __('add new creator name'); ?></td>
         </tr>
         <tr>
         <td colspan ="2"><?php echo object_select_tag($newCreationEvent, 'getActorId', array('related_class' => 'QubitActor', 'include_blank' => true, 'peer_method' => 'getAllExceptUsers')) ?></td>
         <td><?php echo input_tag('newActorAuthorizedName') ?></td>
         </tr>
         <tr><td class="headerCell"><?php echo __('creation year'); ?></td><td class="headerCell"><?php echo __('end year (if range)'); ?></td>
         <td class="headerCell"><?php echo __('date display (defaults to date range)'); ?></td></tr>
         <tr><td><?php echo input_tag('creationYear', '', 'maxlength=4 style="width:35px;"') ?></td>
         <td><?php echo input_tag('endYear', '', 'maxlength=4 style="width:35px;"') ?></td>
         <td><?php echo input_tag('newCreationDateNote') ?></td></tr>
       </table>

        <?php if ($creationEvents): ?>
       <table class="inline" style="margin-top: 20px;">
       <tr><td style="width: 55%; color: #999999; font-weight: bold; border-top: 1px solid #000000;"><?php echo __('Creator') ?></td>
        <td style= "width: 40%; color: #999999; font-weight: bold; border-top: 1px solid #000000;"><?php echo __('Creation date(s)') ?></td>
        <td style="width:5%; border-top: 1px solid #000000;"></td></tr>
        <?php foreach ($creationEvents as $creationEvent): ?>
        <tr><td><?php if ($creationEvent->getActor()): ?>
          <?php echo link_to($creationEvent->getActor(), 'actor/edit?id='.$creationEvent->getActorId()) ?>
          <?php endif; ?></td>
        <td><?php echo $creationEvent->getDescription(array('cultureFallback' => 'true')) ?></td>
        <td style="text-align: center;"><?php echo link_to(image_tag('delete', 'align=top'), 'informationobject/deleteEvent?eventId='.$creationEvent->getId()) ?></td></tr>
        <?php endforeach; ?>
         <?php endif; ?>
      </table>
    </div>

    <?php if ($creators): ?>

      <?php foreach ($creators as $creator): ?>
      <div class="form-item">
      <label for="history"><?php echo __('administrative/biographical history'); ?></label>
      <table class="inline" style="width: 98%;">
        <tr><td style="width: 95%; border: 0;">
          <?php echo '<b>'.$creator.'</b><br />' ?>
          <?php echo nl2br($creator->getHistory(array('cultureFallback' => 'true'))) ?></td><td style="border: 0;"><?php echo link_to(image_tag('pencil', 'align=top'), 'actor/edit?id='.$creator->getId().'&informationObjectReroute='.$informationObject->getId()) ?>
             </td></tr></table>
        </div>
        <?php endforeach; ?>
     <?php endif; ?>

     <div class="form-item">
      <label for="repository_id"><?php echo __('repository'); ?></label>
      <?php echo object_select_tag($informationObject, 'getRepositoryId', array('include_blank' => true,)) ?>
    </div>

    <div class="form-item">
      <label for="acquisition"><?php echo __('immediate source of acquisition'); ?></label>
      <?php if (strlen($sourceCultureValue = $informationObject->getAcquisition(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $informationObject->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_textarea_tag($informationObject, 'getAcquisition', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="archival_history"><?php echo __('archival history'); ?></label>
      <?php if (strlen($sourceCultureValue = $informationObject->getArchivalHistory(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $informationObject->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
       <?php echo object_textarea_tag($informationObject, 'getArchivalHistory', array('size' => '30x3')) ?>
    </div>

  </fieldset>

  <fieldset class="collapsible collapsed">
    <legend><?php echo __('content and structure area'); ?></legend>

    <div class="form-item">
      <label for="scope_and_content"><?php echo __('scope and content'); ?></label>
      <?php if (strlen($sourceCultureValue = $informationObject->getScopeAndContent(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $informationObject->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_textarea_tag($informationObject, 'getScopeAndContent', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="appraisal"><?php echo __('appraisal, destruction and scheduling'); ?></label>
      <?php if (strlen($sourceCultureValue = $informationObject->getAppraisal(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $informationObject->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_textarea_tag($informationObject, 'getAppraisal', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="accruals"><?php echo __('accruals'); ?></label>
      <?php if (strlen($sourceCultureValue = $informationObject->getAccruals(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $informationObject->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_textarea_tag($informationObject, 'getAccruals', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="arrangement"><?php echo __('system of arrangement'); ?></label>
      <?php if (strlen($sourceCultureValue = $informationObject->getArrangement(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $informationObject->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_textarea_tag($informationObject, 'getArrangement', array('size' => '30x3')) ?>
    </div>
  </fieldset>

  <fieldset class="collapsible collapsed">
    <legend><?php echo __('conditions of access and use area'); ?></legend>

    <div class="form-item">
      <label for="access_conditions"><?php echo __('conditions governing access'); ?></label>
      <?php if (strlen($sourceCultureValue = $informationObject->getAccessConditions(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $informationObject->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_textarea_tag($informationObject, 'getAccessConditions', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="reproduction_conditions"><?php echo __('conditions governing reproduction'); ?></label>
      <?php if (strlen($sourceCultureValue = $informationObject->getReproductionConditions(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $informationObject->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_textarea_tag($informationObject, 'getReproductionConditions', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="language_of_material"><?php echo __('language of material'); ?></label>
      <?php if ($languageCodes): ?>
        <?php foreach ($languageCodes as $languageCode): ?>
          <div style="margin-top: 5px; margin-bottom: 5px;">
          <?php echo format_language($languageCode->getValue()) ?>&nbsp;<?php echo link_to(image_tag('delete', 'align=top'), 'informationobject/deleteProperty?Id='.$languageCode->getId()) ?><br/>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
      <?php echo select_language_tag('language_code', null, array('include_blank' => true)) ?>
     </div>

    <div class="form-item">
      <label for="script_of_material"><?php echo __('script of material'); ?></label>
      <?php if ($scriptCodes): ?>
        <?php foreach ($scriptCodes as $scriptCode): ?>
          <div style="margin-top: 5px; margin-bottom: 5px;">
          <?php echo format_script($scriptCode->getValue()) ?>&nbsp;<?php echo link_to(image_tag('delete', 'align=top'), 'informationobject/deleteProperty?Id='.$scriptCode->getId()) ?><br/>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
      <?php echo select_script_tag('script_code', null, array('include_blank' => true)) ?>
    </div>

    <div class="form-item">
      <label for="physical_characteristics"><?php echo __('physical characteristics'); ?></label>
      <?php if (strlen($sourceCultureValue = $informationObject->getPhysicalCharacteristics(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $informationObject->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_textarea_tag($informationObject, 'getPhysicalCharacteristics', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="finding_aids"><?php echo __('finding aids'); ?></label>
      <?php if (strlen($sourceCultureValue = $informationObject->getFindingAids(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $informationObject->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_textarea_tag($informationObject, 'getFindingAids', array('size' => '30x3')) ?>
    </div>
 </fieldset>

 <fieldset class="collapsible collapsed">
    <legend><?php echo __('allied materials area'); ?></legend>
    <div class="form-item">
      <label for="location_of_originals"><?php echo __('location of originals'); ?></label>
      <?php if (strlen($sourceCultureValue = $informationObject->getLocationOfOriginals(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $informationObject->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_textarea_tag($informationObject, 'getLocationOfOriginals', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="location_of_copies"><?php echo __('location of copies'); ?></label>
      <?php if (strlen($sourceCultureValue = $informationObject->getLocationOfCopies(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $informationObject->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_textarea_tag($informationObject, 'getLocationOfCopies', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="related_units_of_description"><?php echo __('related units of description'); ?></label>
      <?php if (strlen($sourceCultureValue = $informationObject->getRelatedUnitsOfDescription(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $informationObject->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_textarea_tag($informationObject, 'getRelatedUnitsOfDescription', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="new_title_note"><?php echo __('publication note'); ?></label>

      <?php if ($publicationNotes): ?>
        <?php foreach ($publicationNotes as $publicationNote): ?>
          <?php echo $publicationNote->getContent(array('cultureFallback' => 'true')) ?>
          <?php echo link_to(image_tag('delete', 'align=top'), 'informationobject/deleteNote?noteId='.$publicationNote->getId()) ?><br />
        <?php endforeach; ?>
      <?php endif; ?>

      <?php echo textarea_tag('new_publication_note', '', 'size=30x3') ?>
    </div>
  </fieldset>

  <fieldset class="collapsible collapsed">
    <legend><?php echo __('notes area'); ?></legend>
    <div class="form-item">
      <label for="notes"><?php echo __('notes'); ?></label>
      <table class="inline">
        <tr>
          <td class="headerCell" style="width: 65%;"><?php echo __('note'); ?></td>
          <td class="headerCell" style="width: 30%"><?php echo __('note type'); ?></td>
          <td class="headerCell" style="width: 5%;"></td>
        </tr>
        <?php if ($notes): ?>
          <?php foreach ($notes as $note): ?>
            <tr>
            <td><?php echo $note->getContent(array('cultureFallback' => 'true')) ?><br/><span class="note"><?php echo $note->getUser() ?>, <?php echo $note->getUpdatedAt() ?></span></td>
            <td><?php echo $note->getType() ?></td>
            <td style="text-align: center;"><?php echo link_to(image_tag('delete', 'align=top'), 'informationobject/deleteNote?noteId='.$note->getId()) ?></td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
        <tr valign="top">
          <td><?php echo object_textarea_tag($newNote, 'getContent', array('size' => '10x1')) ?></td>
          <td><?php echo object_select_tag($newNote, 'getTypeId', array('name' => 'note_type_id', 'id' => 'note_type_id', 'related_class' => 'QubitTerm', 'include_blank' => true, 'peer_method' => 'getNoteTypes', 'style' => 'width: 120px;')) ?></td>
        </tr>
      </table>
    </div>
  </fieldset>

  <fieldset class="collapsible collapsed">
    <legend><?php echo __('access points'); ?></legend>

    <div class="form-item">
      <label for="subject_id"><?php echo __('subject access points'); ?></label>
      <?php if ($subjectAccessPoints): ?>
        <?php foreach ($subjectAccessPoints as $subject): ?>
          <?php echo $subject->getTerm() ?>&nbsp;<?php echo link_to(image_tag('delete', 'align=top'), 'informationobject/deleteTermRelation?TermRelationId='.$subject->getId()) ?><br/>
        <?php endforeach; ?>
      <?php endif; ?>
      <?php echo object_select_tag($newSubjectAccessPoint, 'getTermId', array('name' => 'subject_id', 'id' => 'subject_id', 'include_blank' => true, 'peer_method' => 'getSubjects')) ?>
    </div>

    <div class="form-item">
      <label for="place_id"><?php echo __('place access points'); ?></label>
      <?php if ($placeAccessPoints): ?>
        <?php foreach ($placeAccessPoints as $place): ?>
          <?php echo $place->getTerm() ?>&nbsp;<?php echo link_to(image_tag('delete', 'align=top'), 'informationobject/deleteTermRelation?TermRelationId='.$place->getId()) ?><br/>
        <?php endforeach; ?>
      <?php endif; ?>
      <?php echo object_select_tag($newPlaceAccessPoint, 'getTermId', array('name' => 'place_id', 'id' => 'place_id', 'include_blank' => true, 'peer_method' => 'getPlaces')) ?>
    </div>

    <div class="form-item">
      <label for="name_id"><?php echo __('name access points'); ?></label>
      <?php if ($nameAccessPoints): ?>
        <?php foreach ($nameAccessPoints as $name): ?>
          <?php echo $name->getActor().' ('.$name->getActorRole().')' ?>
          <?php if ($name->getActorRoleId() == QubitTerm::SUBJECT_ID): ?>
            <?php echo link_to(image_tag('delete', 'align=top'), 'informationobject/deleteEvent?eventId='.$name->getId()) ?>
          <?php endif; ?>
          <br/>
        <?php endforeach; ?>
       <?php endif; ?>
       <?php echo select_tag('name_id', options_for_select($nameSelectList, null, array('include_blank' => true))) ?>
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
      <?php echo object_textarea_tag($informationObject, 'getRules', array('size' => '30x3')) ?>
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
      <?php echo object_textarea_tag($informationObject, 'getRevisionHistory', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="language_code"><?php echo __('languages of archival description'); ?></label>
      <?php if ($descriptionLanguageCodes): ?>
        <?php foreach ($descriptionLanguageCodes as $languageCode): ?>
          <div style="margin-top: 5px; margin-bottom: 5px;">
          <?php echo format_language($languageCode->getValue()) ?>&nbsp;<?php echo link_to(image_tag('delete', 'align=top'), 'informationobject/deleteProperty?Id='.$languageCode->getId()) ?><br/>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
      <?php echo select_language_tag('description_language_code', null, array('include_blank' => true)) ?>
    </div>

    <div class="form-item">
      <label for="script_id"><?php echo __('scripts of archival description'); ?></label>
      <?php if ($descriptionScriptCodes): ?>
        <?php foreach ($descriptionScriptCodes as $scriptCode): ?>
          <div style="margin-top: 5px; margin-bottom: 5px;">
          <?php echo format_script($scriptCode->getValue()) ?>&nbsp;<?php echo link_to(image_tag('delete', 'align=top'), 'informationobject/deleteProperty?Id='.$scriptCode->getId()) ?><br/>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
      <?php echo select_script_tag('description_script_code', null, array('include_blank' => true)) ?>
    </div>

    <div class="form-item">
      <label for="sources"><?php echo __('sources'); ?></label>
      <?php if (strlen($sourceCultureValue = $informationObject->getSources(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $informationObject->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_textarea_tag($informationObject, 'getSources', array('size' => '30x3')) ?>
    </div>
  </fieldset>
  
  <fieldset class="collapsible collapsed">
    <legend><?php echo sfConfig::get('app_ui_label_digitalobject'); ?></legend>
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
         <?php $deleteWarning = __('Warning: this %1% has %2% descendants. If you proceed, these lower levels will also be deleted. Are you sure you want to delete this %1%?', array ('%1%' =>sfConfig::get('app_ui_label_informationobject'), '%2%' => $descendantCount)) ?> 
         &nbsp;<?php echo link_to(__('delete'), 'informationobject/delete?id='.$informationObject->getId(), 'post=true&confirm='.$deleteWarning) ?>
      <?php else: ?>
      <?php $deleteWarning = __('Are you sure you want to delete this %1% permanently?', array('%1%' => sfConfig::get('app_ui_label_informationobject'))); ?>
      <?php if ($digitalObjectCount > 0): ?>
        <?php $deleteWarning .= ' '.__('This will also delete %1% %2%.', array('%1%'=>$digitalObjectCount, '%2%'=>sfConfig::get('app_ui_label_digitalobject'))); ?>
      <?php endif; ?>
      &nbsp;<?php echo link_to(__('delete'), 'informationobject/delete?id='.$informationObject->getId(), 'post=true&confirm='.$deleteWarning) ?>
      <?php endif; ?>
      
       &nbsp;<?php echo link_to(__('cancel'), 'informationobject/show?id='.$informationObject->getId().'&template=0') ?>
    <?php else: ?>
      &nbsp;<?php echo link_to(__('cancel'), 'informationobject/list') ?>
    <?php endif; ?>

    <?php if ($informationObject->getId()): ?>
      <?php echo my_submit_tag(__('save'), array('style' => 'width: auto;')) ?>
    <?php else: ?>
      <?php echo my_submit_tag(__('create'), array('style' => 'width: auto;')) ?>
    <?php endif; ?>
  </div>

</form> 

<div class="menu-extra">
  <?php echo link_to(__('add new %1%', array('%1%' => sfConfig::get('app_ui_label_informationobject'))), 'informationobject/create'); ?>
  <?php echo link_to(__('list all %1%', array('%1%' => sfConfig::get('app_ui_label_informationobject'))), 'informationobject/list'); ?>
</div>
</div>
