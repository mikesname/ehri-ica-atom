<div class="pageTitle">
<?php if (is_null($taxonomyName = $taxonomy->getName())) $taxonomyName = $taxonomy->getName(array('sourceCulture' => true)); ?>
  <?php echo __('list %taxonomy%', array('%taxonomy%' => $taxonomyName)) ?>
</div>

<table class="list"><thead><tr>
  <th>
    <?php if ($sort == 'termNameUp'): ?>
      <?php echo link_to($taxonomyName, 'term/browse?taxonomyId='.$taxonomy->getId().'&sort=termNameDown') ?>
      <!-- hide sort option until it is working...
      <?php echo image_tag('up.gif', 'style="padding-bottom: 3px;"', 'sort up') ?>
      -->
    <?php else: ?>
      <?php echo link_to($taxonomyName, 'term/browse?taxonomyId='.$taxonomy->getId().'&sort=termNameUp') ?>
    <?php endif; ?>
    <?php if ($sort == 'termNameDown'): ?>
      <!-- hide sort option until it is working...
      <?php echo image_tag('down.gif', 'style="padding-bottom: 3px;"', 'sort down') ?>
      -->
    <?php endif; ?>
    <?php if ($editCredentials): ?>
      <span class="th-link"><?php echo link_to(__('add/edit'), 'term/list?taxonomyId='.$taxonomy->getId()); ?></span>
    <?php endif; ?>
  </th><th>
    <?php if ($sort == 'hitsUp'): ?>
      <?php echo link_to(__('results'), 'term/browse?taxonomyId='.$taxonomy->getId().'&sort=hitsDown') ?>
      <!-- hide sort option until it is working...
      <?php echo image_tag('up.gif', 'style="padding-bottom: 3px;"', 'sort up') ?>
      -->
    <?php else: ?>
      <?php echo link_to(__('results'), 'term/browse?taxonomyId='.$taxonomy->getId().'&sort=hitsUp') ?>
    <?php endif; ?>
    <?php if ($sort == 'hitsDown'): ?>
      <!-- hide sort option until it is working...
      <?php echo image_tag('down.gif', 'style="padding-bottom: 3px;"', 'sort down') ?>
      -->
    <?php endif; ?>
  </th>
</tr></thead><tbody><?php foreach ($terms as $term): ?><tr>
  <td>
    <?php echo link_to($term['termName'], 'term/browse?termId='.$term['termId']) ?>
  </td><td>
    <?php echo $term['hits'] ?>
  </td>
</tr><?php endforeach; ?></tbody></table>
