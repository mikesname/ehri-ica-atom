<?php



class InformationObjectI18nMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.InformationObjectI18nMapBuilder';

	
	private $dbMap;

	
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap(QubitInformationObjectI18n::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(QubitInformationObjectI18n::TABLE_NAME);
		$tMap->setPhpName('informationObjectI18n');
		$tMap->setClassname('QubitInformationObjectI18n');

		$tMap->setUseIdGenerator(false);

		$tMap->addColumn('TITLE', 'title', 'VARCHAR', false, 255);

		$tMap->addColumn('ALTERNATE_TITLE', 'alternateTitle', 'VARCHAR', false, 255);

		$tMap->addColumn('EDITION', 'edition', 'VARCHAR', false, 255);

		$tMap->addColumn('EXTENT_AND_MEDIUM', 'extentAndMedium', 'LONGVARCHAR', false, null);

		$tMap->addColumn('ARCHIVAL_HISTORY', 'archivalHistory', 'LONGVARCHAR', false, null);

		$tMap->addColumn('ACQUISITION', 'acquisition', 'LONGVARCHAR', false, null);

		$tMap->addColumn('SCOPE_AND_CONTENT', 'scopeAndContent', 'LONGVARCHAR', false, null);

		$tMap->addColumn('APPRAISAL', 'appraisal', 'LONGVARCHAR', false, null);

		$tMap->addColumn('ACCRUALS', 'accruals', 'LONGVARCHAR', false, null);

		$tMap->addColumn('ARRANGEMENT', 'arrangement', 'LONGVARCHAR', false, null);

		$tMap->addColumn('ACCESS_CONDITIONS', 'accessConditions', 'LONGVARCHAR', false, null);

		$tMap->addColumn('REPRODUCTION_CONDITIONS', 'reproductionConditions', 'LONGVARCHAR', false, null);

		$tMap->addColumn('PHYSICAL_CHARACTERISTICS', 'physicalCharacteristics', 'LONGVARCHAR', false, null);

		$tMap->addColumn('FINDING_AIDS', 'findingAids', 'LONGVARCHAR', false, null);

		$tMap->addColumn('LOCATION_OF_ORIGINALS', 'locationOfOriginals', 'LONGVARCHAR', false, null);

		$tMap->addColumn('LOCATION_OF_COPIES', 'locationOfCopies', 'LONGVARCHAR', false, null);

		$tMap->addColumn('RELATED_UNITS_OF_DESCRIPTION', 'relatedUnitsOfDescription', 'LONGVARCHAR', false, null);

		$tMap->addColumn('INSTITUTION_RESPONSIBLE_IDENTIFIER', 'institutionResponsibleIdentifier', 'VARCHAR', false, 255);

		$tMap->addColumn('RULES', 'rules', 'LONGVARCHAR', false, null);

		$tMap->addColumn('SOURCES', 'sources', 'LONGVARCHAR', false, null);

		$tMap->addColumn('REVISION_HISTORY', 'revisionHistory', 'LONGVARCHAR', false, null);

		$tMap->addForeignPrimaryKey('ID', 'id', 'INTEGER' , 'q_information_object', 'ID', true, null);

		$tMap->addPrimaryKey('CULTURE', 'culture', 'VARCHAR', true, 7);

		$tMap->addColumn('SERIAL_NUMBER', 'serialNumber', 'INTEGER', true, null);

	} 
} 