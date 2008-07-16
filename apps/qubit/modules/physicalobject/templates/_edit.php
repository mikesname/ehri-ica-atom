<?php if(count($relations)): ?>

<div class="form-item">
<table class="inline" style="width: 98%;">
  <tr>
    <td colspan="3" class="headerCell" style="width: 98%">
      <?php echo __('containers'); ?>
    </td>
  </tr>
<?php foreach($relations as $relation): ?>
  <?php $physicalObject = $relation->getSubject(); ?>
  <tr>
    <td style="width: 90%">
      <?php if (strlen($type = $physicalObject->getType())) echo $type.': '; ?>
      <b><?php echo $physicalObject->getName(array('cultureFallback' => 'true')); ?></b>
      <?php if ($location = $physicalObject->getLocation(array('cultureFallback' => 'true'))) echo ' - '.$location; ?>     
    </td>
    <?php if ($physicalObject): ?>
    <td style="width: 20px; border-top: 1px solid #cccccc;">
      <?php echo link_to(image_tag('pencil', 'align=top'), 
        array('module' => 'physicalobject', 'action' => 'edit', 'id' => $physicalObject->getId()), 
        array('query_string' => 'next='.url_for(array('module' => 'informationobject', 'action' => 'edit', 'id' => $informationObject->getId())))
      ) ?>
    </td>
    <td style="width: 20px; border-top: 1px solid #cccccc;">
      <?php echo link_to(image_tag('delete', 'align=top'),
        array('module' => 'relation', 'action' => 'delete', 'id' => $relation->getId()), 
        array('query_string' => 'next='.url_for(array('module' => 'informationobject', 'action' => 'edit', 'id' => $informationObject->getId())))
      ) ?>
    </td>
    <?php else: ?>
    <td colspan="2">&nbsp;</td>
    <?php endif; ?>
  </tr>
<?php endforeach; ?>
</table>
</div>
<?php endif; ?>


<table class="inline" style="width: 98%;">
  <tr>
    <td colspan="3" class="headerCell" style="width: 98%">
      <?php echo __('link to an existing container'); ?>
    </td>
  </tr>
</table>
<div class="form-item">
  <?php echo object_select_tag(null, null, 
    array('related_class'=>'QubitPhysicalObject', 'name'=>'physicalObjectId', 'include_blank'=>true)); ?><br />
</div>


<table class="inline" style="width: 98%;">
  <tr>
    <td colspan="3" class="headerCell" style="width: 98%">
      <?php echo __('or, create a new container'); ?>
    </td>
  </tr>
</table>

<div class="form-item">  
  <label for="physicalObjectName"><?php echo __('name'); ?></label>
  <?php echo input_tag('physicalObjectName'); ?>
</div>

<div class="form-item">  
  <label for="physicalObjectLocation"><?php echo __('location'); ?></label>
  <?php echo input_tag('physicalObjectLocation'); ?>
</div>

<div class="form-item">  
  <label for="physicalObjectType"><?php echo __('container type'); ?></label>
  <?php 
    /* Disable fancy multi-level drop-down widget until display code is fixed to 
     * allow multiple instances per form. 
     echo object_select_tree($physicalObject, 'getId', array(
    'include_blank' => true,
    'peer_method' => 'getPhysicalObjectContainerTypes',
    'related_class' => 'QubitTerm',
    'name' => 'physicalObjectContainerId'
  )); */ ?>
  <?php echo select_tag('physicalObjectTypeId', 
    options_for_select(QubitTerm::getIndentedChildTree(QubitTerm::CONTAINER_ID), 
    null, array('include_blank'=>true))); ?>
</div>
