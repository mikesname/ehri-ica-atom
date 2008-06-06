<?php



class ActorMapBuilder {

	
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
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('q_actor');
		$tMap->setPhpName('Actor');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('ID', 'Id', 'int' , CreoleTypes::INTEGER, 'q_object', 'ID', true, null);

		$tMap->addColumn('CORPORATE_BODY_IDENTIFIERS', 'CorporateBodyIdentifiers', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addForeignKey('ENTITY_TYPE_ID', 'EntityTypeId', 'int', CreoleTypes::INTEGER, 'q_term', 'ID', false, null);

		$tMap->addForeignKey('DESCRIPTION_STATUS_ID', 'DescriptionStatusId', 'int', CreoleTypes::INTEGER, 'q_term', 'ID', false, null);

		$tMap->addForeignKey('DESCRIPTION_DETAIL_ID', 'DescriptionDetailId', 'int', CreoleTypes::INTEGER, 'q_term', 'ID', false, null);

		$tMap->addColumn('DESCRIPTION_IDENTIFIER', 'DescriptionIdentifier', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addForeignKey('PARENT_ID', 'ParentId', 'int', CreoleTypes::INTEGER, 'q_actor', 'ID', false, null);

		$tMap->addColumn('LFT', 'Lft', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('RGT', 'Rgt', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, true, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, true, null);

		$tMap->addColumn('SOURCE_CULTURE', 'SourceCulture', 'string', CreoleTypes::VARCHAR, true, 7);

	} 
} 