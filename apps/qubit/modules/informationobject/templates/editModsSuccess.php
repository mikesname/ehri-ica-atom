<?php use_helper('DateForm') ?>
<?php use_helper('Javascript') ?>

<div class="pageTitle"><?php echo __('edit MODS record'); ?></div>

<?php echo form_tag('informationobject/updateIsad', array('multipart' => 'true', 'id'=>'editForm')) ?>
  <?php echo object_input_hidden_tag($informationObject, 'getId') ?>
  <?php echo input_hidden_tag('collection_type_id', QubitTerm::PUBLISHED_MATERIAL_ID) ?>

  <?php if ($label = QubitIsad::getLabel($informationObject, array())): ?>
    <div class="formHeader">
      <?php echo link_to($label, 'informationobject/showMods/?id='.$informationObject->getId()) ?>
    </div>
  <?php else: ?>
    <table class="list" style="height: 25px;"><thead><tr><th></th></tr></table>
  <?php endif; ?>

  <?php if ($sf_context->getActionName() == 'create'): ?>
  <fieldset class="collapsible">
  <?php else : ?>
  <fieldset class="collapsible collapsed">
  <?php endif; ?>


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
      <?php endif; ?>
      &nbsp;<?php echo link_to(__('delete'), 'informationobject/delete?id='.$informationObject->getId(), 'post=true&confirm='.$deleteWarning) ?>
      <?php endif; ?>

       &nbsp;<?php echo link_to(__('cancel'), 'informationobject/showMods?id='.$informationObject->getId()) ?>
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
  <?php echo link_to(__('add new'), 'informationobject/createMods'); ?>
  <?php echo link_to(__('list all'), 'informationobject/list'); ?>
</div>
</div>
