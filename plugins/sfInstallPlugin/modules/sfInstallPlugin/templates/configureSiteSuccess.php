<?php use_helper('Javascript') ?>

<h2>Site configuration</h2>

<?php echo $form->renderFormTag(url_for(array('module' => 'sfInstallPlugin', 'action' => 'configureSite'))) ?>

  <fieldset>
    <legend>Site information</legend>

    <div class="description">
      <p>
        To set up your site, enter the following information.
      </p>
    </div>

    <?php echo $form->siteTitle->renderRow() ?>
    <?php echo $form->siteDescription->renderRow() ?>

  </fieldset>

  <fieldset>
    <legend>Administrator account</legend>

    <div class="description">
      <p>
        The administrator account has complete access to the site; it will automatically be granted all permissions and can perform any administrative activity. This will be the only account that can perform certain activities, so keep its credentials safe.
      </p>
    </div>

    <?php echo $form->username->renderRow() ?>
    <?php echo $form->email->renderRow(null, 'E-mail address') ?>

    <div>
      <?php $settings = json_encode(array('password' => array('strengthTitle' => 'Password strength:', 'hasWeaknesses' => 'To make your password stronger:', 'tooShort' => 'Make it at least six characters', 'addLowerCase' => 'Add lowercase letters', 'addUpperCase' => 'Add uppercase letters', 'addNumbers' => 'Add numbers', 'addPunctuation' => 'Add punctuation', 'sameAsUsername' => 'Make it different from your username', 'confirmSuccess' => 'yes', 'confirmFailure' => 'no', 'confirmTitle' => 'Passwords match:', 'username' => ''))) ?>
      <?php echo javascript_tag(<<<EOF
jQuery.extend(Drupal.settings, $settings);
EOF
) ?>

      <?php echo $form->password->renderRow(array('class' => 'password-field')) ?>
      <?php echo $form->confirmPassword->renderRow(array('class' => 'password-confirm')) ?>
    </div>

  </fieldset>

  <?php echo submit_tag('Save and continue') ?>
</form>
