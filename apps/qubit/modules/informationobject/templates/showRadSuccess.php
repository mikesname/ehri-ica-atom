<div class="pageTitle"><?php echo __('view archival description'); ?></div>

<table class="detail">
<tbody>

<!-- title and statement of responsibility area -->
<?php if ($informationObject->getTitle(array('sourceCulture' => true))): ?>
  <tr><td colspan="2" class="headerCell">
  <?php if ($editCredentials) echo link_to(QubitRad::getLabel($informationObject), 'informationobject/editRad/?id='.$informationObject->getId());
        else echo QubitRad::getLabel($informationObject); ?>
  </td></tr>
<?php endif; ?>

<?php if (strlen($value = $informationObject->getTitle(array('cultureFallback' => true))) > 0) : ?>
  <tr>
    <th><?php echo __('title proper'); ?></th>
    <td><?php echo $value; ?></td>
  </tr>
<?php endif; ?>

<?php if (count($materialTypes) > 0) : ?>
  <tr>
    <th><?php echo __('general material designation'); ?></th>
    <td>
    <?php foreach ($materialTypes as $materialType): ?>
      <?php echo $materialType->getTerm() ?><br />
    <?php endforeach; ?>
    </td>
  </tr>
<?php endif; ?>

<?php if (strlen($value = $informationObject->getAlternateTitle(array('cultureFallback' => true))) > 0) : ?>
  <tr>
    <th><?php echo __('parallel title'); ?></th>
    <td><?php echo $value; ?></td>
  </tr>
<?php endif; ?>

<?php if (strlen($value = $radOtherTitleInformation->getValue(array('cultureFallback' => true))) > 0) : ?>
  <tr>
    <th><?php echo __('other title information'); ?></th>
    <td><?php echo $value; ?></td>
  </tr>
<?php endif; ?>

<?php if (strlen($value = $radTitleStatementOfResponsibility->getValue(array('cultureFallback' => true))) > 0) : ?>
  <tr>
    <th><?php echo __('title statements of responsibility'); ?></th>
    <td><?php echo $value; ?></td>
  </tr>
<?php endif; ?>

<?php if (count($radTitleNotes) > 0) : ?>
  <tr>
    <th><?php echo __('title notes'); ?></th>
    <td>
      <?php foreach ($radTitleNotes as $radTitleNote): ?>
        <?php echo $radTitleNote->getType().': '.nl2br($radTitleNote->getContent(array('cultureFallback' => true))); ?><br />
      <?php endforeach; ?>
    </td>
  </tr>
<?php endif; ?>

<?php if ($informationObject->getLevelOfDescriptionId()) : ?>
  <tr>
    <th><?php echo __('level of description'); ?></th>
    <td><?php echo $informationObject->getLevelOfDescription(); ?></td>
  </tr>
<?php endif; ?>

<?php if ($informationObject->getRepositoryId()) : ?>
  <tr>
    <th><?php echo __('repository'); ?></th>
    <td><?php echo link_to($informationObject->getRepository(), 'repository/show?id='.$informationObject->getRepositoryId()); ?></td>
  </tr>
<?php endif; ?>

<?php if ($informationObject->getIdentifier()): ?>
  <tr>
    <th><?php echo __('reference code'); ?></th>
    <td><?php echo QubitRad::getReferenceCode($informationObject) ?></td>
  </tr>
<?php endif; ?>
<!-- End title and statement of responsibility area -->

<!-- Edition area -->
<?php if (strlen($value = $informationObject->getEdition(array('cultureFallback' => true))) > 0) : ?>
  <tr>
    <th><?php echo __('edition statement'); ?></th>
    <td><?php echo $value; ?></td>
  </tr>
<?php endif; ?>

<?php if (strlen($value = $radEditionStatementOfResponsibility->getValue(array('cultureFallback' => true))) > 0) : ?>
  <tr>
    <th><?php echo __('edition statement of responsibility'); ?></th>
    <td><?php echo $value; ?></td>
  </tr>
<?php endif; ?>
<!-- End edition area -->

<!-- Class of material specific details area -->
<?php if (strlen($value = $radStatementOfScaleCartographic->getValue(array('cultureFallback' => true))) > 0) : ?>
  <tr>
    <th><?php echo __('statement of scale (cartographic)'); ?></th>
    <td><?php echo $value; ?></td>
  </tr>
<?php endif; ?>

<?php if (strlen($value = $radStatementOfProjection->getValue(array('cultureFallback' => true))) > 0) : ?>
  <tr>
    <th><?php echo __('statement of projection (cartographic)'); ?></th>
    <td><?php echo $value; ?></td>
  </tr>
<?php endif; ?>

<?php if (strlen($value = $radStatementOfCoordinates->getValue(array('cultureFallback' => true))) > 0) : ?>
  <tr>
    <th><?php echo __('statement of coordinates (cartographic)'); ?></th>
    <td><?php echo $value; ?></td>
  </tr>
<?php endif; ?>

<?php if (strlen($value = $radStatementOfScaleArchitectural->getValue(array('cultureFallback' => true))) > 0) : ?>
  <tr>
    <th><?php echo __('statement of scale (architectural)'); ?></th>
    <td><?php echo $value; ?></td>
  </tr>
<?php endif; ?>

<?php if (strlen($value = $radIssuingJursidictionAndDenomination->getValue(array('cultureFallback' => true))) > 0) : ?>
  <tr>
    <th><?php echo __('issuing jurisdiction and denomination (philatelic)'); ?></th>
    <td><?php echo $value; ?></td>
  </tr>
<?php endif; ?>
<!-- End class of material specific details area -->

<!-- Dates of creation area -->
<?php if (count($informationObject->getDates()) > 0) : ?>
  <tr>
    <th><?php echo __('dates'); ?></th>
    <td>
    <?php foreach ($informationObject->getDates() as $date): ?>
      <?php echo $date->getDateDisplay().' ('.$date->getType().')' ?>
      <?php if ($actor = $date->getActor()): ?>
        <?php echo link_to($actor, array('module' => 'actor', 'action' => 'show', 'id' => $actor->getId())) ?>
      <?php endif; ?><br />
        <?php if (($date->getPlace()) || ($date->getDescription())): ?>
        <div style="margin-left: 30px; color: #999999;">
        <?php if ($place=$date->getPlace()): ?>
          <?php echo __('Place') ?>: <?php echo $place ?><br />
        <?php endif; ?>
        <?php if ($note=$date->getDescription()): ?>
          <?php echo __('Note') ?>: <?php echo $note ?><br />
        <?php endif; ?>
        </div>
      <?php endif; ?>
    <?php endforeach; ?>
    </td>
  </tr>
<?php endif; ?>

<?php  foreach ($creators as $creator): ?>
  <tr>
  <th><?php echo __('name of creator') ?></th>
  <td><?php echo link_to($creator, 'actor/show?id='.$creator->getId()); ?>
    <?php if ($existence = $creator->getDatesOfExistence(array('cultureFallback' => true))) echo ' ('.$existence.')'; ?>
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
      <tr><td><?php echo nl2br($history); ?></td></tr>
    </table>
  <?php endif; ?>
  </td>
  </tr>
<?php endforeach; ?>
<!-- End dates of creation area -->

<!-- Physical description area -->
<?php if (strlen($value = $informationObject->getExtentAndMedium(array('cultureFallback' => true))) > 0) : ?>
  <tr>
    <th><?php echo __('physical description'); ?></th>
    <td><?php echo nl2br($value); ?></td>
  </tr>
<?php endif; ?>
<!-- End physical description area -->

<!-- Publisher's series area -->
<?php if (strlen($value = $radTitleProperOfPublishersSeries->getValue(array('cultureFallback' => true))) > 0) : ?>
  <tr>
    <th><?php echo __('title proper of publisher\'s series'); ?></th>
    <td><?php echo $value; ?></td>
  </tr>
<?php endif; ?>

<?php if (strlen($value = $radParallelTitlesOfPublishersSeries->getValue(array('cultureFallback' => true))) > 0) : ?>
  <tr>
    <th><?php echo __('parallel titles of publisher\'s series'); ?></th>
    <td><?php echo $value; ?></td>
  </tr>
<?php endif; ?>

<?php if (strlen($value = $radOtherTitleInformationOfPublishersSeries->getValue(array('cultureFallback' => true))) > 0) : ?>
  <tr>
    <th><?php echo __('other title information of publisher\'s series'); ?></th>
    <td><?php echo $value; ?></td>
  </tr>
<?php endif; ?>

<?php if (strlen($value = $radStatementOfResponsibilityRelatingToPublishersSeries->getValue(array('cultureFallback' => true))) > 0) : ?>
  <tr>
    <th><?php echo __('statement of responsibility relating to publisher\'s series'); ?></th>
    <td><?php echo $value; ?></td>
  </tr>
<?php endif; ?>

<?php if (strlen($value = $radNumberingWithinPublishersSeries->getValue(array('cultureFallback' => true))) > 0) : ?>
  <tr>
    <th><?php echo __('numbering within publisher\'s series'); ?></th>
    <td><?php echo $value; ?></td>
  </tr>
<?php endif; ?>

<?php if (strlen($value = $radNoteOnPublishersSeries->getValue(array('cultureFallback' => true))) > 0) : ?>
  <tr>
    <th><?php echo __('Note on publisher\'s series'); ?></th>
    <td><?php echo $value; ?></td>
  </tr>
<?php endif; ?>
<!-- End publisher's series area -->

<!-- Archival description area -->
<?php if (strlen($value = $informationObject->getArchivalHistory(array('cultureFallback' => true))) > 0) : ?>
  <tr>
    <th><?php echo __('custodial history'); ?></th>
    <td><?php echo nl2br($value); ?></td>
  </tr>
<?php endif; ?>

<?php if (strlen($value = $informationObject->getScopeAndContent(array('cultureFallback' => true))) > 0) : ?>
  <tr>
    <th><?php echo __('scope and content'); ?></th>
    <td><?php echo nl2br($value); ?></td>
  </tr>
<?php endif; ?>
<!-- End archival description area -->

<!-- Notes area -->
<?php if (strlen($value = $informationObject->getPhysicalCharacteristics(array('cultureFallback' => true))) > 0) : ?>
<tr>
  <th><?php echo __('physical condition'); ?></th>
  <td><?php echo nl2br($value); ?></td>
</tr>
<?php endif; ?>

<?php if (strlen($value = $informationObject->getAcquisition(array('cultureFallback' => true))) > 0) : ?>
  <tr>
    <th><?php echo __('immediate source of acquisition'); ?></th>
    <td><?php echo nl2br($value); ?></td>
  </tr>
<?php endif; ?>

<?php if (strlen($value = $informationObject->getAppraisal(array('cultureFallback' => true))) > 0) : ?>
  <tr>
    <th><?php echo __('appraisal, destruction and scheduling'); ?></th>
    <td><?php echo nl2br($value); ?></td>
  </tr>
<?php endif; ?>

<?php if (strlen($value = $informationObject->getArrangement(array('cultureFallback' => true))) > 0) : ?>
  <tr>
    <th><?php echo __('arrangement'); ?></th>
    <td><?php echo nl2br($value); ?></td>
  </tr>
<?php endif; ?>

<?php if (count($languageCodes) > 0) : ?>
<tr>
  <th><?php echo __('language of material'); ?></th>
  <td>
        <?php foreach ($languageCodes as $languageCode): ?>
      <?php echo format_language($languageCode->getValue(array('sourceCulture'=>true))); ?><br />
    <?php endforeach; ?>
  </td>
</tr>
<?php endif; ?>

<?php if (count($scriptCodes) > 0) : ?>
  <tr>
    <th><?php echo __('script of material'); ?></th>
    <td>
      <?php foreach ($scriptCodes as $scriptCode): ?>
      <?php echo format_script($scriptCode->getValue(array('sourceCulture'=>true))); ?><br />
      <?php endforeach; ?>
    </td>
  </tr>
<?php endif; ?>

<?php if (strlen($value = $informationObject->getLocationOfOriginals(array('cultureFallback' => true))) > 0) : ?>
  <tr>
    <th><?php echo __('location of originals'); ?></th>
    <td><?php echo nl2br($value); ?></td>
  </tr>
<?php endif; ?>

<?php if (strlen($value = $informationObject->getLocationOfCopies(array('cultureFallback' => true))) > 0) : ?>
  <tr>
    <th><?php echo __('availability of other formats'); ?></th>
    <td><?php echo nl2br($value); ?></td>
  </tr>
<?php endif; ?>

<?php if (strlen($value = $informationObject->getAccessConditions(array('cultureFallback' => true))) > 0) : ?>
  <tr>
    <th><?php echo __('restrictions on access'); ?></th>
    <td><?php echo nl2br($value); ?></td>
  </tr>
<?php endif; ?>

<?php if (strlen($value = $informationObject->getReproductionConditions(array('cultureFallback' => true))) > 0) : ?>
  <tr>
    <th><?php echo __('terms governing use, reproduction, and publication'); ?></th>
    <td><?php echo nl2br($value); ?></td>
  </tr>
<?php endif; ?>

<?php if (strlen($value = $informationObject->getFindingAids(array('cultureFallback' => true))) > 0) : ?>
  <tr>
    <th><?php echo __('finding aids'); ?></th>
    <td><?php echo nl2br($value); ?></td>
  </tr>
<?php endif; ?>

<?php if (strlen($value = $informationObject->getRelatedUnitsOfDescription(array('cultureFallback' => true))) > 0) : ?>
  <tr>
    <th><?php echo __('associated / related material'); ?></th>
    <td><?php echo nl2br($value); ?></td>
  </tr>
<?php endif; ?>

<?php if (strlen($value = $informationObject->getAccruals(array('cultureFallback' => true))) > 0) : ?>
  <tr>
    <th><?php echo __('accruals'); ?></th>
    <td><?php echo nl2br($value); ?></td>
  </tr>
<?php endif; ?>

<?php if (count($radNotes) > 0) : ?>
  <tr>
    <th><?php echo __('other notes'); ?></th>
    <td>
      <?php foreach ($radNotes as $note): ?>
        <?php echo $note->getType().': '.nl2br($note->getContent(array('cultureFallback' => true))); ?><br />
      <?php endforeach; ?>
    </td>
  </tr>
<?php endif; ?>
<!-- End notes area -->

<!-- Standard number area -->
<?php if (strlen($value = $radStandardNumber->getValue(array('cultureFallback' => true))) > 0) : ?>
  <tr>
    <th><?php echo __('standard number'); ?></th>
    <td><?php echo $value; ?></td>
  </tr>
<?php endif; ?>
<!-- End standard number area -->

<!-- Access Points -->
<?php if (count($subjectAccessPoints) > 0) : ?>
  <tr>
    <th><?php echo __('subject access points'); ?></th>
    <td>
      <?php foreach ($subjectAccessPoints as $subject): ?>
        <?php echo link_to($subject->getTerm(), 'term/browse?termId='.$subject->getTermId()); ?><br />
      <?php endforeach; ?>
    </td>
  </tr>
<?php endif; ?>

<?php if (count($placeAccessPoints) > 0) : ?>
  <tr>
    <th><?php echo __('place access points'); ?></th>
    <td>
      <?php foreach ($placeAccessPoints as $place): ?>
        <?php echo link_to($place->getTerm(), 'term/browse?termId='.$place->getTermId()); ?><br />
      <?php endforeach; ?>
    </td>
  </tr>
<?php endif; ?>

<?php if (count($nameAccessPoints) > 0 ) : ?>
  <tr>
    <th><?php echo __('name access points'); ?></th>
    <td>
      <?php foreach ($nameAccessPoints as $name): ?>
        <?php echo link_to($name->getActor(), 'actor/show?id='.$name->getActorId()) ?>
        <?php echo ' ('.$name->getType()->getRole().')' ?>
        <br />
      <?php endforeach; ?>
    </td>
  </tr>
<?php endif; ?>
<!-- End Access Points-->

<!-- Control Area -->
<?php if ($informationObject->getDescriptionIdentifier()): ?>
  <tr>
    <th><?php echo __('description record identifier')?></th>
    <td><?php echo $informationObject->getDescriptionIdentifier() ?></td>
  </tr>
<?php endif; ?>

<?php if (strlen($value = $informationObject->getInstitutionResponsibleIdentifier(array('cultureFallback' => true))) > 0) : ?>
  <tr>
    <th><?php echo __('institution identifier')?></th>
    <td><?php echo $value ?></td>
  </tr>
<?php endif; ?>

<?php if (strlen($value = $informationObject->getRules(array('cultureFallback' => true))) > 0) : ?>
  <tr>
    <th><?php echo __('rules or conventions')?></th>
    <td><?php echo nl2br($value) ?></td>
  </tr>
<?php endif; ?>

<?php if ($informationObject->getDescriptionStatusId()): ?>
  <tr>
    <th><?php echo __('status')?></th>
    <td><?php echo $informationObject->getDescriptionStatus()->getName(array('cultureFallback' => true)) ?></td>
  </tr>
<?php endif; ?>

<?php if ($informationObject->getDescriptionDetailId()): ?>
  <tr>
    <th><?php echo __('detail')?></th>
    <td><?php echo $informationObject->getDescriptionDetail()->getName(array('cultureFallback' => true)) ?></td>
  </tr>
<?php endif; ?>

<?php if (strlen($value = $informationObject->getRevisionHistory(array('cultureFallback' => true))) > 0) : ?>
  <tr>
    <th><?php echo __('dates of creation, revision and deletion')?></th>
    <td><?php echo nl2br($value) ?></td>
  </tr>
<?php endif; ?>

<?php if (count($descriptionLanguageCodes) > 0): ?>
  <tr>
    <th><?php echo __('language of description')?></th>
    <td>
    <?php foreach ($descriptionLanguageCodes as $languageCode): ?>
      <?php echo format_language($languageCode->getValue(array('sourceCulture'=>true))) ?><br />
    <?php endforeach; ?>
    </td>
  </tr>
<?php endif; ?>

<?php if (count($descriptionScriptCodes) > 0): ?>
  <tr>
    <th><?php echo __('script of description')?></th>
    <td>
    <?php foreach ($descriptionScriptCodes as $scriptCode): ?>
      <?php echo format_script($scriptCode->getValue(array('sourceCulture'=>true))) ?><br />
    <?php endforeach; ?>
    </td>
  </tr>
<?php endif; ?>

<?php if (strlen($value = $informationObject->getSources(array('cultureFallback' => true))) > 0) : ?>
  <tr>
    <th><?php echo __('sources')?></th>
    <td><?php echo nl2br($value) ?></td>
  </tr>
<?php endif; ?>
<!-- End Control Area -->

<!-- Digital Object Area -->
<?php if ($digitalObject = $informationObject->getDigitalObject()): ?>
<tr><th><?php echo sfConfig::get('app_ui_label_digitalobject') ?></th>
  <td>
    <?php include_component('digitalobject', 'show', array(
      'digitalObject'=>$digitalObject,
      'usageType'=>QubitTerm::THUMBNAIL_ID,
      'link'=>'digitalobject/show?id='.$digitalObject->getId()
    )); ?>
  </td>
</tr>
<!-- End Digital Object Area -->

<!-- Physical Object Area -->
<?php if (count($physicalObjects) && $editCredentials): ?>
  <?php include_partial('physicalobject/show',
    array('informationObject'=>$informationObject, 'physicalObjects'=>$physicalObjects)); ?>
<?php endif; ?>

<?php endif; ?>
<!-- End Physical Object Area -->

</tbody>
</table>

<?php if ($editCredentials): ?>
<div class="menu-action">
  <?php echo link_to (__('edit archival description'), 'informationobject/editRad?id='.$informationObject->getId()) ?>
</div>
<?php endif; ?>

<div class="menu-extra">
<?php if ($editCredentials): ?>
  <?php echo link_to(__('add new archival description'), 'informationobject/createRad'); ?>
<?php endif; ?>
  <?php echo link_to(__('list all'), 'informationobject/list'); ?>
</div>
