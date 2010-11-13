<div class="pageTitle"><?php echo __('Edit place -> map relation'); ?></div>

<?php echo form_tag('map/updatePlaceMapRelation') ?>

<?php echo object_input_hidden_tag($placeMapRelation, 'getId') ?>

<table class="detail" width="98%">
<tbody>

<tr><th colspan="2"><?php echo __('Map marker'); ?></th></tr>

<tr>
  <th><?php echo __('Map'); ?></th>
  <td>
  <?php if ($placeMapRelation->getMapId()): ?>
  <?php echo object_input_hidden_tag($placeMapRelation, 'getMapId') ?>
  <?php echo link_to($placeMapRelation->getMap(), '/map/edit?id='.$placeMapRelation->getMapId()) ?>
  <?php else: ?>
  <?php echo object_select_tag($placeMapRelation, 'getMapId', array(
  'related_class' => 'Map',
  'include_blank' => true,
)) ?>
   <?php endif; ?>
</td>
</tr>

<tr>
  <th><?php echo __('Place'); ?></th>
  <td>
  <?php if ($placeMapRelation->getPlaceId()): ?>
  <?php echo object_input_hidden_tag($placeMapRelation, 'getPlaceId') ?>
  <?php echo link_to($placeMapRelation->getPlace(), '/place/edit?id='.$placeMapRelation->getPlaceId()) ?>
  <?php else: ?>
  <?php echo object_select_tag($placeMapRelation, 'getPlaceId', array(
  'related_class' => 'Place',
  'include_blank' => true,
)) ?>
   <?php endif; ?>
</td>
</tr>

<tr>
  <th><?php echo __('Icon image'); ?></th>
  <td><?php echo object_select_tag($placeMapRelation, 'getMapIconImageId', array(
  'related_class' => 'digitalObject',
  'include_blank' => true,
)) ?></td>
</tr>
<tr>
  <th><?php echo __('Icon description'); ?></th>
  <td><?php echo object_textarea_tag($placeMapRelation, 'getMapIconDescription', array(
  'size' => '30x3',
)) ?></td>
</tr>
<tr>
  <th><?php echo __('Note'); ?></th>
  <td><?php echo object_textarea_tag($placeMapRelation, 'getRelationNote', array(
  'size' => '30x3',
)) ?></td>
</tr>
</tbody>
</table>

<div class="menu-action">
<?php if ($placeMapRelation->id): ?>
  &nbsp;<?php echo link_to(__('Delete'), 'map/deletePlaceMapRelation?id='.$placeMapRelation->id, 'post=true&confirm='.__('Are you sure?')) ?>
  &nbsp;<?php echo link_to(__('Cancel'), 'map/edit?id='.$placeMapRelation->getMapId()) ?>
<?php else: ?>
  &nbsp;
  <?php if ($placeMapRelation->getMapId()): ?>
    <?php echo link_to(__('Cancel'), 'map/edit?id='.$placeMapRelation->getMapId()) ?>
  <?php else: ?>
    <?php echo link_to(__('Cancel'), 'map/list') ?>
  <?php endif; ?>
<?php endif; ?>
    <?php if ($placeMapRelation->id): ?>
      <input class="form-submit" type="submit" value="<?php echo __('Save') ?>"/>
    <?php else: ?>
      <input class="form-submit" type="submit" value="<?php echo __('Create') ?>"/>
    <?php endif; ?>
</form>
</div>
