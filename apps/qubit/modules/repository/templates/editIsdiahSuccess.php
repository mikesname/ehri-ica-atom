<?php use_helper('Javascript') ?>

<h1><?php echo __('Edit %1% - ISDIAH', array('%1%' => sfConfig::get('app_ui_label_repository'))) ?></h1>

<h1 class="label"><?php echo render_title($repository) ?></h1>

<?php if (isset($sf_request->id)): ?>
  <?php echo $form->renderFormTag(url_for(array($repository, 'module' => 'repository', 'action' => 'edit'))) ?>
<?php else: ?>
  <?php echo $form->renderFormTag(url_for(array('module' => 'repository', 'action' => 'create'))) ?>
<?php endif; ?>

  <?php echo $form->renderHiddenFields() ?>

  <fieldset class="collapsible collapsed" id="identityArea">

    <legend><?php echo __('Identity area') ?></legend>

    <?php echo $form->identifier
      ->label(__('Identifier').' <span class="form-required" title="'.__('This is a mandatory element.').'">*</span>')
      ->renderRow() ?>

    <?php echo render_field($form->authorizedFormOfName
      ->label(link_to_if(isset($sf_request->id), __('Authorized form of name'), array($repository, 'module' => 'actor', 'action' => 'edit', 'repositoryReroute' => $repository->id)).' <span class="form-required" title="'.__('This is a mandatory element').'">*</span>'), $repository) ?>

    <?php echo $form->parallelName
      ->label('Parallel form(s) of name')
      ->renderRow() ?>

    <?php echo $form->otherName
      ->label('Other form(s) of name')
      ->renderRow() ?>

    <?php echo $form->types
      ->label(__('Type'))
      ->renderRow(array('class' => 'form-autocomplete')) ?>

  </fieldset>

 <fieldset class="collapsible collapsed" id="contactArea">

   <legend><?php echo __('Contact area') ?></legend>

   <div class="form-item">

      <label for="contact_information"><?php echo __('Contact information') ?><span title="<?php echo __('This is a mandatory element.') ?>" class="form-required">*</span></label>

      <?php foreach ($contactInformation as $item): ?>

        <table class="inline">
          <tr>
            <td class="headerCell" style="margin-top: 5px; border-top: 2px solid #999999; width: 90%">
              <?php echo $item->getContactType(array('cultureFallback' => true)) ?><?php if ($item->getPrimaryContact()): ?> (<?php echo __('Primary contact') ?>)<?php endif; ?>
              </td><td style="width: 20px; border-top: 2px solid #cccccc; border-bottom: 1px solid #cccccc">
                <?php echo link_to(image_tag('pencil'), array($item, 'module' => 'actor', 'action' => 'editContactInformation', 'repositoryReroute' => $repository->id)) ?>
              </td><td style="width: 20px; border-top: 2px solid #cccccc; border-bottom: 1px solid #cccccc">
                <?php echo link_to(image_tag('delete'), array('module' => 'actor', 'action' => 'deleteContactInformation', 'contactInformationId' => $item->id, 'returnTemplate' => 'isdiah')) ?>
              </td>
            </tr>
          </table>

          <?php echo get_partial('repository/contactInformation', array('contactInformation' => $item)) ?>

        <?php endforeach; ?>

      <table class="inline">
        <tr>
          <td class="headerCell" colspan="4" style="margin-top: 5px; border-top: 2px solid #999999; width: 95%">
            <?php echo __('New contact information') ?>
          </td>
        </tr><tr>
          <td class="headerCell">
            <?php echo __('Street address') ?>
          </td><td>
            <?php echo textarea_tag('street_address') ?>
          </td>
        </tr><tr>
          <td class="headerCell">
            <?php echo __('City') ?>
          </td><td>
            <?php echo input_tag('city') ?>
          </td>
        </tr><tr>
          <td class="headerCell">
            <?php echo __('Region/province') ?>
          </td><td>
            <?php echo input_tag('region') ?>
          </td>
        </tr><tr>
          <td class="headerCell">
            <?php echo __('Country') ?>
          </td><td>
            <?php echo select_country_tag('country_code', null, array('include_blank' => true)) ?>
          </td>
        </tr><tr>
          <td class="headerCell">
            <?php echo __('Postal code') ?>
          </td><td>
            <?php echo input_tag('postal_code') ?>
          </td>
        </tr><tr>
          <td class="headerCell">
            <?php echo __('Telephone') ?>
          </td><td>
            <?php echo input_tag('telephone') ?>
          </td>
        </tr><tr>
          <td class="headerCell">
            <?php echo __('Fax') ?>
          </td><td>
            <?php echo input_tag('fax') ?>
          </td>
        </tr><tr>
          <td class="headerCell">
            <?php echo __('Email') ?>
          </td><td>
            <?php echo input_tag('email') ?>
          </td>
        </tr><tr>
          <td class="headerCell">
            <?php echo __('Website') ?>
          </td><td>
            <?php echo input_tag('website') ?>
          </td>
        </tr><tr>
          <td class="headerCell">
            <?php echo __('Contact person') ?>
          </td><td>
            <?php echo input_tag('contact_person') ?>
          </td>
        </tr><tr>
          <td class="headerCell">
            <?php echo __('Primary contact') ?>
          </td><td>
            <?php echo checkbox_tag('primary_contact') ?>
          </td>
        </tr><tr>
          <td class="headerCell">
            <?php echo __('Contact type') ?>
          </td><td>
            <?php echo input_tag('contact_type') ?>
          </td>
        </tr><tr>
          <td class="headerCell">
            <?php echo __('Note') ?>
          </td><td>
            <?php echo textarea_tag('contact_information_note', null, array('class' => 'resizable', 'size' => '30x3')) ?>
          </td>
        </tr>
      </table>
    </div>

  </fieldset>

  <!-- ******************************************* -->
  <!-- Description area                            -->
  <!-- ******************************************* -->
  <fieldset class="collapsible collapsed" id="descriptionArea">

    <legend><?php echo __('Description area') ?></legend>

    <?php echo render_field($form->history, $repository, array('class' => 'resizable')) ?>

    <?php echo render_field($form->geoculturalContext
      ->label(__('Geographical and cultural context')), $repository, array('class' => 'resizable')) ?>

    <?php echo render_field($form->mandates
      ->label(__('Mandates/Sources of authority')), $repository, array('class' => 'resizable')) ?>

    <?php echo render_field($form->internalStructures
      ->label(__('Administrative structure')), $repository, array('class' => 'resizable')) ?>

    <?php echo render_field($form->collectingPolicies
      ->label(__('Records management and collecting policies')), $repository, array('class' => 'resizable')) ?>

    <?php echo render_field($form->buildings, $repository, array('class' => 'resizable')) ?>

    <?php echo render_field($form->holdings
      ->label(__('Archival and other holdings')), $repository, array('class' => 'resizable')) ?>

    <?php echo render_field($form->findingAids
      ->label(__('Finding aids, guides and publications')), $repository, array('class' => 'resizable')) ?>

  </fieldset>

  <!-- ******************************************* -->
  <!-- Access area                                 -->
  <!-- ******************************************* -->
  <fieldset class="collapsible collapsed" id="accessArea">

    <legend><?php echo __('Access area') ?></legend>

    <?php echo render_field($form->openingTimes, $repository, array('class' => 'resizable')) ?>

    <?php echo render_field($form->accessConditions
      ->label(__('Conditions and requirements')), $repository, array('class' => 'resizable')) ?>

    <?php echo render_field($form->disabledAccess
      ->label(__('Accessibility')), $repository, array('class' => 'resizable')) ?>

  </fieldset>

  <!-- ******************************************* -->
  <!-- Services area                               -->
  <!-- ******************************************* -->
  <fieldset class="collapsible collapsed" id="servicesArea">

    <legend><?php echo __('Services area') ?></legend>

    <?php echo render_field($form->researchServices, $repository, array('class' => 'resizable')) ?>

    <?php echo render_field($form->reproductionServices, $repository, array('class' => 'resizable')) ?>

    <?php echo render_field($form->publicFacilities
      ->label(__('Public areas')), $repository, array('class' => 'resizable')) ?>

  </fieldset>

  <fieldset class="collapsible collapsed" id="controlArea">

    <legend><?php echo __('Control area') ?></legend>

    <?php echo render_field($form->descIdentifier
      ->label(__('Description identifier')), $repository) ?>

    <?php echo render_field($form->descInstitutionIdentifier
      ->label(__('Institution identifier')), $repository) ?>

    <?php echo render_field($form->descRules
      ->label(__('Rules and/or conventions used')), $repository, array('class' => 'resizable')) ?>

    <?php echo $form->descStatus
      ->label('Status')
      ->renderRow() ?>

    <?php echo $form->descDetail
      ->label('Level of detail')
      ->renderRow() ?>

    <?php echo render_field($form->descRevisionHistory
      ->label(__('Dates of creation, revision and deletion')), $repository, array('class' => 'resizable')) ?>

    <?php echo $form->language
      ->label('Language(s)')
      ->renderRow(array('class' => 'form-autocomplete')) ?>

    <?php echo $form->script
      ->label('Script(s)')
      ->renderRow(array('class' => 'form-autocomplete')) ?>

    <?php echo render_field($form->descSources
      ->label(__('Sources')), $repository, array('class' => 'resizable')) ?>

    <?php echo render_field($form->maintenanceNotes, $maintenanceNote, array('name' => 'content', 'class' => 'resizable')) ?>

  </fieldset>

  <div class="actions section">

    <h2 class="element-invisible"><?php echo __('Actions') ?></h2>

    <div class="content">
      <ul class="clearfix links">
        <?php if (isset($sf_request->id)): ?>
          <li><?php echo link_to(__('Cancel'), array($repository, 'module' => 'repository')) ?></li>
          <li><?php echo submit_tag(__('Save')) ?></li>
        <?php else: ?>
          <li><?php echo link_to(__('Cancel'), array('module' => 'repository', 'action' => 'list')) ?></li>
          <li><?php echo submit_tag(__('Create')) ?></li>
        <?php endif; ?>
      </ul>
    </div>

  </div>

</form>
