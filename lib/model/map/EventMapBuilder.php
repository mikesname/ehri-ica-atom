<?php



class EventMapBuilder {

	
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
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('q_event');
		$tMap->setPhpName('Event');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('ID', 'Id', 'int' , CreoleTypes::INTEGER, 'q_object', 'ID', true, null);

		$tMap->addColumn('START_DATE', 'StartDate', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('START_TIME', 'StartTime', 'int', CreoleTypes::TIME, false, null);

		$tMap->addColumn('END_DATE', 'EndDate', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('END_TIME', 'EndTime', 'int', CreoleTypes::TIME, false, null);

		$tMap->addForeignKey('TYPE_ID', 'TypeId', 'int', CreoleTypes::INTEGER, 'q_term', 'ID', false, null);

		$tMap->addForeignKey('ACTOR_ROLE_ID', 'ActorRoleId', 'int', CreoleTypes::INTEGER, 'q_term', 'ID', false, null);

		$tMap->addForeignKey('INFORMATION_OBJECT_ID', 'InformationObjectId', 'int', CreoleTypes::INTEGER, 'q_information_object', 'ID', false, null);

		$tMap->addForeignKey('ACTOR_ID', 'ActorId', 'int', CreoleTypes::INTEGER, 'q_actor', 'ID', false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, true, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, true, null);

		$tMap->addColumn('SOURCE_CULTURE', 'SourceCulture', 'string', CreoleTypes::VARCHAR, true, 7);

	} 
} 