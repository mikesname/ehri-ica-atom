<?php use_helper('Javascript') ?>

<div id="treeView">
</div>
<?php $treeViewObjects = json_encode($sf_data->getRaw('treeViewObjects')) ?>
<?php $treeViewExpands = json_encode($sf_data->getRaw('treeViewExpands')) ?>
<?php $treeViewUrl = url_for(array('module' => 'informationobject', 'action' => 'treeView'), true) ?>
<?php $treeViewI18nLoading = __('Loading...') ?>
<?php echo javascript_tag(<<<EOF
Qubit.treeView.objects = $treeViewObjects;
Qubit.treeView.expands = $treeViewExpands;
Qubit.treeView.Url = '$treeViewUrl';
Qubit.treeView.draggable = $treeViewDraggable;
Qubit.treeView.i18nLoading = '$treeViewI18nLoading';
EOF
) ?>
