<?php if ($sf_request->hasError('actor_id')): ?>
  <div class="form_error">
    <?php $sf_request->getError('actor_id') ?>
  </div>
<?php endif; ?>

<div class="pageTitle">
	<?php echo __('edit').' '.__('repository'); ?>
</div>

<?php echo form_tag('repository/update') ?>
  <?php echo object_input_hidden_tag($repository, 'getId') ?>

  <?php if ($repository->getActorId()): ?>
    <div class="formHeader">
      <?php echo link_to($repository, 'repository/show?id='.$repository->getId()) ?>
    </div>
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
      <label for="authorized_form_of_name"><?php echo __('authorized form of name'); ?></label>

      <?php if ($sf_request->hasError('actor_id')): ?>
        <div class="form_error">
          <?php $sf_request->getError('actor_id') ?>
        </div>
      <?php endif; ?>

      <?php if ($repository->getActorId()): ?>
        <?php echo link_to($repository->getActor(), 'actor/edit?id='.$repository->getActorId().'&repositoryReroute='.$repository->getId()) ?>
        <?php echo input_hidden_tag('actor_id', $repository->getActorId()) ?>
      <?php else: ?>
        <table class="inline"><tr><td class="headerCell" style="width: 40%;"><?php echo __('existing name'); ?></td><td class="headerCell" style="width:55%;"><i><?php echo __('or'); ?> </i><?php echo __('add').' '.__('new').' '.__('name'); ?></td><td class="headerCell" style="width: 5%;"></td></tr><tr><td>
        <?php echo object_select_tag($repository, 'getActorId', array('related_class' => 'Actor', 'include_blank' => true, 'peer_method' => 'getActors')) ?>
        </td><td><?php echo input_tag('NewActorAuthorizedName') ?></td><td>
        <?php echo submit_image_tag('add', 'class=submitAdd') ?></td></tr></table>
      <?php endif; ?>
    </div>

    <div class="form-item">
      <label for="other_name"><?php echo __('other names'); ?></label>
      <?php foreach ($otherNames as $otherName): ?>
        <?php echo $otherName['name'] ?> (<?php echo $otherName['nameType'] ?>)
        <?php if ($otherName['note']): ?>
          <span class="note"><?php $otherName['note'] ?></span>
        <?php endif; ?>
        <?php echo link_to(image_tag('pencil', 'align=top'), 'actor/edit?id='.$repository->getActorId()) ?>
        <br/>
      <?php endforeach; ?>
    </div>

    <div class="form-item">
      <label for="repository_type_id"><?php echo __('type'); ?></label>
      <?php echo object_select_tag($repository, 'getRepositoryTypeId', array('related_class' => 'Term', 'include_blank' => true, 'peer_method' => 'getRepositoryTypes')) ?>
    </div>
  </fieldset>

  <fieldset class="collapsible collapsed">
    <legend><?php echo __('contact area'); ?></legend>

    <div class="form-item">
      <label for="contact_info"><?php echo __('contact information'); ?></label>
      <?php if ($contactInformation): ?>
        <?php foreach ($contactInformation as $contact): ?>
          <table class="inline" style="margin-bottom: 15px;"><tr><td style="border-top: 2px solid #cccccc; border-bottom: 1px solid #cccccc;">
          <?php echo $contact->getContactType() ?>
          <?php if ($contact->getPrimaryContact()): ?> (primary contact)<?php endif; ?>
          </td><td style="width: 20px; border-top: 2px solid #cccccc; border-bottom: 1px solid #cccccc;">
          <?php echo link_to(image_tag('pencil', 'align=top'), 'actor/editContactInformation?id='.$contact->getId().'&repositoryReroute='.$repository->getId()) ?></td>
          <td style="width: 20px; border-top: 2px solid #cccccc; border-bottom: 1px solid #cccccc;">
          <?php echo link_to(image_tag('delete', 'align=top'), 'actor/deleteContactInformation?contactInformationId='.$contact->getId()) ?>
          </td></tr></table>
          <div style="padding-left: 10px; margin-bottom: 10px;">
            <?php echo $contact->getContactInformationString() ?>
            <?php if ($contact->getNote()): ?><p><span class="note"><?php $contact->getNote() ?></span><?php endif; ?>
          </div>
        <?php endforeach; ?>
        <table class="inline">
        <tr><td class="headerCell" colspan="4" style="margin-top: 5px; border-top: 2px solid #999999; width: 95%;">new contact information</td><td align="right" style="border-top: 2px solid #999999;"><?php echo submit_image_tag('add', 'class=submitAdd') ?></tr></table>
      <?php endif; ?>

      <table class="inline">
        <tr><td class="headerCell"><?php echo __('contact type'); ?></td><td><?php echo object_input_tag($newContactInformation, 'getContactType', array('size' => 20)) ?></td></tr>
        <tr><td class="headerCell"><?php echo __('primary contact'); ?></td><td><?php echo object_checkbox_tag($newContactInformation, 'getPrimaryContact', array('style' => 'border: 0;')) ?></td></tr>
        <tr><td class="headerCell"><?php echo __('street address'); ?></td><td><?php echo object_textarea_tag($newContactInformation, 'getStreetAddress', array('size' => '30x3')) ?></td></tr>
        <tr><td class="headerCell"><?php echo __('city'); ?></td><td><?php echo object_input_tag($newContactInformation, 'getCity', array('size' => 20)) ?></td></tr>
        <tr><td class="headerCell"><?php echo __('region / province'); ?></td><td><?php echo object_input_tag($newContactInformation, 'getRegion', array('size' => 20)) ?></td></tr>
        <tr><td class="headerCell"><?php echo __('country'); ?></td><td><?php echo object_select_tag($newContactInformation, 'getCountryId', array('related_class' => 'Term', 'include_blank' => true, 'peer_method' => 'getCountries')) ?></td></tr>
        <tr><td class="headerCell"><?php echo __('postal code'); ?></td><td><?php echo object_input_tag($newContactInformation, 'getPostalCode', array('size' => 20)) ?></td></tr>
        <tr><td class="headerCell"><?php echo __('telephone'); ?></td><td><?php echo object_input_tag($newContactInformation, 'getTelephone', array('size' => 20)) ?></td></tr>
        <tr><td class="headerCell"><?php echo __('fax'); ?></td><td><?php echo object_input_tag($newContactInformation, 'getFax', array('size' => 20)) ?></td></tr>
        <tr><td class="headerCell"><?php echo __('email'); ?></td><td><?php echo object_input_tag($newContactInformation, 'getEmail', array('size' => 20)) ?></td></tr>
        <tr><td class="headerCell"><?php echo __('website'); ?></td><td><?php echo object_input_tag($newContactInformation, 'getWebsite', array('size' => 20)) ?></td></tr>
        <tr><td class="headerCell"><?php echo __('note'); ?></td><td><?php input_tag('contactInformationNote') ?></td></tr>
        </table>
    </div>

    <div class="form-item">
      <label for="officers_in_charge"><?php echo __('officers in charge'); ?></label>
      <?php echo object_input_tag($repository, 'getOfficersInCharge', array('size' => 20)) ?>
    </div>
  </fieldset>

  <fieldset class="collapsible collapsed">
    <legend><?php echo __('description area'); ?></legend>

    <div class="form-item">
      <label for="geocultural_context"><?php echo __('geographical and cultural context'); ?></label>
      <?php echo object_textarea_tag($repository, 'getGeoculturalContext', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="history"><?php echo __('history'); ?></label>
      <table class="inline" style="width: 98%;">
        <tr><td style="width: 95%; border: 0;"><?php echo nl2br($history) ?></td><td style="border: 0;"><?php echo link_to(image_tag('pencil', 'align=top'), 'actor/edit?id='.$repository->getActorId().'&repositoryReroute='.$repository->getId()) ?></td></tr>
      </table>
    </div>

    <div class="form-item">
      <label for="structure"><?php echo __('structure'); ?></label>
      <table class="inline" style="width: 98%;">
        <tr><td style="width: 95%; border: 0;"><?php echo nl2br($structure) ?></td><td style="border: 0;"><?php echo link_to(image_tag('pencil', 'align=top'), 'actor/edit?id='.$repository->getActorId().'&repositoryReroute='.$repository->getId()) ?></td></tr>
      </table>
    </div>

    <div class="form-item">
      <label for="collecting_policies"><?php echo __('collecting policies'); ?></label>
      <?php echo object_textarea_tag($repository, 'getCollectingPolicies', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="buildings"><?php echo __('buildings'); ?></label>
      <?php echo object_input_tag($repository, 'getBuildings', array('size' => 20)) ?>
    </div>

    <div class="form-item">
      <label for="holdings"><?php echo __('archival and other holdings'); ?></label>
      <?php echo object_textarea_tag($repository, 'getHoldings', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="finding_aids"><?php echo __('finding aids and publications'); ?></label>
      <?php echo object_textarea_tag($repository, 'getFindingAids', array('size' => '30x3')) ?>
    </div>
  </fieldset>

  <fieldset class="collapsible collapsed">
    <legend><?php echo __('access area'); ?></legend>

    <div class="form-item">
      <label for="opening_times"><?php echo __('opening times'); ?></label>
      <?php echo object_textarea_tag($repository, 'getOpeningTimes', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="access_conditions"><?php echo __('conditions and requirements'); ?></label>
      <?php echo object_textarea_tag($repository, 'getAccessConditions', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="disabled_access"><?php echo __('disabled access'); ?></label>
      <?php echo object_textarea_tag($repository, 'getDisabledAccess', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="transport"><?php echo __('transport'); ?></label>
      <?php echo object_textarea_tag($repository, 'getTransport', array('size' => '30x3')) ?>
    </div>
  </fieldset>

  <fieldset class="collapsible collapsed">
    <legend><?php echo __('services area'); ?></legend>

    <div class="form-item">
      <label for="research_services"><?php echo __('research services'); ?></label>
      <?php echo object_textarea_tag($repository, 'getResearchServices', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="reproduction_services"><?php echo __('reproduction services'); ?></label>
      <?php echo object_textarea_tag($repository, 'getReproductionServices', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="public_facilities"><?php echo __('public facilities'); ?></label>
      <?php echo object_textarea_tag($repository, 'getPublicFacilities', array('size' => '30x3')) ?>
    </div>
  </fieldset>

  <fieldset class="collapsible collapsed">
    <legend><?php echo __('control area'); ?></legend>

    <div class="form-item">
      <label for="description_identifier"><?php echo __('description identifier'); ?></label>
      <?php echo object_input_tag($repository, 'getDescriptionIdentifier', array('size' => 20)) ?>
    </div>

    <div class="form-item">
      <label for="institution_identifier"><?php echo __('institution identifier'); ?></label>
      <?php echo object_input_tag($repository, 'getInstitutionIdentifier', array('size' => 20)) ?>
    </div>

    <div class="form-item">
      <label for="rules"><?php echo __('rules or conventions'); ?></label>
      <?php echo object_textarea_tag($repository, 'getRules', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="status_id"><?php echo __('status'); ?></label>
      <?php echo object_select_tag($repository, 'getStatusId', array('related_class' => 'Term', 'include_blank' => true, 'peer_method' => 'getAuthorityFileStatus')) ?>
    </div>

    <div class="form-item">
      <label for="level_of_detail"><?php echo __('level of detail'); ?></label>
      <?php echo object_select_tag($repository, 'getLevelOfDetailId', array('related_class' => 'Term', 'include_blank' => true, 'peer_method' => 'getAuthorityFileDetail')) ?>
    </div>

    <div class="form-item">
      <label for="dates"><?php echo __('dates of creation, revision and deletion'); ?></label>
    </div>

    <div class="form-item">
      <label for="language_id"><?php echo __('languages of institution description'); ?></label>
      <?php foreach ($languages as $language): ?>
        <?php echo $language['termName'] ?>&nbsp;<?php echo link_to(image_tag('delete', 'align=top'), 'repository/deleteTermRelationship?TermRelationshipId='.$language['relationshipId']) ?><br/>
      <?php endforeach; ?>

      <?php echo object_select_tag($newLanguage, 'getTermId', array('name' => 'language_id', 'id' => 'language_id', 'include_blank' => true, 'peer_method' => 'getLanguages')) ?>
    </div>

    <div class="form-item">
      <label for="script_id"><?php echo __('scripts of institution description'); ?></label>
      <?php foreach ($scripts as $script): ?>
        <?php echo $script['termName'] ?>&nbsp;<?php echo link_to(image_tag('delete', 'align=top'), 'repository/deleteTermRelationship?TermRelationshipId='.$script['relationshipId']) ?><br/>
      <?php endforeach; ?>

      <?php echo object_select_tag($newScript, 'getTermId', array('name' => 'script_id', 'id' => 'script_id', 'related_class' => 'Term', 'include_blank' => true, 'peer_method' => 'getScripts')) ?>
    </div>

    <div class="form-item">
      <label for="sources"><?php echo __('sources'); ?></label>
      <?php echo object_textarea_tag($repository, 'getSources', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="notes"><?php echo __('notes'); ?></label>
      <table class="inline">
        <tr><td class="headerCell" style="width: 65%;"><?php echo __('note'); ?></td><td class="headerCell" style="width: 30%"><?php echo __('note type'); ?></td><td class="headerCell" style="width: 5%;"></td></tr>
        <?php foreach ($notes as $note): ?>
          <tr><td><?php $note['note'] ?><br/><span class="note"><?php $note['noteAuthor'] ?>, <?php $note['updated'] ?></span></td><td><?php $note['noteType'] ?></td><td style="text-align: center;"><?php link_to(image_tag('delete', 'align=top'), 'actor/deleteNote?noteId='.$note['noteId']) ?></td></tr>
        <?php endforeach; ?>
        <tr valign="top"><td><?php echo object_textarea_tag($newNote, 'getNote', array('size' => '10x1')) ?></td><td><?php echo object_select_tag($newNote, 'getNoteTypeId', array('name' => 'note_type_id', 'id' => 'note_type_id', 'related_class' => 'Term', 'include_blank' => true, 'peer_method' => 'getNoteTypes', 'style' => 'width: 120px;')) ?></td><td style="text-align: center;"><?php echo submit_image_tag('add', 'class=submitAdd') ?></td></tr>
      </table>
    </div>

    <div class="form-item">
      <label for="created_at"><?php echo __('created'); ?></label>
      <?php echo $repository->getCreatedAt() ?>
    </div>

    <div class="form-item">
      <label for="updated_at"><?php echo __('updated'); ?></label>
      <?php echo $repository->getUpdatedAt() ?>
    </div>
  </fieldset>

  <div class="menu-action">
    <?php if ($repository->getId()): ?>
      &nbsp;<?php echo link_to(__('delete'), 'repository/delete?id='.$repository->getId(), 'post=true&confirm='.__('are you sure?')) ?>
      &nbsp;<?php echo link_to(__('cancel'), 'repository/show?id='.$repository->getId()) ?>
    <?php else: ?>
      &nbsp;<?php echo link_to(__('cancel'), 'repository/list') ?>
    <?php endif; ?>
    <?php echo my_submit_tag(__('save'), array('style' => 'width: auto;')) ?>
  </div>
</form>

<div class="menu-extra">
  <?php echo link_to(__('add').' '.__('new').' '.__('repository'), 'repository/create'); ?>
	<?php echo link_to(__('list').' '.__('all').' '.__('repositories'), 'repository/list'); ?>
</div>
