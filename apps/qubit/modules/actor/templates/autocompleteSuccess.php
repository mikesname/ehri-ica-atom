<table>
<caption><?php echo __('actors') ?></caption>
<thead>
<tr><th><?php echo __('name') ?></th></tr>
</thead>
<tbody>
<?php foreach($actors as $actor): ?>
<tr>
  <td>
    <?php echo link_to($actor->getAuthorizedFormOfName(array('cultureFallback' => true)), array('module' => 'actor', 'action' => 'show', 'id' => $actor->id)) ?>
  </td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
