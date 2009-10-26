<div class="pageTitle"><?php echo __('list %1%', array('%1%' =>$taxonomy->getName(array('cultureFallback' => true)))); ?></div>

<table class="list">
<thead>
<tr>
  <th>
    <?php echo __('%1% term', array('%1%' =>$taxonomy->getName(array('cultureFallback' => true)))); ?>
    <?php if ($editCredentials): ?>
      <span class="th-link"><?php echo link_to(__('add new'), 'term/create?taxonomyId='.$taxonomy->getId()); ?></span>
    <?php endif; ?>
  </th>
  <th><?php echo __('scope note') ?></th>
</tr>
</thead>
<tbody>
  <?php foreach($hitlist->getResults() as $term): ?>
  <tr>
    <td>
      <?php echo link_to($term->getName(array('cultureFallback' => true)),
        array('module' => 'term', 'action' => 'show', 'id' => $term->getId())) ?>
      <?php if (0 < count($term->descendants)): ?>
        <span class="note2">(<?php echo count($term->descendants) ?>)</span>
      <?php endif; ?>
      <?php echo ($term->isProtected()) ? image_tag('lock_mini') : '' ?>
    </td>
    <td>
      <?php if (0 < count($scopeNotes = $term->getNotesByType(array('noteTypeId' => QubitTerm::SCOPE_NOTE_ID)))): ?>
      <ul>
        <?php foreach ($scopeNotes as $scopeNote): ?>
          <li><?php echo $scopeNote->getContent(array('cultureFallback' => 'true')) ?></li>
        <?php endforeach; ?>
      </ul>
      <?php endif; ?>
    </td>
  </tr>

  <?php $prevTerm = $term; ?>
<?php endforeach; ?>
</tbody>
</table>

<?php echo get_partial('default/pager', array('pager' => $hitlist)) ?>

<?php if ($editCredentials): ?>
<div style="height: 40px"><!-- Make room to scroll past floating menu --></div>
<ul class="actions">
  <br /><div class="menu-extra">
  <li><?php echo link_to(__('List all taxonomies'), 'term/list') ?>
  </div>
</ul>
<?php endif; ?>
