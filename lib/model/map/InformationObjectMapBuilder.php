<?php



class InformationObjectMapBuilder implements MapBuilder {

	
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
		$this->dbMap = Propel::getDatabaseMap(QubitInformationObject::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(QubitInformationObject::TABLE_NAME);
		$tMap->setPhpName('informationObject');
		$tMap->setClassname('QubitInformationObject');

		$tMap->setUseIdGenerator(true);

		$tMap->addForeignPrimaryKey('ID', 'id', 'INTEGER' , 'q_object', 'ID', true, null);

		$tMap->addColumn('IDENTIFIER', 'identifier', 'VARCHAR', false, 255);

		$tMap->addColumn('OAI_LOCAL_IDENTIFIER', 'oaiLocalIdentifier', 'INTEGER', true, null);

		$tMap->addForeignKey('LEVEL_OF_DESCRIPTION_ID', 'levelOfDescriptionId', 'INTEGER', 'q_term', 'ID', false, null);

		$tMap->addForeignKey('COLLECTION_TYPE_ID', 'collectionTypeId', 'INTEGER', 'q_term', 'ID', false, null);

		$tMap->addForeignKey('REPOSITORY_ID', 'repositoryId', 'INTEGER', 'q_repository', 'ID', false, null);

		$tMap->addForeignKey('PARENT_ID', 'parentId', 'INTEGER', 'q_information_object', 'ID', false, null);

		$tMap->addForeignKey('DESCRIPTION_STATUS_ID', 'descriptionStatusId', 'INTEGER', 'q_term', 'ID', false, null);

		$tMap->addForeignKey('DESCRIPTION_DETAIL_ID', 'descriptionDetailId', 'INTEGER', 'q_term', 'ID', false, null);

		$tMap->addColumn('DESCRIPTION_IDENTIFIER', 'descriptionIdentifier', 'VARCHAR', false, 255);

		$tMap->addColumn('LFT', 'lft', 'INTEGER', true, null);

		$tMap->addColumn('RGT', 'rgt', 'INTEGER', true, null);

		$tMap->addColumn('CREATED_AT', 'createdAt', 'TIMESTAMP', true, null);

		$tMap->addColumn('UPDATED_AT', 'updatedAt', 'TIMESTAMP', true, null);

		$tMap->addColumn('SOURCE_CULTURE', 'sourceCulture', 'VARCHAR', true, 7);

	} 
} 