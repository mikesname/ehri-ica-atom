<table class="list" summary="<?php echo __('Hierarchical list of menus for the site, first column') ?>">
<caption><?php echo __('site menu list'); ?></caption>
<thead>
<tr>
  <th><?php echo __('name'); ?> <span class="th-link"><?php echo link_to(__('add new'), 'menu/create') ?></span></th>
  <th><?php echo __('label'); ?></th>
</tr>
</thead>
<tbody>
<?php foreach ($menuTree as $menu): ?>
  <?php if (!is_null($menu['prev'])): ?>
  <?php $up =  link_to(image_tag('up.gif', array('alt' => __('move up'))),
    'menu/list?move='.$menu['id'].'&before='.$menu['prev'].'&page='.$page, array('title'=> __('move item up in list'))) ?>
  <?php else: ?>
    <?php $up =  image_tag('1x1_transparent.png', array('height'=>'5', 'width'=>'13')) ?>
  <?php endif; ?>
  
  <?php if (!is_null($menu['next'])): ?>
  <?php $down =  link_to(image_tag('down.gif', array('alt' => __('move down'))),
    'menu/list?move='.$menu['id'].'&after='.$menu['next'].'&page='.$page, array('title'=> __('move item down in list'))) ?>
  <?php else: ?>
    <?php $down = image_tag('1x1_transparent.png', array('height'=>'5', 'width'=>'13')) ?>
  <?php endif; ?>
      
  <tr>
    <td>
      <?php $fontWeight = ($menu['parentId'] == QubitMenu::ROOT_ID) ? 'bold' : 'normal'; ?>
      <?php echo str_repeat('&nbsp;&nbsp;', ($menu['depth'] - 1)) ?>
      <?php echo $up ?><?php echo $down ?>
      <span style="font-weight: <?php echo $fontWeight ?>">
        <?php echo link_to($menu['name'], 'menu/edit?id='.$menu['id'].'&page='.$page, array('title'=> __('click to edit item'))) ?>
      </span>
      <?php if ($menu['protected']): ?>
        <?php echo image_tag('lock_mini', array('alt' => __('protected'))) ?>
      <?php endif; ?>
    </td>
    <td><?php echo $menu['label'] ?></td>
  </tr>
<?php endforeach; ?>
</tbody>
</table>
<div class="menu-action" style="padding-top: 10px;">
<?php echo link_to (__('add new menu'), 'menu/create') ?>
</div>