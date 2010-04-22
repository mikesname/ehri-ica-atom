<?php

/*
 * This file is part of Qubit Toolkit.
 *
 * Qubit Toolkit is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * (at your option) any later version.
 *
 * Qubit Toolkit is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Qubit Toolkit.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Upgrade qubit data from version 1.0.7 to 1.0.8 schema
 *
 * @package    qubit
 * @subpackage migration
 * @version    svn: $Id$
 * @author     David Juhasz <david@artefactual.com>
 */
class QubitMigrate107 extends QubitMigrate
{
  /**
   * Controller for calling methods to alter data
   *
   * @return QubitMigrate107 this object
   */
  protected function alterData()
  {
    // Delete "stub" objects
    $this->deleteStubObjects();

    // Add ROOT_ID to root information object
    $this->addInformationObjectRootId();

    // Insert new taxonomy and terms
    $this->addAclGroups();
    $this->addAclActions();
    $this->addAclPermissions();
    $this->addActorRelationTaxonomyTerms();
    $this->addActorRelationNoteTaxonomyTerms();
    $this->addTermRelationTaxonomyTerms();
    $this->addRootTaxonomyTerms();
    $this->addStatusTaxonomyTerms();

    // Assign equivalent access permissions for users in ACL scheme
    $this->copyUserRoleRelationToAclUserGroup();

    // Alter qubit classes (methods ordered alphabetically)
    $this->alterQubitEvents();
    $this->alterQubitMenus();
    $this->alterQubitProperties();
    $this->alterQubitSettings();
    $this->alterQubitStaticPages();
    $this->alterQubitStatus();
    $this->alterQubitTerms();

    return $this;
  }

  /**
   * Call all sort methods
   *
   * @return QubitMigrate107 this object
   */
  protected function sortData()
  {
    // Sort objects within classes
    $this->sortQubitInformationObjects();
    $this->sortQubitTerms();

    // Sort classes
    $this->sortClasses();

    return $this;
  }

  protected function addInformationObjectRootId()
  {
    if (null !== ($rootInformationObjectKey = $this->getRowKey('QubitInformationObject', 'lft', '1')))
    {
      $this->data['QubitInformationObject'][$rootInformationObjectKey]['id'] = '<?php echo QubitInformationObject::ROOT_ID."\n" ?>';
    }

    return $this;
  }

  protected function addAclGroups()
  {
    $this->data['QubitAclGroup'] = array(
      'QubitAclGroup_ROOT' => array(
        'id' => '<?php echo QubitAclGroup::ROOT_ID."\n" ?>',
      ),
      'QubitAclGroup_anonymous' => array(
        'id' => '<?php echo QubitAclGroup::ANONYMOUS_ID."\n" ?>',
        'parent_id' => 'QubitAclGroup_ROOT',
        'name' => array('en' => 'anonymous')
      ),
      'QubitAclGroup_authenticated' => array(
        'id' => '<?php echo QubitAclGroup::AUTHENTICATED_ID."\n" ?>',
        'parent_id' => 'QubitAclGroup_anonymous',
        'name' => array('en' => 'authenticated')
      ),
      'QubitAclGroup_administrator' => array(
        'id' => '<?php echo QubitAclGroup::ADMINISTRATOR_ID."\n" ?>',
        'parent_id' => 'QubitAclGroup_authenticated',
        'name' => array('en' => 'administrator')
      ),
      'QubitAclGroup_editor' => array(
        'id' => '<?php echo QubitAclGroup::EDITOR_ID."\n" ?>',
        'parent_id' => 'QubitAclGroup_authenticated',
        'name' => array('en' => 'editor')
      ),
      'QubitAclGroup_contributor' => array(
        'id' => '<?php echo QubitAclGroup::CONTRIBUTOR_ID."\n" ?>',
        'parent_id' => 'QubitAclGroup_authenticated',
        'name' => array('en' => 'contributor')
      ),
      'QubitAclGroup_translator' => array(
        'id' => '<?php echo QubitAclGroup::TRANSLATOR_ID."\n" ?>',
        'parent_id' => 'QubitAclGroup_authenticated',
        'name' => array('en' => 'translator')
      )
    );

    return $this;
  }

  protected function addAclActions()
  {
    $this->data['QubitAclAction'] = array(
      'QubitAclAction_create' => array(
        'id' => '<?php echo QubitAclAction::CREATE_ID."\n" ?>',
        'name' => array('en' => 'create')
      ),
      'QubitAclAction_read' => array(
        'id' => '<?php echo QubitAclAction::READ_ID."\n" ?>',
        'name' => array('en' => 'read')
      ),
      'QubitAclAction_update' => array(
        'id' => '<?php echo QubitAclAction::UPDATE_ID."\n" ?>',
        'name' => array('en' => 'update')
      ),
      'QubitAclAction_delete' => array(
        'id' => '<?php echo QubitAclAction::DELETE_ID."\n" ?>',
        'name' => array('en' => 'delete')
      ),
      'QubitAclAction_view_draft' => array(
        'id' => '<?php echo QubitAclAction::VIEW_DRAFT_ID."\n" ?>',
        'name' => array('en' => 'view draft')
      ),
      'QubitAclAction_publish' => array(
        'id' => '<?php echo QubitAclAction::PUBLISH_ID."\n" ?>',
        'name' => array('en' => 'publish')
      )
    );

    return $this;
  }

  protected function addAclPermissions()
  {
    $this->data['QubitAclPermission'] = array(
      'QubitAclPermission_anonymous_read' => array(
        'group_id' => 'QubitAclGroup_anonymous',
        'object_id' => '<?php echo QubitInformationObject::ROOT_ID."\n" ?>',
        'action_id' => '<?php echo QubitAclAction::READ_ID."\n" ?>',
        'grant_deny' => '1',
      ),
      'QubitAclPermission_authenticated_read' => array(
        'group_id' => 'QubitAclGroup_authenticated',
        'object_id' => '<?php echo QubitInformationObject::ROOT_ID."\n" ?>',
        'action_id' => '<?php echo QubitAclAction::READ_ID."\n" ?>',
        'grant_deny' => '1',
      ),
      'QubitAclPermission_admin_create' => array(
        'group_id' => 'QubitAclGroup_administrator',
        'object_id' => '<?php echo QubitInformationObject::ROOT_ID."\n" ?>',
        'action_id' => '<?php echo QubitAclAction::CREATE_ID."\n" ?>',
        'grant_deny' => '1',
      ),
      'QubitAclPermission_admin_read' => array(
        'group_id' => 'QubitAclGroup_administrator',
        'object_id' => '<?php echo QubitInformationObject::ROOT_ID."\n" ?>',
        'action_id' => '<?php echo QubitAclAction::READ_ID."\n" ?>',
        'grant_deny' => '1',
      ),
      'QubitAclPermission_admin_update' => array(
        'group_id' => 'QubitAclGroup_administrator',
        'object_id' => '<?php echo QubitInformationObject::ROOT_ID."\n" ?>',
        'action_id' => '<?php echo QubitAclAction::UPDATE_ID."\n" ?>',
        'grant_deny' => '1',
      ),
      'QubitAclPermission_admin_delete' => array(
        'group_id' => 'QubitAclGroup_administrator',
        'object_id' => '<?php echo QubitInformationObject::ROOT_ID."\n" ?>',
        'action_id' => '<?php echo QubitAclAction::DELETE_ID."\n" ?>',
        'grant_deny' => '1',
      ),
      'QubitAclPermission_admin_view_draft' => array(
        'group_id' => 'QubitAclGroup_administrator',
        'object_id' => '<?php echo QubitInformationObject::ROOT_ID."\n" ?>',
        'action_id' => '<?php echo QubitAclAction::VIEW_DRAFT_ID."\n" ?>',
        'grant_deny' => '1',
      ),
      'QubitAclPermission_admin_publish' => array(
        'group_id' => 'QubitAclGroup_administrator',
        'object_id' => '<?php echo QubitInformationObject::ROOT_ID."\n" ?>',
        'action_id' => '<?php echo QubitAclAction::PUBLISH_ID."\n" ?>',
        'grant_deny' => '1',
      ),
      'QubitAclPermission_editor_create' => array(
        'group_id' => 'QubitAclGroup_editor',
        'object_id' => '<?php echo QubitInformationObject::ROOT_ID."\n" ?>',
        'action_id' => '<?php echo QubitAclAction::CREATE_ID."\n" ?>',
        'grant_deny' => '1',
      ),
      'QubitAclPermission_editor_read' => array(
        'group_id' => 'QubitAclGroup_editor',
        'object_id' => '<?php echo QubitInformationObject::ROOT_ID."\n" ?>',
        'action_id' => '<?php echo QubitAclAction::READ_ID."\n" ?>',
        'grant_deny' => '1',
      ),
      'QubitAclPermission_editor_update' => array(
        'group_id' => 'QubitAclGroup_editor',
        'object_id' => '<?php echo QubitInformationObject::ROOT_ID."\n" ?>',
        'action_id' => '<?php echo QubitAclAction::UPDATE_ID."\n" ?>',
        'grant_deny' => '1',
      ),
      'QubitAclPermission_editor_delete' => array(
        'group_id' => 'QubitAclGroup_editor',
        'object_id' => '<?php echo QubitInformationObject::ROOT_ID."\n" ?>',
        'action_id' => '<?php echo QubitAclAction::DELETE_ID."\n" ?>',
        'grant_deny' => '1',
      ),
      'QubitAclPermission_editor_view_draft' => array(
        'group_id' => 'QubitAclGroup_editor',
        'object_id' => '<?php echo QubitInformationObject::ROOT_ID."\n" ?>',
        'action_id' => '<?php echo QubitAclAction::VIEW_DRAFT_ID."\n" ?>',
        'grant_deny' => '1',
      ),
      'QubitAclPermission_editor_publish' => array(
        'group_id' => 'QubitAclGroup_editor',
        'object_id' => '<?php echo QubitInformationObject::ROOT_ID."\n" ?>',
        'action_id' => '<?php echo QubitAclAction::PUBLISH_ID."\n" ?>',
        'grant_deny' => '1',
      ),
      'QubitAclPermission_contributor_create' => array(
        'group_id' => 'QubitAclGroup_contributor',
        'object_id' => '<?php echo QubitInformationObject::ROOT_ID."\n" ?>',
        'action_id' => '<?php echo QubitAclAction::CREATE_ID."\n" ?>',
        'grant_deny' => '1',
      ),
      'QubitAclPermission_contributor_read' => array(
        'group_id' => 'QubitAclGroup_contributor',
        'object_id' => '<?php echo QubitInformationObject::ROOT_ID."\n" ?>',
        'action_id' => '<?php echo QubitAclAction::READ_ID."\n" ?>',
        'grant_deny' => '1',
      ),
      'QubitAclPermission_contributor_update' => array(
        'group_id' => 'QubitAclGroup_contributor',
        'object_id' => '<?php echo QubitInformationObject::ROOT_ID."\n" ?>',
        'action_id' => '<?php echo QubitAclAction::UPDATE_ID."\n" ?>',
        'grant_deny' => '1',
      ),
      'QubitAclPermission_contributor_view_draft' => array(
        'group_id' => 'QubitAclGroup_contributor',
        'object_id' => '<?php echo QubitInformationObject::ROOT_ID."\n" ?>',
        'action_id' => '<?php echo QubitAclAction::VIEW_DRAFT_ID."\n" ?>',
        'grant_deny' => '1',
      ),
      'QubitAclPermission_translator_read' => array(
        'group_id' => 'QubitAclGroup_translator',
        'object_id' => '<?php echo QubitInformationObject::ROOT_ID."\n" ?>',
        'action_id' => '<?php echo QubitAclAction::READ_ID."\n" ?>',
        'grant_deny' => '1',
      ),
      'QubitAclPermission_translator_update' => array(
        'group_id' => 'QubitAclGroup_translator',
        'object_id' => '<?php echo QubitInformationObject::ROOT_ID."\n" ?>',
        'action_id' => '<?php echo QubitAclAction::UPDATE_ID."\n" ?>',
        'grant_deny' => '1',
      ),
      'QubitAclPermission_translator_view_draft' => array(
        'group_id' => 'QubitAclGroup_translator',
        'object_id' => '<?php echo QubitInformationObject::ROOT_ID."\n" ?>',
        'action_id' => '<?php echo QubitAclAction::VIEW_DRAFT_ID."\n" ?>',
        'grant_deny' => '1',
      )
    );

    return $this;
  }

  /**
   * Add the 'Actor Relation Type' taxonomy and terms
   *
   * @return QubitMigrate107 this object
   */
  protected function addActorRelationTaxonomyTerms()
  {
    // Add Actor Relation Type taxonomy
    $this->data['QubitTaxonomy']['QubitTaxonomy_actor_relation_type'] = array(
      'source_culture' => 'en',
      'id' => '<?php echo QubitTaxonomy::ACTOR_RELATION_TYPE_ID."\n" ?>',
      'name' => array('en' => 'Actor Relation Type'),
      'note' => array('en' => 'Actor-to-Actor relationship categories defined by the ICA ISAAR (CPF) specification, 2nd Edition, Section 5.3.2, \'Category of relationship\'.')
    );

    // Add related terms
    $this->data['QubitTerm']['QubitTerm_actor_relationship_hierarchical'] = array(
      'taxonomy_id' => 'QubitTaxonomy_actor_relation_type',
      'id' => '<?php echo QubitTerm::HIERARCHICAL_RELATION_ID."\n" ?>',
      'source_culture' => 'en',
      'name' => array('en' => 'hierarchical')
    );
    $this->data['QubitTerm']['QubitTerm_actor_relationship_temporal'] = array(
      'taxonomy_id' => 'QubitTaxonomy_actor_relation_type',
      'id' => '<?php echo QubitTerm::TEMPORAL_RELATION_ID."\n" ?>',
      'source_culture' => 'en',
      'name' => array('en' => 'temporal')
    );
    $this->data['QubitTerm']['QubitTerm_actor_relationship_family'] = array(
      'taxonomy_id' => 'QubitTaxonomy_actor_relation_type',
      'id' => '<?php echo QubitTerm::FAMILY_RELATION_ID."\n" ?>',
      'source_culture' => 'en',
      'name' => array('en' => 'family')
    );
    $this->data['QubitTerm']['QubitTerm_actor_relationship_associative'] = array(
      'taxonomy_id' => 'QubitTaxonomy_actor_relation_type',
      'id' => '<?php echo QubitTerm::ASSOCIATIVE_RELATION_ID."\n" ?>',
      'source_culture' => 'en',
      'name' => array('en' => 'associative')
    );

    return $this;
  }

  /**
   * Add the 'Actor Relation Note' taxonomy and terms
   *
   * @return QubitMigrate107 this object
   */
  protected function addActorRelationNoteTaxonomyTerms()
  {
    // Add Actor Relation Type taxonomy
    $this->data['QubitTaxonomy']['QubitTaxonomy_actor_relation_note_type'] = array(
      'source_culture' => 'en',
      'id' => '<?php echo QubitTaxonomy::RELATION_NOTE_TYPE_ID."\n" ?>',
      'name' => array('en' => 'Relation Note Types')
    );

    // Add related terms
    $this->data['QubitTerm']['QubitTerm_actor_relation_description'] = array(
      'taxonomy_id' => 'QubitTaxonomy_actor_relation_note_type',
      'id' => '<?php echo QubitTerm::RELATION_NOTE_DESCRIPTION_ID."\n" ?>',
      'source_culture' => 'en',
      'name' => array('en' => 'description')
    );
    $this->data['QubitTerm']['QubitTerm_actor_relation_date_display'] = array(
      'taxonomy_id' => 'QubitTaxonomy_actor_relation_note_type',
      'id' => '<?php echo QubitTerm::RELATION_NOTE_DATE_DISPLAY_ID."\n" ?>',
      'source_culture' => 'en',
      'name' => array('en' => 'date display')
    );

    return $this;
  }

  /**
   * Add 'term relation type' taxonomy and terms
   *
   * @return QubitMigrate107 this object
   */
  protected function addTermRelationTaxonomyTerms()
  {
    // Add taxonomy
    $this->data['QubitTaxonomy']['QubitTaxonomy_term_relation'] = array(
      'source_culture' => 'en',
      'id' => '<?php echo QubitTaxonomy::TERM_RELATION_TYPE_ID."\n" ?>',
      'name' => array('en' => 'Term relation types')
    );

    // Add related terms
    $this->data['QubitTerm']['QubitTerm_term_relation_description'] = array(
      'taxonomy_id' => 'QubitTaxonomy_term_relation',
      'id' => '<?php echo QubitTerm::TERM_RELATION_EQUIVALENCE_ID."\n" ?>',
      'source_culture' => 'en',
      'name' => array('en' => 'equivalence')
    );
    $this->data['QubitTerm']['QubitTerm_term_relation_date_display'] = array(
      'taxonomy_id' => 'QubitTaxonomy_term_relation',
      'id' => '<?php echo QubitTerm::TERM_RELATION_ASSOCIATIVE_ID."\n" ?>',
      'source_culture' => 'en',
      'name' => array('en' => 'associative')
    );

    return $this;
  }

  /**
   * Add 'Status' taxonomies and terms
   *
   * @return QubitMigrate107 this object
   */
  protected function addStatusTaxonomyTerms()
  {
    // Add taxonomies
    $this->data['QubitTaxonomy']['QubitTaxonomy_status_types'] = array(
      'source_culture' => 'en',
      'id' => '<?php echo QubitTaxonomy::STATUS_TYPE_ID."\n" ?>',
      'name' => array('en' => 'Status types')
    );

    $this->data['QubitTaxonomy']['QubitTaxonomy_publication_status'] = array(
      'source_culture' => 'en',
      'id' => '<?php echo QubitTaxonomy::PUBLICATION_STATUS_ID."\n" ?>',
      'name' => array('en' => 'Publication status')
    );

    // Add related terms
    $this->data['QubitTerm']['QubitTerm_status_type_publication'] = array(
      'taxonomy_id' => '<?php echo QubitTaxonomy::STATUS_TYPE_ID."\n" ?>',
      'id' => '<?php echo QubitTerm::STATUS_TYPE_PUBLICATION_ID."\n" ?>',
      'source_culture' => 'en',
      'name' => array('en' => 'publication')
    );

    $this->data['QubitTerm']['QubitTerm_publication_status_draft'] = array(
      'taxonomy_id' => '<?php echo QubitTaxonomy::PUBLICATION_STATUS_ID."\n" ?>',
      'id' => '<?php echo QubitTerm::PUBLICATION_STATUS_DRAFT_ID."\n" ?>',
      'source_culture' => 'en',
      'name' => array('de' => 'Entwurf', 'en' => 'draft', 'es' => 'Minuta', 'fr' => 'Ébauche', 'it' => 'Bozza', 'nl' => 'Klad', 'pt' => 'Preliminar', 'sl' => 'Osnutek')
    );

    $this->data['QubitTerm']['QubitTerm_publication_status_published'] = array(
      'taxonomy_id' => '<?php echo QubitTaxonomy::PUBLICATION_STATUS_ID."\n" ?>',
      'id' => '<?php echo QubitTerm::PUBLICATION_STATUS_PUBLISHED_ID."\n" ?>',
      'source_culture' => 'en',
      'name' => array('en' => 'published')
    );

    return $this;
  }

  /**
   * Add root taxonomy and term objects.
   *
   * @return QubitMigrate107 this object
   */
  protected function addRootTaxonomyTerms()
  {
    // Add root taxonomy
    $this->data['QubitTaxonomy']['QubitTaxonomy_root'] = array(
      'id' => '<?php echo QubitTaxonomy::ROOT_ID."\n" ?>',
    );

    // Add root term
    $this->data['QubitTerm']['QubitTerm_root'] = array(
      'taxonomy_id' => 'QubitTaxonomy_root',
      'id' => '<?php echo QubitTerm::ROOT_ID."\n" ?>',
    );

    // Assign root term as parent for orphan terms
    foreach ($this->data['QubitTerm'] as $key => $term)
    {
      if (!isset($term['parent_id']) && '<?php echo QubitTerm::ROOT_ID."\n" ?>' != $term['id'])
      {
        $this->data['QubitTerm'][$key]['parent_id'] = 'QubitTerm_root';
      }
    }

    return $this;
  }

  protected function copyUserRoleRelationToAclUserGroup()
  {
    foreach ($this->data['QubitUserRoleRelation'] as $userRoleRelation)
    {
      $role = $this->data['QubitRole'][$userRoleRelation['role_id']];

      if (1 === preg_match('/QubitRole::([A-Z_]+)/', $role['id'], $matches))
      {
        $groupId = '<?php echo QubitAclGroup::'.$matches[1].'."\n" ?>';
      }
      else
      {
        switch ($role['name'])
        {
          case 'administrator':
            $groupId = '<?php echo QubitAclGroup::ADMINISTRATOR_ID."\n" ?>';
            break;
          case 'editor':
            $groupId = '<?php echo QubitAclGroup::EDITOR_ID."\n" ?>';
            break;
          case 'contributor':
            $groupId = '<?php echo QubitAclGroup::CONTRIBUTOR_ID."\n" ?>';
            break;
          case 'translator':
            $groupId = '<?php echo QubitAclGroup::TRANSLATOR_ID."\n" ?>';
            break;
        }
      }

      $newKey = 'QubitAclUserGroup_'.rand();

      $this->data['QubitAclUserGroup'][$newKey] = array(
        'user_id' => $userRoleRelation['user_id'],
        'group_id' => $groupId
      );
    }
  }

  /**
   * Alter QubitEvent data
   *
   * @return QubitMigrate107 this object
   */
  protected function alterQubitEvents()
  {
    // Convert legacy dates (which represented years only) from e.g.
    // '1910-01-01' -> '1910-00-00'
    foreach ($this->data['QubitEvent'] as $key => $event)
    {
      if (isset($event['start_date']) && preg_match('/(\d{4})-01-01/', $event['start_date']))
      {
        $this->data['QubitEvent'][$key]['start_date'] = substr($event['start_date'], 0, 4).'-00-00';
      }

      if (isset($event['end_date']) && preg_match('/(\d{4})-01-01/', $event['end_date']))
      {
        $this->data['QubitEvent'][$key]['end_date'] = substr($event['end_date'], 0, 4).'-00-00';
      }
    }

    return $this;
  }

  /**
   * Alter QubitMenu data
   *
   * @return QubitMigrate107 this object
   */
  protected function alterQubitMenus()
  {
    // Remove "import/export" menu
    // difficult to just rename because both the mainmenu and the submenu share the 'import/export' name in 1.0.7
    // so, remove both and add a new 'import' mainmenu and 'import xml' sub-menu
    $importExportMenuKey = $this->getRowKey('QubitMenu', 'name', 'import/export');
    if ($importExportMenuKey)
    {
      $this->data['QubitMenu'] = QubitMigrate::cascadeDelete($this->data['QubitMenu'], $importExportMenuKey);
    }

    // Remove "upload" menu
    // some 1.0.8-dev sites had "upload" menus so add this remove just to be sure
    $uploadMenuKey = $this->getRowKey('QubitMenu', 'name', 'upload');
    if ($uploadMenuKey)
    {
      $this->data['QubitMenu'] = QubitMigrate::cascadeDelete($this->data['QubitMenu'], $uploadMenuKey);
    }

    // Add 'import' menu
    $importMenu = array(
      'QubitMenu_mainmenu_import' => array(
        'id' => '<?php echo QubitMenu::IMPORT_ID."\n" ?>',
        'parent_id' => '<?php echo QubitMenu::MAIN_MENU_ID."\n" ?>',
        'source_culture' => 'en',
        'name' => 'import',
        'path' => 'object/importSelect',
        'label' => array('en' => 'Import', 'es' => 'importar', 'fa' => 'وارد كردن', 'fr' => 'importer', 'it' => 'importa', 'nl' => 'import', 'pt' => 'importar', 'sl' => 'uvoz')
      )
    );

    // Attempt to insert 'import' menu before 'admin' menu
    if ($adminMenuKey = $this->getRowKey('QubitMenu', 'id', '<?php echo QubitMenu::ADMIN_ID."\n" ?>'))
    {
      QubitMigrate::insertBeforeNestedSet($this->data['QubitMenu'], $adminMenuKey, $importMenu);
    }
    else
    {
      array_merge($this->data['QubitMenu'], $importMenu);
    }

    // Add 'import xml' menu as child of 'import'
    $this->data['QubitMenu']['QubitMenu_mainmenu_import_xml'] = array(
      'parent_id' => 'QubitMenu_mainmenu_import',
      'source_culture' => 'en',
      'name' => 'import xml',
      'path' => 'object/importSelect',
      'label' => array('en' => 'xml')
    );

    // Add 'import digital objects' menu as child of 'import'
    $this->data['QubitMenu']['QubitMenu_mainmenu_import_digitalobjects'] = array(
        'parent_id' => 'QubitMenu_mainmenu_import',
        'source_culture' => 'en',
        'name' => 'import digital objects',
        'path' => 'digitalobject/multiFileUpload',
        'label' => array('en' => 'digital objects')
    );

    // Remove previous OAI harvester menu
    $harvesterKey = $this->getRowKey('QubitMenu', 'name', 'harvester');
    if ($harvesterKey)
    {
      $this->data['QubitMenu'] = QubitMigrate::cascadeDelete($this->data['QubitMenu'], $harvesterKey);
    }

    // Add 'import OAI' menu as child of 'import'
    $this->data['QubitMenu']['QubitMenu_mainmenu_import_oai'] = array(
        'parent_id' => 'QubitMenu_mainmenu_import',
        'source_culture' => 'en',
        'name' => 'import oai',
        'path' => 'oai/harvesterList',
        'label' => array('en' => 'oai')
    );

    // Add user and group sub-menus
    if (null !== ($userMenuKey = ($this->getRowKey('QubitMenu', 'name', 'users'))))
    {
      $this->data['QubitMenu']['QubitMenu_mainmenu_admin_users_users'] = array(
        'parent_id' => $userMenuKey,
        'source_culture' => 'en',
        'name' => 'users',
        'path' => 'user/list',
        'label' => array('en' => 'users')
      );
      $this->data['QubitMenu']['QubitMenu_mainmenu_admin_users_groups'] = array(
        'parent_id' => $userMenuKey,
        'source_culture' => 'en',
        'name' => 'groups',
        'path' => 'aclGroup/list',
        'label' => array('en' => 'groups')
      );
    }

    // Update path for home page
    if (null !== ($menuKey = ($this->getRowKey('QubitMenu', 'name', 'home'))))
    {
      $this->data['QubitMenu'][$menuKey]['path'] = 'staticpage/static?permalink=homepage';
    }

    // Pluralize English 'Add/Edit' menu options for Qubit
    $menuOption = $this->getRowKey('QubitMenu', 'label', array('en' => 'Information object'));
    if ($menuOption)
    {
      $this->data['QubitMenu'][$menuOption]['label']['en'] = 'Information objects';
    }
    $menuOption = $this->getRowKey('QubitMenu', 'label', array('en' => 'Person/organization'));
    if ($menuOption)
    {
      $this->data['QubitMenu'][$menuOption]['label']['en'] = 'Persons/organizations';
    }
    $menuOption = $this->getRowKey('QubitMenu', 'label', array('en' => 'Repository'));
    if ($menuOption)
    {
      $this->data['QubitMenu'][$menuOption]['label']['en'] = 'Repositories';
    }
    $menuOption = $this->getRowKey('QubitMenu', 'label', array('en' => 'Term'));
    if ($menuOption)
    {
      $this->data['QubitMenu'][$menuOption]['label']['en'] = 'Terms';
    }
    // Pluralize English 'Add/Edit' menu options for ICA-AtoM variations
    $menuOption = $this->getRowKey('QubitMenu', 'label', array('en' => 'Archival description'));
    if ($menuOption)
    {
      $this->data['QubitMenu'][$menuOption]['label']['en'] = 'Archival descriptions';
    }
    $menuOption = $this->getRowKey('QubitMenu', 'label', array('en' => 'Authority record'));
    if ($menuOption)
    {
      $this->data['QubitMenu'][$menuOption]['label']['en'] = 'Authority records';
    }
    $menuOption = $this->getRowKey('QubitMenu', 'label', array('en' => 'Archival institution'));
    if ($menuOption)
    {
      $this->data['QubitMenu'][$menuOption]['label']['en'] = 'Archival institutions';
    }
    // Pluralize English 'Add/Edit' menu options for DCB variations
    $menuOption = $this->getRowKey('QubitMenu', 'label', array('en' => 'resource'));
    if ($menuOption)
    {
      $this->data['QubitMenu'][$menuOption]['label']['en'] = 'resources';
    }
    $menuOption = $this->getRowKey('QubitMenu', 'label', array('en' => 'organization'));
    if ($menuOption)
    {
      $this->data['QubitMenu'][$menuOption]['label']['en'] = 'organizations';
    }

    return $this;
  }

  /**
   * Alter QubitProperty data
   *
   * @return QubitMigrate107 this object
   */
  protected function alterQubitProperties()
  {
    // Collate language & script properties into serialized array
    // and change name while were at it
    $tmp = array();
    foreach ($this->data['QubitProperty'] as $key => $value)
    {
      switch ($value['name'])
      {
        case 'information_object_language':
        case 'information_object_script':
        case 'language_of_information_object_description':
        case 'script_of_information_object_description':
          $tmp[$value['object_id']][$value['name']][] = $value['value'][$value['source_culture']];

          unset($this->data['QubitProperty'][$key]);
      }
    }

    foreach ($tmp as $id => $value)
    {
      foreach ($value as $name => $value)
      {
        $key = 'QubitProperty_'.rand();
        $this->data['QubitProperty'][$key] = array();
        $this->data['QubitProperty'][$key]['object_id'] = $id;

        switch ($name)
        {
          case 'information_object_language':
            $this->data['QubitProperty'][$key]['name'] = 'language';

            break;

          case 'information_object_script':
            $this->data['QubitProperty'][$key]['name'] = 'script';

            break;

          case 'language_of_information_object_description':
            $this->data['QubitProperty'][$key]['name'] = 'languageOfDescription';

            break;

          case 'script_of_information_object_description':
            $this->data['QubitProperty'][$key]['name'] = 'scriptOfDescription';

            break;

        }

        $this->data['QubitProperty'][$key]['value'] = serialize($value);
      }
    }

    // Move 'display_as_compound_object' property from information object to
    // digital object, and change name & scope while we're at it
    while ($key = $this->getRowKey('QubitProperty', 'name', 'display_as_compound_object'))
    {
      $this->data['QubitProperty'][$key]['name'] = 'displayAsCompound';

      // Get rid of 'scope', in this case it's repeating data we already have
      unset($this->data['QubitProperty'][$key]['scope']);

      if ($digitalObjectKey = $this->getRowKey('QubitDigitalObject', 'information_object_id', $this->data['QubitProperty'][$key]['object_id']))
      {
        $this->data['QubitProperty'][$key]['object_id'] = $digitalObjectKey;
      }
    }
  }

  /**
   * Alter QubitSetting data
   *
   * @return QubitMigrate107 this object
   */
  protected function alterQubitSettings()
  {
    // Update version number
    if ($settingVersionKey = $this->getRowKey('QubitSetting', 'name', 'version'))
    {
      foreach ($this->data['QubitSetting'][$settingVersionKey]['value'] as $culture => $value)
      {
        $this->data['QubitSetting'][$settingVersionKey]['value'][$culture] = str_replace('1.0.7', '1.0.8', $value);
      }
    }

    // Pluralize English UI Labels for Qubit
    $uiLabel = $this->getRowKey('QubitSetting', 'value', array('en' => 'information object'));
    if ($uiLabel)
    {
      $this->data['QubitSetting'][$uiLabel]['value']['en'] = 'information objects';
    }
    $uiLabel = $this->getRowKey('QubitSetting', 'value', array('en' => 'person/organization'));
    if ($uiLabel)
    {
      $this->data['QubitSetting'][$uiLabel]['value']['en'] = 'persons/organizations';
    }
    $uiLabel = $this->getRowKey('QubitSetting', 'value', array('en' => 'creator'));
    if ($uiLabel)
    {
      $this->data['QubitSetting'][$uiLabel]['value']['en'] = 'creators';
    }
    $uiLabel = $this->getRowKey('QubitSetting', 'value', array('en' => 'repository'));
    if ($uiLabel)
    {
      $this->data['QubitSetting'][$uiLabel]['value']['en'] = 'repositories';
    }
    $uiLabel = $this->getRowKey('QubitSetting', 'value', array('en' => 'term'));
    if ($uiLabel)
    {
      $this->data['QubitSetting'][$uiLabel]['value']['en'] = 'terms';
    }
    $uiLabel = $this->getRowKey('QubitSetting', 'value', array('en' => 'subject'));
    if ($uiLabel)
    {
      $this->data['QubitSetting'][$uiLabel]['value']['en'] = 'subjects';
    }
    $uiLabel = $this->getRowKey('QubitSetting', 'value', array('en' => 'collection'));
    if ($uiLabel)
    {
      $this->data['QubitSetting'][$uiLabel]['value']['en'] = 'collections';
    }
    $uiLabel = $this->getRowKey('QubitSetting', 'value', array('en' => 'place'));
    if ($uiLabel)
    {
      $this->data['QubitSetting'][$uiLabel]['value']['en'] = 'places';
    }
    $uiLabel = $this->getRowKey('QubitSetting', 'value', array('en' => 'name'));
    if ($uiLabel)
    {
      $this->data['QubitSetting'][$uiLabel]['value']['en'] = 'names';
    }
    $uiLabel = $this->getRowKey('QubitSetting', 'value', array('en' => 'digital object'));
    if ($uiLabel)
    {
      $this->data['QubitSetting'][$uiLabel]['value']['en'] = 'digital objects';
    }
    $uiLabel = $this->getRowKey('QubitSetting', 'value', array('en' => 'media type'));
    if ($uiLabel)
    {
      $this->data['QubitSetting'][$uiLabel]['value']['en'] = 'media types';
    }
    $uiLabel = $this->getRowKey('QubitSetting', 'value', array('en' => 'material type'));
    if ($uiLabel)
    {
      $this->data['QubitSetting'][$uiLabel]['value']['en'] = 'material types';
    }
    // Pluralize English UI Labels for ICA-AtoM variations
    $uiLabel = $this->getRowKey('QubitSetting', 'value', array('en' => 'archival description'));
    if ($uiLabel)
    {
      $this->data['QubitSetting'][$uiLabel]['value']['en'] = 'archival descriptions';
    }
    $uiLabel = $this->getRowKey('QubitSetting', 'value', array('en' => 'authority record'));
    if ($uiLabel)
    {
      $this->data['QubitSetting'][$uiLabel]['value']['en'] = 'authority records';
    }
    $uiLabel = $this->getRowKey('QubitSetting', 'value', array('en' => 'archival institution'));
    if ($uiLabel)
    {
      $this->data['QubitSetting'][$uiLabel]['value']['en'] = 'archival institutions';
    }
    // Pluralize English UI Labels for DCB variations
    $uiLabel = $this->getRowKey('QubitSetting', 'value', array('en' => 'resource'));
    if ($uiLabel)
    {
      $this->data['QubitSetting'][$uiLabel]['value']['en'] = 'resources';
    }
    $uiLabel = $this->getRowKey('QubitSetting', 'value', array('en' => 'organization'));
    if ($uiLabel)
    {
      $this->data['QubitSetting'][$uiLabel]['value']['en'] = 'organizations';
    }

    // Add default value for the SortTreeviewInformationObject setting
    $this->data['QubitSetting']['QubitSetting_sort_treeview'] = array(
      'name' => 'sort_treeview_informationobject',
      'editable' => 1,
      'deleteable' => 0,
      'value' => array('en' => 'none')
    );

    return $this;
  }

  /**
   * Alter QubitStaticPage data
   *
   * @return QubitMigrate107 this object
   */
  protected function alterQubitStaticPages()
  {
    // Update version number
    foreach ($this->data['QubitStaticPage'] as $key => $page)
    {
      if ($page['permalink'] == 'homepage' || $page['permalink'] == 'about')
      {
        array_walk($this->data['QubitStaticPage'][$key]['content'], create_function('&$x', '$x=str_replace(\'1.0.7\', \'1.0.8\', $x);'));
      }
    }

    return $this;
  }

  /**
   * Alter QubitStatus data
   *
   * @return QubitMigrate107 this object
   */
  protected function alterQubitStatus()
  {
    // Assign default status to information object root
    $this->data['QubitStatus']['QubitStatus_root_status'] = array(
      'object_id' => '<?php echo QubitInformationObject::ROOT_ID."\n" ?>',
      'type_id' => '<?php echo QubitTerm::STATUS_TYPE_PUBLICATION_ID."\n" ?>',
      'status_id' => '<?php echo QubitTerm::PUBLICATION_STATUS_DRAFT_ID."\n" ?>'
    );

    // Identify QubitInformationObject Root
    $rootKey = $this->getRowKey('QubitInformationObject', 'lft', '1');

    foreach ($this->data['QubitInformationObject'] as $key => $value)
    {
      // Assume all pre-existing information objects are published
      // Publication status is inherited by descendants so we only need to set it for
      // collection roots and orphans
      if ($value['parent_id'] == $rootKey)
      {
        $this->data['QubitStatus']['QubitStatus_publication_'.$key] = array(
          'object_id' => $key,
          'type_id' => '<?php echo QubitTerm::STATUS_TYPE_PUBLICATION_ID."\n" ?>',
          'status_id' => '<?php echo QubitTerm::PUBLICATION_STATUS_PUBLISHED_ID."\n" ?>'
        );
      }
    }

    return $this;
  }

  /**
   * Alter QubitTerms data
   *
   * @return QubitMigrate107 this object
   */
  protected function alterQubitTerms()
  {
    // Remove hyphen from English ('en') Level Of Description terms to make them EAD DTD compliant for XML import/export
    $termSubfondsKey = $this->getRowKey('QubitTerm', 'name', array('en' => 'Sub-fonds'));
    if ($termSubfondsKey)
    {
      $this->data['QubitTerm'][$termSubfondsKey]['name']['en'] = 'Subfonds';
    }
    $termSubseriesKey = $this->getRowKey('QubitTerm', 'name', array('en' => 'Sub-series'));
    if ($termSubseriesKey)
    {
      $this->data['QubitTerm'][$termSubseriesKey]['name']['en'] = 'Subseries';
    }

    // Add name access point term
    $this->data['QubitTerm']['QubitTerm_name_access_point'] = array(
      'taxonomy_id' => '<?php echo QubitTaxonomy::RELATION_TYPE_ID."\n" ?>',
      'parent_id' => '<?php echo QubitTerm::ROOT_ID."\n" ?>',
      'id' => '<?php echo QubitTerm::NAME_ACCESS_POINT_ID."\n" ?>',
      'source_culture' => 'en',
      'name' => array(
        'de' => 'Zugriffspunkt (Name)',
        'en' => 'name access points',
        'es' => 'nombre de los puntos de acceso',
        'fa' => 'دسترسي از طريق نام',
        'fr' => 'points d\'accès noms',
        'it' => 'punti di accesso per nome',
        'nl' => 'naam ontsluitingsterm',
        'pt' => 'ponto de acesso - nome',
        'sl' => 'ime vhodne točke'
      )
    );

    // Migrate existing name access points (event type = 'subject') to
    // QubitRelation table
    if ($termKey = $this->getTermKey('<?php echo QubitTerm::SUBJECT_ID."\n" ?>'))
    {
      while ($key = $this->getRowKey('QubitEvent', 'type_id', $termKey))
      {
        $event = $this->data['QubitEvent'][$key];

        if (isset($event['actor_id']))
        {
          // Get a random, unique key
          do
          {
            $newKey = rand();
          }
          while (isset($this->data['QubitRelation'][$newKey]));

          $this->data['QubitRelation']['QubitRelation_'.$newKey] = array(
            'subject_id' => $event['information_object_id'],
            'object_id' => $event['actor_id'],
            'type_id' => '<?php echo QubitTerm::NAME_ACCESS_POINT_ID."\n" ?>'
          );
        }

        // Delete QubitObjectTermRelations linked to QubitEvent
        while ($otrKey = $this->getRowKey('QubitObjectTermRelation', 'object_id', $key))
        {
          unset($this->data['QubitObjectTermRelation'][$otrKey]);
        }

        // Delete QubitEvent object
        unset($this->data['QubitEvent'][$key]);
      }
    }

    // Remove the "SUBJECT_ID" event type term
    if ($subjectTermKey = $this->getTermKey('<?php echo QubitTerm::SUBJECT_ID."\n" ?>'))
    {
      // Remove the related QubitNote defining the possessive declension
      while ($key = $this->getRowKey('QubitNote', 'object_id', $subjectTermKey))
      {
        unset($this->data['QubitNote'][$key]);
      }

      unset($this->data['QubitTerm'][$subjectTermKey]);
    }

    return $this;
  }

  /**
   * Sort information objects by lft value so that parent objects are inserted
   * before their children.
   *
   * @return QubitMigrate107 this object
   */
  protected function sortQubitInformationObjects()
  {
    QubitMigrate::sortByLft($this->data['QubitInformationObject']);

    return $this;
  }

  /**
   * Sort term objects with pre-defined IDs to start of array to prevent
   * pre-emptive assignment IDs by auto-increment
   *
   * @return QubitMigrate107 this object
   */
  protected function sortQubitTerms()
  {
    $qubitTermConstantIds = array(
      'ROOT_ID',
      //EventType taxonomy
      'CREATION_ID',
      'CUSTODY_ID',
      'PUBLICATION_ID',
      'CONTRIBUTION_ID',
      'COLLECTION_ID',
      'ACCUMULATION_ID',
      //NoteType taxonomy
      'TITLE_NOTE_ID',
      'PUBLICATION_NOTE_ID',
      'SOURCE_NOTE_ID',
      'SCOPE_NOTE_ID',
      'DISPLAY_NOTE_ID',
      'ARCHIVIST_NOTE_ID',
      'GENERAL_NOTE_ID',
      'OTHER_DESCRIPTIVE_DATA_ID',
      //CollectionType taxonomy
      'ARCHIVAL_MATERIAL_ID',
      'PUBLISHED_MATERIAL_ID',
      'ARTEFACT_MATERIAL_ID',
      //ActorEntityType taxonomy
      'CORPORATE_BODY_ID',
      'PERSON_ID',
      'FAMILY_ID',
      //OtherNameType taxonomy
      'FAMILY_NAME_FIRST_NAME_ID',
      //MediaType taxonomy
      'AUDIO_ID',
      'IMAGE_ID',
      'TEXT_ID',
      'VIDEO_ID',
      'OTHER_ID',
      //Digital Object Usage taxonomy
      'MASTER_ID',
      'REFERENCE_ID',
      'THUMBNAIL_ID',
      'COMPOUND_ID',
      //Physical Object Type taxonomy
      'LOCATION_ID',
      'CONTAINER_ID',
      'ARTEFACT_ID',
      //Relation Type taxonomy
      'HAS_PHYSICAL_OBJECT_ID',
      //Actor name type taxonomy
      'PARALLEL_FORM_OF_NAME_ID',
      'OTHER_FORM_OF_NAME_ID',
      //Actor relation type taxonomy
      'HIERARCHICAL_RELATION_ID',
      'TEMPORAL_RELATION_ID',
      'FAMILY_RELATION_ID',
      'ASSOCIATIVE_RELATION_ID',
      //Relation NOTE type taxonomy
      'RELATION_NOTE_DESCRIPTION_ID',
      'RELATION_NOTE_DATE_DISPLAY_ID',
      //Term relation taxonomy
      'TERM_RELATION_EQUIVALENCE_ID',
      'TERM_RELATION_ASSOCIATIVE_ID',
      //Status types taxonomy
      'STATUS_TYPE_PUBLICATION_ID',
      // Publication status taxonomy
      'PUBLICATION_STATUS_DRAFT_ID',
      'PUBLICATION_STATUS_PUBLISHED_ID',
      // Name access point
      'NAME_ACCESS_POINT_ID'
    );

    // Restack array with Constant values at top
    $qubitTermArray = $this->data['QubitTerm'];
    foreach ($qubitTermConstantIds as $key => $constantName)
    {
      foreach ($qubitTermArray as $key => $term)
      {
        if ($term['id'] == '<?php echo QubitTerm::'.$constantName.'."\n" ?>')
        {
          $newTermArray[$key] = $term;
          unset($qubitTermArray[$key]);
          break;
        }
      }
    }

    // Sort remainder of array by lft values
    QubitMigrate::sortByLft($qubitTermArray);

    // Append remaining (variable id) terms to the end of the new array
    foreach ($qubitTermArray as $key => $term)
    {
      $newTermArray[$key] = $term;
    }

    $this->data['QubitTerm'] = $newTermArray;

    return $this;
  }

  /**
   * Sort ORM classes to avoid foreign key constraint failures on data load
   *
   * @return QubitMigrate107 this object
   */
  protected function sortClasses()
  {
    $ormSortOrder = array(
      'QubitTaxonomy',
      'QubitTerm',
      'QubitSetting',
      'QubitStaticPage',
      'QubitActor',
      'QubitUser',
      'QubitRole',
      'QubitUserRoleRelation',
      'QubitRepository',
      'QubitContactInformation',
      'QubitInformationObject',
      'QubitDigitalObject',
      'QubitPhysicalObject',
      'QubitEvent',
      'QubitObjectTermRelation',
      'QubitRelation',
      'QubitProperty',
      'QubitNote',
      'QubitAclGroup',
      'QubitAclUserGroup',
      'QubitAclAction',
      'QubitAclPermission'
    );

    $originalData = $this->data;

    foreach ($ormSortOrder as $i => $className)
    {
      if (isset($originalData[$className]))
      {
        $sortedData[$className] = $originalData[$className];
        unset($originalData[$className]);
      }
    }

    // If their are classes in the original data that are not listed in the
    // ormSortOrder array then tack them on to the end of the sorted data
    if (count($originalData))
    {
      foreach ($originalData as $className => $classData)
      {
        $sortedData[$className] = $classData;
      }
    }

    $this->data = $sortedData;

    // Now put QubitInformationObject ROOT id in first!
    /*
    $infoObjectRootKey = $this->getRowKey('QubitInformationObject', 'lft', '1');

    $this->data['QubitInformationObject'][$infoObjectRootKey]['id'] = '<?php echo QubitInformationObject::ROOT_ID."\n" ?>';

    $this->data = array_merge(
      array('QubitObject' => array('QubitObject_2' => array('id' => '2'))),
      $this->data
    );
     */

    return $this;
  }
}
