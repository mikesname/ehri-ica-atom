<h1><?php echo __('Browse %1% - %2%', array('%1%' => sfConfig::get('app_ui_label_digitalobject'), '%2%' => $mediaType->getName(array('cultureFallback' => true)))) ?></h1>

<table class="sticky-enabled">
  <tbody>
    <tr>
      <?php foreach ($pager->getResults() as $key => $item): ?>

        <td>

          <?php if ($item->showAsCompoundDigitalObject()): ?>
            <?php echo get_component('digitalobject', 'show', array('resource' => $item->getPage(0), 'usageType' => QubitTerm::THUMBNAIL_ID, 'link' => array($item->informationObject, 'module' => 'informationobject'), 'iconOnly' => true)) ?>
          <?php else: ?>
            <?php echo get_component('digitalobject', 'show', array('resource' => $item, 'usageType' => QubitTerm::THUMBNAIL_ID, 'link' => array($item->informationObject, 'module' => 'informationobject'), 'iconOnly' => true)) ?>
          <?php endif; ?>

          <h2><?php echo link_to(render_title($item->informationObject), array($item->informationObject, 'module' => 'informationobject')) ?><?php if (QubitTerm::PUBLICATION_STATUS_DRAFT_ID == $item->informationObject->getPublicationStatus()->status->id): ?> <span class="publicationStatus"><?php echo $item->informationObject->getPublicationStatus()->status ?></span><?php endif; ?></h2>

          <?php if ($item->informationObject->getCollectionRoot() !== $item->informationObject): ?>
            <?php echo render_show(__('Part of'), link_to(render_title($item->informationObject->getCollectionRoot()), array($item->informationObject->getCollectionRoot(), 'module' => 'informationobject'))) ?>
          <?php endif; ?>

        </td>

        <?php if (3 == $key % 4): ?>
          </tr><tr>
        <?php endif; ?>

      <?php endforeach; ?>
    </tr>
  </tbody>
</table>

<?php echo get_partial('default/pager', array('pager' => $pager)) ?>
