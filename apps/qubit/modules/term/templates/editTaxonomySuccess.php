<div class="pageTitle"><?php echo __('add/edit %1% term', array('%1%' =>$taxonomy->getName())); ?></div>

<?php echo form_tag('term/update?taxonomy_id='.$term->getTaxonomyId()) ?>

<?php echo object_input_hidden_tag($term, 'getId') ?>
<?php echo input_hidden_tag('taxonomy_id', $taxonomy->getId()) ?>

<table class="detail">
<tbody>

<tr><td colspan="2" class="headerCell">
<?php if (!$term->getName()): ?>
  <?php echo $term->getName(array('sourceCulture' => true)); ?>
<?php else: ?>
  <?php echo $term->getName(); ?>
<?php endif; ?>
</td></tr>
</table>
    <div class="form-item">
      <label for="term name"><?php echo __('term name'); ?></label>
      <?php if (strlen($sourceCultureValue = $term->getName(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $term->getSourceCulture()): ?>
      <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_input_tag($term, 'getName', array ('size' => 80)) ?>
    </div>

    <div class="form-item">
     <label for="taxonomy"><?php echo __('taxonomy'); ?></label>
    <?php echo $taxonomy->getName(array('cultureFallback' => 'true')) ?>
    </div>

    <div class="form-item">
      <label for="code"><?php echo __('code'); ?></label>
      <?php echo object_input_tag($term, 'getCode', array ('size' => 20)) ?>
    </div>

    <div class="form-item">
      <label for="scope note"><?php echo __('scope note'); ?></label>
      <?php if ($scopeNotes): ?>
        <?php foreach ($scopeNotes as $scopeNote): ?>
          <?php echo $scopeNote->getContent(array('cultureFallback' => 'true')) ?>
          <?php echo link_to(image_tag('delete', 'align=top'), 'term/deleteNote?noteId='.$scopeNote->getId()) ?><br />
        <?php endforeach; ?>
      <?php endif; ?>

      <?php echo input_tag('new_scope_note') ?>
    </div>

    <div class="form-item">
      <label for="source note"><?php echo __('source note'); ?></label>
       <?php if ($sourceNotes): ?>
        <?php foreach ($sourceNotes as $sourceNote): ?>
          <?php echo $sourceNote->getContent(array('cultureFallback' => 'true')) ?>
          <?php echo link_to(image_tag('delete', 'align=top'), 'term/deleteNote?noteId='.$sourceNote->getId()) ?><br />
        <?php endforeach; ?>
      <?php endif; ?>

      <?php echo input_tag('new_source_note') ?>
    </div>

    <div class="form-item">
      <label for="display note"><?php echo __('display note'); ?></label>
       <?php if ($displayNotes): ?>
        <?php foreach ($displayNotes as $displayNote): ?>
          <?php echo $displayNote->getContent(array('cultureFallback' => 'true')) ?>
          <?php echo link_to(image_tag('delete', 'align=top'), 'term/deleteNote?noteId='.$displayNote->getId()) ?><br />
        <?php endforeach; ?>
      <?php endif; ?>

      <?php echo input_tag('new_display_note') ?>
    </div>

<!-- include empty div at bottom of form to bump the fixed button-block and allow user to scroll past it -->
<div id="button-block-bump"></div>

<div id="button-block">

<div class="menu-action">
<?php if ($term->getId()): ?>
  &nbsp;<?php echo link_to(__('delete'), 'term/delete?id='.$term->getId().'&taxonomyId='.$term->getTaxonomyId(), 'post=true&confirm='.__('are you sure?')) ?>
  &nbsp;<?php echo link_to(__('cancel'), 'term/list?taxonomyId='.$term->getTaxonomyId()) ?>
<?php else: ?>
  &nbsp;<?php echo link_to(__('cancel'), 'term/list?taxonomyId='.$term->getTaxonomyId()) ?>
<?php endif; ?>
<?php if ($term->getId()): ?>
  <?php echo my_submit_tag(__('save'), array('style' => 'width: auto;')) ?>
<?php else: ?>
  <?php echo my_submit_tag(__('create'), array('style' => 'width: auto;')) ?>
<?php endif; ?>
</div>

<?php if ($term->getId()): ?>
  <div class="menu-extra">
    <?php echo link_to(__('add new %1%', array('%1%' =>$taxonomy->getName())), 'term/create?taxonomyId='.$term->getTaxonomyId()) ?>
  </div>
<?php endif; ?>

<div class="menu-extra">
<?php echo link_to(__('list all taxonomies'), 'term/list?taxonomyId=0') ?>
<?php if ($term->getTaxonomyId()): ?>
  <?php echo link_to(__('list only %1%', array('%1%' => $taxonomy->getName(array('cultureFallback' => 'true')))), 'term/list?taxonomyId='.$term->getTaxonomyId()) ?>
<?php endif; ?>
</div>
</div>

</form>
