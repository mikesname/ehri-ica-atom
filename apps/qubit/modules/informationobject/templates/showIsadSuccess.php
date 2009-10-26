<div class="pageTitle"><?php echo __('view archival description') ?></div>

<table class="detail">
<tbody>

<tr>
  <td colspan="2" class="headerCell">
    <?php echo link_to_if(QubitAcl::check($informationObject, QubitAclAction::UPDATE_ID), render_title(QubitIsad::getLabel($informationObject)), array('module' => 'informationobject', 'action' => 'edit', 'id' => $informationObject->id), array('title' => __('Edit archival description'))) ?>
  </td>
</tr>

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

<!-- ******************************************** -->
<!--   START IDENTITY AREA                         -->
<!-- ******************************************** -->

<?php if (0 < strlen($informationObject->getIdentifier())
  || 0 < strlen($informationObject->getTitle(array('cultureFallback' => true)))
  || 0 < strlen($informationObject->getLevelOfDescriptionId())
  || 0 < strlen($informationObject->getExtentAndMedium(array('cultureFallback' => true)))): ?>
<tr id="identityArea"><td colspan="2" class="subHeaderCell">
  <?php echo link_to_if(SecurityPriviliges::editCredentials($sf_user, 'informationObject'), __('identity area'), array('module' => 'informationobject', 'action' => 'edit', 'id' => $informationObject->id), array('anchor' => 'identityArea', 'title' => __('Edit identity area'))) ?>
</td></tr>
<?php endif; ?>

<?php if ($informationObject->getIdentifier()): ?>
  <tr>
  <th><?php echo __('reference code') ?></th>
  <td><?php echo QubitIsad::getReferenceCode($informationObject) ?>
  </td>
  </tr>
<?php endif; ?>

<?php if ($informationObject->getTitle(array('cultureFallback' => true))): ?>
  <tr>
  <th><?php echo __('title') ?></th>
  <td><?php echo $informationObject->getTitle(array('cultureFallback' => true)) ?>
  </td>
  </tr>
<?php endif; ?>

<?php if (0 < count($informationObject->getDates())): ?>
  <tr>
    <th>
      <?php echo __('date(s)') ?>
    </th><td>
      <ul>
        <?php foreach ($informationObject->getDates() as $date): ?>
          <li><?php echo date_display($date) ?> (<?php echo $date->getType(array('cultureFallback' => true)) ?>)</li>
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

<?php if (0 < strlen($value = $informationObject->getExtentAndMedium(array('cultureFallback' => true)))): ?>
<tr>
<th><?php echo __('extent and medium') ?></th>
<td><?php echo nl2br($value) ?></td>
</tr>
<?php endif; ?>

<!-- ******************************************** -->
<!--   START CONTEXT AREA                         -->
<!-- ******************************************** -->

<?php if (0 < count($informationObject->getCreators())
  || 0 < count($physicalObjects)
  || 0 < strlen($informationObject->getRepositoryId())
  || 0 < strlen($informationObject->getArchivalHistory(array('cultureFallback' => true)))
  || 0 < strlen($informationObject->getAcquisition(array('cultureFallback' => true)))): ?>
<tr id="contextArea"><td colspan="2" class="subHeaderCell">
  <?php echo link_to_if(SecurityPriviliges::editCredentials($sf_user, 'informationObject'), __('context area'), array('module' => 'informationobject', 'action' => 'edit', 'id' => $informationObject->id), array('anchor' => 'contextArea', 'title' => __('Edit context area'))) ?>
</td></tr>
<?php endif; ?>

<?php foreach ($informationObject->getCreators() as $creator): ?>
  <tr>
  <th><?php echo __('name of creator') ?></th>
  <td><?php echo link_to(render_title($creator), array('module' => 'actor', 'action' => 'show', 'id' => $creator->id)) ?>
    <?php if ($existence = $creator->getDatesOfExistence(array('cultureFallback' => true))): ?> (<?php echo $existence ?>)<?php endif; ?>
  <?php if ($history = $creator->getHistory(array('cultureFallback' => true))): ?>
    <table class="detail" style="margin-top: 5px;"><tr><th style="text-align: left; padding: 1px;">
    <?php if ($creator->getEntityTypeId() == QubitTerm::CORPORATE_BODY_ID): ?>
      <?php echo __('Administrative') ?>
    <?php else: ?>
      <?php echo __('Biographic') ?>
    <?php endif; ?>
      <?php echo __('history') ?></th></tr>
      <tr><td><?php echo nl2br($history) ?></td></tr>
    </table>
  <?php endif; ?>
  </td>
  </tr>
<?php endforeach; ?>

<?php if (count($physicalObjects) && SecurityPriviliges::editCredentials($sf_user, 'informationObject')): ?>
  <?php include_partial('physicalobject/show',
    array('informationObject' => $informationObject, 'physicalObjects' => $physicalObjects)) ?>
<?php endif; ?>

<?php if ($informationObject->getRepositoryId()): ?>
<tr>
<th><?php echo __('repository') ?></th>
<td><?php echo link_to(render_title($informationObject->repository), array('module' => 'repository', 'action' => 'show', 'id' => $informationObject->repository->id)) ?></td>
</tr>
<?php endif; ?>

<?php if (0 < strlen($value = $informationObject->getArchivalHistory(array('cultureFallback' => true)))): ?>
<tr>
<th><?php echo __('archival history') ?></th>
<td><?php echo nl2br($value) ?></td>
</tr>
<?php endif; ?>

<?php if (0 < strlen($value = $informationObject->getAcquisition(array('cultureFallback' => true)))): ?>
<tr>
<th><?php echo __('immediate source of acquisition or transfer') ?></th>
<td><?php echo nl2br($value) ?></td>
</tr>
<?php endif; ?>

<!-- ******************************************** -->
<!--   START CONTENT AND STRUCTURE AREA           -->
<!-- ******************************************** -->

<?php if (0 < strlen($informationObject->getScopeAndContent(array('cultureFallback' => true)))
  || 0 < strlen($informationObject->getAppraisal(array('cultureFallback' => true)))
  || 0 < strlen($informationObject->getAccruals(array('cultureFallback' => true)))
  || 0 < strlen($informationObject->getArrangement(array('cultureFallback' => true)))): ?>
<tr id="contentAndStructureArea"><td colspan="2" class="subHeaderCell">
  <?php echo link_to_if(SecurityPriviliges::editCredentials($sf_user, 'informationObject'), __('content and structure area'), array('module' => 'informationobject', 'action' => 'edit', 'id' => $informationObject->id), array('anchor' => 'contentAndStructureArea', 'title' => __('Edit content and structure area'))) ?>
</td></tr>
<?php endif; ?>

<?php if (0 < strlen($value = $informationObject->getScopeAndContent(array('cultureFallback' => true)))): ?>
<tr>
<th><?php echo __('scope and content') ?></th>
<td><?php echo nl2br($value) ?></td>
</tr>
<?php endif; ?>

<?php if (0 < strlen($value = $informationObject->getAppraisal(array('cultureFallback' => true)))): ?>
<tr>
<th><?php echo __('appraisal, destruction and scheduling') ?></th>
<td><?php echo nl2br($value) ?></td>
</tr>
<?php endif; ?>

<?php if (0 < strlen($value = $informationObject->getAccruals(array('cultureFallback' => true)))): ?>
<tr>
<th><?php echo __('accruals') ?></th>
<td><?php echo nl2br($value) ?></td>
</tr>
<?php endif; ?>

<?php if (0 < strlen($value = $informationObject->getArrangement(array('cultureFallback' => true)))): ?>
<tr>
<th><?php echo __('system of arrangement') ?></th>
<td><?php echo nl2br($value) ?></td>
</tr>
<?php endif; ?>

<!-- ******************************************** -->
<!--   START CONDITIONS OF ACCESS AND USE AREA    -->
<!-- ******************************************** -->

<?php if (0 < strlen($informationObject->getAccessConditions(array('cultureFallback' => true)))
  || 0 < strlen($informationObject->getReproductionConditions(array('cultureFallback' => true)))
  || 0 < count($informationObject->language)
  || 0 < count($informationObject->script)
  || 0 < strlen($informationObject->getPhysicalCharacteristics(array('cultureFallback' => true)))
  || 0 < strlen($informationObject->getFindingAids(array('cultureFallback' => true)))): ?>
<tr id="conditionsOfAccessAndUseArea"><td colspan="2" class="subHeaderCell">
  <?php echo link_to_if(SecurityPriviliges::editCredentials($sf_user, 'informationObject'), __('conditions of access and use area'), array('module' => 'informationobject', 'action' => 'edit', 'id' => $informationObject->id), array('anchor' => 'conditionsOfAccessAndUseArea', 'title' => __('Edit conditions of access and use area'))) ?>
</td></tr>
<?php endif; ?>

<?php if (0 < strlen($value = $informationObject->getAccessConditions(array('cultureFallback' => true)))): ?>
<tr>
<th><?php echo __('conditions governing access') ?></th>
<td><?php echo nl2br($value) ?></td>
</tr>
<?php endif; ?>

<?php if (0 < strlen($value = $informationObject->getReproductionConditions(array('cultureFallback' => true)))): ?>
<tr>
<th><?php echo __('conditions governing reproduction') ?></th>
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

<?php if (0 < strlen($value = $informationObject->getPhysicalCharacteristics(array('cultureFallback' => true)))): ?>
<tr>
<th><?php echo __('physical characteristics and technical requirements') ?></th>
<td><?php echo nl2br($value) ?></td>
</tr>
<?php endif; ?>

<?php if (0 < strlen($value = $informationObject->getFindingAids(array('cultureFallback' => true)))): ?>
<tr>
<th><?php echo __('finding aids') ?></th>
<td><?php echo nl2br($value) ?></td>
</tr>
<?php endif; ?>

<!-- ******************************************** -->
<!--   START ALLIED MATERIALS AREA                -->
<!-- ******************************************** -->

<?php if (0 < strlen($informationObject->getLocationOfOriginals(array('cultureFallback' => true)))
  || 0 < strlen($informationObject->getLocationOfCopies(array('cultureFallback' => true)))
  || 0 < strlen($informationObject->getRelatedUnitsOfDescription(array('cultureFallback' => true)))
  || 0 < count($publicationNotes)): ?>
<tr id="alliedMaterialsArea"><td colspan="2" class="subHeaderCell">
  <?php echo link_to_if(SecurityPriviliges::editCredentials($sf_user, 'informationObject'), __('allied materials area'), array('module' => 'informationobject', 'action' => 'edit', 'id' => $informationObject->id), array('anchor' => 'alliedMaterialsArea', 'title' => __('Edit alied materials area'))) ?>
</td></tr>
<?php endif; ?>

<?php if (0 < strlen($value = $informationObject->getLocationOfOriginals(array('cultureFallback' => true)))): ?>
<tr>
<th><?php echo __('existence and location of originals') ?></th>
<td><?php echo nl2br($value) ?></td>
</tr>
<?php endif; ?>

<?php if (0 < strlen($value = $informationObject->getLocationOfCopies(array('cultureFallback' => true)))): ?>
<tr>
<th><?php echo __('existence and location of copies') ?></th>
<td><?php echo nl2br($value) ?></td>
</tr>
<?php endif; ?>

<?php if (0 < strlen($value = $informationObject->getRelatedUnitsOfDescription(array('cultureFallback' => true)))): ?>
<tr>
<th><?php echo __('related units of description') ?></th>
<td><?php echo nl2br($value) ?></td>
</tr>
<?php endif; ?>

<?php if (0 < count($publicationNotes)): ?>
  <?php foreach ($publicationNotes as $publicationNote): ?>
  <tr>
  <th><?php echo __('publication note') ?></th>
  <td><?php echo nl2br($publicationNote->getContent(array('cultureFallback' => true))) ?>
  </td>
  </tr>
  <?php endforeach; ?>
<?php endif; ?>

<!-- ******************************************** -->
<!--   START NOTES AREA                           -->
<!-- ******************************************** -->

<?php if (0 < count($notes)): ?>
<tr id="notesArea"><td colspan="2" class="subHeaderCell">
  <?php echo link_to_if(SecurityPriviliges::editCredentials($sf_user, 'informationObject'), __('notes area'), array('module' => 'informationobject', 'action' => 'edit', 'id' => $informationObject->id), array('anchor' => 'notesArea', 'title' => __('Edit notes area'))) ?>
</td></tr>

<?php foreach ($notes as $note): ?>
<tr>
  <th><?php echo __('note') ?></th>
  <td>
    <?php echo nl2br($note->getContent(array('cultureFallback' => true))) ?><br />
  </td>
</tr>
<?php endforeach; ?>
<?php endif; ?>

<!-- ******************************************** -->
<!--   START ACCESS POINTS                        -->
<!-- ******************************************** -->

<?php if (0 < count($informationObject->getSubjectAccessPoints())
  || 0 < count($informationObject->getPlaceAccessPoints())
  || 0 < count($nameAccessPoints)): ?>
<tr><td colspan="2" class="subHeaderCell">
  <?php echo __('access points') ?>
</td></tr>
<?php endif; ?>

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
          <li><?php echo link_to(render_title($relation->object), array('module' => 'actor', 'action' => 'show', 'id' => $relation->objectId)) ?></li>
          <?php endif; ?>
        <?php endforeach; ?>
      </ul>
    </td>
  </tr>
<?php endif; ?>

<!-- ******************************************** -->
<!--   START CONTROL AREA                         -->
<!-- ******************************************** -->

<?php if (0 < count($archivistsNotes)
  || 0 < strlen($informationObject->getDescriptionIdentifier(array('cultureFallback' => true)))
  || 0 < strlen($informationObject->getInstitutionResponsibleIdentifier(array('cultureFallback' => true)))
  || 0 < strlen($informationObject->getRules(array('cultureFallback' => true)))
  || 0 < strlen($informationObject->getDescriptionStatusId())
  || 0 < strlen($informationObject->getDescriptionDetailId())
  || 0 < strlen($informationObject->getRevisionHistory(array('cultureFallback' => true)))
  || 0 < count($informationObject->languageOfDescription)
  || 0 < count($informationObject->scriptOfDescription)
  || 0 < strlen($informationObject->getSources(array('cultureFallback' => true)))): ?>
<tr id="descriptionControlArea"><td colspan="2" class="subHeaderCell">
  <?php echo link_to_if(SecurityPriviliges::editCredentials($sf_user, 'informationObject'), __('description control area'), array('module' => 'informationobject', 'action' => 'edit', 'id' => $informationObject->id), array('anchor' => 'descriptionControlArea', 'title' => __('Edit description control area'))) ?>
</td></tr>
<?php endif; ?>

<?php if (0 < count($archivistsNotes)): ?>
<?php foreach ($archivistsNotes as $archivistsNote): ?>
<tr>
  <th><?php echo __('archivist\'s note') ?></th>
  <td>
    <?php echo nl2br($archivistsNote->getContent(array('cultureFallback' => true))) ?><br />
  </td>
</tr>
<?php endforeach; ?>
<?php endif; ?>

<?php if ($informationObject->getDescriptionIdentifier(array('cultureFallback' => true))): ?>
  <tr><th><?php echo __('description identifier') ?></th>
  <td><?php echo $informationObject->getDescriptionIdentifier(array('cultureFallback' => true)) ?></td></tr>
<?php endif; ?>

<?php echo render_show(__('institution identifiers'), $informationObject->getInstitutionResponsibleIdentifier(array('cultureFallback' => true))) ?>

<?php if (0 < strlen($value = $informationObject->getRules(array('cultureFallback' => true)))): ?>
  <tr><th><?php echo __('rules') ?></th>
  <td><?php echo nl2br($value) ?></td></tr>
<?php endif; ?>

<?php if ($informationObject->getDescriptionStatusId()): ?>
  <tr><th><?php echo __('status') ?></th><td>
  <?php echo $informationObject->getDescriptionStatus()->getName(array('cultureFallback' => true)) ?>
  </td></tr>
<?php endif; ?>

<?php if ($informationObject->getDescriptionDetailId()): ?>
  <tr><th><?php echo __('detail') ?></th><td>
  <?php echo $informationObject->getDescriptionDetail()->getName(array('cultureFallback' => true)) ?>
  </td></tr>
<?php endif; ?>

<?php if (0 < strlen($value = $informationObject->getRevisionHistory(array('cultureFallback' => true)))): ?>
  <tr><th><?php echo __('dates of creation revision deletion') ?></th><td>
  <?php echo nl2br($value) ?>
  </td></tr>
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
    </th><td>
      <ul>
        <?php foreach ($informationObject->scriptOfDescription as $code): ?>
          <li><?php echo format_script($code) ?></li>
        <?php endforeach; ?>
      </ul>
    </td>
  </tr>
<?php endif; ?>

<?php if (0 < strlen($value = $informationObject->getSources(array('cultureFallback' => true)))): ?>
  <tr><th><?php echo __('sources') ?></th>
  <td><?php echo nl2br($value) ?></td></tr>
<?php endif; ?>

<!-- ******************************************** -->
<!--   START DIGITAL OBJECT METADATA              -->
<!-- ******************************************** -->

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
