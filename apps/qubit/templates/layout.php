<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<?php include_http_metas() ?>
<?php include_metas() ?>

<?php include_title() ?>

<link rel="shortcut icon" href="/favicon.ico" />

</head>
<body class="yui-skin-qubit">

<div id="body-banner-top">
</div>

<div id="body-page">

<div id="header">
  <?php include_component_slot('header') ?>
<div id="header-top">

<?php include_component_slot('ChangeLanguageList') ?>

<div class="menu-top">
<?php if ($sf_user->isAuthenticated()): ?>
<?php echo link_to(__('log out'), 'user/logout') ?>
<?php echo link_to(__('%1% profile', array('%1%' =>$sf_user->getUserName())), 'user/show?id='.$sf_user->getUserID()) ?>
<?php else: ?>
<?php echo link_to(__('log in'), 'login/') ?><?php endif; ?>

<?php echo link_to(__('help'), 'http://qubit-toolkit.org/wiki') ?>
<?php echo link_to(__('about'), '/about/') ?>
<?php echo link_to(__('home'), '/homepage/') ?>
</div>
</div> <!--close header-top -->

<div id="header-middle">
<div id="website-name">
<?php echo link_to('<span style="color: #FC6E3C; letter-spacing: -0.1ex;"><span style="color: #CC3204; font-size: 115%;">Q</span>ubit</span>', '/homepage/') ?>
</div>
<div id="website-description"><?php echo __("open information management toolkit"); ?></div>
<div id="logo"><?php echo link_to(image_tag('/images/qubit-sphere.gif', 'width="80" height="80" alt="Qubit logo"'), '/homepage/') ?></div>
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
