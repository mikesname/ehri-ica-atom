<div class="pageTitle"><?php echo __('view MODS record'); ?></div>

<table class="detail">
<tbody>

<?php if ($informationObject->getTitle(array('sourceCulture' => true))): ?>
  <tr><td colspan="2" class="headerCell">
  <?php if ($editCredentials) echo link_to(QubitMods::getLabel($informationObject), 'informationobject/editIsad/?id='.$informationObject->getId());
        else echo QubitMods::getLabel($informationObject); ?>
  </td></tr>
<?php endif; ?>

<?php if ($showCompoundDigitalObject): ?>
  <tr>
    <td colspan="2">
      <div style="text-align: center">
      <?php include_component('digitalobject', 'showCompound', array('informationObject'=>$informationObject)); ?>
      </div>
    </td>
  </tr>
<?php elseif (isset($digitalObject)): ?>
  <tr>
    <td colspan="2">
      <div style="text-align: center">
      <?php include_component('digitalobject', 'show', array(
        'digitalObject'=>$digitalObject, 'usageType'=>QubitTerm::REFERENCE_ID, 'link'=>$digitalObjectLink)); ?>
      </div>
    </td>
  </tr>
<?php endif; ?>

<!--  Digital Object metadata -->
<?php if (isset($digitalObject)): ?>
  <tr><td colspan="2" class="subHeaderCell">
    <?php echo __('digital object metadata') ?>
  </td></tr>

  <?php if ($digitalObject->getName()): ?>
  <tr>
    <th><?php echo __('filename'); ?></th>
    <td><?php echo $digitalObject->getName(); ?></td>
  </tr>
  <?php endif; ?>

  <?php if ($digitalObject->getMediaType()): ?>
  <tr>
    <th><?php echo __('media type'); ?></th>
    <td><?php echo $digitalObject->getMediaType(); ?></td>
  </tr>
  <?php endif; ?>

  <?php if ($digitalObject->getMimeType()): ?>
  <tr>
    <th><?php echo __('mime-type'); ?></th>
    <td><?php echo $digitalObject->getMimeType(); ?></td>
  </tr>
  <?php endif; ?>

  <?php if ($digitalObject->getHRfileSize()): ?>
  <tr>
    <th><?php echo __('filesize'); ?></th>
    <td><?php echo $digitalObject->getHRfileSize(); ?></td>
  </tr>
  <?php endif; ?>

  <?php if ($digitalObject->getCreatedAt()): ?>
  <tr>
    <th><?php echo __('uploaded'); ?></th>
    <td><?php echo $digitalObject->getCreatedAt(); ?></td>
  </tr>
  <?php endif; ?>
<?php endif; ?>

</tbody>
</table>

<?php if ($editCredentials): ?>
<div class="menu-action">
  <?php echo link_to (__('edit MODS record'), 'informationobject/editMods?id='.$informationObject->getId()) ?>
</div>
<?php endif; ?>

<div class="menu-extra">
<?php if ($editCredentials): ?>
  <?php echo link_to(__('add new'), 'informationobject/createMods'); ?>
<?php endif; ?>
  <?php echo link_to(__('list all'), 'informationobject/list'); ?>
</div>
