<div class="pageTitle"><?php echo __('view resource metadata') ?></div>

<table class="detail">
<tbody>

<tr>
  <td colspan="2" class="headerCell">
    <?php echo link_to_if(QubitAcl::check($informationObject, QubitAclAction::UPDATE_ID), render_title(QubitDc::getLabel($informationObject)), array('module' => 'informationobject', 'action' => 'edit', 'id' => $informationObject->id), array('title' => __('Edit resource metadata'))) ?>
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

<?php if ($identifier = $informationObject->getIdentifier()): ?>
  <tr>
  <th><?php echo __('identifier') ?></th>
  <td><?php echo $identifier ?>
  </td>
  </tr>
<?php endif; ?>

<?php if ($title = $informationObject->getTitle()): ?>
  <tr>
  <th><?php echo __('title') ?></th>
  <td><?php echo $title ?>
  </td>
  </tr>
<?php endif; ?>

<?php  foreach ($informationObject->getCreators() as $creator): ?>
  <tr>
  <th><?php echo __('creator') ?></th>
  <td><?php echo link_to(render_title($creator), array('module' => 'actor', 'action' => 'show', 'id' => $creator->id)) ?>
    <?php if ($existence = $creator->getDatesOfExistence(array('cultureFallback' => true))): ?><span class="note2"> (<?php echo $existence ?>)</span><?php endif; ?>
  </td>
  </tr>
<?php endforeach; ?>

<?php  foreach ($informationObject->getPublishers() as $publisher): ?>
  <tr>
  <th><?php echo __('publisher') ?></th>
  <td><?php echo link_to(render_title($publisher), array('module' => 'actor', 'action' => 'show', 'id' => $publisher->id)) ?>
    <?php if ($existence = $publisher->getDatesOfExistence(array('cultureFallback' => true))): ?><span class="note2"> (<?php echo $existence ?>)</span><?php endif; ?>
  </td>
  </tr>
<?php endforeach; ?>

<?php  foreach ($informationObject->getContributors() as $contributor): ?>
  <tr>
  <th><?php echo __('contributor') ?></th>
  <td><?php echo link_to(render_title($contributor), array('module' => 'actor', 'action' => 'show', 'id' => $contributor->id)) ?>
    <?php if ($existence = $contributor->getDatesOfExistence(array('cultureFallback' => true))): ?><span class="note2"> (<?php echo $existence ?>)</span><?php endif; ?>
  </td>
  </tr>
<?php endforeach; ?>

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

<?php if (0 < count(QubitDc::getTypes($informationObject))): ?>
<?php foreach (QubitDc::getTypes($informationObject) as $type): ?>
  <tr>
    <th><?php echo __('type') ?></th>
    <td>
      <?php echo $type ?>
    </td>
  </tr>
<?php endforeach; ?>
<?php endif; ?>

<?php if (0 < strlen($value = $informationObject->getExtentAndMedium(array('cultureFallback' => true)))): ?>
  <tr>
    <th><?php echo __('format') ?></th>
    <td><?php echo nl2br($value) ?></td>
  </tr>
<?php endif; ?>

<?php if (0 < strlen($value = $informationObject->getScopeAndContent(array('cultureFallback' => true)))): ?>
<tr>
<th><?php echo __('description') ?></th>
<td><?php echo nl2br($value) ?></td>
</tr>
<?php endif; ?>

<?php if ($parent = $informationObject->getParent()): ?>
  <?php if ($parent->getParentId()): ?>
  <tr>
    <th><?php echo __('relation') ?></th>
    <td><?php echo __('is part of') ?>:
        <?php echo link_to(render_title($parent), array('module' => 'informationobject', 'action' => 'show', 'id' => $parent->id)) ?>
    </td>
   </tr>
   <?php endif; ?>
<?php endif; ?>

<?php echo render_show(__('relation'), $informationObject->getPropertyByName('relation', array('scope' => 'dc'))->value) ?>

<?php if (0 < count($informationObject->language)): ?>
  <?php foreach ($informationObject->language as $code): ?>
    <tr><th><?php echo __('language') ?></th><td>
    <?php echo format_language($code) ?>
    </td></tr>
  <?php endforeach; ?>
<?php endif; ?>

<?php if (0 < count($informationObject->getSubjectAccessPoints())): ?>
  <?php foreach ($informationObject->getSubjectAccessPoints() as $subject): ?>
    <tr><th><?php echo __('subject') ?></th><td>
    <?php echo link_to($subject->term, array('module' => 'term', 'action' => 'browse', 'termId' => $subject->term->id)) ?>
    </td></tr>
  <?php endforeach; ?>
<?php endif; ?>

<?php if (0 < count($informationObject->getPlaceAccessPoints())): ?>
  <?php foreach ($informationObject->getPlaceAccessPoints() as $place): ?>
    <tr><th><?php echo __('coverage') ?></th><td>
    <?php echo link_to($place->term, array('module' => 'term', 'action' => 'browse', 'termId' => $place->term->id)) ?>
    </td></tr>
  <?php endforeach; ?>
<?php endif; ?>

<?php if (0 < strlen($value = $informationObject->getLocationOfOriginals(array('cultureFallback' => true)))): ?>
<tr>
<th><?php echo __('source') ?></th>
<td><?php echo nl2br($value) ?></td>
</tr>
<?php endif; ?>

<?php if (0 < strlen($value = $informationObject->getAccessConditions(array('cultureFallback' => true)))): ?>
<tr>
<th><?php echo __('rights') ?></th>
<td><?php echo nl2br($value) ?></td>
</tr>
<?php endif; ?>

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
