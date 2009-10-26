<div class="pageTitle"><?php echo __('view user profile'); ?></div>

<table class="detail">
<tbody>
<tr><td colspan="2" class="headerCell">
<?php if (SecurityCheck::HasPermission($sf_user, array('module' => 'user', 'action' => 'edit'))): ?>
    <?php echo link_to(__('%1% profile', array('%1%' => $user)), array('module' => 'user', 'action' => 'edit', 'id' => $user->id)) ?>
  <?php else: ?>
    <?php echo $user.' Profile' ?>
  <?php endif; ?>
</td>
</tr>
<tr>
  <th><?php echo __('user name'); ?></th>
  <td><?php echo $user->username ?></td>
</tr>

<?php if (null != $user->email): ?>
<tr>
  <th><?php echo __('email'); ?></th>
  <td><?php echo $user->getEmail() ?></td>
</tr>
<?php endif; ?>

<?php if (!$sf_user->hasCredential('administrator')): ?>
<tr>
  <th><?php echo __('password'); ?></th>
  <td><?php echo link_to(__('reset password'), array('module' => 'user', 'action' => 'passwordEdit', 'id' => $user->id)) ?></td>
</tr>
<?php endif; ?>

<?php if (0 < count($groups = $user->getAclGroups())): ?>
<tr>
<th><?php echo __('user groups'); ?></th>
<td>
  <ul>
  <?php foreach ($groups as $group): ?>
    <?php if (100 <= $group->id): ?> 
    <li><?php echo $group->getName(array('cultureFallback' => true)) ?></li>
    <?php else: ?>
    <li><span class="note2"><?php echo $group->getName(array('cultureFallback' => true)) ?></li>
    <?php endif; ?>
  <?php endforeach; ?>
  </ul>
</td>
</tr>
<?php endif; ?>

</tbody>
</table>

<!-- include empty div at bottom of form to bump the fixed button-block and allow user to scroll past it -->
<div id="button-block-bump"></div>

<?php if ($sf_user->hasCredential('administrator')): ?>
<ul class="actions">
  <li><?php echo link_to (__('Edit'), array('module' => 'user', 'action' => 'edit', 'id' => $user->id)) ?></li>
  <li><?php echo link_to (__('Delete'), array('module' => 'user', 'action' => 'delete', 'id' => $user->id), array('post' => true, 'confirm' => 'are you sure?')) ?></li>
  <br />

  <div class="menu-extra">
    <li><?php echo link_to (__('Add new'), array('module' => 'user', 'action' => 'create')) ?></li>
    <li><?php echo link_to(__('List all'), array('module' => 'user', 'action' => 'list')) ?></li>
  </div>
</ul>
<?php endif; ?>
