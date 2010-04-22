<?php


/**
 * This class defines the structure of the 'q_place' table.
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
class PlaceTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.PlaceTableMap';

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
		$this->setName('q_place');
		$this->setPhpName('place');
		$this->setClassname('QubitPlace');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(false);
		// columns
		$this->addForeignPrimaryKey('ID', 'id', 'INTEGER' , 'q_term', 'ID', true, null, null);
		$this->addForeignKey('COUNTRY_ID', 'countryId', 'INTEGER', 'q_term', 'ID', false, null, null);
		$this->addForeignKey('TYPE_ID', 'typeId', 'INTEGER', 'q_term', 'ID', false, null, null);
		$this->addColumn('LONGTITUDE', 'longtitude', 'FLOAT', false, null, null);
		$this->addColumn('LATITUDE', 'latitude', 'FLOAT', false, null, null);
		$this->addColumn('ALTITUDE', 'altitude', 'FLOAT', false, null, null);
		$this->addColumn('SOURCE_CULTURE', 'sourceCulture', 'VARCHAR', true, 7, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('termRelatedByid', 'term', RelationMap::MANY_TO_ONE, array('id' => 'id', ), 'CASCADE', null);
    $this->addRelation('termRelatedBycountryId', 'term', RelationMap::MANY_TO_ONE, array('country_id' => 'id', ), null, null);
    $this->addRelation('termRelatedBytypeId', 'term', RelationMap::MANY_TO_ONE, array('type_id' => 'id', ), null, null);
    $this->addRelation('placeI18n', 'placeI18n', RelationMap::ONE_TO_MANY, array('id' => 'id', ), 'CASCADE', null);
    $this->addRelation('placeMapRelation', 'placeMapRelation', RelationMap::ONE_TO_MANY, array('id' => 'place_id', ), 'CASCADE', null);
	} // buildRelations()

} // PlaceTableMap
