<h1><?php echo __('View resource metadata') ?></h1>

<?php echo link_to_if(QubitAcl::check($object, 'update'), '<h1 class="label">'.render_title(QubitMods::getLabel($object)).'</h1>', array($object, 'module' => 'informationobject', 'action' => 'edit'), array('title' => __('Edit resource metadata'))) ?>

<?php if (0 < count($object->digitalObjects)): ?>
  <?php echo get_component('digitalobject', 'show', array('digitalObject' => $object->digitalObjects[0], 'usageType' => QubitTerm::REFERENCE_ID, 'link' => $digitalObjectLink)) ?>
<?php endif; ?>

<?php echo render_show(__('Identifier'), $object->identifier) ?>

<?php echo render_show(__('Title'), $object->getTitle(array('cultureFallback' => true))) ?>

<?php echo get_partial('informationobject/nameAccessPoints', array('informationObject' => $object)) ?>

<?php echo get_partial('informationobject/dates', array('informationObject' => $object)) ?>

<?php foreach (QubitMods::getTypes($object) as $type): ?>
  <?php echo render_show(__('Type of resource'), $type->term) ?>
<?php endforeach; ?>

<?php foreach ($object->language as $code): ?>
  <?php echo render_show(__('Language'), format_language($code)) ?>
<?php endforeach; ?>

<?php if (0 < count($object->digitalObjects)): ?>
  <?php echo render_show(__('Internet media type'), $object->digitalObjects[0]->mimeType) ?>
<?php endif; ?>

<?php foreach ($object->getSubjectAccessPoints() as $subject): ?>
  <?php echo render_show(__('Subject'), link_to($subject->term, array($subject->term, 'module' => 'term', 'action' => 'browseTerm'))) ?>
<?php endforeach; ?>

<?php echo render_show(__('Access condition'), $object->getAccessConditions(array('cultureFallback' => true))) ?>

<?php if (0 < count($object->digitalObjects)): ?>
  <?php if (QubitTerm::EXTERNAL_URI_ID == $object->digitalObjects[0]->usageId): ?>
    <?php echo render_show(__('URL'), link_to(null, $object->digitalObjects[0]->path)) ?>
  <?php else: ?>
    <?php echo render_show(__('URL'), link_to(null, public_path($object->digitalObjects[0]->getFullPath(), true))) ?>
  <?php endif; ?>
<?php endif; ?>

<div class="field">
  <h3><?php echo __('Physical location') ?></h3>
  <div>
    <?php if (isset($object->repository)): ?>
      <?php if (isset($object->repository->identifier)): ?>
        <?php echo $object->repository->identifier ?> -
      <?php endif; ?>
      <?php echo link_to(render_title($object->repository), array($object->repository, 'module' => 'repository')) ?>
      <?php if (null !== $contactInformation = $object->repository->getPrimaryContact()): ?>
        <?php if (isset($contactInformation->city)): ?>
          <?php echo $contactInformation->city ?>
        <?php endif; ?>
        <?php if (isset($contactInformation->region)): ?>
          <?php echo $contactInformation->region ?>
        <?php endif; ?>
        <?php if (isset($contactInformation->countryCode)): ?>
          <?php echo format_country($contactInformation->countryCode) ?>
        <?php endif; ?>
      <?php endif; ?>
    <?php endif; ?>
  </div>
</div>

<?php if (0 < count($object->digitalObjects)): ?>
  <?php echo get_partial('digitalobject/metadata', array('digitalObject' => $object->digitalObjects[0])) ?>
<?php endif; ?>

<?php echo get_partial('informationobject/actions', array('informationObject' => $object)) ?>
