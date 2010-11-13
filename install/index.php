<?php
/*
 * Install script for the Qubit Toolkit.
 * Last modified 2008-04-30 by Mark Jordan.
 */

 /*
 To do:
 -Complete PostgreSQL connection testing and reporting.
 -Add database port and host to config/databases.yml; add SQLite support to config/databases.yml.
 -Check to see if ModRewrite is enabled and if not, issue fatal warning.
 */

 /*
 apache config testing:

 1) .htaccess is working
 2) mod_rewrite is working
 */

 /*
 * This file is part of the Qubit Toolkit.
 * Copyright (C) 2008 Canadian Association of Research Libraries (http://www.carl-abrc.ca/).
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

/*******************************
 * Set some PHP config options *
 *******************************/
set_error_handler('QubitInstallErrorHandler');
set_time_limit(360);

/******************************************************************************************
 * Define 'distribution' variables. $distroy is a placeholder approach -- we need         *
 * need to figure out later how we are going to handle distributing different Qubit apps. *
 *******************************************************************************************/
$distro = 'Qubit Toolkit';
// Used in example settings
$distro_example_string = 'qubit_toolkit';

// $webFiles is a sibling of the install directory; $distroFiles is a child of the install directory.
$webFiles = 'web';
$distroFiles = 'distro';
$cssPath = $distroFiles.'/installer.css';
$logoPath = $distroFiles.'/qubit-logo.gif';

/***********************************************************************************
 * Define some file paths -- Don't change these unless you know what you are doing *
 ***********************************************************************************/
// $fileSystemPathToTarball is the parent of '/install/index.php'. __FILE__ refers to
// '/install/index.php' (i.e., this script) and is also the parent of all the data directories.
$fileSystemPathToTarball = preg_replace('#/install/index.php#', '', __FILE__);
$fileSystemPathToDataFiles = $fileSystemPathToTarball;
$fileSystemPathToWebFiles = $fileSystemPathToDataFiles.'/'.$webFiles;

/******************************************************************************
 * Get variables coming in from the installer web form, or establish defaults *
 ******************************************************************************/
$qubitWebRoot = isset($_REQUEST['qubit_web_root']) ? $_REQUEST['qubit_web_root'] : '';
$qubitDataRoot = isset($_REQUEST['qubit_data_root']) ? $_REQUEST['qubit_data_root'] : '';
$qubitDbType = isset($_REQUEST['qubit_db_type']) ? $_REQUEST['qubit_db_type'] : 'mysqli';
$qubitDbName = isset($_REQUEST['qubit_db_name']) ? $_REQUEST['qubit_db_name'] : '';
$qubitDbUser = isset($_REQUEST['qubit_db_user']) ? $_REQUEST['qubit_db_user'] : '';
$qubitDbPassword = isset($_REQUEST['qubit_db_password']) ? $_REQUEST['qubit_db_password'] : '';
$qubitDbHost = isset($_REQUEST['qubit_db_host']) ? $_REQUEST['qubit_db_host'] : '';
$qubitDbPort = isset($_REQUEST['qubit_db_port']) ? $_REQUEST['qubit_db_port'] : '';

/******************************
 * Run main wrapper functions *
 ******************************/
printHTMLTop();
handleMainForm();
printHTMLBottom();

/*************
 * Functions *
 *************/

/*
 * Checks to see if form has been submitted and routes flow to appropriate function
 */
function handleMainForm()
  {
  if (isset($_REQUEST['run_installer']))
    {
      processMainForm();
    }
    else
    {
      printMainForm();
    }
  }

/*
 * Prints the form with default values defined by previous iteration of form, if applicable
 */
function printMainForm()
  {
  global $distro;
  global $distro_example_string;
  global $qubitWebRoot;
  global $qubitDataRoot;
  global $qubitDbType;
  global $qubitDbName;
  global $qubitDbUser;
  global $qubitDbPassword;
  global $qubitDbHost;
  global $qubitDbPort;
  $serverDocumentRoot = $_SERVER['DOCUMENT_ROOT'];

  // Define user-friendly example values
  $qubit_web_root_example = $serverDocumentRoot.'/'."$distro_example_string/";
  if (preg_match('/^win/i', PHP_OS))
  {
    $qubit_data_root_example = "c:\\datafiles\\data\\$distro_example_string\\";
  }
  else
  {
    $qubit_data_root_example = "/var/opt/data/$distro_example_string/";
  }

  switch ($qubitDbType)
  {
    case 'mysqli':
    default:
      $qubit_db_name_example = $distro_example_string;
      $qubit_db_user_example = $distro_example_string;
      $qubit_db_password_example = 'R9cUre*34 (should contain numbers, capital letters, and punctuation)';
      $qubit_db_host_example = "Leave blank for 'localhost'";
      $qubit_db_port_example = "Leave blank for MySQL default '3306'";
      break;
    case 'pgsql':
      $qubit_db_name_example = $distro_example_string;
      $qubit_db_user_example = $distro_example_string;
      $qubit_db_password_example = 'R9cUre*34 (should contain numbers, capital letters, and punctuation)';
      $qubit_db_host_example = "Leave blank for 'localhost'";
      $qubit_db_port_example = "Leave blank for PostgreSQL default '5432'";
      break;
    case 'pdo_sqlite':
      $qubit_db_name_example = 'For SQLite, use the full path to your db file';
      $qubit_db_user_example = '<span class="not_applicable">Not applicable to SQLite</span>';
      $qubit_db_password_example = '<span class="not_applicable">Not applicable to SQLite</span>';
      $qubit_db_host_example = '<span class="not_applicable">Not applicable to SQLite</span>';
      $qubit_db_port_example = '<span class="not_applicable">Not applicable to SQLite</span>';
      break;
  }

  print <<<END
    <form action="$_SERVER[PHP_SELF]" method="post">
    <label for="web_root">Where do you want to install the $distro web files?</label>
    <input type="text" name="qubit_web_root" id="web_root" size="50" value="$qubitWebRoot"/>
    <span class="example_values">$qubit_web_root_example</span>
    <label for="data_root">Where do you want to install the $distro data files?</label>
    <input type="text" name="qubit_data_root" id="data_root" size="50" value="$qubitDataRoot"/>
    <span class="example_values">$qubit_data_root_example</span>
    <label for="db_type">What type of database are you using?</label>
    <select name="qubit_db_type" id="db_type"/><option
END;

   if ($qubitDbType == 'mysqli')
   {
     print ' selected ';
   }
   print ' value="mysqli">MySQL</option><option ';
   if ($qubitDbType == 'pgsql')
   {
     print ' selected ';
   }
   // print ' value="pgsql">PostgreSQL</option><option ';
   print ' value="pgsql">PostgreSQL</option>';
   // if ($qubitDbType == 'pdo_sqlite')
   // {
     // print ' selected ';
   // }
   // print ' value="pdo_sqlite">SQLite</option>';

   print '</select></p>';

   print <<<END
    <label for="db_name">What is the name of your database?</label>
    <input type="text" name="qubit_db_name" id="db_name" size="50" value="$qubitDbName"/>
    <span class="example_values">$qubit_db_name_example</span>
    <label for="db_user">What is the database username?</label>
    <input type="text" name="qubit_db_user" id="db_user" size="50" value="$qubitDbUser"/>
    <span class="example_values">$qubit_db_user_example</span>
    <label for="db_password">What is the database password?</label>
    <input type="text" name="qubit_db_password" id="db_password" size="50" value="$qubitDbPassword"/>
    <span class="example_values">$qubit_db_password_example</span>

    <p><a href="javascript:;" onmousedown="toggleDiv('advanced_settings');">Advanced settings</a></p>
    <div id="advanced_settings"
END;

  if (!($qubitDbHost =='') || !($qubitDbPort == ''))
  {
    print 'style="display: block;"';
  }
  else
  {
     print 'style="display: none;"';
  }
   print <<<END
    <label for="db_host">What host is the database running on?</label>
    <input type="text" name="qubit_db_host" id="db_host" size="50" value="$qubitDbHost"/>
    <span class="example_values_advanced">$qubit_db_host_example</span>
    <label for="db_port">What port is the database listening on?</label>
    <input type="text" name="qubit_db_port" id="db_port" size="50" value="$qubitDbPort"/>
    <span class="example_values_advanced">$qubit_db_port_example</span>
    </div>
END;

  if (isset($_REQUEST['run_installer']))
  {
    print '<input class="submit_button" type="submit" name="run_installer" value="Rerun installer"/>';
  }
  else
  {
    print '<input class="submit_button" type="submit" name="run_installer" value="Perform pre-installation checks"/>';
  }
   print '</form>';
  }

/*
 * Prints main form, which will be populated with sticky values from last submission, and passes values off
 * to performPreinstallChecks(). If you need to validate any of the input values, do it here.
 */
function processMainForm()
  {
  global $qubitWebRoot;
  if (!preg_match("/\/$/",$qubitWebRoot))
    {
      $qubitWebRoot .= '/';
    }
  global $qubitDataRoot;
  if (!preg_match("/\/$/",$qubitDataRoot))
    {
      $qubitDataRoot .= '/';
    }
  global $qubitDbType;
  global $qubitDbName;
  global $qubitDbUser;
  global $qubitDbPassword;
  global $qubitDbHost;
  global $qubitDbPort;
  printMainForm();
  performPreinstallChecks($qubitWebRoot, $qubitDataRoot, $qubitDbType, $qubitDbName, $qubitDbUser,
    $qubitDbPassword, $qubitDbHost, $qubitDbPort);
  }

/*
 * Performs all pre-installation checks. Calls all checker functions and accumulates any errors reported
 * from them. If no errors are found, calls installQubit(), which copies files, install the db, etc.
 *
 * To add additional checks, create a function that performs the test and add it to the list in this
 * function. Your checker function needs to take in $error as an argument and return $error = TRUE if
 * it encounters a problem, or return $error (which should be false) if it does not encouter an error
 * ($error should be FALSE going into the function). This may seem counter-intuitive but basically we are
 * passing $error along a series of checker functions, and only call installQubit() if all checker functions
 * have returned FALSE. You will also need to pass in any additional arguments that your function needs and
 * report out any problems using reportOnProgress() and returning TRUE.
 */
function performPreinstallChecks($qubitWebRoot, $qubitDataRoot, $qubitDbType, $qubitDbName, $qubitDbUser,
  $qubitDbPassword, $qubitDbHost, $qubitDbPort)
  {
     global $fileSystemPathToTarball;

     printStatusReportTop();
    /*
     * Set the $error variable to FALSE to keep track of whether any errors are reported by
     * the various check_x functions. If $error is false at the end of performPreinstallChecks,
     * we can procede to the installQubit().
     */
    $error = false;
    $error = checkPHPversion($error);
    $error = checkAllowUrlFopen($error);
    $error = checkXMLEnabled($error);
    $error = checkXSLEnabled($error);
    $error = checkOS($error);
    $error = checkExists($error, $qubitWebRoot, 'web root');
    $error = checkExists($error, $qubitDataRoot, 'data directory');
    $error = checkDbType($error, $qubitDbType);
    // This parameter list should work for mysql and pgsql, but not for sqlite
    $error = checkDbConnection($error, $qubitDbType, $qubitDbName, $qubitDbUser, $qubitDbPassword, $qubitDbHost,
      $qubitDbPort);

    /*
     * If everything is OK (i.e., no $error = true returned from the check_x functions),
     * actually install the distribution.
     */
    if ($error)
      {
        // Exit and report that errors reported above need to be fixed.
        print '<p>Sorry, the installer can\'t procede until all the <span class="problem">problems</span> identified below have been fixed.</p>';
        printStatusReportBottom();
      }
      else
      {
        global $distro;

        // Get the web path of this script by removing the server's web root path from $qubitWebRoot.
        $documentRootPattern = '#'.$_SERVER['DOCUMENT_ROOT'].'#';
        $pathToWebsite = preg_replace($documentRootPattern, '', $qubitWebRoot);
        $pathToWebsite .= 'index.php';
        $urlToWebsite = '<a target="_blank" title="Opens your new '.$distro.' site in new browser/tab" href="http://'.$_SERVER['SERVER_NAME'].$pathToWebsite.'/search/buildIndex">'.$distro.'</a>';

        installQubit($qubitWebRoot, $qubitDataRoot);
        printStatusReportBottom();
        print "<p>Congratulations, the installation is complete. Before you leave this page, please perform the following
          post-installation security tasks:</p>";
        print "<ul>";
        print "<li>Remove the installation files at $fileSystemPathToTarball</li>";
        print "<li>Change permissions on $qubitWebRoot so that directory is not writable by your web server</li>";
        print "</ul>";
        print "<p>Test your new instance of the $urlToWebsite (with email admin@qubit-toolkit.org and password admin), and
          if everything looks good, complete the above security tasks. <strong>It is very important that you do not forget
          to do these things!</strong> Not doing them puts your
          website at a high security risk.</p>";
      }
  }

/*
 * Check PHP version
 */
function checkPHPversion($error)
  {
  $phpVersion = phpversion();
  $requiredVersion = '5.2.0';
  if ($phpVersion < $requiredVersion)
  {
    reportOnProgress('Checking PHP version', 'Problem', "PHP version $requiredVersion is required; your version is $phpVersion",
      'Ask your server administrator to upgrade PHP');
    $error = true;
  }
  else
  {
    reportOnProgress('Checking PHP version', 'OK', "Your version of PHP ($phpVersion) meets the minimum requirements (version $requiredVersion)", '');
  }
    return $error;
  }

/*
 * Check whether allow_url_fopen is enabled
 */
function checkAllowUrlFopen($error)
  {
  $allowUrlFopen = ini_get('allow_url_fopen');
  if ($allowUrlFopen == 'Off')
  {
    reportOnProgress("Checking 'allow_url_fopen'", 'Problem', "''allow_url_fopen' is required but not enabled on your server",
      'Ask your server administrator to upgrade PHP');
    $error = true;
  }
  else
  {
    reportOnProgress("Checking 'allow_url_fopen'", 'OK', "'allow_url_fopen' is enabled", '');
  }
    return $error;
  }

/*
 * Check to see if the xml extension is loaded
 */
function checkXMLEnabled($error)
  {
  if (extension_loaded('xml'))
    {
      reportOnProgress('Checking whether XML support is enabled', 'OK', 'XML support is enabled');
    }
    else
    {
      reportOnProgress('Checking whether XML support is enabled', 'Problem', 'XML support is not enabled',
        'Ask your server admin to enable XML support');
      $error = true;
    }
    return $error;
  }

/*
 * Check to see if the xsl extension is loaded
 */
function checkXSLEnabled($error)
  {
  if (extension_loaded('xsl'))
    {
      reportOnProgress('Checking whether XSL support is enabled', 'OK', 'XSL support is enabled');
    }
    else
    {
      reportOnProgress('Checking whether XSL support is enabled', 'Problem', 'XSL support is not enabled',
        'Ask your server admin to enable XSL support');
      $error = true;
    }
    return $error;
  }

/*
 * We don't actually preform a check in this function, since we don't care what the OS is. Good thing
 * to report out however.
 */
function checkOS($error)
  {
    $OS = PHP_OS.' [Environment details: '.$_SERVER['SERVER_SOFTWARE'].']';
    reportOnProgress('Checking operating system', 'OK', "Your operating system is $OS", '');
    return $error;
  }

/*
 * General function for checking the existence of $path, which should be an absolute path on
 * the server's file system.
 */
function checkExists($error, $path, $label)
  {
    if (file_exists($path))
    {
      reportOnProgress("Looking for $label", 'OK', ucfirst($label)." '$path' found", '');
      $error = checkIsWritable($error, $path, $label);
    }
    else
    {
      reportOnProgress("Looking for $label '$path'", 'Problem', ucfirst($label)." '$path' not found",
        "Verify that '$path' exists");
      $error = true;
    }
    return $error;
  }

/*
 * General function for checking the web server user's write permissions on $path, which should be an
 * absolute path on the server's file system.
 */
function checkIsWritable($error, $path, $label)
  {
  if (is_writable($path))
    {
      reportOnProgress("Checking permissions on $label", 'OK', ucfirst($label)." '$path' is writable by the web server user");
    }
    else
    {
      reportOnProgress("Checking permissions on $label '$path'", 'Problem', ucfirst($label)." '$path' is not writable by the web server user",
        "Verify that '$path' is writable by the web server");
      $error = true;
    }
  return $error;
  }

/*
 * See if user's PHP installation has the selected database support enabled.
 */
function checkDbType($error, $qubitDbType)
  {
    if (extension_loaded($qubitDbType))
    {
      reportOnProgress('Checking PHP support for '.$qubitDbType, 'OK', 'PHP support for '.$qubitDbType.' is enabled');
    }
    else
    {
      reportOnProgress('Checking PHP support for '.$qubitDbType, 'Problem', 'PHP support for '.$qubitDbType.' is not enabled',
      "Choose another database type, or ask your server admin to enable PHP support for '$qubitDbType'");
      $error = true;
    }
    return $error;
  }

/*
 * Test connecting to the db.
 */
function checkDbConnection($error, $qubitDbType, $qubitDbName, $qubitDbUser, $qubitDbPassword, $qubitDbHost, $qubitDbPort)
  {
  switch ($qubitDbType)
      {
      case 'mysqli':
        if ($qubitDbHost =='')
        {
          $qubitDbHost = 'localhost';
        }
        if ($qubitDbPort == '')
        {
          $qubitDbPort = '3306';
        }
        $link = mysqli_connect($qubitDbHost, $qubitDbUser, $qubitDbPassword, $qubitDbName, $qubitDbPort);
        $task = "Checking database connection information";
        if (!$link)
        {
          $dbTestResults = sprintf("Connect failed: %s\n", mysqli_connect_error());
          reportOnProgress($task,  'Problem', $dbTestResults, "Verify your MySQL database connection details for database
          '$qubitDbName', database user '$qubitDbUser', password '$qubitDbPassword', host '$qubitDbHost', port '$qubitDbPort'");
          $error = true;
        }
        else
        {
          mysqli_close($link);
          $dbTestResults = 'Connection succeeded';
          reportOnProgress($task,  'OK', $dbTestResults);
          $error = false;
        }
        break;
      case 'pgsql':
        // To do: Complete PostgreSQL connection and reporting
        if ($qubitDbHost =='')
        {
          $qubitDbHost = 'localhost';
        }
        if ($qubitDbPort == '')
        {
          $qubitDbPort = '5432';
        }
        $task = "Checking database connection information";

        break;
      case 'pdo_sqlite':
        // To do: We need to make sure that the sqlite file is writable by the web server, or nothing will work.
        // Then we can do a simple SQL query to see if there are any problems.
        break;
      default:
        reportOnProgress($task,  'Problem', $qubitDbType.' is not supported');
    }
    return $error;
  }

/*
 * Copy files from install tarball, write out config files, and load initial data into db
 */
function installQubit($qubitWebRoot, $qubitDataRoot)
  {
    global $fileSystemPathToWebFiles;
    global $fileSystemPathToDataFiles;

    // Verify that $fileSystemPathToWebFiles and $fileSystemPathToDataFiles exist. Don't bother
    // reporting if they are found.
    if (!file_exists($fileSystemPathToWebFiles))
    {
      reportOnProgress("Verifying location of source files", 'Problem', "Can't find $fileSystemPathToWebFiles",
        "Verify that '$fileSystemPathToWebFiles' exists");
      $error = true;
    }
    if (!file_exists($fileSystemPathToDataFiles))
    {
      reportOnProgress("Verifying location of source files", 'Problem', "Can't find $fileSystemPathToDataFiles",
        "Verify that '$fileSystemPathToDataFiles' exists");
      $error = true;
    }
    // If there are errors, return here since we can't go any further, and we don't want to copy any files.
    // return $error;

    // If we made it this far, copy files needed to install Qubit
    $error = copyFiles($fileSystemPathToWebFiles, $qubitWebRoot, 'web');
    $error = copyFiles($fileSystemPathToDataFiles, $qubitDataRoot, 'data');

    // Write out index.php controller file
    $error = writeIndexPhp($qubitWebRoot.'index.php', $qubitDataRoot.'lib/QubitConfiguration.class.php');

    // Populate db with structure and sample data. We use Symfony's sfPropelInsertSqlTask() and
    // sfPropelLoadDataTask() objects to do this. To do: Trap errors here and report them with
    // reportOnProgress().

    // First, include Symfony config flass, initialize objects
    require_once($qubitDataRoot.'lib/QubitConfiguration.class.php');
    $configuration = new QubitConfiguration('dev', true);
    $dispatcher = new sfEventDispatcher;
    $formatter = new sfAnsiColorFormatter;
    // We need to chdir into the data directory or symfony complains
    chdir($qubitDataRoot);

    // Next, copy template for propel.ini and call a symphony task to populate it and databases.yml
    $error = copyPropelIni($qubitDataRoot.'config/propel.ini.tmpl', $qubitDataRoot.'config/propel.ini');
    $error = writeDatabaseConfigFiles($dispatcher, $formatter);

    // Then, perform SQL tasks. We're no longer checking for $error here, but the user will see errors
    // if these tasks generate any.
    $insertSql = new sfPropelInsertSqlTask($dispatcher, $formatter);
    $insertSql->run();
    $loadData = new sfPropelLoadDataTask($dispatcher, $formatter);
    $loadData->run(array('qubit'));

    // To do: Perform check to see if mod_rewrite is enabled. We do this by issuing an fopen to a Qubit URL

    return $error;
  }

/*
 * Wrapper function for copying files from extracted tarball to destination directories provided by user.
 * $type gets passed through to the recursive functions called by this wrapper.
 *
 * Recursively copying the distribution files to their user-defined destinations consists of two functions:
 * the first, recursiveCreateDestDirs(), popluates an array of directories to create in the target, and
 * then to create the directories. We use an array because we can sort it and therefore create parent
 * directories before child directories. The second function, recursiveCopyFiles(), iterates through
 * the source directory and copies all files into the new directory structure.
 */
function copyFiles($sourceDir, $destinationDir, $type)
  {
    // First, get all directories in $sourceDir and create a corresponding directory in $destinationDir
    $dirsToCreate = recursiveCreateDestDirs($sourceDir, $destinationDir, $type);
    // We sort the directories so we can create parents before children (which is the way they sort)
    sort($dirsToCreate);
    foreach ($dirsToCreate as $dirToCreate)
    {
      if (!file_exists($dirToCreate))
      {
        mkdir($dirToCreate, 0755);
      }
    }

    // Then, actually copy the files
    $error = recursiveCopyFiles($sourceDir, $destinationDir, $type);

    if ($error)
      {
        reportOnProgress("Copying '$sourceDir' to '$destinationDir'", 'Problem', "Could not copy '$sourceDir' to '$destinationDir'",
          "Verify that '$sourceDir' exists and that '$destinationDir' is writable by the web server");
        $error = true;
      }
      else
      {
        reportOnProgress("Copying source files", 'OK', "Copied '$sourceDir' to '$destinationDir'");
        $error = false;
      }
    return $error;
  }

/**
 * Get a list of all the directories from the source directory we need to create in the
 * destination directory. $type indicates which global variable to use in the file path
 * regex. Returns an array of directories to create in the destination directory, and not
 * $error as do monst functions in this script.
 */
function recursiveCreateDestDirs($dirSource, $dirTarget, $type)
  {
    // Use these global variables since we redefine $dirSource repeatedly. Defining a static
    // copy doesn't work since the funcion is used recursively.
    global $fileSystemPathToWebFiles;
    global $fileSystemPathToDataFiles;
    if ($type == 'web')
    {
      $source = $fileSystemPathToWebFiles;
    }
    if ($type == 'data')
    {
      $source = $fileSystemPathToDataFiles;
    }

    // We need to define $dirsToCreate as static so it accumulates all the directories
    // as the function is called recursively.
    static $dirsToCreate;
    if ($handle = opendir($dirSource))
    {
      while (false !== ($file = readdir($handle)))
      {
        if ($file != "." && $file != "..")
        {
          if (is_dir($dirSource.'/'.$file))
          {
            recursiveCreateDestDirs($dirSource.'/'.$file, $dirTarget, $type);
            $sourcePath = $dirSource.'/'.$file;
            $targetPath = preg_replace("#$source#", $dirTarget, $sourcePath);
            $dirsToCreate[] = $targetPath;
          }
        }
      }
      closedir($handle);
    }
    return $dirsToCreate;
  }

/**
 * Write out the index.php controller, incorporating the absolute path to Symphony's QubitConfiguration.class.php.
 */
function writeIndexPhp($controllerPath, $configurationClassPath)
  {
    $fileContents = "<?php\nrequire_once('".$configurationClassPath."');\n";
    $fileContents .= "\n".'$configuration = new QubitConfiguration(\'prod\', false);'."\n".'sfContext::createInstance($configuration)->dispatch();';
    $fh = fopen($controllerPath, 'w');
    if ($fh)
    {
      $fileSize = fwrite($fh, $fileContents);
      fclose($fh);
      if ($fileSize)
      {
        reportOnProgress("Writing controller file", 'OK', "Wrote '$controllerPath'",'');
        return $error = false;
      }
      else
      {
        reportOnProgress("Writing '$controllerPath'", 'Problem', "Can't write '$controllerPath'","");
        return $error = true;
      }
    }
    else
    {
      reportOnProgress("Writing '$controllerPath'", 'Problem', "Can't write '$controllerPath'","");
      return $error = true;
    }
  }

/**
 * Builds DSN and calls symfony task to write out database configuration files.
 */
function writeDatabaseConfigFiles($dispatcher, $formatter)
  {
    global $qubitDbType;
    global $qubitDbName;
    global $qubitDbUser;
    global $qubitDbPassword;
    global $qubitDbHost;
    global $qubitDbPort;

    switch ($qubitDbType)
      {
      case 'mysqli':
        $dsnDbType = 'mysql';
        if ($qubitDbHost =='')
        {
          $qubitDbHost = 'localhost';
        }
        if ($qubitDbPort == '')
        {
          $qubitDbPort = '3306';
        }
        $dsn = $dsnDbType.'://'.$qubitDbUser.':'.$qubitDbPassword.'@'.$qubitDbHost.'/'.$qubitDbName;
        break;
      case 'pgsql':
        $dsnDbType = 'pgsql'; // To do: Verify this string
        if ($qubitDbHost =='')
        {
          $qubitDbHost = 'localhost';
        }
        if ($qubitDbPort == '')
        {
          $qubitDbPort = '5432';
        }
        $dsn = $dsnDbType.'://'.$qubitDbUser.':'.$qubitDbPassword.'@'.$qubitDbHost.'/'.$qubitDbName;
        break;
      case 'pdo_sqlite':
        $dsnDbType = 'sqlite';
        $fileContents .= 'phptype:  '.$dsnDbType;
        // To do: This is incomplete: we need to add the SQLite db filename. However, we haven't integrated SQLite
        // support into the user-supplied config settings form yet.
        $dsn = "%SF_DATA_DIR%/".$SQLiteDbFile;
        break;
       }

       // Call configure database task
       $configureDatabase = new sfConfigureDatabaseTask($dispatcher, $formatter);
       $configureDatabase->run(array($dsn));

       // To do: Add error checking for this symfony task
       reportOnProgress("Writing database configuration files", 'OK', "Database configured","");
       return $error = true;
  }

/**
 * Copy the propel.ini file from the template provided in the distribution tarball to its expected
 * location.
 */
function copyPropelIni($template, $production)
  {
     $copy_success = copy($template, $production);
     if ($copy_success)
     {
      reportOnProgress("Copying Propel configuration file", 'OK', "Copied '$production'",'');
      $error = false;
     }
     else
     {
       reportOnProgress("Copying Propel configuration file", 'Problem', "Can't copy '$template' to '$production'","");
       $error = true;
     }
     return $error;
  }

/**
 * Recurse down the source directory and copy each regular file found into its corresponding
 * directory in the destination directory. Assumes that all destination directories already exist.
 * Returns $error = true if copying fails, false otherwise.
 */
function recursiveCopyFiles($dirSource, $dirTarget, $type)
  {
    // Use these global variables since we redefine $dirSource repeatedly. Defining a static
    // copy doesn't work since the funcion is used recursively.
    global $fileSystemPathToWebFiles;
    global $fileSystemPathToDataFiles;
    if ($type == 'web')
    {
      $source = $fileSystemPathToWebFiles;
    }
    if ($type == 'data')
    {
      $source = $fileSystemPathToDataFiles;
    }

    if ($handle = opendir($dirSource))
    {
      $error = false;
      while (false !== ($file = readdir($handle)))
      {
        if ($file != "." && $file != "..")
        {
          if (is_dir($dirSource.'/'.$file))
          {
            recursiveCopyFiles($dirSource.'/'.$file, $dirTarget, $type);
          }
          else
          {
            $sourcePath = $dirSource.'/'.$file;
            $targetPath = preg_replace("#$source#", $dirTarget, $sourcePath);
            $copy_success = copy($sourcePath, $targetPath);
            if ($copy_success !== true)
            {
              closedir($handle);
              return true;
            }
          }
        }
      }
    }
    closedir($handle);
  }

/*
 * General function for reporting errors to the user. $result can be one of 'OK', 'Warning', or 'Problem'.
 */
function reportOnProgress($task, $result, $details, $solution)
  {
    switch ($result)
      {
      case 'OK':
        $class = 'ok';
        break;
      case 'Warning':
        $class = 'warning';
        break;
      case 'Problem':
        $class = 'problem';
        break;
      }
      print '<tr><td>'.$task.'</td><td class="'.$class.'">'.$result.'</td><td>'.$details.'</td><td>'.$solution.'</tr>'."\n";
    }

function printHTMLTop()
  {
    global $distro;
    global $distroFiles;
    global $cssPath;
    global $logoPath;
    print <<<END
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
    <head>
    <title>$distro Installer<title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" type="text/css" href="$cssPath"/>
    <script language="javascript">
    function toggleDiv(divid){
      if(document.getElementById(divid).style.display == 'none'){
        document.getElementById(divid).style.display = 'block';
      }else{
        document.getElementById(divid).style.display = 'none';
      }
    }
    </script>
    </head>
    <body>
    <img src="$logoPath">
    <h1>Welcome to the $distro installer</h1>
END;
  }

function printHTMLBottom()
  {
    print "</body>\n</html>";
  }

function  printStatusReportTop()
  {
    print '<table id="status">'."\n".'<tr><th class="status">Installation task</th><th class="status">Status</th><th class="status">Details</th><th class="status">Solution</th></tr>'."\n";
  }

function  printStatusReportBottom()
  {
    print "</table>\n";
  }

/*
 * Do we need this, since we should be checking explicitly for things like file permissions, db connections, etc.?
 * Maby use this custom error handler during development and to catch any errors we don't check for?
 */
function QubitInstallErrorHandler($errorNum, $errorStr, $errorFile, $errorLine)
  {
  // print '<div style="background: #DA70D6; padding: 5px; margin-bottom: 1em;">$errorStr is ' .
    // $errorStr . '(line $errorLine)</div>';
/*
  switch ($errorNum) {
    case E_USER_ERROR;
    case E_USER_WARNING:
    case E_USER_NOTICE:
   }

   function customError($errno, $errstr)
 {
 print "<strong>Error:</strong> [$errno] $errstr<br/>";
 print "Ending Script";
 die();
 }
*/

   /* Don't execute PHP internal error handler */
   return true;
  }

// End of installer
