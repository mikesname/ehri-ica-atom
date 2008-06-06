<div class="pageTitle"><?php echo __('list maps'); ?></div>

<table class="list">
<thead>
<tr>
  <th style="width: 35px;"><?php echo __('id'); ?></th>
  <th><?php echo __('title'); ?><span class="th-link"><?php echo link_to(__('add new'), 'map/create') ?></span></th>

</tr>
</thead>
<tbody>
<?php foreach ($maps as $map): ?>
<tr>
      <td><?php echo $map->getId() ?></td>
    <td><?php echo link_to($map->getTitle(), 'map/edit?id='.$map->getId()) ?></td>
  </tr>
<?php endforeach; ?>
</tbody>
</table>

<div class="menu-action">
<?php echo link_to (__('add new map'), 'map/create') ?>
</div>
