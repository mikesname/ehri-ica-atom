<div>

  <h3><?php echo sfConfig::get('app_ui_label_holdings') ?></h3>
  <div>
    <ul>
      <?php foreach ($holdings as $holding): ?>
        <li><?php echo link_to(render_title($holding), array($holding, 'module' => 'informationobject')) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>

  <?php if ($pager->haveToPaginate()): ?>
    <div class="pager">

      <?php if (1 < $pager->getPage()): ?>
        <?php echo link_to('< '.__('Previous'), array('holdingsPage' => $pager->getPage()-1) + $sf_request->getParameterHolder()->getAll()) ?>
      <?php endif; ?>

      <?php foreach ($pager->getLinks(5) as $page): ?>
        <?php if ($pager->getPage() == $page): ?>
          <strong><?php echo $page ?></strong>
        <?php else: ?>
          <?php echo link_to($page, array('holdingsPage' => $page) + $sf_request->getParameterHolder()->getAll()) ?>
        <?php endif; ?>
      <?php endforeach ?>

      <?php if ($pager->getLastPage() > $pager->getPage()): ?>
        <?php echo link_to(__('Next').' >', array('holdingsPage' => $pager->getPage()+1) + $sf_request->getParameterHolder()->getAll()) ?>
      <?php endif; ?>

    </div>
  <?php endif; ?>

</div>
