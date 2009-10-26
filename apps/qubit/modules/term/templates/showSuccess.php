<div class="pageTitle"><?php echo __('view term') ?></div>

<table class="detail">
<tbody>
<?php if ($term->getName(array('sourceCulture' => true))): ?>
  <tr><td colspan="2" class="headerCell">
  <?php if ($editCredentials) echo link_to($term->getName(array('cultureFallback' => true)), 'term/edit/?id='.$term->getId());
        else echo $term->getName(); ?>
  </td></tr>
<?php endif; ?>

<tr>
  <th><?php echo __('taxonomy') ?></th>
  <td><?php echo $term->getTaxonomy() ?></td>
</tr>

<?php if (0 < strlen($term->getCode())): ?>
<tr>
  <th><?php echo __('code') ?></th>
  <td><?php echo $term->getCode() ?></td>
</tr>
<?php endif; ?>

<?php if (0 < count($scopeNotes)): ?>
<tr>
  <th><?php echo __('scope note(s)') ?></th>
  <td>
    <ul>
      <?php foreach ($scopeNotes as $scopeNote): ?>
        <li><?php echo $scopeNote->getContent(array('cultureFallback' => true)) ?></li>
      <?php endforeach; ?>
    </ul>
  </td>
</tr>
<?php endif; ?>

<?php if (0 < count($sourceNotes)): ?>
<tr>
  <th><?php echo __('source note(s)'); ?></th>
  <td>
      <ul>
        <?php foreach ($sourceNotes as $sourceNote): ?>
          <li><?php echo $sourceNote->getContent(array('cultureFallback' => true)) ?></li>
        <?php endforeach; ?>
      </ul>
  </td>
</tr>
<?php endif; ?>

<?php if (0 < count($displayNotes)): ?>
<tr>
  <th><?php echo __('display note(s)'); ?></th>
  <td>
      <ul>
        <?php foreach ($displayNotes as $displayNote): ?>
          <li><?php echo $displayNote->getContent(array('cultureFallback' => true)) ?></li>
        <?php endforeach; ?>
      </ul>
  </td>
</tr>
<?php endif; ?>

<?php if (0 < count($children) || QubitTerm::ROOT_ID != $term->parentId): ?>
<tr>
  <th><?php echo __('Hierarchical terms'); ?></th>
  <td>
    <?php if(QubitTerm::ROOT_ID != $term->parentId): ?>
    <?php $parent = $term->getParent() ?>
    <dl>
      <dt><?php echo mb_strtoupper($term->getName(array('cultureFallback' => true)), 'utf-8') ?></dt>
      <dd>
        <?php $parentName = mb_strtoupper($parent->getName(array('cultureFallback' => true)), 'utf-8') ?>
        <?php $parentLink = link_to($parentName, array('module' => 'term', 'action' => 'show', 'id' => $parent->getId())) ?>
        <?php echo __('BT %1%', array('%1%' => $parentLink)) ?>
      </dd>
    </dl>
    <?php endif; ?>
    <?php if(0 < count($children)): ?>
    <dl>
      <dt><?php echo mb_strtoupper($term->getName(array('cultureFallback' => true)), 'utf-8') ?></dt>
      <?php foreach ($children as $child): ?>
      <dd>
        <?php $childName = mb_strtoupper($child->getName(array('cultureFallback' => true)), 'utf-8') ?>
        <?php $childLink = link_to($childName, array('module' => 'term', 'action' => 'show', 'id' => $child->getId())) ?>
        <?php echo __('NT %1%', array('%1%' => $childLink)) ?>
      </dd>
      <?php endforeach; ?>
    </dl>
    <?php endif; ?>
  </td>
</tr>
<?php endif; ?>

<?php if (0 < count($uses) || 0 < count($useFors)): ?>
<tr>
  <th><?php echo __('Equivalent terms'); ?></th>
  <td>
  <?php if(0 < count($useFors)): ?>
    <dl>
      <dt><?php echo mb_strtoupper($term->getName(array('cultureFallback' => true)), 'utf-8') ?></dt>
    <?php foreach ($useFors as $useFor): ?>
      <dd>
        <?php $relatedTermName = mb_strtoupper($useFor->getObject()->getName(array('cultureFallback' => true)), 'utf-8') ?>
        <?php $relatedTermLink = link_to($relatedTermName, array('module' => 'term', 'action' => 'show', 'id' => $useFor->getObjectId())) ?>
        <?php echo __('UF %1%', array('%1%' => $relatedTermLink)) ?>
      </dd>
    <?php endforeach; ?>
    </dl>
  <?php endif; ?>
  <?php if(0 < count($uses)): ?>
    <dl>
    <?php foreach ($uses as $use): ?>
      <dt><?php echo mb_strtoupper($term->getName(array('cultureFallback' => true)), 'utf-8') ?></dt>
      <dd>
        <?php $relatedTermName = mb_strtoupper($use->getSubject()->getName(array('cultureFallback' => true)), 'utf-8') ?>
        <?php $relatedTermLink = link_to($relatedTermName, array('module' => 'term', 'action' => 'show', 'id' => $use->getSubjectId())) ?>
        <?php echo __('USE %1%', array('%1%' => $relatedTermLink)) ?>
      </dd>
    <?php endforeach; ?>
    </dl>
  <?php endif; ?>
  </td>
</tr>
<?php endif; ?>

<?php if (0 < count($associateRelations)): ?>
<tr>
  <th><?php echo __('Associated terms'); ?></th>
  <td>
    <dl>
      <dt><?php echo mb_strtoupper($term->getName(array('cultureFallback' => true)), 'utf-8') ?></dt>
    <?php foreach ($associateRelations as $associateRelation): ?>
      <dd>
        <?php $associate = $associateRelation->getOpposedObject($term->id) ?>
        <?php $associateName = mb_strtoupper($associate->getName(array('cultureFallback' => true)), 'utf-8') ?>
        <?php $associateLink = link_to($associateName, array('module' => 'term', 'action' => 'show', 'id' => $associate->getId())) ?>
        <?php echo __('RT %1%', array('%1%' => $associateLink)) ?>
      </dd>
    <?php endforeach; ?>
    </dl>
  </td>
</tr>
<?php endif; ?>

</tbody>
</table>

<?php
  $deleteConfirm = '';
  if (0 < $descendantCount) {
    $deleteConfirm .= __('Deleting this term will also delete %1% descendants.\n', array('%1%' => $descendantCount));
  }
  if($relatedEventCount > 0)
  {
    $deleteConfirm .= __('Deleting this term will delete %1% related events.\n', array('%1%' => $relatedEventCount));
  }
  if ($relatedObjectCount > 0)
  {
    $deleteConfirm .= __('Deleting this term will remove it from %1% descriptions.\n', array('%1%' => $relatedObjectCount));
  }
  $deleteConfirm .= __('Are you sure?');
?>

<ul class="actions">
  <?php if ($editCredentials): ?>
    <li><?php echo link_to (__('Edit'), array('module' => 'term', 'action' => 'edit', 'id' => $term->id)) ?></li>
  <?php endif; ?>
  <?php if ($editCredentials && !$term->isProtected()): ?>
    <li><?php echo link_to (__('Delete'), array('module' => 'term', 'action' => 'delete', 'id' => $term->id), array('post' => true, 'confirm' => $deleteConfirm)) ?></li>
  <?php endif; ?>
  <div class="menu-extra">
  <?php if ($editCredentials): ?>
    <li><?php echo link_to(__('Add New'), array('module' => 'term', 'action' => 'create', 'taxonomyId' => $term->getTaxonomy()->id)) ?></li><?php endif; ?>
  <li><?php echo link_to(__('List all'), array('module' => 'term', 'action' => 'list', 'taxonomyId' => $term->getTaxonomy()->id)) ?></li>
  </div>
</ul>
