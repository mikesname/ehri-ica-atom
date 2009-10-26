<div class="pageTitle"><?php echo __('list %1%', array('%1%' => sfConfig::get('app_ui_label_repository'))) ?></div>

<table class="list">
<thead>
  <tr>
    <th>
      <?php echo __('name'); ?>
      <?php if (SecurityPriviliges::editCredentials($sf_user, 'repository')): ?>
        <span class="th-link"><?php echo link_to(__('add new'), array('module' => 'repository', 'action' => 'create')) ?></span>
      <?php endif; ?>
    </th>
    <th><?php echo __('type'); ?></th>
    <th><?php echo __('country') ?></th>
  </tr>
</thead>
<tbody>
<?php foreach ($repositories as $repository): ?>
<tr>
  <td>
    <?php echo link_to(render_title($repository), array('module' => 'repository', 'action' => 'show', 'id' => $repository->id)) ?>
  </td>
  <td>
    <?php echo $repository->type ?>
  </td>
  <td><?php echo $repository->getCountry() ?></td>
  </tr>
<?php endforeach; ?>
</tbody>
</table>

<?php echo get_partial('default/pager', array('pager' => $pager)) ?>

<div id="list-search">
  <form action="<?php echo url_for(array('module' => 'repository', 'action' => 'list')) ?>">
    <?php echo input_tag('query', $sf_request->query, array('class' => 'search')) ?>
    <?php echo submit_tag(__('search ').sfConfig::get('app_ui_label_repository')) ?>
  </form>
</div>
