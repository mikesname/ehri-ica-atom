<div class="pageTitle"><?php echo __('view').' '.__('archival description'); ?></div>

<table class="detail">
<tbody>

<?php if ($informationObject->getTitle()): ?>
	<tr><td colspan="2" class="headerCell">
	<?php if ($editCredentials) echo link_to($informationObject->getTitle(), 'informationobject/edit/?id='.$informationObject->getId());
				else echo $informationObject->getTitle(); ?>
	</td></tr>
<?php endif; ?>

<?php if ($informationObject->getIdentifier()) : ?>
<tr>
<th><?php echo __('reference code'); ?>: </th>
<td><?php echo $informationObject->getIdentifier(); ?></td>
</tr>
<?php endif; ?>

<?php if($titleNotes) : ?>
<tr>
<th><?php echo __('title notes'); ?>: </th>
<td>
	<?php foreach ($titleNotes as $note): ?>
		<?php echo $note['note']; ?><br />
	<?php endforeach; ?>
</td></tr>
<?php endif; ?>

<?php if($informationObject->getVersion()) : ?>
<tr>
<th><?php echo __('version'); ?>: </th>
<td><?php echo $informationObject->getVersion(); ?></td>
</tr>
<?php endif; ?>

<?php if($informationObject->getDates()) : ?>
<tr><th><?php echo __('dates'); ?>: </th><td>
<?php foreach ($informationObject->getDates() as $date): ?>
<?php echo $date.'<br />' ?>
<?php endforeach; ?>
</td></tr>
<?php endif; ?>

<?php if($informationObject->getLevelOfDescriptionId()) : ?>
<tr>
<th><?php echo __('level of description'); ?>: </th>
<td><?php echo $informationObject->getLevelOfDescription(); ?></td>
</tr>
<?php endif; ?>

<?php if($informationObject->getExtentAndMedium()) : ?>
<tr>
<th><?php echo __('extent and medium'); ?>: </th>
<td><?php echo nl2br($informationObject->getExtentAndMedium()); ?></td>
</tr>
<?php endif; ?>

<?php  foreach ($creators as $creator): ?>
	<tr>
	<th><?php echo __('creator'); ?>: </th>
	<td><?php echo link_to($creator->getAuthorizedFormOfName(), 'actor/show?id='.$creator->getId()); ?>
    <?php if ($creator->getDatesOfExistence()) echo ' ('.$creator->getDatesOfExistence()->getDescription().')'; ?>
	<br />
    <?php echo nl2br($creator->getHistory()); ?>
	</td>
	</tr>
<?php endforeach; ?>

<?php if($informationObject->getArchivalHistory()) : ?>
<tr>
<th><?php echo __('archival history'); ?>: </th>
<td><?php echo nl2br($informationObject->getArchivalHistory()); ?></td>
</tr>
<?php endif; ?>

<?php if($informationObject->getRepositoryId()) : ?>
<tr>
<th><?php echo __('repository'); ?>: </th>
<td><?php echo link_to($informationObject->getRepository(), 'repository/show?id='.$informationObject->getRepositoryId()); ?></td>
</tr>
<?php endif; ?>

<?php if($informationObject->getAcquisition()) : ?>
<tr>
<th><?php echo __('immediate source of acquisition'); ?>: </th>
<td><?php echo nl2br($informationObject->getAcquisition()); ?></td>
</tr>
<?php endif; ?>

<?php if($informationObject->getScopeAndContent()) : ?>
<tr>
<th><?php echo __('scope and content'); ?>: </th>
<td><?php echo nl2br($informationObject->getScopeAndContent()); ?></td>
</tr>
<?php endif; ?>

<?php if($informationObject->getAppraisal()) : ?>
<tr>
<th><?php echo __('appraisal, destruction and scheduling'); ?>: </th>
<td><?php echo nl2br($informationObject->getAppraisal()); ?></td>
</tr>
<?php endif; ?>

<?php if($informationObject->getAccruals()) : ?>
<tr>
<th><?php echo __('accruals'); ?>: </th>
<td><?php echo nl2br($informationObject->getAccruals()); ?></td>
</tr>
<?php endif; ?>

<?php if($informationObject->getArrangement()) : ?>
<tr>
<th><?php echo __('system of arrangement'); ?>: </th>
<td><?php echo nl2br($informationObject->getArrangement()); ?></td>
</tr>
<?php endif; ?>

<?php if($informationObject->getAccessConditions()) : ?>
<tr>
<th><?php echo __('conditions governing access'); ?>: </th>
<td><?php echo nl2br($informationObject->getAccessConditions()); ?></td>
</tr>
<?php endif; ?>

<?php if($informationObject->getReproductionConditions()) : ?>
<tr>
<th><?php echo __('conditions governing reproduction'); ?>: </th>
<td><?php echo nl2br($informationObject->getReproductionConditions()); ?></td>
</tr>
<?php endif; ?>

<?php if($languages) : ?>
<tr>
<th><?php echo __('language'); ?>: </th>
<td>
	<?php foreach ($languages as $language): ?>
		<?php echo $language['termName']; ?><br />
	<?php endforeach; ?>
</td></tr>
<?php endif; ?>

<?php if($scripts) : ?>
<tr>
<th><?php echo __('script'); ?>: </th>
<td>
	<?php foreach ($scripts as $script): ?>
		<?php echo $script['termName']; ?><br />
	<?php endforeach; ?>
</td></tr>
<?php endif; ?>

<?php if($informationObject->getPhysicalCharacteristics()) : ?>
<tr>
<th><?php echo __('physical characteristics'); ?>: </th>
<td><?php echo nl2br($informationObject->getPhysicalCharacteristics()); ?></td>
</tr>
<?php endif; ?>

<?php if($informationObject->getFindingAids()) : ?>
<tr>
<th><?php echo __('finding aids'); ?>: </th>
<td><?php echo nl2br($informationObject->getFindingAids()); ?></td>
</tr>
<?php endif; ?>

<?php if($informationObject->getLocationOfOriginals()) : ?>
<tr>
<th><?php echo __('location of originals'); ?>: </th>
<td><?php echo nl2br($informationObject->getLocationOfOriginals()); ?></td>
</tr>
<?php endif; ?>

<?php if($informationObject->getLocationOfCopies()) : ?>
<tr>
<th><?php echo __('location of copies'); ?>: </th>
<td><?php echo nl2br($informationObject->getLocationOfCopies()); ?></td>
</tr>
<?php endif; ?>

<?php if($informationObject->getRelatedUnitsOfDescription()) : ?>
<tr>
<th><?php echo __('related units of description'); ?>: </th>
<td><?php echo nl2br($informationObject->getRelatedUnitsOfDescription()); ?></td>
</tr>
<?php endif; ?>

<?php if($notes) : ?>
<tr>
<th><?php echo __('notes'); ?>: </th>
<td>
	<?php foreach ($notes as $note): ?>
		<?php echo $note['noteType'].': '.nl2br($note['note']); ?><br />
	<?php endforeach; ?>
</td>
</tr>
<?php endif; ?>

<?php if($informationObject->getRules()) : ?>
<tr>
<th><?php echo __('rules or conventions'); ?>: </th>
<td><?php echo nl2br($informationObject->getRules()); ?></td>
</tr>
<?php endif; ?>

<?php if($datesOfDescription) : ?>
<tr>
<th><?php echo __('dates of description'); ?>: </th>
<td><?php echo $datesOfDescription; ?></td>
</tr>
<?php endif; ?>

<?php if($subjectAccessPoints) : ?>
<tr>
<th><?php echo __('subject').' '.__('access points'); ?>: </th>
<td>
	<?php foreach ($subjectAccessPoints as $subject): ?>
		<?php echo link_to($subject['termName'], 'term/browse?termId='.$subject['termId']); ?><br />
	<?php endforeach; ?>
</td></tr>
<?php endif; ?>

<?php if($placeAccessPoints) : ?>
<tr>
<th><?php echo __('place').' '.__('access points'); ?>: </th>
<td>
	<?php foreach ($placeAccessPoints as $place): ?>
		<?php echo link_to($place, 'place/show?id='.$place->getId()); ?><br />
	<?php endforeach; ?>
</td></tr>
<?php endif; ?>

<?php if($actorAccessPoints) : ?>
<tr>
<th><?php echo __('person').' / '.__('organization').' '.__('access points'); ?>: </th>
<td>
	<?php foreach ($actorAccessPoints as $accessPoint): ?>
		<?php echo link_to($accessPoint, 'actor/show?id='.$accessPoint->getId()); ?><br />
	<?php endforeach; ?>
</td></tr>
<?php endif; ?>

</tbody>
</table>

<?php if ($editCredentials): ?>
<div class="menu-action">
	<?php echo link_to (__('edit').' '.__('archival description'), 'informationobject/edit?id='.$informationObject->getId()) ?>
</div>
<?php endif; ?>
