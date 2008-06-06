<div class="pageTitle"></div>

<div style="text-align: center;">
  <?php echo image_tag('lock48.png') ?>

    <h2 style="font-size: 20px;"><?php echo __('sorry, you do not have permission to access that page'); ?></h2>

	<a href="javascript:history.go(-1)"><?php echo __('back to previous page'); ?></a>
	<br />
	<?php echo link_to(__('go to homepage'), '@homepage') ?>

</div>
