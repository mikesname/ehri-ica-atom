<div class="field">
  <h3><?php echo __('Name access points') ?></h3>
  <div>
    <ul>
      <?php foreach ($informationObject->getActorEvents() as $event): ?>
        <?php if (isset($event->actor)): ?>
          <li><?php echo link_to(render_title($event->actor), array($event->actor, 'module' => 'actor')) ?> <span class="note2">(<?php echo $event->type->getRole() ?>)</span></li>
        <?php endif; ?>
      <?php endforeach; ?>
      <?php foreach ($informationObject->relationsRelatedBysubjectId as $relation): ?>
        <?php if (QubitTerm::NAME_ACCESS_POINT_ID == $relation->type->id): ?>
          <li><?php echo link_to(render_title($relation->object), array($relation->object, 'module' => 'actor')) ?></li>
        <?php endif; ?>
      <?php endforeach; ?>
    </ul>
  </div>
</div>
