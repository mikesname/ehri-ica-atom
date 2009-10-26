<div class="pageTitle"><?php echo __('view archival description') ?></div>

<table class="detail">
<tbody>

<tr>
  <td colspan="2" class="headerCell">
    <?php echo link_to_if(QubitAcl::check($informationObject, QubitAclAction::UPDATE_ID), render_title(QubitRad::getLabel($informationObject)), array('module' => 'informationobject', 'action' => 'edit', 'id' => $informationObject->id), array('title' => __('Edit archival description'))) ?>
  </td>
</tr>

<!-- Digital Object reference representation -->
<?php if (null !== $digitalObject): ?>
  <tr>
    <td colspan="2">
      <div style="text-align: center">
      <?php include_component('digitalobject', 'show', array(
        'digitalObject' => $informationObject->digitalObjects[0], 'usageType' => QubitTerm::REFERENCE_ID, 'link' => $digitalObjectLink)) ?>
      </div>
    </td>
  </tr>
<?php endif; ?>

<!-- title and statement of responsibility area -->
<?php echo render_show(__('title proper'), $informationObject->getTitle(array('cultureFallback' => true))) ?>

<?php if (0 < count($informationObject->getMaterialTypes())): ?>
  <tr>
    <th>
      <?php echo __('general material designation') ?>
    </th><td>
      <ul>
        <?php foreach ($informationObject->getMaterialTypes() as $materialType): ?>
          <li><?php echo $materialType->getTerm() ?></li>
        <?php endforeach; ?>
      </ul>
    </td>
  </tr>
<?php endif; ?>

<?php echo render_show(__('parallel title'), $informationObject->getAlternateTitle(array('cultureFallback' => true))) ?>

<?php echo render_show(__('other title information'), $informationObject->getPropertyByName('otherTitleInformation', array('scope' => 'rad'))->getValue(array('cultureFallback' => true))) ?>

<?php echo render_show(__('title statements of responsibility'), $informationObject->getPropertyByName('titleStatementOfResponsibility', array('scope' => 'rad'))->getValue(array('cultureFallback' => true))) ?>

<?php if (0 < count($titleNotes)): ?>
  <tr>
    <th>
      <?php echo __('title notes') ?>
    </th><td>
      <ul>
        <?php foreach ($titleNotes as $note): ?>
          <li><?php echo $note->getType() ?>: <?php echo nl2br($note->getContent(array('cultureFallback' => true))) ?></li>
        <?php endforeach; ?>
      </ul>
    </td>
  </tr>
<?php endif; ?>

<?php if ($informationObject->getLevelOfDescriptionId()): ?>
  <tr>
    <th><?php echo __('level of description') ?></th>
    <td><?php echo $informationObject->getLevelOfDescription() ?></td>
  </tr>
<?php endif; ?>

<?php if ($informationObject->getRepositoryId()): ?>
  <tr>
    <th><?php echo __('repository') ?></th>
    <td><?php echo link_to(render_title($informationObject->repository), array('module' => 'repository', 'action' => 'show', 'id' => $informationObject->repository->id)) ?></td>
  </tr>
<?php endif; ?>

<?php if ($informationObject->getIdentifier()): ?>
  <tr>
    <th><?php echo __('reference code') ?></th>
    <td><?php echo QubitRad::getReferenceCode($informationObject) ?></td>
  </tr>
<?php endif; ?>
<!-- End title and statement of responsibility area -->

<!-- Edition area -->
<?php echo render_show(__('edition statement'), $informationObject->getEdition(array('cultureFallback' => true))) ?>

<?php echo render_show(__('edition statement of responsibility'), $informationObject->getPropertyByName('editionStatementOfResponsibility', array('scope' => 'rad'))->getValue(array('cultureFallback' => true))) ?>
<!-- End edition area -->

<!-- Class of material specific details area -->
<?php echo render_show(__('statement of scale (cartographic)'), $informationObject->getPropertyByName('statementOfScaleCartographic', array('scope' => 'rad'))->getValue(array('cultureFallback' => true))) ?>

<?php echo render_show(__('statement of projection (cartographic)'), $informationObject->getPropertyByName('statementOfProjection', array('scope' => 'rad'))->getValue(array('cultureFallback' => true))) ?>

<?php echo render_show(__('statement of coordinates (cartographic)'), $informationObject->getPropertyByName('statementOfCoordinates', array('scope' => 'rad'))->getValue(array('cultureFallback' => true))) ?>

<?php echo render_show(__('statement of scale (architectural)'), $informationObject->getPropertyByName('statementOfScaleArchitectural', array('scope' => 'rad'))->getValue(array('cultureFallback' => true))) ?>

<?php echo render_show(__('issuing jurisdiction and denomination (philatelic)'), $informationObject->getPropertyByName('issuingJursidictionAndDenomination', array('scope' => 'rad'))->getValue(array('cultureFallback' => true))) ?>
<!-- End class of material specific details area -->

<!-- Dates of creation area -->
<?php if (0 < count($informationObject->getDates())): ?>
  <?php foreach ($informationObject->getDates() as $date): ?>
    <tr>
      <th>
        <?php echo __('date') ?>
      </th>
      <td>
        <?php echo date_display($date) ?>
        <div style="margin-left: 10px;">
        <span class="note2"><?php echo __('Type').': '.$date->getType() ?></span><br />
        <?php if (($date->getActorId()) & ($role = $date->getType()->getRole())): ?>
        <span class="note2"><?php echo $role.': '.$date->getActor() ?></span>
        <?php endif; ?>
        <?php if ($place=$date->getPlace()): ?>
          <span class="note2"><?php echo __('Place') ?>: <?php echo $place ?></span><br />
        <?php endif; ?>
        <?php if ($note=$date->getDescription()): ?>
          <span class="note2"><?php echo __('Note').': '.$note ?></span>
        <?php endif; ?>
        </div>
      </td>
    </tr>
  <?php endforeach; ?>
<?php endif; ?>

<?php  foreach ($informationObject->getCreators() as $creator): ?>
  <tr>
  <th><?php echo __('name of creator') ?></th>
  <td><?php echo link_to(render_title($creator), array('module' => 'actor', 'action' => 'show', 'id' => $creator->id)) ?>
    <?php if ($existence = $creator->getDatesOfExistence(array('cultureFallback' => true))): ?><span class="note2"> (<?php echo $existence ?>)</span><?php endif; ?>
  <?php if ($history = $creator->getHistory(array('cultureFallback' => true))): ?>
    <table class="detail" style="margin-top: 5px;">
      <tr><th style="text-align: left; padding: 1px;">
        <?php $entityTypeId = $creator->getEntityTypeId() ?>
        <?php switch ($entityTypeId) {
          case QubitTerm::CORPORATE_BODY_ID:
            echo __('administrative history');
            break;
          case QubitTerm::PERSON_ID:
          case QubitTerm::FAMILY_ID:
            echo __('biographical sketch');
            break;
          default:
            echo __('history');
        } ?></th></tr>
      <tr><td><?php echo nl2br($history) ?></td></tr>
    </table>
  <?php endif; ?>
  </td>
  </tr>
<?php endforeach; ?>
<!-- End dates of creation area -->

<!-- Physical description area -->
<?php if (0 < strlen($value = $informationObject->getExtentAndMedium(array('cultureFallback' => true)))): ?>
  <tr>
    <th><?php echo __('physical description') ?></th>
    <td><?php echo nl2br($value) ?></td>
  </tr>
<?php endif; ?>
<!-- End physical description area -->

<!-- Publisher's series area -->
<?php echo render_show(__('title proper of publisher\'s series'), $informationObject->getPropertyByName('titleProperOfPublishersSeries', array('scope' => 'rad'))->getValue(array('cultureFallback' => true))) ?>

<?php echo render_show(__('parallel titles of publisher\'s series'), $informationObject->getPropertyByName('parallelTitlesOfPublishersSeries', array('scope' => 'rad'))->getValue(array('cultureFallback' => true))) ?>

<?php echo render_show(__('other title information of publisher\'s series'), $informationObject->getPropertyByName('otherTitleInformationOfPublishersSeries', array('scope' => 'rad'))->getValue(array('cultureFallback' => true))) ?>

<?php echo render_show(__('statement of responsibility relating to publisher\'s series'), $informationObject->getPropertyByName('statementOfResponsibilityRelatingToPublishersSeries', array('scope' => 'rad'))->getValue(array('cultureFallback' => true))) ?>

<?php echo render_show(__('numbering within publisher\'s series'), $informationObject->getPropertyByName('numberingWithinPublishersSeries', array('scope' => 'rad'))->getValue(array('cultureFallback' => true))) ?>

<?php echo render_show(__('Note on publisher\'s series'), $informationObject->getPropertyByName('noteOnPublishersSeries', array('scope' => 'rad'))->getValue(array('cultureFallback' => true))) ?>
<!-- End publisher's series area -->

<!-- Archival description area -->
<?php if (0 < strlen($value = $informationObject->getArchivalHistory(array('cultureFallback' => true)))): ?>
  <tr>
    <th><?php echo __('custodial history') ?></th>
    <td><?php echo nl2br($value) ?></td>
  </tr>
<?php endif; ?>

<?php if (0 < strlen($value = $informationObject->getScopeAndContent(array('cultureFallback' => true)))): ?>
  <tr>
    <th><?php echo __('scope and content') ?></th>
    <td><?php echo nl2br($value) ?></td>
  </tr>
<?php endif; ?>
<!-- End archival description area -->

<!-- Notes area -->
<?php if (0 < strlen($value = $informationObject->getPhysicalCharacteristics(array('cultureFallback' => true)))): ?>
<tr>
  <th><?php echo __('physical condition') ?></th>
  <td><?php echo nl2br($value) ?></td>
</tr>
<?php endif; ?>

<?php if (0 < strlen($value = $informationObject->getAcquisition(array('cultureFallback' => true)))): ?>
  <tr>
    <th><?php echo __('immediate source of acquisition') ?></th>
    <td><?php echo nl2br($value) ?></td>
  </tr>
<?php endif; ?>

<?php if (0 < strlen($value = $informationObject->getAppraisal(array('cultureFallback' => true)))): ?>
  <tr>
    <th><?php echo __('appraisal, destruction and scheduling') ?></th>
    <td><?php echo nl2br($value) ?></td>
  </tr>
<?php endif; ?>

<?php if (0 < strlen($value = $informationObject->getArrangement(array('cultureFallback' => true)))): ?>
  <tr>
    <th><?php echo __('arrangement') ?></th>
    <td><?php echo nl2br($value) ?></td>
  </tr>
<?php endif; ?>

<?php if (0 < count($informationObject->language)): ?>
  <tr>
    <th>
      <?php echo __('language of material') ?>
    </th><td>
      <ul>
        <?php foreach ($informationObject->language as $code): ?>
          <li><?php echo format_language($code) ?></li>
        <?php endforeach; ?>
      </ul>
    </td>
  </tr>
<?php endif; ?>

<?php if (0 < count($informationObject->script)): ?>
  <tr>
    <th>
      <?php echo __('script of material') ?>
    </th><td>
      <ul>
        <?php foreach ($informationObject->script as $code): ?>
          <li><?php echo format_script($code) ?></li>
        <?php endforeach; ?>
      </ul>
    </td>
  </tr>
<?php endif; ?>

<?php if (0 < strlen($value = $informationObject->getLocationOfOriginals(array('cultureFallback' => true)))): ?>
  <tr>
    <th><?php echo __('location of originals') ?></th>
    <td><?php echo nl2br($value) ?></td>
  </tr>
<?php endif; ?>

<?php if (0 < strlen($value = $informationObject->getLocationOfCopies(array('cultureFallback' => true)))): ?>
  <tr>
    <th><?php echo __('availability of other formats') ?></th>
    <td><?php echo nl2br($value) ?></td>
  </tr>
<?php endif; ?>

<?php if (0 < strlen($value = $informationObject->getAccessConditions(array('cultureFallback' => true)))): ?>
  <tr>
    <th><?php echo __('restrictions on access') ?></th>
    <td><?php echo nl2br($value) ?></td>
  </tr>
<?php endif; ?>

<?php if (0 < strlen($value = $informationObject->getReproductionConditions(array('cultureFallback' => true)))): ?>
  <tr>
    <th><?php echo __('terms governing use, reproduction, and publication') ?></th>
    <td><?php echo nl2br($value) ?></td>
  </tr>
<?php endif; ?>

<?php if (0 < strlen($value = $informationObject->getFindingAids(array('cultureFallback' => true)))): ?>
  <tr>
    <th><?php echo __('finding aids') ?></th>
    <td><?php echo nl2br($value) ?></td>
  </tr>
<?php endif; ?>

<?php if (0 < strlen($value = $informationObject->getRelatedUnitsOfDescription(array('cultureFallback' => true)))): ?>
  <tr>
    <th><?php echo __('associated / related material') ?></th>
    <td><?php echo nl2br($value) ?></td>
  </tr>
<?php endif; ?>

<?php if (0 < strlen($value = $informationObject->getAccruals(array('cultureFallback' => true)))): ?>
  <tr>
    <th><?php echo __('accruals') ?></th>
    <td><?php echo nl2br($value) ?></td>
  </tr>
<?php endif; ?>

<?php if (0 < count($notes)): ?>
  <tr>
    <th><?php echo __('other notes') ?></th>
    <td>
      <?php foreach ($notes as $note): ?>
        <?php echo $note->getType() ?>: <?php echo nl2br($note->getContent(array('cultureFallback' => true))) ?><br />
      <?php endforeach; ?>
    </td>
  </tr>
<?php endif; ?>
<!-- End notes area -->

<!-- Standard number area -->
<?php echo render_show(__('standard number'), $informationObject->getPropertyByName('standardNumber', array('scope' => 'rad'))->getValue(array('cultureFallback' => true))) ?>
<!-- End standard number area -->

<!-- Access Points -->
<?php if (0 < count($informationObject->getSubjectAccessPoints())): ?>
  <tr>
    <th>
      <?php echo __('subject access points') ?>
    </th><td>
      <ul>
        <?php foreach ($informationObject->getSubjectAccessPoints() as $subject): ?>
          <li><?php echo link_to($subject->term, array('module' => 'term', 'action' => 'browse', 'termId' => $subject->term->id)) ?></li>
        <?php endforeach; ?>
      </ul>
    </td>
  </tr>
<?php endif; ?>

<?php if (0 < count($informationObject->getPlaceAccessPoints())): ?>
  <tr>
    <th>
      <?php echo __('place access points') ?>
    </th><td>
      <ul>
        <?php foreach ($informationObject->getPlaceAccessPoints() as $place): ?>
          <li><?php echo link_to($place->term, array('module' => 'term', 'action' => 'browse', 'termId' => $place->term->id)) ?></li>
        <?php endforeach; ?>
      </ul>
    </td>
  </tr>
<?php endif; ?>

<?php if (0 < count($nameAccessPoints) ): ?>
  <tr>
    <th>
      <?php echo __('name access points') ?>
    </th><td>
      <ul>
        <?php foreach ($nameAccessPoints as $relation): ?>
          <?php if ('QubitEvent' == get_class($relation)): ?>
          <li>
            <?php echo link_to(render_title($relation->actor), array('module' => 'actor', 'action' => 'show', 'id' => $relation->actorId)) ?>
            <span class="note2">(<?php echo $relation->type->getRole()?>)</span>
          </li>
          <?php else: ?>
          <li><?php echo link_to(render_title($relation->object), array('module' => 'actor', 'action' => 'show', 'id' => $relation->object->id)) ?></li>
          <?php endif; ?>
        <?php endforeach; ?>
      </ul>
    </td>
  </tr>
<?php endif; ?>
<!-- End Access Points-->

<!-- Control Area -->
<?php if ($informationObject->getDescriptionIdentifier()): ?>
  <tr>
    <th><?php echo __('description record identifier') ?></th>
    <td><?php echo $informationObject->getDescriptionIdentifier() ?></td>
  </tr>
<?php endif; ?>

<?php echo render_show(__('institution identifier'), $informationObject->getInstitutionResponsibleIdentifier(array('cultureFallback' => true))) ?>

<?php if (0 < strlen($value = $informationObject->getRules(array('cultureFallback' => true)))): ?>
  <tr>
    <th><?php echo __('rules or conventions') ?></th>
    <td><?php echo nl2br($value) ?></td>
  </tr>
<?php endif; ?>

<?php if ($informationObject->getDescriptionStatusId()): ?>
  <tr>
    <th><?php echo __('status') ?></th>
    <td><?php echo $informationObject->getDescriptionStatus()->getName(array('cultureFallback' => true)) ?></td>
  </tr>
<?php endif; ?>

<?php if ($informationObject->getDescriptionDetailId()): ?>
  <tr>
    <th><?php echo __('detail') ?></th>
    <td><?php echo $informationObject->getDescriptionDetail()->getName(array('cultureFallback' => true)) ?></td>
  </tr>
<?php endif; ?>

<?php if (0 < strlen($value = $informationObject->getRevisionHistory(array('cultureFallback' => true)))): ?>
  <tr>
    <th><?php echo __('dates of creation, revision and deletion') ?></th>
    <td><?php echo nl2br($value) ?></td>
  </tr>
<?php endif; ?>

<?php if (0 < count($informationObject->languageOfDescription)): ?>
  <tr>
    <th>
      <?php echo __('language of description') ?>
    </th><td>
      <ul>
        <?php foreach ($informationObject->languageOfDescription as $code): ?>
          <li><?php echo format_language($code) ?></li>
        <?php endforeach; ?>
      </ul>
    </td>
  </tr>
<?php endif; ?>

<?php if (0 < count($informationObject->scriptOfDescription)): ?>
  <tr>
    <th>
      <?php echo __('script of description') ?>
    </th>
    <td>
      <ul>
        <?php foreach ($informationObject->scriptOfDescription as $code): ?>
          <li><?php echo format_script($code) ?></li>
        <?php endforeach; ?>
      </ul>
    </td>
  </tr>
<?php endif; ?>

<?php if (0 < strlen($value = $informationObject->getSources(array('cultureFallback' => true)))): ?>
  <tr>
    <th><?php echo __('sources') ?></th>
    <td><?php echo nl2br($value) ?></td>
  </tr>
<?php endif; ?>
<!-- End Control Area -->

<!-- Physical Object Area -->
<?php if (count($physicalObjects) && SecurityPriviliges::editCredentials($sf_user, 'informationObject')): ?>
  <?php include_partial('physicalobject/show',
    array('informationObject' => $informationObject, 'physicalObjects' => $physicalObjects)) ?>
<?php endif; ?>
<!-- End Physical Object Area -->

<!--  Digital Object metadata -->
<?php if (0 < count($informationObject->digitalObjects)): ?>
  <tr><td colspan="2" class="subHeaderCell">
    <?php echo __('digital object metadata') ?>
  </td></tr>

  <?php if ($informationObject->digitalObjects[0]->getName()): ?>
  <tr>
    <th><?php echo __('filename') ?></th>
    <td><?php echo $informationObject->digitalObjects[0]->getName() ?></td>
  </tr>
  <?php endif; ?>

  <?php if ($informationObject->digitalObjects[0]->getMediaType()): ?>
  <tr>
    <th><?php echo __('media type') ?></th>
    <td><?php echo $informationObject->digitalObjects[0]->getMediaType() ?></td>
  </tr>
  <?php endif; ?>

  <?php if ($informationObject->digitalObjects[0]->getMimeType()): ?>
  <tr>
    <th><?php echo __('mime-type') ?></th>
    <td><?php echo $informationObject->digitalObjects[0]->getMimeType() ?></td>
  </tr>
  <?php endif; ?>

  <?php if ($informationObject->digitalObjects[0]->getByteSize()): ?>
  <tr>
    <th><?php echo __('filesize') ?></th>
    <td><?php echo hr_filesize($informationObject->digitalObjects[0]->getByteSize()) ?></td>
  </tr>
  <?php endif; ?>

  <?php if ($informationObject->digitalObjects[0]->getCreatedAt()): ?>
  <tr>
    <th><?php echo __('uploaded') ?></th>
    <td><?php echo $informationObject->digitalObjects[0]->getCreatedAt() ?></td>
  </tr>
  <?php endif; ?>
<?php endif; ?>

</tbody>
</table>

<?php echo get_partial('actions', array('informationObject' => $informationObject)) ?>
