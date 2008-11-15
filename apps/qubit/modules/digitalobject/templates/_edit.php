<?php if (count($digitalObject)): ?>
  <div class="form-item">
    <label for="mediatype"><?php echo __('media type'); ?></label>
    <?php echo object_select_tag($digitalObject, 'getMediaTypeId',
      array('related_class' => 'QubitTerm', 'peer_method' => 'getMediaTypes'
      )) ?>
  </div>

  <!-- Display/edit digital object representations -->
  <?php foreach ($representations as $usageId => $representation): ?>
  <?php if (is_object($representation) && $representation->getId()): ?>
  <?php include_component('digitalobject', 'editRepresentation',
    array('digitalObject'=>$digitalObject, 'representation'=>$representation)); ?>
  <?php else: ?>
  <div class="form-item">
    <label for="upload"><?php echo __('Add a new %1% representation', array('%1%'=>QubitTerm::getById($usageId))); ?></label>
    <table class="inline">
    <tr>
      <td width="60%">
        <?php include_component('digitalobject', 'upload', array('usageId'=>$usageId)); ?>
        <?php if ($digitalObject->canThumbnail()): ?>
        <br/><?php echo __('or'); ?>
        <?php echo checkbox_tag('createDerivative', $usageId, false, array('class'=>'checkbox')); ?>
        <?php echo __('auto-generate'); ?>
        <?php endif; ?>
      </td>
    </tr>
    </table>
  </div>
  <?php endif; ?>
  <?php endforeach; ?>
<?php else: ?>
  <div class="form-item">
    <label for="upload"><?php echo __('upload') ?></label>
    <?php include_component('digitalobject', 'upload', array('informationObject'=>$informationObject)) ?>
  </div>
<?php endif; ?>