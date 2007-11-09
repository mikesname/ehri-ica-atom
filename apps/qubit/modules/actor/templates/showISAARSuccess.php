<div class="pageTitle"><?php echo __('view').' '.__('authority file') ?></div>

<table class="detail">
<tbody>


<?php if ($actor->getAuthorizedFormOfName()): ?>
  <?php if ($editCredentials): ?>
    <tr><td colspan="2" class="headerCell">
    <?php echo link_to($actor->getAuthorizedFormOfName(), 'actor/edit?id='.$actor->getId()) ?>
    </td></tr>
  <?php else: ?>
    <tr><td colspan="2" class="headerCell">
    <?php echo $actor->getAuthorizedFormOfName() ?>
    </td></tr>
  <?php endif; ?>
<?php endif; ?>

<?php if ($actor->getTypeOfEntityId()): ?>
  <tr><th><?php echo __('type of entity') ?>: </th><td>
  <?php echo $actor->getTypeOfEntity() ?>
  </td></tr>
<?php endif; ?>

<?php if ($otherNames): ?>
  <tr><th><?php echo __('other').' '.__('names') ?>:</th><td>
  <?php foreach ($otherNames as $otherName): ?>
    <?php echo $otherName['name'].' ('.$otherName['nameType'].')' ?>
    <?php if($otherName['note']): ?>
      <span class="note">--<?php echo $otherName['note'] ?></span>
    <?php endif; ?>
    <br />
  <?php endforeach; ?>
  </td></tr>
<?php endif; ?>

<?php if ($actor->getIdentifiers()): ?>
  <tr><th><?php echo __('identifiers for corporate bodies') ?>: </th><td>
  <?php echo $actor->getIdentifiers() ?>
  </td></tr>
<?php endif; ?>

<?php if ($datesOfExistence): ?>
  <tr><th>
  <?php echo __('dates of existence')?>: </th>
  <td><?php echo $datesOfExistence ?>
  </td></tr>
<?php endif; ?>

<?php if ($actor->getHistory()): ?>
  <tr><th><?php echo __('history')?>: </th>
  <td><?php echo nl2br($actor->getHistory())?>
  </td></tr>
<?php endif; ?>

<?php if ($places): ?>
  <tr><th><?php echo __('places')?>: </th>
  <td><?php echo $places ?>
  </td></tr>
<?php endif; ?>

<?php if ($actor->getLegalStatus()): ?>
  <tr><th><?php echo __('legal status')?>: </th>
  <td><?php echo nl2br($actor->getLegalStatus()) ?></td></tr>
<?php endif; ?>

<?php if ($actor->getFunctions()): ?>
  <tr><th><?php echo __('functions occupations activities')?>: </th>
  <td><?php echo nl2br($actor->getFunctions()) ?></td></tr>
<?php endif; ?>

<?php if ($actor->getMandates()): ?>
  <tr><th><?php echo __('mandates or sources of authority')?>: </th>
  <td><?php echo nl2br($actor->getMandates()) ?></td></tr>
<?php endif; ?>

<?php if ($actor->getInternalStructures()): ?>
  <tr><th><?php echo __('internal structures or genealogy')?>: </th>
  <td><?php echo nl2br($actor->getInternalStructures()) ?></td></tr>
<?php endif; ?>

<?php if ($actor->getGeneralContext()): ?>
  <tr><th><?php echo __('general context')?>: </th>
  <td><?php echo nl2br($actor->getGeneralContext()) ?></td></tr>
<?php endif; ?>

<?php if($relatedActors): ?>
  <tr><th><?php echo _('related corporate bodies persons families') ?>: </th><td>
  <?php echo $relatedActors ?>
  </td></tr>
<?php endif; ?>

<?php if ($actor->getAuthorityRecordIdentifier()): ?>
  <tr><th><?php echo __('authority record identifier')?>: </th>
  <td><?php echo $actor->getAuthorityRecordIdentifier() ?></td></tr>
<?php endif; ?>

<?php if ($actor->getInstitutionIdentifier()): ?>
  <tr><th><?php echo __('institution identifier')?>: </th>
  <td><?php echo $actor->getInstitutionIdentifier() ?></td></tr>
<?php endif; ?>

<?php if ($actor->getRules()): ?>
  <tr><th><?php echo __('rules')?>: </th>
  <td><?php echo nl2br($actor->getRules()) ?></td></tr>
<?php endif; ?>

<?php if ($actor->getStatusId()): ?>
  <tr><th><?php echo __('status')?>:</th><td>
  <?php echo $actor->getTermRelatedByStatusId() ?>
  </td></tr>
<?php endif; ?>

<?php if ($actor->getLevelOfDetailId()): ?>
  <tr><th><?php echo __('status')?>:</th><td>
  <?php echo $actor->getTermRelatedByLevelOfDetailId() ?>
  </td></tr>
<?php endif; ?>

<?php if ($datesOfChanges): ?>
  <tr><th><?php echo __('dates of creation revision deletion')?>: </th><td>
  <?php echo $datesOfChanges ?>
  </td></tr>
<?php endif; ?>

<?php if ($languages): ?>
  <tr><th><?php echo __('language of authority record')?>:
  </th><td>
  <?php foreach ($languages as $language): ?>
    <?php echo $language['termName'] ?><br />
  <?php endforeach; ?>
  </td></tr>
<?php endif; ?>

<?php if ($scripts): ?>
  <tr><th><?php echo __('script of authority record')?>:
  </th><td>
  <?php foreach ($scripts as $script): ?>
    <?php echo $script['termName'] ?><br />
  <?php endforeach; ?>
  </td></tr>
<?php endif; ?>

<?php if ($actor->getSources()): ?>
  <tr><th><?php echo __('sources')?>: </th>
  <td><?php echo nl2br($actor->getSources()) ?></td></tr>
<?php endif; ?>

<?php if ($notes): ?>
  <tr><th><?php echo __('notes')?>:
  </th><td>
  <?php foreach ($notes as $note): ?>
    <?php echo $note['noteType'].': '.$note['note'] ?>
    <br />
  <?php endforeach; ?>
  </td></tr>
<?php endif; ?>

</tbody>
</table>


<?php if($editCredentials): ?>
  <div class="menu-action">
  <?php echo link_to(__('edit').' '.__('authority file'), 'actor/edit?id='.$actor->getId()) ?>
  </div>
<?php endif; ?>