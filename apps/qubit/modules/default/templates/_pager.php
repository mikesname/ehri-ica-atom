<?php if ($pager->haveToPaginate()): ?>
  <div class="pager">

    <?php if (1 < $pager->getPage()): ?>
      <?php echo link_to('< '.__('previous'), array('page' => $pager->getPage() - 1) + $sf_request->getParameterHolder()->getAll()) ?>
    <?php endif; ?>

    <?php foreach ($pager->getLinks(10) as $page): ?>
      <?php if ($pager->getPage() == $page): ?>
        <strong><?php echo $page ?></strong>
      <?php else: ?>
        <?php echo link_to($page, array('page' => $page) + $sf_request->getParameterHolder()->getAll()) ?>
      <?php endif; ?>
    <?php endforeach ?>

    <?php if ($pager->getLastPage() > $pager->getPage()): ?>
      <?php echo link_to(__('next').' >', array('page' => $pager->getPage() + 1) + $sf_request->getParameterHolder()->getAll()) ?>
    <?php endif; ?>

  </div>
<?php endif; ?>

<div class="result-count">
  <?php if (0 < $pager->getNbResults()): ?>
    <?php echo __('displaying %1% to %2% of %3% results', array('%1%' => $pager->getFirstIndice(), '%2%' => $pager->getLastIndice(), '%3%' => $pager->getNbResults())) ?>
  <?php else: ?>
    <?php echo __('No results found'); ?>
  <?php endif; ?>
</div>
