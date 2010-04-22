<?php use_helper('Javascript') ?>

<h1><?php echo __('Import an XML file') ?></h1>

<?php echo form_tag('object/import', array('multipart' => 'true')) ?>

<table class="list">
<thead>
<tr>
  <th><?php echo __('Select a file to import'); ?></th>
  <th width="100px"></th>
</tr>
</thead>
<tbody>
  <tr>
    <td><?php echo input_file_tag('file', array('size' => '30px')) ?></td>
    <td width="100px">
      <div style="float: right; margin: 3px 8px 0 0">
        <?php echo submit_tag(__('Import')) ?>
      </div>
    </td>
  </tr>
</tbody>
</table>

</form>
