<?php



class PlaceMapRelationMapBuilder {

	
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
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('q_place_map_relation');
		$tMap->setPhpName('PlaceMapRelation');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('ID', 'Id', 'int' , CreoleTypes::INTEGER, 'q_object', 'ID', true, null);

		$tMap->addForeignKey('PLACE_ID', 'PlaceId', 'int', CreoleTypes::INTEGER, 'q_place', 'ID', true, null);

		$tMap->addForeignKey('MAP_ID', 'MapId', 'int', CreoleTypes::INTEGER, 'q_map', 'ID', true, null);

		$tMap->addForeignKey('MAP_ICON_IMAGE_ID', 'MapIconImageId', 'int', CreoleTypes::INTEGER, 'q_digital_object', 'ID', false, null);

		$tMap->addColumn('MAP_ICON_DESCRIPTION', 'MapIconDescription', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addForeignKey('TYPE_ID', 'TypeId', 'int', CreoleTypes::INTEGER, 'q_term', 'ID', false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, true, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, true, null);

	} 
} 