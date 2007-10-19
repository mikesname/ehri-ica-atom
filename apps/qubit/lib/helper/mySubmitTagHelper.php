<?php

/*
 * This file is part of the Qubit Toolkit.
 *
 * For the full copyright and license information, please view the COPYRIGHT
 * and LICENSE files that were distributed with this source code.
 *
 * Copyright (C) 2006-2007 Peter Van Garderen <peter@artefactual.com>
 *
 * This library is free software; you can redistribute it and/or modify it
 * under the terms of the GNU Lesser General Public License as published by the
 * Free Software Foundation; either version 2.1 of the License, or (at your
 * option) any later version.
 *
 * This library is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Lesser General Public License
 * for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with this library; if not, write to the Free Software Foundation,
 * Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

/**
 * Returns an XHTML compliant <input> tag with type="submit" and a CSS class name that corresponds to $value
 *
 * This custom helper overrides the default Symfony submit_tag Helper by adding a CSS class (which is assigned the name
 * of the $value value so that the button can by styled using class name as a CSS selector)
 *
 * By default, this helper creates a submit tag with a name of <em>commit</em> to avoid
 * conflicts with other parts of the framework.  It is recommended that you do not use the name
 * "submit" for submit tags unless absolutely necessary. Also, the default <i>$value</i> parameter
 * (title of the button) is set to "Submit", which can be easily overwritten by passing a
 * <i>$value</i> parameter.
 *
 * <b>Examples:</b>
 * <code>
 *  echo submit_tag();
 * </code>
 *
 * <code>
 *  echo submit_tag('Update Record');
 * </code>
 *
 * @param  string field value (title of submit button)
 * @param  array  additional HTML compliant <input> tag parameters
 * @return string XHTML compliant <input> tag with type="submit"
 */
function my_submit_tag($value = 'submit', $options = array())
{
  return tag('input', array_merge(array('type' => 'submit', 'name' => 'commit', 'class' => 'submit', 'value' => $value, 'onmouseover' => "this.className='submithover'", 'onmouseout' => "this.className='submit'"), _convert_options($options)));
}
