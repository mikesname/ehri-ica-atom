<div class="pageTitle"><?php echo __('view %1%', array('%1%' => sfConfig::get('app_ui_label_repository')))?></div>

<table class="detail">
<tbody>

<?php if ($editCredentials): ?>
  <tr><td colspan="2" class="headerCell">
  <?php echo link_to($repository, 'repository/edit/?id='.$repository->getId())?>
  </td></tr>
<?php else: ?>
  <tr><td colspan="2" class="headerCell">
  <?php echo $repository ?>
  </td></tr>
<?php endif; ?>

<?php if ($repository->getIdentifier()): ?>
  <tr><th><?php echo __('identifier')?></th>
  <td><?php echo $repository->getIdentifier()?>
  </td></tr>
<?php endif; ?>

<tr><th><?php echo __('authorized form of name')?></th><td><?php echo $repository ?></td></th>

<?php if (count($otherNames) > 0): ?>
  <tr><th><?php echo __('other names') ?></th><td>
  <?php foreach ($otherNames as $otherName): ?>
    <?php echo $otherName->getName(array('sourceCulture' => true)).' ('.$otherName->getType()->getName(array('sourceCulture' => true)).')' ?>
    <?php if ($otherName->getNote(array('sourceCulture' => true))): ?>
      <span class="note">--<?php echo $otherName->getNote(array('sourceCulture' => true)) ?></span>
    <?php endif; ?>
    <br />
  <?php endforeach; ?>
  </td></tr>
<?php endif; ?>

<?php if ($repository->getTypeId()): ?>
  <tr><th><?php echo __('type')?></th>
  <td><?php echo $repository->getType()?>
  </td></tr>
<?php endif; ?>

<?php if ($contactInformation): ?>
  <tr><th>Contact Info:</th><td>
  <?php foreach ($contactInformation as $contact): ?>
      <table class="inline" style="margin-bottom: 5px;"><tr>
      <td class="headerCell" style="margin-top: 5px; border-top: 2px solid #999999;">
      <?php echo $contact->getContactType() ?>
      <?php if ($contact->getPrimaryContact()): ?> (primary contact)<?php endif; ?>
      </td></tr></table>
          <div style="padding-left: 10px; margin-bottom: 0px;">
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
  </td></tr>
<?php endif; ?>

<?php if ($repository->getOfficersInCharge()): ?>
  <tr><th><?php echo __('officers in charge')?></th>
  <td><?php echo $repository->getOfficersInCharge()?>
  </td></tr>
<?php endif; ?>

<?php if ($repository->getGeoculturalContext()): ?>
  <tr><th><?php echo __('geographical and cultural context')?></th>
  <td><?php echo nl2br($repository->getGeoculturalContext()) ?>
  </td></tr>
<?php endif; ?>

<?php if ($repository->getHistory()): ?>
  <tr><th><?php echo __('history')?></th><td>
  <?php echo nl2br($repository->getHistory())?>
  </td></tr>
<?php endif; ?>

<?php if ($repository->getInternalStructures()): ?>
  <tr><th><?php echo __('structure')?></th><td>
  <?php echo nl2br($repository->getInternalStructures())?>
  </td></tr>
<?php endif; ?>

<?php if ($repository->getCollectingPolicies()): ?>
  <tr><th><?php echo __('collecting policies')?></th><td>
  <?php echo nl2br($repository->getCollectingPolicies())?>
  </td></tr>
<?php endif; ?>

<?php if ($repository->getBuildings()): ?>
  <tr><th><?php echo __('buildings')?></th><td>
  <?php echo nl2br($repository->getBuildings())?>
  </td></tr>
<?php endif; ?>

<?php if ($repository->getHoldings()): ?>
  <tr><th><?php echo __('holdings')?></th><td>
  <?php echo nl2br($repository->getHoldings())?>
  </td></tr>
<?php endif; ?>

<?php if ($repository->getFindingAids()): ?>
  <tr><th><?php echo __('finding aids and publications')?></th><td>
  <?php echo nl2br($repository->getFindingAids())?>
  </td></tr>
<?php endif; ?>

<?php if ($repository->getOpeningTimes()): ?>
  <tr><th><?php echo __('opening times')?></th><td>
  <?php echo nl2br($repository->getOpeningTimes())?>
  </td></tr>
<?php endif; ?>

<?php if ($repository->getAccessConditions()): ?>
  <tr><th><?php echo __('access conditions and requirements')?></th><td>
  <?php echo nl2br($repository->getAccessConditions())?>
  </td></tr>
<?php endif; ?>

<?php if ($repository->getDisabledAccess()): ?>
  <tr><th><?php echo __('disabled access')?></th><td>
  <?php echo nl2br($repository->getDisabledAccess())?>
  </td></tr>
<?php endif; ?>

<?php if ($repository->getTransport()): ?>
  <tr><th><?php echo __('transport')?></th><td>
  <?php echo nl2br($repository->getTransport())?>
  </td></tr>
<?php endif; ?>

<?php if ($repository->getResearchServices()): ?>
  <tr><th><?php echo __('research services')?></th><td>
  <?php echo nl2br($repository->getResearchServices())?>
  </td></tr>
<?php endif; ?>

<?php if ($repository->getReproductionServices()): ?>
  <tr><th><?php echo __('reproduction services')?></th><td>
  <?php echo nl2br($repository->getReproductionServices())?>
  </td></tr>
<?php endif; ?>

<?php if ($repository->getPublicFacilities()): ?>
  <tr><th><?php echo __('public facilities')?></th><td>
  <?php echo nl2br($repository->getPublicFacilities())?>
  </td></tr>
<?php endif; ?>

<?php if ($repository->getDescIdentifier()): ?>
  <tr><th><?php echo __('description identifier')?></th><td>
  <?php echo nl2br($repository->getDescIdentifier())?>
  </td></tr>
<?php endif; ?>

<?php if ($repository->getDescInstitutionIdentifier()): ?>
  <tr><th><?php echo __('institution identifier')?></th><td>
  <?php echo nl2br($repository->getDescInstitutionIdentifier()) ?>
  </td></tr>
<?php endif; ?>

<?php if ($repository->getDescRules()): ?>
  <tr><th><?php echo __('rules or conventions')?></th><td>
  <?php echo nl2br($repository->getDescRules()) ?>
  </td></tr>
<?php endif; ?>

<?php if ($repository->getDescStatusId()): ?>
  <tr><th><?php echo __('description status')?></th><td>
  <?php echo $repository->getDescStatus() ?>
  </td></tr>
<?php endif; ?>

<?php if ($repository->getDescDetailId()): ?>
  <tr><th><?php echo __('description detail')?></th><td>
  <?php echo $repository->getDescDetail() ?>
  </td></tr>
<?php endif; ?>

<?php if ($repository->getDescRevisionHistory()): ?>
  <tr><th><?php echo __('dates of creation, revision and deletion')?></th><td>
  <?php echo nl2br($repository->getDescRevisionHistory()) ?>
  </td></tr>
<?php endif; ?>

<?php if (count($languageCodes) > 0): ?>
  <tr><th><?php echo __('language of description')?>:
  </th><td>
  <?php foreach ($languageCodes as $languageCode): ?>
    <?php echo format_language($languageCode->getValue()) ?><br />
  <?php endforeach; ?>
  </td></tr>
<?php endif; ?>

<?php if (count($scriptCodes) > 0): ?>
  <tr><th><?php echo __('script of description')?>:
  </th><td>
  <?php foreach ($scriptCodes as $scriptCode): ?>
    <?php echo format_script($scriptCode->getValue()) ?><br />
  <?php endforeach; ?>
  </td></tr>
<?php endif; ?>

<?php if ($repository->getDescSources()): ?>
  <tr><th><?php echo __('sources')?></th><td>
  <?php echo nl2br($repository->getDescSources()) ?>
  </td></tr>
<?php endif; ?>

<?php if (count($notes) > 0): ?>
  <tr><th><?php echo __('notes')?>:
  </th><td>
  <?php foreach ($notes as $note): ?>
    <?php echo $note->getType()->getName(array('sourceCulture' => true)).': '.$note->getContent(array('sourceCulture' => true)) ?>
    <br />
  <?php endforeach; ?>
  </td></tr>
<?php endif; ?>

</tbody>
</table>

<div class="menu-action">
<?php if ($editCredentials): ?>
<?php echo link_to(__('edit %1%', array('%1%' => sfConfig::get('app_ui_label_repository'))), 'repository/edit?id='.$repository->getId()) ?>
<?php endif; ?>
</div>
