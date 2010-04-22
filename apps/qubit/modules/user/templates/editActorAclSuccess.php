<?php use_helper('Javascript') ?>

<h1><?php echo __('Edit authority record permissions') ?></h1>

<h1 class="label"><?php echo $user->__toString() ?></h1>

<?php echo get_partial('aclGroup/addActorDialog', array('basicActions' => $basicActions)) ?>

<form method="post" action="<?php echo url_for(array($user, 'module' => 'user', 'action' => 'editActorAcl')) ?>" id="editForm">

<?php foreach ($permissions as $objectId => $actions): ?>
<div class="form-item">
  <table id="actorPermission_<?php echo $objectId ?>" class="inline">
    <caption>
    <?php if (QubitActor::ROOT_ID == $objectId): ?>
      <em><?php echo __('All authority records') ?></em>
    <?php else: ?>
      <?php echo render_title(QubitActor::getById($objectId)) ?>
    <?php endif; ?> 
    </caption>

    <thead>
      <tr>
        <th scope="col"><?php echo __('Action') ?></th>
        <th scope="col"><?php echo __('Permission') ?></th>
      </tr>
    </thead>

    <tbody>
      <?php foreach ($basicActions as $action => $label): ?>
      <tr class="<?php echo (0 == $row++ % 2) ? 'even' : 'odd' ?>">
        <td><?php echo __($label) ?></td>
        <td id="<?php echo 'acl_'.$objectId.'_'.$action ?>">
          <ul class="radio inline">
          <?php if (isset($actions[$action])): ?>
            <li><?php echo radiobutton_tag('updatePermission['.$actions[$action]->id.']', QubitAcl::GRANT, 1 == $actions[$action]->grantDeny) ?><?php echo __('Grant') ?></li>
            <li><?php echo radiobutton_tag('updatePermission['.$actions[$action]->id.']', QubitAcl::DENY, 0 == $actions[$action]->grantDeny) ?><?php echo __('Deny') ?></li>
            <li><?php echo radiobutton_tag('updatePermission['.$actions[$action]->id.']', QubitAcl::INHERIT, false) ?><?php echo __('Inherit') ?></li>
          <?php else: ?>
            <li><?php echo radiobutton_tag('updatePermission['.$objectId.'_'.$action.']', QubitAcl::GRANT, false) ?><?php echo __('Grant') ?></li>
            <li><?php echo radiobutton_tag('updatePermission['.$objectId.'_'.$action.']', QubitAcl::DENY, false) ?><?php echo __('Deny') ?></li>
            <li><?php echo radiobutton_tag('updatePermission['.$objectId.'_'.$action.']', QubitAcl::INHERIT, true) ?><?php echo __('Inherit') ?></li>
          <?php endif; ?>
          </ul>
        </td> 
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php endforeach; ?>

  <div class="form-item">
    <label for="addActorLink"><?php echo __('Add a person or organization') ?></label>
    <a id="addActorLink" href="javascript:myDialog.show()"><?php echo __('Add permissions') ?></a>
  </div>

  <div class="actions section">
    <h2 class="element-invisible"><?php echo __('Actions') ?></h2>
    <div class="content">
      <ul class="clearfix links">
        <li><?php echo link_to(__('Cancel'), array($user, 'module' => 'user', 'action' => 'indexActorAcl')) ?></li>
        <li><?php echo submit_tag(__('Save')) ?></li>
      </ul>
    </div>
  </div>

</form>
