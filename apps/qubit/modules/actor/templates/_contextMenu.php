<div class="contextMenu">
<?php if ($repository): ?>
  <div class="label"><?php echo sfConfig::get('app_ui_label_repository').' record' ?></div>
  <?php echo link_to($repository, 'repository/show?id='.$repository->getId()) ?>
<?php endif; ?>

<?php if ($informationObjectRelations): ?>
<?php foreach ($informationObjectRelations as $relation): ?>
<div class="label"><?php echo $relation->getActorRole() ?></div>
<div class="node"><?php echo link_to($relation->getInformationObject(), 'informationobject/show?id='.$relation->getInformationObjectId()) ?></div>
<?php endforeach; ?>
<?php endif; ?>
</div>
