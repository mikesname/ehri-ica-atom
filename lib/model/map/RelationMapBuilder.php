<?php



class RelationMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.RelationMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(QubitRelation::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(QubitRelation::TABLE_NAME);
		$tMap->setPhpName('relation');
		$tMap->setClassname('QubitRelation');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('ID', 'id', 'INTEGER' , 'q_object', 'ID', true, null);

		$tMap->addForeignKey('SUBJECT_ID', 'subjectId', 'INTEGER', 'q_object', 'ID', true, null);

		$tMap->addForeignKey('OBJECT_ID', 'objectId', 'INTEGER', 'q_object', 'ID', true, null);

		$tMap->addForeignKey('TYPE_ID', 'typeId', 'INTEGER', 'q_term', 'ID', false, null);

		$tMap->addColumn('START_DATE', 'startDate', 'DATE', false, null);

		$tMap->addColumn('END_DATE', 'endDate', 'DATE', false, null);

	} 
} 