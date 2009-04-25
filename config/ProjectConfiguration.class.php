<?php

require_once dirname(__FILE__).'/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    $this->enablePlugins(array(
      'sfAuditPlugin',
      'sfDrupalPlugin',
      'sfHistoryPlugin',
      'sfInstallPlugin',
      'sfLucenePlugin',
      'sfPluginAdminPlugin',
      'sfSearchPlugin',
      'sfThemePlugin',
      'sfThumbnailPlugin',
      'sfTranslatePlugin'));
  }
}
