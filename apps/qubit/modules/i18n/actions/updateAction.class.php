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

class I18nUpdateAction extends sfAction
{
  public function execute($request)
  {
  //make sure user doesn't overwrite default 'en' values
  if ($this->getUser()->getCulture() != 'en')
    {
    switch ($this->getRequestParameter('fieldset'))
      {
      case 'taxonomy':
        $taxonomies = QubitTaxonomy::getAll();
        foreach ($taxonomies as $taxonomy)
          {
            $taxonomy->setName($this->getRequestParameter('taxonomy_'.$taxonomy->getId()));
            $taxonomy->save();
          }
        break;
      case 'terms':
        $terms = QubitTerm::getAll();
        foreach ($terms as $term)
          {
            $term->setName($this->getRequestParameter('term_'.$term->getId()));
            $term->save();
          }
        break;
      case 'static_pages':
        $staticPages = QubitStaticPage::getAll();
        foreach ($staticPages as $staticPage)
          {
            $staticPage->setTitle($this->getRequestParameter('static_page_title'.$staticPage->getId()));
            $staticPage->setContent($this->getRequestParameter('static_page_content'.$staticPage->getId()));
            $staticPage->save();
          }
        break;
      }
    }

  return $this->redirect('i18n/listDefaultContentTranslation');
  }
}
