<?php use_helper('Javascript') ?>

<div id="treeView">
</div>
<?php $treeViewObjects = json_encode($sf_data->getRaw('treeViewObjects')) ?>
<?php $treeViewExpands = json_encode($sf_data->getRaw('treeViewExpands')) ?>
<?php echo javascript_tag(<<<EOF
Qubit.treeView.objects = $treeViewObjects;
Qubit.treeView.expands = $treeViewExpands;
EOF
) ?>
