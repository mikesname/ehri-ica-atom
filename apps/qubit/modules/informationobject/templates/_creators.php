<?php foreach ($informationObject->getCreators() as $creator): ?>
  <div class="field">
    <h3><?php echo __('Name of creator') ?></h3>
    <div>
      <?php echo link_to(render_title($creator), array($creator, 'module' => 'actor')) ?><?php if (0 < strlen($existence = $creator->getDatesOfExistence(array('cultureFallback' => true)))): ?> (<?php echo $existence ?>)<?php endif; ?>
      <?php if (0 < strlen($history = $creator->getHistory(array('cultureFallback' => true)))): ?>
        <div>
          <h3>
            <?php if (QubitTerm::CORPORATE_BODY_ID == $creator->entityType->id): ?>
              <?php echo __('Administrative history') ?>
            <?php else: ?>
              <?php echo __('Biographical history') ?>
            <?php endif; ?>
          </h3><div>
            <?php echo $history ?>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
<?php endforeach; ?>
