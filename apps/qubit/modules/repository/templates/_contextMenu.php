<div>

  <h3><?php echo sfConfig::get('app_ui_label_holdings') ?></h3>
  <div>
    <ul>
      <?php foreach ($holdings as $holding): ?>
        <li><?php echo link_to(render_title($holding), array($holding, 'module' => 'informationobject')) ?><?php if (QubitTerm::PUBLICATION_STATUS_DRAFT_ID == $holding->getPublicationStatus()->status->id): ?> <span class="publicationStatus"><?php echo $holding->getPublicationStatus()->status ?></span><?php endif; ?></li>
      <?php endforeach; ?>
    </ul>
  </div>

  <?php echo get_partial('default/pager', array('pager' => $pager)) ?>

</div>
