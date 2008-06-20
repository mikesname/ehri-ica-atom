<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2007 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class ReleaseTask extends sfBaseTask
{
  /**
   * @see sfBaseTask
   */
  protected function configure()
  {
    $this->addArguments(array(
      new sfCommandArgument('version', sfCommandArgument::REQUIRED, 'FIXME'),
      new sfCommandArgument('stability', sfCommandArgument::REQUIRED, 'FIXME')));
  }

  protected function execute($arguments = array(), $options = array())
  {
    $filesystem = new sfFilesystem();

    if (($arguments['stability'] == 'beta' || $arguments['stability'] == 'alpha') && count(explode('.', $arguments['version'])) < 2)
    {
      if (preg_match('/Status against revision\:\s+(\d+)\s*$/im', $filesystem->sh('svn status -u '.getcwd()), $matches) < 1)
      {
        throw new Exception('Unable to find last svn revision');
      }

      // make a PEAR compatible version
      $arguments['version'] .= $matches[1];
    }

    print 'Releasing Qubit version "'.$arguments['version']."\"\n";

    // Local changes mean patches may conflict.  All lines which start with a
    // character other than 'P' ('Performing...'), 'S' ('Status...'), or 'X'
    // (externals definition) are local changes.
    if (preg_match('/^[^PSX\n]/m', $filesystem->sh('svn status -u '.getcwd())) > 0)
    {
      throw new Exception('Local modifications. Release process aborted!');
    }

    // Apply patches
    $filesystem->sh('cat '.getcwd().'/patches/* | patch --no-backup-if-mismatch -p0');

    // Test
    require_once(dirname(__FILE__).'/../vendor/symfony/lib/vendor/lime/lime.php');
    $h = new lime_harness(new lime_output_color());

    $h->base_dir = realpath(dirname(__FILE__).'/../../test');

    // unit tests
    $h->register_glob($h->base_dir.'/unit/*/*Test.php');

    // functional tests
    $h->register_glob($h->base_dir.'/functional/*Test.php');
    $h->register_glob($h->base_dir.'/functional/*/*Test.php');

    if (!$h->run())
    {
      throw new Exception('Some tests failed. Release process aborted!');
    }

    $doc = new DOMDocument;
    $doc->load(getcwd().'/package.xml.tmpl');

    $xpath = new DOMXPath($doc);
    $xpath->registerNamespace('pkg', 'http://pear.php.net/dtd/package-2.0');

    if (!$xpath->evaluate('boolean(pkg:date)', $doc->documentElement))
    {
      $dateNode = $doc->createElement('date', date('Y-m-d'));

      // Date element must immediately precede the optional time element or the
      // mandatory version element
      $timeOrVersionNode = $xpath->query('pkg:time | pkg:version', $doc->documentElement)->item(0);
      $doc->documentElement->insertBefore($dateNode, $timeOrVersionNode);
    }

    if (!$xpath->evaluate('boolean(pkg:version/pkg:release)', $doc->documentElement))
    {
      $releaseNode = $doc->createElement('release', $arguments['version']);

      $apiNode = $xpath->query('pkg:version/pkg:api', $doc->documentElement)->item(0);
      $apiNode->parentNode->insertBefore($releaseNode, $apiNode);
    }

    if (null === $stabilityNode = $xpath->query('pkg:stability', $doc->documentElement)->item(0))
    {
      $stabilityNode = $doc->createElement('stability');

      $licenseNode = $xpath->query('pkg:license', $doc->documentElement)->item(0);
      $doc->documentElement->insertBefore($stabilityNode, $licenseNode);
    }

    if (null === $apiNode = $xpath->query('pkg:api', $stabilityNode)->item(0))
    {
      $apiNode = $doc->createElement('api', $arguments['stability']);
      $stabilityNode->appendChild($apiNode);
    }

    if (!$xpath->evaluate('boolean(pkg:release)', $stabilityNode))
    {
      $releaseNode = $doc->createElement('release', $arguments['stability']);
      $stabilityNode->insertBefore($releaseNode, $apiNode);
    }

    // add class files
    if (null === $dirNode = $xpath->query('pkg:contents/pkg:dir', $doc->documentElement)->item(0))
    {
      $dirNode = $doc->createElement('dir');
      $dirNode->setAttribute('name', '/');

      $contentsNode = $xpath->query('pkg:contents', $doc->documentElement)->item(0);
      $contentsNode->appendChild($dirNode);
    }

    $patternNodes = array();
    foreach ($xpath->query('pkg:contents//pkg:file', $doc->documentElement) as $patternNode)
    {
      // Globs like //foo/... must be matched against paths with a leading
      // slash, while globs like foo/... must be matched against paths without
      // a leading slash.  Consequently, prefix all globs with slash, if
      // necessary, and always match against paths with a leading slash.
      if (strncmp($glob = $patternNode->getAttribute('name'), '/', 1) != 0)
      {
        $glob = '/'.$glob;
      }

      $pattern = AuditTask::globToPattern($glob);
      $patternNodes[$pattern] = $patternNode;

      $patternNode->parentNode->removeChild($patternNode);
    }

    $finder = new SvnFinder;
    foreach ($finder->in(sfConfig::get('sf_root_dir')) as $path)
    {
      if (strncmp($path, sfConfig::get('sf_root_dir'), $len = strlen(sfConfig::get('sf_root_dir'))) == 0)
      {
        $path = substr($path, $len);
      }

      unset($fileNode);
      foreach ($patternNodes as $pattern => $patternNode)
      {
        if (preg_match('/^'.str_replace('/', '\\/', $pattern).'$/', $path) > 0)
        {
          if (!isset($fileNode))
          {
            $fileNode = $doc->createElement('file');
          }

          foreach ($patternNode->attributes as $attrNode)
          {
            $fileNode->setAttributeNode(clone $attrNode);
          }
        }
      }

      if (isset($fileNode))
      {
        $fileNode->setAttribute('name', ltrim($path, '/'));
        $dirNode->appendChild($fileNode);
      }
    }

    $doc->save(getcwd().'/package.xml');

    print $filesystem->sh('pear package');

    $filesystem->remove(getcwd().'/package.xml');
  }
}
