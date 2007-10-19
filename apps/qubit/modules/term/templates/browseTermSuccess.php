

<div class="pageTitle">list <?php echo $taxonomyName ?> terms</div>
<table class="list">
<thead>
<tr><th class="header" colspan="3"><?php echo $term ?></th></tr>

<tr>

  <th>
  <?php if($sort == 'titleUp'): ?>
    <?php echo link_to(__('title'), 'term/browse?termId='.$termId.'&sort=titleDown') ?>
    <?php echo image_tag('up.gif', 'style="padding-bottom: 3px;"', 'sort up') ?>
  <?php else: ?>
    <?php echo link_to(__('title'), 'term/browse?termId='.$termId.'&sort=titleUp') ?>
  <?php endif; ?>

  <?php if($sort == 'titleDown'): ?>
    <?php echo image_tag('down.gif', 'style="padding-bottom: 3px;"', 'sort down') ?>
  <?php endif; ?>
  </th>

  <th>
  <?php if($sort == 'collectionUp'): ?>
    <?php echo link_to(__('collection'), 'term/browse?termId='.$termId.'&sort=collectionDown') ?>
    <?php echo image_tag('up.gif', 'style="padding-bottom: 3px;"', 'sort up') ?>
  <?php else: ?>
    <?php echo link_to(__('collection'), 'term/browse?termId='.$termId.'&sort=collectionUp') ?>
  <?php endif; ?>

  <?php if($sort == 'collectionDown'): ?>
    <?php echo image_tag('down.gif', 'style="padding-bottom: 3px;"', 'sort down') ?>
  <?php endif; ?>
  </th>

  <th>
  <?php if($sort == 'repositoryUp'): ?>
    <?php echo link_to(__('repository'), 'term/browse?termId='.$termId.'&sort=repositoryDown') ?>
    <?php echo image_tag('up.gif', 'style="padding-bottom: 3px;"', 'sort up') ?>
  <?php else: ?>
    <?php echo link_to(__('repository'), 'term/browse?termId='.$termId.'&sort=repositoryUp') ?>
  <?php endif; ?>

  <?php if($sort == 'repositoryDown'): ?>
    <?php echo image_tag('down.gif', 'style="padding-bottom: 3px;"', 'sort down') ?>
  <?php endif; ?>
  </th>

</tr>
</thead>
<tbody>
<?php foreach ($informationObjects as $informationObject): ?>
<tr>
      <td><?php echo link_to($informationObject['title'], 'informationobject/show?id='.$informationObject['informationObjectId']) ?></td>
      <td><?php if($informationObject['collectionId'])
          {
          echo link_to($informationObject['collectionName'], 'informationobject/show?id='.$informationObject['collectionId']);
          }
          ?>
      </td>
      <td><?php if($informationObject['repositoryId'])
          {
          echo link_to($informationObject['repositoryName'], 'repository/show?id='.$informationObject['repositoryId']);
          }
          ?></td>
  </tr>
<?php endforeach; ?>
</tbody>
</table>

<div class="menu-extra">
	<?php echo link_to(__('browse').' '.__('all').' '.$taxonomyName.' terms', 'term/browse?taxonomyId='.$taxonomyId); ?>
</div>