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

function format_script($script_iso, $culture = null)
{
  $c = sfCultureInfo::getInstance($culture === null ? sfContext::getInstance()->user->getCulture() : $culture);
  $scripts = $c->getScripts();

  if (!isset($scripts[$script_iso]))
  {
    $c = sfCultureInfo::getInstance(sfConfig::get('sf_default_culture'));
    $scripts = $c->getScripts();
  }

  return isset($scripts[$script_iso]) ? $scripts[$script_iso] : '';
}

function render_field($field, $resource, array $options = array())
{
  $options += array('name' => $field->getName());

  $div = null;
  $culture = sfContext::getInstance()->user->getCulture();
  if (isset($resource) && $culture != $resource->sourceCulture && 0 < strlen($source = $resource->__get($options['name'], array('sourceCulture' => true))))
  {
    // TODO Are there cases where the direction of this <div/>'s containing
    // block isn't the direction of the current culture?
    $dir = null;
    $sourceCultureInfo = sfCultureInfo::getInstance($resource->sourceCulture);
    if (sfCultureInfo::getInstance($culture)->direction != $sourceCultureInfo->direction)
    {
      $dir = " dir=\"$sourceCultureInfo->direction\"";
    }

    $div = <<<div
<div class="default-translation"$dir>
  $source
</div>

div;
  }

  unset($options['name']);

  return <<<return
<div class="form-item">
  {$field->renderLabel()}
  {$field->renderError()}
  $div
  {$field->render($options)}
  {$field->renderHelp()}
</div>

return;
}

function render_show($label, $value)
{
  return <<<return
<div class="field">
  <h3>$label</h3>
  <div>
    $value
  </div>
</div>

return;
}

function render_show_repository($label, $resource)
{
  if (isset($resource->repository))
  {
    return render_show($label, link_to(render_title($resource->repository), array($resource->repository, 'module' => 'repository')));
  }

  foreach ($resource->ancestors->orderBy('rgt') as $item)
  {
    if (isset($item->repository))
    {
      return render_show($label, link_to(render_title($item->repository), array($item->repository, 'module' => 'repository'), array('title' => __('Inherited from %1%', array('%1%' => $item)))));
    }
  }
}

function render_title($value)
{
  // TODO Workaround for PHP bug, http://bugs.php.net/bug.php?id=47522
  if (method_exists($value, '__toString'))
  {
    $value = $value->__toString();
  }

  if (0 < strlen($value))
  {
    return (string) $value;
  }

  return '<em>'.sfContext::getInstance()->i18n->__('Untitled').'</em>';
}

function render_value($value)
{
  ProjectConfiguration::getActive()->loadHelpers('Text');

  $value = auto_link_text($value);

  // Simple lists
  $value = preg_replace('/(?:^\*.*\r?\n)*(?:^\*.*)/m', "<ul>\n$0\n</ul>", $value);
  $value = preg_replace('/(?:^-.*\r?\n)*(?:^-.*)/m', "<ul>\n$0\n</ul>", $value);
  $value = preg_replace('/^(?:\*|-)\s*(.*)(?:\r?\n)?/m', '<li>$1</li>', $value);

  $value = preg_replace('/(?:\r?\n){2,}/', "</p><p>", $value, -1, $count);
  if (0 < $count)
  {
    $value = "<p>$value</p>";
  }

  $value = preg_replace('/\r?\n/', '<br/>', $value);

  return $value;
}

function render_markdown($value)
{
  ProjectConfiguration::getActive()->loadHelpers('Text');

  $value = auto_link_text($value);

  // Simple lists
  $value = preg_replace('/(?:^\*.*\r?\n)*(?:^\*.*)/m', "\n\n", $value);
  $value = preg_replace('/(?:^-.*\r?\n)*(?:^-.*)/m', "\n\n", $value);
  $value = preg_replace('/^(?:\*|-)\s*(.*)(?:\r?\n)?/m', " - $1\n\n", $value);

  $value = preg_replace('/(?:\r?\n){2,}/', "\n\n", $value, -1, $count);
  if (0 < $count)
  {
    $value = "\n\n$value\n\n";
  }

  $value = preg_replace('/\r?\n/', "\n", $value);

  return $value;
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
