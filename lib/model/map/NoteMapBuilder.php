<?php



class NoteMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.NoteMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(QubitNote::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(QubitNote::TABLE_NAME);
		$tMap->setPhpName('note');
		$tMap->setClassname('QubitNote');

		$tMap->setUseIdGenerator(true);

		$tMap->addForeignKey('OBJECT_ID', 'objectId', 'INTEGER', 'q_object', 'ID', true, null);

		$tMap->addForeignKey('TYPE_ID', 'typeId', 'INTEGER', 'q_term', 'ID', false, null);

		$tMap->addColumn('SCOPE', 'scope', 'VARCHAR', false, 255);

		$tMap->addForeignKey('USER_ID', 'userId', 'INTEGER', 'q_user', 'ID', false, null);

		$tMap->addForeignKey('PARENT_ID', 'parentId', 'INTEGER', 'q_note', 'ID', false, null);

		$tMap->addColumn('LFT', 'lft', 'INTEGER', true, null);

		$tMap->addColumn('RGT', 'rgt', 'INTEGER', true, null);

		$tMap->addColumn('CREATED_AT', 'createdAt', 'TIMESTAMP', true, null);

		$tMap->addColumn('UPDATED_AT', 'updatedAt', 'TIMESTAMP', true, null);

		$tMap->addColumn('SOURCE_CULTURE', 'sourceCulture', 'VARCHAR', true, 7);

		$tMap->addPrimaryKey('ID', 'id', 'INTEGER', true, null);

		$tMap->addColumn('SERIAL_NUMBER', 'serialNumber', 'INTEGER', true, null);

	} 
} 