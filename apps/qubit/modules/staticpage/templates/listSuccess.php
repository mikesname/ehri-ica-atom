<h1><?php echo __('List static pages') ?></h1>

<table class="list">
<thead>
<tr>
  <th><?php echo __('Title'); ?>
  <span class="th-link"><?php echo link_to(__('Add new'), array('module' => 'staticpage', 'action' => 'create')); ?></span>
  </th>
  <th><?php echo __('Permalink'); ?></th>
</tr>
</thead>
<tbody>
<?php foreach ($staticPages as $staticPage): ?>
  <tr class="<?php echo 0 == ++$row % 2 ? 'even' : 'odd' ?>">
    <td><?php echo link_to($staticPage->getTitle(array('cultureFallback' => 'true')), 'staticpage/edit?id='.$staticPage->getId()) ?></td>
    <td><?php echo link_to($staticPage->getPermalink(), array('module' => 'staticpage', 'action' => 'static', 'permalink' => $staticPage->getPermalink())) ?>
  </tr>
<?php endforeach; ?>
</tbody>
</table>
