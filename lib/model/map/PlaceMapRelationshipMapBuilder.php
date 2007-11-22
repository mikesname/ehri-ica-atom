<?php



class PlaceMapRelationshipMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.PlaceMapRelationshipMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('place_map_relationship');
		$tMap->setPhpName('PlaceMapRelationship');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('PLACE_ID', 'PlaceId', 'int', CreoleTypes::INTEGER, 'place', 'ID', false, null);

		$tMap->addForeignKey('MAP_ID', 'MapId', 'int', CreoleTypes::INTEGER, 'map', 'ID', false, null);

		$tMap->addForeignKey('MAP_ICON_IMAGE_ID', 'MapIconImageId', 'int', CreoleTypes::INTEGER, 'digital_object', 'ID', false, null);

		$tMap->addColumn('MAP_ICON_DESCRIPTION', 'MapIconDescription', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addForeignKey('RELATIONSHIP_TYPE_ID', 'RelationshipTypeId', 'int', CreoleTypes::INTEGER, 'term', 'ID', false, null);

		$tMap->addColumn('RELATIONSHIP_NOTE', 'RelationshipNote', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 