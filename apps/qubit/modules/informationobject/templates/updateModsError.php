<div class="pageTitle"><?php echo __('Update Error') ?></div>

<div class="error-block">
<ul class="error-list">
  <?php foreach ($sf_request->getErrors() as $error): ?>
  <li>
    <?php if ($error == 'no_form_data'): ?>
      <?php echo __('Error! The update form contained no post data.  This error may be a result of attempting to upload a file that exceeds the max upload filesize of %1%.',
      array('%1%' => hr_filesize(QubitDigitalObject::getMaxUploadSize()))); ?>
    <?php endif; ?>
  </li>
  <?php endforeach; ?>
</ul>
</div>

<dl class="sfTMessageInfo">
  <dt><?php echo __('Please choose one of the links below, or click the "back" button on your browser to return to the previous page.') ?></dt>
  <dd>
    <ul class="sfTIconList">
      <li class="sfTLinkMessage"><a href="<?php echo url_for($sf_data->getRaw('editPage')) ?>"><?php echo __('Return to the create/edit form') ?></a></li>
    </ul>
    <ul class="sfTIconList">
      <li class="sfTLinkMessage"><a href="<?php echo url_for('') ?>"><?php echo __('Go to the homepage') ?></a></li>
    </ul>
  </dd>
</dl>
