
<div class="pageTitle">list <?php echo $taxonomyName ?> terms</div>

<table class="list">
<thead>
<tr>

  <th>
  <?php if($sort == 'termNameUp'): ?>
    <?php echo link_to($taxonomyName.' term', 'term/browse?taxonomyId='.$taxonomyId.'&sort=termNameDown') ?>
    <?php echo image_tag('up.gif', 'style="padding-bottom: 3px;"', 'sort up') ?>
  <?php else: ?>
    <?php echo link_to($taxonomyName.' term', 'term/browse?taxonomyId='.$taxonomyId.'&sort=termNameUp') ?>
  <?php endif; ?>

  <?php if($sort == 'termNameDown'): ?>
    <?php echo image_tag('down.gif', 'style="padding-bottom: 3px;"', 'sort down') ?>
  <?php endif; ?>

  <?php if ($editCredentials): ?>
	<span class="th-link">(<?php echo link_to(__('add').' / '.__('edit'), 'term/list?taxonomyId='.$taxonomyId); ?>)</span>
  <?php endif; ?>

  </th>

  <th>
  <?php if($sort == 'hitsUp'): ?>
    <?php echo link_to(__('hits'), 'term/browse?taxonomyId='.$taxonomyId.'&sort=hitsDown') ?>
    <?php echo image_tag('up.gif', 'style="padding-bottom: 3px;"', 'sort up') ?>
  <?php else: ?>
    <?php echo link_to(__('hits'), 'term/browse?taxonomyId='.$taxonomyId.'&sort=hitsUp') ?>
  <?php endif; ?>

  <?php if($sort == 'hitsDown'): ?>
    <?php echo image_tag('down.gif', 'style="padding-bottom: 3px;"', 'sort down') ?>
  <?php endif; ?>
  </th>

</tr>
</thead>
<tbody>
<?php foreach ($terms as $term): ?>
<tr>
      <td><?php echo link_to($term['termName'], 'term/browse?termId='.$term['termId']) ?></td>
      <td><?php echo $term['hits'] ?></td>
  </tr>
<?php endforeach; ?>
</tbody>
</table>