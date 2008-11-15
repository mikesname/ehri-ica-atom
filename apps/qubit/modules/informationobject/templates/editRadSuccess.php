<?php use_helper('DateForm') ?>
<?php use_helper('Javascript') ?>

<div class="pageTitle"><?php echo __('edit archival description'); ?></div>

<form method="post" action="<?php echo url_for('informationobject/updateRad') ?>" enctype="multipart/form-data">
  <?php echo object_input_hidden_tag($informationObject, 'getId') ?>
  <?php echo input_hidden_tag('collection_type_id', QubitTerm::ARCHIVAL_MATERIAL_ID) ?>

<?php if ($label = QubitRad::getLabel($informationObject, array('sourceCulture' => true))): ?>
  <div class="formHeader">
    <?php echo link_to($label, 'informationobject/showRad/?id='.$informationObject->getId()) ?>
  </div>
<?php else: ?>
  <table class="list" style="height: 25px;"><thead><tr><th>&nbsp;</th></tr></table>
<?php endif; ?>

<?php if ($sf_context->getActionName() == 'create'): ?>
  <fieldset class="collapsible">
<?php else : ?>
  <fieldset class="collapsible collapsed">
<?php endif; ?>
  
    <!-- title and statement of responsibility area -->
    <legend><?php echo __('title and statement of responsibility area'); ?></legend>
    <div class="form-item">
      <label for="title proper"><?php echo __('title proper'); ?></label>
      <?php if (strlen($sourceCultureValue = $informationObject->getTitle(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $informationObject->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_input_tag($informationObject, 'getTitle', array('size' => 20)) ?>
    </div>

    <div class="form-item">
      <label for="general_material_designation_id"><?php echo __('general material designation'); ?></label>
      <?php if ($materialTypes): ?>
        <?php foreach ($materialTypes as $material): ?>
          <?php echo $material->getTerm() ?>&nbsp;<?php echo link_to(image_tag('delete', 'align=top'), 'informationobject/deleteTermRelation?TermRelationId='.$material->getId().'&returnTemplate=rad') ?><br/>
        <?php endforeach; ?>
      <?php endif; ?>
      <?php echo object_select_tag($newMaterialType, 'getTermId', array('name' => 'material_type_id', 'id' => 'material_type_id', 'include_blank' => true, 'peer_method' => 'getMaterialTypes', 'class'=>'multiInstance')) ?>
    </div>

    <div class="form-item">
      <label for="parallel title"><?php echo __('parallel title'); ?></label>
      <?php if (strlen($sourceCultureValue = $informationObject->getAlternateTitle(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $informationObject->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_input_tag($informationObject, 'getAlternateTitle', array('size' => 20)) ?>
    </div>

    <div class="form-item">
      <label for="other title information"><?php echo __('other title information'); ?></label>
      <?php if (strlen($sourceCultureValue = $radOtherTitleInformation->getSourceTextForTranslation($sf_user->getCulture()))): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_input_tag($radOtherTitleInformation, 'getValue', array('name' => 'rad_other_title_information', 'size' => 20)) ?>
    </div>

    <div class="form-item">
      <label for="statements of responsibility"><?php echo __('statements of responsibility'); ?></label>
      <?php if (strlen($sourceCultureValue = $radTitleStatementOfResponsibility->getSourceTextForTranslation($sf_user->getCulture()))): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_input_tag($radTitleStatementOfResponsibility, 'getValue', array('name' => 'rad_title_statement_of_responsibility', 'size' => 20)) ?>
    </div>

    <div class="form-item">
      <label for="notes"><?php echo __('title notes'); ?></label>
      <table class="inline">
        <tr>
          <td class="headerCell" style="width: 65%;"><?php echo __('note'); ?></td>
          <td class="headerCell" style="width: 30%"><?php echo __('title note type'); ?></td>
          <td class="headerCell" style="width: 5%;"></td>
        </tr>
        <?php if ($radTitleNotes): ?>
          <?php foreach ($radTitleNotes as $note): ?>
            <tr>
            <td><?php echo $note->getContent(array('cultureFallback' => 'true')) ?><br/><span class="note"><?php echo $note->getUser() ?>, <?php echo $note->getUpdatedAt() ?></span></td>
            <td><?php echo $note->getType() ?></td>
            <td style="text-align: center;"><?php echo link_to(image_tag('delete', 'align=top'), 'informationobject/deleteNote?noteId='.$note->getId().'&returnTemplate=rad') ?></td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
        <tr valign="top">
          <td><?php echo input_tag('rad_title_note')?></td>
          <td><?php echo select_tag('rad_title_note_type', options_for_select($radTitleNoteTypes))?></td>
        </tr>
      </table>
    </div>

    <table style="border: 0; width: 98%; margin: 0; padding: 0;">
      <tr>
        <td style="width: 150px;">
          <div class="form-item">
            <label for="level_of_description_id"><?php echo __('level of description'); ?></label>
            <?php echo object_select_tag($informationObject, 'getLevelOfDescriptionId', array('related_class' => 'QubitTerm', 'include_blank' => true, 'peer_method' => 'getLevelsOfDescription')) ?>
          </div>
        </td>
        <td style="padding-left: 10px;">
          <div class="form-item">
            <label for="parent_id"><?php echo __('parent level'); ?></label>
            <?php echo object_select_tree(
              $informationObject, 'getParentId', array('disabled' => $informationObject->getDescendants()->andSelf()->indexBy('id'),
              'include_blank' => true, 'peer_method' => 'getDescendants',
              'related_class' => QubitInformationObject::getOne(QubitInformationObject::addRootsCriteria(new Criteria)))) ?>
          </div>
        </td>
      </tr>
    </table>

    <div class="form-item">
      <label for="repository_id"><?php echo __('repository'); ?></label>
      <?php echo object_select_tag($informationObject, 'getRepositoryId', array('include_blank' => true,)) ?>
    </div>

    <div class="form-item">
      <label for="identifier"><?php echo __('identifier'); ?></label>
      <?php echo object_input_tag($informationObject, 'getIdentifier', array('size' => 20)) ?>
    </div>

    <?php if ($informationObject->getIdentifier()): ?>
      <div class="form-item">
        <label for="reference code"><?php echo __('reference code'); ?></label>
        <?php echo QubitRad::getReferenceCode($informationObject) ?>
      </div>
    <?php endif; ?>
  </fieldset>
  <!-- End title and statement of responsibility area -->
  
  <!-- Edition area -->
  <fieldset class="collapsible collapsed">
    <legend><?php echo __('edition area'); ?></legend>

    <div class="form-item">
      <label for="edition statement"><?php echo __('edition statement'); ?></label>
      <?php if (strlen($sourceCultureValue = $informationObject->getEdition(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $informationObject->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_input_tag($informationObject, 'getEdition', array('size' => 20)) ?>
    </div>

    <div class="form-item">
      <label for="statements of responsibility"><?php echo __('statements of responsibility'); ?></label>
      <?php if (strlen($sourceCultureValue = $radEditionStatementOfResponsibility->getSourceTextForTranslation($sf_user->getCulture()))): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_input_tag($radEditionStatementOfResponsibility, 'getValue', array('name' => 'rad_edition_statement_of_responsibility', 'size' => 20)) ?>
    </div>
  </fieldset>
  <!-- End edition area -->

  <!-- Class of material specific details area -->
  <fieldset class="collapsible collapsed">
    <legend><?php echo __('class of material specific details area'); ?></legend>

    <div class="form-item">
      <label for="statement of scale (cartographic)"><?php echo __('statement of scale (cartographic)'); ?></label>
      <?php if (strlen($sourceCultureValue = $radStatementOfScaleCartographic->getSourceTextForTranslation($sf_user->getCulture()))): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_input_tag($radStatementOfScaleCartographic, 'getValue', array('name' => 'rad_statement_of_scale_cartographic', 'size' => 20)) ?>
    </div>

    <div class="form-item">
      <label for="statement of projection"><?php echo __('statement of projection (cartographic)'); ?></label>
      <?php if (strlen($sourceCultureValue = $radStatementOfProjection->getSourceTextForTranslation($sf_user->getCulture()))): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_input_tag($radStatementOfProjection, 'getValue', array('name' => 'rad_statement_of_projection', 'size' => 20)) ?>
    </div>

    <div class="form-item">
      <label for="statement of coordinates"><?php echo __('statement of coordinates (cartographic)'); ?></label>
      <?php if (strlen($sourceCultureValue = $radStatementOfCoordinates->getSourceTextForTranslation($sf_user->getCulture()))): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_input_tag($radStatementOfCoordinates, 'getValue', array('name' => 'rad_statement_of_coordinates', 'size' => 20)) ?>
    </div>

    <div class="form-item">
      <label for="statement of scale (architectural)"><?php echo __('statement of scale (architectural)'); ?></label>
      <?php if (strlen($sourceCultureValue = $radStatementOfScaleArchitectural->getSourceTextForTranslation($sf_user->getCulture()))): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_input_tag($radStatementOfScaleArchitectural, 'getValue', array('name' => 'rad_statement_of_scale_architectural', 'size' => 20)) ?>
    </div>

    <div class="form-item">
      <label for="issuing jurisdiction and denomination"><?php echo __('issuing jurisdiction and denomination (philatelic)'); ?></label>
      <?php if (strlen($sourceCultureValue = $radIssuingJursidictionAndDenomination->getSourceTextForTranslation($sf_user->getCulture()))): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_input_tag($radIssuingJursidictionAndDenomination, 'getValue', array('name' => 'rad_issuing_jursidiction_and_denomination', 'size' => 20)) ?>
    </div>
  </fieldset>
  <!-- End class of material specific details area -->
  
  <!-- Dates of creation area -->
  <fieldset class="collapsible collapsed">
    <legend><?php echo __('dates of creation area'); ?></legend>

    <table id="actorEvents" class="inline" style="margin-top: 25px;">
      <tr>
        <th style="width: 35%;"><?php echo __('Name') ?></th>
        <th style="width: 25%;"><?php echo __('Role').'/'.__('Event') ?></th>
        <th style="width: 30%;"><?php echo __('Date(s)') ?></th>
        <th style="width: 10%">&nbsp;</th>
      </tr>
      <?php if(count($actorEvents)): ?>
      <?php foreach ($actorEvents as $actorEvent): ?>
      <tr>
        <?php if ($actorEvent->getActor()): ?>
          <td>
            <?php echo $actorEvent->getActor() ?>
          </td>
        <?php else: ?>
          <td></td>
        <?php endif; ?>
        <?php if ($actorEvent->getActor()): ?>
        <td>
          <?php echo $actorEvent->getType()->getRole() ?>
        </td>
        <?php else: ?>
          <td><?php echo $actorEvent->getType() ?></td>
        <?php endif; ?>
        <td><?php echo $actorEvent->getDateDisplay(array('cultureFallback' => 'true')) ?></td>
        <td style="text-align: right">
          <!-- <a href="javascript:editActorEventDialog(<?php echo $actorEvent->getId()?>)"><?php echo image_tag('pencil', 'align=top') ?></a> -->
          <?php echo link_to(image_tag('delete', 'align=top'), 'informationobject/deleteEvent?eventId='.$actorEvent->getId().'&returnTemplate=rad') ?>
        </td>
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
          <td colspan ="2"><?php echo object_select_tag($newActorEvent, 'getActorId',
            array('related_class' => 'QubitActor',
              'name' => 'newActorEvent[actorId]',
              'include_blank' => true,
              'peer_method' => 'getAllExceptUsers')) ?></td>
          <td><?php echo input_tag('newActorEvent[newActorAuthorizedName]') ?></td>
        </tr>
        <tr>
          <td colspan="2" class="headerCell" style="width: 55%;"><?php echo __('event type') ?></td><td class="headerCell" style="width: 40%;"><?php echo __('place') ?></td>
        </tr>
        <tr>
          <td colspan="2"><?php echo select_tag('newActorEvent[eventTypeId]', options_for_select($actorEventTypes, $defaultActorEventType))?></td>
          <td><?php echo select_tag('newActorEvent[placeId]', options_for_select($actorEventPlaces))?></td>
        </tr>
        <tr>
          <td class="headerCell"><?php echo __('year'); ?></td><td class="headerCell"><?php echo __('end year'); ?></td>
          <td class="headerCell"><?php echo __('date display (defaults to date range)'); ?></td></tr>
        <tr>
          <td><?php echo input_tag('newActorEvent[year]', '', 'maxlength=4 style="width:35px;"') ?></td>
          <td><?php echo input_tag('newActorEvent[endYear]', '', 'maxlength=4 style="width:35px;"') ?></td>
          <td><?php echo input_tag('newActorEvent[dateDisplay]') ?></td>
        </tr>
        <tr>
          <td colspan="3" class="headerCell"><?php echo __('note'); ?></td>
        </tr>
        <tr>
          <td colspan="3"><?php echo input_tag('newActorEvent[description]') ?></td>
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
          <?php echo __('administrative history').':' ?>
        <?php elseif (($entityTypeId == QubitTerm::PERSON_ID) || ($entityTypeId == QubitTerm::FAMILY_ID)): ?>
          <?php echo __('biographical sketch').':' ?>
        <?php else: ?>
          <?php echo __('history').':' ?>
        <?php endif; ?>
        <?php echo $creator->getAuthorizedFormOfName(array('culturalFallback' => 'true')) ?>
      </label>
      <table class="inline" style="margin: 0;">
        <tr>
          <td><?php echo nl2br($creator->getHistory(array('cultureFallback' => 'true'))) ?></td>
          <td style="width: 20px;"><?php echo link_to(image_tag('pencil', 'align=top'), 'actor/edit?id='.$creator->getId().'&informationObjectReroute='.$informationObject->getId()) ?></td>
        </tr>
      </table>
      </div>
      <?php endforeach; ?>
    <?php endif; ?>
   </fieldset>
   <!-- End dates of creation area -->
  
   <!-- Physical description area -->
   <fieldset class="collapsible collapsed">
    <legend><?php echo __('physical description area'); ?></legend>

    <div class="form-item">
      <label for="extent_and_medium"><?php echo __('physical description'); ?></label>
      <?php if (strlen($sourceCultureValue = $informationObject->getExtentAndMedium(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $informationObject->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_textarea_tag($informationObject, 'getExtentAndMedium', array('size' => '30x3')) ?>
    </div>

  </fieldset>
  <!-- End physical description area -->
  
  <!-- Publisher's series area -->
  <fieldset class="collapsible collapsed">
    <legend><?php echo __("publisher's series area"); ?></legend>

    <div class="form-item">
      <label for="Title proper of publisher's series"><?php echo __("Title proper of publisher's series"); ?></label>
      <?php if ($sourceCultureValue = $radTitleProperOfPublishersSeries->getSourceTextForTranslation($sf_user->getCulture())): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_input_tag($radTitleProperOfPublishersSeries, 'getValue', array('name' => 'rad_title_proper_of_publishers_series', 'size' => '20')) ?>
    </div>

    <div class="form-item">
      <label for="Parallel titles of publisher's series"><?php echo __("Parallel titles of publisher's series"); ?></label>
      <?php if ($sourceCultureValue = $radParallelTitlesOfPublishersSeries->getSourceTextForTranslation($sf_user->getCulture())): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_input_tag($radParallelTitlesOfPublishersSeries, 'getValue', array('name' => 'rad_parallel_titles_of_publishers_series', 'size' => '20')) ?>
    </div>

    <div class="form-item">
      <label for="Other title information of publisher's series"><?php echo __("Other title information of publisher's series"); ?></label>
      <?php if ($sourceCultureValue = $radOtherTitleInformationOfPublishersSeries->getSourceTextForTranslation($sf_user->getCulture())): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_input_tag($radOtherTitleInformationOfPublishersSeries, 'getValue', array('name' => 'rad_other_title_information_of_publishers_series', 'size' => '20')) ?>
    </div>

    <div class="form-item">
      <label for="Statement of responsibility relating to publisher's series"><?php echo __("Statement of responsibility relating to publisher's series"); ?></label>
      <?php if ($sourceCultureValue = $radStatementOfResponsibilityRelatingToPublishersSeries->getSourceTextForTranslation($sf_user->getCulture())): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_input_tag($radStatementOfResponsibilityRelatingToPublishersSeries, 'getValue', array('name' => 'rad_statement_of_responsibility_relating_to_publishers_series', 'size' => '20')) ?>
    </div>

    <div class="form-item">
      <label for="Numbering within publisher's series"><?php echo __("Numbering within publisher's series"); ?></label>
      <?php if ($sourceCultureValue = $radNumberingWithinPublishersSeries->getSourceTextForTranslation($sf_user->getCulture())): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_input_tag($radNumberingWithinPublishersSeries, 'getValue', array('name' => 'rad_numbering_within_publishers_series', 'size' => '20')) ?>
    </div>

     <div class="form-item">
      <label for="Note on publisher's series"><?php echo __("Note on publisher's series"); ?></label>
      <?php if ($sourceCultureValue = $radNoteOnPublishersSeries->getSourceTextForTranslation($sf_user->getCulture())): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_textarea_tag($radNoteOnPublishersSeries, 'getValue', array('name' => 'rad_note_on_publishers_series', 'size' => '30x3')) ?>
    </div>
  </fieldset>
  <!-- End publisher's series area -->

  <!-- Archival description area -->
  <fieldset class="collapsible collapsed">
    <legend><?php echo __('archival description area'); ?></legend>

    <div class="form-item">
      <?php if ($creators): ?>
      <?php foreach ($creators as $creator): ?>
      <div class="form-item">
      <label>
        <?php $entityTypeId = $creator->getEntityTypeId() ?>
        <?php if ($entityTypeId == QubitTerm::CORPORATE_BODY_ID): ?>
          <?php echo __('administrative history').':' ?>
        <?php elseif (($entityTypeId == QubitTerm::PERSON_ID) || ($entityTypeId == QubitTerm::FAMILY_ID)): ?>
          <?php echo __('biographical sketch').':' ?>
        <?php else: ?>
          <?php echo __('history').':' ?>
        <?php endif; ?>
        <?php echo $creator->getAuthorizedFormOfName(array('culturalFallback' => 'true')) ?>
      </label>
      <table class="inline" style="margin: 0;">
        <tr>
          <td><?php echo nl2br($creator->getHistory(array('cultureFallback' => 'true'))) ?></td>
          <td style="width: 20px;"><?php echo link_to(image_tag('pencil', 'align=top'), 'actor/edit?id='.$creator->getId().'&informationObjectReroute='.$informationObject->getId()) ?></td>
        </tr>
      </table>
      </div>
      <?php endforeach; ?>
      <?php endif; ?>
  
      <div class="form-item">
        <label for="Archival history"><?php echo __('custodial history'); ?></label>
        <?php if (strlen($sourceCultureValue = $informationObject->getArchivalHistory(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $informationObject->getSourceCulture()): ?>
        <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
        <?php endif; ?>
         <?php echo object_textarea_tag($informationObject, 'getArchivalHistory', array('size' => '30x3')) ?>
      </div>
  
      <div class="form-item">
        <label for="scope_and_content"><?php echo __('scope and content'); ?></label>
        <?php if (strlen($sourceCultureValue = $informationObject->getScopeAndContent(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $informationObject->getSourceCulture()): ?>
        <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
        <?php endif; ?>
        <?php echo object_textarea_tag($informationObject, 'getScopeAndContent', array('size' => '30x3')) ?>
      </div>
    </div>
  </fieldset>
  <!-- End archival description area -->

  <!-- Notes area -->
  <fieldset class="collapsible collapsed">
    <legend><?php echo __('notes area'); ?></legend>

    <div class="form-item">
      <label for="physical_characteristics"><?php echo __('physical condition'); ?></label>
      <?php if (strlen($sourceCultureValue = $informationObject->getPhysicalCharacteristics(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $informationObject->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_textarea_tag($informationObject, 'getPhysicalCharacteristics', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="acquisition"><?php echo __('immediate source of acquisition'); ?></label>
      <?php if (strlen($sourceCultureValue = $informationObject->getAcquisition(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $informationObject->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_textarea_tag($informationObject, 'getAcquisition', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="arrangement"><?php echo __('arrangement'); ?></label>
      <?php if (strlen($sourceCultureValue = $informationObject->getArrangement(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $informationObject->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_textarea_tag($informationObject, 'getArrangement', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="language_of_material"><?php echo __('language'); ?></label>
      <?php if ($languageCodes): ?>
        <?php foreach ($languageCodes as $languageCode): ?>
          <div style="margin-top: 5px; margin-bottom: 5px;">
          <?php echo format_language($languageCode->getValue()) ?>&nbsp;<?php echo link_to(image_tag('delete', 'align=top'), 'informationobject/deleteProperty?Id='.$languageCode->getId().'&returnTemplate=rad') ?><br/>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
      <?php echo select_language_tag('language_code', null, array('include_blank' => true, 'class'=>'multiInstance')) ?>
     </div>

    <div class="form-item">
      <label for="script_of_material"><?php echo __('script'); ?></label>
      <?php if ($scriptCodes): ?>
        <?php foreach ($scriptCodes as $scriptCode): ?>
          <div style="margin-top: 5px; margin-bottom: 5px;">
          <?php echo format_script($scriptCode->getValue()) ?>&nbsp;<?php echo link_to(image_tag('delete', 'align=top'), 'informationobject/deleteProperty?Id='.$scriptCode->getId().'&returnTemplate=rad') ?><br/>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
      <?php echo select_script_tag('script_code', null, array('include_blank' => true, 'class'=>'multiInstance')) ?>
    </div>

    <div class="form-item">
      <label for="location_of_originals"><?php echo __('location of originals'); ?></label>
      <?php if (strlen($sourceCultureValue = $informationObject->getLocationOfOriginals(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $informationObject->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_textarea_tag($informationObject, 'getLocationOfOriginals', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="location_of_copies"><?php echo __('availability of other formats'); ?></label>
      <?php if (strlen($sourceCultureValue = $informationObject->getLocationOfCopies(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $informationObject->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_textarea_tag($informationObject, 'getLocationOfCopies', array('size' => '30x3')) ?>
    </div>


    <div class="form-item">
      <label for="access_conditions"><?php echo __('restrictions on access'); ?></label>
      <?php if (strlen($sourceCultureValue = $informationObject->getAccessConditions(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $informationObject->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_textarea_tag($informationObject, 'getAccessConditions', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="reproduction_conditions"><?php echo __('terms governing use, reproduction, and publication'); ?></label>
      <?php if (strlen($sourceCultureValue = $informationObject->getReproductionConditions(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $informationObject->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_textarea_tag($informationObject, 'getReproductionConditions', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="finding_aids"><?php echo __('finding aids'); ?></label>
      <?php if (strlen($sourceCultureValue = $informationObject->getFindingAids(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $informationObject->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_textarea_tag($informationObject, 'getFindingAids', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="related_units_of_description"><?php echo __('associated / related material'); ?></label>
      <?php if (strlen($sourceCultureValue = $informationObject->getRelatedUnitsOfDescription(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $informationObject->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_textarea_tag($informationObject, 'getRelatedUnitsOfDescription', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="accruals"><?php echo __('accruals'); ?></label>
      <?php if (strlen($sourceCultureValue = $informationObject->getAccruals(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $informationObject->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_textarea_tag($informationObject, 'getAccruals', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="notes"><?php echo __('other notes'); ?></label>
      <table class="inline">
        <tr>
          <td class="headerCell" style="width: 65%;"><?php echo __('note'); ?></td>
          <td class="headerCell" style="width: 30%"><?php echo __('note type'); ?></td>
          <td class="headerCell" style="width: 5%;"></td>
        </tr>
        <?php if ($radNotes): ?>
          <?php foreach ($radNotes as $note): ?>
            <tr>
            <td><?php echo $note->getContent(array('cultureFallback' => 'true')) ?><br/><span class="note"><?php echo $note->getUser() ?>, <?php echo $note->getUpdatedAt() ?></span></td>
            <td><?php echo $note->getType() ?></td>
            <td style="text-align: center;"><?php echo link_to(image_tag('delete', 'align=top'), 'informationobject/deleteNote?noteId='.$note->getId().'&returnTemplate=rad') ?></td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
        <tr valign="top">
          <td><?php echo input_tag('rad_note')?></td>
          <td><?php echo select_tag('rad_note_type', options_for_select($radNoteTypes))?></td>
        </tr>
      </table>
    </div>
  </fieldset>
  <!-- End notes area -->
  
  <!-- Standard number area -->
  <fieldset class="collapsible collapsed">
    <legend><?php echo __('standard number area'); ?></legend>

    <div class="form-item">
      <label for="statement of coordinates"><?php echo __('standard number'); ?></label>
      <?php if (strlen($sourceCultureValue = $radStandardNumber->getSourceTextForTranslation($sf_user->getCulture()))): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_input_tag($radStandardNumber, 'getValue', array('name' => 'rad_standard_number', 'size' => 20)) ?>
    </div>
  </fieldset>
  <!-- End standard number area -->

  <!-- Access Points -->
  <fieldset class="collapsible collapsed">
    <legend><?php echo __('access points'); ?></legend>

    <?php include_partial('addAccessPointTermDialog') ?>
    <div class="form-item" id="subjectAccessPoints">
      <label for="subject_id"><?php echo __('subject access points'); ?><span id="addSubjectAccessPointLink" style="font-weight:normal"></span></label>
      <?php if ($subjectAccessPoints): ?>
        <?php foreach ($subjectAccessPoints as $subject): ?>
          <?php echo $subject->getTerm() ?>&nbsp;<?php echo link_to(image_tag('delete', 'align=top'), 'informationobject/deleteTermRelation?TermRelationId='.$subject->getId().'&returnTemplate=rad') ?><br/>
        <?php endforeach; ?>
      <?php endif; ?>
      <?php echo object_select_tag($newSubjectAccessPoint, 'getTermId', array('name' => 'subject_id', 'id' => 'subject_id', 'include_blank' => true, 'peer_method' => 'getSubjects', 'class'=>'multiInstance')) ?>
    </div>

    <div class="form-item" id="placeAccessPoints">
      <label for="place_id"><?php echo __('place access points'); ?><span id="addPlaceAccessPointLink" style="font-weight:normal"></span></label>
      <?php if ($placeAccessPoints): ?>
        <?php foreach ($placeAccessPoints as $place): ?>
          <?php echo $place->getTerm() ?>&nbsp;<?php echo link_to(image_tag('delete', 'align=top'), 'informationobject/deleteTermRelation?TermRelationId='.$place->getId().'&returnTemplate=rad') ?><br/>
        <?php endforeach; ?>
      <?php endif; ?>
      <?php echo object_select_tag($newPlaceAccessPoint, 'getTermId', array('name' => 'place_id', 'id' => 'place_id', 'include_blank' => true, 'peer_method' => 'getPlaces', 'class'=>'multiInstance')) ?>
    </div>

    <div class="form-item">
      <label for="name_id"><?php echo __('name access points'); ?></label>
      <?php if ($nameAccessPoints): ?>
        <?php foreach ($nameAccessPoints as $name): ?>
          <?php echo $name->getActor().' ('.$name->getType()->getRole().')' ?>
          <?php if ($name->getTypeId() == QubitTerm::SUBJECT_ID): ?>
            <?php echo link_to(image_tag('delete', 'align=top'), 'informationobject/deleteEvent?eventId='.$name->getId().'&returnTemplate=rad') ?>
          <?php endif; ?>
          <br/>
        <?php endforeach; ?>
       <?php endif; ?>
       <?php echo select_tag('name_id', options_for_select($nameSelectList, null, array('include_blank' => true)), array('class'=>'multiInstance')) ?>
    </div>
  </fieldset>
  <!-- End Access Points-->
  
  <!-- Control Area -->
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
          <?php echo format_language($languageCode->getValue()) ?>&nbsp;<?php echo link_to(image_tag('delete', 'align=top'), 'informationobject/deleteProperty?Id='.$languageCode->getId().'&returnTemplate=rad') ?><br/>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
      <?php echo select_language_tag('description_language_code', null, array('include_blank' => true, 'class'=>'multiInstance')) ?>
    </div>

    <div class="form-item">
      <label for="script_id"><?php echo __('scripts of archival description'); ?></label>
      <?php if ($descriptionScriptCodes): ?>
        <?php foreach ($descriptionScriptCodes as $scriptCode): ?>
          <div style="margin-top: 5px; margin-bottom: 5px;">
          <?php echo format_script($scriptCode->getValue()) ?>&nbsp;<?php echo link_to(image_tag('delete', 'align=top'), 'informationobject/deleteProperty?Id='.$scriptCode->getId().'&returnTemplate=rad') ?><br/>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
      <?php echo select_script_tag('description_script_code', null, array('include_blank' => true, 'class'=>'multiInstance')) ?>
    </div>

    <div class="form-item">
      <label for="sources"><?php echo __('sources'); ?></label>
      <?php if (strlen($sourceCultureValue = $informationObject->getSources(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $informationObject->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_textarea_tag($informationObject, 'getSources', array('size' => '30x3')) ?>
    </div>
  </fieldset>
  <!-- End Control Area -->
  
  <!-- Digital Object Area -->
  <fieldset class="collapsible collapsed">
    <legend><?php echo sfConfig::get('app_ui_label_digitalobject'); ?></legend>
    <?php include_component('digitalobject', 'edit', array('informationObject'=>$informationObject)); ?>
  </fieldset>
  <!-- End Digital Object Area -->

  <!-- Physical Object Area -->  
  <fieldset class="collapsible collapsed">
    <legend><?php echo sfConfig::get('app_ui_label_physicalobject'); ?></legend>
    <?php include_component('physicalobject', 'edit', array('informationObject'=>$informationObject)); ?>
  </fieldset>
  <!-- End Physical Object Area -->

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
          <?php $deleteWarning .= ' '.__('This will also delete the related %1%.', array('%1%'=>sfConfig::get('app_ui_label_digitalobject'))); ?>
        <?php endif; ?>
        &nbsp;<?php echo link_to(__('delete'), 'informationobject/delete?id='.$informationObject->getId(), 'post=true&confirm='.$deleteWarning) ?>
        <?php endif; ?>
  
         &nbsp;<?php echo link_to(__('cancel'), 'informationobject/show?id='.$informationObject->getId()) ?>
      <?php else: ?>
        &nbsp;<?php echo link_to(__('cancel'), 'informationobject/list') ?>
      <?php endif; ?>
  
      <?php if ($informationObject->getId()): ?>
        <?php echo my_submit_tag(__('save'), array('style' => 'width: auto;')) ?>
      <?php else: ?>
        <?php echo my_submit_tag(__('create'), array('style' => 'width: auto;')) ?>
      <?php endif; ?>
    </div>
    <div class="menu-extra">
      <?php echo link_to(__('add new archival description'), 'informationobject/createRad'); ?>
      <?php echo link_to(__('list all'), 'informationobject/list'); ?>
    </div>
  </div>
</form>