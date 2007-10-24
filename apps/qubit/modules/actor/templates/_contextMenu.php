<div class="contextMenu">
<?php if ($informationObjectRelationships): ?>
<?php foreach ($informationObjectRelationships as $relationship): ?>
<div class="label"><?php echo $relationship['actorRole'] ?></div>
<div class="node"><?php echo link_to($relationship['informationObject'], 'informationobject/show?id='.$relationship['informationObjectId']) ?></div>
<?php endforeach; ?>
<?php endif; ?>
</div>