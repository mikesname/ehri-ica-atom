<?php



class ContactInformationMapBuilder {

	
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
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('q_contact_information');
		$tMap->setPhpName('ContactInformation');

		$tMap->setUseIdGenerator(true);

		$tMap->addForeignKey('ACTOR_ID', 'ActorId', 'int', CreoleTypes::INTEGER, 'q_actor', 'ID', true, null);

		$tMap->addColumn('PRIMARY_CONTACT', 'PrimaryContact', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('STREET_ADDRESS', 'StreetAddress', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('WEBSITE', 'Website', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('EMAIL', 'Email', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('TELEPHONE', 'Telephone', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('FAX', 'Fax', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('POSTAL_CODE', 'PostalCode', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('COUNTRY_CODE', 'CountryCode', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('LONGTITUDE', 'Longtitude', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('LATITUDE', 'Latitude', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, true, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, true, null);

		$tMap->addColumn('SOURCE_CULTURE', 'SourceCulture', 'string', CreoleTypes::VARCHAR, true, 7);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

	} 
} 