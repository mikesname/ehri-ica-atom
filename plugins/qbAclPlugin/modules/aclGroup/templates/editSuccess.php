<?php use_helper('Javascript') ?>

<h1>
  <?php echo (isset($sf_request->id)) ? __('Edit group') : __('Create new group') ?>
</h1>

<form method="post" action="<?php echo url_for(array($group, 'module' => 'aclGroup', 'action' => 'edit')) ?>">

<h1 class="label">
  <?php if (isset($sf_request->id)): ?>
  <?php echo $group->getName(array('cultureFallback' => true)) ?>
  <?php else: ?>
  <?php echo __('New group') ?>
  <?php endif; ?>
</h1>

<?php echo render_field($form->name, $group) ?>

<?php echo render_field($form->description, $group, array('class' => 'resizable')) ?>

<?php echo $form->translate->renderRow() ?>

<div class="actions section">
<h2 class="element-invisible"><?php echo __('Actions') ?></h2>
  <div class="content">
    <ul class="clearfix links">
      <?php if (isset($sf_request->id)): ?>
      <li><?php echo link_to(__('Cancel'), array($group, 'module' => 'aclGroup')) ?></li>

      <?php if (QubitAcl::check($group, 'delete') && !$group->isProtected()): ?>
      <li><?php echo link_to(__('Delete'), array($group, 'module' => 'aclGroup', 'action' => 'delete')) ?></li>
      <?php endif; ?>

      <li><?php echo submit_tag(__('Save')) ?></li>
      <?php else: ?>
        <li><?php echo link_to(__('Cancel'), array('module' => 'aclGroup', 'action' => 'list')) ?></li>
        <li><?php echo submit_tag(__('Create')) ?></li>
      <?php endif; ?>
    </ul>
  </div>
</div>

</form>
