<div class="pageTitle"><?php echo __('list'); ?> <?php echo __('static pages'); ?></div>

<table class="list">
<thead>
<tr>
  <th style="width:15px;"><?php echo __('id'); ?></th>
  <th><?php echo __('title'); ?></th>
  <th><?php echo __('updated'); ?></th>
</tr>
</thead>
<tbody>
<?php foreach ($staticpages as $staticpage): ?>
<tr>
      <td align="center"><?php echo $staticpage->getId() ?></td>
      <td><?php echo link_to($staticpage->getTitle(), 'staticpage/edit?id='.$staticpage->getId()) ?></td>
      <td><?php echo $staticpage->getUpdatedAt() ?></td>
  </tr>
<?php endforeach; ?>
</tbody>
</table>

<div class="menu-action" style="padding-top: 10px;">
<?php echo link_to(__('create').' '.__('new').' '.__('static page'), 'staticpage/create') ?>
</div>
