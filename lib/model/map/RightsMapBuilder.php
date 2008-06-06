<?php



class RightsMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.RightsMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('q_rights');
		$tMap->setPhpName('Rights');

		$tMap->setUseIdGenerator(true);

		$tMap->addForeignKey('OBJECT_ID', 'ObjectId', 'int', CreoleTypes::INTEGER, 'q_object', 'ID', true, null);

		$tMap->addForeignKey('PERMISSION_ID', 'PermissionId', 'int', CreoleTypes::INTEGER, 'q_term', 'ID', false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, true, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, true, null);

		$tMap->addColumn('SOURCE_CULTURE', 'SourceCulture', 'string', CreoleTypes::VARCHAR, true, 7);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

	} 
} 