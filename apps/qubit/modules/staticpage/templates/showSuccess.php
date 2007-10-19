<div class="pageTitle"></div>

<table class="detail">
<tbody>
<tr>
<th><?php echo __('id'); ?>: </th>
<td><?php echo $staticpage->getId() ?></td>
</tr>
<tr>
<th><?php echo __('title'); ?>: </th>
<td><?php echo $staticpage->getTitle() ?></td>
</tr>
<tr>
<th><?php echo __('permalink'); ?>: </th>
<td><?php echo $staticpage->getPermalink() ?></td>
</tr>
<tr>
<th><?php echo __('page content'); ?>: </th>
<td><?php echo $staticpage->getPageContent() ?></td>
</tr>
<tr>
<th><?php echo __('stylesheet'); ?>: </th>
<td><?php echo $staticpage->getStylesheet() ?></td>
</tr>
<tr>
<th><?php echo __('created'); ?>: </th>
<td><?php echo $staticpage->getCreatedAt() ?></td>
</tr>
<tr>
<th><?php echo __('updated'); ?>: </th>
<td><?php echo $staticpage->getUpdatedAt() ?></td>
</tr>
</tbody>
</table>
<div class="menu-action">
<?php echo link_to(__('edit'), 'staticpage/edit?id='.$staticpage->getId()) ?>
<?php echo link_to(__('list').' '.__('all'), 'staticpage/list') ?>
</div>
