<div class="pageTitle"><?php echo __('list'); ?> <?php echo __('static pages'); ?></div>

<table class="list">
<thead>
<tr>
  <th><?php echo __('title'); ?></th>
  <th><?php echo __('permalink'); ?></th>
</tr>
</thead>
<tbody>
<?php foreach ($staticPages as $staticPage): ?>
  <tr>
  <td><?php if (is_null($title = $staticPage->getTitle())) $title = $staticPage->getTitle(array('sourceCulture' => true)); echo link_to($title, 'staticpage/edit?id='.$staticPage->getId()) ?>
  </td>
  <td><?php echo link_to($staticPage->getPermalink(), array('module' => 'staticpage', 'action' => 'static', 'permalink' => $staticPage->getPermalink())) ?>
  </tr>
<?php endforeach; ?>
</tbody>
</table>

<div class="menu-action" style="padding-top: 10px;">
<?php echo link_to(__('add new static page'), 'staticpage/create') ?>
</div>
