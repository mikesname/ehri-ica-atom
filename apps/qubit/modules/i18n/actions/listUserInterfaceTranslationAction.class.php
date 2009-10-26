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

class I18nListUserInterfaceTranslationAction extends sfAction
{
  public function execute($request)
  {
    $criteria = new Criteria;
    $criteria->add(QubitInformationObject::PARENT_ID, null, Criteria::ISNOTNULL);
    $this->sampleInformationObject = QubitInformationObject::getOne($criteria);

    $criteria = new Criteria;
    $this->samplePhysicalObject = QubitPhysicalObject::getOne($criteria);

    $criteria = new Criteria;
    $this->sampleDigitalObject = QubitDigitalObject::getOne($criteria);

    $criteria = new Criteria;
    $criteria->addJoin(QubitActor::ID, QubitActorI18n::ID);
    $criteria->add(QubitActorI18n::AUTHORIZED_FORM_OF_NAME, '', Criteria::NOT_EQUAL);
    $this->sampleActor = QubitActor::getOne($criteria);

    $criteria = new Criteria;
    $this->sampleRepository = QubitRepository::getOne($criteria);

    if (null === ($this->sampleContactInformation = $this->sampleRepository->getPrimaryContact()))
    {
      $criteria = new Criteria;
      $this->sampleContactInformation = QubitContactInformation::getOne($criteria);
    }

    $criteria = new Criteria;
    $criteria->add(QubitTerm::TAXONOMY_ID, QubitTaxonomy::LEVEL_OF_DESCRIPTION_ID);
    $this->sampleTerm = QubitTerm::getOne($criteria);

    $criteria = new Criteria;
    $this->sampleStaticPage = QubitStaticPage::getOne($criteria);

    // Get first non-"protected" menu
    $criteria = new Criteria;
    $criteria->add(QubitMenu::ID, QubitMenu::ADMIN_ID, Criteria::GREATER_THAN);
    $this->sampleMenu = QubitMenu::getOne($criteria);
  }
}
