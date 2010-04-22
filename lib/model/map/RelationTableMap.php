<?php


/**
 * This class defines the structure of the 'q_relation' table.
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
class RelationTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.RelationTableMap';

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
		$this->setName('q_relation');
		$this->setPhpName('relation');
		$this->setClassname('QubitRelation');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(false);
		// columns
		$this->addForeignPrimaryKey('ID', 'id', 'INTEGER' , 'q_object', 'ID', true, null, null);
		$this->addForeignKey('SUBJECT_ID', 'subjectId', 'INTEGER', 'q_object', 'ID', true, null, null);
		$this->addForeignKey('OBJECT_ID', 'objectId', 'INTEGER', 'q_object', 'ID', true, null, null);
		$this->addForeignKey('TYPE_ID', 'typeId', 'INTEGER', 'q_term', 'ID', false, null, null);
		$this->addColumn('START_DATE', 'startDate', 'DATE', false, null, null);
		$this->addColumn('END_DATE', 'endDate', 'DATE', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('objectRelatedByid', 'object', RelationMap::MANY_TO_ONE, array('id' => 'id', ), 'CASCADE', null);
    $this->addRelation('objectRelatedBysubjectId', 'object', RelationMap::MANY_TO_ONE, array('subject_id' => 'id', ), null, null);
    $this->addRelation('objectRelatedByobjectId', 'object', RelationMap::MANY_TO_ONE, array('object_id' => 'id', ), null, null);
    $this->addRelation('term', 'term', RelationMap::MANY_TO_ONE, array('type_id' => 'id', ), null, null);
	} // buildRelations()

} // RelationTableMap
