<?php



class PropertyMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.PropertyMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(QubitProperty::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(QubitProperty::TABLE_NAME);
		$tMap->setPhpName('property');
		$tMap->setClassname('QubitProperty');

		$tMap->setUseIdGenerator(true);

		$tMap->addForeignKey('OBJECT_ID', 'objectId', 'INTEGER', 'q_object', 'ID', true, null);

		$tMap->addColumn('SCOPE', 'scope', 'VARCHAR', false, 255);

		$tMap->addColumn('NAME', 'name', 'VARCHAR', false, 255);

		$tMap->addColumn('CREATED_AT', 'createdAt', 'TIMESTAMP', true, null);

		$tMap->addColumn('UPDATED_AT', 'updatedAt', 'TIMESTAMP', true, null);

		$tMap->addColumn('SOURCE_CULTURE', 'sourceCulture', 'VARCHAR', true, 7);

		$tMap->addPrimaryKey('ID', 'id', 'INTEGER', true, null);

	} 
} 