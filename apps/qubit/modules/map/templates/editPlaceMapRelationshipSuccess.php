<div class="pageTitle"><?php echo __('edit').' '.__('place -> map relationship'); ?></div>

<?php echo form_tag('map/updatePlaceMapRelationship') ?>

<?php echo object_input_hidden_tag($placeMapRelationship, 'getId') ?>

<table class="detail" width="98%">
<tbody>

<tr><td colspan="2" class="headerCell"><?php echo __('map marker'); ?></td></tr>

<tr>
  <th><?php echo __('map'); ?>:</th>
  <td>
  <?php if ($placeMapRelationship->getMapId()): ?>
  <?php echo object_input_hidden_tag($placeMapRelationship, 'getMapId') ?>
  <?php echo link_to($placeMapRelationship->getMap(), '/map/edit?id='.$placeMapRelationship->getMapId()) ?>
  <?php else: ?>
  <?php echo object_select_tag($placeMapRelationship, 'getMapId', array (
  'related_class' => 'Map',
  'include_blank' => true,
)) ?>
   <?php endif; ?>
</td>
</tr>

<tr>
  <th><?php echo __('place'); ?>:</th>
  <td>
  <?php if ($placeMapRelationship->getPlaceId()): ?>
  <?php echo object_input_hidden_tag($placeMapRelationship, 'getPlaceId') ?>
  <?php echo link_to($placeMapRelationship->getPlace(), '/place/edit?id='.$placeMapRelationship->getPlaceId()) ?>
  <?php else: ?>
  <?php echo object_select_tag($placeMapRelationship, 'getPlaceId', array (
  'related_class' => 'Place',
  'include_blank' => true,
)) ?>
   <?php endif; ?>
</td>
</tr>

<tr>
  <th><?php echo __('icon image'); ?>:</th>
  <td><?php echo object_select_tag($placeMapRelationship, 'getMapIconImageId', array (
  'related_class' => 'digitalObject',
  'include_blank' => true,
)) ?></td>
</tr>
<tr>
  <th><?php echo __('icon description'); ?>:</th>
  <td><?php echo object_textarea_tag($placeMapRelationship, 'getMapIconDescription', array (
  'size' => '30x3',
)) ?></td>
</tr>
<tr>
  <th><?php echo __('note'); ?>:</th>
  <td><?php echo object_textarea_tag($placeMapRelationship, 'getRelationshipNote', array (
  'size' => '30x3',
)) ?></td>
</tr>
</tbody>
</table>

<div class="menu-action">
<?php if ($placeMapRelationship->getId()): ?>
  &nbsp;<?php echo link_to(__('delete'), 'map/deletePlaceMapRelationship?id='.$placeMapRelationship->getId(), 'post=true&confirm='.__('are you sure?')) ?>
  &nbsp;<?php echo link_to(__('cancel'), 'map/edit?id='.$placeMapRelationship->getMapId()) ?>
<?php else: ?>
  &nbsp;
  <?php if ($placeMapRelationship->getMapId()): ?>
    <?php echo link_to(__('cancel'), 'map/edit?id='.$placeMapRelationship->getMapId()) ?>
  <?php else: ?>
    <?php echo link_to(__('cancel'), 'map/list') ?>
  <?php endif; ?>
<?php endif; ?>
<?php echo my_submit_tag(__('save'), array('style' => 'width: auto;')) ?>
</form>
</div>
