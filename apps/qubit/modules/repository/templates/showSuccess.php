<div class="pageTitle"><?php echo __('view').' '.__('repository')</div>

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
  <tr><th><?php echo __('identifier')?>: </th>
  <td><?php echo $repository->getIdentifier()?>
  </td></tr>
<?php endif; ?>

<tr><th><?php echo __('authorized form of name')?>:</th><td><?php echo $repository ?></td></th>

<?php if ($otherNames): ?>
  <tr><th><?php echo ('other names')?>:</th><td>
  <?php foreach ($otherNames as $otherName): ?>
    <?php echo $otherName['name'].' ('.$otherName['nameType'].')' ?>
    <?php if ($otherName['note']): ?>
      <span class="note">-- <?php echo $otherName['note']?> </span>
    <?php endif; ?>
    <br />
  <?php endforeach; ?>
  </td></tr>
<?php endif; ?>

<?php if ($repository->getRepositoryTypeId()): ?>
  <tr><th><?php echo __('type')?>: </th>
  <td><?php echo $repository->getTermRelatedByRepositoryTypeId()?>
  </td></tr>
<?php endif; ?>

<?php if ($contactInformation): ?>
  <tr><th>Contact Info:</th><td>
  <?php foreach ($contactInformation as $contact): ?>
      <table class="inline" style="margin-bottom: 15px;"><tr><td style="border-top: 2px solid #cccccc; border-bottom: 1px solid #cccccc;"><?php echo $contact->getContactType() ?>
      <?php if ($contact->getPrimaryContact()): ?> (primary contact)<?php endif; ?>
      </td></tr></table>
      <div style="padding-left: 10px; margin-bottom: 10px;">
      <?php echo $contact->getContactInformationString()?>
      <?php echo $contact->getNote() ? '<p><span class="note">--'.$contact->getNote().'</span>' : '' ?></div>
  <?php endforeach; ?>
  </td></tr>
<?php endif; ?>

<?php if ($repository->getOfficersInCharge()): ?>
  <tr><th><?php echo __('officers in charge')?>: </th>
  <td><?php echo $repository->getOfficersInCharge()?>
  </td></tr>
<?php endif; ?>

<?php if ($repository->getGeoculturalContext()): ?>
  <tr><th><?php echo __('geographical and cultural context')?>: </th>
  <td><?php echo nl2br($repository->getGeoculturalContext()) ?>
  </td></tr>
<?php endif; ?>

<?php if ($history): ?>
  <tr><th><?php echo __('history')?>:</th><td>
  <?php echo nl2br($history)?>
  </td></tr>
<?php endif; ?>

<?php if ($structure): ?>
  <tr><th><?php echo __('structure')?>:</th><td>
  <?php echo nl2br($structure)?>
  </td></tr>
<?php endif; ?>

<?php if ($repository->getCollectingPolicies()): ?>
  <tr><th><?php echo __('collecting policies')?>:</th><td>
  <?php echo nl2br($repository->getCollectingPolicies())?>
  </td></tr>
<?php endif; ?>

<?php if ($repository->getBuildings()): ?>
  <tr><th><?php echo __('buildings')?>:</th><td>
  <?php echo nl2br($repository->getBuildings())?>
  </td></tr>
<?php endif; ?>

<?php if ($repository->getHoldings()): ?>
  <tr><th><?php echo __('holdings')?>:</th><td>
  <?php echo nl2br($repository->getHoldings())?>
  </td></tr>
<?php endif; ?>

<?php if ($repository->getFindingAids()): ?>
  <tr><th><?php echo __('finding aids and publications')?>:</th><td>
  <?php echo nl2br($repository->getFindingAids())?>
  </td></tr>
<?php endif; ?>

<?php if ($repository->getOpeningTimes()): ?>
  <tr><th><?php echo __('opening times')?>:</th><td>
  <?php echo nl2br($repository->getOpeningTimes())?>
  </td></tr>
<?php endif; ?>

<?php if ($repository->getAccessConditions()): ?>
  <tr><th><?php echo __('access conditions and requirements')?>:</th><td>
  <?php echo nl2br($repository->getAccessConditions())?>
  </td></tr>
<?php endif; ?>

<?php if ($repository->getDisabledAccess()): ?>
  <tr><th><?php echo __('disabled access')?>:</th><td>
  <?php echo nl2br($repository->getDisabledAccess())?>
  </td></tr>
<?php endif; ?>

<?php if ($repository->getTransport()): ?>
  <tr><th><?php echo __('transport')?>:</th><td>
  <?php echo nl2br($repository->getTransport())?>
  </td></tr>
<?php endif; ?>

<?php if ($repository->getResearchServices()): ?>
  <tr><th><?php echo __('research services')?>:</th><td>
  <?php echo nl2br($repository->getResearchServices())?>
  </td></tr>
<?php endif; ?>

<?php if ($repository->getReproductionServices()): ?>
  <tr><th><?php echo __('reproduction services')?>:</th><td>
  <?php echo nl2br($repository->getReproductionServices())?>
  </td></tr>
<?php endif; ?>

<?php if ($repository->getPublicFacilities()): ?>
  <tr><th><?php echo __('public facilities')?>:</th><td>
  <?php echo nl2br($repository->getPublicFacilities())?>
  </td></tr>
<?php endif; ?>

<?php if ($repository->getDescriptionIdentifier()): ?>
  <tr><th><?php echo __('description identifier')?>:</th><td>
  <?php echo nl2br($repository->getDescriptionIdentifier())?>
  </td></tr>
<?php endif; ?>

<?php if ($repository->getInstitutionIdentifier()): ?>
  <tr><th><?php echo __('institution identifier')?>:</th><td>
  <?php echo nl2br($repository->getInstitutionIdentifier()) ?>
  </td></tr>
<?php endif; ?>

<?php if ($repository->getRules()): ?>
  <tr><th><?php echo __('rules or conventions')?>:</th><td>
  <?php echo nl2br($repository->getRules()) ?>
  </td></tr>
<?php endif; ?>

<?php if ($repository->getStatusId()): ?>
  <tr><th><?php echo __('status')?>:</th><td>
  <?php echo $repository->getTermRelatedByStatusId() ?>
  </td></tr>
<?php endif; ?>

<?php if ($repository->getLevelOfDetailId()): ?>
  <tr><th><?php echo __('status')?>:</th><td>
  <?php echo $repository->getTermRelatedByLevelOfDetailId() ?>
  </td></tr>
<?php endif; ?>

<?php if ($languages): ?>
  <tr><th><?php echo __('language(s) of institution description') ?>:</th><td>
  <?php foreach ($languages as $language): ?>
    <?php echo $language['termName']?>
    <br />
  <?php endforeach; ?>
  <td></tr>
<?php endif; ?>

<?php if ($scripts): ?>
  <tr><th><?php echo __('script(s) of institution description') ?>:</th><td>
  <?php foreach ($scripts as $script): ?>
    <?php echo $script['termName']?>
    <br />
  <?php endforeach; ?>
  <td></tr>
<?php endif; ?>

<?php if ($repository->getSources()): ?>
  <tr><th><?php echo __('sources')?>:</th><td>
  <?php echo nl2br($repository->getSources()) ?>
  </td></tr>
<?php endif; ?>

<?php if ($notes): ?>
  <tr><th><?php echo __('notes')?>:</th><td>
  <?php foreach ($notes as $note): ?>
    <?php echo $note['noteType'].': '.$note['note'] ?>
    <br /><span class="note">-- <?php echo $note['noteAuthor'].', '.$note['updated'] ?></span><p>
  <?php endforeach; ?>
  </td></tr>
<?php endif; ?>

</tbody>
</table>

<div class="menu-action">
<?php if ($editCredentials) { echo link_to(__('edit').' '__('repository'), 'repository/edit?id='.$repository->getId()); } ?>
</div>