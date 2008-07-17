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
        <h1><?php echo image_tag('logo', array('alt' => sfConfig::get('app_name', 'Qubit'), 'id' => 'logo')) ?><div><?php echo sfConfig::get('app_name', 'Qubit') ?></div></h1>
      </div>
    </div>

    <div class="sidebar">
      <ol class="task-list">
        <li<?php if ('check' == $sf_request->getParameter('action')): ?> class="active"<?php elseif ('configure' == $sf_request->getParameter('action') || 'load' == $sf_request->getParameter('action') || 'finish' == $sf_request->getParameter('action')): ?> class="done"<?php endif; ?>>Check system</li>
        <li<?php if ('configure' == $sf_request->getParameter('action')): ?> class="active"<?php elseif ('load' == $sf_request->getParameter('action') || 'finish' == $sf_request->getParameter('action')): ?> class="done"<?php endif; ?>>Configure database</li>
        <li<?php if ('load' == $sf_request->getParameter('action')): ?> class="active"<?php elseif ('finish' == $sf_request->getParameter('action')): ?> class="done"<?php endif; ?>>Load data</li>
        <li<?php if ('finish' == $sf_request->getParameter('action')): ?> class="active"<?php endif; ?>>Finish install</li>
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
