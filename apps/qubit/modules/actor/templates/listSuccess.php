<div class="pageTitle"><?php echo __('list %1%', array('%1%' => sfConfig::get('app_ui_label_actor'))) ?></div>

<table class="list">
<thead>
  <tr>
    <th>
      <?php echo __('name'); ?>
      <?php if (SecurityPriviliges::editCredentials($sf_user, 'actor')): ?>
        <span class="th-link"><?php echo link_to(__('add new'), array('module' => 'actor', 'action' => 'create')) ?></span>
      <?php endif; ?>
    </th>
    <th><?php echo __('type'); ?></th>
  </tr>
</thead>
<tbody>
<?php foreach ($actors as $actor): ?>
  <tr>
    <td>
      <div><?php echo link_to(render_title($actor), array('module' => 'actor', 'action' => 'show', 'id' => $actor->id)) ?></div>
    </td>
    <td><?php echo $actor->entityType ?></td>
  </tr><?php endforeach; ?>
</tbody>
</table>

<?php echo get_partial('default/pager', array('pager' => $pager)) ?>

<div id="list-search">
  <form action="<?php echo url_for(array('module' => 'actor', 'action' => 'list')) ?>">
    <?php echo input_tag('query', $sf_request->query, array('class' => 'search')) ?>
    <?php echo submit_tag(__('search ').sfConfig::get('app_ui_label_actor')) ?>
  </form>
</div>
