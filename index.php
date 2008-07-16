<?php

$path = preg_replace('/\/[^\/]+\.php5?$/', null, isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : (isset($_SERVER['ORIG_SCRIPT_NAME']) ? $_SERVER['ORIG_SCRIPT_NAME'] : null));

$webUrl = $path.'/web/index.php';

header('Location: '.$webUrl);
echo '<html><head><meta http-equiv="refresh" content="0;url='.htmlspecialchars($webUrl, ENT_QUOTES, sfConfig::get('sf_charset')).'"/></head></html>';
