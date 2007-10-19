<div class="pageTitle"><?php echo __('list').' '.__('people').' / '.__('organizations'); ?></div>

<table class="list">
<thead>
<tr>
    <th><?php if ($sort == 'nameUp'): ?>
    <?php echo link_to(__('name'), 'actor/list?role='.$role.'&sort=nameDown') ?>
    <?php echo image_tag('up.gif', 'style="padding-bottom: 3px;"', 'sort up') ?>
  <?php else: ?>
    <?php echo link_to(__('name'), 'actor/list?role='.$role.'&sort=nameUp') ?>
  <?php endif; ?>

  <?php if ($sort == 'nameDown'): ?>
    <?php echo image_tag('down.gif', 'style="padding-bottom: 3px;"', 'sort down') ?>
  <?php endif; ?>

  <?php if ($editCredentials): ?>
	<span class="th-link">(<?php echo link_to(__('add').' '.__('new'), 'actor/create'); ?>)</span>
  <?php endif; ?>

  </th>

  <th>
  <?php if ($sort == 'typeDown'): ?>
    <?php echo link_to(__('type'), 'actor/list?role='.$role.'&sort=typeUp') ?>
    <?php echo image_tag('down.gif', 'style="padding-bottom: 3px;"', 'sort down') ?>
  <?php else: ?>
    <?php echo link_to(__('type'), 'actor/list?role='.$role.'&sort=typeDown') ?>
  <?php endif; ?>

  <?php if ($sort == 'typeUp'): ?>
    <?php echo image_tag('up.gif', 'style="padding-bottom: 3px;"', 'sort up') ?>
  <?php endif; ?>
  </th>


</tr>
</thead>
<tbody>
<?php foreach ($actors as $actor): ?>
<tr>
      <td><div style="padding-left: 17px;" <?php if ($actor->hasChildren()) { echo 'class="plus"'; } ?>>
          <?php if ($editCredentials)
            {
            echo link_to($actor->getAuthorizedFormOfName(), 'actor/show?id='.$actor->getId());
            }
          else
            {
            echo link_to($actor->getAuthorizedFormOfName(), 'actor/show?id='.$actor->getId());
            } ?>
       </div></td>
      <td><?php echo $actor->getTypeOfEntity() ?></td>
  </tr>
<?php endforeach; ?>
</tbody>
</table>

<?php if ($editCredentials)
  {
  echo '<div class="menu-action">'.link_to(__('add').' '.__('new'), 'actor/create').'</div>';
  }
?>
