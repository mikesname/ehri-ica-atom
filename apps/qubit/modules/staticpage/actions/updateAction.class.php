<?php

/*
 * This file is part of Qubit Toolkit.
 *
 * Qubit Toolkit is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
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
        $staticPage->setPermalink(QubitStaticPageFormat::stripText($this->getRequestParameter('title')).'-'.($titleCount + 1));
      }
      else
      {
        $staticPage->setPermalink(QubitStaticPageFormat::stripText($this->getRequestParameter('title')));
      }
    }

    $staticPage->save();

    return $this->redirect(array('module' => 'staticpage', 'action' => 'static', 'permalink' => $staticPage->getPermalink()));
  }
}
