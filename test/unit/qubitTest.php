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

require_once dirname(__FILE__).'/../bootstrap/unit.php';

// Is this the best way to ship path info prefix into ::pathInfo()? I think
// using a real sfWebRequest means including some of its behavior in tests,
// which is possibly not what we want. Should we stub sfContext too? Or ship
// path info prefix into ::pathInfo() some other way?
class sfWebRequestStub
{
  public function getPathInfoPrefix()
  {
    return $this->pathInfoPrefix;
  }
}

$configuration = ProjectConfiguration::getApplicationConfiguration('qubit', 'test', true);
sfContext::createInstance($configuration)->request = new sfWebRequestStub;

$t = new lime_test(2, new lime_output_color);

sfContext::getInstance()->request->pathInfoPrefix = '/aaa/bbb';

$t->is(Qubit::pathInfo('/aaa/bbb/ccc/ddd'), '/ccc/ddd',
  '"::pathInfo()" with prefix');

sfContext::getInstance()->request->pathInfoPrefix = null;

$t->is(Qubit::pathInfo('/aaa/bbb/ccc/ddd'), '/aaa/bbb/ccc/ddd',
  '"::pathInfo()" without prefix');
