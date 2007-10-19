<div class="pageTitle"><?php echo __('digital object'); ?></div>

<table>
<tbody>
<tr>
<th><?php echo __('id'); ?>: </th>
<td><?php echo $digital_object->getId() ?></td>
</tr>
<tr>
<th><?php echo __('filename'); ?>: </th>
<td><?php echo $digital_object->getFilename() ?></td>
</tr>
<tr>
<th><?php echo __('network path'); ?>: </th>
<td><?php echo $digital_object->getNetworkPath() ?></td>
</tr>
<tr>
<th><?php echo __('URL'); ?>: </th>
<td><?php echo $digital_object->getUrl() ?></td>
</tr>
<tr>
<th><?php echo __('created'); ?>: </th>
<td><?php echo $digital_object->getCreatedAt() ?></td>
</tr>
<tr>
<th><?php echo __('updated'); ?>: </th>
<td><?php echo $digital_object->getUpdatedAt() ?></td>
</tr>
</tbody>
</table>
<hr />
<?php echo link_to(__('edit'), 'digitalobject/edit?id='.$digital_object->getId()) ?>
&nbsp;<?php echo link_to(__('list'), 'digitalobject/list') ?>
