<div class="context-column-box">
<div class="contextMenu">
<?php if ($repositoryLink): ?>
<div class="label"><?php echo sfConfig::get('app_ui_label_repository') ?></div>
<?php echo link_to($repositoryLink['repositoryName'], 'repository/show?id='.$repositoryLink['repositoryId']) ?>
<?php endif; ?>

<?php if ($creators): ?>
<div class="label"><?php echo sfConfig::get('app_ui_label_creator') ?></div>
<?php foreach($creators as $creator): ?>
  <?php echo link_to($creator->getAuthorizedFormOfName(), 'actor/show?id='.$creator->getId()) ?><br />
<?php endforeach; ?>
<?php endif; ?>

<?php if ($informationObject->getTreeId()): ?>
<div class="label"><?php echo sfConfig::get('app_ui_label_collection') ?></div>
<?php foreach ($collection as $node): ?>
  <?php echo $node ?>
<?php endforeach; ?>
<?php endif; ?>
</div>
</div>
