<?php echo get_component('user', 'aclMenu') ?>

<h1><?php echo __('View user profile'); ?></h1>

<?php if (SecurityCheck::HasPermission($sf_user, array('module' => 'user', 'action' => 'edit'))): ?>
  <?php echo link_to(__('<h1 class="label">%1% profile</h1>', array('%1%' => $user)), array($user, 'module' => 'user', 'action' => 'edit')) ?>
<?php else: ?>
  <h1 class="label"><?php echo $user.' profile' ?></h1>
<?php endif; ?>

<div class="section">

  <?php echo render_show(__('User name'), $user->username) ?>

  <?php echo render_show(__('Email'), $user->email) ?>

  <?php if (!$sf_user->hasCredential('administrator')): ?>
  <div class="field">
    <h3><?php echo __('Password') ?></h3>
    <div><?php echo link_to(__('Reset password'), array($user, 'module' => 'user', 'action' => 'passwordEdit')) ?></div>
  </div>
  <?php endif; ?>

  <?php if (0 < count($groups = $user->getAclGroups())): ?>
  <div class="field">
    <h3><?php echo __('User groups'); ?></h3>
    <div>
      <ul>
        <?php foreach ($groups as $group): ?>
          <?php if (100 <= $group->id): ?> 
            <li><?php echo $group->__toString() ?></li>
          <?php else: ?>
            <li><span class="note2"><?php echo $group->__toString() ?></li>
          <?php endif; ?>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
  <?php endif; ?>

</div>

<?php echo get_partial('showActions', array('user' => $user)) ?>
