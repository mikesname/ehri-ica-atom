<?php if (sfConfig::get('app_multi_repository')): ?>
  <?php echo render_show_repository(sfConfig::get('app_ui_label_repository'), $resource) ?>
<?php endif; ?>

<?php echo get_component('informationobject', 'creator', array('resource' => $resource)) ?>

<?php echo get_component('digitalobject', 'imageflow', array('resource' => $resource)) ?>

<div>
  <h3>
    <?php if (isset($resource->getCollectionRoot()->levelOfDescription)): ?>
      <?php echo $resource->getCollectionRoot()->levelOfDescription ?>
    <?php else: ?>
      <?php echo sfConfig::get('app_ui_label_collection') ?>
    <?php endif; ?>
  </h3>
  <div>
    <?php echo get_component('informationobject', 'treeView') ?>
  </div>
</div>

<?php echo get_partial('informationobject/format', array('resource' => $resource)) ?>

<?php echo get_component('physicalobject', 'contextMenu', array('resource' => $resource)) ?>
