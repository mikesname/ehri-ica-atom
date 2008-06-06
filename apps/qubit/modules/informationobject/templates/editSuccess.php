<?php use_helper('DateForm') ?>
<?php use_helper('Javascript') ?>

<div class="pageTitle"><?php echo __('edit information object'); ?></div>

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
      <tr><td><?php echo $titleNote->getContent() ?>
      </td><td><?php echo $titleNote->getType() ?>
      </td><td style="text-align: center;"><?php echo link_to(image_tag('delete', 'align=top'), 'informationobject/deleteNote?noteId='.$titleNote->getId()) ?>
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
      <?php echo object_select_tag($informationObject, 'getLevelOfDescriptionId', array('related_class' => 'QubitTerm', 'include_blank' => true, 'peer_method' => 'getLevelsOfDescription')) ?>
    </div>

    <div class="form-item">
      <label for="parent_id"><?php echo __('next upper level of description'); ?></label>
      <?php echo object_select_tree($informationObject, 'getParentId', array('disabled' => $informationObject->getDescendants(array('index' => 'id')), 'include_blank' => true, 'peer_method' => 'getDescendants', 'related_class' => QubitInformationObject::getOne(QubitInformationObject::addRootsCriteria(new Criteria)))) ?>
    </div>

    <div class="form-item">
      <label for="extent_and_medium"><?php echo __('extent and medium'); ?></label>
      <?php echo object_textarea_tag($informationObject, 'getExtentAndMedium', array('size' => '30x3')) ?>
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
  <?php echo link_to(__('add new information object'), 'informationobject/create'); ?>
        <?php echo link_to(__('list all information objects'), 'informationobject/list'); ?>
</div>
