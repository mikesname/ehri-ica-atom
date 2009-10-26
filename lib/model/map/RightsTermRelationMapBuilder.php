<?php



class RightsTermRelationMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.RightsTermRelationMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(QubitRightsTermRelation::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(QubitRightsTermRelation::TABLE_NAME);
		$tMap->setPhpName('rightsTermRelation');
		$tMap->setClassname('QubitRightsTermRelation');

		$tMap->setUseIdGenerator(true);

		$tMap->addForeignKey('RIGHTS_ID', 'rightsId', 'INTEGER', 'q_rights', 'ID', true, null);

		$tMap->addForeignKey('TERM_ID', 'termId', 'INTEGER', 'q_term', 'ID', true, null);

		$tMap->addForeignKey('TYPE_ID', 'typeId', 'INTEGER', 'q_term', 'ID', false, null);

		$tMap->addColumn('DESCRIPTION', 'description', 'LONGVARCHAR', false, null);

		$tMap->addColumn('CREATED_AT', 'createdAt', 'TIMESTAMP', true, null);

		$tMap->addColumn('UPDATED_AT', 'updatedAt', 'TIMESTAMP', true, null);

		$tMap->addPrimaryKey('ID', 'id', 'INTEGER', true, null);

		$tMap->addColumn('SERIAL_NUMBER', 'serialNumber', 'INTEGER', true, null);

	} 
} 