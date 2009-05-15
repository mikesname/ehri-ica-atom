<div class="pageTitle"><?php echo __('add new user'); ?></div>

<?php echo form_tag('user/update') ?>

<?php echo object_input_hidden_tag($user, 'getId') ?>

<table class="detail">
<tbody>

<tr><td colspan="2" class="headerCell"></td></tr>

<tr>
  <th><?php echo __('user name'); ?></th>
  <td>
      <?php echo object_input_tag($user, 'getUsername', array ('size' => 20)) ?>
   </td>
</tr>

<tr>
  <th><?php echo __('email'); ?></th>
  <td><?php echo object_input_tag($user, 'getEmail', array (
  'size' => 20,
)) ?></td>
</tr>

<tr>
  <th><?php echo __('password'); ?></th>
<td><?php echo object_input_tag($user, 'getSha1Password', array (
  'size' => 20,
)) ?></td>
</tr>

<tr><th><?php echo __('user roles'); ?></th><td style="font: normal 12px/12px Verdana, Arial, Sans-Serif;">
        <?php echo object_select_tag($newRoleRelation, 'getRoleId', array('related_class' => 'QubitRole', 'include_blank' => true, 'peer_method' => 'getAll')) ?>
  </td></tr>

</tbody>
</table>

<!-- include empty div at bottom of form to bump the fixed button-block and allow user to scroll past it -->
<div id="button-block-bump"></div>

<div id="button-block">

<div class="menu-action">
<?php if (SecurityCheck::HasPermission($sf_user, array('module' => 'user', 'action' => 'delete'))): ?>
  <?php if ($user->getId()): ?>
  &#160;<?php echo link_to(__('delete'), 'user/delete?id='.$user->getId(), 'post=true&confirm='.__('are you sure?')) ?>
  <?php endif; ?>
<?php endif; ?>
&#160;<?php echo link_to(__('cancel'), 'user/list') ?>
<?php if ($user->getId()): ?>
  <?php echo submit_tag(__('save')) ?>
<?php else: ?>
  <?php echo submit_tag(__('create')) ?>
<?php endif; ?>
</div>
</form>

<?php if (SecurityCheck::HasPermission($sf_user, array('module' => 'user', 'action' => 'list'))): ?>
<div class="menu-extra">
  <?php echo link_to(__('list all users'), 'user/list'); ?>
</div>
<?php endif; ?>
</div>
