<?php


/**
 * This class defines the structure of the 'q_event' table.
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
class EventTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.EventTableMap';

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
		$this->setName('q_event');
		$this->setPhpName('event');
		$this->setClassname('QubitEvent');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(false);
		// columns
		$this->addForeignPrimaryKey('ID', 'id', 'INTEGER' , 'q_object', 'ID', true, null, null);
		$this->addColumn('START_DATE', 'startDate', 'DATE', false, null, null);
		$this->addColumn('START_TIME', 'startTime', 'TIME', false, null, null);
		$this->addColumn('END_DATE', 'endDate', 'DATE', false, null, null);
		$this->addColumn('END_TIME', 'endTime', 'TIME', false, null, null);
		$this->addForeignKey('TYPE_ID', 'typeId', 'INTEGER', 'q_term', 'ID', true, null, null);
		$this->addForeignKey('INFORMATION_OBJECT_ID', 'informationObjectId', 'INTEGER', 'q_information_object', 'ID', false, null, null);
		$this->addForeignKey('ACTOR_ID', 'actorId', 'INTEGER', 'q_actor', 'ID', false, null, null);
		$this->addColumn('SOURCE_CULTURE', 'sourceCulture', 'VARCHAR', true, 7, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('object', 'object', RelationMap::MANY_TO_ONE, array('id' => 'id', ), 'CASCADE', null);
    $this->addRelation('term', 'term', RelationMap::MANY_TO_ONE, array('type_id' => 'id', ), 'CASCADE', null);
    $this->addRelation('informationObject', 'informationObject', RelationMap::MANY_TO_ONE, array('information_object_id' => 'id', ), 'CASCADE', null);
    $this->addRelation('actor', 'actor', RelationMap::MANY_TO_ONE, array('actor_id' => 'id', ), null, null);
    $this->addRelation('eventI18n', 'eventI18n', RelationMap::ONE_TO_MANY, array('id' => 'id', ), 'CASCADE', null);
	} // buildRelations()

} // EventTableMap
