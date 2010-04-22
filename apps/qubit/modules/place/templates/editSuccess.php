<div class="pageTitle"><?php echo __('Add/edit place'); ?></div>

<?php echo form_tag('place/update') ?>

<?php echo object_input_hidden_tag($place, 'getId') ?>

<table class="detail">
<tbody>

<tr><td colspan="2" class="headerCell"><?php echo ($place->getName()) ? link_to($place->getName(),'place/show?id='.$place->getId()): ''; ?></td></tr>

<tr><th><?php echo __('Id'); ?></th>
<td><?php echo $place->getId() ?></td></tr>

<tr>
  <th><?php echo __('Name'); ?></th>
  <td><?php echo object_input_tag($place, 'getName', array ('size' => 20)) ?></td>
</tr>

<tr>
  <th><?php echo __('Description'); ?></th>
  <td><?php echo object_textarea_tag($place, 'getDescription', array ('size' => '30x3')) ?></td>
</tr>

<tr>
  <th><?php echo __('Address'); ?></th>
  <td><?php echo object_textarea_tag($place, 'getAddress', array ('size' => '30x3')) ?></td>
</tr>
<tr>
  <th><?php echo __('Country'); ?></th>
  <td><?php echo object_select_tag($place, 'getCountryId', array ('related_class' => 'Term', 'peer_method' => 'getCountries', 'include_blank' => true)) ?></td>
</tr>
<tr>
  <th><?php echo __('Latitude'); ?></th>
  <td><?php echo object_input_tag($place, 'getLatitude', array ('size' => 20)) ?></td>
</tr>
<tr>
  <th><?php echo __('Longitude'); ?></th>
  <td><?php echo object_input_tag($place, 'getLongtitude', array ('size' => 20)) ?></td>
</tr>

<tr>
  <th><?php echo __('Map relations'); ?>: <br />
  <span class="th-link"><?php echo link_to(__('Add new'), 'map/createPlaceMapRelation?placeId='.$place->getId()) ?></span></th>
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
<?php if ($place->getId()): ?>
  &nbsp;<?php echo link_to(__('Delete'), 'place/delete?id='.$place->getId(), 'post=true&confirm='.__('Are you sure?')) ?>
  &nbsp;<?php echo link_to(__('Cancel'), 'place/list') ?>
<?php else: ?>
  &nbsp;<?php echo link_to(__('Cancel'), 'place/list') ?>
<?php endif; ?>
    <?php if ($place->getId()): ?>
      <?php echo submit_tag(__('Save')) ?>
    <?php else: ?>
      <?php echo submit_tag(__('Create')) ?>
    <?php endif; ?>
</form>
</div>

<div class="menu-extra">
	<?php echo link_to(__('List all places'), 'place/list'); ?>
</div>
