<h1><?php echo __('List functions') ?></h1>

<table class="list">
<thead>
  <tr>
    <th>
      <?php echo __('Name') ?>
      <?php if (QubitAcl::check(new QubitFunction, 'create')): ?>
        <span class="th-link"><?php echo link_to(__('Add new'), array('module' => 'function', 'action' => 'create')) ?></span>
      <?php endif; ?>
    </th>
    <th><?php echo __('Updated') ?></th>
  </tr>
</thead>

<tbody>
<?php foreach ($pager->getResults() as $func): ?>
  <tr>
    <td>
    <?php if (QubitAcl::check($func, 'update')): ?>
      <?php echo link_to(render_title($func->getAuthorizedFormOfName(array('cultureFallback' => true))), array($func, 'module' => 'function')) ?>
    <?php else: ?>
      <?php echo link_to(render_title($func->getAuthorizedFormOfName(array('cultureFallback' => true))), array($func, 'module' => 'function')) ?>
    <?php endif; ?>
    </td>
    <td>
      <?php echo $func->updatedAt ?>
    </td>
  </tr>
<?php endforeach; ?>
</tbody>
</table>

<?php echo get_partial('default/pager', array('pager' => $pager)) ?>
