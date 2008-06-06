<?php



class DigitalObjectMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.DigitalObjectMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('q_digital_object');
		$tMap->setPhpName('DigitalObject');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('ID', 'Id', 'int' , CreoleTypes::INTEGER, 'q_object', 'ID', true, null);

		$tMap->addForeignKey('INFORMATION_OBJECT_ID', 'InformationObjectId', 'int', CreoleTypes::INTEGER, 'q_information_object', 'ID', false, null);

		$tMap->addForeignKey('USAGE_ID', 'UsageId', 'int', CreoleTypes::INTEGER, 'q_term', 'ID', false, null);

		$tMap->addColumn('MIME_TYPE', 'MimeType', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addForeignKey('MEDIA_TYPE_ID', 'MediaTypeId', 'int', CreoleTypes::INTEGER, 'q_term', 'ID', false, null);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('PATH', 'Path', 'string', CreoleTypes::VARCHAR, false, 1000);

		$tMap->addColumn('SEQUENCE', 'Sequence', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('BYTE_SIZE', 'ByteSize', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CHECKSUM', 'Checksum', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addForeignKey('CHECKSUM_TYPE_ID', 'ChecksumTypeId', 'int', CreoleTypes::INTEGER, 'q_term', 'ID', false, null);

		$tMap->addForeignKey('PARENT_ID', 'ParentId', 'int', CreoleTypes::INTEGER, 'q_digital_object', 'ID', false, null);

		$tMap->addColumn('LFT', 'Lft', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('RGT', 'Rgt', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, true, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, true, null);

	} 
} 