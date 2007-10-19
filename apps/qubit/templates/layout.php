<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<?php echo include_http_metas() ?>
<?php echo include_metas() ?>

<?php echo include_title() ?>

<link rel="shortcut icon" href="/favicon.ico" />

</head>
<body>

<div id="body-banner-top"></div>

<div id="body-page">

<div id="header">

<div id="header-top">
<div class="menu-top">
<?php if ($sf_user->isAuthenticated()): ?>
<?php echo link_to(__('log out'), 'user/logout') ?>
<?php echo link_to($sf_user->getUserName().' '.__('profile'), 'user/show?id='.$sf_user->getUserID()) ?>
<?php else: ?>
<?php echo link_to(__('log in'), 'login') ?>
<?php endif; ?>
<?php echo link_to(__('about'), '/about') ?>
<?php echo link_to(__('home'), '/', 'id="first"') ?>

</div>
</div> <!--close header-top -->


<div id="header-middle">
<div id="website-name">
<div id="logo"><?php echo link_to(image_tag('/images/qubit-sphere.gif', 'width="80" height="80" alt="Qubit logo"'), '/') ?></div>
<?php echo link_to('<span style="color: #FC6E3C; letter-spacing: -0.1ex;"><span style="color: #CC3204; font-size: 125%;">Q</span>ubit</span>', '/') ?>
</div>
<div id="website-description"><?php echo __("open information management toolkit"); ?></div>

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

<div class="context-column-box">
<?php include_component_slot('LanguageSidebar') ?>
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
  <?php include_component_slot('footer') ?>
</div>

</div> <!-- close body-page -->
</body>
</html>
