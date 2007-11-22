<?php use_helper('DateForm') ?>

<b style="color: red;">MODS TEMPLATE</b>

<div class="pageTitle"><?php echo __('edit').' '.__('information object'); ?></div>

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

  <legend><?php echo __('title info'); ?></legend>

    <div class="form-item">
      <label for="title"><?php echo __('title'); ?></label>
      <?php echo object_input_tag($informationObject, 'getTitle', array('size' => 20)) ?>
    </div>

    <div class="form-item">
      <label for="alternate_title"><?php echo __('subtitle'); ?></label>
      <?php echo object_input_tag($informationObject, 'getAlternateTitle', array('size' => 20)) ?>
    </div>

  </fieldset>

  <fieldset class="collapsible collapsed">

	  <legend><?php echo __('origin info'); ?></legend>

    <div class="form-item">
      <label for="version"><?php echo __('edition'); ?></label>
      <?php echo object_input_tag($informationObject, 'getVersion', array('size' => 20)) ?>
    </div>

    <div class="form-item">
      <label for="newCreationDateNote"><?php echo __('creation date'); ?></label>
      <table class="inline">

        <tr><td class="headerCell"><?php echo __('creation year'); ?></td><td class="headerCell"><?php echo __('end year (if range)'); ?></td></tr>
        <tr><td><?php echo input_tag('creationYear', '', 'maxlength=4 style="width:35px;"') ?></td>
        <td><?php echo input_tag('endYear', '', 'maxlength=4 style="width:35px;"') ?></td></tr>
        <tr><td colspan="2" class="headerCell"><?php echo __('date display (defaults to date range)'); ?></td></tr>
        <tr><td colspan="2"><?php echo input_tag('newCreationDateNote') ?></td></tr>

<!--
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
-->
      </table>

    <div class="form-item">
      <label for="accruals"><?php echo __('frequency'); ?></label>
      <?php echo object_textarea_tag($informationObject, 'getAccruals', array('size' => '30x3')) ?>
    </div>

    </div>

  </fieldset>

  <fieldset class="collapsible collapsed">

	  <legend><?php echo __('physical description'); ?></legend>

    <div class="form-item">
      <label for="extent_and_medium"><?php echo __('extent'); ?></label>
      <?php echo object_textarea_tag($informationObject, 'getExtentAndMedium', array('size' => '30x3')) ?>
    </div>

  </fieldset>

  <fieldset class="collapsible collapsed">

	  <legend><?php echo __('name'); ?></legend>

    <div class="form-item">
      <label for="newCreationDateNote"><?php echo __('name part'); ?></label>
      <table class="inline">

         <tr><td class="headerCell" style="width: 40%;"><?php echo __('creator'); ?></td><td class="headerCell" style="width: 55%;"><i><?php echo __('or'); ?> </i><?php echo __('add').' '.__('new').' '.__('creator name'); ?></td><td class="headerCell" style="width: 5%;"></td></tr>
        <tr><td><?php echo object_select_tag($newCreationEvent, 'getActorId', array('related_class' => 'Actor', 'include_blank' => true, 'peer_method' => 'getActors')) ?>
        </td><td><?php echo input_tag('newActorAuthorizedName') ?></td><td>
        <?php echo submit_image_tag('add', 'class=submitAdd') ?></td></tr>

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


  </fieldset>

  <fieldset class="collapsible collapsed">

	  <legend><?php echo __('abstract'); ?></legend>

    <div class="form-item">
      <?php echo object_textarea_tag($informationObject, 'getScopeAndContent', array('size' => '30x3')) ?>
    </div>

  </fieldset>

  <fieldset class="collapsible collapsed">

	  <legend><?php echo __('access condition'); ?></legend>

    <div class="form-item">
      <label for="access_conditions"><?php echo __('restriction on access'); ?></label>
      <?php echo object_textarea_tag($informationObject, 'getAccessConditions', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="reproduction_conditions"><?php echo __('use and reproduction'); ?></label>
      <?php echo object_textarea_tag($informationObject, 'getReproductionConditions', array('size' => '30x3')) ?>
    </div>

  </fieldset>

  <fieldset class="collapsible collapsed">

	  <legend><?php echo __('language'); ?></legend>

    <div class="form-item">

      <?php foreach ($languages as $language): ?>
        <?php echo $language['termName'] ?>&nbsp;<?php echo link_to(image_tag('delete', 'align=top'), 'informationobject/deleteTermRelationship?TermRelationshipId='.$language['relationshipId']) ?><br/>
      <?php endforeach; ?>

      <?php echo object_select_tag($newLanguage, 'getTermId', array('name' => 'language_id', 'id' => 'language_id', 'include_blank' => true, 'peer_method' => 'getLanguages')) ?>
    </div>

  </fieldset>

  <fieldset class="collapsible collapsed">

	  <legend><?php echo __('related items'); ?></legend>

    <div class="form-item">
      <label for="location_of_originals"><?php echo __('originals'); ?></label>
      <?php echo object_textarea_tag($informationObject, 'getLocationOfOriginals', array('size' => '30x3')) ?>
    </div>

  </fieldset>

  <fieldset class="collapsible collapsed">
    <legend><?php echo __('notes'); ?></legend>

    <div class="form-item">
      <label for="note"><?php echo __('notes'); ?></label>
      <table class="inline">
      <tr>
        <td class="headerCell" style="width: 65%;"><?php echo __('note'); ?></td>
        <td class="headerCell" style="width: 5%;"></td>
        </tr>
        <?php foreach ($notes as $note): ?>
          <tr><td><?php echo nl2br($note['note']) ?><br/><span class="note"><?php echo $note['noteAuthor'] ?>, <?php echo $note['updated'] ?></span></td><td><?php echo $note['noteType'] ?></td><td style="text-align: center;"><?php echo link_to(image_tag('delete', 'align=top'), 'informationobject/deleteNote?noteId='.$note['noteId']) ?></td></tr>
        <?php endforeach; ?>
        <tr valign="top"><td>
        <?php echo object_textarea_tag($newNote, 'getNote', array('size' => '10x1',)) ?></td>
        <td style="text-align: center;"><?php echo submit_image_tag('add', 'class=submitAdd') ?></td>
      </tr></table>
    </div>

  </fieldset>

  <fieldset class="collapsible collapsed">
    <legend><?php echo __('subjects'); ?></legend>

    <div class="form-item">
      <label for="subject_id"><?php echo __('topics'); ?></label>

      <?php foreach ($subjectAccessPoints as $subject): ?>
        <?php echo $subject['termName'] ?>&nbsp;<?php echo link_to(image_tag('delete', 'align=top'), 'informationobject/deleteTermRelationship?TermRelationshipId='.$subject['relationshipId']) ?><br/>
      <?php endforeach; ?>

      <?php echo object_select_tag($newSubjectAccessPoint, 'getTermId', array('name' => 'subject_id', 'id' => 'subject_id', 'include_blank' => true, 'peer_method' => 'getSubjects')) ?>
    </div>

    <div class="form-item">
      <label for="people_id"><b style="color: red;">MORE TO GO HERE</b></th>
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
  <?php echo link_to(__('add').' '.__('new').' '.__('information object'), 'informationobject/create'); ?>
	<?php echo link_to(__('list').' '.__('all').' '.__('information objects'), 'informationobject/list'); ?>
</div>
