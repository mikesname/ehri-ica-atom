<?php



class PlaceMapRelationMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.PlaceMapRelationMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(QubitPlaceMapRelation::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(QubitPlaceMapRelation::TABLE_NAME);
		$tMap->setPhpName('placeMapRelation');
		$tMap->setClassname('QubitPlaceMapRelation');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('ID', 'id', 'INTEGER' , 'q_object', 'ID', true, null);

		$tMap->addForeignKey('PLACE_ID', 'placeId', 'INTEGER', 'q_place', 'ID', true, null);

		$tMap->addForeignKey('MAP_ID', 'mapId', 'INTEGER', 'q_map', 'ID', true, null);

		$tMap->addForeignKey('MAP_ICON_IMAGE_ID', 'mapIconImageId', 'INTEGER', 'q_digital_object', 'ID', false, null);

		$tMap->addColumn('MAP_ICON_DESCRIPTION', 'mapIconDescription', 'LONGVARCHAR', false, null);

		$tMap->addForeignKey('TYPE_ID', 'typeId', 'INTEGER', 'q_term', 'ID', false, null);

		$tMap->addColumn('CREATED_AT', 'createdAt', 'TIMESTAMP', true, null);

		$tMap->addColumn('UPDATED_AT', 'updatedAt', 'TIMESTAMP', true, null);

	} 
} 