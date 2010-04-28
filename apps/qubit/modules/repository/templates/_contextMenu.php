<div>

  <h3><?php echo sfConfig::get('app_ui_label_holdings') ?></h3>
  <div>
    <ul>
      <?php foreach ($holdings as $holding): ?>
        <li><?php echo link_to(render_title($holding), array($holding, 'module' => 'informationobject')) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>

  <?php echo get_partial('default/pager', array('pager' => $pager)) ?>

</div>
