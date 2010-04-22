<div class="pageTitle"><?php echo __('Add/edit map'); ?></div>

<?php echo form_tag('map/update') ?>

<?php echo object_input_hidden_tag($map, 'getId') ?>

<table class="detail">
<tbody>

<?php if ($map->getTitle()): ?>
	<tr><td colspan="2" class="headerCell">
	<?php echo link_to($map->getTitle(),'map/show?id='.$map->getId()); ?>
	</td></tr>
<?php endif; ?>

<tr><th><?php echo __('Id'); ?></th>
<td><?php echo $map->getId() ?></td></tr>

<tr>
  <th><?php echo __('Title'); ?></th>
  <td><?php echo object_input_tag($map, 'getTitle', array ('size' => 20)) ?></td>
</tr>
<tr>
  <th><?php echo __('Description'); ?></th>
  <td><?php echo object_textarea_tag($map, 'getDescription', array ('size' => '30x3')) ?></td>
</tr>

<tr>
  <th><?php echo __('Places'); ?>: <br />
  <span class="th-link"><?php echo link_to(__('Add new'), 'map/createPlaceMapRelation?mapId='.$map->getId()) ?></span></th>
  <td>
  <?php if ($placeRelations): ?>
  <?php foreach ($placeRelations as $relation): ?>
  <?php echo link_to($relation->getPlace(), 'map/editPlaceMapRelation?id='.$relation->getId()) ?><br />
  <?php endforeach; ?>
  <?php endif; ?>
  </td>
</tr>

</tbody>
</table>

<div class="menu-action">
<?php if ($map->getId()): ?>
  &nbsp;<?php echo link_to(__('Delete'), 'map/delete?id='.$map->getId(), 'post=true&confirm='.__('Are you sure?')) ?>
  &nbsp;<?php echo link_to(__('Cancel'), 'map/show?id='.$map->getId()) ?>
<?php else: ?>
  &nbsp;<?php echo link_to(__('Cancel'), 'map/list') ?>
<?php endif; ?>
    <?php if ($map->getId()): ?>
      <?php echo submit_tag(__('Save')) ?>
    <?php else: ?>
      <?php echo submit_tag(__('Create')) ?>
    <?php endif; ?>
</div>
</form>

<div class="menu-extra">
	<?php echo link_to(__('List all maps'), 'map/list'); ?>
	<?php echo link_to(__('View map'), 'map/show?id='.$map->getId() ) ?>
</div>
