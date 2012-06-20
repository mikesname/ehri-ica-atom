<?php

/*
 * This file is part of Qubit Toolkit.
 *
 * Qubit Toolkit is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
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

/**
 * Fix for issue 2344.
 * Locate this file in the lib/task directory.
 * Then run: $ php symfony tools:fix-issue-2344
 */
class FixIssue2344Task extends sfBaseTask
{
  protected function configure()
  {
    $this->namespace = 'tools';
    $this->name = 'fix-issue-2344';
    $this->briefDescription = 'Fix issue 2344.';

    $this->detailedDescription = <<<EOF
Fix issue 2344.
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    $databaseManager = new sfDatabaseManager($this->configuration);
    $conn = $databaseManager->getDatabase('propel')->getConnection();

    $termIds = array(QubitTerm::ACCESSION_ID, QubitTerm::RIGHT_ID);

    $criteria = new Criteria;
    $criteria->add(QubitTerm::ID, $termIds, Criteria::IN);

    if (count($termIds) <= count(QubitTerm::get($criteria)))
    {
      throw new Exception('You don\'t need this fix, thank you!');
    }

    // Add "Accession" relation type
    $term = new QubitTerm;
    $term->id = QubitTerm::ACCESSION_ID;
    $term->parentId = QubitTerm::ROOT_ID;
    $term->taxonomyId = QubitTaxonomy::RELATION_TYPE_ID;
    $term->sourceCulture = 'en';
    $term->name = 'Accession';

    try
    {
      $term->save();

      $this->logSection('fix-issue-2344', 'Accession relation type added.');
    }
    catch (Exception $e)
    {
      throw new Exception("The \"Right\" relation type could not be added.\n\n".$e->getMessage());
    }

    // Add "Right" relation type
    $term = new QubitTerm;
    $term->id = QubitTerm::RIGHT_ID;
    $term->parentId = QubitTerm::ROOT_ID;
    $term->taxonomyId = QubitTaxonomy::RELATION_TYPE_ID;
    $term->sourceCulture = 'en';
    $term->name = 'Right';

    try
    {
      $term->save();

      $this->logSection('fix-issue-2344', 'Right relation type added.');
    }
    catch (Exception $e)
    {
      throw new Exception("The \"Right\" relation type could not be added.\n\n".$e->getMessage());
    }

    // Set "Donor" relation type parent_id to QubitTerm::ROOT_ID
    $term = QubitTerm::getById(QubitTerm::DONOR_ID);
    $term->parentId = QubitTerm::ROOT_ID;

    try
    {
      $term->save();

      $this->logSection('fix-issue-2344', 'Donor relation type updated.');
    }
    catch (Exception $e)
    {
      throw new Exception("The \"Donor\" relation type could not be updated.\n\n".$e->getMessage());
    }
  }
}