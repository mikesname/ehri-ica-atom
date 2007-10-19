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

class Term extends BaseTerm
{

protected $CountryHitCount = null;
protected $LanguageHitCount = null;
protected $SubjectHitCount = null;


public function __toString()
{
  return $this->getTermName();
}


public function setCountryHitCount($count)
  {
  $this->CountryHitCount = $count;
  }

public function getCountryHitCount()
  {
  return $this->CountryHitCount;
  }

public function setLanguageHitCount($count)
  {
  $this->LanguageHitCount = $count;
  }

public function getLanguageHitCount()
  {
  return $this->LanguageHitCount;
  }

public function setSubjectHitCount($count)
  {
  $this->SubjectHitCount = $count;
  }

public function getSubjectHitCount()
  {
  return $this->SubjectHitCount;
  }




}
