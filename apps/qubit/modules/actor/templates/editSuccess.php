<div class="pageTitle"><?php echo __('edit').' '.__('authority file'); ?></div>

<?php echo form_tag('actor/update') ?>
  <?php echo object_input_hidden_tag($actor, 'getId') ?>

  <?php if ($repositoryReroute): ?>
    <?php echo input_hidden_tag('repositoryReroute', $repositoryReroute) ?>
  <?php endif; ?>
  <?php if ($informationObjectReroute): ?>
    <?php echo input_hidden_tag('informationObjectReroute', $informationObjectReroute) ?>
  <?php endif; ?>

  <?php if ($actor->getAuthorizedFormOfName()): ?>
    <div class="formHeader">
      <?php echo link_to($actor, 'actor/show?id='.$actor->getId()) ?>
    </div>
  <?php endif; ?>

  <?php if ($sf_context->getActionName() == 'create'): ?>
  <fieldset class="collapsible">
  <?php else : ?>
  <fieldset class="collapsible collapsed">
  <?php endif; ?>

  <legend><?php echo __('identity area'); ?></legend>

    <div class="form-item">
      <label for="authorized_form_of_name"><?php echo __('authorized form of name'); ?></label>
      <?php echo object_input_tag($actor, 'getAuthorizedFormOfName', array('size' => 20)) ?>
    </div>

    <div class="form-item">
      <label for="type_of_entity"><?php echo __('type of entity'); ?></label>
      <?php echo object_select_tag($actor, 'getTypeOfEntityId', array('related_class' => 'Term', 'include_blank' => true, 'peer_method' => 'getAuthorityFileEntityTypes')) ?>
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
        <tr><td><?php echo $otherName['name'] ?></td><td><?php echo $otherName['nameType'] ?></td>
        <td><?php echo $otherName['note'] ?></td>
        <td style="text-align: center;"><?php echo link_to(image_tag('delete', 'align=top'), 'actor/deleteOtherName?otherNameId='.$otherName['id']) ?></td></tr>
      <?php endforeach; ?>
    <?php endif; ?>

      <tr><td>
        <?php echo object_input_tag($newName, 'getName', array('size' => 10)) ?></td><td>
        <?php echo object_select_tag($newName, 'getNameTypeId', array('name' => 'name_type_id', 'id' => 'name_type_id', 'related_class' => 'Term', 'include_blank' => true, 'peer_method' => 'getActorNameTypes', 'style' => 'width: 95px;')) ?>
      </td><td>
      <?php echo object_input_tag($newName, 'getNameNote', array('size' => 10)) ?></td>
      <td style="text-align: center;"><?php echo submit_image_tag('add', 'class=submitAdd') ?></td>
      </tr></table>
    </div>

    <div class="form-item">
      <label for="identifiers"><?php echo __('identifiers for corporate bodies'); ?></label>
      <?php echo object_input_tag($actor, 'getIdentifiers', array('size' => 20)) ?>
    </div>
  </fieldset>

  <fieldset class="collapsible collapsed">
    <legend><?php echo __('description area'); ?></legend>

    <div class="form-item">
      <?php if ($date) : ?>
        <?php echo input_hidden_tag('dateId', $date->getId()); ?>
      <?php endif; ?>
      <label for="dates_of_existence"><?php echo __('dates of existence'); ?></label>
 <table class="inline"><tr><td class="headerCell">
    <?php echo __('start year'); ?></td><td class="headerCell"><?php echo __('end year (if range)'); ?></td>
      <td class="headerCell" style="width: 125px;">
      <?php echo __('date display (defaults to date range)'); ?> </td></tr>
     <tr><td><?php echo object_input_tag($date, 'getStartDate', array('maxlength' => 4, 'style' => 'width: 35px;')) ?></td>
        <td><?php echo object_input_tag($date, 'getEndDate',  array('maxlength' => 4, 'style' => 'width: 35px;')) ?></td>
        <td><?php echo object_input_tag($date, 'getDescription') ?></td></tr>
      </table>

    </div>

    <div class="form-item">
      <label for="history"><?php echo __('history'); ?></label>
      <?php echo object_textarea_tag($actor, 'getHistory', array('size' => '30x10')) ?>
    </div>

    <div class="form-item">
      <label for="places"><?php echo __('places'); ?></label>
    </div>

    <div class="form-item">
      <label for="legal_status"><?php echo __('legal status'); ?></label>
      <?php echo object_textarea_tag($actor, 'getLegalStatus', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="functions"><?php echo __('functions, occupations and activities'); ?></label>
      <?php echo object_textarea_tag($actor, 'getFunctions', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="mandates"><?php echo __('mandates or sources of authority'); ?></label>
      <?php echo object_textarea_tag($actor, 'getMandates', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="internal_structures"><?php echo __('internal structures or genealogy'); ?></label>
      <?php echo object_textarea_tag($actor, 'getInternalStructures', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="general_context"><?php echo __('general context'); ?></label>
      <?php echo object_textarea_tag($actor, 'getGeneralContext', array('size' => '30x3')) ?>
    </div>
  </fieldset>

  <fieldset class="collapsible collapsed">
    <legend><?php echo __('relationship area'); ?></legend>

    <div class="form-item">
      <label for="relationships"><?php echo __('relationships'); ?></label>
    </div>
  </fieldset>

  <fieldset class="collapsible collapsed">
    <legend><?php echo __('control area'); ?></legend>

    <div class="form-item">
      <label for="authority_record_identifier"><?php echo __('authority record identifier'); ?></label>
      <?php echo object_input_tag($actor, 'getAuthorityRecordIdentifier', array('size' => 20)) ?>
    </div>

    <div class="form-item">
      <label for="institution_identifier"><?php echo __('institution identifier'); ?></label>
      <?php echo object_input_tag($actor, 'getInstitutionIdentifier', array('size' => 20)) ?>
    </div>

    <div class="form-item">
      <label for="rules"><?php echo __('rules or conventions'); ?></label>
      <?php echo object_textarea_tag($actor, 'getRules', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="status_id"><?php echo __('status'); ?></label>
      <?php echo object_select_tag($actor, 'getStatusId', array('related_class' => 'Term', 'include_blank' => true, 'peer_method' => 'getAuthorityFileStatus')) ?>
    </div>

    <div class="form-item">
      <label for="level_of_detail_id"><?php echo __('level of detail'); ?></label>
      <?php echo object_select_tag($actor, 'getLevelOfDetailId', array('related_class' => 'Term', 'include_blank' => true, 'peer_method' => 'getAuthorityFileDetail')) ?>
    </div>

    <div class="form-item">
      <label for="dates"><?php echo __('dates of creation, revision and deletion'); ?></label>
    <div>

    <div class="form-item">
      <label for="language_id"><?php echo __('languages of authority record'); ?></label>
      <?php foreach ($languages as $language): ?>
        <?php echo $language['termName'] ?>&nbsp;<?php echo link_to(image_tag('delete', 'align=top'), 'actor/deleteTermRelationship?TermRelationshipId='.$language['relationshipId']) ?><br/>
      <?php endforeach; ?>

      <?php echo object_select_tag($newLanguage, 'getTermId', array('name' => 'language_id', 'id' => 'language_id', 'include_blank' => true, 'peer_method' => 'getLanguages')) ?>
    </div>

    <div class="form-item">
      <label for="script_id"><?php echo __('scripts of authority record'); ?></label>
      <?php foreach ($scripts as $script): ?>
        <?php echo $script['termName'] ?>&nbsp;<?php echo link_to(image_tag('delete', 'align=top'), 'actor/deleteTermRelationship?TermRelationshipId='.$script['relationshipId']) ?><br/>
      <?php endforeach; ?>

      <?php echo object_select_tag($newScript, 'getTermId', array('name' => 'script_id', 'id' => 'script_id', 'include_blank' => true, 'peer_method' => 'getScripts')) ?>
    </div>

    <div class="form-id">
      <label for="sources"><?php echo __('sources'); ?></label>
      <?php echo object_textarea_tag($actor, 'getSources', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="notes"><?php echo __('notes'); ?></label>
      <table class="inline">
        <tr><td class="headerCell" style="width: 65%;"><?php echo __('note'); ?></td><td class="headerCell" style="width: 30%"><?php echo __('note type'); ?></td><td class="headerCell" style="width: 5%;"></td></tr>

        <?php foreach ($notes as $note): ?>
          <tr><td><?php $note['note'] ?><br/><span class="note"><?php $note['noteAuthor'] ?>, <?php $note['updated'] ?></span></td><td><?php $note['noteType'] ?></td><td style="text-align: center;"><?php link_to(image_tag('delete', 'align=top'), 'actor/deleteNote?noteId='.$note['noteId']) ?></td></tr>
        <?php endforeach; ?>
        <tr valign="top">
          <td><?php echo object_textarea_tag($newNote, 'getNote', array('size' => '10x1')) ?></td>
          <td><?php echo object_select_tag($newNote, 'getNoteTypeId', array('name' => 'note_type_id', 'id' => 'note_type_id', 'related_class' => 'Term', 'include_blank' => true, 'peer_method' => 'getNoteTypes', 'style' => 'width: 120px;')) ?></td>
          <td style="text-align: center;"><?php echo submit_image_tag('add', 'class=submitAdd') ?></td>
        </tr>
      </table>
    </div>
  </fieldset>

  <div class="menu-action">
    <?php if ($actor->getId()): ?>
      &nbsp;<?php echo link_to(__('delete'), 'actor/delete?id='.$actor->getId(), 'post=true&confirm='.__('are you sure?')) ?>
      &nbsp;<?php echo link_to(__('cancel'), 'actor/show?id='.$actor->getId()) ?>
    <?php else: ?>
      &nbsp;<?php echo link_to(__('cancel'), 'actor/create') ?>
    <?php endif; ?>
    <?php echo my_submit_tag(__('save'), array('style' => 'width: auto;')) ?>
  </div>
</form>

<div class="menu-extra">
	<?php echo link_to(__('add').' '.__('new').' '.__('authority file'), 'actor/create'); ?>
	<?php echo link_to(__('list').' '.__('all').' '.__('authority files'), 'actor/list'); ?>
</div>
