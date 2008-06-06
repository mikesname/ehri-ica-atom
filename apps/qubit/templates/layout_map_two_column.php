<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
<head>
    <?php $map->printHeaderJS(); ?>
    <?php $map->printMapJS(); ?>
    <!-- necessary for google maps polyline drawing in IE -->

<?php echo include_http_metas() ?>
<?php echo include_metas() ?>

<?php echo include_title() ?>

<link rel="shortcut icon" href="/favicon.ico" />

    <style type="text/css">
      v\:* {
        behavior:url(#default#VML);
      }
    </style>

</head>
<body onload="onLoad()">

<div id="body-banner-top"></div>

<div id="body-page">

<div id="header">

<div id="header-top">
<div class="menu-top">
<?php if ($sf_user->isAuthenticated()): ?>
<?php echo link_to('log out', 'user/logout') ?>
<?php echo link_to($sf_user->getUserName().' profile', 'user/show?id='.$sf_user->getUserID()) ?>
<?php else: ?>
<?php echo link_to('log in', 'login') ?>
<?php endif; ?>
<?php echo link_to('about', '/about') ?>
<?php echo link_to('home', '/', 'id="first"') ?>

</div>
</div> <!--close header-top -->

<div id="header-middle">
<div id="logo"><?php echo image_tag('/uploads/images/logo-small.jpg') ?></div>
<div id="website-name"><?php echo link_to('Human Rights Violations:<br />A Guide to Archival Sources', '/') ?></a></div>
</div> <!-- close header-middle -->

</div> <!-- close header-middle -->

<div id="header-bottom">
<?php if ($sf_user->hasCredential('administrator')): ?>
<?php include_component_slot('MainMenu') ?>
<?php include_component_slot('DetailMenu') ?>
<?php endif; ?>
</div> <!-- close header-bottom -->

</div> <!-- close header -->

<div id="main">

<div id="context-column">

<div class="context-column-box">
<?php include_component_slot('SearchSidebar') ?>
<?php include_component_slot('BrowseSidebar') ?>
</div>

<?php if ($this->getContext()->getModuleName() == 'map'): ?>
<?php if ($this->getContext()->getActionName() == 'show'): ?>
<div class="context-column-box">
<div class="contextMenu">
<div class="label" align="center">Map Markers <br />(click to locate on map)</div>
<?php $map->printSidebar(); ?>
</div>
</div>
<?php endif; ?>
<?php endif; ?>

<?php if ($this->getContext()->getModuleName() == 'informationobject'): ?>
<?php if ($this->getContext()->getActionName() != 'list'): ?>
<?php if ($informationObject->getTreeId()): ?>
<div class="context-column-box">
<?php include_component_slot('InformationObjectContextMenu') ?>
</div>
<?php endif; ?>
<?php endif; ?>
<?php endif; ?>

<?php if ($this->getContext()->getModuleName() == 'actor'): ?>
<?php if ($this->getContext()->getActionName() != 'list'): ?>
<?php if ($actor->getId()): ?>
<div class="context-column-box">
<?php include_component_slot('ActorContextMenu') ?>
</div>
<?php endif; ?>
<?php endif; ?>
<?php endif; ?>

<?php if ($this->getContext()->getModuleName() == 'repository'): ?>
<?php if ($this->getContext()->getActionName() != 'list'): ?>
<?php if ($repository->getId()): ?>
<div class="context-column-box">
<?php include_component_slot('RepositoryContextMenu') ?>
</div>
<?php endif; ?>
<?php endif; ?>
<?php endif; ?>

</div> <!-- close context-column" -->

<div id="content-two-column">

<div class="content-column-box">
<?php echo $sf_data->getRaw('sf_content') ?>
</div>

</div> <!-- close content-two-column -->

</div> <!-- close main -->

<div id="footer">
<div id="footer-top"></div>
<div id="footer-bottom"><a href="http://qubit-toolkit.org"><?php echo image_tag('poweredbyICAatom-grey.gif', 'width="84" height="31" alt=""') ?></a></div>
</div> <!-- close footer -->

</body>
</html>
