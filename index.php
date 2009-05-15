<?php

// Only the web directory is meant to be web accessible.  The production
// frontend is in the web directory, which is distributed as a sibling of this
// file.  If this file is web accessible, then the URL of the web directory is
// probably a sibling of the URL of this file.  Try to redirect the web browser
// to the production frontend.

// Copied from sfInstallPlguinConfiguration::initialize()
foreach (array('SCRIPT_NAME', 'ORIG_SCRIPT_NAME') as $key)
{
  if (isset($_SERVER[$key]))
  {
    $scriptName = $_SERVER[$key];

    break;
  }
}

$webUrl = preg_replace('/\/[^\/]+\.php5?$/', '/web/index.php', $scriptName);

// Copied from sfWebController::redirect()
header('Location: '.$webUrl);
echo '<html><head><meta http-equiv="refresh" content="0;url='.htmlspecialchars($webUrl, ENT_QUOTES).'"/></head></html>';
