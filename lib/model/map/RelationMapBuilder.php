<?php



class RelationMapBuilder {

	
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
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('q_relation');
		$tMap->setPhpName('Relation');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('ID', 'Id', 'int' , CreoleTypes::INTEGER, 'q_object', 'ID', true, null);

		$tMap->addForeignKey('SUBJECT_ID', 'SubjectId', 'int', CreoleTypes::INTEGER, 'q_object', 'ID', true, null);

		$tMap->addForeignKey('OBJECT_ID', 'ObjectId', 'int', CreoleTypes::INTEGER, 'q_object', 'ID', true, null);

		$tMap->addForeignKey('TYPE_ID', 'TypeId', 'int', CreoleTypes::INTEGER, 'q_term', 'ID', false, null);

		$tMap->addColumn('START_DATE', 'StartDate', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('END_DATE', 'EndDate', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, true, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, true, null);

	} 
} 