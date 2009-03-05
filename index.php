<?php

// Only the web directory is meant to be web accessible.  The production
// frontend is in the web directory, which is distributed as a sibling of this
// file.  If this file is web accessible, then the URL of the web directory is
// probably a sibling of the URL of this file.  Try to redirect the web browser
// to the production frontend.

$path = preg_replace('/\/[^\/]+\.php5?$/', null, isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : (isset($_SERVER['ORIG_SCRIPT_NAME']) ? $_SERVER['ORIG_SCRIPT_NAME'] : null));

$webUrl = $path.'/web/index.php';

header('Location: '.$webUrl);
echo '<html><head><meta http-equiv="refresh" content="0;url='.htmlspecialchars($webUrl, ENT_QUOTES, sfConfig::get('sf_charset')).'"/></head></html>';
