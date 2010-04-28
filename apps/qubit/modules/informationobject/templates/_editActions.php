<div class="actions section">

  <h2 class="element-invisible"><?php echo __('Actions') ?></h2>

  <div class="content">
    <ul class="clearfix links">

      <?php if (isset($informationObject->id)): ?>
        <li><?php echo link_to(__('Cancel'), array($informationObject, 'module' => 'informationobject')) ?></li>
        <li><?php echo submit_tag(__('Save')) ?></li>
      <?php else: ?>
        <?php if (isset($sf_request->parent)): ?>
          <li><?php echo link_to(__('Cancel'), array($informationObject->parent, 'module' => 'informationobject')) ?></li>
        <?php else: ?>
          <li><?php echo link_to(__('Cancel'), array('module' => 'informationobject', 'action' => 'list')) ?></li>
        <?php endif; ?>
        <li><?php echo submit_tag(__('Create')) ?></li>
      <?php endif; ?>

    </ul>
  </div>

</div>
