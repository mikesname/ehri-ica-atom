<?php use_helper('Text') ?>

<?php if ($sf_request->query): ?>
  <h1><?php echo __('Search for "%1%"', array('%1%' => $sf_request->query)) ?></h1>
<?php endif; ?>

<?php if (isset($error)): ?>
  <div class="search-results">
    <ul>
      <li><?php echo $error ?></li>
    </ul>
  </div>
<?php else: ?>

<div class="section">
  <?php foreach ($informationObjects as $informationObject): ?>
    <div class="clearfix search-results <?php echo 0 == ++$row % 2 ? 'even' : 'odd' ?>">

      <?php if (isset($informationObject->digitalObjects[0])): ?>
        <?php if (QubitTerm::AUDIO_ID == $informationObject->digitalObjects[0]->mediaTypeId): ?>
          <?php echo link_to(image_tag("play.png", array('alt' => render_title($informationObject))), array($informationObject, 'module' => 'informationobject')) ?>
        <?php else: ?>
          <?php echo link_to(image_tag(public_path($informationObject->digitalObjects[0]->thumbnail->getFullPath()), array('alt' => render_title($informationObject))), array($informationObject, 'module' => 'informationobject')) ?>
        <?php endif;?>
      <?php endif; ?>

      <h2><?php echo link_to(render_title($informationObject), array($informationObject, 'module' => 'informationobject')) ?><?php if (QubitTerm::PUBLICATION_STATUS_DRAFT_ID == $informationObject->getPublicationStatus()->status->id): ?> <span class="publicationStatus"><?php echo $informationObject->getPublicationStatus()->status ?></span><?php endif; ?></h2>

      <div>
        <?php echo highlight_text(truncate_text($informationObject->scopeAndContent, 256), $sf_request->query) ?>
      </div>

      <?php echo render_show(__('Reference code'), render_value(QubitIsad::getReferenceCode($informationObject))) ?>

      <div class="field">
        <h3><?php echo __('Date(s)') ?></h3>
        <div>
          <ul>
            <?php foreach ($informationObject->getDates() as $date): ?>
              <li>
                <?php echo date_display($date) ?> (<?php echo $date->getType(array('cultureFallback' => true)) ?>)
                <?php if (isset($date->actor)): ?>
                  <?php echo link_to(render_title($date->actor), array($date->actor, 'module' => 'actor')) ?>
                <?php endif; ?>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>

      <?php echo render_show(__('Level of description'), render_value($informationObject->levelOfDescription)) ?>

      <?php if (sfConfig::get('app_multi_repository') && isset($informationObject->repository)): ?>
        <?php echo render_show(__('Repository'), link_to(render_title($informationObject->repository), array($informationObject->repository, 'module' => 'repository'))) ?>
      <?php endif; ?>

      <?php if ($informationObject->getCollectionRoot() !== $informationObject): ?>
        <?php echo render_show(__('Part of'), link_to(render_title($informationObject->getCollectionRoot()), array($informationObject->getCollectionRoot(), 'module' => 'informationobject'))) ?>
      <?php endif; ?>

    </div>
  <?php endforeach; ?>
</div>

<?php echo get_partial('default/pager', array('pager' => $pager)) ?>

<?php endif; ?>
