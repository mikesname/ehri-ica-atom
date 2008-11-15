<?php

/*
 * This file is part of the sfAuditPlugin package.
 * (c) 2007 Jack Bates <ms419@freezone.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class AuditTask extends sfBaseTask
{
  protected
    $patternConfigs = null;

  public static function globToPattern($glob)
  {
    $pattern = '';

    // PREG_SPLIT_NO_EMPTY is a possibly unnecessary optimization
    foreach (preg_split('/(\*|\/\/|\?)/', $glob, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE) as $token)
    {
      switch ($token)
      {
        case '*':
          $pattern .= '[^/]*';
          break;

        case '//':
          $pattern .= '/(?:.*/)?';
          break;

        case '?':
          $pattern .= '[^/]';
          break;

        default:
          $pattern .= preg_quote($token);
      }
    }

    return $pattern;
  }

  /**
   * @see sfTask
   */
  public function initialize(sfEventDispatcher $dispatcher, sfFormatter $formatter)
  {
    parent::initialize($dispatcher, $formatter);

    // Register this plugin's lib directory with the autoloader, for
    // autoloading SvnFinder and PHP_CodeSniffer
    $autoloader = sfSimpleAutoload::getInstance();
    $autoloader->addDirectory(dirname(__FILE__).'/..');
    $autoloader->register();

    $globConfigs = sfYaml::load(dirname(__FILE__).'/../../config/audit.yml');

    $this->patternConfigs = array();
    foreach ($globConfigs as $glob => $globConfig)
    {
      // Globs like //foo/... must be matched against paths with a leading
      // slash, while globs like foo/... must be matched against paths without
      // a leading slash.  Consequently, prefix all globs with slash, if
      // necessary, and always match against paths with a leading slash.
      if (strncmp($glob, '/', 1) != 0)
      {
        $glob = '/'.$glob;
      }

      $pattern = self::globToPattern($glob);
      $this->patternConfigs[$pattern] = $globConfig;
    }
  }

  /**
   * @see sfTask
   */
  protected function configure()
  {
    $this->addArguments(array(
      new sfCommandArgument('path', sfCommandArgument::OPTIONAL, 'Filesystem path to the file or directory to audit', sfConfig::get('sf_root_dir'))));

    $this->name = '';
    $this->briefDescription = 'FIXME';
    $this->detailedDescription = <<<EOF
FIXME
EOF;
  }

  protected function getConfigForPath($path)
  {
    if (strncmp($path, sfConfig::get('sf_root_dir'), $len = strlen(sfConfig::get('sf_root_dir'))) == 0)
    {
      $path = substr($path, $len);
    }

    $config = array();
    foreach ($this->patternConfigs as $pattern => $patternConfig)
    {
      if (preg_match('/^'.str_replace('/', '\\/', $pattern).'$/', $path) > 0)
      {
        $config = sfToolkit::arrayDeepMerge($config, $patternConfig);
      }
    }

    return $config;
  }

  protected function getPropsFromPath($path)
  {
    // TODO: Find a better way to parse this?
    $pattern = '/K \d+\n(\V+)\nV \d+\n(\V+)\n/';

    $paths = array();
    $paths[] = dirname($path).'/.svn/props/'.basename($path).'.svn-work';
    $paths[] = dirname($path).'/.svn/prop-base/'.basename($path).'.svn-base';

    foreach ($paths as $path)
    {
      if (file_exists($path))
      {
        if (false === $contents = file_get_contents($path))
        {
          // TODO: Error handling
        }

        break;
      }
    }

    if (false === preg_match_all($pattern, $contents, $matches, PREG_SET_ORDER))
    {
      // TODO: Error handling
    }

    $props = array();
    foreach ($matches as $match)
    {
      $props[$match[1]] = $match[2];
    }

    return $props;
  }

  /**
   * @see sfTask
   */
  protected function execute($arguments = array(), $options = array())
  {
    // Call realpath() before constructing PHP_CodeSniffer because the
    // constructor changes our current working directory.  An argument handler
    // which sanitized user input would be nice:
    // http://trac.symfony-project.com/ticket/3486
    $arguments['path'] = realpath($arguments['path']);

    $phpcs = new PHP_CodeSniffer;

    $finder = new SvnFinder;
    foreach ($finder->in($arguments['path']) as $path)
    {
      $config = $this->getConfigForPath($path);
      if (!isset($config['code']['standard']) && !isset($config['preamble']) && !isset($config['props']))
      {
        continue;
      }

      // HACK: It is not easy to modify a file's token listeners after it is
      // constructed, so construct a populated file if the code standard is
      // defined, and an empty file otherwise
      if (isset($config['code']['standard']))
      {
        $listeners = $phpcs->getTokenListeners($config['code']['standard']);
        $phpcsFile = new PHP_CodeSniffer_File($path, $listeners, $phpcs->allowedFileExtensions);

        $phpcsFile->start();
      }
      else
      {
        $phpcsFile = new PHP_CodeSniffer_File($path, array(), $phpcs->allowedFileExtensions);
      }

      if (isset($config['preamble']))
      {
      }

      if (isset($config['props']))
      {
        $props = $this->getPropsFromPath($path);
        foreach (array_merge($props, $config['props']) as $key => $value)
        {
          if (isset($props[$key]) && !isset($config['props'][$key]))
          {
            $phpcsFile->addError('SVN property "'.$key.'" = "'.$props[$key].'" found but not expected', 0);
            continue;
          }

          if (!isset($props[$key]) && isset($config['props'][$key]))
          {
            $phpcsFile->addError('SVN property "'.$key.'" = "'.$config['props'][$key].'" expected but not found', 0);
            continue;
          }

          if ($props[$key] != $config['props'][$key])
          {
            $phpcsFile->addError('SVN property "'.$key.'" = "'.$props[$key].'" expected to match "'.$config['props'][$key].'"', 0);
          }
        }
      }

      $phpcs->addFile($phpcsFile);
    }

    $phpcs->printErrorReport();
  }
}
