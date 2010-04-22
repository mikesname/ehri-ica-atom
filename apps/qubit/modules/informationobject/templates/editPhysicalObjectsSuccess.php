<h1><?php echo __('Link physical storage') ?></h1>

<h1 class="label"><?php echo render_title($informationObject) ?></h1>

<?php echo $form->renderFormTag(url_for(array($informationObject, 'module' => 'informationobject', 'action' => 'editPhysicalObjects'))) ?>

  <?php if (0 < count($relations)): ?>
    <div class="form-item">
      <table class="inline" style="width: 98%;">
        <tr>
          <th colspan="2" style="width: 90%;">
            <?php echo __('Containers') ?>
          </th><th style="width: 5%;">
            <?php echo image_tag('delete', array('align' => 'top', 'class' => 'deleteIcon')) ?>
          </th>
        </tr>
        <?php foreach($relations as $relation): ?>
          <?php $physicalObject = QubitPhysicalObject::getById($relation->getSubjectId()) ?>
          <tr class="<?php echo 'related_obj_'.$relation->id ?>">
            <td style="width: 90%"><div class="animateNicely">
              <?php if (isset($relation->subject->type)): ?><?php echo $relation->subject->type ?>: <?php endif; ?><?php echo render_title($relation->subject) ?><?php if (isset($relation->subject->location)): ?> - <?php echo $relation->subject->getLocation(array('cultureFallback' => 'true')) ?><?php endif; ?>
            </div></td><td style="width: 20px;"><div class="animateNicely">
              <?php echo link_to(image_tag('pencil', array('align' => 'top')), array($relation->subject, 'module' => 'physicalobject', 'action' => 'edit')) ?>
            </div></td><td style="width: 20px;"><div class="animateNicely">
              <input type="checkbox" name="delete_relations[<?php echo $relation->id ?>]" value="delete" class="multiDelete"/>
            </div></td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
  <?php endif; ?>

  <table class="inline" style="width: 98%;">
    <tr>
      <td colspan="3" class="headerCell" style="width: 98%">
        <?php echo __('Add container links (duplicate links will be ignored)') ?>
      </td>
    </tr>
  </table>

  <div class="form-item">
    <?php echo object_select_tag(null, null, array('related_class' => 'QubitPhysicalObject', 'name' => 'physicalObjectId', 'include_blank' => true, 'class' => 'multiInstance')) ?>
  </div>

  <table class="inline" style="width: 98%;">
    <tr>
      <td colspan="3" class="headerCell" style="width: 98%">
        <?php echo __('Or, create a new container') ?>
      </td>
    </tr>
  </table>

  <div class="form-item">
    <label for="physicalObjectName"><?php echo __('Name') ?></label>
    <?php echo input_tag('physicalObjectName') ?>
  </div>

  <div class="form-item">
    <label for="physicalObjectLocation"><?php echo __('Location') ?></label>
    <?php echo input_tag('physicalObjectLocation') ?>
  </div>

  <div class="form-item">
    <label for="physicalObjectType"><?php echo __('Container type') ?></label>
    <?php
      /* Disable fancy multi-level drop-down widget until display code is fixed to
       * allow multiple instances per form.
       echo object_select_tree($physicalObject, 'getId', array(
      'include_blank' => true,
      'peer_method' => 'getPhysicalObjectContainerTypes',
      'related_class' => 'QubitTerm',
      'name' => 'physicalObjectContainerId'
    )); */ ?>
    <?php echo select_tag('physicalObjectTypeId', options_for_select(QubitTerm::getIndentedChildTree(QubitTerm::CONTAINER_ID), null, array('include_blank' => true))) ?>
  </div>

  <div class="actions section">

    <h2 class="element-invisible"><?php echo __('Actions') ?></h2>

    <div class="content">
      <ul class="clearfix links">
        <li><?php echo link_to(__('Cancel'), array($informationObject, 'module' => 'informationobject')) ?></li>
        <li><?php echo submit_tag(__('Save')) ?></li>
      </ul>
    </div>

  </div>

</form>
