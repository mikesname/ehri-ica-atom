<div class="pageTitle"><?php echo __('view archival description'); ?></div>

<table class="detail">
<tbody>

<tr>
  <td colspan="2" class="headerCell">
  <?php if ($editCredentials): ?> 
    <?php echo link_to(render_title(QubitIsad::getLabel($informationObject)), 'informationobject/editIsad/?id='.$informationObject->getId()); ?>
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

<?php if ($informationObject->getIdentifier()): ?>
  <tr>
  <th><?php echo __('reference code'); ?></th>
  <td><?php echo QubitIsad::getReferenceCode($informationObject) ?>
  </td>
  </tr>
<?php endif; ?>

<?php if (count($informationObject->getDates()) > 0) : ?>
<tr><th><?php echo __('dates'); ?></th><td>
<?php foreach ($informationObject->getDates() as $date): ?>
  <?php echo $date->getDateDisplay(array('cultureFallback' => true)).' ('.$date->getType().')' ?>
  <?php if ($actor = $date->getActor()): ?>
    <?php echo link_to(render_title($actor), array('module' => 'actor', 'action' => 'show', 'id' => $actor->getId())) ?>
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
</td></tr>
<?php endif; ?>

<?php if ($informationObject->getLevelOfDescriptionId()) : ?>
<tr>
<th><?php echo __('level of description'); ?></th>
<td><?php echo $informationObject->getLevelOfDescription(); ?></td>
</tr>
<?php endif; ?>

<?php if (strlen($value = $informationObject->getExtentAndMedium(array('cultureFallback' => true))) > 0) : ?>
<tr>
<th><?php echo __('extent and medium'); ?></th>
<td><?php echo nl2br($value); ?></td>
</tr>
<?php endif; ?>

<?php  foreach ($creators as $creator): ?>
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

<?php if (strlen($value = $informationObject->getArchivalHistory(array('cultureFallback' => true))) > 0) : ?>
<tr>
<th><?php echo __('archival history'); ?></th>
<td><?php echo nl2br($value); ?></td>
</tr>
<?php endif; ?>

<?php if (strlen($value = $informationObject->getAcquisition(array('cultureFallback' => true))) > 0) : ?>
<tr>
<th><?php echo __('immediate source of acquisition'); ?></th>
<td><?php echo nl2br($value); ?></td>
</tr>
<?php endif; ?>

<?php if (strlen($value = $informationObject->getScopeAndContent(array('cultureFallback' => true))) > 0) : ?>
<tr>
<th><?php echo __('scope and content'); ?></th>
<td><?php echo nl2br($value); ?></td>
</tr>
<?php endif; ?>

<?php if (strlen($value = $informationObject->getAppraisal(array('cultureFallback' => true))) > 0) : ?>
<tr>
<th><?php echo __('appraisal, destruction and scheduling'); ?></th>
<td><?php echo nl2br($value); ?></td>
</tr>
<?php endif; ?>

<?php if (strlen($value = $informationObject->getAccruals(array('cultureFallback' => true))) > 0) : ?>
<tr>
<th><?php echo __('accruals'); ?></th>
<td><?php echo nl2br($value); ?></td>
</tr>
<?php endif; ?>

<?php if (strlen($value = $informationObject->getArrangement(array('cultureFallback' => true))) > 0) : ?>
<tr>
<th><?php echo __('system of arrangement'); ?></th>
<td><?php echo nl2br($value); ?></td>
</tr>
<?php endif; ?>

<?php if (strlen($value = $informationObject->getAccessConditions(array('cultureFallback' => true))) > 0) : ?>
<tr>
<th><?php echo __('conditions governing access'); ?></th>
<td><?php echo nl2br($value); ?></td>
</tr>
<?php endif; ?>

<?php if (strlen($value = $informationObject->getReproductionConditions(array('cultureFallback' => true))) > 0) : ?>
<tr>
<th><?php echo __('conditions governing reproduction'); ?></th>
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
</td></tr>
<?php endif; ?>

<?php if (count($scriptCodes) > 0) : ?>
<tr>
<th><?php echo __('script of material'); ?></th>
<td>
      <?php foreach ($scriptCodes as $scriptCode): ?>
    <?php echo format_script($scriptCode->getValue(array('sourceCulture'=>true))); ?><br />
  <?php endforeach; ?>
</td></tr>
<?php endif; ?>

<?php if (strlen($value = $informationObject->getPhysicalCharacteristics(array('cultureFallback' => true))) > 0) : ?>
<tr>
<th><?php echo __('physical characteristics'); ?></th>
<td><?php echo nl2br($value); ?></td>
</tr>
<?php endif; ?>

<?php if (strlen($value = $informationObject->getFindingAids(array('cultureFallback' => true))) > 0) : ?>
<tr>
<th><?php echo __('finding aids'); ?></th>
<td><?php echo nl2br($value); ?></td>
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
<th><?php echo __('location of copies'); ?></th>
<td><?php echo nl2br($value); ?></td>
</tr>
<?php endif; ?>

<?php if (strlen($value = $informationObject->getRelatedUnitsOfDescription(array('cultureFallback' => true))) > 0) : ?>
<tr>
<th><?php echo __('related units of description'); ?></th>
<td><?php echo nl2br($value); ?></td>
</tr>
<?php endif; ?>

<?php if (count($subjectAccessPoints) > 0) : ?>
<tr>
<th><?php echo __('subject access points'); ?></th>
<td>
  <?php foreach ($subjectAccessPoints as $subject): ?>
    <?php echo link_to($subject->getTerm(), 'term/browse?termId='.$subject->getTermId()); ?><br />
  <?php endforeach; ?>
</td></tr>
<?php endif; ?>

<?php if (count($placeAccessPoints) > 0) : ?>
<tr>
<th><?php echo __('place access points'); ?></th>
<td>
  <?php foreach ($placeAccessPoints as $place): ?>
    <?php echo link_to($place->getTerm(), 'term/browse?termId='.$place->getTermId()); ?><br />
  <?php endforeach; ?>
</td></tr>
<?php endif; ?>

<?php if (count($nameAccessPoints) > 0 ) : ?>
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

<?php if (count($notes) > 0) : ?>
<tr>
<th><?php echo __('notes'); ?></th>
<td>
  <?php foreach ($notes as $note): ?>
    <?php echo $note->getType().': '.nl2br($note->getContent(array('cultureFallback' => true))); ?><br />
  <?php endforeach; ?>
</td>
</tr>
<?php endif; ?>

<?php if ($informationObject->getDescriptionIdentifier()): ?>
  <tr><th><?php echo __('description identifier')?></th>
  <td><?php echo $informationObject->getDescriptionIdentifier() ?></td></tr>
<?php endif; ?>

<?php if (strlen($value = $informationObject->getInstitutionResponsibleIdentifier(array('cultureFallback' => true))) > 0) : ?>
  <tr><th><?php echo __('institution identifier')?></th>
  <td><?php echo $value ?></td></tr>
<?php endif; ?>

<?php if (strlen($value = $informationObject->getRules(array('cultureFallback' => true))) > 0) : ?>
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

<?php if (strlen($value = $informationObject->getRevisionHistory(array('cultureFallback' => true))) > 0) : ?>
  <tr><th><?php echo __('dates of creation revision deletion')?></th><td>
  <?php echo nl2br($value) ?>
  </td></tr>
<?php endif; ?>

<?php if (count($descriptionLanguageCodes) > 0): ?>
  <tr><th><?php echo __('language of description')?></th><td>
  <?php foreach ($descriptionLanguageCodes as $languageCode): ?>
    <?php echo format_language($languageCode->getValue(array('sourceCulture'=>true))) ?><br />
  <?php endforeach; ?>
  </td></tr>
<?php endif; ?>

<?php if (count($descriptionScriptCodes) > 0): ?>
  <tr><th><?php echo __('script of description')?></th><td>
  <?php foreach ($descriptionScriptCodes as $scriptCode): ?>
    <?php echo format_script($scriptCode->getValue(array('sourceCulture'=>true))) ?><br />
  <?php endforeach; ?>
  </td></tr>
<?php endif; ?>

<?php if (strlen($value = $informationObject->getSources(array('cultureFallback' => true))) > 0) : ?>
  <tr><th><?php echo __('sources')?></th>
  <td><?php echo nl2br($value) ?></td></tr>
<?php endif; ?>

<!--  Digital Object metadata -->
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
  <?php echo link_to (__('edit archival description'), 'informationobject/editIsad?id='.$informationObject->getId()) ?>
</div>
<?php endif; ?>

<div class="menu-extra">
<?php if ($editCredentials): ?>
  <?php echo link_to(__('add new'), 'informationobject/createIsad'); ?>
<?php endif; ?>
  <?php echo link_to(__('list all'), 'informationobject/list'); ?>
</div>
