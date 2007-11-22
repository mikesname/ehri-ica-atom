<div class="pageTitle"><?php echo __('list').' '.$taxonomyName.' '.__('terms'); ?></div>

<table class="list">
<thead>
<tr>

  <th>
  <?php if ($sort == 'termNameUp'): ?>
    <?php echo link_to($taxonomyName.' '.__('term'), 'term/list?taxonomyId='.$taxonomyId.'&sort=termNameDown') ?>
    <?php echo image_tag('up.gif', 'style="padding-bottom: 3px;"', 'sort up') ?>
  <?php else: ?>
    <?php echo link_to($taxonomyName.' '.__('term'), 'term/list?taxonomyId='.$taxonomyId.'&sort=termNameUp') ?>
  <?php endif; ?>

  <?php if ($sort == 'termNameDown'): ?>
    <?php echo image_tag('down.gif', 'style="padding-bottom: 3px;"', 'sort down') ?>
  <?php endif; ?>

  <?php if ($editCredentials): ?>
	<span class="th-link">(<?php echo link_to(__('add').' '.__('new'), 'term/create?taxonomyId='.$taxonomyId); ?>)</span>
  <?php endif; ?>

  </th>

  <th>
  <?php if ($sort == 'sourceUp'): ?>
    <?php echo link_to(__('source'), 'term/list?taxonomyId='.$taxonomyId.'&sort=sourceDown') ?>
    <?php echo image_tag('up.gif', 'style="padding-bottom: 3px;"', 'sort up') ?>
  <?php else: ?>
    <?php echo link_to(__('source'), 'term/list?taxonomyId='.$taxonomyId.'&sort=sourceUp') ?>
  <?php endif; ?>

  <?php if ($sort == 'sourceDown'): ?>
    <?php echo image_tag('down.gif', 'style="padding-bottom: 3px;"', 'sort down') ?>
  <?php endif; ?>
  </th>

  <th style="width:45px;">
  <?php if ($sort == 'sortOrderUp'): ?>
    <?php echo link_to(__('sort'), 'term/list?taxonomyId='.$taxonomyId.'&sort=sortOrderDown') ?>
    <?php echo image_tag('up.gif', 'style="padding-bottom: 3px;"', 'sort up') ?>
  <?php else: ?>
    <?php echo link_to(__('sort'), 'term/list?taxonomyId='.$taxonomyId.'&sort=sortOrderUp') ?>
  <?php endif; ?>

  <?php if ($sort == 'sortOrderDown'): ?>
    <?php echo image_tag('down.gif', 'style="padding-bottom: 3px;"', 'sort down') ?>
  <?php endif; ?>


  </th>
</tr>
</thead>
<tbody>
<?php foreach ($terms as $term): ?>
<tr>
      <td><?php echo link_to($term->getTermName(), 'term/edit?id='.$term->getId().'&taxonomyId='.$taxonomyId) ?></td>
      <td><?php echo $term->getSource() ?></td>
      <td><?php echo $term->getSortOrder() ?></td>
  </tr>
<?php endforeach; ?>
</tbody>
</table>


<?php if ($editCredentials)
  {
  echo '<div class="menu-action">'.link_to(__('add').' '.__('new').' '.$taxonomyName.' '.__('term'), 'term/create?taxonomyId='.$taxonomyId).'</div>' ;
  }
?>

<?php if ($sf_context->getUser()->hasCredential('administrator')): ?>
  <div class="menu-extra">
  <?php echo link_to(__('list').' '.__('all').' '.__('terms'), 'term/list?taxonomyId=0') ?>
  </div>
<?php endif; ?>
