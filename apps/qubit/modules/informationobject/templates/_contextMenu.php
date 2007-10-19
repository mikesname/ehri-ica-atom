<div class="context-column-box">
<div class="contextMenu">
<?php if ($repositoryLink): ?>
<div class="label">Repository</div>
<?php echo link_to($repositoryLink['repositoryName'], 'repository/show?id='.$repositoryLink['repositoryId']) ?>
<?php endif; ?>

<?php if ($creators): ?>
<div class="label">Creator</div>
<?php foreach($creators as $creator): ?>
  <?php echo link_to($creator->getAuthorizedFormOfName(), 'actor/show?id='.$creator->getId()) ?><br />
<?php endforeach; ?>
<?php endif; ?>

<?php if ($informationObject->getTreeId()): ?>
<div class="label">Collection</div>
<?php foreach ($collection as $node): ?>
  <?php echo $node ?>
<?php endforeach; ?>
<?php endif; ?>
</div>
</div>
