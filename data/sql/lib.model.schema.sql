
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- actor
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `actor`;


CREATE TABLE `actor`
(
	`id` INTEGER  NOT NULL,
	`corporate_body_identifiers` VARCHAR(255),
	`entity_type_id` INTEGER,
	`description_status_id` INTEGER,
	`description_detail_id` INTEGER,
	`description_identifier` VARCHAR(255),
	`source_standard` VARCHAR(255),
	`parent_id` INTEGER,
	`lft` INTEGER  NOT NULL,
	`rgt` INTEGER  NOT NULL,
	`source_culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`),
	CONSTRAINT `actor_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `object` (`id`)
		ON DELETE CASCADE,
	INDEX `actor_FI_2` (`entity_type_id`),
	CONSTRAINT `actor_FK_2`
		FOREIGN KEY (`entity_type_id`)
		REFERENCES `term` (`id`)
		ON DELETE SET NULL,
	INDEX `actor_FI_3` (`description_status_id`),
	CONSTRAINT `actor_FK_3`
		FOREIGN KEY (`description_status_id`)
		REFERENCES `term` (`id`)
		ON DELETE SET NULL,
	INDEX `actor_FI_4` (`description_detail_id`),
	CONSTRAINT `actor_FK_4`
		FOREIGN KEY (`description_detail_id`)
		REFERENCES `term` (`id`)
		ON DELETE SET NULL,
	INDEX `actor_FI_5` (`parent_id`),
	CONSTRAINT `actor_FK_5`
		FOREIGN KEY (`parent_id`)
		REFERENCES `actor` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- actor_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `actor_i18n`;


CREATE TABLE `actor_i18n`
(
	`authorized_form_of_name` VARCHAR(255),
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
	CONSTRAINT `actor_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `actor` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- contact_information
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `contact_information`;


CREATE TABLE `contact_information`
(
	`actor_id` INTEGER  NOT NULL,
	`primary_contact` TINYINT,
	`contact_person` VARCHAR(255),
	`street_address` TEXT,
	`website` VARCHAR(255),
	`email` VARCHAR(255),
	`telephone` VARCHAR(255),
	`fax` VARCHAR(255),
	`postal_code` VARCHAR(255),
	`country_code` VARCHAR(255),
	`longitude` FLOAT,
	`latitude` FLOAT,
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	`source_culture` VARCHAR(7)  NOT NULL,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`serial_number` INTEGER default 0 NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `contact_information_FI_1` (`actor_id`),
	CONSTRAINT `contact_information_FK_1`
		FOREIGN KEY (`actor_id`)
		REFERENCES `actor` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- contact_information_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `contact_information_i18n`;


CREATE TABLE `contact_information_i18n`
(
	`contact_type` VARCHAR(255),
	`city` VARCHAR(255),
	`region` VARCHAR(255),
	`note` TEXT,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `contact_information_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `contact_information` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- digital_object
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `digital_object`;


CREATE TABLE `digital_object`
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
	PRIMARY KEY (`id`),
	CONSTRAINT `digital_object_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `object` (`id`)
		ON DELETE CASCADE,
	INDEX `digital_object_FI_2` (`information_object_id`),
	CONSTRAINT `digital_object_FK_2`
		FOREIGN KEY (`information_object_id`)
		REFERENCES `information_object` (`id`),
	INDEX `digital_object_FI_3` (`usage_id`),
	CONSTRAINT `digital_object_FK_3`
		FOREIGN KEY (`usage_id`)
		REFERENCES `term` (`id`)
		ON DELETE SET NULL,
	INDEX `digital_object_FI_4` (`media_type_id`),
	CONSTRAINT `digital_object_FK_4`
		FOREIGN KEY (`media_type_id`)
		REFERENCES `term` (`id`)
		ON DELETE SET NULL,
	INDEX `digital_object_FI_5` (`checksum_type_id`),
	CONSTRAINT `digital_object_FK_5`
		FOREIGN KEY (`checksum_type_id`)
		REFERENCES `term` (`id`)
		ON DELETE SET NULL,
	INDEX `digital_object_FI_6` (`parent_id`),
	CONSTRAINT `digital_object_FK_6`
		FOREIGN KEY (`parent_id`)
		REFERENCES `digital_object` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- event
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `event`;


CREATE TABLE `event`
(
	`id` INTEGER  NOT NULL,
	`start_date` DATE,
	`start_time` TIME,
	`end_date` DATE,
	`end_time` TIME,
	`type_id` INTEGER  NOT NULL,
	`information_object_id` INTEGER,
	`actor_id` INTEGER,
	`source_culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`),
	CONSTRAINT `event_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `object` (`id`)
		ON DELETE CASCADE,
	INDEX `event_FI_2` (`type_id`),
	CONSTRAINT `event_FK_2`
		FOREIGN KEY (`type_id`)
		REFERENCES `term` (`id`)
		ON DELETE CASCADE,
	INDEX `event_FI_3` (`information_object_id`),
	CONSTRAINT `event_FK_3`
		FOREIGN KEY (`information_object_id`)
		REFERENCES `information_object` (`id`)
		ON DELETE CASCADE,
	INDEX `event_FI_4` (`actor_id`),
	CONSTRAINT `event_FK_4`
		FOREIGN KEY (`actor_id`)
		REFERENCES `actor` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- event_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `event_i18n`;


CREATE TABLE `event_i18n`
(
	`name` VARCHAR(255),
	`description` TEXT,
	`date` VARCHAR(255),
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `event_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `event` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- function
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `function`;


CREATE TABLE `function`
(
	`id` INTEGER  NOT NULL,
	`type_id` INTEGER,
	`parent_id` INTEGER,
	`description_status_id` INTEGER,
	`description_detail_id` INTEGER,
	`description_identifier` VARCHAR(255),
	`source_standard` VARCHAR(255),
	`lft` INTEGER,
	`rgt` INTEGER,
	`source_culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`),
	CONSTRAINT `function_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `object` (`id`)
		ON DELETE CASCADE,
	INDEX `function_FI_2` (`type_id`),
	CONSTRAINT `function_FK_2`
		FOREIGN KEY (`type_id`)
		REFERENCES `term` (`id`),
	INDEX `function_FI_3` (`parent_id`),
	CONSTRAINT `function_FK_3`
		FOREIGN KEY (`parent_id`)
		REFERENCES `function` (`id`),
	INDEX `function_FI_4` (`description_status_id`),
	CONSTRAINT `function_FK_4`
		FOREIGN KEY (`description_status_id`)
		REFERENCES `term` (`id`),
	INDEX `function_FI_5` (`description_detail_id`),
	CONSTRAINT `function_FK_5`
		FOREIGN KEY (`description_detail_id`)
		REFERENCES `term` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- function_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `function_i18n`;


CREATE TABLE `function_i18n`
(
	`authorized_form_of_name` VARCHAR(255),
	`classification` VARCHAR(255),
	`dates` VARCHAR(255),
	`description` TEXT,
	`history` TEXT,
	`legislation` TEXT,
	`institution_identifier` TEXT,
	`revision_history` TEXT,
	`rules` TEXT,
	`sources` TEXT,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `function_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `function` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- historical_event
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `historical_event`;


CREATE TABLE `historical_event`
(
	`id` INTEGER  NOT NULL,
	`type_id` INTEGER,
	`start_date` DATE,
	`start_time` TIME,
	`end_date` DATE,
	`end_time` TIME,
	PRIMARY KEY (`id`),
	CONSTRAINT `historical_event_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `term` (`id`)
		ON DELETE CASCADE,
	INDEX `historical_event_FI_2` (`type_id`),
	CONSTRAINT `historical_event_FK_2`
		FOREIGN KEY (`type_id`)
		REFERENCES `term` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- information_object
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `information_object`;


CREATE TABLE `information_object`
(
	`id` INTEGER  NOT NULL,
	`identifier` VARCHAR(255),
	`oai_local_identifier` INTEGER  NOT NULL AUTO_INCREMENT,
	`level_of_description_id` INTEGER,
	`collection_type_id` INTEGER,
	`repository_id` INTEGER,
	`parent_id` INTEGER,
	`description_status_id` INTEGER,
	`description_detail_id` INTEGER,
	`description_identifier` VARCHAR(255),
	`source_standard` VARCHAR(255),
	`lft` INTEGER  NOT NULL,
	`rgt` INTEGER  NOT NULL,
	`source_culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `information_object_U_1` (`oai_local_identifier`),
	CONSTRAINT `information_object_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `object` (`id`)
		ON DELETE CASCADE,
	INDEX `information_object_FI_2` (`level_of_description_id`),
	CONSTRAINT `information_object_FK_2`
		FOREIGN KEY (`level_of_description_id`)
		REFERENCES `term` (`id`)
		ON DELETE SET NULL,
	INDEX `information_object_FI_3` (`collection_type_id`),
	CONSTRAINT `information_object_FK_3`
		FOREIGN KEY (`collection_type_id`)
		REFERENCES `term` (`id`),
	INDEX `information_object_FI_4` (`repository_id`),
	CONSTRAINT `information_object_FK_4`
		FOREIGN KEY (`repository_id`)
		REFERENCES `repository` (`id`),
	INDEX `information_object_FI_5` (`parent_id`),
	CONSTRAINT `information_object_FK_5`
		FOREIGN KEY (`parent_id`)
		REFERENCES `information_object` (`id`),
	INDEX `information_object_FI_6` (`description_status_id`),
	CONSTRAINT `information_object_FK_6`
		FOREIGN KEY (`description_status_id`)
		REFERENCES `term` (`id`)
		ON DELETE SET NULL,
	INDEX `information_object_FI_7` (`description_detail_id`),
	CONSTRAINT `information_object_FK_7`
		FOREIGN KEY (`description_detail_id`)
		REFERENCES `term` (`id`)
		ON DELETE SET NULL
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- information_object_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `information_object_i18n`;


CREATE TABLE `information_object_i18n`
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
	CONSTRAINT `information_object_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `information_object` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- map
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `map`;


CREATE TABLE `map`
(
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	`source_culture` VARCHAR(7)  NOT NULL,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`serial_number` INTEGER default 0 NOT NULL,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- map_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `map_i18n`;


CREATE TABLE `map_i18n`
(
	`title` VARCHAR(255),
	`description` TEXT,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `map_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `map` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- menu
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `menu`;


CREATE TABLE `menu`
(
	`parent_id` INTEGER,
	`name` VARCHAR(255),
	`path` VARCHAR(255),
	`lft` INTEGER  NOT NULL,
	`rgt` INTEGER  NOT NULL,
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	`source_culture` VARCHAR(7)  NOT NULL,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`serial_number` INTEGER default 0 NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `menu_FI_1` (`parent_id`),
	CONSTRAINT `menu_FK_1`
		FOREIGN KEY (`parent_id`)
		REFERENCES `menu` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- menu_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `menu_i18n`;


CREATE TABLE `menu_i18n`
(
	`label` VARCHAR(255),
	`description` TEXT,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `menu_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `menu` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- note
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `note`;


CREATE TABLE `note`
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
	`serial_number` INTEGER default 0 NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `note_FI_1` (`object_id`),
	CONSTRAINT `note_FK_1`
		FOREIGN KEY (`object_id`)
		REFERENCES `object` (`id`)
		ON DELETE CASCADE,
	INDEX `note_FI_2` (`type_id`),
	CONSTRAINT `note_FK_2`
		FOREIGN KEY (`type_id`)
		REFERENCES `term` (`id`)
		ON DELETE SET NULL,
	INDEX `note_FI_3` (`user_id`),
	CONSTRAINT `note_FK_3`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`),
	INDEX `note_FI_4` (`parent_id`),
	CONSTRAINT `note_FK_4`
		FOREIGN KEY (`parent_id`)
		REFERENCES `note` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- note_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `note_i18n`;


CREATE TABLE `note_i18n`
(
	`content` TEXT,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `note_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `note` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- oai_harvest
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `oai_harvest`;


CREATE TABLE `oai_harvest`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`oai_repository_id` INTEGER  NOT NULL,
	`start_timestamp` DATETIME,
	`end_timestamp` DATETIME,
	`last_harvest` DATETIME,
	`last_harvest_attempt` DATETIME,
	`metadataPrefix` VARCHAR(255),
	`set` VARCHAR(255),
	`created_at` DATETIME  NOT NULL,
	`serial_number` INTEGER default 0 NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `oai_harvest_FI_1` (`oai_repository_id`),
	CONSTRAINT `oai_harvest_FK_1`
		FOREIGN KEY (`oai_repository_id`)
		REFERENCES `oai_repository` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- oai_repository
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `oai_repository`;


CREATE TABLE `oai_repository`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(512),
	`uri` VARCHAR(255),
	`admin_email` VARCHAR(255),
	`earliest_timestamp` DATETIME,
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	`serial_number` INTEGER default 0 NOT NULL,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- object
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `object`;


CREATE TABLE `object`
(
	`class_name` VARCHAR(255),
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`serial_number` INTEGER default 0 NOT NULL,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- object_term_relation
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `object_term_relation`;


CREATE TABLE `object_term_relation`
(
	`id` INTEGER  NOT NULL,
	`object_id` INTEGER  NOT NULL,
	`term_id` INTEGER  NOT NULL,
	`start_date` DATE,
	`end_date` DATE,
	PRIMARY KEY (`id`),
	CONSTRAINT `object_term_relation_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `object` (`id`)
		ON DELETE CASCADE,
	INDEX `object_term_relation_FI_2` (`object_id`),
	CONSTRAINT `object_term_relation_FK_2`
		FOREIGN KEY (`object_id`)
		REFERENCES `object` (`id`)
		ON DELETE CASCADE,
	INDEX `object_term_relation_FI_3` (`term_id`),
	CONSTRAINT `object_term_relation_FK_3`
		FOREIGN KEY (`term_id`)
		REFERENCES `term` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- other_name
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `other_name`;


CREATE TABLE `other_name`
(
	`object_id` INTEGER  NOT NULL,
	`type_id` INTEGER,
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	`source_culture` VARCHAR(7)  NOT NULL,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`serial_number` INTEGER default 0 NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `other_name_FI_1` (`object_id`),
	CONSTRAINT `other_name_FK_1`
		FOREIGN KEY (`object_id`)
		REFERENCES `object` (`id`)
		ON DELETE CASCADE,
	INDEX `other_name_FI_2` (`type_id`),
	CONSTRAINT `other_name_FK_2`
		FOREIGN KEY (`type_id`)
		REFERENCES `term` (`id`)
		ON DELETE SET NULL
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- other_name_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `other_name_i18n`;


CREATE TABLE `other_name_i18n`
(
	`name` VARCHAR(255),
	`note` VARCHAR(255),
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `other_name_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `other_name` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- physical_object
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `physical_object`;


CREATE TABLE `physical_object`
(
	`id` INTEGER  NOT NULL,
	`type_id` INTEGER,
	`parent_id` INTEGER,
	`lft` INTEGER  NOT NULL,
	`rgt` INTEGER  NOT NULL,
	`source_culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`),
	CONSTRAINT `physical_object_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `object` (`id`)
		ON DELETE CASCADE,
	INDEX `physical_object_FI_2` (`type_id`),
	CONSTRAINT `physical_object_FK_2`
		FOREIGN KEY (`type_id`)
		REFERENCES `term` (`id`)
		ON DELETE SET NULL,
	INDEX `physical_object_FI_3` (`parent_id`),
	CONSTRAINT `physical_object_FK_3`
		FOREIGN KEY (`parent_id`)
		REFERENCES `physical_object` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- physical_object_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `physical_object_i18n`;


CREATE TABLE `physical_object_i18n`
(
	`name` VARCHAR(255),
	`description` TEXT,
	`location` TEXT,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `physical_object_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `physical_object` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- place
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `place`;


CREATE TABLE `place`
(
	`id` INTEGER  NOT NULL,
	`country_id` INTEGER,
	`type_id` INTEGER,
	`longtitude` FLOAT,
	`latitude` FLOAT,
	`altitude` FLOAT,
	`source_culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`),
	CONSTRAINT `place_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `term` (`id`)
		ON DELETE CASCADE,
	INDEX `place_FI_2` (`country_id`),
	CONSTRAINT `place_FK_2`
		FOREIGN KEY (`country_id`)
		REFERENCES `term` (`id`),
	INDEX `place_FI_3` (`type_id`),
	CONSTRAINT `place_FK_3`
		FOREIGN KEY (`type_id`)
		REFERENCES `term` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- place_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `place_i18n`;


CREATE TABLE `place_i18n`
(
	`street_address` TEXT,
	`city` VARCHAR(255),
	`region` VARCHAR(255),
	`postal_code` VARCHAR(255),
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `place_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `place` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- place_map_relation
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `place_map_relation`;


CREATE TABLE `place_map_relation`
(
	`id` INTEGER  NOT NULL,
	`place_id` INTEGER  NOT NULL,
	`map_id` INTEGER  NOT NULL,
	`map_icon_image_id` INTEGER,
	`map_icon_description` TEXT,
	`type_id` INTEGER,
	PRIMARY KEY (`id`),
	CONSTRAINT `place_map_relation_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `object` (`id`)
		ON DELETE CASCADE,
	INDEX `place_map_relation_FI_2` (`place_id`),
	CONSTRAINT `place_map_relation_FK_2`
		FOREIGN KEY (`place_id`)
		REFERENCES `place` (`id`)
		ON DELETE CASCADE,
	INDEX `place_map_relation_FI_3` (`map_id`),
	CONSTRAINT `place_map_relation_FK_3`
		FOREIGN KEY (`map_id`)
		REFERENCES `map` (`id`)
		ON DELETE CASCADE,
	INDEX `place_map_relation_FI_4` (`map_icon_image_id`),
	CONSTRAINT `place_map_relation_FK_4`
		FOREIGN KEY (`map_icon_image_id`)
		REFERENCES `digital_object` (`id`),
	INDEX `place_map_relation_FI_5` (`type_id`),
	CONSTRAINT `place_map_relation_FK_5`
		FOREIGN KEY (`type_id`)
		REFERENCES `term` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- property
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `property`;


CREATE TABLE `property`
(
	`object_id` INTEGER  NOT NULL,
	`scope` VARCHAR(255),
	`name` VARCHAR(255),
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	`source_culture` VARCHAR(7)  NOT NULL,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`serial_number` INTEGER default 0 NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `property_FI_1` (`object_id`),
	CONSTRAINT `property_FK_1`
		FOREIGN KEY (`object_id`)
		REFERENCES `object` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- property_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `property_i18n`;


CREATE TABLE `property_i18n`
(
	`value` VARCHAR(255),
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `property_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `property` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- relation
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `relation`;


CREATE TABLE `relation`
(
	`id` INTEGER  NOT NULL,
	`subject_id` INTEGER  NOT NULL,
	`object_id` INTEGER  NOT NULL,
	`type_id` INTEGER,
	`start_date` DATE,
	`end_date` DATE,
	PRIMARY KEY (`id`),
	CONSTRAINT `relation_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `object` (`id`)
		ON DELETE CASCADE,
	INDEX `relation_FI_2` (`subject_id`),
	CONSTRAINT `relation_FK_2`
		FOREIGN KEY (`subject_id`)
		REFERENCES `object` (`id`),
	INDEX `relation_FI_3` (`object_id`),
	CONSTRAINT `relation_FK_3`
		FOREIGN KEY (`object_id`)
		REFERENCES `object` (`id`),
	INDEX `relation_FI_4` (`type_id`),
	CONSTRAINT `relation_FK_4`
		FOREIGN KEY (`type_id`)
		REFERENCES `term` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- repository
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `repository`;


CREATE TABLE `repository`
(
	`id` INTEGER  NOT NULL,
	`identifier` VARCHAR(255),
	`desc_status_id` INTEGER,
	`desc_detail_id` INTEGER,
	`desc_identifier` VARCHAR(255),
	`source_culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`),
	CONSTRAINT `repository_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `actor` (`id`)
		ON DELETE CASCADE,
	INDEX `repository_FI_2` (`desc_status_id`),
	CONSTRAINT `repository_FK_2`
		FOREIGN KEY (`desc_status_id`)
		REFERENCES `term` (`id`)
		ON DELETE SET NULL,
	INDEX `repository_FI_3` (`desc_detail_id`),
	CONSTRAINT `repository_FK_3`
		FOREIGN KEY (`desc_detail_id`)
		REFERENCES `term` (`id`)
		ON DELETE SET NULL
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- repository_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `repository_i18n`;


CREATE TABLE `repository_i18n`
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
	CONSTRAINT `repository_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `repository` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- rights
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `rights`;


CREATE TABLE `rights`
(
	`object_id` INTEGER  NOT NULL,
	`permission_id` INTEGER,
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	`source_culture` VARCHAR(7)  NOT NULL,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`serial_number` INTEGER default 0 NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `rights_FI_1` (`object_id`),
	CONSTRAINT `rights_FK_1`
		FOREIGN KEY (`object_id`)
		REFERENCES `object` (`id`)
		ON DELETE CASCADE,
	INDEX `rights_FI_2` (`permission_id`),
	CONSTRAINT `rights_FK_2`
		FOREIGN KEY (`permission_id`)
		REFERENCES `term` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- rights_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `rights_i18n`;


CREATE TABLE `rights_i18n`
(
	`description` TEXT,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `rights_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `rights` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- rights_actor_relation
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `rights_actor_relation`;


CREATE TABLE `rights_actor_relation`
(
	`id` INTEGER  NOT NULL,
	`rights_id` INTEGER  NOT NULL,
	`actor_id` INTEGER  NOT NULL,
	`type_id` INTEGER,
	PRIMARY KEY (`id`),
	CONSTRAINT `rights_actor_relation_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `object` (`id`)
		ON DELETE CASCADE,
	INDEX `rights_actor_relation_FI_2` (`rights_id`),
	CONSTRAINT `rights_actor_relation_FK_2`
		FOREIGN KEY (`rights_id`)
		REFERENCES `rights` (`id`)
		ON DELETE CASCADE,
	INDEX `rights_actor_relation_FI_3` (`actor_id`),
	CONSTRAINT `rights_actor_relation_FK_3`
		FOREIGN KEY (`actor_id`)
		REFERENCES `actor` (`id`)
		ON DELETE CASCADE,
	INDEX `rights_actor_relation_FI_4` (`type_id`),
	CONSTRAINT `rights_actor_relation_FK_4`
		FOREIGN KEY (`type_id`)
		REFERENCES `term` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- rights_term_relation
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `rights_term_relation`;


CREATE TABLE `rights_term_relation`
(
	`rights_id` INTEGER  NOT NULL,
	`term_id` INTEGER  NOT NULL,
	`type_id` INTEGER,
	`description` TEXT,
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`serial_number` INTEGER default 0 NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `rights_term_relation_FI_1` (`rights_id`),
	CONSTRAINT `rights_term_relation_FK_1`
		FOREIGN KEY (`rights_id`)
		REFERENCES `rights` (`id`)
		ON DELETE CASCADE,
	INDEX `rights_term_relation_FI_2` (`term_id`),
	CONSTRAINT `rights_term_relation_FK_2`
		FOREIGN KEY (`term_id`)
		REFERENCES `term` (`id`)
		ON DELETE CASCADE,
	INDEX `rights_term_relation_FI_3` (`type_id`),
	CONSTRAINT `rights_term_relation_FK_3`
		FOREIGN KEY (`type_id`)
		REFERENCES `term` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- setting
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `setting`;


CREATE TABLE `setting`
(
	`name` VARCHAR(255),
	`scope` VARCHAR(255),
	`editable` TINYINT default 0,
	`deleteable` TINYINT default 0,
	`source_culture` VARCHAR(7)  NOT NULL,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`serial_number` INTEGER default 0 NOT NULL,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- setting_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `setting_i18n`;


CREATE TABLE `setting_i18n`
(
	`value` TEXT,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `setting_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `setting` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- slug
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `slug`;


CREATE TABLE `slug`
(
	`object_id` INTEGER  NOT NULL,
	`slug` VARCHAR(255)  NOT NULL,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`serial_number` INTEGER default 0 NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `slug_U_1` (`object_id`),
	UNIQUE KEY `slug_U_2` (`slug`),
	CONSTRAINT `slug_FK_1`
		FOREIGN KEY (`object_id`)
		REFERENCES `object` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- static_page
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `static_page`;


CREATE TABLE `static_page`
(
	`id` INTEGER  NOT NULL,
	`source_culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`),
	CONSTRAINT `static_page_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `object` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- static_page_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `static_page_i18n`;


CREATE TABLE `static_page_i18n`
(
	`title` VARCHAR(255),
	`content` TEXT,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `static_page_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `static_page` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- status
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `status`;


CREATE TABLE `status`
(
	`object_id` INTEGER  NOT NULL,
	`type_id` INTEGER,
	`status_id` INTEGER,
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`serial_number` INTEGER default 0 NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `status_FI_1` (`object_id`),
	CONSTRAINT `status_FK_1`
		FOREIGN KEY (`object_id`)
		REFERENCES `object` (`id`)
		ON DELETE CASCADE,
	INDEX `status_FI_2` (`type_id`),
	CONSTRAINT `status_FK_2`
		FOREIGN KEY (`type_id`)
		REFERENCES `term` (`id`)
		ON DELETE CASCADE,
	INDEX `status_FI_3` (`status_id`),
	CONSTRAINT `status_FK_3`
		FOREIGN KEY (`status_id`)
		REFERENCES `term` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- system_event
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `system_event`;


CREATE TABLE `system_event`
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
	`serial_number` INTEGER default 0 NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `system_event_FI_1` (`type_id`),
	CONSTRAINT `system_event_FK_1`
		FOREIGN KEY (`type_id`)
		REFERENCES `term` (`id`),
	INDEX `system_event_FI_2` (`user_id`),
	CONSTRAINT `system_event_FK_2`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- taxonomy
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `taxonomy`;


CREATE TABLE `taxonomy`
(
	`id` INTEGER  NOT NULL,
	`usage` VARCHAR(255),
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	`parent_id` INTEGER,
	`lft` INTEGER  NOT NULL,
	`rgt` INTEGER  NOT NULL,
	`source_culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`),
	CONSTRAINT `taxonomy_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `object` (`id`)
		ON DELETE CASCADE,
	INDEX `taxonomy_FI_2` (`parent_id`),
	CONSTRAINT `taxonomy_FK_2`
		FOREIGN KEY (`parent_id`)
		REFERENCES `taxonomy` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- taxonomy_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `taxonomy_i18n`;


CREATE TABLE `taxonomy_i18n`
(
	`name` VARCHAR(255),
	`note` TEXT,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `taxonomy_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `taxonomy` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- term
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `term`;


CREATE TABLE `term`
(
	`id` INTEGER  NOT NULL,
	`taxonomy_id` INTEGER  NOT NULL,
	`code` VARCHAR(255),
	`parent_id` INTEGER,
	`lft` INTEGER  NOT NULL,
	`rgt` INTEGER  NOT NULL,
	`source_culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`),
	CONSTRAINT `term_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `object` (`id`)
		ON DELETE CASCADE,
	INDEX `term_FI_2` (`taxonomy_id`),
	CONSTRAINT `term_FK_2`
		FOREIGN KEY (`taxonomy_id`)
		REFERENCES `taxonomy` (`id`)
		ON DELETE CASCADE,
	INDEX `term_FI_3` (`parent_id`),
	CONSTRAINT `term_FK_3`
		FOREIGN KEY (`parent_id`)
		REFERENCES `term` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- term_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `term_i18n`;


CREATE TABLE `term_i18n`
(
	`name` VARCHAR(255),
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `term_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `term` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- user
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `user`;


CREATE TABLE `user`
(
	`id` INTEGER  NOT NULL,
	`username` VARCHAR(255),
	`email` VARCHAR(255),
	`sha1_password` VARCHAR(255),
	`salt` VARCHAR(255),
	PRIMARY KEY (`id`),
	CONSTRAINT `user_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `actor` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
