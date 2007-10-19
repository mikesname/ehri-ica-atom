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

class staticpageActions extends sfActions
{
  public function executeStatic ()
  {

  $c = new Criteria();
  $c->add(staticPagePeer::PERMALINK, $this->getRequestParameter('permalink'));
  $this->staticpage = staticPagePeer::doSelectOne($c);

  $this->forward404Unless($this->staticpage);

  //determine if user has edit priviliges
  $this->editCredentials = false;
  if ($this->getUser()->hasCredential('administrator'))
    {
    $this->editCredentials = true;
    }

  }

  public function executeList ()
  {
    $this->staticpages = staticPagePeer::doSelect(new Criteria());
  }

  public function executeShow ()
  {
    $this->staticpage = staticPagePeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->staticpage);



  }

  public function executeCreate ()
  {
    $this->staticpage = new staticPage();

    $this->setTemplate('edit');
  }

  public function executeEdit ()
  {
    $this->staticpage = staticPagePeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->staticpage);
  }

  public function executeUpdate ()
  {
    if (!$this->getRequestParameter('id', 0))
    {
      $staticpage = new staticPage();
    }
    else
    {
      $staticpage = staticPagePeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($staticpage);
    }

    $staticpage->setId($this->getRequestParameter('id'));
    $staticpage->setTitle($this->getRequestParameter('title'));
    $staticpage->setPageContent($this->getRequestParameter('page_content'));
    $staticpage->setStylesheet($this->getRequestParameter('stylesheet'));

    $staticpage->save();

    $permalink = $staticpage->getPermalink();

    return $this->redirect($permalink);
  }

  public function executeDelete ()
  {
    $staticpage = staticPagePeer::retrieveByPk($this->getRequestParameter('id'));

    $this->forward404Unless($staticpage);

    $staticpage->delete();

    return $this->redirect('staticpage/list');
  }
}
