<?php use_helper('Validation') ?>
<?php use_helper('Javascript') ?>
<div class="pageTitle"></div>

<div class="login-form">
<fieldset>
<?php  if ($login_message): ?>
  <legend><?php echo $login_message ?></legend>
<?php endif; ?>
<?php echo form_tag('user/login') ?>
<div class="form-item">
<label for="email"><?php echo __('email'); ?></label>

<?php echo input_tag('email', $sf_params->get('email')) ?>
</div>

<div class="form-item">
<label for="password"><?php echo __('password'); ?></label>

<?php echo input_password_tag('password') ?>
</div>

<!--set initial focus to email input control -->
<?php echo javascript_tag(<<<EOF
$('[name=email]').focus();
EOF
) ?>

<div class="menu-action">
<?php echo input_hidden_tag('referer', $sf_request->getAttribute('referer')) ?>
<?php echo my_submit_tag(__('log in'), array('style' => 'width: auto;')) ?>
</div>
</fieldset>
</form>
</div>
