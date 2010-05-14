<h1><?php echo (isset($sf_request->id)) ? __('Edit term') : __('Create term'); ?></h1>

<h1 class="label"><?php echo render_title($term) ?></h1>

<?php if (isset($sf_request->id)): ?>
  <?php echo $form->renderFormTag(url_for(array($term, 'module' => 'term', 'action' => 'edit'))) ?>
<?php else: ?>
  <?php echo $form->renderFormTag(url_for(array('module' => 'term', 'action' => 'create'))) ?>
<?php endif; ?>

  <?php echo $form->renderHiddenFields() ?>

  <fieldset class="collapsible">

    <legend><?php echo __('Definition') ?></legend>

    <div class="form-item">
      <?php echo $form->taxonomy->renderLabel() ?>
      <?php echo $form->taxonomy->render(array('class' => 'form-autocomplete')) ?>
      <input class="list" type="hidden" value="<?php echo url_for(array($term->taxonomy, 'module' => 'taxonomy', 'action' => 'autocomplete')) ?>"/>
    </div>

    <div class="form-item">

      <?php echo $form->name->renderLabel() ?><?php if ($term->isProtected()): ?><?php echo image_tag('lock_mini') ?><?php endif; ?>

      <?php if ($term->isProtected()): ?>
        <?php echo $form->name->render(array('class' => 'disabled', 'disabled' => 'disabled')) ?>
      <?php else: ?>

        <?php if (0 < strlen($sourceCultureValue = $term->getName(array('sourceCulture' => 'true'))) && $sf_user->getCulture() != $term->getSourceCulture()): ?>
          <div class="default-translation">
            <?php echo $sourceCultureValue ?>
          </div>
        <?php endif; ?>

        <?php echo $form->name ?>

      <?php endif; ?>

    </div>

    <?php echo $form->alternateForms
      ->label(__('Use for'))
      ->renderRow() ?>

    <?php echo render_field($form->code, $term) ?>

    <?php echo $form->scopeNote
      ->label(__('Scope note(s)'))
      ->renderRow() ?>

    <?php echo $form->sourceNote
      ->label(__('Source note(s)'))
      ->renderRow() ?>

    <?php echo $form->displayNote
      ->label(__('Display note(s)'))
      ->renderRow() ?>

  </fieldset>

  <fieldset class="collapsible collapsed">

    <legend><?php echo __('Relationships') ?></legend>

    <div class="form-item">
      <?php echo $form->parent
        ->label(__('Broad term'))
        ->renderLabel() ?>
      <?php echo $form->parent->render(array('class' => 'form-autocomplete')) ?>
      <input class="list" type="hidden" value="<?php echo url_for(array('module' => 'term', 'action' => 'autocomplete', 'taxonomyId' => $term->taxonomyId)) ?>"/>
    </div>

    <div class="form-item">
      <?php echo $form->relatedTerms
        ->label(__('Related term(s)'))
        ->renderLabel() ?>
      <?php echo $form->relatedTerms->render(array('class' => 'form-autocomplete')) ?>
      <input class="list" type="hidden" value="<?php echo url_for(array('module' => 'term', 'action' => 'autocomplete', 'taxonomyId' => $term->taxonomyId)) ?>"/>
    </div>

    <div class="form-item">
      <?php echo $form->narrowTerms
        ->label(__('Create narrow terms'))
        ->renderLabel() ?>
      <?php echo $form->narrowTerms ?>
    </div>

  </fieldset>

  <div class="actions section">

    <h2 class="element-invisible"><?php echo __('Actions') ?></h2>

    <div class="content">
      <ul class="clearfix links">
        <?php if (isset($sf_request->id)): ?>
          <li><?php echo link_to(__('Cancel'), array($term, 'module' => 'term')) ?></li>
          <li><?php echo submit_tag(__('Save')) ?></li>
        <?php else: ?>
          <?php if (isset($term->taxonomy)): ?>
          <li><?php echo link_to(__('Cancel'), array($term->taxonomy, 'module' => 'term', 'action' => 'listTaxonomy')) ?></li>
          <?php else: ?>
          <li><?php echo link_to(__('Cancel'), array('module' => 'term', 'action' => 'list')) ?></li>
          <?php endif; ?>
          <li><?php echo submit_tag(__('Create')) ?></li>
        <?php endif; ?>
      </ul>
    </div>

  </div>

</form>
