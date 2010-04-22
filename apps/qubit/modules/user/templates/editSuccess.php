<?php use_helper('Javascript') ?>

<h1>
  <?php if (isset($sf_request->id)): ?>
    <?php echo __('Edit user') ?>
  <?php else: ?>
    <?php echo __('Create new user') ?>
  <?php endif; ?>
</h1>

<?php if (isset($sf_request->id)): ?>
  <h1 class="label"><?php echo __('%1% profile', array('%1%' => $user->username)) ?></h1>
<?php endif; ?>

<?php echo $form->renderFormTag(url_for(array($user, 'module' => 'user', 'action' => 'edit')), array('id' => 'editForm')) ?>

  <fieldset class="collapsible" id="basicInfo">

    <legend><?php echo __('Basic info')?></legend>

    <?php echo render_field($form->username, $user) ?>

    <?php echo render_field($form->email, $user) ?>

    <?php $settings = json_encode(array('password' => array('strengthTitle' => 'Password strength:', 'hasWeaknesses' => 'To make your password stronger:', 'tooShort' => 'Make it at least six characters', 'addLowerCase' => 'Add lowercase letters', 'addUpperCase' => 'Add uppercase letters', 'addNumbers' => 'Add numbers', 'addPunctuation' => 'Add punctuation', 'sameAsUsername' => 'Make it different from your username', 'confirmSuccess' => 'yes', 'confirmFailure' => 'no', 'confirmTitle' => 'Passwords match:', 'username' => ''))) ?>
    <?php echo javascript_tag(<<<EOF
jQuery.extend(Drupal.settings, $settings);
EOF
) ?>
    <?php echo $form->password->renderError() ?>

    <div class="form-item password-parent">

      <?php if (isset($sf_request->id)): ?>
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
        <?php if (isset($sf_request->id)): ?>
          <li><?php echo link_to(__('Cancel'), array($user, 'module' => 'user')) ?></li>
          <li><?php echo submit_tag(__('Save')) ?></li>
        <?php else: ?>
          <li><?php echo link_to(__('Cancel'), array('module' => 'user', 'action' => 'list')) ?></li>
          <li><?php echo submit_tag(__('Create')) ?></li>
        <?php endif; ?>
      </ul>
    </div>

  </div>

</form>
