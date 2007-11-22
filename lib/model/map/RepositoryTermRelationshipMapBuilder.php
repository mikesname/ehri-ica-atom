<?php



class RepositoryTermRelationshipMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.RepositoryTermRelationshipMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('repository_term_relationship');
		$tMap->setPhpName('RepositoryTermRelationship');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('REPOSITORY_ID', 'RepositoryId', 'int', CreoleTypes::INTEGER, 'repository', 'ID', false, null);

		$tMap->addForeignKey('TERM_ID', 'TermId', 'int', CreoleTypes::INTEGER, 'term', 'ID', false, null);

		$tMap->addForeignKey('RELATIONSHIP_TYPE_ID', 'RelationshipTypeId', 'int', CreoleTypes::INTEGER, 'term', 'ID', false, null);

		$tMap->addColumn('RELATIONSHIP_NOTE', 'RelationshipNote', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 