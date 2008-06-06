<?php use_helper('DateForm') ?>
﻿<?php use_helper('Javascript') ?>

<div class="pageTitle"><?php echo __('edit %1%', array('%1%' => sfConfig::get('app_ui_label_informationobject'))); ?></div>

<?php echo form_tag('informationobject/update') ?>
  <?php echo object_input_hidden_tag($informationObject, 'getId') ?>

  <?php if ($informationObject->getTitle(array('sourceCulture' => true))): ?>
    <div class="formHeader">
      <?php echo link_to($informationObject->getLabel(), 'informationobject/show/?id='.$informationObject->getId()) ?>
    </div>
  <?php else: ?>
    <table class="list" style="height: 25px;"><thead><tr><th></th></tr></table>
  <?php endif; ?>

    <div class="form-item">
      <label for="identifier"><?php echo __('identifier'); ?></label>
      <?php echo object_input_tag($informationObject, 'getIdentifier', array('size' => 20)) ?>
    </div>

    <div class="form-item">
      <label for="title"><?php echo __('title'); ?></label>
      <?php echo object_input_tag($informationObject, 'getTitle', array('size' => 20)) ?>
    </div>

    <div class="form-item">
      <label for="alternateTitle"><?php echo __('alternate title'); ?></label>
      <?php echo input_tag('alternateTitle', array('size' => 20)) ?>
    </div>

    <div class="form-item">
      <label for="bibliographicCitation"><?php echo __('bibliographic citation'); ?></label>
      <?php echo input_tag('bibliographicCitation', array('size' => 20)) ?>
    </div>

      <div class="form-item">
      <label for="date"><?php echo __('date'); ?></label>
      <?php echo input_tag('date', array('size' => 20)) ?>
    </div>

    <div class="form-item">
      <label for="coverage"><?php echo __('coverage'); ?></label>
      <?php echo input_tag('coverage', array('size' => 20)) ?>
    </div>

    <div class="form-item">
      <label for="extent"><?php echo __('extent'); ?></label>
       <?php echo input_tag('extent', array('size' => 20)) ?>
    </div>

    <div class="form-item">
      <label for="medium"><?php echo __('medium'); ?></label>
       <?php echo input_tag('medium', array('size' => 20)) ?>
    </div>

    <div class="form-item">
      <label for="format"><?php echo __('format'); ?></label>
       <?php echo input_tag('format', array('size' => 20)) ?>
    </div>

    <div class="form-item">
      <label for="type"><?php echo __('type'); ?></label>
       <?php echo input_tag('type', array('size' => 20)) ?>
    </div>

    <div class="form-item">
      <label for="creator"><?php echo __('creator'); ?></label>
       <?php echo input_tag('creator', array('size' => 20)) ?>
    </div>

    <div class="form-item">
      <label for="contributor"><?php echo __('contributor'); ?></label>
       <?php echo input_tag('creator', array('size' => 20)) ?>
    </div>

    <div class="form-item">
      <label for="publisher"><?php echo __('publisher'); ?></label>
       <?php echo input_tag('creator', array('size' => 20)) ?>
    </div>

    <div class="form-item">
      <label for="provenance"><?php echo __('provenance'); ?></label>
      <?php echo object_input_tag($informationObject, 'getArchivalHistory', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="description"><?php echo __('description'); ?></label>
      <?php echo object_input_tag($informationObject, 'getScopeAndContent', array('size' => '30x3')) ?>
    </div>

    <div class="form-item">
      <label for="accrual_method"><?php echo __('accrual method'); ?></label>
       <?php echo input_tag('accrualMethod', array('size' => 20)) ?>
    </div>

    <div class="form-item">
      <label for="accrual_periodicity"><?php echo __('accrual periodicity'); ?></label>
       <?php echo input_tag('accrualPeriodicity', array('size' => 20)) ?>
    </div>

    <div class="form-item">
      <label for="accrual_policy"><?php echo __('accrual policy'); ?></label>
       <?php echo input_tag('accrualPolicy', array('size' => 20)) ?>
    </div>

    <div class="form-item">
      <label for="rights"><?php echo __('rights'); ?></label>
      <?php echo object_input_tag($informationObject, 'getAccessConditions', array('size' => 20)) ?>
    </div>

    <div class="form-item">
      <label for="language"><?php echo __('language'); ?></label>

      <?php foreach ($languageCodes as $languageCode): ?>
        <div style="margin-top: 5px; margin-bottom: 5px;">
        <?php echo format_language($languageCode->getValue()) ?>&nbsp;<?php echo link_to(image_tag('delete', 'align=top'), 'actor/deleteProperty?Id='.$languageCode->getId()) ?><br/>
        </div>
      <?php endforeach; ?>

      <?php echo select_language_tag('language_code', null, array('include_blank' => true)) ?>
     </div>

    <div class="form-item">
      <label for="subject_id"><?php echo __('subject'); ?></label>

      <?php foreach ($subjectAccessPoints as $subject): ?>
        <?php echo $subject->getTerm() ?>&nbsp;<?php echo link_to(image_tag('delete', 'align=top'), 'informationobject/deleteTermRelation?TermRelationId='.$subject->getId()) ?><br/>
      <?php endforeach; ?>

      <?php echo object_select_tag($newSubjectAccessPoint, 'getTermId', array('name' => 'subject_id', 'id' => 'subject_id', 'include_blank' => true, 'peer_method' => 'getSubjects')) ?>
    </div>

    <div class="form-item">
      <label for="place_id"><?php echo __('subject - spatial'); ?></label>
       <?php echo input_tag('accrualPolicy', array('size' => 20)) ?>
    </div>

    <div class="form-item">
      <label for="repository_id"><?php echo __('repository'); ?></label>
      <?php echo object_select_tag($informationObject, 'getRepositoryId', array('include_blank' => true,)) ?>
    </div>

  <?php if ($sf_context->getActionName() == 'create'): ?>
  <!--set initial form focus -->
  <?php echo javascript_tag(<<<EOF
  $('[name=identifier]').focus();
EOF
  ) ?>
  <?php endif; ?>

  <div class="menu-action">
    <?php if ($informationObject->getId()): ?>
      &nbsp;<?php echo link_to(__('delete'), 'informationobject/delete?id='.$informationObject->getId(), 'post=true&confirm='.__('are you sure?')) ?>
      &nbsp;<?php echo link_to(__('cancel'), 'informationobject/show?id='.$informationObject->getId().'&template=0') ?>
    <?php else: ?>
      &nbsp;<?php echo link_to(__('cancel'), 'informationobject/create') ?>
    <?php endif; ?>

    <?php if ($informationObject->getId()): ?>
      <?php echo my_submit_tag(__('save'), array('style' => 'width: auto;')) ?>
    <?php else: ?>
      <?php echo my_submit_tag(__('create'), array('style' => 'width: auto;')) ?>
    <?php endif; ?>

  </div>
</form>

<div class="menu-extra">
  <?php echo link_to(__('add new %1%', array('%1%' => sfConfig::get('app_ui_label_informationobject'))), 'informationobject/create'); ?>
	<?php echo link_to(__('list all %1%', array('%1%' => sfConfig::get('app_ui_label_informationobject'))), 'informationobject/list'); ?>
</div>
