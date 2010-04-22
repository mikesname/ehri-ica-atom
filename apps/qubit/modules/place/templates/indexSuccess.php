<div class="pageTitle"><?php echo __('Place'); ?></div>

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
<th><?php echo __('Description'); ?></th>
<td><?php echo $user->getDescription() ?></td>
</tr>
<tr>
<th><?php echo __('Address'); ?></th>
<td><?php echo $user->getAddress() ?></td>
</tr>
<tr>
<th><?php echo __('Country'); ?></th>
<td><?php echo $user->getCountry() ?></td>
</tr>
<tr>
<th><?php echo __('Latitude'); ?></th>
<td><?php echo $user->getLatitude() ?></td>
</tr>
<tr>
<th><?php echo __('Longitude'); ?></th>
<td><?php echo $user->getLongtitude() ?></td>
</tr>

<tr>
  <th><?php echo __('Maps'); ?></th>
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
  <?php echo link_to(__('Edit'), 'place/edit?id='.$place->getId()) ?>
<?php endif; ?>
<?php echo link_to(__('Back'), $nav_context_back) ?>
</div>
