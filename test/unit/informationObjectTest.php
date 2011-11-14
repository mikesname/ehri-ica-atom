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

require_once dirname(__FILE__).'/../bootstrap/unit.php';

$configuration = ProjectConfiguration::getApplicationConfiguration('qubit', 'test', true);

new sfDatabaseManager($configuration);

$t = new lime_test(3, new lime_output_color);

$informationObject = new QubitInformationObject;
$t->isa_ok($informationObject->__toString(), 'string',
  '"->__toString()" returns a string');

$informationObject->title = 'test title';
$t->is($informationObject->__toString(), 'test title',
  '"->__toString()" returns the title');

$informationObject->language = array('en', 'fr');
$t->is($informationObject->language, array('en', 'fr'),
  '"->language" can be set and got');

$informationObject->save();

$informationObject->delete();
