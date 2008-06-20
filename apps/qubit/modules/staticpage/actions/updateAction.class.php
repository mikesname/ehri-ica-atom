<?php

/*
 * This file is part of the Qubit Toolkit.
 * Copyright (C) 2006-2008 Peter Van Garderen <peter@artefactual.com>
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

class StaticPageUpdateAction extends sfAction
{
  public function execute($request)
  {
    if (!$this->getRequestParameter('id', 0))
    {
      $staticPage = new QubitStaticPage;
    }
    else
    {
      $staticPage = QubitStaticPage::getById($this->getRequestParameter('id'));
      $this->forward404Unless($staticPage);
    }

    $staticPage->setId($this->getRequestParameter('id'));
    $staticPage->setTitle($this->getRequestParameter('title'));
    $staticPage->setContent($this->getRequestParameter('content'));

    if (!$staticPage->getPermalink())
    {
      // check to see if the same title already exists for another page (permalinks must be unique)
      $criteria = new Criteria;
      $criteria->addJoin(QubitStaticPage::ID, QubitStaticPageI18n::ID);
      $criteria->add(QubitStaticPageI18n::TITLE, $this->getRequestParameter('title'));
      $matchingTitles = QubitStaticPageI18n::get($criteria);
      if (($titleCount = count($matchingTitles)) > 0)    
      {
        //append the permalink slug if the same title text is already being used for another page
        $staticPage->setPermalink(StaticPageFormat::stripText($this->getRequestParameter('title')).'-'.($titleCount + 1));
      }
      else  
      {
        $staticPage->setPermalink(StaticPageFormat::stripText($this->getRequestParameter('title')));
      }
    }

    $staticPage->save();

    return $this->redirect(array('module' => 'staticpage', 'action' => 'static', 'permalink' => $staticPage->getPermalink()));
  }
}
