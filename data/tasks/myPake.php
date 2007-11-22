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

pake_desc('FIXME');
pake_task('fix-code');

function run_fix_code($task, $args)
{
  if (count($args) < 1)
  {
    throw new Exception('You must provide a file path.');
  }

  foreach ($args as $filePath)
  {
    $fileContents = file_get_contents($filePath);

    // Use consistent line endings
    $fileContents = preg_replace("/\r\n/", "\n", $fileContents);

    // Remove trailing whitespace from lines
    $fileContents = preg_replace("/[ \t]+\n/", "\n", $fileContents);

    // Remove trailing empty lines from file
    $fileContents = preg_replace("/\n+$/", "\n", $fileContents);

    // Use this file's preamble
    $preamble = preg_replace('/\*\/.*$/s', '*/', file_get_contents(__FILE__));
    $fileContents = preg_replace('/^.*?\*\//s', $preamble, $fileContents);

    // Fix control signature
    $fileContents = preg_replace('/for *\(/', 'for (', $fileContents);
    $fileContents = preg_replace('/foreach *\(/', 'foreach (', $fileContents);
    $fileContents = preg_replace('/if *\(/', 'if (', $fileContents);

    // Fix elseif
    $fileContents = preg_replace('/elseif/', 'else if', $fileContents);

    if (!file_put_contents($filePath, $fileContents))
    {
      throw new Exception('FIXME');
    }
  }
}
