<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<?php include_http_metas() ?>
<?php include_metas() ?>

<?php include_title() ?>

<link rel="shortcut icon" href="/favicon.ico" />

</head>
<body class="sidebar-left">

<!-- FIXME: Is there a better way to put comments in templates? -->
<!-- FIXME: Is there a better way to mark active and done tasks? -->
<div id="wrapper">
  <div class="clear-block" id="container">

    <div id="header">
      <div id="logo-floater">
        <h1><?php echo image_tag('logo', array('alt' => $sf_response->getTitle(), 'id' => 'logo')) ?><div><?php echo $sf_response->getTitle() ?></div></h1>
      </div>
    </div>

    <div class="sidebar">
      <ol class="task-list">
        <li<?php switch ($sf_request->getParameter('action')): case 'checkSystem': ?> class="active"<?php break; case 'configureDatabase': case 'loadData': case 'configureSite': case 'finishInstall': ?> class="done"<?php endswitch; ?>>Check system</li>
        <li<?php switch ($sf_request->getParameter('action')): case 'configureDatabase': ?> class="active"<?php break; case 'loadData': case 'configureSite': case 'finishInstall': ?> class="done"<?php endswitch; ?>>Configure database</li>
        <li<?php switch ($sf_request->getParameter('action')): case 'loadData': ?> class="active"<?php break; case 'configureSite': case 'finishInstall': ?> class="done"<?php endswitch; ?>>Load data</li>
        <li<?php switch ($sf_request->getParameter('action')): case 'configureSite': ?> class="active"<?php break; case 'finishInstall': ?> class="done"<?php endswitch; ?>>Configure site</li>
      </ol>
    </div>

    <div id="center">
      <div id="squeeze">
        <div class="right-corner">
          <div class="left-corner">

            <?php echo $sf_content ?>

          </div>
        </div>
      </div>
    </div>

  </div>
</div>

</body>
</html>
