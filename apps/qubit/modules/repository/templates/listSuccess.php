<div class="pageTitle"><?php echo __('list').' '.__('archival institutions'); ?></div>

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
	<span class="th-link">(<?php echo link_to(__('add').' '.__('new'), 'repository/create'); ?>)</span>
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
  <?php if ($editCredentials)
    {
    echo link_to($repository['name'], 'repository/show?id='.$repository['id']);
    }
  else
    {
    echo link_to($repository['name'], 'repository/show?id='.$repository['id']);
    } ?>
  </td>
  <td><?php echo $repository['type'] ?></td>
  <td><?php echo $repository['country'] ?></td>
  </tr>
<?php endforeach; ?>
</tbody>
</table>

<?php if ($editCredentials): ?>
<div class="menu-action">
	<?php echo link_to(__('add').' '.__('new').' '.__('archival institution'), 'repository/create'); ?>
</div>
<?php endif; ?>
