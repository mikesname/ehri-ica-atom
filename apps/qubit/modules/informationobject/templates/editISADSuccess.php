<?php use_helper('DateForm') ?>

<div class="pageTitle"><?php echo __('edit').' '.__('archival description'); ?></div>

<?php echo form_tag('informationobject/update') ?>
  <?php echo object_input_hidden_tag($informationObject, 'getId') ?>

  <?php if ($informationObject->getTitle()): ?>
    <div class="formHeader">
      <?php echo link_to($informationObject->getLabel(), 'informationobject/show/?id='.$informationObject->getId()) ?>
    </div>
  <?php endif; ?>

  <?php if ($sf_context->getActionName() == 'create'): ?>
  <fieldset class="collapsible">
  <?php else : ?>
  <fieldset class="collapsible collapsed">
  <?php endif; ?>

  <legend><?php echo __('identity area'); ?></legend>

    <div class="form-item">
      <label for="identifier"><?php echo __('reference code'); ?></label>
      <?php echo object_input_tag($informationObject, 'getIdentifier', array('size' => 20)) ?>
    </div>

    <div class="form-item">
      <label for="title"><?php echo __('title'); ?></label>
      <?php echo object_input_tag($informationObject, 'getTitle', array('size' => 20)) ?>
    </div>

    <div class="form-item">
      <label for="alternate_title"><?php echo __('alternate title'); ?></label>
      <?php echo object_input_tag($informationObject, 'getAlternateTitle', array('size' => 20)) ?>
    </div>

    <div class="form-item">
      <label for="new_title_note"><?php echo __('title notes'); ?></label>
      <table class="inline"><tr>
        <td class="headerCell" style="width: 65%;"><?php echo __('note'); ?></td>
        <td class="headerCell" style="width: 30%;"><?php echo __('note type'); ?></td>
        <td class="headerCell" style="width: 5%;"></td>
      </tr>
      <?php foreach ($titleNotes as $titleNote): ?>
      <tr><td><?php echo $titleNote['note'] ?>
      </td><td><?php echo $titleNote['noteType'] ?>
      </td><td style="text-align: center;"><?php echo link_to(image_tag('delete', 'align=top'), 'informationobject/deleteNote?noteId='.$titleNote['noteId']) ?>
      </td></tr>
      <?php endforeach; ?>
      <tr valign="top">
      <td>
      <?php echo input_tag('new_title_note') ?></td>
      <td><?php echo __('title note'); ?></td>
      <td style="text-align: center;"><?php echo submit_image_tag('add', 'class=submitAdd') ?></td>
      </tr></table>
    </div>

    <div class="form-item">
      <label for="rules"><?php echo __('rules or conventions'); ?></label>
      <?php echo object_textarea_tag($informationObject, 'getRules', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="version"><?php echo __('version'); ?></label>
      <?php echo object_input_tag($informationObject, 'getVersion', array('size' => 20)) ?>
    </div>

    <div class="form-item">
      <label for="level_of_description_id"><?php echo __('level of description'); ?></label>
      <?php echo object_select_tag($informationObject, 'getLevelOfDescriptionId', array('related_class' => 'Term', 'include_blank' => true, 'peer_method' => 'getLevelsOfDescription')) ?>
    </div>

    <div class="form-item">
      <label for="parent_id"><?php echo __('next upper level of description'); ?></label>
      <?php if ($parent): ?>
        <?php echo $parent->getLabel() ?>
      <?php endif; ?>

      <?php echo select_tag('parent_id', options_for_select($informationObjectPicklist, $selectedParent)) ?>
    </div>

    <div class="form-item">
      <label for="extent_and_medium"><?php echo __('extent and medium'); ?></label>
      <?php echo object_textarea_tag($informationObject, 'getExtentAndMedium', array('size' => '30x3')) ?>
    </div>
  </fieldset>

  <fieldset class="collapsible collapsed">
    <legend><?php echo __('context area'); ?></legend>
    <div class="form-item">
      <label for="newCreationDateNote"><?php echo __('creation context'); ?></label>
      <table class="inline">

         <tr><td class="headerCell" style="width: 40%;"><?php echo __('creator'); ?></td><td class="headerCell" style="width: 55%;"><i><?php echo __('or'); ?> </i><?php echo __('add').' '.__('new').' '.__('creator name'); ?></td><td class="headerCell" style="width: 5%;"></td></tr>
        <tr><td><?php echo object_select_tag($newCreationEvent, 'getActorId', array('related_class' => 'Actor', 'include_blank' => true, 'peer_method' => 'getActors')) ?>
        </td><td><?php echo input_tag('newActorAuthorizedName') ?></td><td>
        <?php echo submit_image_tag('add', 'class=submitAdd') ?></td></tr>
        <tr><td class="headerCell"><?php echo __('creation year'); ?></td><td class="headerCell"><?php echo __('end year (if range)'); ?></td></tr>
        <tr><td><?php echo input_tag('creationYear', '', 'maxlength=4 style="width:35px;"') ?></td>
        <td><?php echo input_tag('endYear', '', 'maxlength=4 style="width:35px;"') ?></td></tr>
        <tr><td colspan="2" class="headerCell"><?php echo __('date display (defaults to date range)'); ?></td></tr>
        <tr><td colspan="2"><?php echo input_tag('newCreationDateNote') ?></td></tr>

        <?php if ($creationEvents): ?>
        <tr><td colspan="3" style="border-bottom: 1px solid #000000;"></td></tr>
        <tr><td class="headerCell"><?php echo __('creator') ?></td><td class="headerCell"><?php echo __('creation date(s)') ?></td><td class="headerCell"></td></tr>
        <?php foreach ($creationEvents as $creationEvent): ?>
        <tr><td><?php if ($creationEvent['creatorName']): ?>
          <?php echo link_to($creationEvent['creatorName'], 'actor/edit?id='.$creationEvent['creatorId']) ?>
          <?php endif; ?></td>
        <td><?php echo $creationEvent['dateDisplay'] ?></td>
        <td style="text-align: center;"><?php echo link_to(image_tag('delete', 'align=top'), 'informationobject/deleteEvent?eventId='.$creationEvent['eventId']) ?></td></tr>
        <?php endforeach; ?>
        <tr><td colspan="3" style="border-bottom: 1px solid #000000;"></td></tr>
        <?php endif; ?>
      </table>
    </div>

    <?php if ($creators): ?>

      <?php foreach ($creators as $creator): ?>
      <div class="form-item">
      <label for="history"><?php echo __('administrative / biographical history'); ?></label>
      <table class="inline" style="width: 98%;">
        <tr><td style="width: 95%; border: 0;">
          <?php echo '<b>'.$creator.'</b>' ?>
          <?php echo nl2br($creator->getHistory()) ?></td><td style="border: 0;"><?php echo link_to(image_tag('pencil', 'align=top'), 'actor/edit?id='.$creator->getId().'&informationObjectReroute='.$informationObject->getId()) ?>
             </td></tr></table>
        </div>
        <?php endforeach; ?>
     <?php endif; ?>

    <div class="form-item">
      <label for="archival_history"><?php echo __('archival history'); ?></label>
      <?php echo object_textarea_tag($informationObject, 'getArchivalHistory', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="repository_id"><?php echo __('repository'); ?></label>
      <?php echo object_select_tag($informationObject, 'getRepositoryId', array('include_blank' => true,)) ?>
    </div>

    <div class="form-item">
      <label for="acquisition"><?php echo __('immediate source of acquisition'); ?></label>
      <?php echo object_textarea_tag($informationObject, 'getAcquisition', array('size' => '30x3')) ?>
    </div>
  </fieldset>

  <fieldset class="collapsible collapsed">
    <legend><?php echo __('content and structure area'); ?></legend>

    <div class="form-item">
      <label for="scope_and_content"><?php echo __('scope and content'); ?></label>
      <?php echo object_textarea_tag($informationObject, 'getScopeAndContent', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="appraisal"><?php echo __('appraisal, destruction and scheduling'); ?></label>
      <?php echo object_textarea_tag($informationObject, 'getAppraisal', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="accruals"><?php echo __('accruals'); ?></label>
      <?php echo object_textarea_tag($informationObject, 'getAccruals', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="arrangement"><?php echo __('system of arrangement'); ?></label>
      <?php echo object_textarea_tag($informationObject, 'getArrangement', array('size' => '30x3')) ?>
    </div>
  </fieldset>

  <fieldset class="collapsible collapsed">
    <legend><?php echo __('conditions of access and use area'); ?></legend>

    <div class="form-item">
      <label for="access_conditions"><?php echo __('conditions governing access'); ?></label>
      <?php echo object_textarea_tag($informationObject, 'getAccessConditions', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="reproduction_conditions"><?php echo __('conditions governing reproduction'); ?></label>
      <?php echo object_textarea_tag($informationObject, 'getReproductionConditions', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="language_id"><?php echo __('language'); ?></label>

      <?php foreach ($languages as $language): ?>
        <?php echo $language['termName'] ?>&nbsp;<?php echo link_to(image_tag('delete', 'align=top'), 'informationobject/deleteTermRelationship?TermRelationshipId='.$language['relationshipId']) ?><br/>
      <?php endforeach; ?>

      <?php echo object_select_tag($newLanguage, 'getTermId', array('name' => 'language_id', 'id' => 'language_id', 'include_blank' => true, 'peer_method' => 'getLanguages')) ?>
    </div>

    <div class="form-item">
      <label for="script_id"><?php echo __('script'); ?></label>
      <?php foreach ($scripts as $script): ?>
        <?php echo $script['termName'] ?>&nbsp;<?php echo link_to(image_tag('delete', 'align=top'), 'informationobject/deleteTermRelationship?TermRelationshipId='.$script['relationshipId']) ?><br/>
      <?php endforeach; ?>

      <?php echo object_select_tag($newScript, 'getTermId', array('name' => 'script_id', 'id' => 'script_id', 'include_blank' => true, 'peer_method' => 'getScripts')) ?>
    </div>

    <div class="form-item">
      <label for="physical_characteristics"><?php echo __('physical characteristics'); ?></label>
      <?php echo object_textarea_tag($informationObject, 'getPhysicalCharacteristics', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="finding_aids"><?php echo __('finding aids'); ?></label>
      <?php echo object_textarea_tag($informationObject, 'getFindingAids', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="location_of_originals"><?php echo __('location of originals'); ?></label>
      <?php echo object_textarea_tag($informationObject, 'getLocationOfOriginals', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="location_of_copies"><?php echo __('location of copies'); ?></label>
      <?php echo object_textarea_tag($informationObject, 'getLocationOfCopies', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="related_units_of_description"><?php echo __('related units of description'); ?></label>
      <?php echo object_textarea_tag($informationObject, 'getRelatedUnitsOfDescription', array('size' => '30x3')) ?>
    </div>
  </fieldset>

  <fieldset class="collapsible collapsed">
    <legend><?php echo __('access points'); ?></legend>

    <div class="form-item">
      <label for="subject_id"><?php echo __('subject access points'); ?></label>

      <?php foreach ($subjectAccessPoints as $subject): ?>
        <?php echo $subject['termName'] ?>&nbsp;<?php echo link_to(image_tag('delete', 'align=top'), 'informationobject/deleteTermRelationship?TermRelationshipId='.$subject['relationshipId']) ?><br/>
      <?php endforeach; ?>

      <?php echo object_select_tag($newSubjectAccessPoint, 'getTermId', array('name' => 'subject_id', 'id' => 'subject_id', 'include_blank' => true, 'peer_method' => 'getSubjects')) ?>
    </div>

    <div class="form-item">
      <label for="place_id"><?php echo __('place access points'); ?></label>
    </div>

    <div class="form-item">
      <label for="people_id"><?php echo __('person').' / '.__('organization').' '.__('access points'); ?></th>
    </div>
  </fieldset>

  <fieldset class="collapsible collapsed">
    <legend><?php echo __('description control area'); ?></legend>

    <div class="form-item">
      <label for="note"><?php echo __('notes'); ?></label>
      <table class="inline"><tr>
        <td class="headerCell" style="width: 65%;"><?php echo __('note'); ?></td>
        <td class="headerCell" style="width: 30%;"><?php echo __('note type'); ?></td>
        <td class="headerCell" style="width: 5%;"></td>
        </tr>
        <?php foreach ($notes as $note): ?>
          <tr><td><?php echo nl2br($note['note']) ?><br/><span class="note"><?php echo $note['noteAuthor'] ?>, <?php echo $note['updated'] ?></span></td><td><?php echo $note['noteType'] ?></td><td style="text-align: center;"><?php echo link_to(image_tag('delete', 'align=top'), 'informationobject/deleteNote?noteId='.$note['noteId']) ?></td></tr>
        <?php endforeach; ?>
        <tr valign="top"><td>
        <?php echo object_textarea_tag($newNote, 'getNote', array('size' => '10x1',)) ?></td><td>
        <?php echo object_select_tag($newNote, 'getNoteTypeId', array('name' => 'note_type_id', 'id' => 'note_type_id', 'related_class' => 'Term', 'include_blank' => true, 'peer_method' => 'getNoteTypes', 'style' => 'width: 120px;')) ?></td>
        <td style="text-align: center;"><?php echo submit_image_tag('add', 'class=submitAdd') ?></td>
      </tr></table>
    </div>

    <div class="form-item">
      <label for="rules"><?php echo __('rules or conventions'); ?></label>
      <?php echo object_textarea_tag($informationObject, 'getRules', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="dates"><?php echo __('dates of description'); ?></label>
    </div>
  </fieldset>

  <div class="menu-action">
    <?php if ($informationObject->getId()): ?>
      &nbsp;<?php echo link_to(__('delete'), 'informationobject/delete?id='.$informationObject->getId(), 'post=true&confirm='.__('are you sure?')) ?>
      &nbsp;<?php echo link_to(__('cancel'), 'informationobject/show?id='.$informationObject->getId().'&template=0') ?>
    <?php else: ?>
      &nbsp;<?php echo link_to(__('cancel'), 'informationobject/create') ?>
    <?php endif; ?>
    <?php echo my_submit_tag(__('save'), array('style' => 'width: auto;')) ?>
  </div>
</form>

<div class="menu-extra">
  <?php echo link_to(__('add').' '.__('new').' '.__('archival description'), 'informationobject/create'); ?>
	<?php echo link_to(__('list').' '.__('all').' '.__('archival descriptions'), 'informationobject/list'); ?>
</div>
