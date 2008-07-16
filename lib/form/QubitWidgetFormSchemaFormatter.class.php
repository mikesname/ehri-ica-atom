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

class QubitWidgetFormSchemaFormatter extends sfWidgetFormSchemaFormatter
{
// FIXME: Why does PHP not like this?
//  protected
//    $rowFormat = <<<EOF
//<div class="form-item">
//  %label%
//  %error%%field%
//  %help%%hidden_fields%
//</div>
//
//EOF;

  protected
    $errorListFormatInARow = "<div class=\"messages error\">\n  <ul>\n    %errors%\n  </ul>\n</div>\n",
    $helpFormat = "<div class=\"description\">\n  %help%\n</div>\n",
    $rowFormat = "<div class=\"form-item\">\n  %label%\n  %error%%field%\n  %help%%hidden_fields%\n</div>\n";
}
