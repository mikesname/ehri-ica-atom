<?php



class ContactInformationMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.ContactInformationMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(QubitContactInformation::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(QubitContactInformation::TABLE_NAME);
		$tMap->setPhpName('contactInformation');
		$tMap->setClassname('QubitContactInformation');

		$tMap->setUseIdGenerator(true);

		$tMap->addForeignKey('ACTOR_ID', 'actorId', 'INTEGER', 'q_actor', 'ID', true, null);

		$tMap->addColumn('PRIMARY_CONTACT', 'primaryContact', 'BOOLEAN', false, null);

		$tMap->addColumn('CONTACT_PERSON', 'contactPerson', 'VARCHAR', false, 255);

		$tMap->addColumn('STREET_ADDRESS', 'streetAddress', 'LONGVARCHAR', false, null);

		$tMap->addColumn('WEBSITE', 'website', 'VARCHAR', false, 255);

		$tMap->addColumn('EMAIL', 'email', 'VARCHAR', false, 255);

		$tMap->addColumn('TELEPHONE', 'telephone', 'VARCHAR', false, 255);

		$tMap->addColumn('FAX', 'fax', 'VARCHAR', false, 255);

		$tMap->addColumn('POSTAL_CODE', 'postalCode', 'VARCHAR', false, 255);

		$tMap->addColumn('COUNTRY_CODE', 'countryCode', 'VARCHAR', false, 255);

		$tMap->addColumn('LONGTITUDE', 'longtitude', 'FLOAT', false, null);

		$tMap->addColumn('LATITUDE', 'latitude', 'FLOAT', false, null);

		$tMap->addColumn('CREATED_AT', 'createdAt', 'TIMESTAMP', true, null);

		$tMap->addColumn('UPDATED_AT', 'updatedAt', 'TIMESTAMP', true, null);

		$tMap->addColumn('SOURCE_CULTURE', 'sourceCulture', 'VARCHAR', true, 7);

		$tMap->addPrimaryKey('ID', 'id', 'INTEGER', true, null);

	} 
} 