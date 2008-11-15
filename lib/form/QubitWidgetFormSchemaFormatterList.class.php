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

/**
 * Form decorator for <table class="list"> css definition.
 * 
 * @package    qubit
 * @subpackage forms
 * @version    svn: $Id$
 * @author     David Juhasz <david@artefactual.com>
 */
class QubitWidgetFormSchemaFormatterList extends sfWidgetFormSchemaFormatter 
{ 
  protected 
    $rowFormat = "<tr>\n <td><span title=\"%help%\">%label%</td>\n <td>%error%%field%%hidden_fields%</td>\n</tr>\n",
    $helpFormat = '%help%',
    $errorRowFormat = "<tr><td colspan=\"2\">\n%errors%</td></tr>\n",
    $errorListFormatInARow = " <ul class=\"validation_error\">\n%errors% </ul>\n",
    $errorRowFormatInARow = " <li>%error%</li>\n",
    $namedErrorRowFormatInARow = " <li>%name%: %error%</li>\n",
    $decoratorFormat = "<table>\n %content%</table>";
}

?>