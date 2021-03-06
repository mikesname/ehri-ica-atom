<?php use_helper('Javascript') ?>

<h1>
  <?php if (isset($sf_request->getAttribute('sf_route')->resource)): ?>
    <?php echo __('Edit user') ?>
  <?php else: ?>
    <?php echo __('Add new user') ?>
  <?php endif; ?>
</h1>

<h1 class="label"><?php echo render_title($resource) ?></h1>

<?php echo $form->renderFormTag(url_for(array($resource, 'module' => 'user', 'action' => 'edit')), array('id' => 'editForm')) ?>

  <fieldset class="collapsible" id="basicInfo">

    <legend><?php echo __('Basic info')?></legend>

    <?php echo $form->username->renderRow() ?>

    <?php echo $form->email->renderRow() ?>

    <?php $settings = json_encode(array(
      'password' => array(
        'strengthTitle' => __('Password strength:'),
        'hasWeaknesses' => __('To make your password stronger:'),
        'tooShort' => __('Make it at least six characters'),
        'addLowerCase' => __('Add lowercase letters'),
        'addUpperCase' => __('Add uppercase letters'),
        'addNumbers' => __('Add numbers'),
        'addPunctuation' => __('Add punctuation'),
        'sameAsUsername' => __('Make it different from your username'),
        'confirmSuccess' => __('Yes'),
        'confirmFailure' => __('No'),
        'confirmTitle' => __('Passwords match:'),
        'username' => ''))) ?>
    <?php echo javascript_tag(<<<EOF
jQuery.extend(Drupal.settings, $settings);
EOF
) ?>
    <?php echo $form->password->renderError() ?>

    <div class="form-item password-parent">

      <?php if (isset($sf_request->getAttribute('sf_route')->resource)): ?>
        <?php echo $form->password
          ->label(__('Change password'))
          ->renderLabel() ?>
      <?php else: ?>
        <?php echo $form->password
          ->label(__('Password'))
          ->renderLabel() ?>
      <?php endif; ?>

      <?php echo $form->password->render(array('class' => 'password-field')) ?>

    </div>

    <div class="form-item confirm-parent">
      <?php echo $form->password
        ->label(__('Confirm password'))
        ->renderLabel() ?>
      <?php echo $form->confirmPassword->render(array('class' => 'password-confirm')) ?>
    </div>

  </fieldset> <!-- /#basicInfo -->

  <fieldset class="collapsible collapsed" id="groupsAndPermissions">

    <legend><?php echo __('Access control')?></legend>

    <?php echo $form->groups
      ->label(__('User groups'))
      ->renderRow(array('class' => 'form-autocomplete')) ?>

    <?php echo $form->translate
      ->label(__('Allowed languages for translation'))
      ->renderRow(array('class' => 'form-autocomplete')) ?>

  </fieldset> <!-- /#groupsAndPermissions -->

  <div class="actions section">

    <h2 class="element-invisible"><?php echo __('Actions') ?></h2>

    <div class="content">
      <ul class="clearfix links">
        <?php if (isset($sf_request->getAttribute('sf_route')->resource)): ?>
          <li><?php echo link_to(__('Cancel'), array($resource, 'module' => 'user')) ?></li>
          <li><input class="form-submit" type="submit" value="<?php echo __('Save') ?>"/></li>
        <?php else: ?>
          <li><?php echo link_to(__('Cancel'), array('module' => 'user', 'action' => 'list')) ?></li>
          <li><input class="form-submit" type="submit" value="<?php echo __('Create') ?>"/></li>
        <?php endif; ?>
      </ul>
    </div>

  </div>

</form>
