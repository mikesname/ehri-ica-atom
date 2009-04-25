<?php use_helper('DateForm') ?>
<?php use_helper('Javascript') ?>

<div class="pageTitle"><?php echo __('edit MODS record'); ?></div>

  <?php if (isset($sf_request->id)): ?>
  <form method="post" action="<?php echo url_for(array('module' => 'informationobject', 'action' => 'edit', 'id' => $sf_request->id)) ?>" enctype="multipart/form-data" id="editForm">
  <?php else: ?>
    <form method="post" action="<?php echo url_for(array('module' => 'informationobject', 'action' => 'create')) ?>" enctype="multipart/form-data" id="editForm">
  <?php endif; ?>

  <?php echo input_hidden_tag('collection_type_id', QubitTerm::PUBLISHED_MATERIAL_ID) ?>

  <?php if ($label = QubitIsad::getLabel($informationObject, array())): ?>
    <div class="formHeader">
      <?php echo link_to($label, array('module' => 'informationobject', 'action' => 'show', 'id' => $informationObject->getId())) ?>
    </div>
  <?php else: ?>
    <table class="list" style="height: 25px;"><thead><tr><th>&nbsp;</th></tr></table>
  <?php endif; ?>

  <?php if ($sf_context->getActionName() == 'create'): ?>
  <fieldset class="collapsible">
  <?php else : ?>
  <fieldset class="collapsible collapsed">
  <?php endif; ?>
    <legend><?php echo __('DLF Aquifer Elements') ?></legend>

    <div class="form-item">
      <label for="title"><?php echo __('title'); ?></label>
      <?php if (strlen($sourceCultureValue = $informationObject->getTitle(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $informationObject->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_input_tag($informationObject, 'getTitle', array('size' => 20)) ?>
    </div>

    <div class="form-item">
      <label for="subtitle"><?php echo __('subtitle(s)'); ?></label>
      <table class="inline">
        <tr>
          <td class="headerCell" style="width: 65%;"><?php echo __('subtitle'); ?></td>
          <td class="headerCell" style="width: 30%"><?php echo __('type'); ?></td>
          <td class="headerCell" style="width: 5%;">&nbsp;</td>
        </tr>
        <?php if ($modsSubTitles): ?>
        <?php foreach ($modsSubTitles as $subtitle): ?>
        <tr>
          <td><?php echo $subtitle->getContent(array('cultureFallback' => 'true')) ?></td>
          <td><?php echo $subtitle->getType() ?></td>
          <td style="text-align: center;"><?php echo link_to(image_tag('delete', 'align=top'),
            array('module' => 'informationobject', 'action' => 'deleteNote', 'noteId' => $subtitle->getId(), 'returnTemplate' => 'mods')) ?></td>
        </tr>
        <?php endforeach; ?>
        <?php endif; ?>
        <tr valign="top">
          <td><?php echo input_tag('mods_subtitle')?></td>
          <td><?php echo select_tag('mods_subtitle_type', options_for_select($modsSubTitleTypes))?></td>
        </tr>
      </table>
    </div>

    <div class="form-item">
      <label for="name"><?php echo __('names'); ?></label>
      <?php if ($actorEvents): ?>
      <ul class="linked-object" id="name">
      <?php foreach ($actorEvents as $actorEvent): ?>
        <?php $eventType = $actorEvent->getType() ?>
        <li class="<?php echo 'related_obj_'.$actorEvent->getId() ?>">
          <div>
            <?php echo $actorEvent->getActor()->getAuthorizedFormOfName(array('cultureFallback' => 'true')) ?>
            <?php if(null !== $eventType && 0 < count($notes = $eventType->getNotesByType(QubitTerm::DISPLAY_NOTE_ID))): ?>
              (<?php echo $notes[0]->getContent() ?>)
            <?php endif; ?>
            <input type="checkbox" name="deleteEvents[<?php echo $actorEvent->getId() ?>]" value="delete" class="multiDelete" />
          </div>
        </li>
      <?php endforeach; ?>
      </ul>
      <?php endif; ?>

      <table id="newName" class="inline">
        <tr>
          <td class="headerCell""><?php echo __('name'); ?></td>
          <td class="headerCell"><i><?php echo __('or'); ?> </i><?php echo __('add new name'); ?></td>
          <td class="headerCell"><?php echo __('type')?></td>
        </tr>
        <tr>
          <td>
            <?php echo select_tag('addActor[actorId]', QubitActor::getOptionsForSelectList(QubitTerm::CREATION_ID,
              array('include_blank' => true, 'cultureFallback' => true))) ?>
          </td>
          <td><?php echo input_tag('addActor[newActorName]') ?></td>
          <td><?php echo select_tag('addActor[eventTypeId]', options_for_select($actorEventTypes, $defaultActorEventType))?></td>
        </tr>
      </table>
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
         <?php $deleteWarning = __('Warning: this MODS record has %1% descendants. If you proceed, these lower levels will also be deleted. Are you sure you want to delete this MODS record?', array ('%1%' => $descendantCount)) ?>
         &nbsp;<?php echo link_to(__('delete'), 'informationobject/delete?id='.$informationObject->getId(), 'post=true&confirm='.$deleteWarning) ?>
      <?php else: ?>
        <?php $deleteWarning = __('Are you sure you want to delete this MODS record permanently?'); ?>
        <?php if ($digitalObjectCount > 0): ?>
          <?php $deleteWarning .= ' '.__('This will also delete the related %1%.', array('%1%'=>sfConfig::get('app_ui_label_digitalobject'))); ?>
        <?php endif; ?>&nbsp;
        <?php echo link_to(__('delete'), array('module' => 'informationobject', 'action' => 'delete', 'id' => $informationObject->getId()),
          array('post' => true, 'confirm' => $deleteWarning)) ?>
      <?php endif; ?>
      &nbsp;<?php echo link_to(__('cancel'), array('module' => 'informationobject', 'action' => 'show', 'id' => $informationObject->getId())) ?>
    <?php else: ?>
      &nbsp;<?php echo link_to(__('cancel'), array('module' => 'informationobject', 'action' => 'list')) ?>
    <?php endif; ?>

    <?php if ($informationObject->getId()): ?>
      <?php echo submit_tag(__('save'), array('class' => 'form-submit')) ?>
    <?php else: ?>
      <?php echo submit_tag(__('create'), array('class' => 'form-submit')) ?>
    <?php endif; ?>
  </div>

  <div class="menu-extra">
    <?php echo link_to(__('add new'), array('module' => 'informationobject', 'action' => 'create')); ?>
    <?php echo link_to(__('list all'), array('module' => 'informationobject', 'action' => 'list')); ?>
  </div>
</div>

</form>
