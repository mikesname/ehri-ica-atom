<?php use_helper('Javascript') ?>

<div id="treeView"></div>

<?php

$treeViewObjects = json_encode($treeViewObjects);
$treeViewExpands = json_encode($treeViewExpands);
$treeViewI18nLoading = __('Loading...');

echo javascript_tag(<<<content
Qubit.treeView.objects = $treeViewObjects;
Qubit.treeView.expands = $treeViewExpands;
Qubit.treeView.draggable = $treeViewDraggable;
Qubit.treeView.i18nLoading = '$treeViewI18nLoading';

content
);
