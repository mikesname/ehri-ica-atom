<h1><?php echo __('List users') ?></h1>

<table class="sticky-enabled">
  <thead>
    <tr>
      <th>
        <?php echo __('User name') ?> <?php echo link_to('('.__('Add new').')', array('module' => 'user', 'action' => 'create')) ?>
      </th><th>
        <?php echo __('Email') ?>
      </th><th>
        <?php echo __('User roles') ?>
      </th>
    </tr>
  </thead><tbody>
    <?php foreach ($users as $user): ?>
      <tr class="<?php echo (0 == $row++ % 2) ? 'even' : 'odd' ?>">
        <td>
          <?php echo link_to($user->username, array($user, 'module' => 'user')) ?>
        </td><td>
          <?php echo $user->email ?>
        </td><td>
          <ul>
            <?php foreach ($user->getAclGroups() as $group): ?>
              <li><?php echo render_title($group) ?></li>
            <?php endforeach; ?>
          </ul>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php echo get_partial('default/pager', array('pager' => $pager)) ?>
