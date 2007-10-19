<div class="pageTitle"><?php echo __('add').' '.__('user'); ?></div>

<table class="detail">
<tbody>
<tr><td colspan="2" class="headerCell">
  <?php if ($isAdministrator == true): ?>
    <?php echo link_to($user->getUserName().' '.__('profile'), 'user/edit?id='.$user->getId()) ?>
  <?php else: ?>
    <?php echo $user->getUserName().' Profile' ?>
  <?php endif; ?>
</td></tr>
<tr>
<th><?php echo __('id'); ?>: </th>
<td><?php echo $user->getId() ?></td>
</tr>
<tr>
<th><?php echo __('user name'); ?>: </th>
<td><?php echo $user->getUserName() ?></td>
</tr>
<tr>
<th><?php echo __('email'); ?>: </th>
<td><?php echo $user->getEmail() ?></td>
</tr>
<tr>
<th><?php echo __('password'); ?>: </th>
<td><?php echo link_to(__('reset password'), 'user/passwordEdit?id='.$user->getId()) ?></td></tr>
<tr>
<th><?php echo __('credentials'); ?>:</th>
<td><?php foreach ($credentials as $credential): ?>
  <?php echo $credential['credential'].": " ?>
    <?php if ($credential['repositoryId']!== 0): ?>
    <?php echo link_to($credential['repository'], 'repository/show?id='.$credential['repositoryId']) ?>
    <?php else: ?>
    <?php echo $credential['repository'] ?>
    <?php endif; ?>
    <br />
  <?php endforeach; ?>
</td>

</tbody>
</table>
<div class="menu-action">
<?php if ($isAdministrator == true): ?>
  <?php echo link_to(__('edit'), 'user/edit?id='.$user->getId()) ?>
<?php endif; ?>
</div>

<?php if ($isAdministrator == true): ?>
<div class="menu-extra">
	<?php echo link_to(__('list').' '.__('all').' '.__('users'), 'user/list'); ?>
</div>
<?php endif; ?>
