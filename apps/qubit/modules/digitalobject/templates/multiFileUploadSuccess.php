<?php use_helper('Javascript') ?>

<h1><?php echo __('Import multiple digital objects') ?></h1>

<h1 class="label"><?php echo render_title($informationObject->getLabel()) ?> </h1>

<noscript>
  <div class="messages status">
    <?php echo __('Your browser does not support Flash and/or JavaScript. See %1%minimum requirements%2%.', array('%1%' => '<a href="http://qubit-toolkit.org/wiki/index.php?title=Minimum_requirements">', '%2%' => '</a>')) ?>
  </div>
  <ul class="actions links">
    <li><?php echo link_to(__('Cancel'), array($informationObject, 'module' => 'informationobject')) ?></li>
  </ul>
</noscript>

<?php echo $form->renderFormTag(url_for(array('module' => 'digitalobject', 'action' => 'multiFileUpload')), array('id' => 'multiFileUploadForm', 'style' => 'display: none;')) ?>

  <?php echo $form->renderHiddenFields() ?>

  <?php echo $form->title
    ->help(__('The "<b>%dd%</b>" placeholder will be replaced with a incremental number (e.g. \'image <b>01</b>\', \'image <b>02</b>\')'))
    ->label(__('Title'))
    ->renderRow() ?>

  <?php echo $form->levelOfDescription
    ->label(__('Level of description'))
    ->renderRow() ?>

  <div class="form-item multiFileUpload">
    <label for=""><?php echo __('Digital objects') ?></label>
    <div id="uploads"></div>
    <div id="uiElements" style="display: inline;">
      <div id="uploaderContainer">
        <div id="uploaderOverlay" style="position: absolute; z-index: 2;"></div>
        <div id="selectFilesLink" style="z-index: 1;"><a id="selectLink" href="#">Select files</a></div>
      </div>
    </div>
  </div>

  <div class="actions section">
  <h2 class="element-invisible"><?php echo __('Actions') ?></h2>
    <div class="content">
      <ul class="clearfix links">
        <li><?php echo link_to(__('Cancel'), array($informationObject, 'module' => 'informationobject')) ?></li>
        <li><?php echo submit_tag(__('Import')) ?></li>
      </ul>
    </div>
  </div>

</form>

<?php echo javascript_tag('
  // If JavaScript and Flash Player installed
  if (0 == YAHOO.deconcept.SWFObjectUtil.getPlayerVersion().major)
  {
    // Show <noscript> content
    var noscript = jQuery(\'noscript\');
    noscript.replaceWith(noscript.text());
  }
  else
  {
    jQuery(\'form#multiFileUploadForm\').show();
  }

  YAHOO.widget.Uploader.SWFURL = "'.$uploadSwfPath.'";

  Qubit.multiFileUpload.maxUploadSize = "'.$maxUploadSize.'";
  Qubit.multiFileUpload.uploadTmpDir = "'.$uploadTmpDir.'";
  Qubit.multiFileUpload.uploadResponsePath = "'.$uploadResponsePath.'?'.http_build_query(array(session_name() => session_id())).'";
  Qubit.multiFileUpload.informationObjectId = "'.$informationObject->id.'";
  Qubit.multiFileUpload.thumbWidth = 150;

  Qubit.multiFileUpload.i18nUploading = "'.__('Uploading...').'";
  Qubit.multiFileUpload.i18nLoadingPreview = "'.__('Loading preview...').'";
  Qubit.multiFileUpload.i18nWaiting = "'.__('Waiting...').'";
  Qubit.multiFileUpload.i18nUploadError = "'.__('Upload error, retry?').'";
  Qubit.multiFileUpload.i18nInfoObjectTitle = "'.__('Title').'";
  Qubit.multiFileUpload.i18nFilename  = "'.__('Filename').'";
  Qubit.multiFileUpload.i18nFilesize  = "'.__('Filesize').'";
  Qubit.multiFileUpload.i18nDelete = "'.__('Delete').'";
  Qubit.multiFileUpload.i18nCancel = "'.__('Cancel').'";
  Qubit.multiFileUpload.i18nStart = "'.__('Start').'";
  Qubit.multiFileUpload.i18nDuplicateFile = "'.__('Warning: duplicate of %1%').'";
  Qubit.multiFileUpload.i18nOversizedFile = "'.__('This file couldn\'t be uploaded because of file size upload limits').'";
'); ?>
