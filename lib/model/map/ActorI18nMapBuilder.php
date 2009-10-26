<?php



class ActorI18nMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.ActorI18nMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(QubitActorI18n::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(QubitActorI18n::TABLE_NAME);
		$tMap->setPhpName('actorI18n');
		$tMap->setClassname('QubitActorI18n');

		$tMap->setUseIdGenerator(false);

		$tMap->addColumn('AUTHORIZED_FORM_OF_NAME', 'authorizedFormOfName', 'VARCHAR', true, 255);

		$tMap->addColumn('DATES_OF_EXISTENCE', 'datesOfExistence', 'VARCHAR', false, 255);

		$tMap->addColumn('HISTORY', 'history', 'LONGVARCHAR', false, null);

		$tMap->addColumn('PLACES', 'places', 'LONGVARCHAR', false, null);

		$tMap->addColumn('LEGAL_STATUS', 'legalStatus', 'LONGVARCHAR', false, null);

		$tMap->addColumn('FUNCTIONS', 'functions', 'LONGVARCHAR', false, null);

		$tMap->addColumn('MANDATES', 'mandates', 'LONGVARCHAR', false, null);

		$tMap->addColumn('INTERNAL_STRUCTURES', 'internalStructures', 'LONGVARCHAR', false, null);

		$tMap->addColumn('GENERAL_CONTEXT', 'generalContext', 'LONGVARCHAR', false, null);

		$tMap->addColumn('INSTITUTION_RESPONSIBLE_IDENTIFIER', 'institutionResponsibleIdentifier', 'VARCHAR', false, 255);

		$tMap->addColumn('RULES', 'rules', 'LONGVARCHAR', false, null);

		$tMap->addColumn('SOURCES', 'sources', 'LONGVARCHAR', false, null);

		$tMap->addColumn('REVISION_HISTORY', 'revisionHistory', 'LONGVARCHAR', false, null);

		$tMap->addForeignPrimaryKey('ID', 'id', 'INTEGER' , 'q_actor', 'ID', true, null);

		$tMap->addPrimaryKey('CULTURE', 'culture', 'VARCHAR', true, 7);

		$tMap->addColumn('SERIAL_NUMBER', 'serialNumber', 'INTEGER', true, null);

	} 
} 