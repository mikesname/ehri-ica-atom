<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2007 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Release script.
 *
 * Usage: php data/bin/release.php 1.0.0 stable
 *
 * @package    symfony
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id$
 */
require_once(dirname(__FILE__).'/../../lib/vendor/symfony/lib/task/sfFilesystem.class.php');
require_once(dirname(__FILE__).'/../../lib/vendor/symfony/lib/util/sfFinder.class.php');
require_once(dirname(__FILE__).'/../../lib/vendor/symfony/lib/vendor/lime/lime.php');

if (!isset($argv[1]))
{
  throw new Exception('You must provide version prefix.');
}

if (!isset($argv[2]))
{
  throw new Exception('You must provide stability status (alpha/beta/stable).');
}

$stability = $argv[2];

$filesystem = new sfFilesystem();

if (($stability == 'beta' || $stability == 'alpha') && count(explode('.', $argv[1])) < 2)
{
  $version_prefix = $argv[1];

  if (preg_match('/Status against revision\:\s+(\d+)\s*$/im', $filesystem->sh('svn status -u '.getcwd()), $match))
  {
    $version = $match[1];
  }

  if (!isset($version))
  {
    throw new Exception('Unable to find last svn revision');
  }

  // make a PEAR compatible version
  $version = $version_prefix.'.'.$version;
}
else
{
  $version = $argv[1];
}

print 'Releasing Qubit version "'.$version."\"\n";

// Local changes mean patches may conflict.  All lines which start with a
// character other than 'P' ('Performing...') or 'X' (externals definition) are
// local changes.
if (preg_match('/^[PX]/m', $filesystem->sh('svn status -u '.getcwd())) > 0)
{
  throw new Exception('Local modifications. Release process aborted!');
}

// Apply patches
$filesystem->sh('cat '.getcwd().'/patches/* | patch --no-backup-if-mismatch -p0');

// Test
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
  $releaseNode = $doc->createElement('release', $version);

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
  $apiNode = $doc->createElement('api', $stability);
  $stabilityNode->appendChild($apiNode);
}

if (!$xpath->evaluate('boolean(pkg:release)', $stabilityNode))
{
  $releaseNode = $doc->createElement('release', $stability);
  $stabilityNode->insertBefore($releaseNode, $apiNode);
}

$doc->save(getcwd().'/package.xml');

// add class files
$finder = sfFinder::type('file')->ignore_version_control()->relative();
$xml_classes = '';

foreach ($finder->in('apps/qubit') as $file)
{
  $xml_classes .= '<file name="apps/qubit/'.$file.'" role="php" />'."\n";
}

foreach ($finder->in('config') as $file)
{
  $xml_classes .= '<file name="config/'.$file.'" role="data" />'."\n";
}

foreach ($finder->in('data') as $file)
{
  $xml_classes .= '<file name="data/'.$file.'" role="data" />'."\n";
}

foreach ($finder->in('install') as $file)
{
  $xml_classes .= '<file name="install/'.$file.'" role="php" />'."\n";
}

// FIXME: http://trac.symfony-project.com/ticket/3479
$clone = clone $finder;
foreach ($clone->prune('vendor')->in('lib') as $file)
{
  $xml_classes .= '<file name="lib/'.$file.'" role="php" />'."\n";
}

foreach ($finder->in('lib/vendor/symfony/data') as $file)
{
  $xml_classes .= '<file name="lib/vendor/symfony/data/'.$file.'" role="data" />'."\n";
}

foreach ($finder->in('lib/vendor/symfony/lib') as $file)
{
  $xml_classes .= '<file name="lib/vendor/symfony/lib/'.$file.'" role="php" />'."\n";
}

$xml_classes .= '<file name="lib/vendor/Zend/Exception.php" role="php" />'."\n";

foreach ($finder->in('lib/vendor/Zend/Search') as $file)
{
  $xml_classes .= '<file name="lib/vendor/Zend/Search/'.$file.'" role="php" />'."\n";
}

foreach ($finder->in('plugins') as $file)
{
  $xml_classes .= '<file name="plugins/'.$file.'" role="php" />'."\n";
}

foreach ($finder->in('web') as $file)
{
  $xml_classes .= '<file name="web/'.$file.'" role="data" />'."\n";
}

// replace tokens
$filesystem->replaceTokens(getcwd().'/package.xml', '##', '##', array(
  'VERSION' => $version,
  'CURRENT_DATE' => date('Y-m-d'),
  'CLASS_FILES' => $xml_classes,
  'STABILITY' => $stability));

print $filesystem->sh('pear package');

$filesystem->remove(getcwd().'/package.xml');
