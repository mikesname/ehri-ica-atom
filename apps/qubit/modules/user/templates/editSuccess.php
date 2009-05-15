<div class="pageTitle"><?php echo __('edit user'); ?></div>

<?php echo form_tag('user/update') ?>

<?php echo object_input_hidden_tag($user, 'getId') ?>

<table class="detail">
<tbody>

<tr><td colspan="2" class="headerCell"><?php echo link_to(__('%1% profile', array('%1%' => $user)), array('module' => 'user', 'action' => 'show', 'id' => $user->id)) ?></td></tr>
<tr>

<tr>
  <th><?php echo __('user name'); ?></th>
  <td>
      <?php echo object_input_tag($user, 'getUsername', array ('size' => 20)) ?>
   </td>
</tr>

<tr>
  <th><?php echo __('email'); ?></th>
  <td><?php echo object_input_tag($user, 'getEmail', array ('size' => 20)) ?></td>
</tr>

<tr>
  <th><?php echo __('password'); ?></th>
<td><?php echo link_to(__('reset password'), 'user/passwordEdit?id='.$user->getId()) ?></td>
</tr>

<tr><th><?php echo __('user roles'); ?></th><td style="font: normal 12px/12px Verdana, Arial, Sans-Serif;">
      <?php foreach ($user->getUserRoleRelations() as $roleRelation): ?>
      <?php echo $roleRelation->getRole() ?>&nbsp;
      <?php echo link_to(image_tag('delete', 'align=top'), 'user/deleteRoleRelation?role_relation_id='.$roleRelation->getId()) ?>
      <br />
      <?php endforeach; ?>

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
&#160;<?php echo link_to(__('cancel'), 'user/show?id='.$user->getId()) ?>
<?php if ($user->getId()): ?>
  <?php echo submit_tag(__('save')) ?>
<?php else: ?>
  <?php echo submit_tag(__('create')) ?>
<?php endif; ?>
</div>
</form>

<div class="menu-extra">
  <?php echo link_to(__('add new'), 'user/create'); ?>
  <?php echo link_to(__('list all users'), 'user/list'); ?>
</div>
</div>
