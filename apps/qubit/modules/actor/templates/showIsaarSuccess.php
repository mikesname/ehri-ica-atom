<div class="pageTitle"><?php echo __('view authority record') ?></div>

<table class="detail">
<tbody>

<?php $name = render_title($actor->getAuthorizedFormOfName(array('cultureFallback' => true))) ?>
<?php if ($editCredentials): ?>
  <tr><td colspan="2" class="headerCell">
  <?php echo link_to($name, array('module' => 'actor', 'action' => 'editIsaar', 'id' => $actor->getId())) ?>
  </td></tr>
<?php else: ?>
  <tr><td colspan="2" class="headerCell">
  <?php echo $name ?>
  </td></tr>
<?php endif; ?>

<?php if ($actor->getEntityTypeId()): ?>
  <tr><th><?php echo __('type of entity') ?></th><td>
  <?php echo $actor->getEntityType()->getName(array('cultureFallback' => true)) ?>
  </td></tr>
<?php endif; ?>

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

<?php if ($actor->getCorporateBodyIdentifiers()): ?>
  <tr><th><?php echo __('identifiers') ?></th><td>
  <?php echo $actor->getCorporateBodyIdentifiers() ?>
  </td></tr>
<?php endif; ?>

<?php if (strlen($value = $actor->getDatesOfExistence(array('cultureFallback' => true))) >0): ?>
  <tr><th><?php echo __('dates of existence')?></th>
  <td><?php echo nl2br($value)?>
  </td></tr>
<?php endif; ?>

<?php if (strlen($value = $actor->getHistory(array('cultureFallback' => true))) >0): ?>
  <tr><th><?php echo __('history')?></th>
  <td><?php echo nl2br($value)?>
  </td></tr>
<?php endif; ?>

<?php if (strlen($value = $actor->getPlaces(array('cultureFallback' => true))) >0): ?>
  <tr><th><?php echo __('places')?></th>
  <td><?php echo nl2br($value) ?>
  </td></tr>
<?php endif; ?>

<?php if (strlen($value = $actor->getLegalStatus(array('cultureFallback' => true))) >0): ?>
  <tr><th><?php echo __('legal status')?></th>
  <td><?php echo nl2br($value) ?></td></tr>
<?php endif; ?>

<?php if (strlen($value = $actor->getFunctions(array('cultureFallback' => true))) >0): ?>
  <tr><th><?php echo __('functions occupations activities')?></th>
  <td><?php echo nl2br($value) ?></td></tr>
<?php endif; ?>

<?php if (strlen($value = $actor->getMandates(array('cultureFallback' => true))) >0): ?>
  <tr><th><?php echo __('mandates or sources of authority')?></th>
  <td><?php echo nl2br($value) ?></td></tr>
<?php endif; ?>

<?php if (strlen($value = $actor->getInternalStructures(array('cultureFallback' => true))) >0): ?>
  <tr><th><?php echo __('internal structures or genealogy')?></th>
  <td><?php echo nl2br($value) ?></td></tr>
<?php endif; ?>

<?php if (strlen($value = $actor->getGeneralContext(array('cultureFallback' => true))) >0): ?>
  <tr><th><?php echo __('general context')?></th>
  <td><?php echo nl2br($value) ?></td></tr>
<?php endif; ?>

<?php if ($relatedActors): ?>
  <tr><th><?php echo _('related corporate bodies persons families') ?></th><td>
  <?php echo $relatedActors ?>
  </td></tr>
<?php endif; ?>

<?php if ($actor->getDescriptionIdentifier()): ?>
  <tr><th><?php echo __('authority record identifier')?></th>
  <td><?php echo $actor->getDescriptionIdentifier() ?></td></tr>
<?php endif; ?>

<?php if (strlen($value = $actor->getInstitutionResponsibleIdentifier(array('cultureFallback' => true))) >0): ?>
  <tr><th><?php echo __('institution identifier')?></th>
  <td><?php echo $value ?></td></tr>
<?php endif; ?>

<?php if (strlen($value = $actor->getRules(array('cultureFallback' => true))) >0): ?>
  <tr><th><?php echo __('rules')?></th>
  <td><?php echo nl2br($value) ?></td></tr>
<?php endif; ?>

<?php if ($actor->getDescriptionStatusId()): ?>
  <tr><th><?php echo __('status')?></th><td>
  <?php echo $actor->getDescriptionStatus()->getName(array('sourceCulture' => true)) ?>
  </td></tr>
<?php endif; ?>

<?php if ($actor->getDescriptionDetailId()): ?>
  <tr><th><?php echo __('detail')?></th><td>
  <?php echo $actor->getDescriptionDetail()->getName(array('sourceCulture' => true)) ?>
  </td></tr>
<?php endif; ?>

<?php if (strlen($value = $actor->getRevisionHistory(array('cultureFallback' => true))) >0): ?>
  <tr><th><?php echo __('dates of creation revision deletion')?></th><td>
  <?php echo nl2br($value) ?>
  </td></tr>
<?php endif; ?>

<?php if (count($languageCodes) > 0): ?>
  <tr><th><?php echo __('language of authority record')?></th><td>
  <?php foreach ($languageCodes as $languageCode): ?>
    <?php echo format_language($languageCode->getValue(array('sourceCulture'=>true))) ?><br />
  <?php endforeach; ?>
  </td></tr>
<?php endif; ?>

<?php if (count($scriptCodes) > 0): ?>
  <tr><th><?php echo __('script of authority record')?></th><td>
  <?php foreach ($scriptCodes as $scriptCode): ?>
    <?php echo format_script($scriptCode->getValue(array('sourceCulture'=>true))) ?><br />
  <?php endforeach; ?>
  </td></tr>
<?php endif; ?>

<?php if (strlen($value = $actor->getSources(array('cultureFallback' => true))) >0): ?>
  <tr><th><?php echo __('sources')?></th>
  <td><?php echo nl2br($value) ?></td></tr>
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

<?php if (SecurityCheck::HasPermission($sf_user, array('module' => 'actor', 'action' => 'update'))): ?>
<div class="menu-action">
<?php echo link_to(__('edit %1%', array('%1%' => sfConfig::get('app_ui_label_actor'))), 'actor/editIsaar?id='.$actor->getId()) ?>
</div>

<div class="menu-extra">
  <?php echo link_to(__('add new'), 'actor/createIsaar'); ?>
  <?php echo link_to(__('list all'), 'actor/list'); ?>
</div>
<?php endif; ?>
