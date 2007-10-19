<?php



class TermMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.TermMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('term');
		$tMap->setPhpName('Term');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('TAXONOMY_ID', 'TaxonomyId', 'int', CreoleTypes::INTEGER, 'taxonomy', 'ID', false, null);

		$tMap->addColumn('TERM_NAME', 'TermName', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('SCOPE_NOTE', 'ScopeNote', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('CODE_ALPHA', 'CodeAlpha', 'string', CreoleTypes::VARCHAR, false, 5);

		$tMap->addColumn('CODE_ALPHA2', 'CodeAlpha2', 'string', CreoleTypes::VARCHAR, false, 5);

		$tMap->addColumn('CODE_NUMERIC', 'CodeNumeric', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('SORT_ORDER', 'SortOrder', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('SOURCE', 'Source', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('LOCKED', 'Locked', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('TREE_ID', 'TreeId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('TREE_LEFT_ID', 'TreeLeftId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('TREE_RIGHT_ID', 'TreeRightId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('TREE_PARENT_ID', 'TreeParentId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 