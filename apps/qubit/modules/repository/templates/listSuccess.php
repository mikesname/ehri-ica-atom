<div class="pageTitle"><?php echo __('list %1%', array('%1%' => sfConfig::get('app_ui_label_repository'))); ?></div>

<table class="list">
<thead>
<tr>
  <th><?php if ($sort == 'nameUp'): ?>
    <?php echo link_to(__('name'), 'repository/list?country='.$country.'&sort=nameDown') ?>
    <?php echo image_tag('up.gif', 'style="padding-bottom: 3px;"', 'sort up') ?>
  <?php else: ?>
    <?php echo link_to(__('name'), 'repository/list?country='.$country.'&sort=nameUp') ?>
  <?php endif; ?>

  <?php if ($sort == 'nameDown'): ?>
    <?php echo image_tag('down.gif', 'style="padding-bottom: 3px;"', 'sort down') ?>
  <?php endif; ?>

  <?php if ($editCredentials): ?>
  <span class="th-link"><?php echo link_to(__('add new'), 'repository/create'); ?></span>
  <?php endif; ?>
  </th>

  <th><?php if ($sort == 'typeUp'): ?>
    <?php echo link_to(__('type'), 'repository/list?country='.$country.'&sort=typeDown') ?>
    <?php echo image_tag('up.gif', 'style="padding-bottom: 3px;"', 'sort up') ?>
  <?php else: ?>
    <?php echo link_to(__('type'), 'repository/list?country='.$country.'&sort=typeUp') ?>
  <?php endif; ?>

  <?php if ($sort == 'typeDown'): ?>
    <?php echo image_tag('down.gif', 'style="padding-bottom: 3px;"', 'sort down') ?>
  <?php endif; ?>
  </th>

  <th>
  <?php if ($sort == 'countryDown'): ?>
    <?php echo link_to(__('country'), 'repository/list?country='.$country.'&sort=countryUp') ?>
    <?php echo image_tag('down.gif', 'style="padding-bottom: 3px;"', 'sort down') ?>
  <?php else: ?>
    <?php echo link_to(__('country'), 'repository/list?country='.$country.'&sort=countryDown') ?>
  <?php endif; ?>

  <?php if ($sort == 'countryUp'): ?>
    <?php echo image_tag('up.gif', 'style="padding-bottom: 3px;"', 'sort up') ?>
  <?php endif; ?>
  </th>

</tr>
</thead>
<tbody>
<?php foreach ($repositories as $repository): ?>
<tr>
  <td>
  <?php if (is_null($repositoryName = $repository->getAuthorizedFormOfName())) $repositoryName = $repository->getAuthorizedFormOfName(array('sourceCulture' => true)); ?>
  <?php if ($editCredentials): ?>
    <?php echo link_to($repositoryName, 'repository/show?id='.$repository->getId()) ?>
  <?php else: ?>
    <?php echo link_to($repositoryName, 'repository/show?id='.$repository->getId()) ?>
  <?php endif; ?>
  </td>
  <td>
  <?php if ($repository->getTypeId()): ?>
    <?php if (is_null($repositoryType = $repository->getType()->getName())) $repositoryType = $repository->getType()->getName(array('sourceCulture' => true)); echo $repositoryType; ?>
  <?php endif; ?>
  </td>
  <td><?php echo $repository->getCountry() ?></td>
  </tr>
<?php endforeach; ?>
</tbody>
</table>

<?php if ($editCredentials): ?>
<div class="menu-action">
  <?php echo link_to(__('add new %1%', array('%1%' => sfConfig::get('app_ui_label_repository'))), 'repository/create'); ?>
</div>
<?php endif; ?>
