<h1><?php echo __('List static pages') ?></h1>

<table class="sticky-enabled">
  <thead>
    <tr>
      <th>
        <?php echo __('Title') ?>
      </th><th>
        <?php echo __('Permalink') ?>
      </th>
    </tr>
  </thead><tbody>
    <?php foreach ($staticPages as $staticPage): ?>
      <tr class="<?php echo 0 == ++$row % 2 ? 'even' : 'odd' ?>">
        <td>
          <?php echo link_to($staticPage->title, array($staticPage, 'module' => 'staticpage')) ?>
        </td><td>
          <?php echo $staticPage->permalink ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php echo get_partial('default/pager', array('pager' => $pager)) ?>

<div class="actions section">

  <h2 class="element-invisible"><?php echo __('Actions') ?></h2>

  <div class="content">
    <ul class="clearfix links">
      <li><?php echo link_to(__('Add new'), array('module' => 'staticpage', 'action' => 'create')) ?></li>
    </ul>
  </div>

</div>
