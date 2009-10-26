<ul class="actions">
  <?php if (isset($sf_request->id)): ?>
    <li><?php echo link_to(__('Cancel'), array('module' => 'informationobject', 'action' => 'show', 'id' => $informationObject->id)) ?></li>
    <li><?php echo submit_tag(__('Save')) ?></li>
  <?php else: ?>
    <li><?php echo link_to(__('Cancel'), array('module' => 'informationobject', 'action' => 'list')) ?></li>
    <li><?php echo submit_tag(__('Create')) ?></li>
  <?php endif; ?>
</ul>
