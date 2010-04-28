<?php use_helper('Javascript') ?>

<h1><?php echo __('Upload digital objects') ?></h1>

<h1 class="label"><?php echo render_title(QubitIsad::getLabel($informationObject)) ?> </h1>

<?php echo $form->renderGlobalErrors() ?>

<?php echo $form->renderFormTag(url_for(array('module' => 'digitalobject', 'action' => 'create')), array('id' => 'uploadForm')) ?>

  <?php echo $form->renderHiddenFields() ?>

  <fieldset class="collapsible" id="singleFileUpload">

    <legend><?php echo __('Upload a digital object') ?></legend>

    <?php echo $form->file
        ->help(-1 < $maxUploadSize ? __('Max. size ~%1%', array('%1%' => hr_filesize($maxUploadSize))) : null)
        ->renderRow() ?>

  </fieldset>

  <fieldset class="collapsible" id="externalFileLink">

    <legend><?php echo __('Link to an external digital object') ?></legend>

    <?php echo $form->url->renderRow() ?>

  </fieldset>

  <div class="actions section">
  <h2 class="element-invisible"><?php echo __('Actions') ?></h2>
    <div class="content">
      <ul class="clearfix links">
        <li><?php echo link_to(__('Cancel'), array($informationObject, 'module' => 'informationobject')) ?></li>
        <li><?php echo submit_tag(__('Create')) ?></li>
      </ul>
    </div>
  </div>

</form>
