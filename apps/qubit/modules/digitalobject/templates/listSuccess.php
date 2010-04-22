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
    <?php $linkAction = ($editCredentials) ? 'browse' : 'show'; ?>
    <div style="padding-left: 17px;">
      <?php echo link_to($term->getName(array('cultureFallback'=>true)), 'digitalobject/browse?mediatype='.$term->getId()); ?>
    </div>
  </td>
  <td>
    <?php echo QubitDigitalObject::getCount($term->getId()); ?>
  </td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
