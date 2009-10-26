<?php use_helper('Text') ?>

<?php if ($sf_request->query): ?>
  <h1 class="search"><?php echo __('Search for "%1%" returned %2% results', array('%1%' => $sf_request->query, '%2%' => $pager->getNbResults())) ?></h1>
<?php endif; ?>

<?php foreach ($informationObjects as $informationObject): ?>
  <div class="search-results" style="padding-top: 5px;">

    <h3><?php echo link_to(render_title($informationObject), array('module' => 'informationobject', 'action' => 'show', 'id' => $informationObject->id)) ?>
        <?php $status = $informationObject->getPublicationStatus() ?>
        <?php if ($status->statusId == QubitTerm::PUBLICATION_STATUS_DRAFT_ID): ?><span class="note2"><?php echo ' ('.$status->status.')' ?></span><?php endif; ?></h3>

    <div class="CRUD_summary">

      <div>
        <?php echo highlight_text(truncate_text($informationObject->scopeAndContent, 250), $sf_request->query) ?>
      </div>

      <?php if ($informationObject->getCollectionRoot()->id != $informationObject->id): ?>
        <div>
          <?php echo __('Part of') ?>: <?php echo link_to(render_title($informationObject->getCollectionRoot()), array('module' => 'informationobject', 'action' => 'show', 'id' => $informationObject->getCollectionRoot()->id)) ?>
        </div>
      <?php endif; ?>

      <?php if (sfConfig::get('app_multi_repository') && isset($informationObject->repository)): ?>
        <div>
          <?php echo __('Repository') ?>: <?php echo link_to(render_title($informationObject->repository), array('module' => 'repository', 'action' => 'show', 'id' => $informationObject->repository->id)) ?>
        </div>
      <?php endif; ?>

    </div>

  </div>
<?php endforeach; ?>

<?php echo get_partial('default/pager', array('pager' => $pager)) ?>
