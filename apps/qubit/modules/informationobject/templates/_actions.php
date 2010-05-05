<div class="actions section">

  <h2 class="element-invisible"><?php echo __('Actions') ?></h2>

  <div class="content">
    <ul class="clearfix links">

      <?php if (QubitAcl::check($informationObject, 'update') || (QubitAcl::check($informationObject, 'translate'))): ?>
        <li><?php echo link_to(__('Edit'), array($informationObject, 'module' => 'informationobject', 'action' => 'edit')) ?></li>
      <?php endif; ?>

      <?php if (QubitAcl::check($informationObject, 'delete')): ?>
        <li><?php echo link_to(__('Delete'), array($informationObject, 'module' => 'informationobject', 'action' => 'delete')) ?></li>
      <?php endif; ?>

      <?php if (QubitAcl::check($informationObject, 'create')): ?>
        <li><?php echo link_to(__('Add new'), array('module' => 'informationobject', 'action' => 'create', 'parent' => url_for(array($informationObject, 'module' => 'informationobject')))) ?></li>
        <li><?php echo link_to(__('Duplicate'), array('module' => 'informationobject', 'action' => 'duplicate', 'source' => $informationObject->id)) ?></li>
      <?php endif; ?>

      <?php if (QubitAcl::check($informationObject, 'update')): ?>

        <li><?php echo link_to(__('Move'), array($informationObject, 'action' => 'move')) ?></li>

        <?php if (0 < count($informationObject->digitalObjects)): ?>
          <li><?php echo link_to(__('Edit digital object'), array($informationObject->digitalObjects[0], 'module' => 'digitalobject', 'action' => 'edit')) ?></li>
        <?php else: ?>
          <li><?php echo link_to(__('Link digital object'), array('module' => 'digitalobject', 'action' => 'create', 'informationObject' => $informationObject->id)) ?></li>
        <?php endif; ?>

        <li><?php echo link_to(__('Import digital objects'), array('module' => 'digitalobject', 'action' => 'multiFileUpload', 'informationObject' => $informationObject->id)) ?></li>
        <li><?php echo link_to(__('Link physical storage'), array($informationObject, 'module' => 'informationobject', 'action' => 'editPhysicalObjects')) ?></li>

      <?php endif; ?>

    </ul>
  </div>

</div>
