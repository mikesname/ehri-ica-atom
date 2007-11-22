<?php

/*
 * This file is part of the sfTranslatePlugin package.
 * (c) 2007 Jack Bates <ms419@freezone.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * i18n actions.
 *
 * @package    symfony
 * @subpackage i18n
 * @author     Your name here
 * @version    SVN: $Id$
 */
class translateAction extends sfAction
{
  /**
   * Executes index action
   *
   */
  public function execute()
  {
    $error = array();
    $status = array();

    $messageSource = $this->getContext()->getI18N()->getMessageSource();

    $sourceMessages = $this->getRequestParameter('source', array());
    $targetMessages = $this->getRequestParameter('target', array());
    foreach ($sourceMessages as $key => $sourceMessage)
    {
      if (!$messageSource->update($sourceMessage, $targetMessages[$key]))
      {
        $error[] = $sourceMessage.$targetMessage;
      }
      else
      {
        $status[] = $sourceMessage.$targetMessage;
      }
    }

    if (!empty($error))
    {
      $this->forward($this->getUser()->getAttribute('moduleName', 'default', 'sfHistoryPlugin'), $this->getUser()->getAttribute('actionName', 'index', 'sfHistoryPlugin'));
    }

    $this->redirect($this->getUser()->getAttribute('currentInternalUri', null, 'sfHistoryPlugin'));
  }
}
