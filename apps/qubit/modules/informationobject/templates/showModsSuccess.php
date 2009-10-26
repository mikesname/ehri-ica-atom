<div class="pageTitle"><?php echo __('view resource metadata') ?></div>

<table class="detail">
<tbody>

<tr>
  <td colspan="2" class="headerCell">
    <?php echo link_to_if(QubitAcl::check($informationObject, QubitAclAction::UPDATE_ID), render_title(QubitMods::getLabel($informationObject)), array('module' => 'informationobject', 'action' => 'edit', 'id' => $informationObject->id), array('title' => __('Edit resource metadata'))) ?>
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

<?php if (0 < count(QubitMods::getTypes($informationObject))): ?>
<?php foreach (QubitMods::getTypes($informationObject) as $type): ?>
  <tr>
    <th><?php echo __('type of resource') ?></th>
    <td>
      <?php echo $type->getTerm() ?>
    </td>
  </tr>
<?php endforeach; ?>
<?php endif; ?>

<?php if (0 < count($informationObject->language)): ?>
  <?php foreach ($informationObject->language as $code): ?>
    <tr><th><?php echo __('language') ?></th><td>
    <?php echo format_language($code) ?>
    </td></tr>
  <?php endforeach; ?>
<?php endif; ?>

<?php if (0 < count($informationObject->digitalObjects)): ?>
  <?php if ($informationObject->digitalObjects[0]->getMimeType()): ?>
    <tr>
    <th><?php echo __('internet media type') ?></th>
    <td><?php echo $informationObject->digitalObjects[0]->getMimeType() ?></td>
    </tr>
  <?php endif; ?>
<?php endif; ?>

<?php if (0 < count($informationObject->getSubjectAccessPoints())): ?>
  <?php foreach ($informationObject->getSubjectAccessPoints() as $subject): ?>
    <tr><th><?php echo __('subject') ?></th><td>
    <?php echo link_to($subject->term, array('module' => 'term', 'action' => 'browse', 'termId' => $subject->term->id)) ?>
    </td></tr>
  <?php endforeach; ?>
<?php endif; ?>

<?php if (0 < strlen($value = $informationObject->getAccessConditions(array('cultureFallback' => true)))): ?>
<tr>
<th><?php echo __('access condition') ?></th>
<td><?php echo nl2br($value) ?></td>
</tr>
<?php endif; ?>

<?php if (0 < count($informationObject->digitalObjects)): ?>
  <tr><th><?php echo __('URL') ?></th>
  <td><?php echo link_to(null, public_path($informationObject->digitalObjects[0]->getFullPath(), true)) ?></td>
  </tr>
<?php endif; ?>

<?php if ($repository = $informationObject->getRepository()): ?>
  <tr><th><?php echo __('Physical Location') ?></th>
  <td><?php if ($repository->getIdentifier()): ?>
    <?php echo $repository->getIdentifier() ?> -
  <?php endif; ?>
  <?php echo link_to(render_title($repository), array('module' => 'repository', 'action' => 'show', 'id' => $repository->id)) ?>
  <?php if ($contactInformation = $repository->getPrimaryContact()): ?>
     <br /><?php echo $contactInformation->getCity() ?><?php if ($contactInformation->getCity()): ?>, <?php endif; ?>
    <?php echo $contactInformation->getRegion() ?><?php if ($contactInformation->getRegion() && $contactInformation->getCountryCode()): ?>, <?php endif; ?>
    <?php echo format_country($contactInformation->getCountryCode()) ?>
  <?php endif; ?>
  </td></tr>
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
