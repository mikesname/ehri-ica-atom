<?php



class NoteI18nMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.NoteI18nMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(QubitNoteI18n::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(QubitNoteI18n::TABLE_NAME);
		$tMap->setPhpName('noteI18n');
		$tMap->setClassname('QubitNoteI18n');

		$tMap->setUseIdGenerator(false);

		$tMap->addColumn('CONTENT', 'content', 'LONGVARCHAR', false, null);

		$tMap->addForeignPrimaryKey('ID', 'id', 'INTEGER' , 'q_note', 'ID', true, null);

		$tMap->addPrimaryKey('CULTURE', 'culture', 'VARCHAR', true, 7);

	} 
} 