<div class="pageTitle"><?php echo __('list users'); ?></div>

<table class="list">
<thead>
<tr>
  <th><?php echo __('user name'); ?> <span class="th-link"><?php echo link_to(__('add new'), 'user/create') ?></span></th>
  <th><?php echo __('email'); ?></th>
  <th><?php echo __('user roles'); ?></th>
</tr>
</thead>
<tbody>
<?php foreach ($users as $user): ?>
<tr>
      <td><?php echo link_to($user->getUsername(), 'user/edit?id='.$user->getId()) ?></td>
      <td><?php echo $user->getEmail() ?></td>
      <td><?php foreach ($user->getRoles() as $role): ?>
            <?php echo $role ?><br />
          <?php endforeach; ?>
      </td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

<div class="menu-action" style="padding-top: 10px;">
<?php echo link_to (__('add new user'), 'user/create') ?>
</div>
