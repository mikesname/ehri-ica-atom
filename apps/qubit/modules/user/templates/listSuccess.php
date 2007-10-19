<div class="pageTitle"><?php echo __('list').' '.__('users'); ?></div>

<table class="list">
<thead>
<tr>
  <th style="width: 15px;"><?php echo __('id'); ?></th>
  <th><?php echo __('user name'); ?> <span class="th-link">(<?php echo link_to(__('add').' '.__('new'), 'user/create') ?>)</span></th>
  <th><?php echo __('email'); ?></th>
  <th><?php echo __('credentials'); ?></th>
</tr>
</thead>
<tbody>
<?php foreach ($users as $user): ?>
<tr>
      <td><?php echo $user->getId() ?></td>
      <td><?php echo link_to($user->getUserName(), 'user/edit?id='.$user->getId()) ?></td>
      <td><?php echo $user->getEmail() ?></td>
      <td><?php foreach ($user->getUserCredentials() as $credential): ?>
            <?php echo $credential['credential'].": " ?>
            <?php if ($credential['repositoryId']!== 0): ?>
            <?php echo link_to($credential['repository'], 'repository/show?id='.$credential['repositoryId']) ?>
            <?php else: ?>
            <?php echo $credential['repository'] ?>
            <?php endif; ?>
            <br />
          <?php endforeach; ?>
      </td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

<div class="menu-action" style="padding-top: 10px;">
<?php echo link_to (__('add').' '.__('new').' '.__('user'), 'user/create') ?>
</div>
