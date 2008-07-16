<?php

require_once(dirname(__FILE__).'/../../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('qubit', 'prod', false);

// Required if settings.yml does not yet exist, such as in a Subversion
// checkout
sfConfig::set('sf_enabled_modules', array('sfInstallPlugin'));

// Required if databases.yml does not yet exist, such as in a Subversion
// checkout
sfConfig::set('sf_use_database', false);

$context = sfContext::createInstance($configuration);

$request = $context->getRequest();
$request->setParameter('module', 'sfInstallPlugin');

// TODO: Consider using 'index'?
$request->setParameter('action', 'check');

// Drop /install/index.php (18 characters) from the relative URL root
$request->setRelativeUrlRoot(sfConfig::get('sf_relative_url_root', substr($request->getScriptName(), 0, -18)));

$context->dispatch();
