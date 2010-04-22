<?php


/**
 * This class defines the structure of the 'q_system_event' table.
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
class SystemEventTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.SystemEventTableMap';

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
		$this->setName('q_system_event');
		$this->setPhpName('systemEvent');
		$this->setClassname('QubitSystemEvent');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addForeignKey('TYPE_ID', 'typeId', 'INTEGER', 'q_term', 'ID', false, null, null);
		$this->addColumn('OBJECT_CLASS', 'objectClass', 'VARCHAR', false, 255, null);
		$this->addColumn('OBJECT_ID', 'objectId', 'INTEGER', false, null, null);
		$this->addColumn('PRE_EVENT_SNAPSHOT', 'preEventSnapshot', 'LONGVARCHAR', false, null, null);
		$this->addColumn('POST_EVENT_SNAPSHOT', 'postEventSnapshot', 'LONGVARCHAR', false, null, null);
		$this->addColumn('DATE', 'date', 'TIMESTAMP', false, null, null);
		$this->addForeignKey('USER_ID', 'userId', 'INTEGER', 'q_user', 'ID', false, null, null);
		$this->addColumn('CREATED_AT', 'createdAt', 'TIMESTAMP', true, null, null);
		$this->addColumn('UPDATED_AT', 'updatedAt', 'TIMESTAMP', true, null, null);
		$this->addPrimaryKey('ID', 'id', 'INTEGER', true, null, null);
		$this->addColumn('SERIAL_NUMBER', 'serialNumber', 'INTEGER', true, null, 0);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('term', 'term', RelationMap::MANY_TO_ONE, array('type_id' => 'id', ), null, null);
    $this->addRelation('user', 'user', RelationMap::MANY_TO_ONE, array('user_id' => 'id', ), null, null);
	} // buildRelations()

} // SystemEventTableMap
