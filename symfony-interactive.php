<?php
echo "Symfony Interactive Shell 0.1 (c) Andrei Baragan <http://andlei.blogspot.com>\n";

define('SF_ROOT_DIR',    realpath(dirname(__FILE__)));
define('SF_APP',         'qubit');
define('SF_ENVIRONMENT', 'dev');
define('SF_DEBUG',       true);

$configpath = SF_ROOT_DIR.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php';
if (!file_exists($configpath)) 
{
  die("Error: You must be in a symfony project directory to use symfony-interactive: $configpath.\n");
}

 
require_once($configpath);
require_once(dirname(__FILE__).'/config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('qubit', 'dev', true);
sfContext::createInstance($configuration)->dispatch();

// initialize database manager
$databaseManager = new sfDatabaseManager($configuration);
$databaseManager->initialize($configuration);

echo "based on:\n";
// pear must be in your include_path in php.ini
include ('php-shell-cmd.php');
?>
