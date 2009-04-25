<div class="context-column-box">
  <div class="contextMenu">
    <div class="label">
      <?php echo __('%1% information', array('%1%' => sfConfig::get('app_ui_label_actor'))) ?>
    </div>
    <?php echo link_to(render_title($repository->getAuthorizedFormOfName(array('cultureFallback' => true))), 'actor/show?id='.$repository->getId()) ?>
    
    <!-- Only display holdings on "show" templates to avoid form submit issues
         with using pager -->
    <?php if (substr($currentAction, 0, 4) == 'show' && count($holdings)): ?>
    <div class="label">
      <?php echo sfConfig::get('app_ui_label_holdings') ?>
    </div>
    <div class="holdings">
    <ul>
      <?php foreach ($holdings as $holding): ?>
        <li><?php echo link_to(render_title($holding), 'informationobject/show?id='.$holding->getId()) ?></li>
      <?php endforeach; ?>
    </ul>
    </div>
    
    <?php if ($pager->haveToPaginate()): ?>
    <div class="pager">
      <?php $links = $pager->getLinks(); ?>
      <?php if ($pager->getPage() != $pager->getFirstPage()): ?>
     <?php echo link_to('< '.__('previous'), 'repository/show?id='.$repository->getId().'&holdingsPage='.($pager->getPage()-1)) ?>
      <?php endif; ?>
      <?php foreach ($links as $page): ?>
        <?php echo ($page == $pager->getPage()) ? '<strong>'.$page.'</strong>' : link_to($page, 'repository/show?id='.$repository->getId().'&holdingsPage='.$page) ?>
      <?php endforeach ?>
      <?php if ($pager->getPage() != $pager->getLastPage()): ?>
     <?php echo link_to(__('next').' >', 'repository/show?id='.$repository->getId().'&holdingsPage='.($pager->getPage()+1)) ?>
      <?php endif; ?>
    </div>
    <?php endif; ?>
    <?php endif; // Only display holdings for show template ?>
  </div>
</div>
