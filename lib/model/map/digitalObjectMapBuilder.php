<?php



class digitalObjectMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.digitalObjectMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('digital_object');
		$tMap->setPhpName('digitalObject');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('INFORMATION_OBJECT_ID', 'InformationObjectId', 'int', CreoleTypes::INTEGER, 'information_object', 'ID', false, null);

		$tMap->addForeignKey('USEAGE_ID', 'UseageId', 'int', CreoleTypes::INTEGER, 'term', 'ID', false, null);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addForeignKey('MIME_TYPE_ID', 'MimeTypeId', 'int', CreoleTypes::INTEGER, 'term', 'ID', false, null);

		$tMap->addForeignKey('MEDIA_TYPE_ID', 'MediaTypeId', 'int', CreoleTypes::INTEGER, 'term', 'ID', false, null);

		$tMap->addColumn('SEQUENCE', 'Sequence', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('BYTE_SIZE', 'ByteSize', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CHECKSUM', 'Checksum', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addForeignKey('CHECKSUM_TYPE_ID', 'ChecksumTypeId', 'int', CreoleTypes::INTEGER, 'term', 'ID', false, null);

		$tMap->addForeignKey('LOCATION_ID', 'LocationId', 'int', CreoleTypes::INTEGER, 'term', 'ID', false, null);

		$tMap->addColumn('TREE_ID', 'TreeId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('TREE_LEFT_ID', 'TreeLeftId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('TREE_RIGHT_ID', 'TreeRightId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('TREE_PARENT_ID', 'TreeParentId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 