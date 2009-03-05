<?php



class ActorNameMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.ActorNameMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(QubitActorName::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(QubitActorName::TABLE_NAME);
		$tMap->setPhpName('actorName');
		$tMap->setClassname('QubitActorName');

		$tMap->setUseIdGenerator(true);

		$tMap->addForeignKey('ACTOR_ID', 'actorId', 'INTEGER', 'q_actor', 'ID', true, null);

		$tMap->addForeignKey('TYPE_ID', 'typeId', 'INTEGER', 'q_term', 'ID', false, null);

		$tMap->addColumn('CREATED_AT', 'createdAt', 'TIMESTAMP', true, null);

		$tMap->addColumn('UPDATED_AT', 'updatedAt', 'TIMESTAMP', true, null);

		$tMap->addColumn('SOURCE_CULTURE', 'sourceCulture', 'VARCHAR', true, 7);

		$tMap->addPrimaryKey('ID', 'id', 'INTEGER', true, null);

	} 
} 