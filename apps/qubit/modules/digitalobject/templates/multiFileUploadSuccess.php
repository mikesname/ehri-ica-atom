<?php use_helper('Javascript') ?>

<?php if($hasWarning): ?>
<div class="warning"><?php echo $warning ?></div>
<?php endif; ?>

<div class="pageTitle"><?php echo __('Import multiple digital objects'); ?></div>
<form method="post" action="<?php echo url_for(array('module' => 'digitalobject', 'action' => 'multiFileUpload')) ?>" id="uploadForm">

  <fieldset class="collapsible">
    <legend><?php echo __('new object template'); ?></legend>

    <div class="form-item">
      <label for="parent_id"><?php echo __('title'); ?></label>
      <?php echo object_input_tag($infoObjectTemplate, 'getTitle', array('size' => 20, 'onkeyup' => 'renumerateUploads()')) ?>
      <span class="note"><?php echo __('The "<b>%dd%</b>" placeholder will be replaced with a incremental number (e.g. \'image <b>01</b>\', \'image <b>02</b>\')')?></span>
    </div>

    <div class="form-item">
      <label for="parent_id"><?php echo __('parent level'); ?></label>
      <?php echo object_select_tree($infoObjectTemplate, 'getId',
        array(
          'peer_method' => 'getDescendants',
          'related_class' => QubitInformationObject::getOne(QubitInformationObject::addRootsCriteria(new Criteria)),
          'style' => 'width: 200px'
        )) ?>
    </div>

    <div class="form-item">
      <label for="level_of_description_id"><?php echo __('level of description'); ?></label>
      <?php echo object_select_tag($infoObjectTemplate, 'getLevelOfDescriptionId', array(
        'related_class' => 'QubitTerm',
        'include_blank' => true,
        'peer_method' => 'getLevelsOfDescription'
      ))
      ?>
    </div>
  </fieldset>

  <fieldset>
    <legend><?php echo __('digital objects'); ?></legend>

    <div id="uploads"></div>
    <br style="clear: both" />
    <div id="uiElements" style="display:inline;">
      <div id="uploaderContainer">
         <div id="uploaderOverlay" style="position:absolute; z-index:2"></div>
         <div id="selectFilesLink" style="z-index:1"><a id="selectLink" href="#">Select Files</a></div>
      </div>
    </div>
  </fieldset>

  <div>
    <?php echo submit_tag('import')?>
  </div>
</form>

<?php echo javascript_tag('
  YAHOO.widget.Uploader.SWFURL = "'.$uploadSwfPath.'";

  var maxUploadSize = "'.$maxUploadSize.'";
  var uploadTmpDir = "'.$uploadTmpDir.'";
  var uploadResponsePath = "'.$uploadResponsePath.'";

  var i18nUploading = "'.__('Uploading...').'";
  var i18nInfoObjectTitle = "'.__('%1% title', array('%1%' => sfConfig::get('app_ui_label_informationobject'))).'";
  var i18nFilename  = "'.__('file name').'";
  var i18nFilesize  = "'.__('file size').'";
  var i18nDelete = "'.__('Delete').'";
  var i18nCancel = "'.__('Cancel').'";
  var i18nOversizedFileListMessage = "'.__('These files couldn\'t be uploaded because of file size upload limits').'";
'); ?>

<?php echo javascript_tag(<<<EOF
  var uploader = new YAHOO.widget.Uploader('uploaderOverlay');

  var fileList;
  var uploadedList = Array();

  uploader.addListener('contentReady', handleContentReady);
  uploader.addListener('fileSelect', onFileSelect)
  uploader.addListener('uploadStart', onUploadStart);
  uploader.addListener('uploadProgress', onUploadProgress);
  uploader.addListener('uploadCancel', onUploadCancel);
  uploader.addListener('uploadComplete', onUploadComplete);
  uploader.addListener('uploadCompleteData', onUploadResponse);
  uploader.addListener('uploadError', onUploadError);
  uploader.addListener('rollOver', handleRollOver);
  uploader.addListener('rollOut', handleRollOut);
  uploader.addListener('click', handleClick);
  uploader.addListener('mouseDown', handleMouseDown);
  uploader.addListener('mouseUp', handleMouseUp);
EOF
) ?>
