<h1><?php echo __('List %1%', array('%1%' => sfConfig::get('app_ui_label_digitalobject'))) ?></h1>

<table class="list">
<thead>
  <tr>
    <th><?php echo __('Name'); ?></th>
    <th><?php echo __('Results'); ?></th>
  </tr>
</thead>

<tbody>
<?php foreach ($terms as $term): ?>
<tr class="<?php echo 0 == ++$row % 2 ? 'even' : 'odd' ?>">
  <td>
    <div style="padding-left: 17px;">
      <?php echo link_to($term->getName(array('cultureFallback'=>true)), array('module' => 'digitalobject', 'action' => 'browse', 'mediatype' => $term->id)); ?>
    </div>
  </td>
  <td>
    <?php echo QubitDigitalObject::getCount($term->id); ?>
  </td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
