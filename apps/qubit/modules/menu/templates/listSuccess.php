<h1><?php echo __('Site menu list') ?></h1>

<table class="sticky-enabled" summary="<?php echo __('Hierarchical list of menus for the site, first column') ?>">
  <thead>
    <tr>
      <th>
        <?php echo __('Name') ?> <?php echo link_to(__('Add new'), array('module' => 'menu', 'action' => 'create')) ?>
      </th><th>
        <?php echo __('Label') ?>
      </th>
    </tr>
  </thead><tbody>
    <?php foreach ($menuTree as $menu): ?>
      <tr class="<?php echo 0 == ++$row % 2 ? 'even' : 'odd' ?>">
        <td<?php if (QUbitMenu::ROOT_ID == $menu['parentId']): ?> style="font-weight: bold"<?php endif; ?>>

          <?php echo str_repeat('&nbsp;&nbsp;', ($menu['depth'] - 1)) ?>

          <?php if (isset($menu['prev'])): ?>
            <?php echo link_to(image_tag('up.gif', array('alt' => __('Move up'))), array('module' => 'menu', 'action' => 'list', 'move' => $menu['id'], 'before' => $menu['prev']), array('title' => __('Move item up in list'))) ?>
          <?php else: ?>
            <?php echo image_tag('1x1_transparent', array('height' => '5', 'width' => '13')) ?>
          <?php endif; ?>

          <?php if (isset($menu['next'])): ?>
            <?php echo link_to(image_tag('down.gif', array('alt' => __('Move down'))), array('module' => 'menu', 'action' => 'list', 'move' => $menu['id'], 'after' => $menu['next']), array('title' => __('Move item down in list'))) ?>
          <?php else: ?>
            <?php echo image_tag('1x1_transparent', array('height' => '5', 'width'=>'13')) ?>
          <?php endif; ?>

          <?php if ($menu['protected']): ?>
            <?php echo link_to($menu['name'], array(QubitMenu::getById($menu['id']), 'module' => 'menu', 'action' => 'edit'), array('class' => 'readOnly', 'title' => __('Edit menu'))) ?>
          <?php else: ?>
            <?php echo link_to($menu['name'], array(QubitMenu::getById($menu['id']), 'module' => 'menu', 'action' => 'edit'), array('title' => __('Edit menu'))) ?>
          <?php endif; ?>

        </td><td>
          <?php echo $menu['label'] ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
