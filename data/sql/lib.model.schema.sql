
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- q_object
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `q_object`;


CREATE TABLE `q_object`
(
	`class_name` VARCHAR(255),
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- q_information_object
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `q_information_object`;


CREATE TABLE `q_information_object`
(
	`id` INTEGER  NOT NULL,
	`identifier` VARCHAR(255),
	`level_of_description_id` INTEGER,
	`collection_type_id` INTEGER,
	`repository_id` INTEGER,
	`parent_id` INTEGER,
	`description_status_id` INTEGER,
	`description_detail_id` INTEGER,
	`description_identifier` VARCHAR(255),
	`lft` INTEGER  NOT NULL,
	`rgt` INTEGER  NOT NULL,
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	`source_culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`),
	CONSTRAINT `q_information_object_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `q_object` (`id`)
		ON DELETE CASCADE,
	INDEX `q_information_object_FI_2` (`level_of_description_id`),
	CONSTRAINT `q_information_object_FK_2`
		FOREIGN KEY (`level_of_description_id`)
		REFERENCES `q_term` (`id`),
	INDEX `q_information_object_FI_3` (`collection_type_id`),
	CONSTRAINT `q_information_object_FK_3`
		FOREIGN KEY (`collection_type_id`)
		REFERENCES `q_term` (`id`),
	INDEX `q_information_object_FI_4` (`repository_id`),
	CONSTRAINT `q_information_object_FK_4`
		FOREIGN KEY (`repository_id`)
		REFERENCES `q_repository` (`id`),
	INDEX `q_information_object_FI_5` (`parent_id`),
	CONSTRAINT `q_information_object_FK_5`
		FOREIGN KEY (`parent_id`)
		REFERENCES `q_information_object` (`id`),
	INDEX `q_information_object_FI_6` (`description_status_id`),
	CONSTRAINT `q_information_object_FK_6`
		FOREIGN KEY (`description_status_id`)
		REFERENCES `q_term` (`id`),
	INDEX `q_information_object_FI_7` (`description_detail_id`),
	CONSTRAINT `q_information_object_FK_7`
		FOREIGN KEY (`description_detail_id`)
		REFERENCES `q_term` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- q_information_object_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `q_information_object_i18n`;


CREATE TABLE `q_information_object_i18n`
(
	`title` VARCHAR(255),
	`alternate_title` VARCHAR(255),
	`edition` VARCHAR(255),
	`extent_and_medium` TEXT,
	`archival_history` TEXT,
	`acquisition` TEXT,
	`scope_and_content` TEXT,
	`appraisal` TEXT,
	`accruals` TEXT,
	`arrangement` TEXT,
	`access_conditions` TEXT,
	`reproduction_conditions` TEXT,
	`physical_characteristics` TEXT,
	`finding_aids` TEXT,
	`location_of_originals` TEXT,
	`location_of_copies` TEXT,
	`related_units_of_description` TEXT,
	`institution_responsible_identifier` VARCHAR(255),
	`rules` TEXT,
	`sources` TEXT,
	`revision_history` TEXT,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `q_information_object_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `q_information_object` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- q_object_term_relation
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `q_object_term_relation`;


CREATE TABLE `q_object_term_relation`
(
	`id` INTEGER  NOT NULL,
	`object_id` INTEGER  NOT NULL,
	`term_id` INTEGER  NOT NULL,
	`start_date` DATE,
	`end_date` DATE,
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	PRIMARY KEY (`id`),
	CONSTRAINT `q_object_term_relation_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `q_object` (`id`)
		ON DELETE CASCADE,
	INDEX `q_object_term_relation_FI_2` (`object_id`),
	CONSTRAINT `q_object_term_relation_FK_2`
		FOREIGN KEY (`object_id`)
		REFERENCES `q_object` (`id`)
		ON DELETE CASCADE,
	INDEX `q_object_term_relation_FI_3` (`term_id`),
	CONSTRAINT `q_object_term_relation_FK_3`
		FOREIGN KEY (`term_id`)
		REFERENCES `q_term` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- q_property
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `q_property`;


CREATE TABLE `q_property`
(
	`object_id` INTEGER  NOT NULL,
	`scope` VARCHAR(255),
	`name` VARCHAR(255),
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	`source_culture` VARCHAR(7)  NOT NULL,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`),
	INDEX `q_property_FI_1` (`object_id`),
	CONSTRAINT `q_property_FK_1`
		FOREIGN KEY (`object_id`)
		REFERENCES `q_object` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- q_property_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `q_property_i18n`;


CREATE TABLE `q_property_i18n`
(
	`value` VARCHAR(255),
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `q_property_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `q_property` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- q_relation
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `q_relation`;


CREATE TABLE `q_relation`
(
	`id` INTEGER  NOT NULL,
	`subject_id` INTEGER  NOT NULL,
	`object_id` INTEGER  NOT NULL,
	`type_id` INTEGER,
	`start_date` DATE,
	`end_date` DATE,
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	PRIMARY KEY (`id`),
	CONSTRAINT `q_relation_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `q_object` (`id`)
		ON DELETE CASCADE,
	INDEX `q_relation_FI_2` (`subject_id`),
	CONSTRAINT `q_relation_FK_2`
		FOREIGN KEY (`subject_id`)
		REFERENCES `q_object` (`id`),
	INDEX `q_relation_FI_3` (`object_id`),
	CONSTRAINT `q_relation_FK_3`
		FOREIGN KEY (`object_id`)
		REFERENCES `q_object` (`id`),
	INDEX `q_relation_FI_4` (`type_id`),
	CONSTRAINT `q_relation_FK_4`
		FOREIGN KEY (`type_id`)
		REFERENCES `q_term` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- q_note
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `q_note`;


CREATE TABLE `q_note`
(
	`object_id` INTEGER  NOT NULL,
	`type_id` INTEGER,
	`scope` VARCHAR(255),
	`user_id` INTEGER,
	`parent_id` INTEGER,
	`lft` INTEGER  NOT NULL,
	`rgt` INTEGER  NOT NULL,
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	`source_culture` VARCHAR(7)  NOT NULL,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`),
	INDEX `q_note_FI_1` (`object_id`),
	CONSTRAINT `q_note_FK_1`
		FOREIGN KEY (`object_id`)
		REFERENCES `q_object` (`id`)
		ON DELETE CASCADE,
	INDEX `q_note_FI_2` (`type_id`),
	CONSTRAINT `q_note_FK_2`
		FOREIGN KEY (`type_id`)
		REFERENCES `q_term` (`id`),
	INDEX `q_note_FI_3` (`user_id`),
	CONSTRAINT `q_note_FK_3`
		FOREIGN KEY (`user_id`)
		REFERENCES `q_user` (`id`),
	INDEX `q_note_FI_4` (`parent_id`),
	CONSTRAINT `q_note_FK_4`
		FOREIGN KEY (`parent_id`)
		REFERENCES `q_note` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- q_note_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `q_note_i18n`;


CREATE TABLE `q_note_i18n`
(
	`content` TEXT,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `q_note_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `q_note` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- q_digital_object
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `q_digital_object`;


CREATE TABLE `q_digital_object`
(
	`id` INTEGER  NOT NULL,
	`information_object_id` INTEGER,
	`usage_id` INTEGER,
	`mime_type` VARCHAR(50),
	`media_type_id` INTEGER,
	`name` VARCHAR(255),
	`path` VARCHAR(1000),
	`sequence` INTEGER,
	`byte_size` INTEGER,
	`checksum` VARCHAR(255),
	`checksum_type_id` INTEGER,
	`parent_id` INTEGER,
	`lft` INTEGER  NOT NULL,
	`rgt` INTEGER  NOT NULL,
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	PRIMARY KEY (`id`),
	CONSTRAINT `q_digital_object_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `q_object` (`id`)
		ON DELETE CASCADE,
	INDEX `q_digital_object_FI_2` (`information_object_id`),
	CONSTRAINT `q_digital_object_FK_2`
		FOREIGN KEY (`information_object_id`)
		REFERENCES `q_information_object` (`id`),
	INDEX `q_digital_object_FI_3` (`usage_id`),
	CONSTRAINT `q_digital_object_FK_3`
		FOREIGN KEY (`usage_id`)
		REFERENCES `q_term` (`id`),
	INDEX `q_digital_object_FI_4` (`media_type_id`),
	CONSTRAINT `q_digital_object_FK_4`
		FOREIGN KEY (`media_type_id`)
		REFERENCES `q_term` (`id`),
	INDEX `q_digital_object_FI_5` (`checksum_type_id`),
	CONSTRAINT `q_digital_object_FK_5`
		FOREIGN KEY (`checksum_type_id`)
		REFERENCES `q_term` (`id`),
	INDEX `q_digital_object_FI_6` (`parent_id`),
	CONSTRAINT `q_digital_object_FK_6`
		FOREIGN KEY (`parent_id`)
		REFERENCES `q_digital_object` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- q_physical_object
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `q_physical_object`;


CREATE TABLE `q_physical_object`
(
	`id` INTEGER  NOT NULL,
	`type_id` INTEGER,
	`parent_id` INTEGER,
	`lft` INTEGER  NOT NULL,
	`rgt` INTEGER  NOT NULL,
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	`source_culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`),
	CONSTRAINT `q_physical_object_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `q_object` (`id`)
		ON DELETE CASCADE,
	INDEX `q_physical_object_FI_2` (`type_id`),
	CONSTRAINT `q_physical_object_FK_2`
		FOREIGN KEY (`type_id`)
		REFERENCES `q_term` (`id`),
	INDEX `q_physical_object_FI_3` (`parent_id`),
	CONSTRAINT `q_physical_object_FK_3`
		FOREIGN KEY (`parent_id`)
		REFERENCES `q_physical_object` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- q_physical_object_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `q_physical_object_i18n`;


CREATE TABLE `q_physical_object_i18n`
(
	`name` VARCHAR(255),
	`description` TEXT,
	`location` TEXT,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `q_physical_object_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `q_physical_object` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- q_actor
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `q_actor`;


CREATE TABLE `q_actor`
(
	`id` INTEGER  NOT NULL,
	`corporate_body_identifiers` VARCHAR(255),
	`entity_type_id` INTEGER,
	`description_status_id` INTEGER,
	`description_detail_id` INTEGER,
	`description_identifier` VARCHAR(255),
	`parent_id` INTEGER,
	`lft` INTEGER,
	`rgt` INTEGER,
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	`source_culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`),
	CONSTRAINT `q_actor_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `q_object` (`id`)
		ON DELETE CASCADE,
	INDEX `q_actor_FI_2` (`entity_type_id`),
	CONSTRAINT `q_actor_FK_2`
		FOREIGN KEY (`entity_type_id`)
		REFERENCES `q_term` (`id`),
	INDEX `q_actor_FI_3` (`description_status_id`),
	CONSTRAINT `q_actor_FK_3`
		FOREIGN KEY (`description_status_id`)
		REFERENCES `q_term` (`id`),
	INDEX `q_actor_FI_4` (`description_detail_id`),
	CONSTRAINT `q_actor_FK_4`
		FOREIGN KEY (`description_detail_id`)
		REFERENCES `q_term` (`id`),
	INDEX `q_actor_FI_5` (`parent_id`),
	CONSTRAINT `q_actor_FK_5`
		FOREIGN KEY (`parent_id`)
		REFERENCES `q_actor` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- q_actor_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `q_actor_i18n`;


CREATE TABLE `q_actor_i18n`
(
	`authorized_form_of_name` VARCHAR(255)  NOT NULL,
	`dates_of_existence` VARCHAR(255),
	`history` TEXT,
	`places` TEXT,
	`legal_status` TEXT,
	`functions` TEXT,
	`mandates` TEXT,
	`internal_structures` TEXT,
	`general_context` TEXT,
	`institution_responsible_identifier` VARCHAR(255),
	`rules` TEXT,
	`sources` TEXT,
	`revision_history` TEXT,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `q_actor_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `q_actor` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- q_repository
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `q_repository`;


CREATE TABLE `q_repository`
(
	`id` INTEGER  NOT NULL,
	`identifier` VARCHAR(255),
	`type_id` INTEGER,
	`desc_status_id` INTEGER,
	`desc_detail_id` INTEGER,
	`desc_identifier` VARCHAR(255),
	`source_culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`),
	CONSTRAINT `q_repository_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `q_actor` (`id`)
		ON DELETE CASCADE,
	INDEX `q_repository_FI_2` (`type_id`),
	CONSTRAINT `q_repository_FK_2`
		FOREIGN KEY (`type_id`)
		REFERENCES `q_term` (`id`),
	INDEX `q_repository_FI_3` (`desc_status_id`),
	CONSTRAINT `q_repository_FK_3`
		FOREIGN KEY (`desc_status_id`)
		REFERENCES `q_term` (`id`),
	INDEX `q_repository_FI_4` (`desc_detail_id`),
	CONSTRAINT `q_repository_FK_4`
		FOREIGN KEY (`desc_detail_id`)
		REFERENCES `q_term` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- q_repository_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `q_repository_i18n`;


CREATE TABLE `q_repository_i18n`
(
	`geocultural_context` TEXT,
	`collecting_policies` TEXT,
	`buildings` TEXT,
	`holdings` TEXT,
	`finding_aids` TEXT,
	`opening_times` TEXT,
	`access_conditions` TEXT,
	`disabled_access` TEXT,
	`research_services` TEXT,
	`reproduction_services` TEXT,
	`public_facilities` TEXT,
	`desc_institution_identifier` VARCHAR(255),
	`desc_rules` TEXT,
	`desc_sources` TEXT,
	`desc_revision_history` TEXT,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `q_repository_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `q_repository` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- q_actor_name
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `q_actor_name`;


CREATE TABLE `q_actor_name`
(
	`actor_id` INTEGER  NOT NULL,
	`type_id` INTEGER,
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	`source_culture` VARCHAR(7)  NOT NULL,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`),
	INDEX `q_actor_name_FI_1` (`actor_id`),
	CONSTRAINT `q_actor_name_FK_1`
		FOREIGN KEY (`actor_id`)
		REFERENCES `q_actor` (`id`)
		ON DELETE CASCADE,
	INDEX `q_actor_name_FI_2` (`type_id`),
	CONSTRAINT `q_actor_name_FK_2`
		FOREIGN KEY (`type_id`)
		REFERENCES `q_term` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- q_actor_name_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `q_actor_name_i18n`;


CREATE TABLE `q_actor_name_i18n`
(
	`name` VARCHAR(255),
	`note` VARCHAR(255),
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `q_actor_name_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `q_actor_name` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- q_contact_information
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `q_contact_information`;


CREATE TABLE `q_contact_information`
(
	`actor_id` INTEGER  NOT NULL,
	`primary_contact` INTEGER,
	`contact_person` VARCHAR(255),
	`street_address` TEXT,
	`website` VARCHAR(255),
	`email` VARCHAR(255),
	`telephone` VARCHAR(255),
	`fax` VARCHAR(255),
	`postal_code` VARCHAR(255),
	`country_code` VARCHAR(255),
	`longtitude` FLOAT,
	`latitude` FLOAT,
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	`source_culture` VARCHAR(7)  NOT NULL,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`),
	INDEX `q_contact_information_FI_1` (`actor_id`),
	CONSTRAINT `q_contact_information_FK_1`
		FOREIGN KEY (`actor_id`)
		REFERENCES `q_actor` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- q_contact_information_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `q_contact_information_i18n`;


CREATE TABLE `q_contact_information_i18n`
(
	`contact_type` VARCHAR(255),
	`city` VARCHAR(255),
	`region` VARCHAR(255),
	`note` TEXT,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `q_contact_information_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `q_contact_information` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- q_place
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `q_place`;


CREATE TABLE `q_place`
(
	`id` INTEGER  NOT NULL,
	`country_id` INTEGER,
	`type_id` INTEGER,
	`longtitude` FLOAT,
	`latitude` FLOAT,
	`altitude` FLOAT,
	`source_culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`),
	CONSTRAINT `q_place_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `q_term` (`id`)
		ON DELETE CASCADE,
	INDEX `q_place_FI_2` (`country_id`),
	CONSTRAINT `q_place_FK_2`
		FOREIGN KEY (`country_id`)
		REFERENCES `q_term` (`id`),
	INDEX `q_place_FI_3` (`type_id`),
	CONSTRAINT `q_place_FK_3`
		FOREIGN KEY (`type_id`)
		REFERENCES `q_term` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- q_place_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `q_place_i18n`;


CREATE TABLE `q_place_i18n`
(
	`street_address` TEXT,
	`city` VARCHAR(255),
	`region` VARCHAR(255),
	`postal_code` VARCHAR(255),
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `q_place_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `q_place` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- q_map
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `q_map`;


CREATE TABLE `q_map`
(
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	`source_culture` VARCHAR(7)  NOT NULL,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- q_map_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `q_map_i18n`;


CREATE TABLE `q_map_i18n`
(
	`title` VARCHAR(255),
	`description` TEXT,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `q_map_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `q_map` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- q_place_map_relation
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `q_place_map_relation`;


CREATE TABLE `q_place_map_relation`
(
	`id` INTEGER  NOT NULL,
	`place_id` INTEGER  NOT NULL,
	`map_id` INTEGER  NOT NULL,
	`map_icon_image_id` INTEGER,
	`map_icon_description` TEXT,
	`type_id` INTEGER,
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	PRIMARY KEY (`id`),
	CONSTRAINT `q_place_map_relation_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `q_object` (`id`)
		ON DELETE CASCADE,
	INDEX `q_place_map_relation_FI_2` (`place_id`),
	CONSTRAINT `q_place_map_relation_FK_2`
		FOREIGN KEY (`place_id`)
		REFERENCES `q_place` (`id`)
		ON DELETE CASCADE,
	INDEX `q_place_map_relation_FI_3` (`map_id`),
	CONSTRAINT `q_place_map_relation_FK_3`
		FOREIGN KEY (`map_id`)
		REFERENCES `q_map` (`id`)
		ON DELETE CASCADE,
	INDEX `q_place_map_relation_FI_4` (`map_icon_image_id`),
	CONSTRAINT `q_place_map_relation_FK_4`
		FOREIGN KEY (`map_icon_image_id`)
		REFERENCES `q_digital_object` (`id`),
	INDEX `q_place_map_relation_FI_5` (`type_id`),
	CONSTRAINT `q_place_map_relation_FK_5`
		FOREIGN KEY (`type_id`)
		REFERENCES `q_term` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- q_term
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `q_term`;


CREATE TABLE `q_term`
(
	`id` INTEGER  NOT NULL,
	`taxonomy_id` INTEGER  NOT NULL,
	`code` VARCHAR(255),
	`parent_id` INTEGER,
	`lft` INTEGER  NOT NULL,
	`rgt` INTEGER  NOT NULL,
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	`source_culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`),
	CONSTRAINT `q_term_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `q_object` (`id`)
		ON DELETE CASCADE,
	INDEX `q_term_FI_2` (`taxonomy_id`),
	CONSTRAINT `q_term_FK_2`
		FOREIGN KEY (`taxonomy_id`)
		REFERENCES `q_taxonomy` (`id`)
		ON DELETE CASCADE,
	INDEX `q_term_FI_3` (`parent_id`),
	CONSTRAINT `q_term_FK_3`
		FOREIGN KEY (`parent_id`)
		REFERENCES `q_term` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- q_term_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `q_term_i18n`;


CREATE TABLE `q_term_i18n`
(
	`name` VARCHAR(255),
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `q_term_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `q_term` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- q_taxonomy
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `q_taxonomy`;


CREATE TABLE `q_taxonomy`
(
	`usage` VARCHAR(255),
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	`source_culture` VARCHAR(7)  NOT NULL,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- q_taxonomy_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `q_taxonomy_i18n`;


CREATE TABLE `q_taxonomy_i18n`
(
	`name` VARCHAR(255),
	`note` TEXT,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `q_taxonomy_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `q_taxonomy` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- q_event
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `q_event`;


CREATE TABLE `q_event`
(
	`id` INTEGER  NOT NULL,
	`start_date` DATE,
	`start_time` TIME,
	`end_date` DATE,
	`end_time` TIME,
	`type_id` INTEGER,
	`information_object_id` INTEGER,
	`actor_id` INTEGER,
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	`source_culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`),
	CONSTRAINT `q_event_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `q_object` (`id`)
		ON DELETE CASCADE,
	INDEX `q_event_FI_2` (`type_id`),
	CONSTRAINT `q_event_FK_2`
		FOREIGN KEY (`type_id`)
		REFERENCES `q_term` (`id`),
	INDEX `q_event_FI_3` (`information_object_id`),
	CONSTRAINT `q_event_FK_3`
		FOREIGN KEY (`information_object_id`)
		REFERENCES `q_information_object` (`id`)
		ON DELETE CASCADE,
	INDEX `q_event_FI_4` (`actor_id`),
	CONSTRAINT `q_event_FK_4`
		FOREIGN KEY (`actor_id`)
		REFERENCES `q_actor` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- q_event_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `q_event_i18n`;


CREATE TABLE `q_event_i18n`
(
	`name` VARCHAR(255),
	`description` TEXT,
	`date_display` VARCHAR(255),
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `q_event_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `q_event` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- q_system_event
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `q_system_event`;


CREATE TABLE `q_system_event`
(
	`type_id` INTEGER,
	`object_class` VARCHAR(255),
	`object_id` INTEGER,
	`pre_event_snapshot` TEXT,
	`post_event_snapshot` TEXT,
	`date` DATETIME,
	`user_id` INTEGER,
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`),
	INDEX `q_system_event_FI_1` (`type_id`),
	CONSTRAINT `q_system_event_FK_1`
		FOREIGN KEY (`type_id`)
		REFERENCES `q_term` (`id`),
	INDEX `q_system_event_FI_2` (`user_id`),
	CONSTRAINT `q_system_event_FK_2`
		FOREIGN KEY (`user_id`)
		REFERENCES `q_user` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- q_historical_event
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `q_historical_event`;


CREATE TABLE `q_historical_event`
(
	`id` INTEGER  NOT NULL,
	`type_id` INTEGER,
	`start_date` DATE,
	`start_time` TIME,
	`end_date` DATE,
	`end_time` TIME,
	PRIMARY KEY (`id`),
	CONSTRAINT `q_historical_event_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `q_term` (`id`)
		ON DELETE CASCADE,
	INDEX `q_historical_event_FI_2` (`type_id`),
	CONSTRAINT `q_historical_event_FK_2`
		FOREIGN KEY (`type_id`)
		REFERENCES `q_term` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- q_function
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `q_function`;


CREATE TABLE `q_function`
(
	`id` INTEGER  NOT NULL,
	`type_id` INTEGER,
	`description_status_id` INTEGER,
	`description_level_id` INTEGER,
	`description_identifier` VARCHAR(255),
	`source_culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`),
	CONSTRAINT `q_function_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `q_term` (`id`)
		ON DELETE CASCADE,
	INDEX `q_function_FI_2` (`type_id`),
	CONSTRAINT `q_function_FK_2`
		FOREIGN KEY (`type_id`)
		REFERENCES `q_term` (`id`),
	INDEX `q_function_FI_3` (`description_status_id`),
	CONSTRAINT `q_function_FK_3`
		FOREIGN KEY (`description_status_id`)
		REFERENCES `q_term` (`id`),
	INDEX `q_function_FI_4` (`description_level_id`),
	CONSTRAINT `q_function_FK_4`
		FOREIGN KEY (`description_level_id`)
		REFERENCES `q_term` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- q_function_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `q_function_i18n`;


CREATE TABLE `q_function_i18n`
(
	`classification` TEXT,
	`domain` TEXT,
	`dates` TEXT,
	`history` TEXT,
	`legislation` TEXT,
	`general_context` TEXT,
	`institution_responsible_identifier` VARCHAR(255),
	`rules` TEXT,
	`sources` TEXT,
	`revision_history` TEXT,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `q_function_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `q_function` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- q_rights
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `q_rights`;


CREATE TABLE `q_rights`
(
	`object_id` INTEGER  NOT NULL,
	`permission_id` INTEGER,
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	`source_culture` VARCHAR(7)  NOT NULL,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`),
	INDEX `q_rights_FI_1` (`object_id`),
	CONSTRAINT `q_rights_FK_1`
		FOREIGN KEY (`object_id`)
		REFERENCES `q_object` (`id`)
		ON DELETE CASCADE,
	INDEX `q_rights_FI_2` (`permission_id`),
	CONSTRAINT `q_rights_FK_2`
		FOREIGN KEY (`permission_id`)
		REFERENCES `q_term` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- q_rights_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `q_rights_i18n`;


CREATE TABLE `q_rights_i18n`
(
	`description` TEXT,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `q_rights_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `q_rights` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- q_rights_term_relation
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `q_rights_term_relation`;


CREATE TABLE `q_rights_term_relation`
(
	`rights_id` INTEGER  NOT NULL,
	`term_id` INTEGER  NOT NULL,
	`type_id` INTEGER,
	`description` TEXT,
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`),
	INDEX `q_rights_term_relation_FI_1` (`rights_id`),
	CONSTRAINT `q_rights_term_relation_FK_1`
		FOREIGN KEY (`rights_id`)
		REFERENCES `q_rights` (`id`)
		ON DELETE CASCADE,
	INDEX `q_rights_term_relation_FI_2` (`term_id`),
	CONSTRAINT `q_rights_term_relation_FK_2`
		FOREIGN KEY (`term_id`)
		REFERENCES `q_term` (`id`)
		ON DELETE CASCADE,
	INDEX `q_rights_term_relation_FI_3` (`type_id`),
	CONSTRAINT `q_rights_term_relation_FK_3`
		FOREIGN KEY (`type_id`)
		REFERENCES `q_term` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- q_rights_actor_relation
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `q_rights_actor_relation`;


CREATE TABLE `q_rights_actor_relation`
(
	`id` INTEGER  NOT NULL,
	`rights_id` INTEGER  NOT NULL,
	`actor_id` INTEGER  NOT NULL,
	`type_id` INTEGER,
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	PRIMARY KEY (`id`),
	CONSTRAINT `q_rights_actor_relation_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `q_object` (`id`)
		ON DELETE CASCADE,
	INDEX `q_rights_actor_relation_FI_2` (`rights_id`),
	CONSTRAINT `q_rights_actor_relation_FK_2`
		FOREIGN KEY (`rights_id`)
		REFERENCES `q_rights` (`id`)
		ON DELETE CASCADE,
	INDEX `q_rights_actor_relation_FI_3` (`actor_id`),
	CONSTRAINT `q_rights_actor_relation_FK_3`
		FOREIGN KEY (`actor_id`)
		REFERENCES `q_actor` (`id`)
		ON DELETE CASCADE,
	INDEX `q_rights_actor_relation_FI_4` (`type_id`),
	CONSTRAINT `q_rights_actor_relation_FK_4`
		FOREIGN KEY (`type_id`)
		REFERENCES `q_term` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- q_menu
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `q_menu`;


CREATE TABLE `q_menu`
(
	`url` VARCHAR(255),
	`parent_id` INTEGER,
	`lft` INTEGER,
	`rgt` INTEGER,
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	`source_culture` VARCHAR(7)  NOT NULL,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- q_menu_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `q_menu_i18n`;


CREATE TABLE `q_menu_i18n`
(
	`name` VARCHAR(255),
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `q_menu_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `q_menu` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- q_static_page
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `q_static_page`;


CREATE TABLE `q_static_page`
(
	`id` INTEGER  NOT NULL,
	`permalink` VARCHAR(255),
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	`source_culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`),
	CONSTRAINT `q_static_page_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `q_object` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- q_static_page_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `q_static_page_i18n`;


CREATE TABLE `q_static_page_i18n`
(
	`title` VARCHAR(255),
	`content` TEXT,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `q_static_page_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `q_static_page` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- q_user
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `q_user`;


CREATE TABLE `q_user`
(
	`id` INTEGER  NOT NULL,
	`username` VARCHAR(255),
	`email` VARCHAR(255),
	`sha1_password` VARCHAR(255),
	`salt` VARCHAR(255),
	PRIMARY KEY (`id`),
	CONSTRAINT `q_user_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `q_actor` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- q_role
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `q_role`;


CREATE TABLE `q_role`
(
	`name` VARCHAR(255),
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- q_user_role_relation
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `q_user_role_relation`;


CREATE TABLE `q_user_role_relation`
(
	`user_id` INTEGER  NOT NULL,
	`role_id` INTEGER  NOT NULL,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`),
	INDEX `q_user_role_relation_FI_1` (`user_id`),
	CONSTRAINT `q_user_role_relation_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `q_user` (`id`)
		ON DELETE CASCADE,
	INDEX `q_user_role_relation_FI_2` (`role_id`),
	CONSTRAINT `q_user_role_relation_FK_2`
		FOREIGN KEY (`role_id`)
		REFERENCES `q_role` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- q_permission
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `q_permission`;


CREATE TABLE `q_permission`
(
	`module` VARCHAR(255),
	`action` VARCHAR(255),
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- q_role_permission_relation
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `q_role_permission_relation`;


CREATE TABLE `q_role_permission_relation`
(
	`role_id` INTEGER  NOT NULL,
	`permission_id` INTEGER  NOT NULL,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`),
	INDEX `q_role_permission_relation_FI_1` (`role_id`),
	CONSTRAINT `q_role_permission_relation_FK_1`
		FOREIGN KEY (`role_id`)
		REFERENCES `q_role` (`id`)
		ON DELETE CASCADE,
	INDEX `q_role_permission_relation_FI_2` (`permission_id`),
	CONSTRAINT `q_role_permission_relation_FK_2`
		FOREIGN KEY (`permission_id`)
		REFERENCES `q_permission` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- q_permission_scope
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `q_permission_scope`;


CREATE TABLE `q_permission_scope`
(
	`name` VARCHAR(255),
	`parameters` VARCHAR(255),
	`permission_id` INTEGER  NOT NULL,
	`role_id` INTEGER,
	`user_id` INTEGER,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`),
	INDEX `q_permission_scope_FI_1` (`permission_id`),
	CONSTRAINT `q_permission_scope_FK_1`
		FOREIGN KEY (`permission_id`)
		REFERENCES `q_permission` (`id`)
		ON DELETE CASCADE,
	INDEX `q_permission_scope_FI_2` (`role_id`),
	CONSTRAINT `q_permission_scope_FK_2`
		FOREIGN KEY (`role_id`)
		REFERENCES `q_role` (`id`)
		ON DELETE CASCADE,
	INDEX `q_permission_scope_FI_3` (`user_id`),
	CONSTRAINT `q_permission_scope_FK_3`
		FOREIGN KEY (`user_id`)
		REFERENCES `q_user` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- q_setting
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `q_setting`;


CREATE TABLE `q_setting`
(
	`name` VARCHAR(255),
	`scope` VARCHAR(255),
	`editable` INTEGER default 0,
	`deleteable` INTEGER default 0,
	`source_culture` VARCHAR(7)  NOT NULL,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- q_setting_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `q_setting_i18n`;


CREATE TABLE `q_setting_i18n`
(
	`value` TEXT,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `q_setting_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `q_setting` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
