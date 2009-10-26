<ul class="actions">
  <?php if (QubitAcl::check($informationObject, QubitAclAction::UPDATE_ID)): ?>
    <li><?php echo link_to(__('Edit'), array('module' => 'informationobject', 'action' => 'edit', 'id' => $informationObject->id)) ?></li>
  <?php endif; ?>
  <?php if (QubitAcl::check($informationObject, QubitAclAction::DELETE_ID)): ?>
    <li><?php echo link_to(__('Delete'), array('module' => 'informationobject', 'action' => 'delete', 'id' => $informationObject->id), array('title' => __('Delete'))) ?></li>
  <?php endif; ?>
  <?php if (QubitAcl::check($informationObject, QubitAclAction::UPDATE_ID)): ?>
    <?php if (0 < count($informationObject->digitalObjects)): ?>
      <li><?php echo link_to(__('Edit digital object'), array('module' => 'digitalobject', 'action' => 'edit', 'id' => $informationObject->digitalObjects[0]->id)) ?></li>
    <?php else: ?>
      <li><?php echo link_to(__('Upload digital object'), array('module' => 'digitalobject', 'action' => 'create', 'informationObject' => $informationObject->id)) ?></li>
    <?php endif; ?>
  <?php endif; ?>
  <?php if (QubitAcl::check($informationObject, QubitAclAction::UPDATE_ID)): ?>
    <li><?php echo link_to(__('Link physical storage'), array('module' => 'informationobject', 'action' => 'editPhysicalObjects', 'id' => $informationObject->id)) ?></li>
  <?php endif; ?>
  <div class="menu-extra">
  <?php if (QubitAcl::check(QubitInformationObject::getRoot(), QubitAclAction::CREATE_ID)): ?>
    <li><?php echo link_to(__('Add new'), array('module' => 'informationobject', 'action' => 'create', 'parent' => url_for(array('module' => 'informationobject', 'action' => 'show', 'id' => $informationObject->id))), array('title' => __('Add new'))) ?></li>
  <?php endif; ?>
  <li><?php echo link_to(__('List all'), array('module' => 'informationobject', 'action' => 'list')) ?></li>
  </div>
</ul>
