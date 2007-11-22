<div class="pageTitle"><?php echo __('list').' '.__('active').' '.__('languages'); ?></div>

<table class="list">
<thead>
<tr>
  <th>id</th>
  <th><?php echo __('language') ?></th>
  <th><?php echo __('ISO 639 code') ?></th>
  <th></th>
</tr>
</thead>
<tbody>
<?php foreach ($languages as $language): ?>
<tr>
      <td><?php echo $language->getId() ?></td>
      <td><?php echo $language->getTermName() ?></td>
      <td><?php echo $language->getCodeAlpha() ?></td>
      <td><?php echo link_to(image_tag('delete', 'align=top'), 'i18n/deleteI18nLanguage?id='.$language->getId()) ?>
</tr>
<?php endforeach; ?>

<?php echo form_tag('i18n/updateI18nLanguages') ?>
<tr>
  <td></td>
  <td><?php echo input_tag('newLanguage') ?></td>
  <td><?php echo input_tag('newCodeAlpha','', 'maxlength=2 style="width:15px;"') ?></td>
  <td><?php echo submit_image_tag('add', 'class=submitAdd') ?></td>
</tr>
</form>


</tbody>
</table>