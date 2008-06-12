<div class="pageTitle"><?php echo __('list %1%', array('%1%' => sfConfig::get('app_ui_label_mediatype'))) ?></div>

<table class="list"><thead><tr>
  <th>
    <?php if ($sort == 'nameUp'): ?>
      <?php echo link_to(__('name'), 'digitalobject/list?sort=nameDown') ?>
      <?php echo image_tag('up.gif', array('style' => 'padding-bottom: 3px'), 'sort up') ?>
    <?php elseif ($sort == 'nameDown'): ?>
      <?php echo link_to(__('name'), 'digitalobject/list?sort=nameUp') ?>
      <?php echo image_tag('down.gif', array('style' => 'padding-bottom: 3px'), 'sort down') ?>
    <?php else: ?>
      <?php echo link_to(__('name'), 'digitalobject/list?sort=nameUp') ?>
    <?php endif; ?>
  </th>
  <th>
    <?php if ($sort == 'hitsUp'): ?>
      <?php echo link_to(__('results'), 'digitalobject/list?sort=hitsDown') ?>
      <?php echo image_tag('up.gif', array('style' => 'padding-bottom: 3px'), 'sort up') ?>
    <?php elseif ($sort == 'hitsDown'): ?>
      <?php echo link_to(__('results'), 'digitalobject/list?sort=hitsUp') ?>
      <?php echo image_tag('down.gif', array('style' => 'padding-bottom: 3px'), 'sort down') ?>
    <?php else: ?>
      <?php echo link_to(__('results'), 'digitalobject/list?sort=hitsUp') ?>
    <?php endif; ?>
  </th>
</tr>
</thead>

<tbody>
<?php foreach ($resultSet as $row): ?>
<?php $mediaType = QubitTerm::getbyId($row[0]); ?>
<tr>
  <td>
    <?php if (is_null($mediaTypeName = $mediaType->getName())) $mediaTypeName = $mediaType->getName(array('sourceCulture' => true)); ?>
    <?php $linkAction = ($editCredentials) ? 'brow' : 'show'; ?>
    <div style="padding-left: 17px;">
      <?php echo link_to($mediaTypeName, 'digitalobject/browse?mediatype='.$row[0]); ?>
    </div>
  </td>
  <td>
    <?php echo $row[1]; ?>
  </td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

<?php if ($editCredentials): ?>
  <div class="menu-action">
    <?php echo link_to(__('add new'), 'actor/create') ?>
  </div>
<?php endif; ?>
