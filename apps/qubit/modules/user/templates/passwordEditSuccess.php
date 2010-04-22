<?php use_helper('Javascript') ?>

<h1><?php echo __('Reset password'); ?></h1>

<form method="post" action="<?php echo url_for(array('module' => 'user', 'action' => 'passwordEdit')) ?>">

<?php echo object_input_hidden_tag($user, 'getId') ?>

<div class="formHeader">
  <?php echo __('Reset password: %1%', array('%1%' => $user)) ?>
</div>

<fieldset>
<div>
  <?php $settings = json_encode(array('password' => array('strengthTitle' => 'Password strength:', 'hasWeaknesses' => 'To make your password stronger:', 'tooShort' => 'Make it at least six characters', 'addLowerCase' => 'Add lowercase letters', 'addUpperCase' => 'Add uppercase letters', 'addNumbers' => 'Add numbers', 'addPunctuation' => 'Add punctuation', 'sameAsUsername' => 'Make it different from your username', 'confirmSuccess' => 'yes', 'confirmFailure' => 'no', 'confirmTitle' => 'Passwords match:', 'username' => ''))) ?>
  <?php echo javascript_tag(<<<EOF
jQuery.extend(Drupal.settings, $settings);
EOF
) ?>

  <?php echo $form->renderGlobalErrors() ?>
  
  <?php echo $form->password->label(__('Change password'))->renderRow(array('class' => 'password-field')) ?>
  <br style="clear: both" />  
  <?php echo $form->confirmPassword->label(__('Confirm password'))->renderRow(array('class' => 'password-confirm')) ?>
</div>
</fieldset>

  <div class="actions section">
    <h2 class="element-invisible"><?php echo __('Actions') ?></h2>
    <div class="content">
      <ul class="clearfix links">
        <li><?php echo link_to(__('Cancel'), array('module' => 'user', 'id' => $user->getId())) ?></li>
        <li><?php echo submit_tag(__('Save')) ?></li>
      </ul>
    </div>
  </div>

</form>
