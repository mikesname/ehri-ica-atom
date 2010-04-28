<h1><?php echo __('List taxonomies') ?></h1>

<table>
  <thead>
    <tr>
      <th><?php echo __('Name') ?></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($taxonomies as $taxonomy): ?>
    <tr class="<?php echo 0 == ++$row % 2 ? 'even' : 'odd' ?>">
      <td>
        <?php echo link_to(render_title($taxonomy), array($taxonomy, 'module' => 'taxonomy')) ?>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>