<div class="pageTitle"><?php echo __('list %1%', array('%1%' =>$taxonomyName)); ?></div>

<table class="list">
<thead>
<tr>

  <th>
  <?php if ($sort == 'termNameUp'): ?>
    <?php echo link_to(__('%1% term', array('%1%' =>$taxonomyName)), 'term/list?taxonomyId='.$taxonomyId.'&sort=termNameDown') ?>
    <!-- disable sort until it is working...
    <?php echo image_tag('up.gif', 'style="padding-bottom: 3px;"', 'sort up') ?>
    -->
  <?php else: ?>
    <?php echo link_to(__('%1% term', array('%1%' =>$taxonomyName)), 'term/list?taxonomyId='.$taxonomyId.'&sort=termNameUp') ?>
  <?php endif; ?>

  <?php if ($sort == 'termNameDown'): ?>
    <!-- disable sort until it is working...
    <?php echo image_tag('down.gif', 'style="padding-bottom: 3px;"', 'sort down') ?>
    -->
  <?php endif; ?>

  <?php if ($editCredentials): ?>
  <span class="th-link"><?php echo link_to(__('add new'), 'term/create?taxonomyId='.$taxonomyId); ?></span>
  <?php endif; ?>
  </th>

   <th><?php echo __('scope note') ?></th>

</tr>
</thead>
<tbody>
<?php $prevTerm = null; $indent = 0; $lastRgt = array(); ?>
<?php foreach ($terms as $term): ?>
<?php if ($prevTerm && $term->getLft() > $prevTerm->getLft() && $term->getRgt() < $prevTerm->getRgt()): ?>
<?php $indent += 2; array_push($lastRgt, $prevTerm->getRgt()); ?>
<?php elseif (count($lastRgt) && $term->getRgt() > $lastRgt[count($lastRgt)-1]): ?>
<?php $indent -= 2; array_pop($lastRgt); ?>
<?php endif; ?>
  <tr>
    <?php if (is_null($termName = $term->getName())) $termName = $term->getName(array('sourceCulture' => true)); ?>
    <td>
      <?php echo str_repeat('&nbsp;', $indent); ?>
      <?php if (!$term->isProtected()): ?>
      <?php echo link_to($termName, 'term/edit?id='.$term->getId().'&taxonomyId='.$taxonomyId) ?>
      <?php else: ?>
      <?php echo $termName.' '.link_to(image_tag('lock_mini', 'align=top'), 'admin/termPermission') ?>
      <?php endif; ?>
    </td>
    <td>
      <?php if (is_null($scopeNote = $term->getScopeNote())) $scopeNote = $term->getScopeNote(array('sourceCulture' => true)); ?>
      <?php echo $scopeNote ?>
    </td>
  </tr>
  
  <?php $prevTerm = $term; ?>
<?php endforeach; ?>
</tbody>
</table>

<?php if ($editCredentials)
  {
  echo '<div class="menu-action">'.link_to(__('add new %1%', array('%1%' =>$taxonomyName)), 'term/create?taxonomyId='.$taxonomyId).'</div>' ;
  }
?>

<?php if ($sf_context->getUser()->hasCredential('administrator')): ?>
  <div class="menu-extra">
  <?php echo link_to(__('list all taxonomies'), 'term/list?taxonomyId=0') ?>
  </div>
<?php endif; ?>
