<h1><?php echo __('Physical storage') ?></h1>

<h1 class="label"><?php echo render_title($informationObject) ?></h1>

<table class="sticky-enabled">
  <thead>
    <tr>
      <th>
        <?php echo __('Name') ?>
      </th><th>
        <?php echo __('Location') ?>
      </th><th>
        <?php echo __('Type') ?>
      </th>
    </tr>
  </thead><tbody>
    <?php foreach ($physicalObjects as $physicalObject): ?>
      <tr class="<?php echo 0 == ++$row % 2 ? 'even' : 'odd' ?>">
        <td>
          <?php echo link_to(render_title($physicalObject), array($physicalObject, 'module' => 'physicalobject')) ?>
        </td><td>
          <?php echo render_value($physicalObject->getLocation(array('cultureFallback' => true))) ?>
        </td><td>
          <?php echo render_value($physicalObject->type) ?>
        </td>
      </tr>
    <?php endforeach; ?>
  <tbody>
</table>

<?php echo get_partial('default/pager', array('pager' => $pager)) ?>
