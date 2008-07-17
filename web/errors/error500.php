<?php $appName = 'ICA-AtoM' ?>
<?php $path = preg_replace('/\/[^\/]+\.php5?$/', null, isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : (isset($_SERVER['ORIG_SCRIPT_NAME']) ? $_SERVER['ORIG_SCRIPT_NAME'] : null)) ?>
<?php if (isset($exception) && $exception instanceof sfConfigurationException): ?>
  <?php

  $request = sfContext::getInstance()->getRequest();
  if (null === $request || 'sfInstallPlugin' != $request->getParameter('module'))
  {
    $installUrl = $path.'/install/index.php';

    header('Location: '.$installUrl);
    echo '<html><head><meta http-equiv="refresh" content="0;url='.htmlspecialchars($installUrl, ENT_QUOTES, sfConfig::get('sf_charset')).'" /></head></html>';
  }

  ?>
<?php else: ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="title" content="<?php echo $appName ?> - error 500" />
<meta name="robots" content="index, follow" />
<meta name="language" content="en" />
<title><?php echo $appName ?> - error 500</title>

<link rel="shortcut icon" href="/favicon.ico" />
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $path ?>/sf/sf_default/css/screen.css" />
<!--[if lt IE 7.]>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $path ?>/sf/sf_default/css/ie.css" />
<![endif]-->

<link rel="stylesheet" type="text/css" media="all" href="<?php echo $path ?>/vendor/drupal/modules/system/defaults.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo $path ?>/vendor/drupal/modules/system/system.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo $path ?>/vendor/drupal/themes/garland/style.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo $path ?>/vendor/drupal/themes/garland/minnelli/minnelli.css" />
<link rel="stylesheet" type="text/css" media="print" href="<?php echo $path ?>/vendor/drupal/themes/garland/print.css" />
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $path ?>/css/main.css" />

</head>
<body>
<div class="sfTContainer" id="wrapper">
  <div class="clear-block" id="container">

    <div id="header">
      <div id="logo-floater">
        <h1><img alt="<?php echo $appName ?>" id="logo" src="<?php echo $path ?>/images/logo.png" /><div><?php echo $appName ?></div></h1>
      </div>
    </div>

    <div id="center">
      <div id="squeeze">
        <div class="right-corner">
          <div class="left-corner">

            <div class="sfTMessageContainer sfTAlert">
              <img alt="page not found" class="sfTMessageIcon" src="<?php echo $path ?>/sf/sf_default/images/icons/tools48.png" height="48" width="48" />
              <div class="sfTMessageWrap">
                <h1>Oops! An Error Occurred</h1>
                <h5>The server returned a "500 Internal Server Error".</h5>
              </div>
            </div>

            <dl class="sfTMessageInfo">
              <dt>Sorry for the inconvenience but something is not working correctly right now.</dt>
              <dd>Please contact the site administrator or try again a little later.</dd>
              <dt>What's next</dt>
              <dd>
                <ul class="sfTIconList">
                  <li class="sfTLinkMessage"><a href="javascript:history.go(-1)">Back to previous page</a></li>
                </ul>
              </dd>
            </dl>

          </div>
        </div>
      </div>
    </div>

  </div>
</div>
</body>
</html>
<?php endif; ?>
