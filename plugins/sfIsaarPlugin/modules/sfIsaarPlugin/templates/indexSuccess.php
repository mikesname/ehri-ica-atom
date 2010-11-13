<h1><?php echo __('View authority record') ?></h1>

<?php echo link_to_if(QubitAcl::check($resource, 'update'), '<h1 class="label">'.render_title($resource).'</h1>', array($resource, 'module' => 'actor', 'action' => 'edit'), array('title' => __('Edit authority record'))) ?>

<?php if (isset($errorSchema)): ?>
  <div class="messages error">
    <ul>
      <?php foreach ($errorSchema as $error): ?>
        <li><?php echo $error ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>

<?php echo render_show(__('Type of entity'), render_value($resource->entityType)) ?>

<?php echo render_show(__('Authorized form of name'), render_value($resource->getAuthorizedFormOfName(array('cultureFallback' => true)))) ?>

<div class="field">
  <h3><?php echo __('Parallel form(s) of name') ?></h3>
  <div>
    <ul>
      <?php foreach ($resource->getOtherNames(array('typeId' => QubitTerm::PARALLEL_FORM_OF_NAME_ID)) as $item): ?>
        <li><?php echo render_value($item->__toString()) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>

<div class="field">
  <h3><?php echo __('Standardized form(s) of name according to other rules') ?></h3>
  <div>
    <ul>
      <?php foreach ($resource->getOtherNames(array('typeId' => QubitTerm::STANDARDIZED_FORM_OF_NAME_ID)) as $item): ?>
        <li><?php echo render_value($item->__toString()) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>

<div class="field">
  <h3><?php echo __('Other form(s) of name') ?></h3>
  <div>
    <ul>
      <?php foreach ($resource->getOtherNames(array('typeId' => QubitTerm::OTHER_FORM_OF_NAME_ID)) as $item): ?>
        <li><?php echo render_value($item->__toString()) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>

<?php echo render_show(__('Identifiers for corporate bodies'), render_value($resource->corporateBodyIdentifiers)) ?>

<?php echo render_show(__('Dates of existence'), render_value($resource->getDatesOfExistence(array('cultureFallback' => true)))) ?>

<?php echo render_show(__('History'), render_value($resource->getHistory(array('cultureFallback' => true)))) ?>

<?php echo render_show(__('Places'), render_value($resource->getPlaces(array('cultureFallback' => true)))) ?>

<?php echo render_show(__('Legal status'), render_value($resource->getLegalStatus(array('cultureFallback' => true)))) ?>

<?php echo render_show(__('Functions, occupations and activities'), render_value($resource->getFunctions(array('cultureFallback' => true)))) ?>

<?php echo render_show(__('Mandates/sources of authority'), render_value($resource->getMandates(array('cultureFallback' => true)))) ?>

<?php echo render_show(__('Internal structures/genealogy'), render_value($resource->getInternalStructures(array('cultureFallback' => true)))) ?>

<?php echo render_show(__('General context'), render_value($resource->getGeneralContext(array('cultureFallback' => true)))) ?>

<?php foreach ($resource->getActorRelations() as $item): ?>
  <?php $relatedActor = $item->getOpposedObject($resource->id) ?>
  <div class="field">
    <h3><?php echo __('Related entity') ?></h3>
    <div>
      <?php echo link_to(render_title($relatedActor), array($relatedActor, 'module' => 'actor')) ?><?php if (isset($relatedActor->datesOfExistence)): ?> <span class="note2">(<?php echo render_value($relatedActor->getDatesOfExistence(array('cultureFallback' => true))) ?>)</span><?php endif; ?>

      <?php echo render_show(__('Identifier of the related entity'), render_value($relatedActor->descriptionIdentifier)) ?>

      <?php echo render_show(__('Category of the relationship'), render_value($item->type)) ?>

      <?php echo render_show(__('Dates of the relationship'), Qubit::renderDateStartEnd($item->getNoteByTypeId(QubitTerm::RELATION_NOTE_DATE_ID), $item->startDate, $item->endDate)) ?>

      <?php echo render_show(__('Description of relationship'), render_value($item->getNoteByTypeId(QubitTerm::RELATION_NOTE_DESCRIPTION_ID))) ?>

    </div>
  </div>
<?php endforeach; ?>

<?php foreach ($functions as $item): ?>
  <?php echo render_show(__('Related function'), link_to(render_title($item), array($item, 'module' => 'function'))) ?>
<?php endforeach; ?>

<?php echo render_show(__('Description identifier'), render_value($resource->descriptionIdentifier)) ?>

<?php echo render_show(__('Institution identifier'), render_value($resource->getInstitutionResponsibleIdentifier(array('cultureFallback' => true)))) ?>

<?php echo render_show(__('Rules and/or conventions used'), render_value($resource->getRules(array('cultureFallback' => true)))) ?>

<?php echo render_show(__('Status'), render_value($resource->descriptionStatus)) ?>

<?php echo render_show(__('Level of detail'), render_value($resource->descriptionDetail)) ?>

<?php echo render_show(__('Dates of creation, revision and deletion'), render_value($resource->getRevisionHistory(array('cultureFallback' => true)))) ?>

<div class="field">
  <h3><?php echo __('Language(s)') ?></h3>
  <div>
    <ul>
      <?php foreach ($resource->language as $code): ?>
        <li><?php echo format_language($code) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>

<div class="field">
  <h3><?php echo __('Script(s)') ?></h3>
  <div>
    <ul>
      <?php foreach ($resource->script as $code): ?>
        <li><?php echo format_script($code) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>

<?php echo render_show(__('Sources'), render_value($resource->getSources(array('cultureFallback' => true)))) ?>

<?php echo render_show(__('Maintenance notes'), render_value($isaar->maintenanceNotes)) ?>

<?php if (QubitAcl::check($resource, 'create') || QubitAcl::check($resource, 'delete') || QubitAcl::check($resource, 'update')): ?>
  <div class="actions section">

    <h2 class="element-invisible"><?php echo __('Actions') ?></h2>

    <div class="content">
      <ul class="clearfix links">

        <?php if (QubitAcl::check($resource, 'update')): ?>
          <li><?php echo link_to(__('Edit'), array($resource, 'module' => 'actor', 'action' => 'edit'), array('title' => __('Edit'))) ?></li>
        <?php endif; ?>

        <?php if (QubitAcl::check($resource, 'delete')): ?>
          <li><?php echo link_to(__('Delete'), array($resource, 'module' => 'actor', 'action' => 'delete'), array('title' => __('Delete'))) ?></li>
        <?php endif; ?>

        <?php if (QubitAcl::check($resource, 'create')): ?>
          <li><?php echo link_to(__('Add new'), array('module' => 'actor', 'action' => 'add'), array('title' => __('Add new'))) ?></li>
        <?php endif; ?>

      </ul>
    </div>

  </div>
<?php endif; ?>
