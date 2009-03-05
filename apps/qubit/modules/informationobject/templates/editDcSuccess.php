<?php use_helper('DateForm') ?>
<?php use_helper('Javascript') ?>

<div class="pageTitle"><?php echo __('edit resource metadata - Dublin Core'); ?></div>

<?php echo form_tag('informationobject/updateDc', array('multipart' => 'true', 'id'=>'editForm')) ?>
  <?php echo object_input_hidden_tag($informationObject, 'getId') ?>

<?php if ($label = QubitDc::getLabel($informationObject, array('sourceCulture' => true))): ?>
  <div class="formHeader">
    <?php echo link_to($label, 'informationobject/showDc/?id='.$informationObject->getId()) ?>
  </div>
<?php else: ?>
  <table class="list" style="height: 25px;"><thead><tr><th>&nbsp;</th></tr></table>
<?php endif; ?>


<?php if ($sf_context->getActionName() == 'createDc'): ?>
  <fieldset class="collapsible">
<?php else : ?>
  <fieldset class="collapsible collapsed">
<?php endif; ?>

    <legend><?php echo __('resource metadata'); ?></legend>

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

    <label for="actors"><?php echo __('creator').', '.__('publisher').', '.__('contributor'); ?></label>
    <table id="actorEvents" class="inline" style="margin-top: 1px;">
      <tr>
        <th style="width: 35%;"><?php echo __('Name') ?></th>
        <th style="width: 25%;"><?php echo __('Role').'/'.__('Event') ?></th>
        <th style="width: 30%;"><?php echo __('Date(s)') ?></th>
        <th style="width: 10%">&nbsp;</th>
      </tr>
      <?php if(count($actorEvents)): ?>
      <?php foreach ($actorEvents as $actorEvent): ?>
      <tr class="<?php echo 'related_obj_'.$actorEvent->getId() ?>">
        <td><div class="animateNicely">
        <?php if ($actorEvent->getActor()): ?>
          <?php echo render_title($actorEvent->getActor()) ?>
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
          <?php echo $actorEvent->getDateDisplay(array('cultureFallback' => 'true')) ?>
        </div></td>
        <td style="text-align: right"><div class="animateNicely">
          <!-- <a href="javascript:editActorEventDialog(<?php echo $actorEvent->getId()?>)"><?php echo image_tag('pencil', 'align=top') ?></a> -->
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
          <td><?php echo input_tag('newActorEvent[newActorAuthorizedName]') ?></td>
        </tr>
        <tr>
          <td colspan="2" class="headerCell" style="width: 55%;"><?php echo __('event type') ?></td><td class="headerCell" style="width: 40%;"><?php echo __('place') ?></td>
        </tr>
        <tr>
          <td colspan="2"><?php echo select_tag('newActorEvent[eventTypeId]', options_for_select($dcEventTypes, $defaultActorEventType))?></td>
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

    <div class="form-item">
      <label for="collection_type_id"><?php echo __('type'); ?></label>
      <?php echo object_select_tag($informationObject, 'getCollectionTypeId', array('related_class' => 'QubitTerm', 'peer_method' => 'getCollectionTypes'), QubitTerm::ARCHIVAL_MATERIAL_ID) ?>
    </div>

    <div class="form-item">
      <label for="material_type_id"><?php echo __('type'); ?></label>
      <?php if ($materialTypes): ?>
        <?php foreach ($materialTypes as $material): ?>
          <?php echo $material->getTerm() ?>&nbsp;<?php echo link_to(image_tag('delete', 'align=top'), 'informationobject/deleteTermRelation?TermRelationId='.$material->getId().'&returnTemplate=dc') ?><br/>
        <?php endforeach; ?>
      <?php endif; ?>
      <?php echo object_select_tag($newMaterialType, 'getTermId', array('name' => 'material_type_id', 'id' => 'material_type_id', 'include_blank' => true, 'peer_method' => 'getMaterialTypes', 'class'=>'multiInstance')) ?>
    </div>

    <div class="form-item">
      <label for="format"><?php echo __('format'); ?></label>
      <?php if (strlen($sourceCultureValue = $informationObject->getExtentAndMedium(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $informationObject->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_textarea_tag($informationObject, 'getExtentAndMedium', array('class' => 'resizable', 'size' => '30x3')) ?>
    </div>

    <div class="form-item">
        <label for="description"><?php echo __('description'); ?></label>
        <?php if (strlen($sourceCultureValue = $informationObject->getScopeAndContent(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $informationObject->getSourceCulture()): ?>
        <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
        <?php endif; ?>
        <?php echo object_textarea_tag($informationObject, 'getScopeAndContent', array('class' => 'resizable', 'size' => '30x3')) ?>
   </div>

    <div class="form-item">
      <label for="parent_id"><?php echo __('relation').' - '.__('parent level'); ?></label>
      <?php echo object_select_tree($informationObject, 'getParentId', array('disabled' => $informationObject->getDescendants()->andSelf()->indexBy('id'), 'include_blank' => true, 'peer_method' => 'getDescendants', 'related_class' => QubitInformationObject::getOne(QubitInformationObject::addRootsCriteria(new Criteria)))) ?>
    </div>

    <div class="form-item">
      <label for="relation"><?php echo __('relation'); ?></label>
        <?php if (strlen($sourceCultureValue = $dcRelation->getSourceTextForTranslation($sf_user->getCulture()))): ?>
        <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_input_tag($dcRelation, 'getValue', array('name' => 'dc_relation', 'size' => 20)) ?>
    </div>

    <div class="form-item">
      <table class="inline">
        <tr>
          <th style="width: 90%;"><?php echo __('Language'); ?></th>
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

     <?php include_partial('addAccessPointTermDialog') ?>
    <div class="form-item" id="subjectAccessPoints">
      <table class="inline">
        <tr>
          <th style="width: 90%;"><?php echo __('Subject'); ?><span id="addSubjectAccessPointLink" style="font-weight:normal"></span></th>
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
          <th style="width: 90%;"><?php echo __('Coverage').' - '.__('spatial'); ?><span id="addPlaceAccessPointLink" style="font-weight:normal"></span></th>
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

    <div class="form-item">
      <label for="source"><?php echo __('source'); ?></label>
      <?php if (strlen($sourceCultureValue = $informationObject->getLocationOfOriginals(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $informationObject->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_textarea_tag($informationObject, 'getLocationOfOriginals', array('class' => 'resizable', 'size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="rights"><?php echo __('rights'); ?></label>
      <?php if (strlen($sourceCultureValue = $informationObject->getAccessConditions(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $informationObject->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_textarea_tag($informationObject, 'getAccessConditions', array('class' => 'resizable', 'size' => '30x3')) ?>
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

    <div class="form-item">
      <label for="repository_id"><?php echo __('repository'); ?></label>
      <?php echo select_tag('repository_id', QubitRepository::getOptionsForSelectList($informationObject->getRepositoryId(), array('include_blank' => true, 'cultureFallback' => true))) ?>
    </div>

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
         <?php $deleteWarning = __('Warning: this resource has %1% descendants. If you proceed, these lower levels will also be deleted. Are you sure you want to delete this resource?', array ('%1%' => $descendantCount)) ?>
         &nbsp;<?php echo link_to(__('delete'), 'informationobject/delete?id='.$informationObject->getId(), 'post=true&confirm='.$deleteWarning) ?>
      <?php else: ?>
      <?php $deleteWarning = __('Are you sure you want to delete this resource permanently?'); ?>
      <?php if ($digitalObjectCount > 0): ?>
        <?php $deleteWarning .= ' '.__('This will also delete the related %1%.', array('%1%'=>sfConfig::get('app_ui_label_digitalobject'))); ?>
      <?php endif; ?>
      &nbsp;<?php echo link_to(__('delete'), 'informationobject/delete?id='.$informationObject->getId(), 'post=true&confirm='.$deleteWarning) ?>
      <?php endif; ?>

       &nbsp;<?php echo link_to(__('cancel'), 'informationobject/showDc?id='.$informationObject->getId()) ?>
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
  <?php echo link_to(__('add new'), 'informationobject/createDc'); ?>
  <?php echo link_to(__('list all'), 'informationobject/list'); ?>
</div>
</div>