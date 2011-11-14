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

class updatePublicationStatusTask extends sfBaseTask
{
  protected function configure()
  {
    $this->addArguments(array(
      new sfCommandArgument('publicationStatusId', sfCommandArgument::REQUIRED, 'Desired publication status identifier'),
      new sfCommandArgument('slug', sfCommandArgument::REQUIRED, 'Resource slug')
    ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_OPTIONAL, 'The application name', true),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'cli'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'propel'),
      new sfCommandOption('force', 'f', sfCommandOption::PARAMETER_NONE, 'Force update of descendants', null),
      new sfCommandOption('ignore-descendants', 'i', sfCommandOption::PARAMETER_NONE, 'Don\'t update descendants', null),
      new sfCommandOption('no-confirm', null, sfCommandOption::PARAMETER_NONE, 'No confirmation message', null)
    ));

    $this->namespace = 'tools';
    $this->name = 'updatePublicationStatus';
    $this->briefDescription = 'FIXME';
    $this->detailedDescription = <<<EOF
FIXME
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    $databaseManager = new sfDatabaseManager($this->configuration);
    $conn = $databaseManager->getDatabase('propel')->getConnection();

    $criteria = new Criteria;
    $criteria->add(QubitSlug::SLUG, $arguments['slug']);
    $criteria->addJoin(QubitSlug::OBJECT_ID, QubitObject::ID);
    $resource = QubitInformationObject::get($criteria)->__get(0);

    $publicationStatus = QubitTerm::getById($arguments['publicationStatusId']);


    // Check if the resource exists
    if (!isset($resource))
    {
      throw new sfException('Resource not found');
    }

    // Check if the given status is correct and exists
    if (!isset($publicationStatus))
    {
      throw new sfException('Publication status not found');
    }
    if (QubitTaxonomy::PUBLICATION_STATUS_ID != $publicationStatus->taxonomyId)
    {
      throw new sfException('Given term is not part of the publication status taxonomy');
    }

    // Final confirmation
    if (!$options['no-confirm'])
    {
      if (!$this->askConfirmation(array(
        'Please, confirm that you want to change',
        'the publication status of "' . $resource . '"',
        'to "' . $publicationStatus . '" (y/N)'), 'QUESTION_LARGE', false))
        {
          $this->logSection('tools', 'Bye!');

          return 1;
        }
    }

    // Start work
    $resource->setPublicationStatus($publicationStatus->id);
    $resource->save();
    echo '+';

    // Update pub status of descendants
    if (!$options['ignore-descendants'])
    {
      foreach ($resource->descendants as $descendant)
      {
        if (null === $descendantPubStatus = $descendant->getPublicationStatus())
        {
          $descendantPubStatus = new QubitStatus;
          $descendantPubStatus->typeId = QubitTerm::STATUS_TYPE_PUBLICATION_ID;
          $descendantPubStatus->objectId = $descendant->id;
        }

        if ($options['force'] || $publicationStatus->id != $descendantPubStatus->statusId)
        {
          $descendantPubStatus->statusId = $publicationStatus->id;
          $descendantPubStatus->save();
          echo '^';
        }
      }
    }

    echo "\n";
  }
}
