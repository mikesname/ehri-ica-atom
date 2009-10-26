<?php use_helper('Javascript') ?>
<div class="pageTitle"><?php echo __('import an XML file'); ?></div>

<?php echo form_tag('object/import', array('multipart' => 'true')) ?>

<table class="list">
<thead>
<tr>
  <th><?php echo __('select a file to import'); ?></th>
  <th width="100px" />
</tr>
</thead>
<tbody>
  <tr>
    <td><?php echo input_file_tag('file', array('size' => '30px')) ?></td>
    <td width="100px">
      <div style="float: right; margin: 3px 8px 0 0">
        <?php echo submit_tag(__('import')) ?>
      </div>
    </td>
  </tr>
</tbody>
</table>

</form>
