<?php



class informationObjectMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.informationObjectMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('information_object');
		$tMap->setPhpName('informationObject');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('IDENTIFIER', 'Identifier', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('TITLE', 'Title', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('ALTERNATETITLE', 'Alternatetitle', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('VERSION', 'Version', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addForeignKey('LEVEL_OF_DESCRIPTION_ID', 'LevelOfDescriptionId', 'int', CreoleTypes::INTEGER, 'term', 'ID', false, null);

		$tMap->addColumn('EXTENT_AND_MEDIUM', 'ExtentAndMedium', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('ARCHIVAL_HISTORY', 'ArchivalHistory', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('ACQUISITION', 'Acquisition', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('SCOPE_AND_CONTENT', 'ScopeAndContent', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('APPRAISAL', 'Appraisal', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('ACCRUALS', 'Accruals', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('ARRANGEMENT', 'Arrangement', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('ACCESS_CONDITIONS', 'AccessConditions', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('REPRODUCTION_CONDITIONS', 'ReproductionConditions', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('PHYSICAL_CHARACTERISTICS', 'PhysicalCharacteristics', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('FINDING_AIDS', 'FindingAids', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('LOCATION_OF_ORIGINALS', 'LocationOfOriginals', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('LOCATION_OF_COPIES', 'LocationOfCopies', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('RELATED_UNITS_OF_DESCRIPTION', 'RelatedUnitsOfDescription', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('RULES', 'Rules', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addForeignKey('COLLECTION_TYPE_ID', 'CollectionTypeId', 'int', CreoleTypes::INTEGER, 'term', 'ID', false, null);

		$tMap->addForeignKey('REPOSITORY_ID', 'RepositoryId', 'int', CreoleTypes::INTEGER, 'repository', 'ID', false, null);

		$tMap->addColumn('TREE_ID', 'TreeId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('TREE_LEFT_ID', 'TreeLeftId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('TREE_RIGHT_ID', 'TreeRightId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('TREE_PARENT_ID', 'TreeParentId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 