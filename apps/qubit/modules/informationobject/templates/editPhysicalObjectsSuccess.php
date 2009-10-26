<h1><?php echo __('Link physical storage') ?></h1>
<div class="headerCell"><?php if (0 < (strlen($label = $informationObject->getLabel()))): ?><?php echo $label ?><?php endif; ?></div>

<?php echo $form->renderFormTag(url_for(array('module' => 'informationobject', 'action' => 'editPhysicalObjects', 'id' => $informationObject->id))) ?>

<?php if(count($relations)): ?>

<div class="form-item">
<table class="inline" style="width: 98%;">
  <tr>
    <th colspan="2" style="width: 90%;"><?php echo __('containers') ?></th>
    <th style="width: 5%;"><?php echo image_tag('delete', array('align' => 'top', 'class' => 'deleteIcon')) ?></th>
  </tr>
<?php foreach($relations as $relation): ?>
  <?php $physicalObject = QubitPhysicalObject::getById($relation->getSubjectId()) ?>
  <tr class="<?php echo 'related_obj_'.$relation->getId() ?>">
    <td style="width: 90%"><div class="animateNicely">
      <?php if ($type = $physicalObject->getType()): ?><?php if (strlen($typeString = $type->__toString())): ?><?php echo $typeString.': ' ?><?php endif; ?><?php endif; ?>
      <b><?php echo $physicalObject->getName(array('cultureFallback' => 'true')) ?></b>
      <?php if ($location = $physicalObject->getLocation(array('cultureFallback' => 'true'))) echo ' - '.$location ?>     
    </div></td>
    <td style="width: 20px;"><div class="animateNicely">
      <?php echo link_to(image_tag('pencil', array('align' => 'top')), array('module' => 'physicalobject', 'action' => 'edit', 'id' => $physicalObject->id, 'next' => $sf_request->getUri())) ?>
    </div></td>
    <td style="width: 20px;"><div class="animateNicely">
      <input type="checkbox" name="delete_relations[<?php echo $relation->getId() ?>]" value="delete" class="multiDelete" />
    </div></td>
  </tr>
<?php endforeach; ?>
</table>
</div>
<?php endif; ?>


<table class="inline" style="width: 98%;">
  <tr>
    <td colspan="3" class="headerCell" style="width: 98%">
      <?php echo __('add container links (duplicate links will be ignored)') ?>
    </td>
  </tr>
</table>
<div class="form-item">
  <?php echo object_select_tag(null, null, 
    array('related_class'=>'QubitPhysicalObject', 'name'=>'physicalObjectId', 'include_blank'=>true, 'class'=>'multiInstance')) ?><br />
</div>


<table class="inline" style="width: 98%;">
  <tr>
    <td colspan="3" class="headerCell" style="width: 98%">
      <?php echo __('or, create a new container') ?>
    </td>
  </tr>
</table>

<div class="form-item">  
  <label for="physicalObjectName"><?php echo __('name') ?></label>
  <?php echo input_tag('physicalObjectName') ?>
</div>

<div class="form-item">  
  <label for="physicalObjectLocation"><?php echo __('location') ?></label>
  <?php echo input_tag('physicalObjectLocation') ?>
</div>

<div class="form-item">  
  <label for="physicalObjectType"><?php echo __('container type') ?></label>
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
    null, array('include_blank'=>true))) ?>
</div>

  <ul class="actions">
    <li><?php echo link_to(__('Cancel'), array('module' => 'informationobject', 'action' => 'show', 'id' => $informationObject->id)) ?></li>
    <li><?php echo submit_tag(__('Save')) ?></li>
  </ul>

</form>
