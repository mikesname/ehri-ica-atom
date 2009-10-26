<?php



class ContactInformationI18nMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.ContactInformationI18nMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(QubitContactInformationI18n::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(QubitContactInformationI18n::TABLE_NAME);
		$tMap->setPhpName('contactInformationI18n');
		$tMap->setClassname('QubitContactInformationI18n');

		$tMap->setUseIdGenerator(false);

		$tMap->addColumn('CONTACT_TYPE', 'contactType', 'VARCHAR', false, 255);

		$tMap->addColumn('CITY', 'city', 'VARCHAR', false, 255);

		$tMap->addColumn('REGION', 'region', 'VARCHAR', false, 255);

		$tMap->addColumn('NOTE', 'note', 'LONGVARCHAR', false, null);

		$tMap->addForeignPrimaryKey('ID', 'id', 'INTEGER' , 'q_contact_information', 'ID', true, null);

		$tMap->addPrimaryKey('CULTURE', 'culture', 'VARCHAR', true, 7);

		$tMap->addColumn('SERIAL_NUMBER', 'serialNumber', 'INTEGER', true, null);

	} 
} 