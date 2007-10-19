<?php decorate_with(sfLoader::getTemplatePath('default', 'defaultLayout.php')) ?>

<div class="pageTitle"></div>

<div class="sfTMessageContainer sfTAlert">
  <?php echo image_tag('tools48.png') ?>

  <div class="sfTMessageWrap">
    <h1><?php echo __('website currently unavailable'); ?></h1>
    <h5><?php echo __('this website has been temporarily disabled').'. '.__('please try again later'); ?></h5>
  </div>

</div>
