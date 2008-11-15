<?php



class ActorI18nMapBuilder {

	
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
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('q_actor_i18n');
		$tMap->setPhpName('ActorI18n');

		$tMap->setUseIdGenerator(false);

		$tMap->addColumn('AUTHORIZED_FORM_OF_NAME', 'AuthorizedFormOfName', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('DATES_OF_EXISTENCE', 'DatesOfExistence', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('HISTORY', 'History', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('PLACES', 'Places', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('LEGAL_STATUS', 'LegalStatus', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('FUNCTIONS', 'Functions', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('MANDATES', 'Mandates', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('INTERNAL_STRUCTURES', 'InternalStructures', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('GENERAL_CONTEXT', 'GeneralContext', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('INSTITUTION_RESPONSIBLE_IDENTIFIER', 'InstitutionResponsibleIdentifier', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('RULES', 'Rules', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('SOURCES', 'Sources', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('REVISION_HISTORY', 'RevisionHistory', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addForeignPrimaryKey('ID', 'Id', 'int' , CreoleTypes::INTEGER, 'q_actor', 'ID', true, null);

		$tMap->addPrimaryKey('CULTURE', 'Culture', 'string', CreoleTypes::VARCHAR, true, 7);

	} 
} 