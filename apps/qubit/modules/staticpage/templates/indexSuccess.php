<table class="detail">
<tbody>
<tr>
<th><?php echo __('Id'); ?></th>
<td><?php echo $staticPage->getId() ?></td>
</tr>
<tr>
<th><?php echo __('Title'); ?></th>
<td><?php echo $staticPage->getTitle() ?></td>
</tr>
<tr>
<th><?php echo __('Permalink'); ?></th>
<td><?php echo $staticPage->getPermalink() ?></td>
</tr>
<tr>
<th><?php echo __('Content'); ?></th>
<td><?php echo $staticPage->getContent() ?></td>
</tr>
<tr>
<th><?php echo __('Created'); ?></th>
<td><?php echo $staticPage->getCreatedAt() ?></td>
</tr>
<tr>
<th><?php echo __('Updated'); ?></th>
<td><?php echo $staticPage->getUpdatedAt() ?></td>
</tr>
</tbody>
</table>

<div class="actions section">
<h2 class="element-invisible"><?php echo __('Actions') ?></h2>
  <div class="content">
    <ul class="clearfix links">
      <li><?php echo link_to(__('Edit'), 'staticpage/edit?id='.$staticPage->getId()) ?></li>
      <li><?php echo link_to(__('List all'), 'staticpage/list') ?></li>
    </ul>
  </div>
</div>
