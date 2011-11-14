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

class importBulkTask extends sfBaseTask
{
  protected function configure()
  {
    $this->addArguments(array(
      new sfCommandArgument('folder', sfCommandArgument::REQUIRED, 'The import folder or file')
    ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name', 'qubit'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'cli'),
      new sfCommandOption('noindex', null, sfCommandOption::PARAMETER_OPTIONAL, 'Set to \'true\' to skip indexing on imported objects'),
      new sfCommandOption('schema', null, sfCommandOption::PARAMETER_OPTIONAL, 'Schema to use if importing a CSV file'),
      new sfCommandOption('output', null, sfCommandOption::PARAMETER_OPTIONAL, 'Filename to output results in CSV format'),
      new sfCommandOption('v', null, sfCommandOption::PARAMETER_OPTIONAL, 'Verbose output'),
    ));

    $this->namespace        = 'import';
    $this->name             = 'bulk';
    $this->briefDescription = 'Bulk import multiple XML/CSV files at once';
    $this->detailedDescription = <<<EOF
Bulk import multiple XML/CSV files at once
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    $timer = new QubitTimer; // overall timing

    $context = sfContext::createInstance($this->configuration);

    if (empty($arguments['folder']) || !file_exists($arguments['folder']))
    {
      throw new sfException('You must specify a valid import folder or file');
    }

    // Set indexing preference
    if ($options['noindex'])
    {
      QubitSearch::getInstance()->disabled = true;
    }
    else
    {
      QubitSearch::getInstance()->getEngine()->enableBatchMode();
    }

    if (is_dir($arguments['folder']))
    {
      // Recurse into the import folder
      $files = $this->dir_tree(rtrim($arguments['folder'], '/'));
    }
    else
    {
      $files = array($arguments['folder']);
    }

    // TODO: Add some colour
    $this->log("Importing ".count($files)." files from ".$arguments['folder']." (indexing is ".($options['noindex'] ? "DISABLED" : "ENABLED").") ...\n");

    $count = 0;
    $total = count($files);

    foreach ($files as $file)
    {
      $start = microtime(true);

      // Choose import type based on file extension, eg. csv, xml
      if ('csv' == pathinfo($file, PATHINFO_EXTENSION))
      {
        $importer = new QubitCsvImport;
        $importer->import($file, $options);
      }
      elseif ('xml' == pathinfo($file, PATHINFO_EXTENSION))
      {
        $importer = new QubitXmlImport;
        $importer->import($file, array('strictXmlParsing' => false));
      }
      else
      {
        // Move on to the next file
        continue;
      }

      // Try to free up memory
      unset($importer);

      $count++;
      $split = microtime(true) - $start;

      // Store details if output is specified
      if ($options['output'])
      {
        $rows[] = array($count, $split, memory_get_usage());
      }

      if ($options['v'])
      {
        $this->log(basename($file)." imported (".round($split, 2)." s) (".$count."/".$total.")");
      }
    }

    // Create/open output file if specified
    if ($options['output'])
    {
      $fh = fopen($options['output'], 'w+');
      foreach ($rows as $row)
      {
        fputcsv($fh, $row);
      }

      fputcsv($fh, array('', $timer->elapsed(), memory_get_peak_usage()));
      fclose($fh);
    }

    // Optimize index if enabled
    if (!$options['noindex'])
    {
      QubitSearch::getInstance()->getEngine()->optimize();
    }

    $this->log("\nSuccessfully imported ".$count." XML/CSV files in ".$timer->elapsed()." s. ".memory_get_peak_usage()." bytes used.");
  }

  protected function dir_tree($dir)
  {
    $path = '';
    $stack[] = $dir;

    while ($stack)
    {
      $thisdir = array_pop($stack);

      if ($dircont = scandir($thisdir))
      {
        $i = 0;

        while (isset($dircont[$i]))
        {
          if ($dircont[$i] !== '.' && $dircont[$i] !== '..' && !preg_match('/^\..*/', $dircont[$i]))
          {
            $current_file = "{$thisdir}/{$dircont[$i]}";

            if (is_file($current_file))
            {
              $path[] = "{$thisdir}/{$dircont[$i]}";
            }
            elseif (is_dir($current_file))
            {
              $stack[] = $current_file;
            }
          }

          $i++;
        }
      }
    }

    return $path;
  }
}
