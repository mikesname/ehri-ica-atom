<?php use_helper('Javascript') ?>

<h1><?php echo __('Log in') ?></h1>

<?php if ('user' != $sf_request->module || 'login' != $sf_request->action): ?>
  <div class="messages status">
    <?php echo __('Please log in to access that page') ?>
  </div>
<?php endif; ?>

<?php echo $form->renderGlobalErrors() ?>

<?php echo $form->renderFormTag(url_for(array('module' => 'user', 'action' => 'login'))) ?>

  <?php echo $form->renderHiddenFields() ?>

  <fieldset>

    <?php echo $form->email->renderRow() ?>

    <?php echo $form->password->renderRow() ?>

    <div class="actions section">

      <h2 class="element-invisible"><?php echo __('Actions') ?></h2>

      <div class="content">
        <ul class="clearfix links">
          <li><?php echo submit_tag(__('Log in')) ?></li>
        </ul>
      </div>

    </div>

  </fieldset>

</form>

<?php echo javascript_tag('jQuery("[name=email]").select();') ?>
