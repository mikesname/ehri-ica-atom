<?php use_helper('Javascript') ?>
<div class="pageTitle"><?php echo __('import an XML file'); ?></div>

<?php echo form_tag('object/import', array('multipart' => 'true')) ?>

<table class="list">
<thead>
<tr>
  <th><?php echo __('select a file to import'); ?></th>
  <th/>
</tr>
</thead>
<tbody>
  <tr>
        <td><?php echo input_file_tag(__('file'), "size = 60") ?></td>
    <td style="width: 5%;">
    <div style="float: right; margin: 3px 8px 0 0;">
      <?php echo my_submit_tag(__('upload'), array('style' => 'width: auto;')) ?>
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
  <th/>
</tr>
</thead>
<tbody>
<tr>
  <td colspan>
  <?php echo object_select_tree(new QubitInformationObject, 'getId', array('disabled' => $informationObject->getDescendants(array('index' => 'id')), 'include_blank' => true, 'peer_method' => 'getDescendants', 'related_class' => QubitInformationObject::getOne(QubitInformationObject::addRootsCriteria(new Criteria)))) ?>
  </td>
  <td style="text-align: right;">
    <?php echo select_tag('format', options_for_select(
      array(
              'ead' => 'EAD 2002',
               'mods' => 'MODS 3.2',
               'marc' => 'MARC21XML (via EAD)',
               'alouette' => 'AlouetteCanada Portal'), null, array('include_blank' => true))); ?>
  </td>
  <td style="width: 5%;">
    <div style="float: right; margin: 3px 8px 0 0;">
      <?php echo my_submit_tag(__('export'), array('style' => 'width: auto;')) ?>
    </div>
    </td>
</tr>

</tbody>
</table>

</form>
