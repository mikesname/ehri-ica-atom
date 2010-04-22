<?php


/**
 * This class defines the structure of the 'q_rights_actor_relation' table.
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
class RightsActorRelationTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.RightsActorRelationTableMap';

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
		$this->setName('q_rights_actor_relation');
		$this->setPhpName('rightsActorRelation');
		$this->setClassname('QubitRightsActorRelation');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(false);
		// columns
		$this->addForeignPrimaryKey('ID', 'id', 'INTEGER' , 'q_object', 'ID', true, null, null);
		$this->addForeignKey('RIGHTS_ID', 'rightsId', 'INTEGER', 'q_rights', 'ID', true, null, null);
		$this->addForeignKey('ACTOR_ID', 'actorId', 'INTEGER', 'q_actor', 'ID', true, null, null);
		$this->addForeignKey('TYPE_ID', 'typeId', 'INTEGER', 'q_term', 'ID', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('object', 'object', RelationMap::MANY_TO_ONE, array('id' => 'id', ), 'CASCADE', null);
    $this->addRelation('rights', 'rights', RelationMap::MANY_TO_ONE, array('rights_id' => 'id', ), 'CASCADE', null);
    $this->addRelation('actor', 'actor', RelationMap::MANY_TO_ONE, array('actor_id' => 'id', ), 'CASCADE', null);
    $this->addRelation('term', 'term', RelationMap::MANY_TO_ONE, array('type_id' => 'id', ), null, null);
	} // buildRelations()

} // RightsActorRelationTableMap
