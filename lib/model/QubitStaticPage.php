<?php

/*
 * This file is part of the Qubit Toolkit.
 * Copyright (C) 2006-2008 Peter Van Garderen <peter@artefactual.com>
 *
 * This program is free software; you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the Free
 * Software Foundation; either version 2 of the License, or (at your option)
 * any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Lesser General Public License
 * for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, write to the Free Software Foundation, Inc., 51
 * Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

class QubitStaticPage extends BaseStaticPage
{
/*FIXME: This function is disabled because it is causing a bug
see http://code.google.com/p/qubit-toolkit/issues/detail?id=197

	// TODO: This function still needs an exception that checks to see if the permalink name is unique
	public function setTitle($value, array $options = array())
	{
		parent::setTitle($value);

		// only generate the permalink if one does not already exist to avoid clobbering
		if (!$this->getPermalink())
		{
			$this->setPermalink(StaticPageFormat::stripText($value));
		}
	}
*/
}
