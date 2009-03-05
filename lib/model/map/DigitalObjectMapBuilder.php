<?php



class DigitalObjectMapBuilder implements MapBuilder {

	
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
		$this->dbMap = Propel::getDatabaseMap(QubitDigitalObject::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(QubitDigitalObject::TABLE_NAME);
		$tMap->setPhpName('digitalObject');
		$tMap->setClassname('QubitDigitalObject');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('ID', 'id', 'INTEGER' , 'q_object', 'ID', true, null);

		$tMap->addForeignKey('INFORMATION_OBJECT_ID', 'informationObjectId', 'INTEGER', 'q_information_object', 'ID', false, null);

		$tMap->addForeignKey('USAGE_ID', 'usageId', 'INTEGER', 'q_term', 'ID', false, null);

		$tMap->addColumn('MIME_TYPE', 'mimeType', 'VARCHAR', false, 50);

		$tMap->addForeignKey('MEDIA_TYPE_ID', 'mediaTypeId', 'INTEGER', 'q_term', 'ID', false, null);

		$tMap->addColumn('NAME', 'name', 'VARCHAR', false, 255);

		$tMap->addColumn('PATH', 'path', 'VARCHAR', false, 1000);

		$tMap->addColumn('SEQUENCE', 'sequence', 'INTEGER', false, null);

		$tMap->addColumn('BYTE_SIZE', 'byteSize', 'INTEGER', false, null);

		$tMap->addColumn('CHECKSUM', 'checksum', 'VARCHAR', false, 255);

		$tMap->addForeignKey('CHECKSUM_TYPE_ID', 'checksumTypeId', 'INTEGER', 'q_term', 'ID', false, null);

		$tMap->addForeignKey('PARENT_ID', 'parentId', 'INTEGER', 'q_digital_object', 'ID', false, null);

		$tMap->addColumn('LFT', 'lft', 'INTEGER', true, null);

		$tMap->addColumn('RGT', 'rgt', 'INTEGER', true, null);

		$tMap->addColumn('CREATED_AT', 'createdAt', 'TIMESTAMP', true, null);

		$tMap->addColumn('UPDATED_AT', 'updatedAt', 'TIMESTAMP', true, null);

	} 
} 