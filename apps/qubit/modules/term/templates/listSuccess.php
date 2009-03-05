<div class="pageTitle"><?php echo __('list taxonomy terms'); ?></div>

<table class="list" style="height: 25px;"><thead><tr><th></th></tr></table>

<?php foreach ($taxonomies as $taxonomy): ?>
  <fieldset class="collapsible collapsed" style="margin-top: 5px;">
  <legend><?php if (is_null($name = $taxonomy->getName())) $name = $taxonomy->getName(array('sourceCulture' => true)); echo $name ?></legend>
  <table class="list">
    <thead>
      <tr>
        <th><?php echo __('term')?></th>
        <th><?php echo __('scope note')?></th>
      </tr>
    </thead>
    <tbody>
  <?php $prevTerm = null; $indent = 0; $lastRgt = array(); ?>
  <?php foreach ($terms = $taxonomy->getTermsSorted('name') as $term): ?>
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
      <?php if ((count($scopeNotes = $term->getNotesByType($noteTypeId = QubitTerm::SCOPE_NOTE_ID, $exclude = null))) > 0): ?>
      <ul>
        <?php foreach ($scopeNotes as $scopeNote): ?>
          <li><?php echo $scopeNote->getContent(array('cultureFallback' => 'true')) ?></li>
        <?php endforeach; ?>
      </ul>
      <?php endif; ?>
      </td></tr>
    
    <?php $prevTerm = $term; ?>
  <?php endforeach; ?>

<tr><td></td><td><div class="menu-extra" style="float: right;"><?php echo link_to(__('add new %1%', array('%1%' =>$taxonomy->getName())), 'term/create?taxonomyId='.$taxonomy->getId()) ?></div></td></tr>

</tbody>
</table>

</fieldset>
<?php endforeach; ?>

<?php if ($editCredentials): ?>
  <div class="menu-action"><?php echo link_to(__('add new %1% term', array('%1%' =>$taxonomyName)), 'term/create?taxonomyId='.$taxonomyId)?>
  </div>
<?php endif; ?>
