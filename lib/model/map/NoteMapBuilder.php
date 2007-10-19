<?php



class NoteMapBuilder {

	
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
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('note');
		$tMap->setPhpName('Note');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('INFORMATION_OBJECT_ID', 'InformationObjectId', 'int', CreoleTypes::INTEGER, 'information_object', 'ID', false, null);

		$tMap->addForeignKey('ACTOR_ID', 'ActorId', 'int', CreoleTypes::INTEGER, 'actor', 'ID', false, null);

		$tMap->addForeignKey('REPOSITORY_ID', 'RepositoryId', 'int', CreoleTypes::INTEGER, 'repository', 'ID', false, null);

		$tMap->addForeignKey('FUNCTION_DESCRIPTION_ID', 'FunctionDescriptionId', 'int', CreoleTypes::INTEGER, 'function_description', 'ID', false, null);

		$tMap->addColumn('NOTE', 'Note', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addForeignKey('NOTE_TYPE_ID', 'NoteTypeId', 'int', CreoleTypes::INTEGER, 'term', 'ID', false, null);

		$tMap->addForeignKey('USER_ID', 'UserId', 'int', CreoleTypes::INTEGER, 'user', 'ID', false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 