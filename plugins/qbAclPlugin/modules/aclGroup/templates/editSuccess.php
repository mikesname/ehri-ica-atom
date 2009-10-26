<?php use_helper('Javascript') ?>

<div class="pageTitle">
  <?php if (isset($sf_request->id)): ?>
  <?php echo __('Edit group') ?>
  <?php else: ?>
  <?php echo __('Create new group') ?>
  <?php endif; ?>
</div>

<form method="post" action="<?php echo url_for(array('module' => 'aclGroup', 'action' => 'edit', 'id' => $group->id)) ?>">

<div class="formHeader">
  <?php if (isset($sf_request->id)): ?>
  <?php echo $group->getName(array('cultureFallback' => true)) ?>
  <?php else: ?>
  <?php echo __('new group') ?>
  <?php endif; ?>
</div>

<fieldset class="collapsible" id="definitionArea">
  <legend><?php echo __('definition')?></legend>

  <?php echo render_field($form->name, $group) ?>
  <?php echo render_field($form->description, $group, array('class' => 'resizable')) ?>
</fieldset>

<fieldset class="collapsible collapsed" id="permissionArea">
  <legend><?php echo __('permissions')?></legend>

  <table class="inline">
    <caption><?php echo __('Existing permissions'); ?></caption>
    <thead>
      <tr>
        <th style="width: 20%"><?php echo __('action') ?></th>
        <th style="width: 15%"><?php echo __('grant/deny') ?></th>
        <th style="width: 60%"><?php echo __('repository') ?></th>
        <th style="width: 5%"><?php echo image_tag('delete', array('align' => 'top', 'class' => 'deleteIcon')) ?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($permissions as $permission): ?>
        <?php $parameters = array() ?>
        <tr id="<?php echo 'permission_'.$permission->id ?>" class="<?php echo 'related_obj_'.$permission->id ?>">
          <td><?php echo $permission->getAction()->getName(array('cultureFallback' => true)) ?></td>
          <td>
            <ul class="radio_list">
              <li><?php echo radiobutton_tag('permission['.$permission->id.'][grantDeny]', '1', ('1' == $permission->grantDeny)) ?>&nbsp;<label><?php echo __('grant')?></label></li>
              <li><?php echo radiobutton_tag('permission['.$permission->id.'][grantDeny]', '0', ('1' != $permission->grantDeny)) ?>&nbsp;<label><?php echo __('deny')?></label></li>
            </ul>
          </td>
          <td>
            <div style="width: 100%">
            <select name="permission[<?php echo $permission->id ?>][repository]" class="form-autocomplete" id="repository">
            <?php if (null !== ($repository = $permission->getRepository())): ?>
              <option value="<?php echo $this->context->routing->generate(null, array('module' => 'repository', 'action' => 'show', 'id' => $repository->id)) ?>" selected="selected"><?php echo $repository->getAuthorizedFormOfName(array('cultureFallback' => true)) ?></option>
            <?php endif; ?>
            </select>
            <input class="list" type="hidden" value="<?php echo $this->context->routing->generate(null, array('module' => 'repository', 'action' => 'autocomplete')) ?>" />
            </div>
          </td>
          <td>
            <input type="checkbox" name="deletePermission[<?php echo $permission->id ?>]" value="delete" class="multiDelete" />
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <table class="inline">
    <caption><?php echo __('Add a new permission'); ?></caption>
    <thead>
      <tr>
        <th style="width: 20%"><?php echo __('action') ?></th>
        <th style="width: 15%"><?php echo __('grant/deny') ?></th>
        <th style="width: 60%"><?php echo __('repository') ?></th>
        <th style="width: 5%">&nbsp;</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>
          <?php echo object_select_tag('', '',
            array('name' => 'permission[new][actionId]', 'id' => 'permission_new_actionId', 'related_class' => 'QubitAclAction', 'include_blank' => true)) ?>
        </td>
        <td>
          <ul class="radio_list">
            <li><?php echo radiobutton_tag('permission[new][grantDeny]', '1', true) ?>&nbsp;<label><?php echo __('grant')?></label></li>
            <li><?php echo radiobutton_tag('permission[new][grantDeny]', '0', false) ?>&nbsp;<label><?php echo __('deny')?></label></li>
          </ul>
        </td>
        <td>
          <div style="width: 100%">
          <select name="permission[new][repository]" class="form-autocomplete" id="newRepository"></select>
          <input class="list" type="hidden" value="<?php echo $this->context->routing->generate(null, array('module' => 'repository', 'action' => 'list')) ?>" />
          </div>
        </td>
        <td>&nbsp;</td>
      </tr>
    </tbody>
  </table>
</fieldset>

<!-- include empty div at bottom of form to bump the fixed button-block and allow user to scroll past it -->
<div id="button-block-bump" />

<div id="button-block">
  <div class="menu-action">
  <?php echo link_to(__('Cancel'), array('module' => 'aclGroup', 'action' => 'list')) ?>

  <?php if (isset($sf_request->id)): ?>
    <?php if (QubitAcl::check($group, QubitAclAction::DELETE_ID) && !$group->isProtected()): ?>
      <?php echo link_to(__('Delete'), array('module' => 'aclGroup', 'action' => 'delete', 'id' => $group->id)) ?>
    <?php endif; ?>
    <?php echo submit_tag(__('Save')) ?>
  <?php else: ?>
    <?php echo submit_tag(__('Create')) ?>
  <?php endif; ?>
  </div>
</div>
</form>
</div>
