<?php use_helper('Javascript') ?>

<div class="pageTitle">
  <?php if (isset($sf_request->id)): ?>
  <?php echo __('Edit user') ?>
  <?php else: ?>
  <?php echo __('Create new user') ?>
  <?php endif; ?>
</div>

<form method="post" action="<?php echo url_for(array('module' => 'user', 'action' => 'edit', 'id' => $user->id)) ?>">

<div class="formHeader">
  <?php if (isset($sf_request->id)): ?>
  <?php echo link_to(__('%1% profile', array('%1%' => $user->username)), array('module' => 'user', 'action' => 'show', 'id' => $user->id)) ?>
  <?php else: ?>
  <?php echo __('new user') ?>
  <?php endif; ?>
</div>

<fieldset class="collapsible" id="detailsArea">
  <legend><?php echo __('basic info')?></legend>

  <?php echo render_field($form->username, $user) ?>
  <?php echo render_field($form->email, $user) ?>

  <div>
    <?php $settings = json_encode(array('password' => array('strengthTitle' => 'Password strength:', 'hasWeaknesses' => 'To make your password stronger:', 'tooShort' => 'Make it at least six characters', 'addLowerCase' => 'Add lowercase letters', 'addUpperCase' => 'Add uppercase letters', 'addNumbers' => 'Add numbers', 'addPunctuation' => 'Add punctuation', 'sameAsUsername' => 'Make it different from your username', 'confirmSuccess' => 'yes', 'confirmFailure' => 'no', 'confirmTitle' => 'Passwords match:', 'username' => ''))) ?>
<?php echo javascript_tag(<<<EOF
jQuery.extend(Drupal.settings, $settings);
EOF
) ?>
    <?php echo $form->password->renderError() ?>
    <table class="inline">
      <thead>
      <tr>
        <th>
          <?php if (isset($sf_request->id)): ?>
          <?php echo $form->password->label(__('change password'))->renderLabel() ?>
          <?php else: ?>
          <?php echo $form->password->label(__('password'))->renderLabel() ?>
          <?php endif; ?>
        </th>
        <th>
          <?php echo $form->password->label(__('confirm password'))->renderLabel() ?>
        </th>
      </thead>
      <tbody>
      <tr>
        <td>
          <?php echo $form->password->render(array('class' => 'password-field')) ?>
        </td>
        <td>
          <?php echo $form->confirmPassword->render(array('class' => 'password-confirm')) ?>
        </td>
      </tr>
      </tbody>
    </table>
  </div>
</fieldset>

<fieldset class="collapsible collapsed" id="groupsAndPermissions">
  <legend><?php echo __('groups and permissions')?></legend>

  <div class="form-item" style="width: 90%">
    <?php echo $form->groups->label(__('groups'))->renderLabel() ?>
    <?php echo $form->groups->render(array('class' => 'form-autocomplete')) ?>
  </div>

  <?php if (0 < count($permissions)): ?>
  <table class="inline">
    <caption><?php echo __('Existing permissions (archival descriptions)'); ?></caption>
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
  <?php endif; ?>

  <table class="inline">
    <caption><?php echo __('Add a new permission (archival descriptions)'); ?></caption>
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
          <input class="list" type="hidden" value="<?php echo $this->context->routing->generate(null, array('module' => 'repository', 'action' => 'autocomplete')) ?>" />
          </div>
        </td>
        <td>&nbsp;</td>
      </tr>
    </tbody>
  </table>
</fieldset>

<!-- include empty div at bottom of form to bump the fixed button-block and allow user to scroll past it -->
<div id="button-block-bump"></div>

<ul class="actions">
  <?php if (isset($sf_request->id)): ?>
  <li><?php echo link_to(__('Cancel'), array('module' => 'user', 'action' => 'show', 'id' => $user->getId())) ?></li>
  <?php else: ?>
  <li><?php echo link_to(__('Cancel'), array('module' => 'user', 'action' => 'list')) ?></li>
  <?php endif; ?>

  <?php if ($user->getId()): ?>
    <li><?php echo submit_tag(__('Save')) ?></li>
  <?php else: ?>
    <li><?php echo submit_tag(__('Create')) ?></li>
  <?php endif; ?>
</ul>

</form>
