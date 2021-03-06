<?php echo get_component('user', 'aclMenu') ?>

<h1><?php echo __('View permissions') ?></h1>

<?php echo link_to_if(SecurityCheck::HasPermission($sf_user, array('module' => 'user', 'action' => 'edit')), '<h1 class="label">'.render_title($resource).'</h1>', array($resource, 'module' => 'user', 'action' => 'edit'), array('title' => __('Edit user'))) ?>

<div class="section">

  <?php if (0 < count($acl)): ?>

    <table id="userPermissions" class="sticky-enabled">
      <thead>
        <tr>
          <th colspan="2">&nbsp;</th>
          <?php foreach ($roles as $item): ?>
            <?php if (null !== $group = QubitAclGroup::getById($item)): ?>
              <th><?php echo $group->__toString() ?></th>
            <?php elseif ($resource->username == $item): ?>
              <th><?php echo $resource->username ?></th>
            <?php endif; ?>
          <?php endforeach; ?>
        </tr>
      </thead><tbody>
        <?php foreach ($acl as $taxonomyId => $actions): ?>
          <tr>
            <td colspan="<?php echo $tableCols ?>"><strong>
              <?php if ('' == $taxonomyId): ?>
                <em><?php echo __('All %1%', array('%1%' => sfConfig::get('app_ui_label_term'))) ?></em>
              <?php else: ?>
                <?php echo __('Taxonomy: %1%', array('%1%' => render_title(QubitTaxonomy::getById($taxonomyId)))) ?>
              <?php endif; ?>
            </strong></td>
          </tr>
          <?php $row = 0; ?>
          <?php foreach ($actions as $action => $groupPermission): ?>
            <tr class="<?php echo 0 == @++$row % 2 ? 'even' : 'odd' ?>">
              <td>&nbsp;</td>
              <td>
                <?php if ('' != $action): ?>
                  <?php echo QubitAcl::$ACTIONS[$action] ?>
                <?php else: ?>
                  <em><?php echo __('All privileges') ?></em>
                <?php endif; ?>
              </td>
              <?php foreach ($roles as $roleId): ?>
                <td>
                  <?php if (isset($groupPermission[$roleId]) && $permission = $groupPermission[$roleId]): ?>
                    <?php if ('translate' == $permission->action && null !== $permission->getConstants(array('name' => 'languages'))): ?>
                      <?php echo $permission->renderAccess().': '.implode(',', $permission->getConstants(array('name' => 'languages'))) ?>
                    <?php else: ?>
                      <?php echo $permission->renderAccess() ?>
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

<?php echo get_partial('showActions', array('resource' => $resource)) ?>
