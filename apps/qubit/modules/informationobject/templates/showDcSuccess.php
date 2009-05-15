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

<?php  foreach ($creators as $creator): ?>
  <tr>
  <th><?php echo __('creator') ?></th>
  <td><?php echo link_to(render_title($creator), 'actor/show?id='.$creator->getId()); ?>
    <?php if ($existence = $creator->getDatesOfExistence(array('cultureFallback' => true))) echo ' ('.$existence.')'; ?>
  </td>
  </tr>
<?php endforeach; ?>

<?php  foreach ($informationObject->getPublishers() as $publisher): ?>
  <tr>
  <th><?php echo __('publisher') ?></th>
  <td><?php echo link_to(render_title($publisher), 'actor/show?id='.$publisher->getId()); ?>
    <?php if ($existence = $publisher->getDatesOfExistence(array('cultureFallback' => true))) echo ' ('.$existence.')'; ?>
  </td>
  </tr>
<?php endforeach; ?>

<?php  foreach ($informationObject->getContributors() as $contributor): ?>
  <tr>
  <th><?php echo __('contributor') ?></th>
  <td><?php echo link_to(render_title($contributor), 'actor/show?id='.$contributor->getId()); ?>
    <?php if ($existence = $contributor->getDatesOfExistence(array('cultureFallback' => true))) echo ' ('.$existence.')'; ?>
  </td>
  </tr>
<?php endforeach; ?>

<?php if (count($informationObject->getDates()) > 0) : ?>

<?php foreach ($informationObject->getDates() as $date): ?>
<tr><th><?php echo __('date'); ?></th><td>
  <?php echo $date->getDateDisplay(array('cultureFallback' => true)).' ('.$date->getType().')' ?>
</td></tr>
<?php endforeach; ?>
<?php endif; ?>

<?php if (count($dcTypes) > 0) : ?>
<?php foreach ($dcTypes as $dcType): ?>
  <tr>
    <th><?php echo __('type'); ?></th>
    <td>
      <?php echo $dcType ?><br />
    </td>
  </tr>
<?php endforeach; ?>
<?php endif; ?>

<?php if (strlen($value = $informationObject->getExtentAndMedium(array('cultureFallback' => true))) > 0) : ?>
  <tr>
    <th><?php echo __('format'); ?></th>
    <td><?php echo nl2br($value); ?></td>
  </tr>
<?php endif; ?>

<?php if (strlen($value = $informationObject->getScopeAndContent(array('cultureFallback' => true))) > 0) : ?>
<tr>
<th><?php echo __('description'); ?></th>
<td><?php echo nl2br($value); ?></td>
</tr>
<?php endif; ?>

<?php if ($parent = $informationObject->getParent()): ?>
  <?php if ($parent->getParentId()): ?>
  <tr>
    <th><?php echo __('relation'); ?></th>
    <td><?php echo __('is part of').': ' ?>
        <?php echo link_to(render_title($parent), 'informationobject/showDc?id='.$parent->getId()) ?>
    </td>
   </tr>
   <?php endif; ?>
<?php endif; ?>

<?php if ($dcRelation): ?>
  <tr>
    <th><?php echo __('relation'); ?></th>
    <td><?php echo $dcRelation->getValue(); ?></td>
  </tr>
<?php endif; ?>

<?php if (count($languageCodes) > 0) : ?>
  <?php foreach ($languageCodes as $languageCode): ?>
    <tr><th><?php echo __('language'); ?></th><td>
    <?php echo format_language($languageCode->getValue(array('sourceCulture'=>true))); ?><br />
    </td></tr>
  <?php endforeach; ?>
<?php endif; ?>

<?php if (count($subjectAccessPoints) > 0) : ?>
  <?php foreach ($subjectAccessPoints as $subject): ?>
    <tr><th><?php echo __('subject'); ?></th><td>
    <?php echo link_to($subject->getTerm(), 'term/browse?termId='.$subject->getTermId()); ?><br />
    </td></tr>
  <?php endforeach; ?>
<?php endif; ?>

<?php if (count($placeAccessPoints) > 0) : ?>
  <?php foreach ($placeAccessPoints as $place): ?>
    <tr><th><?php echo __('coverage'); ?></th><td>
    <?php echo link_to($place->getTerm(), 'term/browse?termId='.$place->getTermId()); ?><br />
    </td></tr>
  <?php endforeach; ?>
<?php endif; ?>

<?php if (strlen($value = $informationObject->getLocationOfOriginals(array('cultureFallback' => true))) > 0) : ?>
<tr>
<th><?php echo __('source'); ?></th>
<td><?php echo nl2br($value); ?></td>
</tr>
<?php endif; ?>

<?php if (strlen($value = $informationObject->getAccessConditions(array('cultureFallback' => true))) > 0) : ?>
<tr>
<th><?php echo __('rights'); ?></th>
<td><?php echo nl2br($value); ?></td>
</tr>
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