<?php foreach ($informationObject->getDates() as $date): ?>
  <div class="field">
    <h3><?php echo __('Date') ?></h3>
    <div>
      <?php echo date_display($date) ?>
          <div style="margin-left: 1.5em;"><span class="note2"><?php echo __('Type') ?>: <?php echo $date->type ?></span></div>
          <?php if (isset($date->actor) && null !== $date->type->getRole()): ?>
          <div style="margin-left: 1.5em;"><span class="note2"><?php echo $date->type->getRole() ?>: <?php echo render_title($date->actor) ?></span></div>
          <?php endif; ?>
          <?php if (null !== $date->getPlace()): ?>
          <div style="margin-left: 1.5em;"><span class="note2"><?php echo __('Place') ?>: <?php echo $date->getPlace() ?></span></div>
          <?php endif; ?>
          <?php if (0 !== strlen($date->description)): ?>
          <div style="margin-left: 1.5em;"><span class="note2"><?php echo __('Note') ?>: <?php echo $date->description ?></span></div>
          <?php endif; ?>
        </ul>
    </div>
  </div>
<?php endforeach; ?>
