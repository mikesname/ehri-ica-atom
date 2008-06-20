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

class I18nListUserInterfaceTranslationAction extends sfAction
{
  public function execute($request)
  {
  $criteria = new Criteria;
  $criteria->add(QubitInformationObjectI18n::TITLE, 'Townley, Matheson and Partners fonds');
  $this->sampleInformationObject = QubitInformationObjectI18n::getOne($criteria);
  
  $criteria = new Criteria;
  $criteria->addJoin(QubitPhysicalObject::ID, QubitPhysicalObjectI18n::ID);
  $criteria->add(QubitPhysicalObjectI18n::NAME, 'Box A12');
  $this->samplePhysicalObject = QubitPhysicalObject::getOne($criteria);
  
  $criteria = new Criteria;
  $criteria->add(QubitDigitalObject::NAME, 'CVA_Townley_Hotel1.jpg');
  $this->sampleDigitalObject = QubitDigitalObject::getOne($criteria);
  
  $criteria = new Criteria;
  $criteria->add(QubitActorI18n::AUTHORIZED_FORM_OF_NAME, 'Townley, Matheson and Partners');
  $this->sampleActor = QubitActorI18n::getOne($criteria);
 
  $criteria = new Criteria;
  $criteria->addJoin(QubitActor::ID, QubitActorI18n::ID);
  $criteria->add(QubitActorI18n::AUTHORIZED_FORM_OF_NAME, 'City of Vancouver Archives');
  $this->sampleRepository = QubitActor::getOne($criteria);
  
  $criteria = new Criteria;
  $criteria->addJoin(QubitTerm::ID, QubitTermI18n::ID);
  $criteria->add(QubitTermI18n::NAME, 'Series');
  $this->sampleTerm = QubitTerm::getOne($criteria);
  
  $criteria = new Criteria;
  $criteria->add(QubitStaticPage::PERMALINK, 'homepage');
  $this->sampleStaticPage = QubitStaticPage::getOne($criteria);
  }
}
