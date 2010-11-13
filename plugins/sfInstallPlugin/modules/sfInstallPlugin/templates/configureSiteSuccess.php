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

    <?php echo $form->email->label('E-mail address')->renderRow() ?>

    <div>

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
          'confirmSuccess' => __('yes'),
          'confirmFailure' => __('no'),
          'confirmTitle' => __('Passwords match:'),
          'username' => ''))) ?>
      <?php echo javascript_tag(<<<EOF
jQuery.extend(Drupal.settings, $settings);
EOF
) ?>

      <?php echo $form->password->renderRow(array('class' => 'password-field')) ?>
      <?php echo $form->confirmPassword->renderRow(array('class' => 'password-confirm')) ?>

    </div>

  </fieldset>

  <input class="form-submit" type="submit" value="<?php echo 'Save and continue' ?>"/>

</form>
