<?php if ($showCompoundObjectToggle): ?>
<div class="form-item">
  <label for="display_as_compound_object"><?php echo __('view children as a compound digital object?') ?></label>
  <?php echo radiobutton_tag('display_as_compound_object', '1', $isCompoundDigitalObject); ?>&nbsp;<?php echo __('yes') ?><br />
  <?php echo radiobutton_tag('display_as_compound_object', '0', !$isCompoundDigitalObject) ?>&nbsp;<?php echo __('no') ?>
</div>
<?php endif; ?>

<?php if (count($digitalObject)): ?>
  <!-- Display/edit digital object representations -->
  <?php foreach ($representations as $usageId => $representation): ?>
  <?php if (is_object($representation) && $representation->getId()): ?>
    <?php include_component('digitalobject', 'editRepresentation',
      array('digitalObject'=>$digitalObject, 'representation'=>$representation)); ?>
    <?php else: ?>
    <div class="form-item">
      <table class="inline">
        <tr>
          <th><?php echo __('Add a new %1% representation', array('%1%'=>QubitTerm::getById($usageId))); ?></th>
        </tr>
        <tr style="border-bottom: 1px solid #CCC">
          <td>
            <?php include_component('digitalobject', 'upload', array('usageId'=>$usageId)); ?><br />
            <?php if ($digitalObject->canThumbnail()): ?>
              <?php echo __('<i>or</i> Auto-generate a new representation from master image'); ?>
              <?php echo checkbox_tag('createDerivative', $usageId, false, array('class'=>'checkbox')); ?>
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