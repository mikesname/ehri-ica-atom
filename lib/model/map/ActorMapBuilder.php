<?php



class ActorMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.ActorMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(QubitActor::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(QubitActor::TABLE_NAME);
		$tMap->setPhpName('actor');
		$tMap->setClassname('QubitActor');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('ID', 'id', 'INTEGER' , 'q_object', 'ID', true, null);

		$tMap->addColumn('CORPORATE_BODY_IDENTIFIERS', 'corporateBodyIdentifiers', 'VARCHAR', false, 255);

		$tMap->addForeignKey('ENTITY_TYPE_ID', 'entityTypeId', 'INTEGER', 'q_term', 'ID', false, null);

		$tMap->addForeignKey('DESCRIPTION_STATUS_ID', 'descriptionStatusId', 'INTEGER', 'q_term', 'ID', false, null);

		$tMap->addForeignKey('DESCRIPTION_DETAIL_ID', 'descriptionDetailId', 'INTEGER', 'q_term', 'ID', false, null);

		$tMap->addColumn('DESCRIPTION_IDENTIFIER', 'descriptionIdentifier', 'VARCHAR', false, 255);

		$tMap->addForeignKey('PARENT_ID', 'parentId', 'INTEGER', 'q_actor', 'ID', false, null);

		$tMap->addColumn('LFT', 'lft', 'INTEGER', false, null);

		$tMap->addColumn('RGT', 'rgt', 'INTEGER', false, null);

		$tMap->addColumn('SOURCE_CULTURE', 'sourceCulture', 'VARCHAR', true, 7);

	} 
} 