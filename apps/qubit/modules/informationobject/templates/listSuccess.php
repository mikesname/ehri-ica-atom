<div class="pageTitle"><?php echo __('list').' '.__('archival descriptions'); ?></div>

<table class="list">
<thead>
<tr>
  <th style="width: 35px;">
  <?php if ($sort == 'idDown'): ?>
    <?php echo link_to(__('id'), 'informationobject/list?repository='.$repository.'&sort=idUp') ?>
    <?php echo image_tag('down.gif', 'style="padding-bottom: 3px;"', 'sort down') ?>
  <?php else: ?>
    <?php echo link_to(__('id'), 'informationobject/list?repository='.$repository.'&sort=idDown') ?>
  <?php endif; ?>

  <?php if ($sort == 'idUp'): ?>
    <?php echo image_tag('up.gif', 'style="padding-bottom: 3px;"', 'sort up') ?>
  <?php endif; ?>
  </th>

  <th><?php if ($sort == 'titleUp'): ?>
    <?php echo link_to(__('title'), 'informationobject/list?repository='.$repository.'&sort=titleDown') ?>
    <?php echo image_tag('up.gif', 'style="padding-bottom: 3px;"', 'sort up') ?>
  <?php else: ?>
    <?php echo link_to(__('title'), 'informationobject/list?repository='.$repository.'&sort=titleUp') ?>
  <?php endif; ?>

  <?php if ($sort == 'titleDown'): ?>
    <?php echo image_tag('down.gif', 'style="padding-bottom: 3px;"', 'sort down') ?>
  <?php endif; ?>

  <?php if ($editCredentials): ?>
	<span class="th-link">(<?php echo link_to(__('add').' '.__('new'), 'informationobject/create'); ?>)</span>
  <?php endif; ?>
  </th>

  <th><?php if ($sort == 'repositoryUp'): ?>
    <?php echo link_to(__(sfConfig::get('app_ui_label_repository')), 'informationobject/list?repository='.$repository.'&sort=repositoryDown') ?>
    <?php echo image_tag('up.gif', 'style="padding-bottom: 3px;"', 'sort up') ?>
  <?php else: ?>
    <?php echo link_to(__(sfConfig::get('app_ui_label_repository')), 'informationobject/list?repository='.$repository.'&sort=repositoryUp') ?>
  <?php endif; ?>

  <?php if ($sort == 'repositoryDown'): ?>
    <?php echo image_tag('down.gif', 'style="padding-bottom: 3px;"', 'sort down') ?>
  <?php endif; ?>
  </th>

</tr>
</thead>
<tbody>
<?php foreach ($informationObjects as $informationObject): ?>
<tr>
      <td><?php echo $informationObject['id'] ?></td>
      <td><div style="padding-left: 17px;" <?php if($informationObject['hasChildren']) { echo 'class="plus"'; } ?>> <?php echo link_to($informationObject['title'], 'informationobject/show?id='.$informationObject['id']) ?></div></td>
      <td><?php echo $informationObject['repository'] ?></td>

  </tr>
<?php endforeach; ?>
</tbody>
</table>

<?php if ($editCredentials): ?>
<div class="menu-action">
	<?php echo link_to (__('add').' '.__('new').' '.__('archival description'), 'informationobject/create') ?>
</div>
<?php endif; ?>