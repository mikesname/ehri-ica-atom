<h1><?php echo __('View resource metadata') ?></h1>

<?php echo link_to_if(QubitAcl::check($object, 'update'), '<h1 class="label">'.render_title(QubitDc::getLabel($object)).'</h1>', array($object, 'module' => 'informationobject', 'action' => 'edit'), array('title' => __('Edit resource metadata'))) ?>

<?php if (isset($errorSchema)): ?>
  <div class="messages error">
    <ul>
      <?php foreach ($errorSchema as $error): ?>
        <li><?php echo $error ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>

<?php if (0 < count($object->digitalObjects)): ?>
  <?php echo get_component('digitalobject', 'show', array('digitalObject' => $object->digitalObjects[0], 'usageType' => QubitTerm::REFERENCE_ID, 'link' => $digitalObjectLink)) ?>
<?php endif; ?>

<?php echo render_show(__('Identifier'), $object->identifier) ?>

<?php echo render_show(__('Title'), $object->getTitle(array('cultureFallback' => true))) ?>

<?php  foreach ($object->getCreators() as $creator): ?>
  <div class="field">
    <h3><?php echo __('Creator') ?></h3>
    <div>
      <?php echo link_to(render_title($creator), array($creator, 'module' => 'actor')) ?><?php if ($existence = $creator->getDatesOfExistence(array('cultureFallback' => true))): ?> <span class="note2">(<?php echo $existence ?>)</span><?php endif; ?>
    </div>
  </div>
<?php endforeach; ?>

<?php  foreach ($object->getPublishers() as $publisher): ?>
  <div class="field">
    <h3><?php echo __('Publisher') ?></h3>
    <div>
      <?php echo link_to(render_title($publisher), array($publisher, 'module' => 'actor')) ?><?php if ($existence = $publisher->getDatesOfExistence(array('cultureFallback' => true))): ?> <span class="note2">(<?php echo $existence ?>)</span><?php endif; ?>
    </div>
  </div>
<?php endforeach; ?>

<?php  foreach ($object->getContributors() as $contributor): ?>
  <div class="field">
    <h3><?php echo __('Contributor') ?></h3>
    <div>
      <?php echo link_to(render_title($contributor), array($contributor, 'module' => 'actor')) ?><?php if ($existence = $contributor->getDatesOfExistence(array('cultureFallback' => true))): ?> <span class="note2">(<?php echo $existence ?>)</span><?php endif; ?>
    </div>
  </div>
<?php endforeach; ?>

<?php echo get_partial('informationobject/dates', array('informationObject' => $object)) ?>

<?php foreach ($object->getSubjectAccessPoints() as $subject): ?>
  <?php echo render_show(__('Subject'), link_to($subject->term, array($subject->term, 'module' => 'term', 'action' => 'browseTerm'))) ?>
<?php endforeach; ?>

<?php echo render_show(__('Description'), $object->getScopeAndContent(array('cultureFallback' => true))) ?>

<?php foreach (QubitDc::getTypes($object) as $type): ?>
  <?php echo render_show(__('Type'), $type) ?>
<?php endforeach; ?>

<?php foreach (QubitDc::getFormats($object) as $format): ?>
  <?php echo render_show(__('Format'), $format) ?>
<?php endforeach; ?>

<?php echo render_show(__('Source'), $object->getLocationOfOriginals(array('cultureFallback' => true))) ?>

<?php foreach ($object->language as $code): ?>
  <?php echo render_show(__('Language'), format_language($code)) ?>
<?php endforeach; ?>

<?php if($repositoryId): ?>
  <?php echo render_show(__('Relation (isLocatedAt)'), link_to($repository, array('module' => 'repository', 'id' => $repositoryId))) ?>
<?php endif; ?>

<?php foreach (QubitDc::getCoverage($object, array('spatial' => true)) as $coverageSpatial): ?>
  <?php echo render_show(__('Coverage (spatial)'), link_to($coverageSpatial->name, array($coverageSpatial, 'module' => 'term', 'action' => 'browseTerm'))) ?>
<?php endforeach; ?>

<?php echo render_show(__('Rights'), $object->getAccessConditions(array('cultureFallback' => true))) ?>

<?php if (0 < count($object->digitalObjects)): ?>
  <?php echo get_partial('digitalobject/metadata', array('digitalObject' => $object->digitalObjects[0])) ?>
<?php endif; ?>

<?php echo get_partial('informationobject/actions', array('informationObject' => $object)) ?>
