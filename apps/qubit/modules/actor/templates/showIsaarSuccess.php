<div class="pageTitle"><?php echo __('view authority record') ?></div>

<table class="detail">
<tbody>

  <tr><td colspan="2" class="headerCell">
  <?php echo link_to_if(SecurityPriviliges::editCredentials($sf_user, 'actor'), render_title($actor), array('module' => 'actor', 'action' => 'edit', 'id' => $actor->id), array('title' => __('Edit authority record'))) ?>
  </td></tr>

<?php if ($actor->getEntityTypeId()): ?>
  <tr><th><?php echo __('type of entity') ?></th><td>
  <?php echo $actor->getEntityType()->getName(array('cultureFallback' => true)) ?>
  </td></tr>
<?php endif; ?>

<?php if (strlen($authName = $actor->getAuthorizedFormOfName(array('cultureFallback' => true))) > 0): ?>
  <tr><th><?php echo __('authorized form of name') ?></th><td>
  <?php echo $authName ?>
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
  <tr><th><?php echo __('Mandates/Sources of authority')?></th>
  <td><?php echo nl2br($value) ?></td></tr>
<?php endif; ?>

<?php if (strlen($value = $actor->getInternalStructures(array('cultureFallback' => true))) >0): ?>
  <tr><th><?php echo __('Internal structures/Genealogy')?></th>
  <td><?php echo nl2br($value) ?></td></tr>
<?php endif; ?>

<?php if (strlen($value = $actor->getGeneralContext(array('cultureFallback' => true))) >0): ?>
  <tr><th><?php echo __('general context')?></th>
  <td><?php echo nl2br($value) ?></td></tr>
<?php endif; ?>

<?php if (0 < count($actorRelations)): ?>
  <?php foreach ($actorRelations as $actorRelation): ?>
  <tr>
    <th><?php echo _('related entity') ?></th>
    <td>
      <?php if ($actor->getId() == $actorRelation->getObjectId()): ?>
        <?php $relatedActor = $actorRelation->getSubject() ?>
        <?php echo link_to($relatedActor->getAuthorizedFormOfName(array('cultureFallback' => true)),
        array('module' => 'actor', 'action' => 'show', 'id' => $actorRelation->getSubjectId())) ?>
        <?php if ($existence = $relatedActor->getDatesOfExistence(array('cultureFallback' => true))): ?><span class="note2"> (<?php echo $existence ?>)</span><?php endif; ?>
      <?php else: ?>
        <?php $relatedActor = $actorRelation->getObject() ?>
        <?php echo link_to($relatedActor->getAuthorizedFormOfName(array('cultureFallback' => true)),
        array('module' => 'actor', 'action' => 'show', 'id' => $actorRelation->getObjectId())) ?>
        <?php if ($existence = $relatedActor->getDatesOfExistence(array('cultureFallback' => true))): ?><span class="note2"> (<?php echo $existence ?>)</span><?php endif; ?>
      <?php endif; ?>

      <table class="detail" style="margin-top: 5px;">
        <?php if (0 < strlen($relatedActor->getCorporateBodyIdentifiers())): ?>
        <tr>
          <th style="text-align: left; padding: 1px;"><?php echo __('identifier of the related entity') ?></th>
        </tr>
        <tr>
          <td><?php echo $relatedActor->getCorporateBodyIdentifiers() ?></td>
        </tr>
        <?php endif; ?>

        <?php if (0 < $actorRelation->getTypeId()): ?>
        <tr>
          <th style="text-align: left; padding: 1px;"><?php echo __('category of the relationship') ?></th>
        </tr>
        <tr>
          <td><?php echo $actorRelation->getType()->getName() ?></td>
        </tr>
        <?php endif; ?>

        <?php if (null !== ($dateDisplayNote = $actorRelation->getNoteByTypeId(QubitTerm::RELATION_NOTE_DATE_DISPLAY_ID)) || 0 < count($dateArray = $actorRelation->getDates())): ?>
        <tr>
          <th style="text-align: left; padding: 1px;"><?php echo __('dates of the relationship') ?></th>
        </tr>
        <tr>
          <td>
          <?php if (null !== $dateDisplayNote && 0 < strlen($dateDisplay = $dateDisplayNote->getContent(array('cultureFallback' => true)))): ?>
            <?php echo $dateDisplay ?>
          <?php elseif (2 == count($dateArray)): ?>
            <?php echo __('%1% - %2%', array('%1%' => collapse_date($dateArray['start']), '%2%' => collapse_date($dateArray['end']))); ?>
          <?php else: ?>
            <?php echo collapse_date(array_shift($dateArray)) ?>
          <?php endif; ?>
          </td>
        </tr>
        <?php endif; ?>

        <?php if (null !== ($descriptionNote = $actorRelation->getNoteByTypeId(QubitTerm::RELATION_NOTE_DESCRIPTION_ID))): ?>
        <tr>
          <th style="text-align: left; padding: 1px;"><?php echo __('description of relationship') ?></th>
        </tr>
        <tr>
          <td><?php echo $descriptionNote->getContent(array('cultureFallback' => true)) ?></td>
        </tr>
        <?php endif; ?>
      </table>
    </td>
  </tr>
  <?php endforeach; ?>
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
  <tr><th><?php echo __('rules and/or conventions')?></th>
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
  <?php foreach ($notes as $note): ?>
      <tr><th><?php echo $note->getType()->getName(array('cultureFallback' => true)) ?></th>
      <td><?php echo $note->getContent(array('cultureFallback' => true)) ?></td></tr>
  <?php endforeach; ?>
<?php endif; ?>

</tbody>
</table>

<ul class="actions">
  <?php if (SecurityPriviliges::editCredentials($sf_user, 'actor')): ?>
    <li><?php echo link_to(__('Edit'), array('module' => 'actor', 'action' => 'edit', 'id' => $actor->id), array('title' => __(''))) ?></li><?php endif; ?>
  <?php if (SecurityPriviliges::editCredentials($sf_user, 'actor')): ?>
    <li><?php echo link_to(__('Delete'), array('module' => 'actor', 'action' => 'delete', 'id' => $actor->id), array('title' => __(''))) ?></li><?php endif; ?>
  <br /><div class="menu-extra">
  <?php if (SecurityPriviliges::editCredentials($sf_user, 'actor')): ?>
    <li><?php echo link_to(__('Add new'), array('module' => 'actor', 'action' => 'create'), array('title' => __(''))) ?></li><?php endif; ?>
  <li><?php echo link_to(__('List all'), array('module' => 'actor', 'action' => 'list'), array('title' => __(''))) ?></li>
</ul>
