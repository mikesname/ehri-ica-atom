<?php use_helper('Javascript') ?>

<div class="pageTitle"><?php echo __('edit %1%', array('%1%' => sfConfig::get('app_ui_label_actor'))) ?></div>

<?php echo form_tag('actor/update') ?>
  <?php echo object_input_hidden_tag($actor, 'getId') ?>
  <?php echo input_hidden_tag('repositoryReroute', $repositoryReroute) ?>
  <?php echo input_hidden_tag('informationObjectReroute', $informationObjectReroute) ?>

  <?php if ($actor->getAuthorizedFormOfName(array('sourceCulture' => true))): ?>
    <div class="formHeader">
      <?php echo link_to($actor, 'actor/show?id='.$actor->getId()) ?>
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

  <div class="form-item">
    <label for="authorized_form_of_name"><?php echo __('authorized form of name'); ?></label>
    <?php echo object_input_tag($actor, 'getAuthorizedFormOfName', array('size' => 20)) ?>
  </div>

  <div class="form-item">
    <label for="type_of_entity"><?php echo __('type of entity'); ?></label>
    <?php echo object_select_tag($actor, 'getEntityTypeId', array('related_class' => 'QubitTerm', 'include_blank' => true, 'peer_method' => 'getActorEntityTypes')) ?>
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
          <td style="text-align: center;"><?php echo link_to(image_tag('delete', 'align=top'), 'actor/deleteOtherName?otherNameId='.$otherName->getId()) ?></td></tr>
        <?php endforeach; ?>
      <?php endif; ?>
      <tr><td>
      <?php echo object_input_tag($newName, 'getName', array('size' => 10)) ?></td><td>
      <?php echo object_select_tag($newName, 'getTypeId', array('name' => 'type_id', 'id' => 'type_id', 'related_class' => 'QubitTerm', 'include_blank' => true, 'peer_method' => 'getActorNameTypes', 'style' => 'width: 95px;')) ?>
      </td><td>
      <?php echo object_input_tag($newName, 'getNote', array('size' => 10)) ?></td>
      </tr>
    </table>
  </div>

  <div class="form-item">
    <label for="identifiers"><?php echo __('identifiers for corporate bodies'); ?></label>
    <?php echo object_input_tag($actor, 'getCorporateBodyIdentifiers', array('size' => 20)) ?>
  </div>

  </fieldset>

  <fieldset class="collapsible collapsed">
    <legend><?php echo __('description area'); ?></legend>

    <div class="form-item">
      <?php if ($date) : ?>
        <?php echo input_hidden_tag('dateId', $date->getId()); ?>
      <?php endif; ?>
      <label for="dates_of_existence"><?php echo __('dates of existence'); ?></label>
        <table class="inline"><tr><td class="headerCell" align="center">
          <?php echo __('year'); ?></td><td class="headerCell" align="center"><?php echo __('end year <br />(if range)'); ?></td>
          <td class="headerCell" style="width: 125px;">
          <?php echo __('date display <br />(defaults to date range)'); ?> </td></tr>
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
      <?php echo object_textarea_tag($actor, 'getPlaces', array('size' => '30x3')) ?>
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
    <legend><?php echo __('relationships area'); ?></legend>

  </fieldset>

  <fieldset class="collapsible collapsed">
    <legend><?php echo __('control area'); ?></legend>

    <div class="form-item">
      <label for="description_identifier"><?php echo __('authority record identifier'); ?></label>
      <?php echo object_input_tag($actor, 'getDescriptionIdentifier', array('size' => 20)) ?>
    </div>

    <div class="form-item">
      <label for="institution_identifier"><?php echo __('institution identifier'); ?></label>
      <?php echo object_input_tag($actor, 'getInstitutionResponsibleIdentifier', array('size' => 20)) ?>
    </div>

    <div class="form-item">
      <label for="rules"><?php echo __('rules or conventions'); ?></label>
      <?php echo object_textarea_tag($actor, 'getRules', array('size' => '30x3')) ?>
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
      <?php echo object_textarea_tag($actor, 'getRevisionHistory', array('size' => '30x3')) ?>
    <div>

    <div class="form-item">
      <label for="language_code"><?php echo __('languages of authority record'); ?></label>

      <?php foreach ($languageCodes as $languageCode): ?>
        <div style="margin-top: 5px; margin-bottom: 5px;">
        <?php echo format_language($languageCode->getValue()) ?>&nbsp;<?php echo link_to(image_tag('delete', 'align=top'), 'actor/deleteProperty?Id='.$languageCode->getId()) ?><br/>
        </div>
      <?php endforeach; ?>

      <?php echo select_language_tag('language_code', null, array('include_blank' => true)) ?>
     </div>

    <div class="form-item">
      <label for="script_id"><?php echo __('scripts of authority record'); ?></label>

      <?php foreach ($scriptCodes as $scriptCode): ?>
        <div style="margin-top: 5px; margin-bottom: 5px;">
        <?php echo format_script($scriptCode->getValue()) ?>&nbsp;<?php echo link_to(image_tag('delete', 'align=top'), 'actor/deleteProperty?Id='.$scriptCode->getId()) ?><br/>
        </div>
      <?php endforeach; ?>

      <?php echo select_script_tag('script_code', null, array('include_blank' => true)) ?>
    </div>

    <div class="form-id">
      <label for="sources"><?php echo __('sources'); ?></label>
      <?php echo object_textarea_tag($actor, 'getSources', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="notes"><?php echo __('notes'); ?></label>
      <table class="inline">
        <tr>
          <td class="headerCell" style="width: 65%;"><?php echo __('note'); ?></td>
          <td class="headerCell" style="width: 30%"><?php echo __('note type'); ?></td>
          <td class="headerCell" style="width: 5%;"></td>
        </tr>

        <?php foreach ($notes as $note): ?>
          <tr>
          <td><?php echo $note->getContent() ?><br/><span class="note"><?php echo $note->getUser() ?>, <?php echo $note->getUpdatedAt() ?></span></td>
          <td><?php echo $note->getType() ?></td>
          <td style="text-align: center;"><?php echo link_to(image_tag('delete', 'align=top'), 'actor/deleteNote?noteId='.$note->getId()) ?></td>
          </tr>
        <?php endforeach; ?>

        <tr valign="top">
          <td><?php echo object_textarea_tag($newNote, 'getContent', array('size' => '10x1')) ?></td>
          <td><?php echo object_select_tag($newNote, 'getTypeId', array('name' => 'note_type_id', 'id' => 'note_type_id', 'related_class' => 'QubitTerm', 'include_blank' => true, 'peer_method' => 'getNoteTypes', 'style' => 'width: 120px;')) ?></td>
        </tr>
      </table>
    </div>

  </fieldset>

  <?php if ($sf_context->getActionName() == 'create'): ?>
  <!--set initial form focus -->
  <?php echo javascript_tag(<<<EOF
  $('[name=authorized_form_of_name]').focus();
EOF
  ) ?>
  <?php endif; ?>
  
  
<!-- include empty div at bottom of form to bump the fixed button-block and allow user to scroll past it -->
<div id="button-block-bump"></div>

<div id="button-block">
  <div class="menu-action">
    <?php if ($actor->getId()): ?>
      &nbsp;<?php echo link_to(__('delete'), 'actor/delete?id='.$actor->getId(), 'post=true&confirm='.__('are you sure?')) ?>
      &nbsp;<?php echo link_to(__('cancel'), 'actor/show?id='.$actor->getId()) ?>
    <?php else: ?>
      &nbsp;<?php echo link_to(__('cancel'), 'actor/list') ?>
    <?php endif; ?>
    <?php if ($actor->getId()): ?>
      <?php echo my_submit_tag(__('save'), array('style' => 'width: auto;')) ?>
    <?php else: ?>
      <?php echo my_submit_tag(__('create'), array('style' => 'width: auto;')) ?>
    <?php endif; ?>
  </div>
</form>

<div class="menu-extra">
  <?php echo link_to(__('add new %1%', array('%1%' => sfConfig::get('app_ui_label_actor'))), 'actor/create'); ?>
  <?php echo link_to(__('list all %1%', array('%1%' => sfConfig::get('app_ui_label_actor'))), 'actor/list'); ?>
</div>

</div>
