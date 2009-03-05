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

class siteSettingsFilter extends sfFilter
{
  /*
   * execute this filter on every request in case some params have changed since the last page load
   */
  public function execute($filterChain)
  {
    // create a function cache object for the QubitSettings method call
    //$fileCache = new sfFileCache(array('cache_dir' => sfConfig::get('sf_app_cache_dir').'/settings'));

    // invalidate cache when user switches culture
    // FIXME: there must be a smarter way to detect this accurately; user culture is set very early after routing
    if ($this->getContext()->getRequest()->getParameter('sf_culture'))
    {
      //$fileCache->clean();
    }

    //$functionCache = new sfFunctionCache($fileCache);

    // get settings (from cache if it exists)
    //$settings = $functionCache->call(array(new QubitSetting, 'getSettingsArray'));
    $settings = QubitSetting::getSettingsArray();

    // overwrite/populate settings into sfConfig object
    sfConfig::add($settings);

    $this->setSiteTitle();

    // Set routing default parameters so that links to create, edit and show actions
    // get routed to default actions
    $this->context->getRouting()->setDefaultParameters(array('informationobject_template' => sfConfig::get('app_default_template_informationobject'), 'actor_template' => sfConfig::get('app_default_template_actor'), 'repository_template' => sfConfig::get('app_default_template_repository')));

    // execute next filter
    $filterChain->execute();
  }

  protected function setSiteTitle()
  {
    $title = strip_tags(sfConfig::get('app_site_information_site_title'));
    $desc  = strip_tags(sfConfig::get('app_site_information_site_description'));

    if (strlen($title) && strlen($desc))
    {
      $title = $title.' - '.$desc;
    }
    else
    {
      $title .= $desc;
    }

    $this->getContext()->getResponse()->setTitle($title);
  }
}
