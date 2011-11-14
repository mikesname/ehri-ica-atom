<?php $sf_response->addJavaScript('multiDelete') ?>

<table id="relatedEvents">
  <thead>
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
  </thead><tbody>
    <?php foreach ($resource->events as $item): ?>
      <tr class="<?php echo 0 == @++$row % 2 ? 'even' : 'odd' ?> related_obj_<?php echo $item->id ?>" id="<?php echo url_for(array($item, 'module' => 'event')) ?>">
        <td>
          <div>
            <?php if (isset($item->actor)): ?>
              <?php echo render_title($item->actor) ?>
            <?php endif; ?>
          </div>
        </td><td>
          <div>
            <?php echo $item->type ?>
          </div>
        </td><td>
          <div>
            <?php echo Qubit::renderDateStartEnd($item->getDate(array('cultureFallback' => true)), $item->startDate, $item->endDate) ?>
          </div>
        </td><td style="text-align: right">
          <input class="multiDelete" name="deleteEvents[]" type="checkbox" value="<?php echo url_for(array($item, 'module' => 'event')) ?>"/>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
