<div class="pageTitle"><?php echo __('view user profile'); ?></div>

<table class="detail">
<tbody>
<tr><td colspan="2" class="headerCell">
<?php if (SecurityCheck::HasPermission($sf_user, array('module' => 'user', 'action' => 'edit'))): ?>
    <?php echo link_to(__('%1% profile', array('%1%' => $user)), array('module' => 'user', 'action' => 'edit', 'id' => $user->id)) ?>
  <?php else: ?>
    <?php echo $user.' Profile' ?>
  <?php endif; ?>
</td></tr>
<tr>
<th><?php echo __('user name'); ?></th>
<td><?php echo $user->username ?></td>
</tr>
<tr>
<th><?php echo __('email'); ?></th>
<td><?php echo $user->getEmail() ?></td>
</tr>
<tr>
<th><?php echo __('password'); ?></th>
<td><?php echo link_to(__('reset password'), 'user/passwordEdit?id='.$user->getId()) ?></td></tr>
<tr>
<th><?php echo __('user roles'); ?></th>
<td>
      <?php foreach ($user->getRoles() as $role): ?>
        <?php echo $role ?><br />
      <?php endforeach; ?>
</td>

</tbody>
</table>

<div class="menu-action">
<?php if (SecurityCheck::HasPermission($sf_user, array('module' => 'user', 'action' => 'edit'))): ?>
  <?php echo link_to(__('edit'), 'user/edit?id='.$user->getId()) ?>
<?php endif; ?>
</div>

<div class="menu-extra">
<?php if (SecurityCheck::HasPermission($sf_user, array('module' => 'user', 'action' => 'edit'))): ?>
  <?php echo link_to(__('add new'), 'user/create'); ?>
<?php endif; ?>
  <?php echo link_to(__('list all users'), 'user/list'); ?>
</div>