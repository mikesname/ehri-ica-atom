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

		$tMap = $this->dbMap->addTable('actor');
		$tMap->setPhpName('Actor');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('AUTHORIZED_FORM_OF_NAME', 'AuthorizedFormOfName', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addForeignKey('TYPE_OF_ENTITY_ID', 'TypeOfEntityId', 'int', CreoleTypes::INTEGER, 'term', 'ID', false, null);

		$tMap->addColumn('IDENTIFIERS', 'Identifiers', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('HISTORY', 'History', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('LEGAL_STATUS', 'LegalStatus', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('FUNCTIONS', 'Functions', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('MANDATES', 'Mandates', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('INTERNAL_STRUCTURES', 'InternalStructures', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('GENERAL_CONTEXT', 'GeneralContext', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('AUTHORITY_RECORD_IDENTIFIER', 'AuthorityRecordIdentifier', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('INSTITUTION_IDENTIFIER', 'InstitutionIdentifier', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('RULES', 'Rules', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addForeignKey('STATUS_ID', 'StatusId', 'int', CreoleTypes::INTEGER, 'term', 'ID', false, null);

		$tMap->addForeignKey('LEVEL_OF_DETAIL_ID', 'LevelOfDetailId', 'int', CreoleTypes::INTEGER, 'term', 'ID', false, null);

		$tMap->addColumn('SOURCES', 'Sources', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('TREE_ID', 'TreeId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('TREE_LEFT_ID', 'TreeLeftId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('TREE_RIGHT_ID', 'TreeRightId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('TREE_PARENT_ID', 'TreeParentId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 