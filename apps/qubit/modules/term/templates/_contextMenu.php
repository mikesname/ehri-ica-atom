<div>
  <h3><?php echo __('Taxonomy hierarchy') ?></h3>
  <div>
    <?php echo get_component('term', 'treeView') ?>
  </div>
</div>

<?php echo get_partial('term/format', array('resource' => $resource)) ?>
