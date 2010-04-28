<h1><?php echo __('Search %1%', array('%1%' => sfConfig::get('app_ui_label_actor'))) ?></h1>

<table class="sticky-enabled">
  <thead>
    <tr>
      <th>
        <?php echo __('Name') ?>
      </th>
      <th>
        <?php echo __('Type') ?>
      </th>
    </tr>
  </thead><tbody>
    <?php foreach ($actors as $actor): ?>
      <tr class="<?php echo 0 == ++$row % 2 ? 'even' : 'odd' ?>">
        <td>
          <?php echo link_to(render_title($actor), array($actor, 'module' => 'actor')) ?>
        </td><td>
          <?php echo $actor->entityType ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php echo get_partial('default/pager', array('pager' => $pager)) ?>

<div class="search">
  <form action="<?php echo url_for(array('module' => 'actor', 'action' => 'list')) ?>">
    <?php echo input_tag('query', $sf_request->query) ?>
    <?php echo submit_tag(__('Search %1%', array('%1%' => sfConfig::get('app_ui_label_actor')))) ?>
  </form>
</div>
