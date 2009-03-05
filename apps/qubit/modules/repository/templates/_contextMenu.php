<div class="context-column-box">
  <div class="contextMenu">
    <div class="label">
      <?php echo __('%1% information', array('%1%' => sfConfig::get('app_ui_label_actor'))) ?>
    </div>
    <?php echo link_to(render_title($repository), 'actor/show?id='.$repository->getId()) ?>
  
    <div class="label">
      <?php echo sfConfig::get('app_ui_label_holdings') ?>
    </div>
    <ul>
      <?php foreach ($repositoryHoldings as $holding): ?>
        <li><?php echo link_to(render_title($holding), 'informationobject/show?id='.$holding->getId()) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>
