<?php



class informationObjectRecursiveRelationshipMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.informationObjectRecursiveRelationshipMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('information_object_recursive_relationship');
		$tMap->setPhpName('informationObjectRecursiveRelationship');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('INFORMATION_OBJECT_ID', 'InformationObjectId', 'int', CreoleTypes::INTEGER, 'information_object', 'ID', false, null);

		$tMap->addForeignKey('RELATED_INFORMATION_OBJECT_ID', 'RelatedInformationObjectId', 'int', CreoleTypes::INTEGER, 'information_object', 'ID', false, null);

		$tMap->addForeignKey('RELATIONSHIP_TYPE_ID', 'RelationshipTypeId', 'int', CreoleTypes::INTEGER, 'term', 'ID', false, null);

		$tMap->addColumn('RELATIONSHIP_DESCRIPTION', 'RelationshipDescription', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('RELATIONSHIP_START_DATE', 'RelationshipStartDate', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('RELATIONSHIP_END_DATE', 'RelationshipEndDate', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('DATE_DISPLAY', 'DateDisplay', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 