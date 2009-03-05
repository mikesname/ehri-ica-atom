<?php

require_once dirname(__FILE__).'/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    $this->enablePlugins(array(
      'sfAuditPlugin',
      'sfCompat10Plugin',
      'sfDrupalPlugin',
      'sfHistoryPlugin',
      'sfInstallPlugin',
      'sfLucenePlugin',
      'sfSearchPlugin',
      'sfThumbnailPlugin',
      'sfTranslatePlugin'));
  }
}
