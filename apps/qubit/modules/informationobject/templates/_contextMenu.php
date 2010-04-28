<?php if (isset($repository)): ?>
  <?php echo render_show(sfConfig::get('app_ui_label_repository'), link_to(render_title($repository), array($repository, 'module' => 'repository'), $sf_data->getRaw('repositoryOptions'))) ?>
<?php endif; ?>

<div class="field">
  <h3><?php echo sfConfig::get('app_ui_label_creator') ?></h3>
  <div>
    <ul>
      <?php foreach ($creators as $creator): ?>
        <li><?php echo link_to(render_title($creator), array($creator, 'module' => 'actor'), $sf_data->getRaw('creatorOptions')) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>

<?php echo get_component('digitalobject', 'imageflow', array('informationObject' => $informationObject)) ?>

<div>
  <h3>
    <?php if (isset($informationObject->getCollectionRoot()->levelOfDescription)): ?>
      <?php echo $informationObject->getCollectionRoot()->levelOfDescription ?>
    <?php else: ?>
      <?php echo sfConfig::get('app_ui_label_collection') ?>
    <?php endif; ?>
  </h3>
  <div>
    <?php echo get_component('informationobject', 'treeView') ?>
  </div>
</div>

<?php echo get_partial('informationobject/format', array('informationObject' => $informationObject)) ?>

<?php echo get_component('physicalobject', 'contextMenu', array('informationObject' => $informationObject)) ?>
