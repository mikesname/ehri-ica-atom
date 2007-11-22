<?php



class DigitalObjectRecursiveRelationshipMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.DigitalObjectRecursiveRelationshipMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('digital_object_recursive_relationship');
		$tMap->setPhpName('DigitalObjectRecursiveRelationship');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('DIGITAL_OBJECT_ID', 'DigitalObjectId', 'int', CreoleTypes::INTEGER, 'digital_object', 'ID', false, null);

		$tMap->addForeignKey('RELATED_DIGITAL_OBJECT_ID', 'RelatedDigitalObjectId', 'int', CreoleTypes::INTEGER, 'digital_object', 'ID', false, null);

		$tMap->addForeignKey('RELATIONSHIP_TYPE_ID', 'RelationshipTypeId', 'int', CreoleTypes::INTEGER, 'term', 'ID', false, null);

		$tMap->addColumn('RELATIONSHIP_DESCRIPTION', 'RelationshipDescription', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 