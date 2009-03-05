<?php



class ActorNameI18nMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.ActorNameI18nMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(QubitActorNameI18n::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(QubitActorNameI18n::TABLE_NAME);
		$tMap->setPhpName('actorNameI18n');
		$tMap->setClassname('QubitActorNameI18n');

		$tMap->setUseIdGenerator(false);

		$tMap->addColumn('NAME', 'name', 'VARCHAR', false, 255);

		$tMap->addColumn('NOTE', 'note', 'VARCHAR', false, 255);

		$tMap->addForeignPrimaryKey('ID', 'id', 'INTEGER' , 'q_actor_name', 'ID', true, null);

		$tMap->addPrimaryKey('CULTURE', 'culture', 'VARCHAR', true, 7);

	} 
} 