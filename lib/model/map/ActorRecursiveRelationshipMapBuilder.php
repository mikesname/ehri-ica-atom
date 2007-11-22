<?php



class ActorRecursiveRelationshipMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.ActorRecursiveRelationshipMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('actor_recursive_relationship');
		$tMap->setPhpName('ActorRecursiveRelationship');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('ACTOR_ID', 'ActorId', 'int', CreoleTypes::INTEGER, 'actor', 'ID', false, null);

		$tMap->addForeignKey('RELATED_ACTOR_ID', 'RelatedActorId', 'int', CreoleTypes::INTEGER, 'actor', 'ID', false, null);

		$tMap->addForeignKey('RELATIONSHIP_TYPE_ID', 'RelationshipTypeId', 'int', CreoleTypes::INTEGER, 'term', 'ID', false, null);

		$tMap->addColumn('RELATIONSHIP_DESCRIPTION', 'RelationshipDescription', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('RELATIONSHIP_START_DATE', 'RelationshipStartDate', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('RELATIONSHIP_END_DATE', 'RelationshipEndDate', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('DATE_DISPLAY', 'DateDisplay', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 