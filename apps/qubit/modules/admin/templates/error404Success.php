<div class="pageTitle"></div>

<div style="text-align: center;">
  <?php echo image_tag('cancel48.png') ?>
    <h2 class="capitalize" style="font-size: 20px"><?php echo __('sorry').'. '.__('page not found').'.'; ?></h2>
    <h2 class="firstLetter"><?php echo __('the server returned a 404 response').'.'; ?></h2>

  <h4 class="firstLetter"><?php echo __('did you type the URL correctly?'); ?></h4>

  <h4 class="firstLetter"><?php echo __('did you follow a broken link?'); ?></h4>

	<a href="javascript:history.go(-1)"><?php echo __('back to previous page'); ?></a>
	<br />
	<?php echo link_to(__('go to homepage'), '@homepage') ?>

</div>
