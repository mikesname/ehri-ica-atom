<?php

/*
 * This file is part of Qubit Toolkit.
 *
 * Qubit Toolkit is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
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
 * EAC representation of an Actor
 *
 * @package    qubit
 * @subpackage sfEacPlugin
 * @author     Jack Bates <jack@artefactual.com>
 * @version    SVN: $Id$
 */

class sfEacPluginIndexAction extends ActorIndexAction
{
  public function responseFilterContent(sfEvent $event, $content)
  {
    require_once sfConfig::get('sf_root_dir').'/vendor/FluentDOM/FluentDOM.php';

    return FluentDOM($content)
      ->namespaces(array('eac' => 'urn:isbn:1-931666-33-4'))
      ->find('//eac:languageDeclaration[not(*)]')
      ->remove();
  }

  public function execute($request)
  {
    parent::execute($request);

    $this->eac = new sfEacPlugin($this->resource);

    $this->dispatcher->connect('response.filter_content', array($this, 'responseFilterContent'));
  }
}
