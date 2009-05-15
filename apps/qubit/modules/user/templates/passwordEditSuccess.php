<div class="pageTitle"><?php echo __('reset password'); ?></div>

<?php echo form_tag('user/passwordUpdate') ?>

<?php echo object_input_hidden_tag($user, 'getId') ?>

<table class="detail">
<tbody>

<tr><td colspan="2" class="headerCell">
    <?php echo __('reset password: %1%', array('%1%' => $user)) ?>
</td></tr>

<th><?php echo __('new password'); ?></th>
  <td><?php echo input_tag('sha1_password', '','maxlength=20')  ?></td>
</tr>

</tbody>
</table>


<div class="menu-action">
<?php if ($user->getId()): ?>
  &#160;<?php echo link_to(__('cancel'), 'user/show?id='.$user->getId()) ?>
<?php else: ?>
  &#160;<?php echo link_to(__('cancel'), 'user/show?id='.$user->getId()) ?>
<?php endif; ?>
<?php echo submit_tag(__('save')) ?>
</div>

</form>
