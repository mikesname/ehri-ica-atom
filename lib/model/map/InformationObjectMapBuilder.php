<?php



class InformationObjectMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.InformationObjectMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('q_information_object');
		$tMap->setPhpName('InformationObject');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('ID', 'Id', 'int' , CreoleTypes::INTEGER, 'q_object', 'ID', true, null);

		$tMap->addColumn('IDENTIFIER', 'Identifier', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addForeignKey('LEVEL_OF_DESCRIPTION_ID', 'LevelOfDescriptionId', 'int', CreoleTypes::INTEGER, 'q_term', 'ID', false, null);

		$tMap->addForeignKey('COLLECTION_TYPE_ID', 'CollectionTypeId', 'int', CreoleTypes::INTEGER, 'q_term', 'ID', false, null);

		$tMap->addForeignKey('REPOSITORY_ID', 'RepositoryId', 'int', CreoleTypes::INTEGER, 'q_repository', 'ID', false, null);

		$tMap->addForeignKey('PARENT_ID', 'ParentId', 'int', CreoleTypes::INTEGER, 'q_information_object', 'ID', false, null);

		$tMap->addForeignKey('DESCRIPTION_STATUS_ID', 'DescriptionStatusId', 'int', CreoleTypes::INTEGER, 'q_term', 'ID', false, null);

		$tMap->addForeignKey('DESCRIPTION_DETAIL_ID', 'DescriptionDetailId', 'int', CreoleTypes::INTEGER, 'q_term', 'ID', false, null);

		$tMap->addColumn('DESCRIPTION_IDENTIFIER', 'DescriptionIdentifier', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('LFT', 'Lft', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('RGT', 'Rgt', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, true, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, true, null);

		$tMap->addColumn('SOURCE_CULTURE', 'SourceCulture', 'string', CreoleTypes::VARCHAR, true, 7);

	} 
} 