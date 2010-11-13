<?php use_helper('Text') ?>

<?php if ($sf_request->query): ?>
  <h1><?php echo __('Search for [%1%]', array('%1%' => htmlentities($sf_request->query))) ?></h1>
<?php endif; ?>

<?php if (isset($error)): ?>

  <div class="search-results">
    <ul>
      <li><?php echo $error ?></li>
    </ul>
  </div>

<?php else: ?>

  <div class="section">
    <?php foreach ($informationObjects as $item): ?>
      <div class="clearfix search-results <?php echo 0 == ++$row % 2 ? 'even' : 'odd' ?>">

        <?php if (isset($item->digitalObjects[0])): ?>
          <?php if (!isset($item->digitalObjects[0]->mediaTypeId)): ?>
            <?php echo link_to(image_tag(QubitDigitalObject::getGenericRepresentation($item->digitalObjects[0]->mediaTypeId, QubitTerm::THUMBNAIL_ID)->getFullPath(), array('alt' => render_title($item))), array($item, 'module' => 'informationobject')) ?>
          <?php elseif (QubitTerm::AUDIO_ID == $item->digitalObjects[0]->mediaTypeId): ?>
            <?php echo link_to(image_tag("play.png", array('alt' => render_title($item))), array($item, 'module' => 'informationobject')) ?>
          <?php elseif (null !== $item->digitalObjects[0]->thumbnail): ?>
            <?php echo link_to(image_tag(public_path($item->digitalObjects[0]->thumbnail->getFullPath()), array('alt' => render_title($item))), array($item, 'module' => 'informationobject')) ?>
          <?php endif;?>
        <?php endif; ?>

        <h2><?php echo link_to(render_title($item), array($item, 'module' => 'informationobject')) ?><?php if (QubitTerm::PUBLICATION_STATUS_DRAFT_ID == $item->getPublicationStatus()->status->id): ?> <span class="publicationStatus"><?php echo $item->getPublicationStatus()->status ?></span><?php endif; ?></h2>

        <div>
          <?php echo highlight_text(truncate_text($item->scopeAndContent, 256), $sf_request->query) ?>
        </div>

        <?php $isad = new sfIsadPlugin($item); echo render_show(__('Reference code'), render_value($isad->referenceCode)) ?>

        <div class="field">
          <h3><?php echo __('Date(s)') ?></h3>
          <div>
            <ul>
              <?php foreach ($item->getDates() as $date): ?>
                <li>

                  <?php echo Qubit::renderDateStartEnd($date->getDate(array('cultureFallback' => true)), $date->startDate, $date->endDate) ?> (<?php echo $date->getType(array('cultureFallback' => true)) ?>)

                  <?php if (isset($date->actor)): ?>
                    <?php echo link_to(render_title($date->actor), array($date->actor, 'module' => 'actor')) ?>
                  <?php endif; ?>

                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>

        <?php echo render_show(__('Level of description'), render_value($item->levelOfDescription)) ?>

        <?php if (sfConfig::get('app_multi_repository') && isset($item->repository)): ?>
          <?php echo render_show(__('Repository'), link_to(render_title($item->repository), array($item->repository, 'module' => 'repository'))) ?>
        <?php endif; ?>

        <?php if ($item->getCollectionRoot() !== $item): ?>
          <?php echo render_show(__('Part of'), link_to(render_title($item->getCollectionRoot()), array($item->getCollectionRoot(), 'module' => 'informationobject'))) ?>
        <?php endif; ?>

      </div>
    <?php endforeach; ?>
  </div>

  <?php echo get_partial('default/pager', array('pager' => $pager)) ?>

<?php endif; ?>
