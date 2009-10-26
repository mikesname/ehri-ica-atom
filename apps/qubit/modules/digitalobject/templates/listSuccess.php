<div class="pageTitle"><?php echo __('list %1%', array('%1%' => sfConfig::get('app_ui_label_mediatype'))) ?></div>

<table class="list">
<thead>
  <tr>
    <th><?php echo __('name'); ?></th>
    <th><?php echo __('results'); ?></th>
  </tr>
</thead>

<tbody>
<?php foreach ($terms as $term): ?>
<tr>
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
