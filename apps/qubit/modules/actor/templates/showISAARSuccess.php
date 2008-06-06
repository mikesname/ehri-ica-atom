﻿<div class="pageTitle"><?php echo __('view %1%', array('%1%' => sfConfig::get('app_ui_label_actor'))) ?></div>

<table class="detail">
<tbody>

<?php if ($actor->getAuthorizedFormOfName(array('sourceCulture' => true))): ?>
    <?php if (SecurityCheck::HasPermission($sf_user, array('module' => 'actor', 'action' => 'update'))): ?>
    <tr><td colspan="2" class="headerCell">
    <?php echo link_to($actor, 'actor/edit?id='.$actor->getId()) ?>
    </td></tr>
  <?php else: ?>
    <tr><td colspan="2" class="headerCell">
    <?php echo $actor->getAuthorizedFormOfName(array('sourceCulture' => true)) ?>
    </td></tr>
  <?php endif; ?>
<?php endif; ?>

<?php if ($actor->getEntityTypeId()): ?>
  <tr><th><?php echo __('type of entity') ?></th><td>
  <?php echo $actor->getEntityType()->getName(array('sourceCulture' => true)) ?>
  </td></tr>
<?php endif; ?>

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

<?php if ($actor->getCorporateBodyIdentifiers(array('sourceCulture' => true))): ?>
  <tr><th><?php echo __('identifiers') ?></th><td>
  <?php echo $actor->getCorporateBodyIdentifiers(array('sourceCulture' => true)) ?>
  </td></tr>
<?php endif; ?>

<?php if ($datesOfExistence): ?>
  <tr><th>
  <?php echo __('dates of existence')?></th>
  <td><?php echo $datesOfExistence ?>
  </td></tr>
<?php endif; ?>

<?php if ($actor->getHistory(array('sourceCulture' => true))): ?>
  <tr><th><?php echo __('history')?></th>
  <td><?php echo nl2br($actor->getHistory(array('sourceCulture' => true)))?>
  </td></tr>
<?php endif; ?>

<?php if ($actor->getPlaces(array('sourceCulture' => true))): ?>
  <tr><th><?php echo __('places')?></th>
  <td><?php echo nl2br($actor->getPlaces(array('sourceCulture' => true))) ?>
  </td></tr>
<?php endif; ?>

<?php if ($actor->getLegalStatus(array('sourceCulture' => true))): ?>
  <tr><th><?php echo __('legal status')?></th>
  <td><?php echo nl2br($actor->getLegalStatus(array('sourceCulture' => true))) ?></td></tr>
<?php endif; ?>

<?php if ($actor->getFunctions(array('sourceCulture' => true))): ?>
  <tr><th><?php echo __('functions occupations activities')?></th>
  <td><?php echo nl2br($actor->getFunctions(array('sourceCulture' => true))) ?></td></tr>
<?php endif; ?>

<?php if ($actor->getMandates(array('sourceCulture' => true))): ?>
  <tr><th><?php echo __('mandates or sources of authority')?></th>
  <td><?php echo nl2br($actor->getMandates(array('sourceCulture' => true))) ?></td></tr>
<?php endif; ?>

<?php if ($actor->getInternalStructures(array('sourceCulture' => true))): ?>
  <tr><th><?php echo __('internal structures or genealogy')?></th>
  <td><?php echo nl2br($actor->getInternalStructures(array('sourceCulture' => true))) ?></td></tr>
<?php endif; ?>

<?php if ($actor->getGeneralContext(array('sourceCulture' => true))): ?>
  <tr><th><?php echo __('general context')?></th>
  <td><?php echo nl2br($actor->getGeneralContext(array('sourceCulture' => true))) ?></td></tr>
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

<?php if ($actor->getInstitutionResponsibleIdentifier(array('sourceCulture' => true))): ?>
  <tr><th><?php echo __('institution identifier')?></th>
  <td><?php echo $actor->getInstitutionResponsibleIdentifier(array('sourceCulture' => true)) ?></td></tr>
<?php endif; ?>

<?php if ($actor->getRules(array('sourceCulture' => true))): ?>
  <tr><th><?php echo __('rules')?></th>
  <td><?php echo nl2br($actor->getRules(array('sourceCulture' => true))) ?></td></tr>
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

<?php if ($actor->getRevisionHistory(array('sourceCulture' => true))): ?>
  <tr><th><?php echo __('dates of creation revision deletion')?></th><td>
  <?php echo $actor->getRevisionHistory(array('sourceCulture' => true)) ?>
  </td></tr>
<?php endif; ?>

<?php if (count($languageCodes) > 0): ?>
  <tr><th><?php echo __('language of authority record')?>:
  </th><td>
  <?php foreach ($languageCodes as $languageCode): ?>
    <?php echo format_language($languageCode->getValue()) ?><br />
  <?php endforeach; ?>
  </td></tr>
<?php endif; ?>

<?php if (count($scriptCodes) > 0): ?>
  <tr><th><?php echo __('script of authority record')?>:
  </th><td>
  <?php foreach ($scriptCodes as $scriptCode): ?>
    <?php echo format_script($scriptCode->getValue()) ?><br />
  <?php endforeach; ?>
  </td></tr>
<?php endif; ?>

<?php if ($actor->getSources(array('sourceCulture' => true))): ?>
  <tr><th><?php echo __('sources')?></th>
  <td><?php echo nl2br($actor->getSources(array('sourceCulture' => true))) ?></td></tr>
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

<?php if (SecurityCheck::HasPermission($sf_user, array('module' => 'actor', 'action' => 'update'))): ?>
  <div class="menu-action">
  <?php echo link_to(__('edit %1%', array('%1%' => sfConfig::get('app_ui_label_actor'))), 'actor/edit?id='.$actor->getId()) ?>
  </div>
<?php endif; ?>
</table>
