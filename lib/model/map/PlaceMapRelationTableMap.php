<?php


/**
 * This class defines the structure of the 'q_place_map_relation' table.
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
class PlaceMapRelationTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.PlaceMapRelationTableMap';

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
		$this->setName('q_place_map_relation');
		$this->setPhpName('placeMapRelation');
		$this->setClassname('QubitPlaceMapRelation');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(false);
		// columns
		$this->addForeignPrimaryKey('ID', 'id', 'INTEGER' , 'q_object', 'ID', true, null, null);
		$this->addForeignKey('PLACE_ID', 'placeId', 'INTEGER', 'q_place', 'ID', true, null, null);
		$this->addForeignKey('MAP_ID', 'mapId', 'INTEGER', 'q_map', 'ID', true, null, null);
		$this->addForeignKey('MAP_ICON_IMAGE_ID', 'mapIconImageId', 'INTEGER', 'q_digital_object', 'ID', false, null, null);
		$this->addColumn('MAP_ICON_DESCRIPTION', 'mapIconDescription', 'LONGVARCHAR', false, null, null);
		$this->addForeignKey('TYPE_ID', 'typeId', 'INTEGER', 'q_term', 'ID', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('object', 'object', RelationMap::MANY_TO_ONE, array('id' => 'id', ), 'CASCADE', null);
    $this->addRelation('place', 'place', RelationMap::MANY_TO_ONE, array('place_id' => 'id', ), 'CASCADE', null);
    $this->addRelation('map', 'map', RelationMap::MANY_TO_ONE, array('map_id' => 'id', ), 'CASCADE', null);
    $this->addRelation('digitalObject', 'digitalObject', RelationMap::MANY_TO_ONE, array('map_icon_image_id' => 'id', ), null, null);
    $this->addRelation('term', 'term', RelationMap::MANY_TO_ONE, array('type_id' => 'id', ), null, null);
	} // buildRelations()

} // PlaceMapRelationTableMap
