<?php



class HistoricalEventMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.HistoricalEventMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(QubitHistoricalEvent::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(QubitHistoricalEvent::TABLE_NAME);
		$tMap->setPhpName('historicalEvent');
		$tMap->setClassname('QubitHistoricalEvent');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('ID', 'id', 'INTEGER' , 'q_term', 'ID', true, null);

		$tMap->addForeignKey('TYPE_ID', 'typeId', 'INTEGER', 'q_term', 'ID', false, null);

		$tMap->addColumn('START_DATE', 'startDate', 'DATE', false, null);

		$tMap->addColumn('START_TIME', 'startTime', 'TIME', false, null);

		$tMap->addColumn('END_DATE', 'endDate', 'DATE', false, null);

		$tMap->addColumn('END_TIME', 'endTime', 'TIME', false, null);

	} 
} 