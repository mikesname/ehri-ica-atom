<div class="pageTitle">
  <?php echo __('list %taxonomy%', array('%taxonomy%' => $taxonomy->getName(array('cultureFallback' => true)))) ?>
</div>

<table class="list">
<thead>
  <tr>
    <th>
      <?php if ($sort == 'termNameUp'): ?>
        <?php echo link_to($taxonomy->getName(array('cultureFallback' => true)), array('module' => 'term', 'action' => 'browse', 'taxonomyId' => $taxonomy->getId(), 'sort' => 'termNameDown')) ?>
        <?php echo image_tag('up.gif', 'style="padding-bottom: 3px;"', 'sort up') ?>
      <?php else: ?>
        <?php echo link_to($taxonomy->getName(array('cultureFallback' => true)), array('module' => 'term', 'action' => 'browse', 'taxonomyId' => $taxonomy->getId(), 'sort' => 'termNameUp')) ?>
      <?php endif; ?>
      <?php if ($sort == 'termNameDown'): ?>
        <?php echo image_tag('down.gif', 'style="padding-bottom: 3px;"', 'sort down') ?>
      <?php endif; ?>
      <?php if ($editCredentials): ?>
        <span class="th-link"><?php echo link_to(__('add/edit'), array('module' => 'term', 'action' => 'list', 'taxonomyId' => $taxonomy->getId())) ?></span>
      <?php endif; ?>
    </th>
    <th>
      <?php if ($sort == 'hitsDown'): ?>
        <?php echo link_to(__('results'), array('module' => 'term', 'action' => 'browse', 'taxonomyId' => $taxonomy->getId(), 'sort' => 'hitsUp')) ?>
        <?php echo image_tag('down.gif', 'style="padding-bottom: 3px;"', 'sort down') ?>
      <?php else: ?>
        <?php echo link_to(__('results'), array('module' => 'term', 'action' => 'browse', 'taxonomyId' => $taxonomy->getId(), 'sort' => 'hitsDown')) ?>
      <?php endif; ?>
      <?php if ($sort == 'hitsUp'): ?>
        <?php echo image_tag('up.gif', 'style="padding-bottom: 3px;"', 'sort up') ?>
      <?php endif; ?>
    </th>
  </tr>
</thead>
<tbody>
<?php foreach ($pager->getResults() as $term): ?>
  <tr>
    <td>
      <?php echo link_to($term->getName(array('cultureFallback'=>true)), array('module' => 'term', 'action' => 'browse', 'termId' => $term->getId())) ?>
    </td>
    <td>
      <?php echo $term->getObjectTermRelationCountByObjectClass('QubitInformationObject') ?>
    </td>
  </tr>
<?php endforeach; ?>
</tbody>
</table>

<?php echo get_partial('default/pager', array('pager' => $pager)) ?>
