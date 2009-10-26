<?php include_partial('termNameAutoComplete', array('term' => $term))?>

<div class="pageTitle"><?php echo __('add/edit term'); ?></div>

<div class="formHeader">
<?php if(0 < $term->getId()): ?>
  <?php echo $term->getName(array('cultureFallback' => true)) ?>
<?php else: ?>
  <?php echo __('new term') ?>
<?php endif; ?>
</div>

<?php if (isset($sf_request->id)): ?>
<form method="post" action="<?php echo url_for(array('module' => 'term', 'action' => 'edit', 'id' => $sf_request->id)) ?>" id="editForm">
<?php else: ?>
<form method="post" action="<?php echo url_for(array('module' => 'term', 'action' => 'create', 'taxonomyId' => $term->getTaxonomy()->getId())) ?>" id="editForm">
<?php endif; ?>
  <fieldset class="collapsible">
    <legend><?php echo __('definition'); ?></legend>

    <div class="form-item">
      <label for="term name">
        <?php echo __('term name'); ?>
        <?php echo ($term->isProtected()) ? image_tag('lock_mini') : '' ?>
      </label>
      <?php if($term->isProtected()): ?>
        <?php echo object_input_tag($term, 'getName', array('class' => 'disabled', 'disabled' => 'disabled')) ?>
      <?php else: ?>
      <?php if (strlen($sourceCultureValue = $term->getName(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $term->getSourceCulture()): ?>
        <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
        <?php echo object_input_tag($term, 'getName', array ('size' => 80)) ?>
      <?php endif; ?>
    </div>

    <div class="form-item">
      <label for="taxonomy">
        <?php echo __('taxonomy'); ?>
      </label>
      <?php echo $term->getTaxonomy()->getName(array('cultureFallback' => 'true')) ?>
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
          <?php echo link_to(image_tag('delete', 'align=top'), array('module' => 'term', 'action' => 'deleteNote', 'noteId' => $scopeNote->getId())) ?><br />
        <?php endforeach; ?>
      <?php endif; ?>

      <?php echo input_tag('new_scope_note') ?>
    </div>

    <div class="form-item">
      <label for="source note"><?php echo __('source note'); ?></label>
       <?php if ($sourceNotes): ?>
        <?php foreach ($sourceNotes as $sourceNote): ?>
          <?php echo $sourceNote->getContent(array('cultureFallback' => 'true')) ?>
          <?php echo link_to(image_tag('delete', 'align=top'), array('module' => 'term', 'action' => 'deleteNote', 'noteId' => $sourceNote->getId())) ?><br />
        <?php endforeach; ?>
      <?php endif; ?>

      <?php echo input_tag('new_source_note') ?>

    <div class="form-item">
      <label for="display note"><?php echo __('display note'); ?></label>
       <?php if ($displayNotes): ?>
        <?php foreach ($displayNotes as $displayNote): ?>
          <?php echo $displayNote->getContent(array('cultureFallback' => 'true')) ?>
          <?php echo link_to(image_tag('delete', 'align=top'), array('module' => 'term', 'action' => 'deleteNote', 'noteId' => $displayNote->getId())) ?><br />
        <?php endforeach; ?>
      <?php endif; ?>

      <?php echo input_tag('new_display_note') ?>
    </div>
  </fieldset>

  <fieldset class="collapsible collapsed">
    <legend><?php echo __('relationships') ?></legend>

    <div class="form-item">
      <label for="display note"><?php echo __('broad term'); ?></label>
      <div id="broadTermAutoComplete" style="padding-bottom:2em; width:95%">
        <input id="parentId" type="hidden" name="parentId" value="<?php echo $term->parentId ?>" />
        <input id="broadTermAcInput" type="text" name="broadTerm" value="<?php echo $parent->getName(array('cultureFallback' => true)) ?>" />
        <div id="broadTermAcList"></div>
      </div>
    </div>

    <table class="inline" id="relatedTerms">
      <caption><?php echo __('related terms'); ?></caption>
      <tr>
        <th style="width: 50%"><?php echo __('related term'); ?></th>
        <th style="width: 40%"><?php echo __('relationship type'); ?></th>
        <th style="width: 10%; text-align: center"><?php echo image_tag('delete', array('align' => 'top', 'class' => 'deleteIcon')) ?></th>
      </tr>
      <?php if (0 < count($termRelations)): ?>
      <?php foreach ($termRelations as $termRelation): ?>
      <tr id="<?php echo 'relation_'.$termRelation->getId() ?>" class="<?php echo 'related_obj_'.$termRelation->getId() ?>">
        <td>
        <?php if ($termRelation->getObjectId() == $term->getId()): ?>
          <?php echo $termRelation->getSubject()->getName(array('cultureFallback' => true)) ?>
        <?php else: ?>
          <?php echo $termRelation->getObject()->getName(array('cultureFallback' => true)) ?>
        <?php endif; ?>
        </td>
        <td>
          <?php echo select_tag('related_term_type['.$termRelation->id.']',
            options_for_select($termRelationTypes, $relationTypeMatrix[$termRelation->id])) ?>
        </td>
        <td style="text-align: center">
          <input type="checkbox" name="deleteRelation[<?php echo $termRelation->id ?>]" value="delete" class="multiDelete" />
        </td>
      </tr>
      <?php endforeach; ?>
      <?php endif; ?>
      <tr id="newRelatedTerm0">
        <td>
          <div id="relatedTermAutoComplete" style="padding-bottom:2em; width:95%">
            <input id="relatedTermAcInput" type="text" name="new_related_term[0]" />
            <div id="relatedTermAcList"></div>
          </div>
        </td>
        <td>
          <?php echo select_tag('related_term_type[new0]', options_for_select($sf_data->getRaw('termRelationTypes'))) ?>
        </td>
        <td style="text-align: center">
          <button class="delete-small" onclick="deleteNewRtRow(0); return false;" />
        </td>
      </tr>
    </table>
  </fieldset>

<!-- include empty div at bottom of form to bump the fixed button-block and allow user to scroll past it -->
<div id="button-block-bump"></div>

<ul class="actions">
  <?php if ($term->getId()): ?>
    <li><?php echo link_to(__('Cancel'), array('module' => 'term', 'action' => 'show', 'id' => $term->id)) ?></li>
    <?php echo submit_tag(__('Save')) ?>
  <?php else: ?>
    <li><?php echo link_to(__('Cancel'), array('module' => 'term', 'action' => 'list', 'taxonomyId' => $term->taxonomyId)) ?></li>
    <?php echo submit_tag(__('Create')) ?>
  <?php endif; ?>
</ul>
