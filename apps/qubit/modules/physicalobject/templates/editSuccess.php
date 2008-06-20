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
        options_for_select(QubitTerm::getIndentedChildTree(QubitTerm::CONTAINER_ID), 
        $physicalObject->getTypeId(),
        array('include_blank'=>true))
      ); ?>
    </div> 
  </fieldset>
  
  <?php if ($relatedInfoObjectCount > 0): ?>
  <fieldset class="collapsible"> 
    <legend><?php echo __('contains', array('%1%'=>sfConfig::get('app_ui_label_informationobject'))); ?></legend>
    
    <div class="form-item">
    <table class="inline">
      <thead><td class="headerCell"><span class="capitalize"><?php echo __('title'); ?></span></thead>
    <?php foreach ($relatedInfoObjects as $informationObject): ?>
      <tr>
        <td><?php echo link_to($informationObject->getLabel(), 'informationobject/show?id='.$informationObject->getId()); ?></td>
      </tr>
    <?php endforeach; ?>
    </table>
    </div>
  </fieldset>
  <?php endif; ?>
  
  <!-- include empty div at bottom of form to bump the fixed button-block and allow user to scroll past it -->
  <div id="button-block-bump" />
  
  <div id="button-block">  
    <div class="menu-action">
        <?php if ($relatedInfoObjectCount == 0): ?>
          <?php $deleteWarning = __('are you sure?') ?>
        <?php elseif ($relatedInfoObjectCount == 1): ?>
          <?php $deleteWarning = __('There is 1 %1% related to this item.  Are you sure you wish proceed with delete?',
            array('%1%'=>sfConfig::get('app_ui_label_informationobject'))) ?>
        <?php else: ?>
          <?php $deleteWarning = __('There are %1% %2%s related to this item.  Are you sure you wish to proceed with delete?',
            array(
              '%1%'=>$relatedInfoObjectCount,
              '%2%'=>sfConfig::get('app_ui_label_informationobject')
          )) ?>
        <?php endif; ?>
        
        <?php if($nextAction == null): ?>
          &nbsp;<?php echo link_to(__('delete'), 'physicalobject/delete?id='.$physicalObject->getId(), 'post=true&confirm='.$deleteWarning) ?>
          &nbsp;<?php echo link_to(__('cancel'), 'physicalobject/show?id='.$physicalObject->getId()); ?>
        <?php else: ?>
          &nbsp;<?php echo link_to(__('delete'), 
                  'physicalobject/delete?id='.$physicalObject->getId().'&next='.urlencode($nextAction),
                  array('confirm'=>$deleteWarning)); ?>
          &nbsp;<?php echo link_to(__('cancel'), $nextAction); ?>
        <?php endif; ?>
        
        &nbsp;<?php echo my_submit_tag(__('save'), array('style' => 'width: auto;')) ?>
    </div>
  </div>
</form>