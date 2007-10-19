<div class="pageTitle"><?php echo __('add').' / '.__('edit').' '.__('place'); ?></div>

<?php echo form_tag('place/update') ?>

<?php echo object_input_hidden_tag($place, 'getId') ?>

<table class="detail">
<tbody>

<tr><td colspan="2" class="headerCell"><?php echo ($place->getName()) ? link_to($place->getName(),'place/show?id='.$place->getId()): ''; ?></td></tr>


<tr><th><?php echo __('id'); ?>: </th>
<td><?php echo $place->getId() ?></td></tr>

<tr>
  <th><?php echo __('name'); ?>:</th>
  <td><?php echo object_input_tag($place, 'getName', array (
  'size' => 20,
)) ?></td>
</tr>


<tr>
  <th><?php echo __('description'); ?>:</th>
  <td><?php echo object_textarea_tag($place, 'getDescription', array (
  'size' => '30x3',
)) ?></td>
</tr>

<tr>
  <th><?php echo __('address'); ?>:</th>
  <td><?php echo object_textarea_tag($place, 'getAddress', array (
  'size' => '30x3',
)) ?></td>
</tr>
<tr>
  <th><?php echo __('country'); ?>:</th>
  <td><?php echo object_select_tag($place, 'getCountryId', array (
  'related_class' => 'Term',
  'peer_method' => 'getCountries',
  'include_blank' => true,
)) ?></td>
</tr>
<tr>
  <th><?php echo __('longitude'); ?>:</th>
  <td><?php echo object_input_tag($place, 'getLongtitude', array (
  'size' => 20,
)) ?></td>
</tr>
<tr>
  <th><?php echo __('latitude'); ?>:</th>
  <td><?php echo object_input_tag($place, 'getLatitude', array (
  'size' => 20,
)) ?></td>
</tr>

<tr>
  <th><?php echo __('map relationships'); ?>: <br />
  <span class="th-link">(<?php echo link_to(__('add').' '.__('new'), 'map/createPlaceMapRelationship?placeId='.$place->getId()) ?>)</span></th>
  <td>
  <?php if ($mapRelationships): ?>
  <?php foreach ($mapRelationships as $relationship): ?>
  <?php echo link_to($relationship->getMap(), 'map/show?id='.$relationship->getMapId()) ?><br />
  <?php endforeach; ?>
  <?php endif; ?>
  </td>
</tr>


</tbody>
</table>

<div class="menu-action">
<?php if ($place->getId()): ?>
  &nbsp;<?php echo link_to(__('delete'), 'place/delete?id='.$place->getId(), 'post=true&confirm='.__('are you sure?')) ?>
  &nbsp;<?php echo link_to(__('cancel'), 'place/list') ?>
<?php else: ?>
  &nbsp;<?php echo link_to(__('cancel'), 'place/list') ?>
<?php endif; ?>
<?php echo my_submit_tag(__('save'), array('style' => 'width: auto;')) ?>
</form>
</div>


<div class="menu-extra">
	<?php echo link_to(__('list').' '.__('all').' '.__('places'), 'place/list'); ?>
</div>
