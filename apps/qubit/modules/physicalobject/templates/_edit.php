<?php if($physicalObject->getId()): ?>
<div class="form-item">
<table class="inline" style="width: 98%;">
  <tr>
    <td colspan="3" class="headerCell" style="width: 98%">
      <?php echo __('current container'); ?>
    </td>
  </tr>
  <tr>
    <td style="width: 90%">
      <b><?php echo __('name'); ?>:</b> <?php echo $physicalObject->getName(); ?><br />
      <b><?php echo __('location'); ?>:</b> <?php echo $physicalObject->getLocation(); ?><br />
      <b><?php echo __('type'); ?>:</b> <?php echo $physicalObject->getType(); ?>
    </td>
    <?php if ($physicalObject): ?>
    <td style="width: 20px; border-top: 1px solid #cccccc;">
      <?php echo link_to(image_tag('pencil', 'align=top'), 'physicalobject/edit?id='.$physicalObject->getId().'&next=informationobject%2Fedit%3Fid%3D'.$informationObject->getId()); ?>
    </td>
    <td style="width: 20px; border-top: 1px solid #cccccc;">
      <?php echo link_to(image_tag('delete', 'align=top'), 'physicalobject/delete?id='.$physicalObject->getId()); ?>
    </td>
    <?php else: ?>
    <td colspan="2">&nbsp;</td>
    <?php endif; ?>
  </tr>
</table>
</div>
<?php endif; ?>

<div class="form-item">
<table class="inline" style="width: 98%;">
  <tr>
    <td colspan="3" class="headerCell" style="width: 98%">
      <?php echo __('select an existing container'); ?>
    </td>
  </tr>
  <tr>
    <td style="width: 90%">
      <?php echo object_select_tag($physicalObject, 'getId', 
        array('related_class'=>'QubitPhysicalObject', 'name'=>'physicalObjectId')); ?><br />
    </td>
  </tr>
</table>
</div>

<div class="form-item">
<table class="inline" style="width: 98%;">
  <tr>
    <td colspan="2" class="headerCell"><?php echo __('create new container'); ?></td>
  </tr>
  <tr>
    <td class="headerCell" style="width: 25%;"><?php echo __('name'); ?></td>
    <td><?php echo input_tag('physicalObjectName'); ?></td>
  </tr>
  <tr>
    <td class="headerCell" style="width: 25%;"><?php echo __('location'); ?></td>
    <td>
      <?php echo input_tag('physicalObjectLocation'); ?>
    </td>
  </tr>
  <tr>
    <td class="headerCell" style="width: 25%;"><?php echo __('container type'); ?></td>
    <td>
      <?php /* Disable fancy multi-level drop-down widget until display code is fixed to 
             * allow multiple instances per form. 
         echo object_select_tree($physicalObject, 'getId', array(
        'include_blank' => true,
        'peer_method' => 'getPhysicalObjectContainerTypes',
        'related_class' => 'QubitTerm',
        'name' => 'physicalObjectContainerId'
      )); */ ?>
      <?php echo select_tag('physicalObjectContainerId', options_for_select(QubitTerm::getIndentedChildTree(QubitTerm::CONTAINER_ID))) ?>
    </td>
  </tr>
</table>
</div>