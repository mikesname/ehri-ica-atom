<div class="pageTitle"><?php echo __('List places'); ?></div>

<table class="list">
<thead>
<tr>
  <th><?php echo __('Id'); ?></th>
  <th><?php echo __('Place name'); ?> <span class="th-link"><?php echo link_to(__('Add new'), 'place/create') ?></span></th>
  <th><?php echo __('Address'); ?></th>
  <th><?php echo __('Country'); ?></th>
</tr>
</thead>
<tbody>
<?php foreach ($places as $place): ?>
<tr>
      <td><?php echo $place->getId() ?></td>
      <td><?php echo link_to($place->getName(), 'place/edit?id='.$place->getId()) ?></td>
      <td><?php echo $place->getAddress() ?></td>
      <td><?php echo $place->getCountry() ?></td>
  </tr>
<?php endforeach; ?>
</tbody>
</table>

<div class="menu-action">
<?php echo link_to (__('Add new place'), 'place/create') ?>
</div>
