<div class="pageTitle"></div>

<?php decorate_with(sfLoader::getTemplatePath('default', 'defaultLayout.php')) ?>

<div class="sfTMessageContainer sfTAlert">
  <?php echo image_tag('cancel48.png') ?>

  <div class="sfTMessageWrap">
    <h1><?php echo __('this module is unavailable'); ?></h1>
    <h5><?php echo __('this module has been disabled by a site administrator'); ?></h5>
  </div>
</div>

	<a href="javascript:history.go(-1)"><?php echo __('back to previous page'); ?></a>
	<br />
	<?php echo link_to(__('go to homepage'), '@homepage') ?>
