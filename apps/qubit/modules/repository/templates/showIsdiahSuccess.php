<div class="pageTitle"><?php echo __('view %1%', array('%1%' => sfConfig::get('app_ui_label_repository')))?></div>

<table class="detail">
<tbody>

<?php if ($editCredentials): ?>
  <tr><td colspan="2" class="headerCell">
  <?php echo link_to($repository, 'repository/editIsdiah/?id='.$repository->getId())?>
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
    <?php echo $otherName->getName(array('cultureFallback' => true)).' ('.$otherName->getType()->getName(array('cultureFallback' => true)).')' ?>
    <?php if ($otherName->getNote(array('cultureFallback' => true))): ?>
      <span class="note">--<?php echo $otherName->getNote(array('cultureFallback' => true)) ?></span>
    <?php endif; ?>
    <br />
  <?php endforeach; ?>
  </td></tr>
<?php endif; ?>

<?php if ($repository->getTypeId()): ?>
  <tr><th><?php echo __('type')?></th>
  <td><?php echo $repository->getType(array('cultureFallback' => true)) ?>
  </td></tr>
<?php endif; ?>

<?php if (!empty($contactInformation)): ?>
  <tr><th><?php echo __('Contact information') ?></th><td>
  <?php foreach ($contactInformation as $contact): ?>
      <table class="inline" style="margin-bottom: 5px;"><tr>
      <td class="headerCell" style="margin-top: 5px; border-top: 2px solid #999999;">
      <?php echo $contact->getContactType(array('cultureFallback' => true)) ?>
      <?php if ($contact->getPrimaryContact()): ?><?php echo '('.__('primary contact').')' ?><?php endif; ?>
      </td></tr></table>
          <div style="padding-left: 10px; margin-bottom: 0px;">
            <?php if ($contact->getContactPerson()): ?>
              <?php echo $contact->getContactPerson() ?><br />
            <?php endif; ?>
            <?php if ($contact->getStreetAddress()): ?>
              <?php echo nl2br($contact->getStreetAddress()) ?><br />
            <?php endif; ?>
            <?php if (strlen($value = $contact->getCity(array('cultureFallback' => true))) >0): ?>
              <?php echo $value ?><br />
            <?php endif; ?>
            <?php if (strlen($value = $contact->getRegion(array('cultureFallback' => true))) >0): ?>
              <?php echo $value ?><br />
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
              <?php
                // Add http:// to the beginning of website urls that don't already have it
                $fullUrl = (preg_match('|^https?://|', $contact->getWebsite())) ? $contact->getWebsite() : 'http://'.$contact->getWebsite();
              ?>
              <?php echo '<a href="'.$fullUrl.'" target="_NEW">'.$fullUrl.'</a>' ?><br />
            <?php endif; ?>
            <?php if (strlen($value = $contact->getNote(array('cultureFallback' => true))) >0): ?>
              <span class="note"><?php echo $value ?></span>
            <?php endif; ?>
          </div>
  <?php endforeach; ?>
  </td></tr>
<?php endif; ?>

<?php if (strlen($value = $repository->getHistory(array('cultureFallback' => true))) >0): ?>
  <tr><th><?php echo __('history')?></th><td>
  <?php echo nl2br($value)?>
  </td></tr>
<?php endif; ?>

<?php if (strlen($value = $repository->getGeoculturalContext(array('cultureFallback' => true))) >0): ?>
  <tr><th><?php echo __('geographical and cultural context')?></th>
  <td><?php echo nl2br($value) ?>
  </td></tr>
<?php endif; ?>

<?php if (strlen($value = $repository->getMandates(array('cultureFallback' => true))) >0): ?>
  <tr><th><?php echo __('mandates or sources of authority')?></th>
  <td><?php echo nl2br($value) ?></td></tr>
<?php endif; ?>

<?php if (strlen($value = $repository->getInternalStructures(array('cultureFallback' => true))) >0): ?>
  <tr><th><?php echo __('structure')?></th><td>
  <?php echo nl2br($value)?>
  </td></tr>
<?php endif; ?>

<?php if (strlen($value = $repository->getCollectingPolicies(array('cultureFallback' => true))) >0): ?>
  <tr><th><?php echo __('records management and collecting policies')?></th><td>
  <?php echo nl2br($value)?>
  </td></tr>
<?php endif; ?>

<?php if (strlen($value = $repository->getBuildings(array('cultureFallback' => true))) >0): ?>
  <tr><th><?php echo __('buildings')?></th><td>
  <?php echo nl2br($value)?>
  </td></tr>
<?php endif; ?>

<?php if (strlen($value = $repository->getHoldings(array('cultureFallback' => true))) >0): ?>
  <tr><th><?php echo __('holdings')?></th><td>
  <?php echo nl2br($value)?>
  </td></tr>
<?php endif; ?>

<?php if (strlen($value = $repository->getFindingAids(array('cultureFallback' => true))) >0): ?>
  <tr><th><?php echo __('finding aids, guides, publications')?></th><td>
  <?php echo nl2br($value)?>
  </td></tr>
<?php endif; ?>

<?php if (strlen($value = $repository->getOpeningTimes(array('cultureFallback' => true))) >0): ?>
  <tr><th><?php echo __('opening times')?></th><td>
  <?php echo nl2br($value)?>
  </td></tr>
<?php endif; ?>

<?php if (strlen($value = $repository->getAccessConditions(array('cultureFallback' => true))) >0): ?>
  <tr><th><?php echo __('access conditions and requirements')?></th><td>
  <?php echo nl2br($value)?>
  </td></tr>
<?php endif; ?>

<?php if (strlen($value = $repository->getDisabledAccess(array('cultureFallback' => true))) >0): ?>
  <tr><th><?php echo __('accessibility')?></th><td>
  <?php echo nl2br($value)?>
  </td></tr>
<?php endif; ?>

<?php if (strlen($value = $repository->getResearchServices(array('cultureFallback' => true))) >0): ?>
  <tr><th><?php echo __('research services')?></th><td>
  <?php echo nl2br($value)?>
  </td></tr>
<?php endif; ?>

<?php if (strlen($value = $repository->getReproductionServices(array('cultureFallback' => true))) >0): ?>
  <tr><th><?php echo __('reproduction services')?></th><td>
  <?php echo nl2br($value)?>
  </td></tr>
<?php endif; ?>

<?php if (strlen($value = $repository->getPublicFacilities(array('cultureFallback' => true))) >0): ?>
  <tr><th><?php echo __('public areas')?></th><td>
  <?php echo nl2br($value)?>
  </td></tr>
<?php endif; ?>

<?php if ($repository->getDescIdentifier()): ?>
  <tr><th><?php echo __('description identifier')?></th><td>
  <?php echo nl2br($repository->getDescIdentifier())?>
  </td></tr>
<?php endif; ?>

<?php if (strlen($value = $repository->getDescInstitutionIdentifier(array('cultureFallback' => true))) >0): ?>
  <tr><th><?php echo __('institution identifier')?></th><td>
  <?php echo nl2br($value) ?>
  </td></tr>
<?php endif; ?>

<?php if (strlen($value = $repository->getDescRules(array('cultureFallback' => true))) >0): ?>
  <tr><th><?php echo __('rules or conventions')?></th><td>
  <?php echo nl2br($value) ?>
  </td></tr>
<?php endif; ?>

<?php if ($repository->getDescStatusId()): ?>
  <tr><th><?php echo __('status')?></th><td>
  <?php echo $repository->getDescStatus() ?>
  </td></tr>
<?php endif; ?>

<?php if ($repository->getDescDetailId()): ?>
  <tr><th><?php echo __('level of detail')?></th><td>
  <?php echo $repository->getDescDetail() ?>
  </td></tr>
<?php endif; ?>

<?php if (strlen($value = $repository->getDescRevisionHistory(array('cultureFallback' => true))) >0): ?>
  <tr><th><?php echo __('dates of creation, revision and deletion')?></th><td>
  <?php echo nl2br($value) ?>
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

<?php if (strlen($value = $repository->getDescSources(array('cultureFallback' => true))) >0): ?>
  <tr><th><?php echo __('sources')?></th><td>
  <?php echo nl2br($value) ?>
  </td></tr>
<?php endif; ?>

<?php if (count($notes) > 0): ?>
  <tr><th><?php echo __('notes')?>:
  </th><td>
  <?php foreach ($notes as $note): ?>
    <?php echo $note->getType()->getName(array('cultureFallback' => true)).': '.$note->getContent(array('cultureFallback' => true)) ?>
    <br />
  <?php endforeach; ?>
  </td></tr>
<?php endif; ?>

</tbody>
</table>

<div class="menu-action">
<?php if ($editCredentials): ?>
<?php echo link_to(__('edit %1%', array('%1%' => sfConfig::get('app_ui_label_repository'))), 'repository/editIsdiah?id='.$repository->getId()) ?>
<?php endif; ?>
</div>

<div class="menu-extra">
  <?php echo link_to(__('add new %1%', array('%1%' => sfConfig::get('app_ui_label_repository'))), 'repository/createIsdiah'); ?>
  <?php echo link_to(__('list all'), 'repository/list'); ?>
</div>
