<?php



class RightsActorRelationMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.RightsActorRelationMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(QubitRightsActorRelation::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(QubitRightsActorRelation::TABLE_NAME);
		$tMap->setPhpName('rightsActorRelation');
		$tMap->setClassname('QubitRightsActorRelation');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('ID', 'id', 'INTEGER' , 'q_object', 'ID', true, null);

		$tMap->addForeignKey('RIGHTS_ID', 'rightsId', 'INTEGER', 'q_rights', 'ID', true, null);

		$tMap->addForeignKey('ACTOR_ID', 'actorId', 'INTEGER', 'q_actor', 'ID', true, null);

		$tMap->addForeignKey('TYPE_ID', 'typeId', 'INTEGER', 'q_term', 'ID', false, null);

	} 
} 