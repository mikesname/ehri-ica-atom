<?php

class sfInstallPluginCheckAction extends sfAction
{
  public function execute($request)
  {
    $this->qubitWikiIndexUrl = 'http://qubit-toolkit.org/wiki/index.php';
  }
}
