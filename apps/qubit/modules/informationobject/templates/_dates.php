<?php foreach ($resource->getDates() as $item): ?>
  <div class="field">
    <h3><?php echo __('Date') ?></h3>
    <div>

      <?php echo Qubit::renderDateStartEnd($item->getDate(array('cultureFallback' => true)), $item->startDate, $item->endDate) ?>

      <div class="note2" style="margin-left: 1.5em;">
        <?php echo __('Type') ?>: <?php echo $item->type ?>
      </div>

      <?php if (isset($item->actor) && null !== $item->type->getRole()): ?>
        <div class="note2" style="margin-left: 1.5em;">
          <?php echo $item->type->getRole() ?>: <?php echo render_title($item->actor) ?>
        </div>
      <?php endif; ?>

      <?php if (null !== $item->getPlace()): ?>
        <div class="note2" style="margin-left: 1.5em;">
          <?php echo __('Place') ?>: <?php echo $item->getPlace() ?>
        </div>
      <?php endif; ?>

      <?php if (0 < strlen($item->description)): ?>
        <div class="note2" style="margin-left: 1.5em;">
          <?php echo __('Note') ?>: <?php echo $item->description ?>
        </div>
      <?php endif; ?>

    </div>
  </div>
<?php endforeach; ?>
