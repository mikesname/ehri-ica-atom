<table>
<caption><?php echo __('Repository list') ?></caption>
<thead>
<tr><th><?php echo __('Name') ?></th></tr>
</thead>
<tbody>
<?php foreach($repositories as $repository): ?>
<tr>
  <td>
    <?php echo link_to($repository->getAuthorizedFormOfName(array('cultureFallback' => true)), array($repository, 'module' => 'repository')) ?>
  </td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
