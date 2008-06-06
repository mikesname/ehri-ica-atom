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
  <?php foreach ($terms = $taxonomy->getTerms() as $term): ?>
    <tr>
    <?php if (is_null($termName = $term->getName())) $termName = $term->getName(array('sourceCulture' => true)); ?>
      <td><?php if (!$term->isProtected()): ?>
        <?php echo link_to($termName, 'term/edit?id='.$term->getId().'&taxonomyId='.$taxonomyId) ?>
      <?php else: ?>
            <?php echo $termName.' '.link_to(image_tag('lock_mini', 'align=top'), 'admin/termPermission') ?>
    <?php endif; ?>
      </td>
      <td>
    <?php if (is_null($scopeNote = $term->getScopeNote())) $scopeNote = $term->getScopeNote(array('sourceCulture' => true)); ?>
      <?php echo $scopeNote ?>
      </td></tr>
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
