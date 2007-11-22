<?php



class HistoricalEventMapBuilder {

	
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
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('historical_event');
		$tMap->setPhpName('HistoricalEvent');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('TERM_ID', 'TermId', 'int', CreoleTypes::INTEGER, 'term', 'ID', false, null);

		$tMap->addForeignKey('HISTORICAL_EVENT_TYPE_ID', 'HistoricalEventTypeId', 'int', CreoleTypes::INTEGER, 'term', 'ID', false, null);

		$tMap->addColumn('START_DATE', 'StartDate', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('START_TIME', 'StartTime', 'int', CreoleTypes::TIME, false, null);

		$tMap->addColumn('END_DATE', 'EndDate', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('END_TIME', 'EndTime', 'int', CreoleTypes::TIME, false, null);

		$tMap->addColumn('DATE_DISPLAY', 'DateDisplay', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 