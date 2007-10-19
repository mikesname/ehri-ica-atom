<?php use_helper('Validation') ?>
<div class="pageTitle"></div>

<div class="login-form">
<fieldset>
<?php  if ($login_message) { echo '<legend>'.$login_message.'</legend>'; } ?>
<?php echo form_tag('user/login') ?>
<div class="form-item">
<label for="email"><?php echo __('email'); ?></label>
<?php echo __(form_error('email')) ?>
<?php echo input_tag('email', $sf_params->get('email')) ?>
</div>

<div class="form-item">
<label for="password"><?php echo __('password'); ?></label>
<td><?php echo __(form_error('password')) ?>
<?php echo input_password_tag('password') ?>
</div>

<!-- use a Javascript hack to set the focus on the text box -->
<script type="text/javascript">
document.forms[3][0].focus();
</script>

<div class="menu-action">
<?php echo input_hidden_tag('referer', $sf_request->getAttribute('referer')) ?>
<?php echo my_submit_tag(__('log in'), array('style' => 'width: auto;')) ?>
</div>
</fieldset>
</form>
</div>
