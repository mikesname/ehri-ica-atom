<div class="pageTitle"><?php echo __('list taxonomies'); ?></div>

<table class="list">
<thead>
  <tr>
    <th style="width: 40%"><?php echo __('name'); ?></th>
    <th style="width: 60%"><?php echo __('note') ?></th>
  </tr>
<tbody>
<?php foreach ($hitlist->getResults() as $taxonomy): ?>
  <tr>
    <td>
      <?php echo link_to($taxonomy->getName(array('cultureFallback' => true)), 
        array('module' => 'term', 'action' => 'list', 'taxonomyId' => $taxonomy->getId())) ?>
    </td>
    <td>
      <?php echo $taxonomy->getNote(array('cultureFallback' => true)) ?>
    </td>
  </tr>
<?php endforeach; ?>
</tbody>
</table>

<?php echo get_partial('default/pager', array('pager' => $hitlist)) ?>
