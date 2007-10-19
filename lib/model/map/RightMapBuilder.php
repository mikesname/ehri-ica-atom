<?php



class RightMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.RightMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('right');
		$tMap->setPhpName('Right');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('INFORMATION_OBJECT_ID', 'InformationObjectId', 'int', CreoleTypes::INTEGER, 'information_object', 'ID', false, null);

		$tMap->addForeignKey('DIGITAL_OBJECT_ID', 'DigitalObjectId', 'int', CreoleTypes::INTEGER, 'digital_object', 'ID', false, null);

		$tMap->addForeignKey('PHYSICAL_OBJECT_ID', 'PhysicalObjectId', 'int', CreoleTypes::INTEGER, 'physical_object', 'ID', false, null);

		$tMap->addForeignKey('PERMISSION_ID', 'PermissionId', 'int', CreoleTypes::INTEGER, 'term', 'ID', false, null);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 