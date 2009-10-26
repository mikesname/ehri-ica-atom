<div class="pageTitle"><?php echo __('list'); ?> <?php echo __('static pages'); ?></div>

<table class="list">
<thead>
<tr>
  <th><?php echo __('title'); ?>
  <span class="th-link"><?php echo link_to(__('add new'), array('module' => 'staticpage', 'action' => 'create')); ?></span>
  </th>
  <th><?php echo __('permalink'); ?></th>
</tr>
</thead>
<tbody>
<?php foreach ($staticPages as $staticPage): ?>
  <tr>
  <td><?php echo link_to($staticPage->getTitle(array('cultureFallback' => 'true')), 'staticpage/edit?id='.$staticPage->getId()) ?></td>
  <td><?php echo link_to($staticPage->getPermalink(), array('module' => 'staticpage', 'action' => 'static', 'permalink' => $staticPage->getPermalink())) ?>
  </tr>
<?php endforeach; ?>
</tbody>
</table>
