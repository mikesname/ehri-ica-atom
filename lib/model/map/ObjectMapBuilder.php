<?php



class ObjectMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.ObjectMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(QubitObject::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(QubitObject::TABLE_NAME);
		$tMap->setPhpName('object');
		$tMap->setClassname('QubitObject');

		$tMap->setUseIdGenerator(true);

		$tMap->addColumn('CLASS_NAME', 'className', 'VARCHAR', false, 255);

		$tMap->addPrimaryKey('ID', 'id', 'INTEGER', true, null);

	} 
} 