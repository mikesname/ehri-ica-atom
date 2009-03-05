<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
  </head>
  <body class="yui-skin-sam">
    <div id="body-banner-top"></div>

    <div id="body-page">

    <div id="header">
      <?php include_component_slot('header') ?>
    <div id="header-top">

    <div class="menu-top">
      <?php include_component_slot('ChangeLanguage') ?>
      <?php include_component('menu', 'quickLinks') ?>
    </div>
    </div> <!--close header-top -->

    <div id="header-middle">
    <?php if (strlen(sfConfig::get('app_site_information_site_title'))): ?>
    <div id="website-name">
      <?php echo link_to(__(sfConfig::get('app_site_information_site_title')),
        array('module' => 'staticpage', 'action' => 'static', 'permalink' => 'homepage')) ?>
    </div>
    <?php endif; ?>

    <?php if (strlen(sfConfig::get('app_site_information_site_description'))): ?>
    <div id="website-description">
      <?php echo __(sfConfig::get('app_site_information_site_description')); ?>
    </div>
    <?php endif; ?>

    <div id="logo"><?php echo link_to(image_tag('logo', array('alt' => sfConfig::get('app_name', 'Qubit'))),
      array('module' => 'staticpage', 'action' => 'static', 'permalink' => 'homepage')) ?></div>
    </div> <!-- close header-middle -->

    <div id="header-bottom">
    <?php if ($sf_user->hasCredential('administrator' or 'editor' or 'contributor' or 'translator')): ?>
    <?php include_component_slot('MainMenu') ?>
    <?php endif; ?>
    </div> <!-- close header-bottom -->

    </div> <!-- close header -->

    <div id="main">

    <div id="context-column">

    <div class="context-column-box">
    <?php include_component_slot('SearchSidebar') ?>
    <?php include_component_slot('BrowseSidebar') ?>
    </div>

    <div id="sidebar">
      <?php include_component_slot('sidebar') ?>
    </div>

    </div> <!-- close context-column" -->

    <div id="content-two-column">

    <div class="content-column-box">
    <?php echo $sf_data->getRaw('sf_content') ?>
    </div>

    </div> <!-- close content-two-column -->

    </div> <!-- close main -->

    <div id="footer">
    </div>

    </div> <!-- close body-page -->
    <div id="body-banner-bottom">
      <?php include_component_slot('bottomBanner') ?>
    </div>
  </body>
</html>
