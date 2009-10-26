<?php use_helper('Javascript') ?>

<?php // write actorRelationDialog yui dialog object to DOM via javascript
  echo include_partial('actorRelationDialog'); ?>

<?php // write eventDialog yui dialog object to DOM via javascript
  echo include_partial('eventDialog'); ?>

<div class="pageTitle"><?php echo __('edit %1% - ISAAR', array('%1%' => sfConfig::get('app_ui_label_actor'))) ?></div>

<?php if (isset($sf_request->id)): ?>
  <?php echo $form->renderFormTag(url_for(array('module' => 'actor', 'action' => 'edit', 'id' => $sf_request->id)), array('id' => 'editForm')) ?>
<?php else: ?>
  <?php echo $form->renderFormTag(url_for(array('module' => 'actor', 'action' => 'create')), array('id' => 'editForm')) ?>
<?php endif; ?>

  <?php echo $form->renderHiddenFields() ?>

  <?php echo input_hidden_tag('repositoryReroute', $repositoryReroute) ?>
  <?php echo input_hidden_tag('informationObjectReroute', $informationObjectReroute) ?>

    <div class="formHeader">
      <?php echo render_title($actor) ?>
    </div>

  <fieldset class="collapsible collapsed" id="identityArea">

  <legend><?php echo __('identity area'); ?></legend>

  <div class="form-item">
    <label for="type_of_entity"><?php echo __('type of entity'); ?></label>
    <?php echo object_select_tag($actor, 'getEntityTypeId', array('related_class' => 'QubitTerm', 'include_blank' => true, 'peer_method' => 'getActorEntityTypes')) ?>
  </div>

  <div class="form-item">
    <label for="authorized_form_of_name"><?php echo __('authorized form of name'); ?></label>
      <?php if (strlen($sourceCultureValue = $actor->getAuthorizedFormOfName(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $actor->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
    <?php echo object_input_tag($actor, 'getAuthorizedFormOfName', array('size' => 20)) ?>
  </div>

  <div class="form-item">
    <label for="other_name"><?php echo __('other names'); ?></label>
    <table class="inline"><tr>
      <td class="headerCell" style="width: 40%;"><?php echo __('name'); ?></td>
      <td class="headerCell" style="width: 20%;"><?php echo __('type'); ?></td>
      <td class="headerCell" style="width: 35%;"><?php echo __('note'); ?></td>
      <td class="headerCell" style="width: 5%;"></td>
      </tr>
      <?php if ($otherNames): ?>
        <?php foreach ($otherNames as $otherName): ?>
          <tr><td><?php echo $otherName->getName() ?></td><td><?php echo $otherName->getType() ?></td>
          <td><?php echo $otherName->getNote() ?></td>
          <td style="text-align: center;"><?php echo link_to(image_tag('delete', 'align=top'), array('module' => 'actor', 'action' => 'deleteOtherName', 'otherNameId' => $otherName->getId(), 'returnTemplate' => 'isaar')) ?></td></tr>
        <?php endforeach; ?>
      <?php endif; ?>
      <tr>
        <td><?php echo input_tag('new_name', null, array('size' => 10))?></td>
        <td><?php echo object_select_tag($newName, 'getTypeId', array(
          'name' => 'new_name_type_id',
          'id' => 'new_name_type_id',
          'related_class' => 'QubitTerm',
          'include_blank' => true,
          'peer_method' => 'getActorNameTypes',
          'style' => 'width: 95px;'
        )) ?></td>
        <td><?php echo input_tag('new_name_note', null, array('size' => 10))?></td>
      </tr>
    </table>
  </div>

  <div class="form-item">
    <label for="identifiers"><?php echo __('identifiers for corporate bodies'); ?></label>
    <?php echo object_input_tag($actor, 'getCorporateBodyIdentifiers', array('size' => 20)) ?>
  </div>

  </fieldset>

  <fieldset class="collapsible collapsed" id="descriptionArea">
    <legend><?php echo __('description area'); ?></legend>

    <div class="form-item">
      <label for="dates_of_existence"><?php echo __('dates of existence'); ?></label>
      <?php if (strlen($sourceCultureValue = $actor->getDatesOfExistence(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $actor->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_input_tag($actor, 'getDatesOfExistence', array('size' => 20)) ?>
    </div>

    <div class="form-item">
      <label for="history"><?php echo __('history'); ?></label>
      <?php if (strlen($sourceCultureValue = $actor->getHistory(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $actor->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_textarea_tag($actor, 'getHistory', array('class' => 'resizable', 'size' => '30x10')) ?>
    </div>

    <div class="form-item">
      <label for="places"><?php echo __('places'); ?></label>
      <?php if (strlen($sourceCultureValue = $actor->getPlaces(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $actor->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_textarea_tag($actor, 'getPlaces', array('class' => 'resizable', 'size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="legal_status"><?php echo __('legal status'); ?></label>
      <?php if (strlen($sourceCultureValue = $actor->getLegalStatus(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $actor->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_textarea_tag($actor, 'getLegalStatus', array('class' => 'resizable', 'size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="functions"><?php echo __('functions, occupations and activities'); ?></label>
      <?php if (strlen($sourceCultureValue = $actor->getFunctions(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $actor->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_textarea_tag($actor, 'getFunctions', array('class' => 'resizable', 'size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="mandates"><?php echo __('Mandates/Sources of authority'); ?></label>
      <?php if (strlen($sourceCultureValue = $actor->getMandates(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $actor->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_textarea_tag($actor, 'getMandates', array('class' => 'resizable', 'size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="internal_structures"><?php echo __('Internal structures/Genealogy'); ?></label>
      <?php if (strlen($sourceCultureValue = $actor->getInternalStructures(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $actor->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_textarea_tag($actor, 'getInternalStructures', array('class' => 'resizable', 'size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="general_context"><?php echo __('general context'); ?></label>
      <?php if (strlen($sourceCultureValue = $actor->getGeneralContext(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $actor->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_textarea_tag($actor, 'getGeneralContext', array('class' => 'resizable', 'size' => '30x3')) ?>
    </div>


  </fieldset>

  <fieldset class="collapsible collapsed" id="relationshipsArea">
    <legend><?php echo __('relationships area'); ?></legend>

    <div class="form-item">
      <table class="inline" id="relatedEntities">
        <caption><?php echo __('Related corporate bodies, persons or families'); ?></caption>
        <tr>
          <th style="width: 25%"><?php echo __('name'); ?></th>
          <th style="width: 15%"><?php echo __('type'); ?></th>
          <th style="width: 20%"><?php echo __('dates'); ?></th>
          <th style="width: 30%"><?php echo __('description'); ?></th>
          <th style="width: 10%; text-align: center"><?php echo image_tag('delete', array('align' => 'top', 'class' => 'deleteIcon')) ?></th>
        </tr>
      <?php if (0 < count($actorRelations)): ?>
        <?php foreach ($actorRelations as $actorRelation): ?>
        <tr id="<?php echo 'actorRelation_'.$actorRelation->getId() ?>" class="<?php echo 'related_obj_'.$actorRelation->getId() ?>">
          <?php if ($actorRelation->getObjectId() == $actor->getId()): ?>
          <td><?php echo $actorRelation->getSubject()->getAuthorizedFormOfName() ?></td>
          <?php else: ?>
          <td><?php echo $actorRelation->getObject()->getAuthorizedFormOfName() ?></td>
          <?php endif; ?>
          <td><?php echo $actorRelation->getType() ?></td>
          <td>
          <?php if (0 < strlen($dateDisplay = $actorRelation->getNoteByTypeId(QubitTerm::RELATION_NOTE_DATE_DISPLAY_ID)) || 0 < count($dateArray = $actorRelation->getDates())): ?>
            <?php if (0 < strlen($dateDisplay)): ?>
              <?php echo $dateDisplay ?>
            <?php elseif (2 == count($dateArray)): ?>
              <?php echo __('%1% - %2%', array('%1%' => collapse_date($dateArray['start']), '%2%' => collapse_date($dateArray['end']))) ?>
            <?php else: ?>
              <?php echo collapse_date(array_shift($dateArray)) ?>
            <?php endif; ?>
          <?php endif; ?>
          </td>
          <td><?php echo $actorRelation->getNoteByTypeId(QubitTerm::RELATION_NOTE_DESCRIPTION_ID) ?></td>
          <td style="text-align: center;">
            <input type="checkbox" name="deleteRelations[<?php echo $actorRelation->getId() ?>]" value="delete" class="multiDelete" />
          </td>
        </tr>
        <?php endforeach; ?>
      <?php endif; ?>
      </table>
    </div>

    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *  -->
    <!-- NOTE: The actorRelationDialog.js script cuts this *entire*       -->
    <!-- "actorRelation" table and pastes it in a YUI dialog object.      -->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *  -->
    <table class="inline" id="actorRelation">
      <caption><?php echo __('new relationship') ?></caption>
      <tbody>
      <tr>
        <th style="width: 66%" colspan="3">
          <label for="editActorRelation_actorName" class="required_field"><?php echo __('Name of related entity') ?></label>
        </th>
        <th style="width: 34%">
          <label for="editActorRelation_categoryId"><?php echo __('Category of relationship') ?></label>
        </th>
      </tr>
      <tr>
        <td colspan="3" style="width: 66%">
          <?php include_partial('actorNameAutoComplete', array('actor' => $actor))?>
        </td>
        <td style="width: 34%">
          <?php echo select_tag('editActorRelation[categoryId]', objects_for_select($actorRelationCategories, 'getId', 'getName')) ?>
        </td>
      </tr>
      <tr>
        <th colspan="4">
          <label for="editActorRelation_description"><?php echo __('Description of relationship') ?></label>
        </th>
      </tr>
      <tr>
        <td colspan="4" style="width: 100%">
          <?php echo textarea_tag('editActorRelation[description]', '', array('class' => 'resizable', 'style' => '30x3')) ?>
        </td>
      </tr>
      <tr>
        <th style="width: 25%">
          <label for="editActorRelation_startDate"><?php echo __('date&dagger') ?></label>
        </th>
        <th style="width: 25%">
          <label for="editActorRelation_endDate"><?php echo __('end date&dagger;') ?></label>
        </th>
        <th colspan="2" style="width: 50%">
          <label for="editActorRelation_dateDisplay"><?php echo __('date display') ?></label>
        </th>
      </tr>
      <tr>
        <td style="width: 25%">
          <?php echo input_tag('editActorRelation[startDate]') ?>
        </td>
        <td style="width: 25%">
          <?php echo input_tag('editActorRelation[endDate]') ?>
        </td>
        <td colspan="2" style="width: 50%">
          <?php echo input_tag('editActorRelation[dateDisplay]') ?>
        </td>
      </tr>
      <tr>
        <td colspan="4">
          <?php echo __('%1% - required field', array('%1%' => '*'))?><br />
          <?php echo __('%1% - dates must be specified in ISO-8601 format (YYYY-MM-DD)', array('%1%' => '&dagger;'))?>
        </td>
      </tr>
      </tbody>
    </table>

    <!-- Related resources -->
    <div class="form-item">
      <table class="inline" id="relatedEvents">
        <caption><?php echo __('Related resources'); ?></caption>
        <tr>
          <th style="width: 35%"><?php echo __('title'); ?></th>
          <th style="width: 20%"><?php echo __('relationship'); ?></th>
          <th style="width: 25%"><?php echo __('dates'); ?></th>
          <th style="width: 10%; text-align: center"><?php echo image_tag('delete', array('align' => 'top', 'class' => 'deleteIcon')) ?></th>
        </tr>
      <?php if (0 < count($events)): ?>
        <?php foreach ($events as $event): ?>
        <tr id="<?php echo 'event_'.$event->getId() ?>" class="<?php echo 'related_obj_'.$event->getId() ?>">
          <td><?php echo $event->getInformationObject()->getTitle() ?></td>
          <td><?php echo $event->getType() ?></td>
          <td>
            <?php if (0 < strlen($dateDisplay = $event->getDateDisplay())): ?>
              <?php echo $dateDisplay ?>
            <?php elseif (0 < strlen($event->getStartDate()) && 0 < strlen($event->getEndDate())): ?>
              <?php echo __('%1% - %2%', array('%1%' => collapse_date($event->getStartDate()), '%2%' => collapse_date($event->getEndDate()))) ?>
            <?php elseif (0 < strlen($date = $event->getStartDate()) || 0 < strlen($date = $event->getEndDate())): ?>
              <?php echo collapse_date($date) ?>
            <?php endif; ?>
          </td>
          <td style="text-align: right">
            <input type="checkbox" name="deleteEvents[<?php echo $event->getId() ?>]" value="delete" class="multiDelete" />
          </td>
        </tr>
        <?php endforeach; ?>
      <?php endif; ?>
      </table>
    </div>

    <?php 
      /**
       * NOTE: The eventDialog script cuts this entire table and pastes
       * it in a YUI dialog object.
       *
       * @see apps/qubit/modules/actor/_eventDialog.php
       * @see web/js/eventDialog.js
       */
    ?>
    <table id="newEvent" class="inline">
      <tr>
        <td colspan="3" class="headerCell" style="width: 55%;"><?php echo __('title of related resource'); ?></td>
      </tr>
      <tr>
        <td colspan="3" class="noline">
          <?php echo input_tag('newEvent[resourceTitle]', null, array('class' => 'titleAutoComplete')) ?>
          <?php include_partial('informationobject/titleAutoComplete') ?>
        </td>
      </tr>
      <tr>
        <td colspan="2" class="headerCell" style="width: 60%;"><?php echo __('nature of relationship') ?></td>
        <td class="headerCell" style="width: 40%;"><?php echo __('type of related resource') ?></td>
      </tr>
      <tr>
        <td colspan="2" class="noline">
          <?php echo select_tag('newEvent[typeId]', options_for_select($eventTypes))?>
        </td>
        <td class="noline">
          <?php echo select_tag('newEvent[resourceTypeId]', 
            objects_for_select($resourceTypeTerms, 'getId', 'getName'))?>
        </td>
      </tr>
      <tr>
        <td class="headerCell" style="width: 30%"><?php echo __('date'); ?></td>
        <td class="headerCell" style="width: 30%"><?php echo __('end date'); ?></td>
        <td class="headerCell" style="width: 40%"><?php echo __('date display'); ?></td></tr>
      <tr>
        <td class="noline"><?php echo input_tag('newEvent[startDate]') ?></td>
        <td class="noline"><?php echo input_tag('newEvent[endDate]') ?></td>
        <td class="noline"><?php echo input_tag('newEvent[dateDisplay]') ?></td>
      </tr>
    </table>
  </fieldset>

  <fieldset class="collapsible collapsed" id="controlArea">
    <legend><?php echo __('control area'); ?></legend>

    <div class="form-item">
      <label for="description_identifier"><?php echo __('authority record identifier'); ?></label>
      <?php echo object_input_tag($actor, 'getDescriptionIdentifier', array('size' => 20)) ?>
    </div>

    <div class="form-item">
      <label for="institution_identifier"><?php echo __('institution identifier'); ?></label>
      <?php if (strlen($sourceCultureValue = $actor->getInstitutionResponsibleIdentifier(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $actor->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_input_tag($actor, 'getInstitutionResponsibleIdentifier', array('size' => 20)) ?>
    </div>

    <div class="form-item">
      <label for="rules"><?php echo __('rules and/or conventions'); ?></label>
      <?php if (strlen($sourceCultureValue = $actor->getRules(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $actor->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_textarea_tag($actor, 'getRules', array('class' => 'resizable', 'size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="status_id"><?php echo __('status'); ?></label>
      <?php echo object_select_tag($actor, 'getDescriptionStatusId', array('related_class' => 'QubitTerm', 'include_blank' => true, 'peer_method' => 'getDescriptionStatuses')) ?>
    </div>

    <div class="form-item">
      <label for="level_of_detail_id"><?php echo __('level of detail'); ?></label>
      <?php echo object_select_tag($actor, 'getDescriptionDetailId', array('related_class' => 'QubitTerm', 'include_blank' => true, 'peer_method' => 'getDescriptionDetailLevels')) ?>
    </div>

    <div class="form-item">
      <label for="dates"><?php echo __('dates of creation, revision and deletion'); ?></label>
      <?php if (strlen($sourceCultureValue = $actor->getRevisionHistory(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $actor->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_textarea_tag($actor, 'getRevisionHistory', array('class' => 'resizable', 'size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="language_code"><?php echo __('languages of authority record'); ?></label>

      <?php if (count($languageCodes) > 0): ?>
      <?php foreach ($languageCodes as $languageCode): ?>
        <div style="margin-top: 5px; margin-bottom: 5px;">
        <?php echo format_language($languageCode->getValue(array('sourceCulture' => true))) ?>&nbsp;<?php echo link_to(image_tag('delete', 'align=top'), array('module' => 'actor', 'action' => 'deleteProperty', 'Id' => $languageCode->getId(), 'returnTemplate' => 'isaar')) ?><br/>
        </div>
      <?php endforeach; ?>
      <?php endif; ?>

      <?php echo select_language_tag('language_code', null, array('include_blank' => true, 'class'=>'multiInstance')) ?>
     </div>

    <div class="form-item">
      <label for="script_id"><?php echo __('scripts of authority record'); ?></label>

      <?php if (count($scriptCodes) > 0): ?>
      <?php foreach ($scriptCodes as $scriptCode): ?>
        <div style="margin-top: 5px; margin-bottom: 5px;">
        <?php echo format_script($scriptCode->getValue(array('sourceCulture' => true))) ?>&nbsp;<?php echo link_to(image_tag('delete', 'align=top'), array('module' => 'actor', 'action' => 'deleteProperty', 'Id' => $scriptCode->getId(), 'returnTemplate' => 'isaar')) ?><br/>
        </div>
      <?php endforeach; ?>
      <?php endif; ?>

      <?php echo select_script_tag('script_code', null, array('include_blank' => true, 'class'=>'multiInstance')) ?>
    </div>

    <div class="form-id">
      <label for="sources"><?php echo __('sources'); ?></label>
      <?php if (strlen($sourceCultureValue = $actor->getSources(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $actor->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_textarea_tag($actor, 'getSources', array('class' => 'resizable', 'size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <table class="inline">
        <tr>
          <th style="width: 90%;"><?php echo __('Maintenance Notes') ?></th>
          <th style="width: 10%; text-align: right"><?php echo image_tag('delete', array('align' => 'top', 'class' => 'deleteIcon')) ?></th>
        </tr>
        <?php if ($maintenanceNotes): ?>
        <?php foreach ($maintenanceNotes as $maintenanceNote): ?>
        <tr class="<?php echo 'related_obj_'.$maintenanceNote->getId() ?>">
          <td><div class="animateNicely">
            <?php echo $maintenanceNote->getContent(array('cultureFallback' => 'true')) ?>
          </div></td>
          <td style="text-align: right;"><div class="animateNicely">
            <input type="checkbox" name="delete_notes[<?php echo $maintenanceNote->getId() ?>]" value="delete" class="multiDelete" />
          </div></td>
        </tr>
        <?php endforeach; ?>
        <?php endif; ?>
        <tr>
          <td><?php echo textarea_tag('new_maintenance_note', '', array('class' => 'multiInstanceTr', 'size' => '30x2')) ?></td>
          <td style="text-align: right">&nbsp;</td>
        </tr>
      </table>
    </div>

  </fieldset>

  <ul class="actions">
    <?php if (isset($sf_request->id)): ?>
      <?php if($repositoryReroute): ?>
        <li><?php echo link_to(__('Cancel'), array('module' => 'repository', 'action' => 'show', 'id' => $repositoryReroute)) ?>
      <?php else: ?>
        <li><?php echo link_to(__('Cancel'), array('module' => 'actor', 'action' => 'show', 'id' => $actor->id)) ?></li>
      <?php endif; ?>
      <li><?php echo submit_tag(__('Save')) ?></li>
    <?php else: ?>
      <li><?php echo link_to(__('Cancel'), array('module' => 'actor', 'action' => 'list')) ?></li>
      <li><?php echo submit_tag(__('Create')) ?></li>
    <?php endif; ?>
  </ul>

</form>
