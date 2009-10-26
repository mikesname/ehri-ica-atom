<?php use_helper('Javascript') ?>

<div class="pageTitle"><?php echo __('reset password'); ?></div>

<form method="post" action="<?php echo url_for(array('module' => 'user', 'action' => 'passwordEdit')) ?>">

<?php echo object_input_hidden_tag($user, 'getId') ?>

<div class="formHeader">
  <?php echo __('reset password: %1%', array('%1%' => $user)) ?>
</div>

<fieldset>
<div>
  <?php $settings = json_encode(array('password' => array('strengthTitle' => 'Password strength:', 'hasWeaknesses' => 'To make your password stronger:', 'tooShort' => 'Make it at least six characters', 'addLowerCase' => 'Add lowercase letters', 'addUpperCase' => 'Add uppercase letters', 'addNumbers' => 'Add numbers', 'addPunctuation' => 'Add punctuation', 'sameAsUsername' => 'Make it different from your username', 'confirmSuccess' => 'yes', 'confirmFailure' => 'no', 'confirmTitle' => 'Passwords match:', 'username' => ''))) ?>
  <?php echo javascript_tag(<<<EOF
jQuery.extend(Drupal.settings, $settings);
EOF
) ?>

  <?php echo $form->renderGlobalErrors() ?>
  
  <?php echo $form->password->label(__('change password'))->renderRow(array('class' => 'password-field')) ?>
  <br style="clear: both" />  
  <?php echo $form->confirmPassword->label(__('confirm password'))->renderRow(array('class' => 'password-confirm')) ?>
</div>
</fieldset>

<ul class="actions">
  <li><?php echo link_to(__('Cancel'), array('module' => 'user', 'action' => 'show', 'id' => $user->getId())) ?></li>
  <li><?php echo submit_tag(__('Save')) ?></li>
</ul>

</form>
