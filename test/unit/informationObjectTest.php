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

require_once(dirname(__FILE__).'/../bootstrap/unit.php');

require_once($sf_symfony_lib_dir.'/util/sfSimpleAutoload.class.php');
require_once($sf_symfony_lib_dir.'/util/sfToolkit.class.php');
$autoload = sfSimpleAutoload::getInstance(sfToolkit::getTmpDir().'/sf_autoload_unit_'.md5(__FILE__).'.data');
$autoload->addDirectory($sf_symfony_lib_dir);
$autoload->addDirectory(SF_ROOT_DIR.'/lib/model');
$autoload->register();

set_include_path(get_include_path().PATH_SEPARATOR.$sf_symfony_lib_dir.'/plugins/sfPropelPlugin/lib/vendor');

$t = new lime_test(2, new lime_output_color);

// ->__toString()
$t->diag('->__toString()');

$informationObject = new InformationObject;
$t->isa_ok($informationObject->__toString(), 'string',
  '->__toString returns a string');

$informationObject->setTitle('test title');
$t->is($informationObject->__toString(), 'test title',
  '->__toString returns the title');
