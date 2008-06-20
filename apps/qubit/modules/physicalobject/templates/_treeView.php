<?php use_helper('Javascript') ?>

<div class="label">
  <?php echo sfConfig::get('app_ui_label_physicalobject'); ?>
</div>

<div id="treeViewPo">
</div>
<?php $treeViewObjects = json_encode($sf_data->getRaw('treeViewObjects')); ?>
<?php $treeViewExpands = json_encode($sf_data->getRaw('treeViewExpands')); ?>
<?php echo javascript_tag(<<<EOF
Qubit.treeViewPo.objects = $treeViewObjects;
Qubit.treeViewPo.expands = $treeViewExpands;
EOF
); ?>