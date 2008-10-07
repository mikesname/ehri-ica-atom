<div class="pageTitle"><?php echo __('list %1%', array('%1%' => sfConfig::get('app_ui_label_mediatype'))) ?></div>

<table class="list"><thead><tr>
  <th>
  <?php if ($sort == 'nameUp'): ?>
    <?php echo link_to(__('name'), 'digitalobject/list?sort=nameDown') ?>
    <?php echo image_tag('up.gif', 'style="padding-bottom: 3px;"', 'sort up') ?>
  <?php else: ?>
    <?php echo link_to(__('name'), 'digitalobject/list?sort=nameUp') ?>
  <?php endif; ?>
  <?php if ($sort == 'nameDown'): ?>
    <?php echo image_tag('down.gif', 'style="padding-bottom: 3px;"', 'sort down') ?>
  <?php endif; ?>
  </th>
  <th>
  <?php if ($sort == 'hitsUp'): ?>
    <?php echo link_to(__('results'), 'digitalobject/list?sort=hitsDown') ?>
    <?php echo image_tag('up.gif', 'style="padding-bottom: 3px;"', 'sort up') ?>
  <?php else: ?>
    <?php echo link_to(__('results'), 'digitalobject/list?sort=hitsUp') ?>
  <?php endif; ?>
  <?php if ($sort == 'hitsDown'): ?>
    <?php echo image_tag('down.gif', 'style="padding-bottom: 3px;"', 'sort down') ?>
  <?php endif; ?>
  </th>
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

<?php if ($editCredentials): ?>
  <div class="menu-action">
    <?php echo link_to(__('add new'), 'actor/create') ?>
  </div>
<?php endif; ?>
