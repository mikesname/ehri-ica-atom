<?php use_helper('Javascript') ?>

<div class="pageTitle"><?php echo __('edit %1% - ISAAR', array('%1%' => sfConfig::get('app_ui_label_actor'))) ?></div>

<?php if (isset($sf_request->id)): ?>
  <?php echo form_tag(array('module' => 'actor', 'action' => 'edit', 'id' => $sf_request->id)) ?>
<?php else: ?>
  <?php echo form_tag(array('module' => 'actor', 'action' => 'create')) ?>
<?php endif; ?>
  <?php echo input_hidden_tag('repositoryReroute', $repositoryReroute) ?>
  <?php echo input_hidden_tag('informationObjectReroute', $informationObjectReroute) ?>

  <?php if ($actor->getAuthorizedFormOfName(array('sourceCulture' => true))): ?>
    <div class="formHeader">
      <?php echo link_to($actor, array('module' => 'actor', 'action' => 'show', 'id' => $actor->getId())) ?>
    </div>
  <?php else: ?>
    <table class="list" style="height: 25px;"><thead><tr><th></th></tr></table>
  <?php endif; ?>

  <?php if ($sf_context->getActionName() == 'createIsaar'): ?>
  <fieldset class="collapsible">
  <?php else : ?>
  <fieldset class="collapsible collapsed">
  <?php endif; ?>

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

  <fieldset class="collapsible collapsed">
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
    <div>

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
      <label for="notes"><?php echo __('notes'); ?></label>
      <table class="inline">
        <tr>
          <td class="headerCell" style="width: 65%;"><?php echo __('note'); ?></td>
          <td class="headerCell" style="width: 30%"><?php echo __('note type'); ?></td>
          <td class="headerCell" style="width: 5%;"></td>
        </tr>

        <?php if (count($notes) > 0): ?>
        <?php foreach ($notes as $note): ?>
          <tr>
          <td><?php echo $note->getContent(array('cultureFallback' => true)) ?><br/><span class="note"><?php echo $note->getUser() ?>, <?php echo $note->getUpdatedAt() ?></span></td>
          <td><?php echo $note->getType() ?></td>
          <td style="text-align: center;"><?php echo link_to(image_tag('delete', 'align=top'), array('module' => 'actor', 'action' => 'deleteNote', 'noteId' => $note->getId(), 'returnTemplate' => 'isaar')) ?></td>
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
      &nbsp;<?php echo link_to(__('delete'), array('module' => 'actor', 'action' => 'delete', 'id' => $actor->getId()), array('post' => true, 'confirm' => __('are you sure?'))) ?>
      &nbsp;<?php echo link_to(__('cancel'), array('module' => 'actor', 'action' => 'show', 'id' => $actor->getId())) ?>
    <?php else: ?>
      &nbsp;<?php echo link_to(__('cancel'), array('module' => 'actor', 'action' => 'list')) ?>
    <?php endif; ?>
    <?php if ($actor->getId()): ?>
      <?php echo submit_tag(__('save'), array('class' => 'form-submit')) ?>
    <?php else: ?>
      <?php echo submit_tag(__('create'), array('class' => 'form-submit')) ?>
    <?php endif; ?>
  </div>
</form>

<div class="menu-extra">
  <?php echo link_to(__('add new'), array('module' => 'actor', 'action' => 'create')) ?>
  <?php echo link_to(__('list all'), array('module' => 'actor', 'action' => 'list')) ?>
</div>

</div>
