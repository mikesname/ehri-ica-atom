<div>

  <h3><?php echo sfConfig::get('app_ui_label_holdings') ?></h3>

  <div>

    <div class="search">
      <form action="<?php echo url_for(array($resource, 'module' => 'search')) ?>">
        <input type="text" name="query" value="<?php echo $sf_request->query ?>">
        <input type="submit" value="search" class="form-submit"/>
      </form>
    </div>

    <ul>
      <?php foreach ($holdings as $holding): ?>
        <li><?php echo link_to(render_title($holding), array($holding, 'module' => 'informationobject')) ?><?php if (QubitTerm::PUBLICATION_STATUS_DRAFT_ID == $holding->getPublicationStatus()->status->id): ?> <span class="publicationStatus"><?php echo $holding->getPublicationStatus()->status ?></span><?php endif; ?></li>
      <?php endforeach; ?>
    </ul>

    <?php echo get_partial('default/pager', array('pager' => $pager)) ?>

  </div>

</div>
