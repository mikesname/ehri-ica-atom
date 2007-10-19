<div class="pageTitle"><?php echo __('add').' '.__('new').' '.__('user'); ?></div>

<?php echo form_tag('user/update') ?>

<?php echo object_input_hidden_tag($user, 'getId') ?>

<table class="detail">
<tbody>

<tr><td colspan="2" class="headerCell"></td></tr>

<tr><th><?php echo __('id'); ?>: </th>
<td><?php echo $user->getId() ?></td></tr>

<tr>
  <th><?php echo __('user name'); ?>:</th>
  <td>
      <?php echo object_input_tag($user, 'getUserName', array ('size' => 20,)) ?>
   </td>
</tr>

<tr>
  <th><?php echo __('email'); ?>:</th>
  <td><?php echo object_input_tag($user, 'getEmail', array (
  'size' => 20,
)) ?></td>
</tr>

<tr>
  <th><?php echo __('password'); ?>:</th>
<td><?php echo object_input_tag($user, 'getSha1Password', array (
  'size' => 20,
)) ?></td>
</tr>


<tr><th><?php echo __('credentials'); ?>:</th><td style="font: normal 12px/12px Verdana, Arial, Sans-Serif;">
      <?php foreach ($credentials as $credential): ?>
        <?php echo $credential['credential'].": " ?>
        <?php if ($credential['repositoryId']!== 0): ?>
          <?php echo link_to($credential['repository'], 'repository/show?id='.$credential['repositoryId']) ?>
        <?php else: ?>
          <?php echo $credential['repository'] ?>
        <?php endif; ?>
        <?php echo link_to(image_tag('delete', 'align=top alt=delete credential'), 'user/deleteTermRelationship?TermRelationshipId='.$credential['relationshipId']).' <br ?>' ?>
      <?php endforeach; ?>

     <table width="100%" style="margin-top: 15px;"><tr>
     <td style="border: 0; background-color: #999999; color: #ffffff; font-weight: bold; font-size: 10px;"><?php echo __('role'); ?></td>
     <td style="border: 0; background-color: #999999; color: #ffffff; font-weight: bold; font-size: 10px;"><?php echo __('repository'); ?> (<?php echo __('leave blank for'); ?> <i><?php echo __('all'); ?></i>)</td>
     </tr><tr><td style="border: 0;">
    <?php echo object_select_tag($newTermRelationship, 'getTermId',
     array ('name' => 'termId',
     'id' => 'termId',
      'related_class' => 'Term',
      'peer_method' => 'getCredentials',
      'include_blank' => true))
      ?>
      </td><td style="border: 0;">

      <?php echo object_select_tag($newTermRelationship, 'getRepositoryId', array (
      'name' => 'repositoryId',
      'id' => 'repositoryId',
      'related_class' => 'Repository',
      'include_blank' => true)) ?>
    </td></tr></table>
</td></tr>



</tbody>
</table>
<div class="menu-action">
<?php if ($isAdministrator == true): ?>
  <?php if ($user->getId()): ?>
  &#160;<?php echo link_to(__('delete'), 'user/delete?id='.$user->getId(), 'post=true&confirm='.__('are you sure?')) ?>
  <?php endif; ?>
<?php endif; ?>
&#160;<?php echo link_to(__('cancel'), 'user/list') ?>
<?php echo my_submit_tag(__('save'), array('style' => 'width: auto;')) ?>
</div>
</form>

<?php if ($isAdministrator == true): ?>
<div class="menu-extra">
	<?php echo link_to(__('list').' '.__('all').' '.__('users'), 'user/list'); ?>
</div>
<?php endif; ?>
