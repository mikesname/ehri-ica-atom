<h1><?php echo __('Edit contact information') ?></h1>

<h1 class="label"><?php echo render_title($contactInformation->actor) ?></h1>

<?php echo $form->renderGlobalErrors() ?>

<?php if (isset($sf_request->id)): ?>
  <?php echo $form->renderFormTag(url_for(array($contactInformation, 'module' => 'actor', 'action' => 'editContactInformation'))) ?>
<?php else: ?>
  <?php echo $form->renderFormTag(url_for(array('module' => 'actor', 'action' => 'createContactInformation'))) ?>
<?php endif; ?>

  <?php echo $form->renderHiddenFields() ?>

  <?php echo $form->streetAddress->renderRow() ?>

  <?php echo render_field($form->city, $contactInformation) ?>

  <?php echo render_field($form->region
    ->label(__('Region/province')), $contactInformation) ?>

  <?php echo $form->countryCode
    ->label(__('Country'))
    ->renderRow(array('class' => 'form-autocomplete')) ?>

  <?php echo $form->postalCode->renderRow() ?>

  <?php echo $form->latitude->renderRow() ?>

  <?php echo $form->longitude->renderRow() ?>

  <?php echo $form->telephone->renderRow() ?>

  <?php echo $form->fax->renderRow() ?>

  <?php echo $form->email->renderRow() ?>

  <?php echo $form->website->renderRow() ?>

  <?php echo $form->contactPerson->renderRow() ?>

  <?php echo $form->primaryContact
    ->label(__('Primary contact?'))->renderRow() ?>

  <?php echo render_field($form->contactType, $contactInformation) ?>

  <?php echo render_field($form->note, $contactInformation, array('class' => 'resizable')) ?>

  <div class="actions section">

    <h2 class="element-invisible"><?php echo __('Actions') ?></h2>

    <div class="content">
      <ul class="clearfix links">

        <?php if (null !== $next = $form->getValue('next')): ?>
          <li><?php echo link_to(__('Cancel'), $next) ?></li>
        <?php else: ?>
          <li><?php echo link_to(__('Cancel'), array($contactInformation->actor, 'module' => 'actor', 'action' => 'edit')) ?></li>
        <?php endif; ?>

        <?php if (isset($sf_request->id)): ?>
          <li><?php echo submit_tag(__('Save')) ?></li>
        <?php else: ?>
          <li><?php echo submit_tag(__('Create')) ?></li>
        <?php endif; ?>

      </ul>
    </div>

  </div>

</form>
