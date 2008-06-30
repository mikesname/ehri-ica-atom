<?php use_helper('Javascript') ?>

<div class="pageTitle"><?php echo __('edit %1%', array('%1%' => sfConfig::get('app_ui_label_repository'))); ?></div>

<?php echo form_tag('repository/update') ?>
  <?php echo object_input_hidden_tag($repository, 'getId') ?>

  <?php if ($repository->getId()): ?>
    <div class="formHeader">
      <?php echo link_to($repository, 'repository/show?id='.$repository->getId()) ?>
    </div>
  <?php else: ?>
    <table class="list" style="height: 25px;"><thead><tr><th></th></tr></table>
  <?php endif; ?>

  <?php if ($sf_context->getActionName() == 'create'): ?>
  <fieldset class="collapsible">
  <?php else : ?>
  <fieldset class="collapsible collapsed">
  <?php endif; ?>

  <legend><?php echo __('identity area'); ?></legend>

    <div class="form-item">
      <label for="identifier"><?php echo __('identifier'); ?></label>
      <?php echo object_input_tag($repository, 'getIdentifier', array('size' => 20)) ?>
    </div>

    <div class="form-item">
      <label for="authorized_form_of_name">
        <?php if ($repository->getId()): ?>
          <?php echo link_to(__('authorized form of name'), 'actor/edit?id='.$repository->getId().'&repositoryReroute='.$repository->getId()) ?>
        <?php else: ?>
          <?php echo __('authorized form of name'); ?>
        <?php endif; ?>
     </label>
      <?php if (strlen($sourceCultureValue = $repository->getAuthorizedFormOfName(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $repository->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>   
       <?php echo object_input_tag($repository, 'getAuthorizedFormOfName', array('size' => 20)) ?>
    </div>

  <div class="form-item">
    <label for="other_name"><?php echo __('other names'); ?></label>
    <table class="inline"><tr>
      <td class="headerCell" style="width: 40%;"><?php echo __('name'); ?></td>
      <td class="headerCell" style="width: 20%;"><?php echo __('type'); ?></td>
      <td class="headerCell" style="width: 35%;"><?php echo __('note'); ?></td>
      <td class="headerCell" style="width: 5%;"></td>
      </tr>
      <?php if ($otherNames): ?>
        <?php foreach ($otherNames as $otherName): ?>
          <tr><td><?php echo $otherName->getName(array('cultureFallback' => true)) ?></td><td><?php echo $otherName->getType() ?></td>
          <td><?php echo $otherName->getNote(array('cultureFallback' => true)) ?></td>
          <td style="text-align: center;"><?php echo link_to(image_tag('delete', 'align=top'), 'actor/deleteOtherName?otherNameId='.$otherName->getId()) ?></td></tr>
        <?php endforeach; ?>
      <?php endif; ?>
      <tr><td>
      <?php echo input_tag('other_name','', 'size= 10') ?></td><td>

      <?php echo select_tag('other_name_type_id', options_for_select($otherNameTypes, null, array('include_blank' => true))) ?>

      </td><td>
      <?php echo input_tag('other_name_note','', 'size=10') ?></td>
      </tr>
    </table>
  </div>

    <div class="form-item">
      <label for="repository_type_id"><?php echo __('type'); ?></label>
      <?php echo object_select_tag($repository, 'getTypeId', array('related_class' => 'QubitTerm', 'include_blank' => true, 'peer_method' => 'getRepositoryTypes')) ?>
    </div>

  </fieldset>

 <fieldset class="collapsible collapsed">
    <legend><?php echo __('contact area'); ?></legend>

   <div class="form-item">
      <label for="contact_information"><?php echo __('contact information'); ?></label>
      <?php if (count($contactInformation) > 0): ?>
        <?php foreach ($contactInformation as $contact): ?>
          <table class="inline"><tr><td class="headerCell" style="margin-top: 5px; border-top: 2px solid #999999; width: 90%;">
          <?php echo $contact->getContactType() ?>
          <?php if ($contact->getPrimaryContact()): ?><?php echo '('.__('primary contact').')' ?><?php endif; ?>
          </td><td style="width: 20px; border-top: 2px solid #cccccc; border-bottom: 1px solid #cccccc;">
          <?php echo link_to(image_tag('pencil', 'align=top'), 'actor/editContactInformation?id='.$contact->getId().'&repositoryReroute='.$repository->getId()) ?></td>
          <td style="width: 20px; border-top: 2px solid #cccccc; border-bottom: 1px solid #cccccc;">
          <?php echo link_to(image_tag('delete', 'align=top'), 'actor/deleteContactInformation?contactInformationId='.$contact->getId()) ?>
          </td></tr></table>
          <div style="padding-left: 10px; margin-bottom: 10px;">
            <?php if ($contact->getContactPerson()): ?>
              <?php echo $contact->getContactPerson() ?><br />
            <?php endif; ?>
            <?php if ($contact->getStreetAddress()): ?>
              <?php echo nl2br($contact->getStreetAddress()) ?><br />
            <?php endif; ?>
            <?php if ($contact->getCity()): ?>
              <?php echo $contact->getCity() ?><br />
            <?php endif; ?>
            <?php if ($contact->getRegion()): ?>
              <?php echo $contact->getRegion() ?><br />
            <?php endif; ?>
            <?php if ($contact->getCountryCode()): ?>
              <?php echo format_country($contact->getCountryCode()) ?><br />
            <?php endif; ?>
            <?php if ($contact->getPostalCode()): ?>
              <?php echo $contact->getPostalCode() ?><br />
            <?php endif; ?>
            <?php if ($contact->getTelephone()): ?>
              <?php echo 'phone: '.$contact->getTelephone() ?><br />
            <?php endif; ?>
            <?php if ($contact->getFax()): ?>
              <?php echo 'fax: '.$contact->getFax() ?><br />
            <?php endif; ?>
            <?php if ($contact->getEmail()): ?>
              <?php echo $contact->getEmail() ?><br />
            <?php endif; ?>
            <?php if ($contact->getWebsite()): ?>
              <?php echo link_to($contact->getWebsite(), $contact->getWebsite()) ?><br />
            <?php endif; ?>
            <?php if ($contact->getNote()): ?>
              <span class="note"><?php echo $contact->getNote() ?></span>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>

      <table class="inline">
        <tr><td class="headerCell" colspan="4" style="margin-top: 5px; border-top: 2px solid #999999; width: 95%;"><?php echo __('new contact information') ?></td></tr>
        <tr><td class="headerCell"><?php echo __('contact type'); ?></td><td><?php echo input_tag('contact_type', '', 'size=20') ?></td></tr>
        <tr><td class="headerCell"><?php echo __('primary contact'); ?></td><td><?php echo checkbox_tag('primary_contact') ?></td></tr>
        <tr><td class="headerCell"><?php echo __('contact person'); ?></td><td><?php echo input_tag('contact_person', '', 'size=20') ?></td></tr>
        <tr><td class="headerCell"><?php echo __('street address'); ?></td><td><?php echo textarea_tag('street_address', '', 'size=30x3') ?></td></tr>
        <tr><td class="headerCell"><?php echo __('city'); ?></td><td><?php echo input_tag('city', '', 'size=20') ?></td></tr>
        <tr><td class="headerCell"><?php echo __('region/province'); ?></td><td><?php echo input_tag('region', '', 'size=20') ?></td></tr>
        <tr><td class="headerCell"><?php echo __('country'); ?></td><td><?php echo select_country_tag('country_code', null, array('include_blank' => true)) ?></td></tr>
        <tr><td class="headerCell"><?php echo __('postal code'); ?></td><td><?php echo input_tag('postal_code', '', 'size=20') ?></td></tr>
        <tr><td class="headerCell"><?php echo __('telephone'); ?></td><td><?php echo input_tag('telephone', '', 'size=20') ?></td></tr>
        <tr><td class="headerCell"><?php echo __('fax'); ?></td><td><?php echo input_tag('fax', '', 'size=20') ?></td></tr>
        <tr><td class="headerCell"><?php echo __('email'); ?></td><td><?php echo input_tag('email', '', 'size=20') ?></td></tr>
        <tr><td class="headerCell"><?php echo __('website'); ?></td><td><?php echo input_tag('website', '', 'size=20') ?></td></tr>
        <tr><td class="headerCell"><?php echo __('note'); ?></td><td><?php echo input_tag('contact_information_note', '', 'size=20') ?></td></tr>
        </table>
    </div>

  </fieldset>

 <fieldset class="collapsible collapsed">
    <legend><?php echo __('description area'); ?></legend>

    <div class="form-item">
      <label for="history"><?php echo __('history'); ?></label>
      <?php if (strlen($sourceCultureValue = $repository->getHistory(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $repository->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>       
       <?php echo object_textarea_tag($repository, 'getHistory', array('size' => '30x3')) ?>
    </div>
    
    <div class="form-item">
      <label for="geocultural_context"><?php echo __('geographical and cultural context'); ?></label>
      <?php if (strlen($sourceCultureValue = $repository->getGeoculturalContext(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $repository->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>       
      <?php echo object_textarea_tag($repository, 'getGeoculturalContext', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="mandates"><?php echo __('mandates or sources of authority'); ?></label>
      <?php if (strlen($sourceCultureValue = $repository->getMandates(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $repository->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?> 
      <?php echo object_textarea_tag($repository, 'getMandates', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="structure"><?php echo __('administrative structure'); ?></label>
      <?php if (strlen($sourceCultureValue = $repository->getInternalStructures(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $repository->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?> 
      <?php echo object_textarea_tag($repository, 'getInternalStructures', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="collecting_policies"><?php echo __('records management and collecting policies'); ?></label>
      <?php if (strlen($sourceCultureValue = $repository->getCollectingPolicies(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $repository->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?> 
      <?php echo object_textarea_tag($repository, 'getCollectingPolicies', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="buildings"><?php echo __('buildings'); ?></label>
      <?php if (strlen($sourceCultureValue = $repository->getBuildings(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $repository->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?> 
      <?php echo object_textarea_tag($repository, 'getBuildings', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="holdings"><?php echo __('archival and other holdings'); ?></label>
      <?php if (strlen($sourceCultureValue = $repository->getHoldings(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $repository->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?> 
      <?php echo object_textarea_tag($repository, 'getHoldings', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="finding_aids"><?php echo __('finding aids, guides, publications'); ?></label>
      <?php if (strlen($sourceCultureValue = $repository->getFindingAids(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $repository->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?> 
      <?php echo object_textarea_tag($repository, 'getFindingAids', array('size' => '30x3')) ?>
    </div>
  </fieldset>

  <fieldset class="collapsible collapsed">
    <legend><?php echo __('access area'); ?></legend>

    <div class="form-item">
      <label for="opening_times"><?php echo __('opening times'); ?></label>
      <?php if (strlen($sourceCultureValue = $repository->getOpeningTimes(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $repository->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?> 
      <?php echo object_textarea_tag($repository, 'getOpeningTimes', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="access_conditions"><?php echo __('conditions and requirements'); ?></label>
      <?php if (strlen($sourceCultureValue = $repository->getAccessConditions(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $repository->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?> 
      <?php echo object_textarea_tag($repository, 'getAccessConditions', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="disabled_access"><?php echo __('accessibility'); ?></label>
      <?php if (strlen($sourceCultureValue = $repository->getDisabledAccess(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $repository->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?> 
      <?php echo object_textarea_tag($repository, 'getDisabledAccess', array('size' => '30x3')) ?>
    </div>
  </fieldset>

  <fieldset class="collapsible collapsed">
    <legend><?php echo __('services area'); ?></legend>

    <div class="form-item">
      <label for="research_services"><?php echo __('research services'); ?></label>
      <?php if (strlen($sourceCultureValue = $repository->getResearchServices(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $repository->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?> 
      <?php echo object_textarea_tag($repository, 'getResearchServices', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="reproduction_services"><?php echo __('reproduction services'); ?></label>
      <?php if (strlen($sourceCultureValue = $repository->getReproductionServices(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $repository->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?> 
      <?php echo object_textarea_tag($repository, 'getReproductionServices', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="public_facilities"><?php echo __('public areas'); ?></label>
      <?php if (strlen($sourceCultureValue = $repository->getPublicFacilities(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $repository->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>       
      <?php echo object_textarea_tag($repository, 'getPublicFacilities', array('size' => '30x3')) ?>
    </div>
  </fieldset>

  <fieldset class="collapsible collapsed">
    <legend><?php echo __('control area'); ?></legend>

    <div class="form-item">
      <label for="desc_identifier"><?php echo __('description identifier'); ?></label>
      <?php if (strlen($sourceCultureValue = $repository->getDescIdentifier(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $repository->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>       <?php echo object_input_tag($repository, 'getDescIdentifier', array('size' => 20)) ?>
    </div>

    <div class="form-item">
      <label for="desc_institution_identifier"><?php echo __('institution responsible identifier'); ?></label>
      <?php echo object_input_tag($repository, 'getDescInstitutionIdentifier', array('size' => 20)) ?>
    </div>

    <div class="form-item">
      <label for="desc_rules"><?php echo __('rules or conventions'); ?></label>
      <?php if (strlen($sourceCultureValue = $repository->getDescRules(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $repository->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>       
      <?php echo object_textarea_tag($repository, 'getDescRules', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="desc_status_id"><?php echo __('status'); ?></label>
      <?php echo object_select_tag($repository, 'getDescStatusId', array('related_class' => 'QubitTerm', 'include_blank' => true, 'peer_method' => 'getDescriptionStatuses')) ?>
    </div>

    <div class="form-item">
      <label for="desc_detail_id"><?php echo __('level of detail'); ?></label>
      <?php echo object_select_tag($repository, 'getDescDetailId', array('related_class' => 'QubitTerm', 'include_blank' => true, 'peer_method' => 'getDescriptionDetailLevels')) ?>
    </div>

    <div class="form-item">
      <label for="desc_revision_history"><?php echo __('dates of creation, revision and deletion'); ?></label>
      <?php if (strlen($sourceCultureValue = $repository->getDescRevisionHistory(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $repository->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>       
      <?php echo object_textarea_tag($repository, 'getDescRevisionHistory', array('size' => '30x3')) ?>
    <div>

    <div class="form-item">
      <label for="language_code"><?php echo __('languages of institution description'); ?></label>

      <?php foreach ($languageCodes as $languageCode): ?>
        <div style="margin-top: 5px; margin-bottom: 5px;">
        <?php echo format_language($languageCode->getValue()) ?>&nbsp;<?php echo link_to(image_tag('delete', 'align=top'), 'actor/deleteProperty?Id='.$languageCode->getId()) ?><br/>
        </div>
      <?php endforeach; ?>

      <?php echo select_language_tag('language_code', null, array('include_blank' => true)) ?>
     </div>

    <div class="form-item">
      <label for="script_id"><?php echo __('scripts of institution description'); ?></label>

      <?php foreach ($scriptCodes as $scriptCode): ?>
        <div style="margin-top: 5px; margin-bottom: 5px;">
        <?php echo format_script($scriptCode->getValue()) ?>&nbsp;<?php echo link_to(image_tag('delete', 'align=top'), 'actor/deleteProperty?Id='.$scriptCode->getId()) ?><br/>
        </div>
      <?php endforeach; ?>

      <?php echo select_script_tag('script_code', null, array('include_blank' => true)) ?>
    </div>

    <div class="form-id">
      <label for="desc_sources"><?php echo __('sources'); ?></label>
      <?php if (strlen($sourceCultureValue = $repository->getDescSources(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $repository->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>       
      <?php echo object_textarea_tag($repository, 'getDescSources', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="notes"><?php echo __('notes'); ?></label>
      <table class="inline">
        <tr>
          <td class="headerCell" style="width: 65%;"><?php echo __('note'); ?></td>
          <td class="headerCell" style="width: 30%"><?php echo __('note type'); ?></td>
          <td class="headerCell" style="width: 5%;"></td>
        </tr>

        <?php foreach ($notes as $note): ?>
          <tr>
          <td><?php echo $note->getContent(array('cultureFallback' => true)) ?><br/><span class="note"><?php echo $note->getUser() ?>, <?php echo $note->getUpdatedAt() ?></span></td>
          <td><?php echo $note->getType() ?></td>
          <td style="text-align: center;"><?php echo link_to(image_tag('delete', 'align=top'), 'actor/deleteNote?noteId='.$note->getId()) ?></td>
          </tr>
        <?php endforeach; ?>

        <tr valign="top">
          <td><?php echo object_textarea_tag($newNote, 'getContent', array('size' => '10x1')) ?></td>
          <td><?php echo object_select_tag($newNote, 'getTypeId', array('name' => 'note_type_id', 'id' => 'note_type_id', 'related_class' => 'QubitTerm', 'include_blank' => true, 'peer_method' => 'getNoteTypes', 'style' => 'width: 120px;')) ?></td>
        </tr>
      </table>
    </div>

  </fieldset>

  <?php if ($sf_context->getActionName() == 'create'): ?>
  <!--set initial form focus -->
  <?php echo javascript_tag(<<<EOF
  $('[name=authorized_form_of_name]').focus();
EOF
  ) ?>
  <?php endif; ?>
  
  
<!-- include empty div at bottom of form to bump the fixed button-block and allow user to scroll past it -->
<div id="button-block-bump"></div>

<div id="button-block">  

  <div class="menu-action">
    <?php if ($repository->getId()): ?>
      &nbsp;<?php echo link_to(__('delete'), 'repository/delete?id='.$repository->getId(), 'post=true&confirm='.__('are you sure?')) ?>
      &nbsp;<?php echo link_to(__('cancel'), 'repository/show?id='.$repository->getId()) ?>
    <?php else: ?>
      &nbsp;<?php echo link_to(__('cancel'), 'repository/list') ?>
    <?php endif; ?>
    <?php if ($repository->getId()): ?>
      <?php echo my_submit_tag(__('save'), array('style' => 'width: auto;')) ?>
    <?php else: ?>
      <?php echo my_submit_tag(__('create'), array('style' => 'width: auto;')) ?>
    <?php endif; ?>
  </div>
</form>

<div class="menu-extra">
  <?php echo link_to(__('add new %1%', array('%1%' => sfConfig::get('app_ui_label_repository'))), 'repository/create'); ?>
  <?php echo link_to(__('list all %1%', array('%1%' => sfConfig::get('app_ui_label_repository'))), 'repository/list'); ?>
</div>

</div>
