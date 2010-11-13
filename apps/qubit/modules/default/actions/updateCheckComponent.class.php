<?php

/*
 * This file is part of Qubit Toolkit.
 *
 * Qubit Toolkit is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * (at your option) any later version.
 *
 * Qubit Toolkit is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Qubit Toolkit.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Check for updates component
 *
 * @package qubit
 * @subpackage default
 * @version svn: $Id$
 * @author Jesús García Crespo <correo@sevein.com>
 */
class DefaultUpdateCheckComponent extends sfComponent
{
  public function execute($request)
  {
    if (!$this->context->user->hasCredential('administrator') || !sfConfig::get('app_check_for_updates'))
    {
      return sfView::NONE;
    }

    $this->currentVersion = qubitConfiguration::VERSION;

    $this->updateCheckUrl = 'http://updatecheck.qubit-toolkit.org/check/';

    $this->cookiePath = sfContext::getInstance()->request->getRelativeUrlRoot();
    if (1 > strlen($this->cookiePath))
    {
      $this->cookiePath = '/';
    }

    $this->updateCheckData = array();
    $this->updateCheckData['address'] = $request->getUriPrefix() . $request->getScriptName() . $request->getPathInfo();
    $this->updateCheckData['version'] = qubitConfiguration::VERSION.' - '.sfConfig::get('app_version');

    if (null === ($this->updateCheckData['distribution'] = $this->context->user->getAttribute('distribution')))
    {
      $packageXmlPath = sfConfig::get('sf_config_dir').'/package.xml';
      if (file_exists($packageXmlPath))
      {
        require_once sfConfig::get('sf_root_dir').'/vendor/FluentDOM/FluentDOM.php';

        $fd = FluentDOM($packageXmlPath)
          ->namespaces(array('p' => 'http://pear.php.net/dtd/package-2.0'));

        $this->context->user->setAttribute('distribution', $this->updateCheckData['distribution'] = $fd->find('/*/p:name')->item(0)->textContent);
      }
    }

    $this->updateCheckData['site_description'] = sfConfig::get('app_siteDescription');
    $this->updateCheckData['site_title'] = sfConfig::get('app_siteTitle');

    if (!$request->getCookie('has_js'))
    {
      if (null === ($this->lastVersion = $this->context->user->getAttribute('last_version')))
      {
        try
        {
          $browser = new sfWebBrowser;
          $this->lastVersion = $browser->post($this->updateCheckUrl, $this->updateCheckData)->getResponseText();
        }
        catch (Exception $e)
        {
          $this->lastVersion = 0;
        }

        $this->context->user->setAttribute('last_version', $this->lastVersion);
      }

      if (0 == $this->lastVersion || 1 > version_compare($this->lastVersion, qubitConfiguration::VERSION))
      {
        return sfView::NONE;
      }
    }
  }
}
