<div class="pageTitle"></div>

<table class="detail">
<tbody>
<tr>
<th><?php echo __('id'); ?></th>
<td><?php echo $staticPage->getId() ?></td>
</tr>
<tr>
<th><?php echo __('title'); ?></th>
<td><?php echo $staticPage->getTitle() ?></td>
</tr>
<tr>
<th><?php echo __('permalink'); ?></th>
<td><?php echo $staticPage->getPermalink() ?></td>
</tr>
<tr>
<th><?php echo __('content'); ?></th>
<td><?php echo $staticPage->getContent() ?></td>
</tr>
<tr>
<th><?php echo __('created'); ?></th>
<td><?php echo $staticPage->getCreatedAt() ?></td>
</tr>
<tr>
<th><?php echo __('updated'); ?></th>
<td><?php echo $staticPage->getUpdatedAt() ?></td>
</tr>
</tbody>
</table>
<div class="menu-action">
<?php echo link_to(__('edit'), 'staticpage/edit?id='.$staticPage->getId()) ?>
<?php echo link_to(__('list all'), 'staticpage/list') ?>
</div>
