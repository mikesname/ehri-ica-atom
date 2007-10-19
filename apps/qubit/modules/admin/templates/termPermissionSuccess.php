<div class="pageTitle"></div>

<div style="text-align: center;">
  <?php echo image_tag('lock48.png') ?>

    <h2 style="font-size: 20px;"><?php echo __('sorry').'. '.__('this term is locked and cannot be edited'); ?></h2>
    <h2><?php echo __('the existing term value is required by the application to operate correctly'); ?></h2>

	<a href="javascript:history.go(-1)"><?php echo __('back to previous page'); ?></a>
	<br />
	<?php echo link_to(__('go to homepage'), '@homepage') ?>

</div>
