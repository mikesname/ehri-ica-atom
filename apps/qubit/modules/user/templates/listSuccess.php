<div class="options-list"><a class="active">users</a><?php echo link_to('groups', array('module' => 'aclGroup', 'action' => 'list')) ?></div>

<div class="pageTitle"><?php echo __('list users'); ?></div>

<table class="list">
<thead>
<tr>
  <th><?php echo __('user name'); ?> <span class="th-link"><?php echo link_to(__('add new'), array('module' => 'user', 'action' => 'create')) ?></span></th>
  <th><?php echo __('email'); ?></th>
  <th><?php echo __('user roles'); ?></th>
</tr>
</thead>
<tbody>
<?php foreach ($users->getResults() as $user): ?>
<tr>
  <td><?php echo link_to($user->getUsername(), array('module' => 'user', 'action' => 'show', 'id' => $user->getId())) ?></td>
  <td><?php echo $user->getEmail() ?></td>
  <td>
    <ul>
    <?php foreach ($user->getAclGroups() as $group): ?>
    <?php if (100 <= $group->id): ?> 
    <li><?php echo $group->getName(array('cultureFallback' => true)) ?></li>
    <?php else: ?>
    <li><span class="note2"><?php echo $group->getName(array('cultureFallback' => true)) ?></li>
    <?php endif; ?>
    <?php endforeach; ?>
    </ul>
  </td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

<?php echo get_partial('default/pager', array('pager' => $users)) ?>
