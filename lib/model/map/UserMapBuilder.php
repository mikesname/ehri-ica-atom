<?php



class UserMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.UserMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(QubitUser::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(QubitUser::TABLE_NAME);
		$tMap->setPhpName('user');
		$tMap->setClassname('QubitUser');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('ID', 'id', 'INTEGER' , 'q_actor', 'ID', true, null);

		$tMap->addColumn('USERNAME', 'username', 'VARCHAR', false, 255);

		$tMap->addColumn('EMAIL', 'email', 'VARCHAR', false, 255);

		$tMap->addColumn('SHA1_PASSWORD', 'sha1Password', 'VARCHAR', false, 255);

		$tMap->addColumn('SALT', 'salt', 'VARCHAR', false, 255);

	} 
} 