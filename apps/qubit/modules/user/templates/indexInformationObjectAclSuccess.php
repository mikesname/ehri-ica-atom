<?php echo get_component('user', 'aclMenu') ?>

<h1><?php echo __('View permissions') ?></h1>

<?php echo link_to_if(SecurityCheck::HasPermission($sf_user, array('module' => 'user', 'action' => 'edit')), '<h1 class="label">'.render_title($resource).'</h1>', array($resource, 'module' => 'user', 'action' => 'edit'), array('title' => __('Edit user'))) ?>

<div class="section">
  <?php if (0 < count($acl)): ?>
    <table id="userPermissions" class="sticky-enabled">
      <thead>
        <tr>
          <th colspan="2">&nbsp;</th>
          <?php foreach ($userGroups as $item): ?>
            <?php if (null !== $group = QubitAclGroup::getById($item)): ?>
              <th><?php echo $group->__toString() ?></th>
            <?php elseif ($resource->username == $item): ?>
              <th><?php echo $resource->username ?></th>
            <?php endif; ?>
          <?php endforeach; ?>
        </tr>
      </thead><tbody>
        <?php foreach ($acl as $repoId => $objects): ?>
          <?php foreach ($objects as $objectId => $actions): ?>
            <tr>
              <td colspan="<?php echo $tableCols ?>"><strong>
                <?php if ('' == $repoId && '' == $objectId): ?>
                  <em><?php echo __('All %1%', array('%1%' => sfConfig::get('app_ui_label_informationobject'))) ?></em>
                <?php elseif ('' != $repoId): ?>
                  <?php echo __('%1%: %2%', array('%1%' => sfConfig::get('app_ui_label_repository'), '%2%' => render_title(QubitRepository::getById($repoId)))) ?>
                <?php else: ?>
                  <?php echo render_title(QubitInformationObject::getById($objectId)) ?>
                <?php endif; ?>
              </strong></td>
            </tr>
            <?php $row = 0; ?>
            <?php foreach ($actions as $action => $groupPermission): ?>
              <tr class="<?php echo 0 == ++$row % 2 ? 'even' : 'odd' ?>">
                <td>&nbsp;</td>
                <td>
                  <?php if ('' != $action): ?>
                    <?php echo QubitInformationObjectAcl::$ACTIONS[$action] ?>
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
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>

<?php echo get_partial('showActions', array('resource' => $resource)) ?>
