<table>
<caption><?php echo __('repository list') ?></caption>
<thead>
<tr><th><?php echo __('name') ?></th></tr>
</thead>
<tbody>
<?php foreach($repositories as $repository): ?>
<tr>
  <td>
    <?php echo link_to($repository->getAuthorizedFormOfName(array('cultureFallback' => true)), array('module' => 'repository', 'action' => 'show', 'id' => $repository->id)) ?>
  </td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
