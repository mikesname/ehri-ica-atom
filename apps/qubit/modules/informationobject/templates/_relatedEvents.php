<table id="relatedEvents" class="inline">
<?php if (0 < count($informationObject->events)): ?>
  <tr>
    <th style="width: 35%">
      <?php echo __('Name') ?>
    </th><th style="width: 25%">
      <?php echo __('Role/event') ?>
    </th><th style="width: 30%">
      <?php echo __('Date(s)') ?>
    </th><th style="width: 10%">
      &nbsp;
    </th>
  </tr>
  <?php foreach ($informationObject->events as $event): ?>
    <tr class="<?php echo 'related_obj_'.$event->id ?>" id="<?php echo url_for(array($event, 'module' => 'event')) ?>">
      <td>
        <div>
          <?php if (isset($event->actor)): ?>
            <?php echo render_title($event->actor) ?>
          <?php endif; ?>
        </div>
      </td><td>
        <div>
          <?php if (isset($event->actor)): ?>
            <?php echo $event->type->getRole() ?>
          <?php else: ?>
            <?php echo $event->type ?>
          <?php endif; ?>
        </div>
      </td><td>
        <div>
          <?php echo date_display($event) ?>
        </div>
      </td><td style="text-align: right">
        <input type="checkbox" name="deleteEvents[<?php echo $event->id ?>]" value="delete" class="multiDelete"/>
      </td>
    </tr>
  <?php endforeach; ?>
<?php endif; ?>
</table>
