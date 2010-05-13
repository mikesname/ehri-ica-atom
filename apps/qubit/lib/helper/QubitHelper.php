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

function select_script_tag($name, $selected = null, $options = array())
{
  $c = sfCultureInfo::getInstance(sfContext::getInstance()->getUser()->getCulture());
  $scripts = $c->getScripts();

  if ($script_option = _get_option($options, 'scripts'))
  {
    foreach ($scripts as $key => $value)
    {
      if (!in_array($key, $script_option))
      {
        unset($scripts[$key]);
      }
    }
  }

  asort($scripts);

  $option_tags = options_for_select($scripts, $selected, $options);

  return select_tag($name, $option_tags, $options);
}

function format_script($script_iso, $culture = null)
{
  $c = sfCultureInfo::getInstance($culture === null ? sfContext::getInstance()->getUser()->getCulture() : $culture);
  $scripts = $c->getScripts();

  if (!isset($scripts[$script_iso]))
  {
    $c = sfCultureInfo::getInstance(sfConfig::get('sf_default_culture'));
    $scripts = $c->getScripts();
  }

  return isset($scripts[$script_iso]) ? $scripts[$script_iso] : '';
}

function render_field($field, $object, array $options = array())
{
  $options += array('name' => $field->getName());

  $div = null;
  if (isset($object) && sfContext::getInstance()->user->getCulture() != $object->sourceCulture && 0 < strlen($source = $object->__get($options['name'], array('sourceCulture' => true))))
  {
    $div = <<<EOF
<div class="default-translation">
  $source
</div>

EOF;
  }

  unset($options['name']);

  return <<<EOF
<div class="form-item">
  {$field->renderLabel()}
  {$field->renderError()}
  $div
  {$field->render($options)}
  {$field->renderHelp()}
</div>

EOF;
}

function render_show($label, $value)
{
  return <<<EOF
<div class="field">
  <h3>$label</h3>
  <div>
    $value
  </div>
</div>

EOF;
}

function render_title($object)
{
  // TODO: Workaround for PHP bug, http://bugs.php.net/bug.php?id=47522
  if (method_exists($object, '__toString'))
  {
    $object = $object->__toString();
  }

  if (0 < strlen($object))
  {
    return (string) $object;
  }

  return '<em>Untitled</em>';
}

function render_value($value)
{
  ProjectConfiguration::getActive()->loadHelpers('Text');

  $value = auto_link_text($value);

  $value = preg_replace('/\r?\n/', '<br/>', $value);

  // Simple lists
  $value = preg_replace('/(?:^\*.*\r?\n)*(?:^\*.*)/m', "<ul>\n$0\n</ul>", $value);
  $value = preg_replace('/(?:^-.*\r?\n)*(?:^-.*)/m', "<ul>\n$0\n</ul>", $value);
  $value = preg_replace('/^(?:\*|-)\s*(.*)/m', '<li>$1</li>', $value);

  return $value;
}

function object_select_tree($object, $method, array $options = array())
{
  $response = sfContext::getInstance()->getResponse();

  $response->addJavaScript('/vendor/jquery');
  $response->addJavaScript('/plugins/sfDrupalPlugin/vendor/drupal/misc/drupal');
  $response->addJavaScript('/vendor/yui/yahoo-dom-event/yahoo-dom-event');
  $response->addJavaScript('/vendor/yui/element/element-min');
  $response->addJavaScript('/vendor/yui/button/button-min');
  $response->addJavaScript('/vendor/yui/container/container_core-min');
  $response->addJavaScript('/vendor/yui/menu/menu-min');

  $response->addStylesheet('/vendor/yui/button/assets/skins/sam/button');
  $response->addStylesheet('/vendor/yui/menu/assets/skins/sam/menu');

  if (is_null($relatedClass = _get_option($options, 'related_class')) && preg_match('/^get(.+?)Id$/', $method, $matches) === 1)
  {
    $relatedClass = 'Qubit'.$matches[1];
  }

  $optionsObjects = sfContext::getInstance()->retrieveObjects($relatedClass, _get_option($options, 'peer_method'));

  $selectTreeObjects = array();

  // Hack to parallel the include_blank behavior of select_tag
  if (isset($options['include_blank']))
  {
    $selectTreeObject = array();
    $selectTreeObject['id'] = null;
    $selectTreeObject['text'] = '&nbsp;';

    if (count($optionsObjects) > 0)
    {
      $selectTreeObject['parentId'] = $optionsObjects[0]->getParentId();
    }

    $selectTreeObjects[] = $selectTreeObject;
  }

  foreach ($optionsObjects as $optionsObject)
  {
    $selectTreeObject = array();
    $selectTreeObject['id'] = $optionsObject->getId();
    $selectTreeObject['parentId'] = $optionsObject->getParentId();
    $selectTreeObject['text'] = render_title($optionsObject);

    // Hack to parallel the disabled behavior of options_for_select
    if (isset($options['disabled'][$optionsObject->getId()]))
    {
      $selectTreeObject['disabled'] = true;
    }

    $selectTreeObjects[] = $selectTreeObject;
  }
  $selectTreeObjects = json_encode($selectTreeObjects);

  $options += array('control_name' => _convert_method_to_name($method, $options));
  $options += array('id' => get_id_from_name($options['control_name']));

  $value = $object;
  if (is_object($object))
  {
    $value = _get_object_value($object, $method);
  }

  return select_tag($options['control_name'], options_for_select(_get_options_from_objects($optionsObjects, _get_option($options, 'text_method')), $value, $options), $options).javascript_tag(<<<EOF
Drupal.behaviors = jQuery.extend({ selectTree: {
  attach: function (context)
    {
      $('#$options[id]', context).each(function ()
        {
          function build(objects, parentId)
          {
            var itemdata = [];
            while (objects.length > 0 && objects[0].parentId == parentId)
            {
              var object = objects.shift();
              object.value = object.id;

              var submenu = {};
              submenu.id = '$options[id]_' + object.id;
              submenu.itemdata = build(objects, object.id);
              if (submenu.itemdata.length > 0)
              {
                object.submenu = submenu;
              }

              itemdata.push(object);
            }

            return itemdata;
          }

          var objects = $selectTreeObjects;

          var button = new YAHOO.widget.Button({
            container: this.parentNode,
            label: $('option:selected', this).text(),
            menu: build(objects, objects[0].parentId),
            name: '$options[control_name]',
            selectedMenuItem: $('option:selected', this).get(0),
            type: 'menu' });

          // Change the button label when a menu item is clicked.  Do not use the
          // selectedMenuItemChange event because it fires before a menu item is
          // clicked.
          button.getMenu().subscribe('click', function (type, args)
            {
              // If the target of the event was a MenuItem instance, it will be
              // passed back as the second argument
              if (args[1] != null)
              {
                button.set('label', args[1].cfg.getProperty('text'));
                button.set('selectedMenuItem', args[1]);
              }
            });
        }).remove();
    } } }, Drupal.behaviors);
EOF
  );
}

/**
 * Break a $longString into multiple lines at the closest $whitespaceChars,
 * so no line exceeds the $width. Truncate string if it exceeds
 * $maxLines.
 *
 * @param string  $longString
 * @param integer $width
 * @param integer $maxLines
 * @param array   $whitespaceChars
 * @param string  $linebreak
 */

function string_wrap($longString, $width, $maxLines=3, $whiteSpaceChars = array(' ', '-', '_'), $linebreak='<br />')
{
  $start     = 0;
  $end       = 0;
  $lineCount = 0;

  while ($end < strlen($longString))
  {
    $thisLine = substr($longString, $start, $width);

    if (strlen($thisLine) < $width)
    {
      $end = $start + strlen($thisLine);
    }
    else
    {
      // find the right-most $whiteSpaceChar in $thisLine
      for ($i = strlen($thisLine); $i >= 0; $i--)
      {
        $thisChar = substr($thisLine, $i, 1);
        if (in_array($thisChar, $whiteSpaceChars))
        {
          $end = $start + $i;
          break;
        }
      }

      // If no $whiteSpaceChar found or resulting line length would be
      // less than 1/4 of $width, break arbitrarily at $width
      if ($i < floor($width / 4))
      {
        $end = $start + strlen($thisLine);
      }
    }

    if ($lineCount == ($maxLines - 1))
    {
      // If at $maxLines, maximize length of last line, and add ellipses
      $wrappedLines[$lineCount] = substr($longString, $start, $width - 3);
      if ($end < strlen($longString))
      {
        $wrappedLines[$lineCount] .= '...';
      }
      break;
    }
    else
    {
      // Add current line to $wrappedLines array
      $wrappedLines[$lineCount] = substr($longString, $start, ($end - $start));
    }

    $start = $end;
    $lineCount++;
  } // endwhile

  return implode($linebreak, $wrappedLines);
}

/**
 * Return a human readable file size, using the appropriate SI prefix
 *
 * @param integer $val value in bytes
 * @return string human-readable value with units
 */
function hr_filesize($val)
{
  $units = array('B', 'KiB', 'MiB', 'GiB', 'TiB');
  for ($i = 0; $i < count($units); $i++)
  {
    if ($val / pow(1024, $i + 1) < 1)
    {
      break;
    }
  }

  return round(($val / pow(1024, $i)), 1).' '.$units[$i];
}

/**
 * Collapse unknown or irrelevant month/day (i.e. set to '00')
 *
 * @param string $date original, full ISO-8601 date
 * @return string date collapsed to relevent terms
 */
function collapse_date($date)
{
  $date = str_replace('-00', '', $date);
  $date = preg_replace('/^0+/', '', $date);

  return $date;
}

function date_display($dateObject)
{
  $dateDisplay = '';

  if (0 < strlen($dateObject->getDateDisplay(array('cultureFallback' => true))))
  {
    $dateDisplay = $dateObject->getDateDisplay(array('cultureFallback' => true));
  }
  else if (0 < strlen($dateObject->getStartDate()) && 0 < strlen($dateObject->getEndDate()))
  {
    $dateDisplay = collapse_date($dateObject->getStartDate()).' - '.collapse_date($dateObject->getEndDate());
  }
  else if (0 < strlen($dateObject->getStartDate()))
  {
    $dateDisplay = collapse_date($dateObject->getStartDate());
  }

  return $dateDisplay;
}
