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
        <?php echo submit_tag(__('upload'), array('class' => 'form-submit')) ?>
      </div>
    </td>
  </tr>
</tbody>
</table>

</form>

<br/><br/>

<div class="pageTitle"><?php echo __('export an XML file'); ?></div>

<?php echo form_tag('object/export') ?>

<table class="list">
<thead>
<tr>
  <th><?php echo sfConfig::get('app_ui_label_informationobject'); ?></th>
  <th><?php echo __('format') ?></th>
  <th width="100px"/>
</tr>
</thead>
<tbody>
<tr>
  <td style="width: 200px">
    <div><?php echo object_select_tree(new QubitInformationObject, 'getId',
      array(
        'disabled' => $informationObject->getDescendants(array('index' => 'id')),
        'include_blank' => true,
        'peer_method' => 'getDescendants',
        'related_class' => QubitInformationObject::getOne(QubitInformationObject::addRootsCriteria(new Criteria)),
        'style' => 'width: 200px'
      )
    ) ?></div>

  </td>
  <td style="text-align: right;">
    <?php echo select_tag('format', options_for_select(
      array('dc' => 'Dublin Core','ead' => 'EAD 2002'),
      null, array('include_blank' => true))); ?>
  </td>
  <td width="100px">
    <div style="float: right; margin: 3px 3px 0 0;">
      <?php echo submit_tag(__('export'), array('class' => 'form-submit')) ?>
    </div>
  </td>
</tr>

</tbody>
</table>

</form>
