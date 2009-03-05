<div class="context-column-box">
  <div class="contextMenu">
  <?php if ($repository): ?>
    <div class="label">
      <?php echo __('%1% information', array('%1%' => sfConfig::get('app_ui_label_repository'))) ?>
    </div>
    <?php echo link_to(render_title($repository), 'repository/show?id='.$repository->getId()) ?>
  <?php endif; ?>

  <?php if ($relatedInfoObjects): ?>
    <?php foreach ($relatedInfoObjects as $role => $relations): ?>
      <div class="label">
        <?php echo __('%1% of', array('%1%' => $role)) ?>
      </div>
      <ul>
      <?php foreach($relations as $relation): ?>
        <li><?php echo link_to(render_title($relation->getInformationObject()), 'informationobject/show?id='.$relation->getInformationObjectId()) ?></li>
      <?php endforeach;  ?>
      </ul>
    <?php endforeach; ?>
  <?php endif; ?>
  </div>
</div>