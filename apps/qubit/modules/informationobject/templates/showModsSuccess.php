<div class="pageTitle"><?php echo __('view resource metadata'); ?></div>

<table class="detail">
<tbody>

<tr>
  <td colspan="2" class="headerCell">
  <?php if ($editCredentials): ?>
    <?php echo link_to(render_title(QubitDc::getLabel($informationObject)), array('module' => 'informationobject', 'action' => 'edit', 'id' => $informationObject->getId())); ?>
  <?php else: ?>
    <?php echo render_title(QubitDc::getLabel($informationObject)); ?>
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

<?php if ($identifier = $informationObject->getIdentifier()): ?>
  <tr>
  <th><?php echo __('identifier'); ?></th>
  <td><?php echo $identifier ?>
  </td>
  </tr>
<?php endif; ?>

<?php if ($title = $informationObject->getTitle()): ?>
  <tr>
  <th><?php echo __('title'); ?></th>
  <td><?php echo $title ?>
  </td>
  </tr>
<?php endif; ?>

<?php if (count($nameAccessPoints) > 0 ) : ?>
  <?php foreach ($nameAccessPoints as $name): ?>
    <tr><th><?php echo __('name'); ?></th>
      <td>
        <?php echo link_to(render_title($name->getActor()), 'actor/show?id='.$name->getActorId()) ?>
        <?php echo ' ('.$name->getType()->getRole().')' ?>
      </td>
    </tr>
  <?php endforeach; ?>
<?php endif; ?>

<?php if (count($informationObject->getDates()) > 0) : ?>
  <?php foreach ($informationObject->getDates() as $date): ?>
    <tr><th>
    <?php if ($date->getTypeId() == QubitTerm::CREATION_ID): ?>
      <?php echo __('date (Created)'); ?></th><td>
      <?php echo $date->getDateDisplay(array('cultureFallback' => true)) ?>
      </td></tr>
    <?php elseif ($date->getTypeId() == QubitTerm::PUBLICATION_ID): ?>
      <?php echo __('date (Issued)'); ?></th><td>
      <?php echo $date->getDateDisplay(array('cultureFallback' => true)) ?>
      </td></tr>
    <?php else: ?>
      <?php echo __('date (Other)'); ?></th><td>
      <?php echo $date->getDateDisplay(array('cultureFallback' => true)) ?>
      <?php echo ' ('.$date->getType().')' ?>
      </td></tr>
    <?php endif; ?>

    <?php if ($place = $date->getPlace()): ?>
      <tr><th><?php echo __('place') ?></th>
      <td><?php echo $place ?></td></tr>
    <?php endif; ?>
  <?php endforeach; ?>
<?php endif; ?>

<?php if (count($modsTypes) > 0) : ?>
<?php foreach ($modsTypes as $modsType): ?>
  <tr>
    <th><?php echo __('type of resource'); ?></th>
    <td>
      <?php echo $modsType->getTerm() ?><br />
    </td>
  </tr>
<?php endforeach; ?>
<?php endif; ?>

<?php if (count($languageCodes) > 0) : ?>
  <?php foreach ($languageCodes as $languageCode): ?>
    <tr><th><?php echo __('language'); ?></th><td>
    <?php echo format_language($languageCode->getValue(array('sourceCulture'=>true))); ?><br />
    </td></tr>
  <?php endforeach; ?>
<?php endif; ?>

<?php if (isset($digitalObject)): ?>
  <?php if ($digitalObject->getMimeType()): ?>
    <tr>
    <th><?php echo __('internet media type'); ?></th>
    <td><?php echo $digitalObject->getMimeType(); ?></td>
    </tr>
  <?php endif; ?>
<?php endif; ?>

<?php if (count($subjectAccessPoints) > 0) : ?>
  <?php foreach ($subjectAccessPoints as $subject): ?>
    <tr><th><?php echo __('subject'); ?></th><td>
    <?php echo link_to($subject->getTerm(), 'term/browse?termId='.$subject->getTermId()); ?><br />
    </td></tr>
  <?php endforeach; ?>
<?php endif; ?>

<?php if (strlen($value = $informationObject->getAccessConditions(array('cultureFallback' => true))) > 0) : ?>
<tr>
<th><?php echo __('access condition'); ?></th>
<td><?php echo nl2br($value); ?></td>
</tr>
<?php endif; ?>

<?php if (isset($digitalObject)): ?>
  <tr><th><?php echo __('URL'); ?></th>
  <td><?php echo link_to($locationUrl, $locationUrl) ?></td>
  </tr>
<?php endif; ?>

<?php if ($repository = $informationObject->getRepository()): ?>
  <tr><th><?php echo __('Physical Location'); ?></th>
  <td><?php if($repository->getIdentifier()):?>
    <?php echo $repository->getIdentifier().' - ' ?>
  <?php endif; ?>
  <?php echo link_to($repository->__toString(), array('module' => 'repository', 'action' => 'show', 'id' => $repository->getId())) ?>
  <?php if ($contactInformation = $repository->getPrimaryContact()): ?>
     <br /><?php echo $contactInformation->getCity() ?><?php if ($contactInformation->getCity()): ?><?php echo ', '?><?php endif; ?>
    <?php echo $contactInformation->getRegion() ?><?php if ($contactInformation->getRegion() && $contactInformation->getCountryCode()): ?><?php echo ', ' ?><?php endif; ?>
    <?php echo format_country($contactInformation->getCountryCode()) ?>
  <?php endif; ?>
  </td></tr>
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
  <?php echo link_to (__('edit resource metadata'), array('module' => 'informationobject', 'action' => 'edit', 'id' => $informationObject->getId())) ?>
</div>
<?php endif; ?>

<div class="menu-extra">
<?php if ($editCredentials): ?>
  <?php echo link_to(__('add new'), array('module' => 'informationobject', 'action' => 'create')); ?>
<?php endif; ?>
  <?php echo link_to(__('list all'), array('module' => 'informationobject', 'action' => 'list')); ?>
</div>
