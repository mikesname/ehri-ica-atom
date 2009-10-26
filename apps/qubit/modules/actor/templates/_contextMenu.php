<div class="context-column-box">
  <div class="contextMenu">

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
