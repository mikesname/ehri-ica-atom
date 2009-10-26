<?php



class EventMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.EventMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(QubitEvent::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(QubitEvent::TABLE_NAME);
		$tMap->setPhpName('event');
		$tMap->setClassname('QubitEvent');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('ID', 'id', 'INTEGER' , 'q_object', 'ID', true, null);

		$tMap->addColumn('START_DATE', 'startDate', 'DATE', false, null);

		$tMap->addColumn('START_TIME', 'startTime', 'TIME', false, null);

		$tMap->addColumn('END_DATE', 'endDate', 'DATE', false, null);

		$tMap->addColumn('END_TIME', 'endTime', 'TIME', false, null);

		$tMap->addForeignKey('TYPE_ID', 'typeId', 'INTEGER', 'q_term', 'ID', true, null);

		$tMap->addForeignKey('INFORMATION_OBJECT_ID', 'informationObjectId', 'INTEGER', 'q_information_object', 'ID', false, null);

		$tMap->addForeignKey('ACTOR_ID', 'actorId', 'INTEGER', 'q_actor', 'ID', false, null);

		$tMap->addColumn('SOURCE_CULTURE', 'sourceCulture', 'VARCHAR', true, 7);

	} 
} 