<?php


/**
 * This class defines the structure of the 'historical_event' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class HistoricalEventTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.HistoricalEventTableMap';

	/**
	 * Initialize the table attributes, columns and validators
	 * Relations are not initialized by this method since they are lazy loaded
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function initialize()
	{
	  // attributes
		$this->setName('historical_event');
		$this->setPhpName('historicalEvent');
		$this->setClassname('QubitHistoricalEvent');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(false);
		// columns
		$this->addForeignPrimaryKey('ID', 'id', 'INTEGER' , 'term', 'ID', true, null, null);
		$this->addForeignKey('TYPE_ID', 'typeId', 'INTEGER', 'term', 'ID', false, null, null);
		$this->addColumn('START_DATE', 'startDate', 'DATE', false, null, null);
		$this->addColumn('START_TIME', 'startTime', 'TIME', false, null, null);
		$this->addColumn('END_DATE', 'endDate', 'DATE', false, null, null);
		$this->addColumn('END_TIME', 'endTime', 'TIME', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('termRelatedByid', 'term', RelationMap::MANY_TO_ONE, array('id' => 'id', ), 'CASCADE', null);
    $this->addRelation('termRelatedBytypeId', 'term', RelationMap::MANY_TO_ONE, array('type_id' => 'id', ), null, null);
	} // buildRelations()

} // HistoricalEventTableMap
