<?php foreach ($relatedInfoObjects as $role => $relations): ?>
  <div>
    <h3><?php echo __('%1% of', array('%1%' => $role)) ?></h3>
    <div>
      <ul>
        <?php foreach ($relations as $relation): ?>
          <li><?php echo link_to(render_title($relation->informationObject), array($relation->informationObject, 'module' => 'informationobject')) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
<?php endforeach; ?>
