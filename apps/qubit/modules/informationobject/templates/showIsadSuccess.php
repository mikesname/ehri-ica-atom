<div class="pageTitle"><?php echo __('view archival description'); ?></div>

<table class="detail">
<tbody>

<tr>
  <td colspan="2" class="headerCell">
  <?php if ($editCredentials): ?>
    <?php echo link_to(render_title(QubitIsad::getLabel($informationObject)), array('module' => 'informationobject', 'action' => 'edit', 'id' => $informationObject->getId())); ?>
  <?php else: ?> 
    <?php echo render_title(QubitIsad::getLabel($informationObject)); ?>
  <?php endif; ?>
  </td>
</tr>

<?php if ($showCompoundDigitalObject): ?>
  <tr>
    <td colspan="2">
      <div style="text-align: center">
      <?php include_component('digitalobject', 'showCompound', array('informationObject'=>$informationObject)); ?>
      </div>
    </td>
  </tr>
<?php elseif (isset($digitalObject)): ?>
  <tr>
    <td colspan="2">
      <div style="text-align: center">
      <?php include_component('digitalobject', 'show', array(
        'digitalObject'=>$digitalObject, 'usageType'=>QubitTerm::REFERENCE_ID, 'link'=>$digitalObjectLink)); ?>
      </div>
    </td>
  </tr>
<?php endif; ?>

<!-- ******************************************** -->
<!--   START IDENTITY AREA                         -->
<!-- ******************************************** -->

<?php if(
  0 < strlen($informationObject->getIdentifier()) ||
  0 < strlen($informationObject->getTitle(array('cultureFallback' => true))) ||
  0 < strlen($informationObject->getLevelOfDescriptionId()) ||
  0 < strlen($informationObject->getExtentAndMedium(array('cultureFallback' => true)))
): ?>
<tr><td colspan="2" class="subHeaderCell">
  <?php echo __('identity area') ?>
</td></tr>
<?php endif; ?>

<?php if ($informationObject->getIdentifier()): ?>
  <tr>
  <th><?php echo __('reference code'); ?></th>
  <td><?php echo QubitIsad::getReferenceCode($informationObject) ?>
  </td>
  </tr>
<?php endif; ?>

<?php if ($informationObject->getTitle(array('cultureFallback' => true))): ?>
  <tr>
  <th><?php echo __('title'); ?></th>
  <td><?php echo $informationObject->getTitle(array('cultureFallback' => true)) ?>
  </td>
  </tr>
<?php endif; ?>

<?php if (0 < count($informationObject->getDates())) : ?>
<tr><th><?php echo __('date(s)'); ?></th><td>
<?php foreach ($informationObject->getDates() as $date): ?>
  <?php echo $date->getDateDisplay(array('cultureFallback' => true)) ?> 
  (<?php echo $date->getType(array('cultureFallback' => true)) ?>)<br />
<?php endforeach; ?>
</td></tr>
<?php endif; ?>

<?php if ($informationObject->getLevelOfDescriptionId()) : ?>
<tr>
<th><?php echo __('level of description'); ?></th>
<td><?php echo $informationObject->getLevelOfDescription(); ?></td>
</tr>
<?php endif; ?>

<?php if (0 < strlen($value = $informationObject->getExtentAndMedium(array('cultureFallback' => true)))) : ?>
<tr>
<th><?php echo __('extent and medium'); ?></th>
<td><?php echo nl2br($value); ?></td>
</tr>
<?php endif; ?>


<!-- ******************************************** -->
<!--   START CONTEXT AREA                         -->
<!-- ******************************************** -->

<?php if(
  0 < count($creators) ||
  0 < count($physicalObjects) ||
  0 < strlen($informationObject->getRepositoryId()) ||
  0 < strlen($informationObject->getArchivalHistory(array('cultureFallback' => true))) ||
  0 < strlen($informationObject->getAcquisition(array('cultureFallback' => true)))
): ?>
<tr><td colspan="2" class="subHeaderCell">
  <?php echo __('context area') ?>
</td></tr>
<?php endif; ?>

<?php foreach ($creators as $creator): ?>
  <tr>
  <th><?php echo __('name of creator') ?></th>
  <td><?php echo link_to(render_title($creator), 'actor/show?id='.$creator->getId()); ?>
    <?php if ($existence = $creator->getDatesOfExistence(array('cultureFallback' => true))) echo ' ('.$existence.')'; ?>
  <?php if ($history = $creator->getHistory(array('cultureFallback' => true))): ?>
    <table class="detail" style="margin-top: 5px;"><tr><th style="text-align: left; padding: 1px;">
    <?php if ($creator->getEntityTypeId() == QubitTerm::CORPORATE_BODY_ID): ?>
      <?php echo __('Administrative').' ' ?>
    <?php else: ?>
      <?php echo __('Biographic').' ' ?>
    <?php endif; ?>
      <?php echo __('history') ?></th></tr>
      <tr><td><?php echo nl2br($history); ?></td></tr>
    </table>
  <?php endif; ?>
  </td>
  </tr>
<?php endforeach; ?>

<?php if (count($physicalObjects) && $editCredentials): ?>
  <?php include_partial('physicalobject/show',
    array('informationObject'=>$informationObject, 'physicalObjects'=>$physicalObjects)); ?>
<?php endif; ?>

<?php if ($informationObject->getRepositoryId()) : ?>
<tr>
<th><?php echo __('repository'); ?></th>
<td><?php echo link_to(render_title($informationObject->getRepository()), 'repository/show?id='.$informationObject->getRepositoryId()); ?></td>
</tr>
<?php endif; ?>

<?php if (0 < strlen($value = $informationObject->getArchivalHistory(array('cultureFallback' => true)))) : ?>
<tr>
<th><?php echo __('archival history'); ?></th>
<td><?php echo nl2br($value); ?></td>
</tr>
<?php endif; ?>

<?php if (0 < strlen($value = $informationObject->getAcquisition(array('cultureFallback' => true)))) : ?>
<tr>
<th><?php echo __('immediate source of acquisition or transfer'); ?></th>
<td><?php echo nl2br($value); ?></td>
</tr>
<?php endif; ?>


<!-- ******************************************** -->
<!--   START CONTENT AND STRUCTURE AREA           -->
<!-- ******************************************** -->

<?php if(
  0 < strlen($informationObject->getScopeAndContent(array('cultureFallback' => true))) ||
  0 < strlen($informationObject->getAppraisal(array('cultureFallback' => true))) ||
  0 < strlen($informationObject->getAccruals(array('cultureFallback' => true))) ||
  0 < strlen($informationObject->getArrangement(array('cultureFallback' => true)))
): ?>
<tr><td colspan="2" class="subHeaderCell">
  <?php echo __('content and structure area') ?>
</td></tr>
<?php endif; ?>

<?php if (0 < strlen($value = $informationObject->getScopeAndContent(array('cultureFallback' => true)))) : ?>
<tr>
<th><?php echo __('scope and content'); ?></th>
<td><?php echo nl2br($value); ?></td>
</tr>
<?php endif; ?>

<?php if (0 < strlen($value = $informationObject->getAppraisal(array('cultureFallback' => true)))) : ?>
<tr>
<th><?php echo __('appraisal, destruction and scheduling'); ?></th>
<td><?php echo nl2br($value); ?></td>
</tr>
<?php endif; ?>

<?php if (0 < strlen($value = $informationObject->getAccruals(array('cultureFallback' => true)))) : ?>
<tr>
<th><?php echo __('accruals'); ?></th>
<td><?php echo nl2br($value); ?></td>
</tr>
<?php endif; ?>

<?php if (0 < strlen($value = $informationObject->getArrangement(array('cultureFallback' => true)))) : ?>
<tr>
<th><?php echo __('system of arrangement'); ?></th>
<td><?php echo nl2br($value); ?></td>
</tr>
<?php endif; ?>


<!-- ******************************************** -->
<!--   START CONDITIONS OF ACCESS AND USE AREA    -->
<!-- ******************************************** -->

<?php if(
  0 < strlen($informationObject->getAccessConditions(array('cultureFallback' => true))) ||
  0 < strlen($informationObject->getReproductionConditions(array('cultureFallback' => true))) ||
  0 < count($languageCodes) || 
  0 < count($scriptCodes) ||
  0 < strlen($informationObject->getPhysicalCharacteristics(array('cultureFallback' => true))) ||
  0 < strlen($informationObject->getFindingAids(array('cultureFallback' => true)))
): ?>
<tr><td colspan="2" class="subHeaderCell">
  <?php echo __('conditions of access and use area') ?>
</td></tr>
<?php endif; ?>

<?php if (0 < strlen($value = $informationObject->getAccessConditions(array('cultureFallback' => true)))) : ?>
<tr>
<th><?php echo __('conditions governing access'); ?></th>
<td><?php echo nl2br($value); ?></td>
</tr>
<?php endif; ?>

<?php if (0 < strlen($value = $informationObject->getReproductionConditions(array('cultureFallback' => true)))) : ?>
<tr>
<th><?php echo __('conditions governing reproduction'); ?></th>
<td><?php echo nl2br($value); ?></td>
</tr>
<?php endif; ?>

<?php if (0 < count($languageCodes)) : ?>
<tr>
<th><?php echo __('language of material'); ?></th>
<td>
      <?php foreach ($languageCodes as $languageCode): ?>
    <?php echo format_language($languageCode->getValue(array('sourceCulture'=>true))); ?><br />
  <?php endforeach; ?>
</td></tr>
<?php endif; ?>

<?php if (0 < count($scriptCodes)) : ?>
<tr>
<th><?php echo __('script of material'); ?></th>
<td>
<?php foreach ($scriptCodes as $scriptCode): ?>
  <?php echo format_script($scriptCode->getValue(array('sourceCulture'=>true))); ?><br />
<?php endforeach; ?>
</td></tr>
<?php endif; ?>

<?php if (0 < strlen($value = $informationObject->getPhysicalCharacteristics(array('cultureFallback' => true)))) : ?>
<tr>
<th><?php echo __('physical characteristics and technical requirements'); ?></th>
<td><?php echo nl2br($value); ?></td>
</tr>
<?php endif; ?>

<?php if (0 < strlen($value = $informationObject->getFindingAids(array('cultureFallback' => true)))) : ?>
<tr>
<th><?php echo __('finding aids'); ?></th>
<td><?php echo nl2br($value); ?></td>
</tr>
<?php endif; ?>


<!-- ******************************************** -->
<!--   START ALLIED MATERIALS AREA                -->
<!-- ******************************************** -->

<?php if(
  0 < strlen($informationObject->getLocationOfOriginals(array('cultureFallback' => true))) ||
  0 < strlen($informationObject->getLocationOfCopies(array('cultureFallback' => true))) ||
  0 < strlen($informationObject->getRelatedUnitsOfDescription(array('cultureFallback' => true))) ||
  0 < count($publicationNotes)
): ?>
<tr><td colspan="2" class="subHeaderCell">
  <?php echo __('allied materials area') ?>
</td></tr>
<?php endif; ?>

<?php if (0 < strlen($value = $informationObject->getLocationOfOriginals(array('cultureFallback' => true)))) : ?>
<tr>
<th><?php echo __('existence and location of originals'); ?></th>
<td><?php echo nl2br($value); ?></td>
</tr>
<?php endif; ?>

<?php if (0 < strlen($value = $informationObject->getLocationOfCopies(array('cultureFallback' => true)))) : ?>
<tr>
<th><?php echo __('existence and location of copies'); ?></th>
<td><?php echo nl2br($value); ?></td>
</tr>
<?php endif; ?>

<?php if (0 < strlen($value = $informationObject->getRelatedUnitsOfDescription(array('cultureFallback' => true)))) : ?>
<tr>
<th><?php echo __('related units of description'); ?></th>
<td><?php echo nl2br($value); ?></td>
</tr>
<?php endif; ?>

<?php if (0 < count($publicationNotes)): ?>
  <?php foreach ($publicationNotes as $publicationNote): ?>
  <tr>
  <th><?php echo __('publication note'); ?></th>
  <td><?php echo nl2br($publicationNote->getContent(array('cultureFallback' => true))) ?>
  </td>
  </tr>
  <?php endforeach; ?>
<?php endif; ?>


<!-- ******************************************** -->
<!--   START NOTES AREA                           -->
<!-- ******************************************** -->

<?php if (0 < count($notes)) : ?>
<tr><td colspan="2" class="subHeaderCell">
  <?php echo __('notes area') ?>
</td></tr>

<?php foreach($notes as $note): ?>
<tr>
  <th><?php echo __('note'); ?></th>
  <td>
    <?php echo nl2br($note->getContent(array('cultureFallback' => true))); ?><br />
  </td>
</tr>
<?php endforeach; ?>
<?php endif; ?>


<!-- ******************************************** -->
<!--   START ACCESS POINTS                        -->
<!-- ******************************************** -->

<?php if (
  0 < count($subjectAccessPoints) ||
  0 < count($placeAccessPoints) ||
  0 < count($nameAccessPoints)
): ?>
<tr><td colspan="2" class="subHeaderCell">
  <?php echo __('access points') ?>
</td></tr>
<?php endif; ?>

<?php if (0 < count($subjectAccessPoints)) : ?>
<tr>
<th><?php echo __('subject access points'); ?></th>
<td>
  <?php foreach ($subjectAccessPoints as $subject): ?>
    <?php echo link_to($subject->getTerm(), 'term/browse?termId='.$subject->getTermId()); ?><br />
  <?php endforeach; ?>
</td></tr>
<?php endif; ?>

<?php if (0 < count($placeAccessPoints)) : ?>
<tr>
<th><?php echo __('place access points'); ?></th>
<td>
  <?php foreach ($placeAccessPoints as $place): ?>
    <?php echo link_to($place->getTerm(), 'term/browse?termId='.$place->getTermId()); ?><br />
  <?php endforeach; ?>
</td></tr>
<?php endif; ?>

<?php if (0 < count($nameAccessPoints) ) : ?>
<tr>
<th><?php echo __('name access points'); ?></th>
<td>
  <?php foreach ($nameAccessPoints as $name): ?>
    <?php echo link_to(render_title($name->getActor()), 'actor/show?id='.$name->getActorId()) ?>
    <?php echo ' ('.$name->getType()->getRole().')' ?>
    <br />
  <?php endforeach; ?>
</td></tr>
<?php endif; ?>


<!-- ******************************************** -->
<!--   START CONTROL AREA                         -->
<!-- ******************************************** -->

<?php if (
  0 < count($archivistsNotes) ||
  0 < strlen($informationObject->getDescriptionIdentifier(array('cultureFallback' => true))) ||
  0 < strlen($informationObject->getInstitutionResponsibleIdentifier(array('cultureFallback' => true))) ||
  0 < strlen($informationObject->getRules(array('cultureFallback' => true))) ||
  0 < strlen($informationObject->getDescriptionStatusId()) ||
  0 < strlen($informationObject->getDescriptionDetailId()) ||
  0 < strlen($informationObject->getRevisionHistory(array('cultureFallback' => true))) ||
  0 < count($descriptionLanguageCodes) || 
  0 < count($descriptionScriptCodes) ||
  0 < strlen($informationObject->getSources(array('cultureFallback' => true)))
): ?>
<tr><td colspan="2" class="subHeaderCell">
  <?php echo __('description control area') ?>
</td></tr>
<?php endif; ?>

<?php if (0 < count($archivistsNotes)) : ?>
<?php foreach($archivistsNotes as $archivistsNote): ?>
<tr>
  <th><?php echo __('archivist\'s note'); ?></th>
  <td>
    <?php echo nl2br($archivistsNote->getContent(array('cultureFallback' => true))); ?><br />
  </td>
</tr>
<?php endforeach; ?>
<?php endif; ?>

<?php if ($informationObject->getDescriptionIdentifier(array('cultureFallback' => true))): ?>
  <tr><th><?php echo __('description identifier')?></th>
  <td><?php echo $informationObject->getDescriptionIdentifier(array('cultureFallback' => true)) ?></td></tr>
<?php endif; ?>

<?php if (0 < strlen($value = $informationObject->getInstitutionResponsibleIdentifier(array('cultureFallback' => true)))) : ?>
  <tr><th><?php echo __('institution identifier')?></th>
  <td><?php echo $value ?></td></tr>
<?php endif; ?>

<?php if (0 < strlen($value = $informationObject->getRules(array('cultureFallback' => true)))) : ?>
  <tr><th><?php echo __('rules')?></th>
  <td><?php echo nl2br($value) ?></td></tr>
<?php endif; ?>

<?php if ($informationObject->getDescriptionStatusId()): ?>
  <tr><th><?php echo __('status')?></th><td>
  <?php echo $informationObject->getDescriptionStatus()->getName(array('cultureFallback' => true)) ?>
  </td></tr>
<?php endif; ?>

<?php if ($informationObject->getDescriptionDetailId()): ?>
  <tr><th><?php echo __('detail')?></th><td>
  <?php echo $informationObject->getDescriptionDetail()->getName(array('cultureFallback' => true)) ?>
  </td></tr>
<?php endif; ?>

<?php if (0 < strlen($value = $informationObject->getRevisionHistory(array('cultureFallback' => true)))) : ?>
  <tr><th><?php echo __('dates of creation revision deletion')?></th><td>
  <?php echo nl2br($value) ?>
  </td></tr>
<?php endif; ?>

<?php if (0 < count($descriptionLanguageCodes)): ?>
  <tr><th><?php echo __('language of description')?></th><td>
  <?php foreach ($descriptionLanguageCodes as $languageCode): ?>
    <?php echo format_language($languageCode->getValue(array('sourceCulture'=>true))) ?><br />
  <?php endforeach; ?>
  </td></tr>
<?php endif; ?>

<?php if (0 < count($descriptionScriptCodes)): ?>
  <tr><th><?php echo __('script of description')?></th><td>
  <?php foreach ($descriptionScriptCodes as $scriptCode): ?>
    <?php echo format_script($scriptCode->getValue(array('sourceCulture'=>true))) ?><br />
  <?php endforeach; ?>
  </td></tr>
<?php endif; ?>

<?php if (0 < strlen($value = $informationObject->getSources(array('cultureFallback' => true)))) : ?>
  <tr><th><?php echo __('sources')?></th>
  <td><?php echo nl2br($value) ?></td></tr>
<?php endif; ?>


<!-- ******************************************** -->
<!--   START DIGITAL OBJECT METADATA              -->
<!-- ******************************************** -->

<?php if (isset($digitalObject)): ?>
  <tr><td colspan="2" class="subHeaderCell">
    <?php echo __('digital object metadata') ?>
  </td></tr>

  <?php if ($digitalObject->getName()): ?>
  <tr>
    <th><?php echo __('filename'); ?></th>
    <td><?php echo $digitalObject->getName(); ?></td>
  </tr>
  <?php endif; ?>
  
  <?php if ($digitalObject->getMediaType()): ?>
  <tr>
    <th><?php echo __('media type'); ?></th>
    <td><?php echo $digitalObject->getMediaType(); ?></td>
  </tr>
  <?php endif; ?>
  
  <?php if ($digitalObject->getMimeType()): ?>
  <tr>
    <th><?php echo __('mime-type'); ?></th>
    <td><?php echo $digitalObject->getMimeType(); ?></td>
  </tr>
  <?php endif; ?>
  
  <?php if ($digitalObject->getHRfileSize()): ?>
  <tr>
    <th><?php echo __('filesize'); ?></th>
    <td><?php echo $digitalObject->getHRfileSize(); ?></td>
  </tr>
  <?php endif; ?>
  
  <?php if ($digitalObject->getCreatedAt()): ?>
  <tr>
    <th><?php echo __('uploaded'); ?></th>
    <td><?php echo $digitalObject->getCreatedAt(); ?></td>
  </tr>
  <?php endif; ?>
<?php endif; ?>
</tbody>
</table>

<?php if ($editCredentials): ?>
<div class="menu-action">
  <?php echo link_to (__('edit archival description'), array('module' => 'informationobject', 'action' => 'edit', 'id' => $informationObject->getId())) ?>
</div>
<?php endif; ?>

<div class="menu-extra">
<?php if ($editCredentials): ?>
  <?php echo link_to(__('add new'), array('module' => 'informationobject', 'action' => 'create')); ?>
<?php endif; ?>
  <?php echo link_to(__('list all'), array('module' => 'informationobject', 'action' => 'list')); ?>
</div>
