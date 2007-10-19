<div class="pageTitle"><?php echo __('list').' '.__('digital objects'); ?></div>

<table>
<thead>
<tr>
  <th><?php echo __('id'); ?></th>
  <th><?php echo __('filename'); ?></th>
  <th><?php echo __('network path'); ?></th>
  <th><?php echo __('URL'); ?></th>
  <th><?php echo __('created'); ?></th>
  <th><?php echo __('updated'); ?></th>
</tr>
</thead>
<tbody>
<?php foreach ($digital_objects as $digital_object): ?>
<tr>
    <td><?php echo link_to($digital_object->getId(), 'digitalobject/show?id='.$digital_object->getId()) ?></td>
      <td><?php echo $digital_object->getFilename() ?></td>
      <td><?php echo $digital_object->getNetworkPath() ?></td>
      <td><?php echo $digital_object->getUrl() ?></td>
      <td><?php echo $digital_object->getCreatedAt() ?></td>
      <td><?php echo $digital_object->getUpdatedAt() ?></td>
  </tr>
<?php endforeach; ?>
</tbody>
</table>

<?php echo link_to (__('create'), 'digitalobject/create') ?>
