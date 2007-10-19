<div class="pageTitle"><?php echo __('add').' / '.__('edit').' '.__('digital objects'); ?></div>

<?php echo form_tag('digitalobject/update') ?>

<?php echo object_input_hidden_tag($digital_object, 'getId') ?>

<table>
<tbody>
<tr>
  <th><?php echo __('filename'); ?>:</th>
  <td><?php echo object_input_tag($digital_object, 'getFilename', array ('size' => 80)) ?></td>
</tr>
<tr>
  <th><?php echo __('network path'); ?>:</th>
  <td><?php echo object_input_tag($digital_object, 'getNetworkPath', array ('size' => 80)) ?></td>
</tr>
<tr>
  <th><?php echo __('URL'); ?>:</th>
  <td><?php echo object_input_tag($digital_object, 'getUrl', array ('size' => 80)) ?></td>
</tr>
</tbody>
</table>
<hr />
<?php echo submit_tag('save') ?>
<?php if ($digital_object->getId()): ?>
  &nbsp;<?php echo link_to(__('delete'), 'digitalobject/delete?id='.$digital_object->getId(), 'post=true&confirm='.__('are you sure?')) ?>
  &nbsp;<?php echo link_to(__('cancel'), 'digitalobject/show?id='.$digital_object->getId()) ?>
<?php else: ?>
  &nbsp;<?php echo link_to(__('cancel'), 'digitalobject/list') ?>
<?php endif; ?>
</form>
