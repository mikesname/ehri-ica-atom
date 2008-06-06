<div class="pageTitle"><?php echo __('place'); ?></div>

<table class="detail">
<tbody>

<tr><td colspan="2" class="headerCell">
<?php if ($editCredentials): ?>
	<?php echo link_to($place->getName(), 'place/edit/?id='.$place->getId()); ?>
<?php else: ?>
	<?php echo $place->getName(); ?>
<?php endif; ?>
</td></tr>

<tr>
<th><?php echo __('description'); ?></th>
<td><?php echo $user->getDescription() ?></td>
</tr>
<tr>
<th><?php echo __('address'); ?></th>
<td><?php echo $user->getAddress() ?></td>
</tr>
<tr>
<th><?php echo __('country'); ?></th>
<td><?php echo $user->getCountry() ?></td>
</tr>
<tr>
<th><?php echo __('latitude'); ?></th>
<td><?php echo $user->getLatitude() ?></td>
</tr>
<tr>
<th><?php echo __('longitude'); ?></th>
<td><?php echo $user->getLongtitude() ?></td>
</tr>

<tr>
  <th><?php echo __('maps'); ?></th>
  <td>
  <?php if ($mapRelations): ?>
  <?php foreach ($mapRelations as $relation): ?>
  <?php echo link_to($relation->getMap(), 'map/show?id='.$relation->getMapId()) ?><br />
  <?php endforeach; ?>
  <?php endif; ?>
  </td>
</tr>

</tbody>

</table>

<div class="menu-action">
<?php if ($editCredentials): ?>
  <?php echo link_to(__('edit'), 'place/edit?id='.$place->getId()) ?>
<?php endif; ?>
<?php echo link_to(__('back'), $nav_context_back) ?>
</div>
