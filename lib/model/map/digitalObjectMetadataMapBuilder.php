<?php



class digitalObjectMetadataMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.digitalObjectMetadataMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('digital_object_metadata');
		$tMap->setPhpName('digitalObjectMetadata');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('DIGITAL_OBJECT_ID', 'DigitalObjectId', 'int', CreoleTypes::INTEGER, 'digital_object', 'ID', false, null);

		$tMap->addColumn('ELEMENT', 'Element', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('VALUE', 'Value', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 