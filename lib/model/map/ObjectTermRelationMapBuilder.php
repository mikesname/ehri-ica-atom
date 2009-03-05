<?php



class ObjectTermRelationMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.ObjectTermRelationMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(QubitObjectTermRelation::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(QubitObjectTermRelation::TABLE_NAME);
		$tMap->setPhpName('objectTermRelation');
		$tMap->setClassname('QubitObjectTermRelation');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('ID', 'id', 'INTEGER' , 'q_object', 'ID', true, null);

		$tMap->addForeignKey('OBJECT_ID', 'objectId', 'INTEGER', 'q_object', 'ID', true, null);

		$tMap->addForeignKey('TERM_ID', 'termId', 'INTEGER', 'q_term', 'ID', true, null);

		$tMap->addColumn('START_DATE', 'startDate', 'DATE', false, null);

		$tMap->addColumn('END_DATE', 'endDate', 'DATE', false, null);

		$tMap->addColumn('CREATED_AT', 'createdAt', 'TIMESTAMP', true, null);

		$tMap->addColumn('UPDATED_AT', 'updatedAt', 'TIMESTAMP', true, null);

	} 
} 