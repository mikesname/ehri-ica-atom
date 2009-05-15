<?php use_helper('Validation') ?>
<?php use_helper('Javascript') ?>
<div class="pageTitle"></div>

<div class="login-form">
<fieldset>
<?php if ($loginMessage): ?>
  <legend><?php echo $loginMessage ?></legend>
<?php endif; ?>

<?php if ($loginForm->hasGlobalErrors()): ?>
  <div class="validation_error"><?php echo $loginForm->renderGlobalErrors() ?></div>
<?php endif; ?>
  <form action="<?php echo url_for('user/login') ?>" method="POST">
    <?php if($loginError): ?>
      <div class="form_error">
        <?php if($loginError == 'invalid username') echo __('your email address was not found') ?>
        <?php if($loginError == 'invalid password') echo __('your email and password do not match') ?>
      </div>
    <?php endif; ?>

    <div class="form-item">
      <label for="email"><?php echo __('email'); ?></label>
      <?php if (strlen($error = $loginForm['email']->renderError())): ?><?php echo $error ?><?php endif; ?>
      <?php echo $loginForm['email'] ?>
    </div>
      
    <div class="form-item">
      <label for="password"><?php echo __('password'); ?></label>
      <?php if (strlen($error = $loginForm['password']->renderError())): ?><?php echo $error ?><?php endif; ?>
      <?php echo $loginForm['password'] ?>
    </div>
      
    <div class="menu-action">
      <?php echo input_hidden_tag('referer', $sf_request->getAttribute('referer')) ?>
      <?php echo submit_tag(__('log in')) ?>
    </div>
  </form>
</fieldset>

<!--set initial focus to email input control -->
<?php echo javascript_tag("$('[name=email]').focus()"); ?>
</div>
