<?php


/**
 * This class defines the structure of the 'place_i18n' table.
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
class PlaceI18nTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.PlaceI18nTableMap';

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
		$this->setName('place_i18n');
		$this->setPhpName('placeI18n');
		$this->setClassname('QubitPlaceI18n');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(false);
		// columns
		$this->addColumn('STREET_ADDRESS', 'streetAddress', 'LONGVARCHAR', false, null, null);
		$this->addColumn('CITY', 'city', 'VARCHAR', false, 255, null);
		$this->addColumn('REGION', 'region', 'VARCHAR', false, 255, null);
		$this->addColumn('POSTAL_CODE', 'postalCode', 'VARCHAR', false, 255, null);
		$this->addForeignPrimaryKey('ID', 'id', 'INTEGER' , 'place', 'ID', true, null, null);
		$this->addPrimaryKey('CULTURE', 'culture', 'VARCHAR', true, 7, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('place', 'place', RelationMap::MANY_TO_ONE, array('id' => 'id', ), 'CASCADE', null);
	} // buildRelations()

} // PlaceI18nTableMap
