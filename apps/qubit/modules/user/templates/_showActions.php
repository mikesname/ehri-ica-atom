<?php if (QubitAcl::check($user, array('create', 'update', 'delete'))): ?>
<div class="actions section">
  <h2 class="element-invisible"><?php echo __('Actions') ?></h2>
  <div class="content">
    <ul class="clearfix links">
      <?php if (QubitAcl::check($user, 'update')): ?>
      <li><?php echo link_to (__('Edit'), array($user, 'module' => 'user', 'action' => str_replace('index', 'edit', $sf_context->getActionName()))) ?></li>
      <?php endif; ?>

      <?php if (QubitAcl::check($user, 'delete')): ?>
      <li><?php echo link_to (__('Delete'), array($user, 'module' => 'user', 'action' => 'delete')) ?></li>
      <?php endif; ?>

      <?php if (QubitAcl::check($user, 'create')): ?>
        <li><?php echo link_to (__('Add new'), array('module' => 'user', 'action' => 'create')) ?></li>
      <?php endif; ?>
    </ul>
  </div>
</div>
<?php endif; ?>
