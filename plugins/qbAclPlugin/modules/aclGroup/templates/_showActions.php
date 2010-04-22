<?php if (QubitAcl::check($group, array('create', 'update', 'delete'))): ?>
<div class="actions section">
<h2 class="element-invisible"><?php echo __('Actions') ?></h2>
  <div class="content">
    <ul class="clearfix links">
      <?php if (QubitAcl::check($group, 'update')): ?>
        <li><?php echo link_to (__('Edit'), array('module' => 'aclGroup', 'action' => str_replace('index', 'edit', $sf_context->getActionName()), 'id' => $group->id)) ?></li>
      <?php endif; ?>

      <?php if (QubitAcl::check($group, 'delete')): ?>
        <li><?php echo link_to (__('Delete'), array($group, 'module' => 'aclGroup', 'action' => 'delete')) ?></li>
      <?php endif; ?>

      <?php if (QubitAcl::check($group, 'create')): ?>
        <li><?php echo link_to (__('Add new'), array('module' => 'aclGroup', 'action' => 'create')) ?></li>
      <?php endif; ?>
    </ul>
  </div>
</div>
<?php endif; ?>
