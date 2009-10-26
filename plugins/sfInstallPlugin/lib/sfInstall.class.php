<?php

/*
 */

// TODO: Integrate with symfony/data/bin/check_configuration.php
class sfInstall
{
  public static $MINIMUM_MEMORY_LIMIT_MB = 64;

  public static function publishAssets()
  {
    $dispatcher = sfContext::getInstance()->getEventDispatcher();
    $formatter = new sfAnsiColorFormatter;

    chdir(sfConfig::get('sf_root_dir'));

    $publishAssets = new sfPluginPublishAssetsTask($dispatcher, $formatter);
    $publishAssets->run();
  }

  // Returns an array of missing dependencies
  // TODO: This is already implemented in PEAR.  Make this check more robust by
  // calling their code.
  // TODO: Break this up so we can give more detailed output (like which
  // extensions *are* loaded?
  public static function checkDependencies()
  {
    $dependencies = array();

    // Check if any dependencies are defined
    $packageXmlPath = sfConfig::get('sf_config_dir').'/package.xml';
    if (!file_exists($packageXmlPath))
    {
      return $dependencies;
    }

    $doc = new DOMDocument;
    $doc->load($packageXmlPath);

    $xpath = new DOMXPath($doc);
    $xpath->registerNamespace('p', 'http://pear.php.net/dtd/package-2.0');

    // Check if a minimum PHP version is defined, and if it is less than our
    // current version
    if (strlen($min = $xpath->evaluate('string(p:dependencies/p:required/p:php/p:min)', $doc->documentElement)) > 0 && version_compare(PHP_VERSION, $min) < 0)
    {
      $dependencies['php']['min'] = $min;
    }

    foreach ($xpath->query('p:dependencies/*/p:extension/p:name') as $node)
    {
      // nodeValue or textContent? http://php.net/DOMNode
      if (!extension_loaded($node->nodeValue))
      {
        $dependencies['extensions'][] = $node->nodeValue;
      }
    }

    return $dependencies;
  }

  public static function checkWritablePaths()
  {
    // FIXME: This is a late night hack.  It should probably get moved into its
    // own check.
    // Copied from sfFileLogger::initialize()
    if (!is_dir(sfConfig::get('sf_log_dir')))
    {
      mkdir(sfConfig::get('sf_log_dir'), 0777, true);
    }

    $writablePaths = array();

    $finder = sfFinder::type('any');

    foreach (array(sfConfig::get('sf_cache_dir'), sfConfig::get('sf_data_dir'), sfConfig::get('sf_log_dir')) as $path)
    {
      // FIXME: sfFinder::in() does not include the argument path
      if (!is_writable($path))
      {
        $writablePaths[] = $path;
      }

      foreach ($finder->in($path) as $path)
      {
        if (!is_writable($path))
        {
          $writablePaths[] = $path;
        }
      }
    }

    return $writablePaths;
  }

  public static function checkDatabasesYml()
  {
    $databasesYml = array();

    $databasesYmlPath = sfConfig::get('sf_config_dir').'/databases.yml';

    // Read databases.yml contents from existing databases.yml,
    // databases.yml.tmpl (for a Subversion checkout), or symfony skeleton
    // databases.yml, whichever is found first
    $databasesYmlPaths = array();
    $databasesYmlPaths[] = $databasesYmlPath;
    $databasesYmlPaths[] = $databasesYmlPath.'.tmpl';
    $databasesYmlPaths[] = sfConfig::get('sf_lib_dir').'/task/generator/skeleton/project/config/databases.yml';

    foreach ($databasesYmlPaths as $path)
    {
      if (false !== $databasesYmlContents = file_get_contents($path))
      {
        break;
      }
    }

    if (false === file_put_contents($databasesYmlPath, $databasesYmlContents))
    {
      $databasesYml['notWritable'] = 'notWritable';
    }

    return $databasesYml;
  }

  public static function checkPropelIni()
  {
    $propelIni = array();

    $propelIniPath = sfConfig::get('sf_config_dir').'/propel.ini';

    // Read propel.ini contents from existing propel.ini, propel.ini.tmpl (for
    // a Subversion checkout), or symfony skeleton propel.ini, whichever is
    // found first
    $propelIniPaths = array();
    $propelIniPaths[] = $propelIniPath;
    $propelIniPaths[] = $propelIniPath.'.tmpl';
    $propelIniPaths[] = sfConfig::get('sf_lib_dir').'/task/generator/skeleton/project/config/propel.ini';

    foreach ($propelIniPaths as $path)
    {
      if (false !== $propelIniContents = file_get_contents($path))
      {
        break;
      }
    }

    if (false === file_put_contents($propelIniPath, $propelIniContents))
    {
      $propelIni['notWritable'] = 'notWritable';
    }

    return $propelIni;
  }

  // TODO: Use sfWebBrowserPlugin
  protected static function get($url)
  {
    $request = sfContext::getInstance()->request;

    // TODO: Error handling
    $handle = fsockopen($request->getHost(), 80, $null, $null, 5);
    fwrite($handle, implode("\r\n", array(
      'GET '.$url.' HTTP/1.1',
      'Host: '.$request->getHost()))."\r\n\r\n");
    fflush($handle);

    $contents = stream_get_contents($handle);
    fclose($handle);

    return $contents;
  }

  // Must be called after checkDatabasesYml() because the $noScriptNameUrl will
  // always fail if databases.yml does not exist
  public static function checkHtaccess()
  {
    $htaccess = array();

    $invalidContents = <<<EOF
Deliberately invalid .htaccess file.  Requests in this directory should only succeed if .htaccess files are completely ignored.

EOF;

    $optionsContents = <<<EOF
Options +FollowSymLinks +ExecCGI

EOF;

    $relativeUrlRoot = sfContext::getInstance()->request->getRelativeUrlRoot();

    $rewriteBase = 'RewriteBase '.$relativeUrlRoot;
    if ('/' === $relativeUrlRoot)
    {
      $rewriteBase = '#'.$rewriteBase;
    }
    else
    {
      $rewriteBase .= '/';
    }

    $checkModRewriteContents = <<<EOF
<IfModule mod_rewrite.c>
  RewriteEngine On

  # uncomment the following line, if you are having trouble
  # getting no_script_name to work
  $rewriteBase
  RewriteRule ^(.*)$ index.php [QSA,L]
</IfModule>

EOF;

    $modRewriteContents = <<<EOF
<IfModule mod_rewrite.c>
  RewriteEngine On

  # uncomment the following line, if you are having trouble
  # getting no_script_name to work
  $rewriteBase

  # we skip all files with .something
  #RewriteCond %{REQUEST_URI} \..+$
  #RewriteCond %{REQUEST_URI} !\.html$
  #RewriteRule .* - [L]

  # we check if the .html version is here (caching)
  RewriteRule ^$ index.html [QSA]
  RewriteRule ^([^.]+)$ $1.html [QSA]
  RewriteCond %{REQUEST_FILENAME} !-f

  # no, so we redirect to our front web controller
  RewriteRule ^(.*)$ index.php [QSA,L]
</IfModule>

EOF;

    $htaccessPath = sfConfig::get('sf_web_dir').'/.htaccess';

    $url = sfContext::getInstance()->routing->context(sfContext::getInstance()->request->sf_no_script_name(false)->getRequestContext())->generate(null, array('module' => 'sfInstallPlugin', 'action' => 'callback'));

    $noScriptNameUrl = sfContext::getInstance()->routing->context(sfContext::getInstance()->request->sf_no_script_name(true)->getRequestContext())->generate(null, array('module' => 'sfInstallPlugin', 'action' => 'callback'));

    // Remember if the .htaccess file already exists
    $htaccessExists = file_exists($htaccessPath);

    // Check if the .htaccess file is writable and if .htaccess files are
    // completely ignored
    if (false === file_put_contents($htaccessPath, $invalidContents))
    {
      // Check if the configuration works before complaining
      if (false === strstr(self::get($noScriptNameUrl), 'Open-Source PHP Web Framework'))
      {
        $htaccess['notWritable'] = 'notWritable';
      }

      return $htaccess;
    }

    // FIXME: We created a new .htaccess file.  Make it world readable or
    // Apache may not be able to read it.
    if (!$htaccessExists)
    {
      chmod($htaccessPath, 0644);
    }

    // Check if .htaccess files are completely ignored
    if (false !== strstr(self::get($url), 'Open-Source PHP Web Framework'))
    {
      // Check if the configuration works before complaining
      if (false === strstr(self::get($noScriptNameUrl), 'Open-Source PHP Web Framework'))
      {
        $htaccess['ignored'] = 'ignored';
      }

      unlink($htaccessPath);

      return $htaccess;
    }

    $htaccessContents = array();

    // Check if Options allowed in .htaccess
    $htaccessContents[] = $optionsContents;
    file_put_contents($htaccessPath, implode("\n", $htaccessContents));
    if (false === strstr(self::get($url), 'Open-Source PHP Web Framework'))
    {
      $htaccess['optionsNotAllowed'] = 'optionsNotAllowed';
      $htaccessContents = array();
    }

    $checkHtaccessContents = $htaccessContents;

    // Check if the configuration works before complaining
    $htaccessContents[] = $modRewriteContents;
    file_put_contents($htaccessPath, implode("\n", $htaccessContents));
    if (false !== strstr(self::get($noScriptNameUrl), 'Open-Source PHP Web Framework'))
    {
      return array();
    }

    // TODO: Discriminate between mod_rewrite not enabled and mod_rewrite not
    // configured by putting valid mod_rewrite directives outside <IfModule>
    $checkHtaccessContents[] = $checkModRewriteContents;
    file_put_contents($htaccessPath, implode("\n", $checkHtaccessContents));
    if (false !== strstr(self::get($url), 'Open-Source PHP Web Framework'))
    {
      $htaccess['modRewriteNotConfigured'] = 'modRewriteNotConfigured';
    }

    file_put_contents($htaccessPath, implode("\n", $htaccessContents));

    return $htaccess;
  }

  public static function setNoScriptName($noScriptName, $settingsYmlContents)
  {
    // TODO: Make this pattern more robust, or parse the YAML?
    $pattern = '/^(prod:\v+  .settings:\v+    no_script_name:\h*)[^\v]+/';
    $replacement = '\1'.($noScriptName ? 'on' : 'off');

    return preg_replace($pattern, $replacement, $settingsYmlContents);
  }

  public static function checkSettingsYml($noScriptName)
  {
    $settingsYml = array();

    $settingsYmlPath = sfConfig::get('sf_app_config_dir').'/settings.yml';

    // Read settings.yml contents from existing settings.yml, settings.yml.tmpl
    // (for a Subversion checkout), or symfony skeleton settings.yml, whichever
    // is found first
    $settingsYmlPaths = array();
    $settingsYmlPaths[] = $settingsYmlPath;
    $settingsYmlPaths[] = $settingsYmlPath.'.tmpl';
    $settingsYmlPaths[] = sfConfig::get('sf_lib_dir').'/task/generator/skeleton/app/app/config/settings.yml';

    foreach ($settingsYmlPaths as $path)
    {
      if (false !== $settingsYmlContents = file_get_contents($path))
      {
        break;
      }
    }

    $settingsYmlContents = sfInstall::setNoScriptName($noScriptName, $settingsYmlContents);

    if (false === file_put_contents($settingsYmlPath, $settingsYmlContents))
    {
      $settingsYml['notWritable'] = 'notWritable';
    }

    $dispatcher = sfContext::getInstance()->getEventDispatcher();
    $formatter = new sfAnsiColorFormatter;

    chdir(sfConfig::get('sf_root_dir'));

    // FIXME: By instantiating a new application configuration the cache clear
    // task may change these settings, leading to bugs in code which expects
    // them to remain constant
    $saveDebug = sfConfig::get('sf_debug');
    $saveLoggingEnabled = sfConfig::get('sf_logging_enabled');

    // FIXME: We do not want to cache anything during install, but currently we
    // must clear the cache after adding enabling sfInstallPlugin : (
    $cacheClear = new sfCacheClearTask($dispatcher, $formatter);
    $cacheClear->run();

    sfConfig::set('sf_debug', $saveDebug);
    sfConfig::set('sf_logging_enabled', $saveLoggingEnabled);

    return $settingsYml;
  }

  /**
   * Check that memory_limit ini value meets Qubit's minimum requirements
   * (currently 64 MB)
   *
   * @return current memory limit if less than 64M
   */
  public static function checkMemoryLimit()
  {
    $memoryLimit = ini_get('memory_limit');

    // Convert memoryLimit to float or integer value in units of MB
    // See http://ca.php.net/manual/en/faq.using.php#faq.using.shorthandbytes
    switch (strtolower(substr($memoryLimit, -1)))
    {
      case 'k':
        $memoryLimit = round(intval(substr($memoryLimit, 0, -1))/1024, 3);
        break;
      case 'm':
        $memoryLimit = intval(substr($memoryLimit, 0, -1));
        break;
      case 'g':
        $memoryLimit = intval(substr($memoryLimit, 0, -1))*1024;
        break;
      default:
        // If suffix is not K, M, or G (case-insensitive), then value is assumed to be bytes
        $memoryLimit = round(intval($memoryLimit)/1048576, 3);
    }

    if ($memoryLimit < self::$MINIMUM_MEMORY_LIMIT_MB)
    {
      return $memoryLimit;
    }
  }

  public static function configureDatabase(array $options = array())
  {
    $database = array();

    $dsn = 'mysql:dbname='.$options['databaseName'].';host='.$options['databaseHost'];
    if (isset($options['databasePort']))
    {
      $dsn .= ';port='.$options['databasePort'];
    }

    $arguments = array();
    $arguments[] = $dsn;

    if (isset($options['databaseUsername']))
    {
      $arguments[] = $options['databaseUsername'];

      if (isset($options['databasePassword']))
      {
        $arguments[] = $options['databasePassword'];
      }
    }

    $dispatcher = sfContext::getInstance()->getEventDispatcher();
    $formatter = new sfAnsiColorFormatter;

    chdir(sfConfig::get('sf_root_dir'));

    $configureDatabase = new sfConfigureDatabaseTask($dispatcher, $formatter);
    $configureDatabase->run($arguments);

    // FIXME: By instantiating a new application configuration the cache clear
    // task may change these settings, leading to bugs in code which expects
    // them to remain constant
    $saveDebug = sfConfig::get('sf_debug');
    $saveLoggingEnabled = sfConfig::get('sf_logging_enabled');

    // FIXME: We do not want to cache anything during install, but currently we
    // must clear the cache after configuring the database : (
    $cacheClear = new sfCacheClearTask($dispatcher, $formatter);
    $cacheClear->run();

    sfConfig::set('sf_debug', $saveDebug);
    sfConfig::set('sf_logging_enabled', $saveLoggingEnabled);

    $databaseManager = sfContext::getInstance()->databaseManager;

    // FIXME: Currently need to reload after configuring the database
    $databaseManager->loadConfiguration();

    try
    {
      sfContext::getInstance()->getDatabaseConnection('propel');
    }
    catch (Exception $e)
    {
      $database[] = $e;
    }

    return $database;
  }

  public static function insertSql()
  {
    $arguments = array();

    $options = array();
    $options[] = 'no-confirmation';

    $dispatcher = sfContext::getInstance()->getEventDispatcher();
    $formatter = new sfAnsiColorFormatter;

    chdir(sfConfig::get('sf_root_dir'));

    $insertSql = new sfPropelInsertSqlTask($dispatcher, $formatter);
    $insertSql->run($arguments, $options);
  }

  public static function loadRoot()
  {
    $object = new QubitInformationObject;
    $object->setId(QubitInformationObject::ROOT_ID);
    $object->save();
  }

  public static function loadData()
  {
    $dispatcher = sfContext::getInstance()->getEventDispatcher();
    $formatter = new sfAnsiColorFormatter;

    chdir(sfConfig::get('sf_root_dir'));

    $loadData = new sfPropelLoadDataTask($dispatcher, $formatter);
    $loadData->run();
  }
}
