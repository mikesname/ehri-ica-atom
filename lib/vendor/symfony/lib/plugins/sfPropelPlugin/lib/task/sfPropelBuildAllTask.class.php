<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once(dirname(__FILE__).'/sfPropelBaseTask.class.php');

/**
 * Generates Propel model, SQL and initializes the database.
 *
 * @package    symfony
 * @subpackage command
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfPropelBuildAllTask.class.php 8970 2008-05-15 03:59:27Z Carl.Vondrick $
 */
class sfPropelBuildAllTask extends sfPropelBaseTask
{
  /**
   * @see sfTask
   */
  protected function configure()
  {
    $this->aliases = array('propel-build-all');
    $this->namespace = 'propel';
    $this->name = 'build-all';
    $this->briefDescription = 'Generates Propel model, SQL and initializes the database';

    $this->addOptions(array(
      new sfCommandOption('skip-forms', 'F', sfCommandOption::PARAMETER_NONE, 'Skip generating forms')
    ));

    $this->detailedDescription = <<<EOF
The [propel:build-all|INFO] task is a shortcut for three other tasks:

  [./symfony propel:build-all|INFO]

The task is equivalent to:

  [./symfony propel:build-model|INFO]
  [./symfony propel:build-sql|INFO]
  [./symfony propel:build-forms|INFO]
  [./symfony propel:insert-sql|INFO]

See those three tasks help page for more information.
EOF;
  }

  /**
   * @see sfTask
   */
  protected function execute($arguments = array(), $options = array())
  {
    $buildModel = new sfPropelBuildModelTask($this->dispatcher, $this->formatter);
    $buildModel->setCommandApplication($this->commandApplication);
    $buildModel->run();

    $buildSql = new sfPropelBuildSqlTask($this->dispatcher, $this->formatter);
    $buildSql->setCommandApplication($this->commandApplication);
    $buildSql->run();

    $insertSql = new sfPropelInsertSqlTask($this->dispatcher, $this->formatter);
    $insertSql->setCommandApplication($this->commandApplication);
    $insertSql->run();
  }
}
