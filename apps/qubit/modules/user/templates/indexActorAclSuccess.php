<?php echo get_component('user', 'aclMenu') ?>

<h1><?php echo __('View permissions') ?></h1>

<h1 class="label"><?php echo $user->__toString() ?></h1>

<div class="section">
  <?php if (0 < count($acl)): ?>
  <table id="userPermissions" class="inline sticky-enabled">
    <thead>
      <tr>
      <th colspan="2">&nbsp;</th>
      <?php foreach ($userGroups as $groupId): ?>
        <?php if (null !== $group = QubitAclGroup::getById($groupId)): ?>
        <th><?php echo $group->__toString() ?></th>
        <?php elseif ($user->username == $groupId): ?>
        <th><?php echo $user->username ?></th>
        <?php endif; ?>
      <?php endforeach; ?>
      </tr>
    </thead>

    <tbody>
    <?php foreach ($acl as $objectId => $actions): ?>
      <tr>
        <td colspan="<?php echo $tableCols ?>"><strong>
        <?php if (1 < $objectId): ?>
          <?php echo render_title(QubitActor::getById($objectId)) ?>
        <?php else: ?>
          <em><?php echo __('All authority records') ?></em>
        <?php endif; ?>
        </strong></td>
      </tr>
      
    <?php $row = 0; ?>
    <?php foreach ($actions as $action => $groupPermission): ?>
      <tr class="<?php echo 0 == ++$row % 2 ? 'even' : 'odd' ?>">
        <td>&nbsp;</td>
        <td>
        <?php if ('' != $action): ?>
          <?php echo QubitAcl::$ACTIONS[$action] ?>
        <?php else: ?>
          <em><?php echo __('All privileges') ?></em>
        <?php endif; ?>
        </td> 
        
        <?php foreach ($userGroups as $groupId): ?>
        <td>
        <?php if (isset($groupPermission[$groupId]) && $permission = $groupPermission[$groupId]): ?>
          <?php if ('translate' == $permission->action && null !== $permission->getConstants(array('name' => 'languages'))): ?>
          <?php echo __('%1%: %2%', array('%1%' => $permission->renderAccess(), '%2%' => implode(', ', $permission->getConstants(array('name' => 'languages'))))) ?>
          <?php else: ?>
            <?php echo __($permission->renderAccess()) ?>
          <?php endif; ?>
        <?php else: ?>
          <?php echo '-' ?>
        <?php endif; ?>
        </td>
        <?php endforeach; ?>
      </tr>
    <?php endforeach; ?>
    <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>

</div>

<?php echo get_partial('showActions', array('user' => $user)) ?>
