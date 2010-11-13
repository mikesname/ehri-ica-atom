<?php echo get_component('user', 'aclMenu') ?>

<h1><?php echo __('View user profile') ?></h1>

<?php echo link_to_if(SecurityCheck::HasPermission($sf_user, array('module' => 'user', 'action' => 'edit')), '<h1 class="label">'.render_title($resource).'</h1>', array($resource, 'module' => 'user', 'action' => 'edit'), array('title' => __('Edit user'))) ?>

<div class="section">

  <?php echo render_show(__('User name'), $resource->username) ?>

  <?php echo render_show(__('Email'), $resource->email) ?>

  <?php if (!$sf_user->hasCredential('administrator')): ?>
    <div class="field">
      <h3><?php echo __('Password') ?></h3>
      <div><?php echo link_to(__('Reset password'), array($resource, 'module' => 'user', 'action' => 'passwordEdit')) ?></div>
    </div>
  <?php endif; ?>

  <?php if (0 < count($groups = $resource->getAclGroups())): ?>
    <div class="field">
      <h3><?php echo __('User groups') ?></h3>
      <div>
        <ul>
          <?php foreach ($groups as $item): ?>
            <?php if (100 <= $item->id): ?>
              <li><?php echo $item->__toString() ?></li>
            <?php else: ?>
              <li><span class="note2"><?php echo $item->__toString() ?></li>
            <?php endif; ?>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  <?php endif; ?>

</div>

<?php echo get_partial('showActions', array('resource' => $resource)) ?>
