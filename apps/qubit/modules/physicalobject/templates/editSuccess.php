<?php use_helper('Javascript') ?>

<div class="pageTitle"><?php echo __('edit %1%', array('%1%' => sfConfig::get('app_ui_label_physicalobject'))); ?></div>

<?php echo form_tag('physicalobject/update') ?>
  <?php echo object_input_hidden_tag($physicalObject, 'getId'); ?>
  <?php echo input_hidden_tag('next', $nextAction) ?>
  
  <div class="formHeader">
    <?php echo $physicalObject->getName(); ?>
  </div>
 
  <fieldset class="collapsible"> 
    <legend><?php echo __('container'); ?></legend>

    <div class="form-item">
      <label for="name"><?php echo __('name'); ?></label>
      <?php echo object_input_tag($physicalObject, 'getName'); ?>
    </div>

    <div class="form-item">
      <label for="location"><?php echo __('location'); ?></label>
      <?php echo object_input_tag($physicalObject, 'getLocation'); ?>
    </div>
    
    <div class="form-item">
      <label for="type"><?php echo __('type'); ?></label>
      <?php echo select_tag('typeId', 
        options_for_select(QubitTerm::getIndentedChildTree(QubitTerm::CONTAINER_ID), $physicalObject->getTypeId())); ?>
    </div> 
  </fieldset>
  
  <!-- include empty div at bottom of form to bump the fixed button-block and allow user to scroll past it -->
  <div id="button-block-bump" />
  
  <div id="button-block">  
    <div class="menu-action">
        
        <?php if($nextAction == null): ?>
          &nbsp;<?php echo link_to(__('delete'), 'physicalobject/delete?id='.$physicalObject->getId(), 'post=true&confirm='.__('are you sure?')) ?>
          &nbsp;<?php echo link_to(__('cancel'), 'physicalobject/show?id='.$physicalObject->getId()); ?>
        <?php else: ?>
          &nbsp;<?php echo link_to(__('delete'), 
                  'physicalobject/delete?id='.$physicalObject->getId().'&next='.urlencode($nextAction),
                  array('confirm'=>__('are you sure?'))); ?>
          &nbsp;<?php echo link_to(__('cancel'), $nextAction); ?>
        <?php endif; ?>
        
        &nbsp;<?php echo my_submit_tag(__('save'), array('style' => 'width: auto;')) ?>
    </div>
  </div>
</form>