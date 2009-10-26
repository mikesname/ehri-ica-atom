<?php



class PhysicalObjectMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.PhysicalObjectMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(QubitPhysicalObject::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(QubitPhysicalObject::TABLE_NAME);
		$tMap->setPhpName('physicalObject');
		$tMap->setClassname('QubitPhysicalObject');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('ID', 'id', 'INTEGER' , 'q_object', 'ID', true, null);

		$tMap->addForeignKey('TYPE_ID', 'typeId', 'INTEGER', 'q_term', 'ID', false, null);

		$tMap->addForeignKey('PARENT_ID', 'parentId', 'INTEGER', 'q_physical_object', 'ID', false, null);

		$tMap->addColumn('LFT', 'lft', 'INTEGER', true, null);

		$tMap->addColumn('RGT', 'rgt', 'INTEGER', true, null);

		$tMap->addColumn('SOURCE_CULTURE', 'sourceCulture', 'VARCHAR', true, 7);

	} 
} 