<?php



class PhysicalObjectMapBuilder {

	
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
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('physical_object');
		$tMap->setPhpName('PhysicalObject');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addForeignKey('INFORMATION_OBJECT_ID', 'InformationObjectId', 'int', CreoleTypes::INTEGER, 'information_object', 'ID', false, null);

		$tMap->addForeignKey('LOCATION_ID', 'LocationId', 'int', CreoleTypes::INTEGER, 'term', 'ID', false, null);

		$tMap->addColumn('TREE_ID', 'TreeId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('TREE_LEFT_ID', 'TreeLeftId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('TREE_RIGHT_ID', 'TreeRightId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('TREE_PARENT_ID', 'TreeParentId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 