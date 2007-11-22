
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- information_object
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `information_object`;


CREATE TABLE `information_object`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`identifier` VARCHAR(255),
	`title` VARCHAR(255),
	`alternate_title` VARCHAR(255),
	`version` VARCHAR(255),
	`level_of_description_id` INTEGER,
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
	`rules` TEXT,
	`collection_type_id` INTEGER,
	`repository_id` INTEGER  NOT NULL,
	`tree_id` INTEGER,
	`tree_left_id` INTEGER,
	`tree_right_id` INTEGER,
	`tree_parent_id` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `information_object_FI_1` (`level_of_description_id`),
	CONSTRAINT `information_object_FK_1`
		FOREIGN KEY (`level_of_description_id`)
		REFERENCES `term` (`id`),
	INDEX `information_object_FI_2` (`collection_type_id`),
	CONSTRAINT `information_object_FK_2`
		FOREIGN KEY (`collection_type_id`)
		REFERENCES `term` (`id`),
	INDEX `information_object_FI_3` (`repository_id`),
	CONSTRAINT `information_object_FK_3`
		FOREIGN KEY (`repository_id`)
		REFERENCES `repository` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- information_object_term_relationship
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `information_object_term_relationship`;


CREATE TABLE `information_object_term_relationship`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`information_object_id` INTEGER  NOT NULL,
	`term_id` INTEGER  NOT NULL,
	`relationship_type_id` INTEGER,
	`relationship_note` TEXT,
	`relationship_start_date` DATE,
	`relationship_end_date` DATE,
	`date_display` VARCHAR(255),
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `information_object_term_relationship_FI_1` (`information_object_id`),
	CONSTRAINT `information_object_term_relationship_FK_1`
		FOREIGN KEY (`information_object_id`)
		REFERENCES `information_object` (`id`),
	INDEX `information_object_term_relationship_FI_2` (`term_id`),
	CONSTRAINT `information_object_term_relationship_FK_2`
		FOREIGN KEY (`term_id`)
		REFERENCES `term` (`id`),
	INDEX `information_object_term_relationship_FI_3` (`relationship_type_id`),
	CONSTRAINT `information_object_term_relationship_FK_3`
		FOREIGN KEY (`relationship_type_id`)
		REFERENCES `term` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- information_object_recursive_relationship
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `information_object_recursive_relationship`;


CREATE TABLE `information_object_recursive_relationship`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`information_object_id` INTEGER  NOT NULL,
	`related_information_object_id` INTEGER,
	`relationship_type_id` INTEGER,
	`relationship_description` TEXT,
	`relationship_start_date` DATE,
	`relationship_end_date` DATE,
	`date_display` VARCHAR(255),
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `information_object_recursive_relationship_FI_1` (`information_object_id`),
	CONSTRAINT `information_object_recursive_relationship_FK_1`
		FOREIGN KEY (`information_object_id`)
		REFERENCES `information_object` (`id`),
	INDEX `information_object_recursive_relationship_FI_2` (`related_information_object_id`),
	CONSTRAINT `information_object_recursive_relationship_FK_2`
		FOREIGN KEY (`related_information_object_id`)
		REFERENCES `information_object` (`id`),
	INDEX `information_object_recursive_relationship_FI_3` (`relationship_type_id`),
	CONSTRAINT `information_object_recursive_relationship_FK_3`
		FOREIGN KEY (`relationship_type_id`)
		REFERENCES `term` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- note
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `note`;


CREATE TABLE `note`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`information_object_id` INTEGER  NOT NULL,
	`actor_id` INTEGER  NOT NULL,
	`repository_id` INTEGER  NOT NULL,
	`function_description_id` INTEGER  NOT NULL,
	`note` TEXT,
	`note_type_id` INTEGER,
	`user_id` INTEGER  NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `note_FI_1` (`information_object_id`),
	CONSTRAINT `note_FK_1`
		FOREIGN KEY (`information_object_id`)
		REFERENCES `information_object` (`id`),
	INDEX `note_FI_2` (`actor_id`),
	CONSTRAINT `note_FK_2`
		FOREIGN KEY (`actor_id`)
		REFERENCES `actor` (`id`),
	INDEX `note_FI_3` (`repository_id`),
	CONSTRAINT `note_FK_3`
		FOREIGN KEY (`repository_id`)
		REFERENCES `repository` (`id`),
	INDEX `note_FI_4` (`function_description_id`),
	CONSTRAINT `note_FK_4`
		FOREIGN KEY (`function_description_id`)
		REFERENCES `function_description` (`id`),
	INDEX `note_FI_5` (`note_type_id`),
	CONSTRAINT `note_FK_5`
		FOREIGN KEY (`note_type_id`)
		REFERENCES `term` (`id`),
	INDEX `note_FI_6` (`user_id`),
	CONSTRAINT `note_FK_6`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- digital_object
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `digital_object`;


CREATE TABLE `digital_object`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`information_object_id` INTEGER  NOT NULL,
	`useage_id` INTEGER,
	`name` VARCHAR(255),
	`description` TEXT,
	`mime_type_id` INTEGER,
	`media_type_id` INTEGER,
	`sequence` INTEGER,
	`byte_size` INTEGER,
	`checksum` VARCHAR(100),
	`checksum_type_id` INTEGER,
	`location_id` INTEGER,
	`tree_id` INTEGER,
	`tree_left_id` INTEGER,
	`tree_right_id` INTEGER,
	`tree_parent_id` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `digital_object_FI_1` (`information_object_id`),
	CONSTRAINT `digital_object_FK_1`
		FOREIGN KEY (`information_object_id`)
		REFERENCES `information_object` (`id`),
	INDEX `digital_object_FI_2` (`useage_id`),
	CONSTRAINT `digital_object_FK_2`
		FOREIGN KEY (`useage_id`)
		REFERENCES `term` (`id`),
	INDEX `digital_object_FI_3` (`mime_type_id`),
	CONSTRAINT `digital_object_FK_3`
		FOREIGN KEY (`mime_type_id`)
		REFERENCES `term` (`id`),
	INDEX `digital_object_FI_4` (`media_type_id`),
	CONSTRAINT `digital_object_FK_4`
		FOREIGN KEY (`media_type_id`)
		REFERENCES `term` (`id`),
	INDEX `digital_object_FI_5` (`checksum_type_id`),
	CONSTRAINT `digital_object_FK_5`
		FOREIGN KEY (`checksum_type_id`)
		REFERENCES `term` (`id`),
	INDEX `digital_object_FI_6` (`location_id`),
	CONSTRAINT `digital_object_FK_6`
		FOREIGN KEY (`location_id`)
		REFERENCES `term` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- digital_object_metadata
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `digital_object_metadata`;


CREATE TABLE `digital_object_metadata`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`digital_object_id` INTEGER  NOT NULL,
	`element` VARCHAR(255),
	`value` TEXT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `digital_object_metadata_FI_1` (`digital_object_id`),
	CONSTRAINT `digital_object_metadata_FK_1`
		FOREIGN KEY (`digital_object_id`)
		REFERENCES `digital_object` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- digital_object_recursive_relationship
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `digital_object_recursive_relationship`;


CREATE TABLE `digital_object_recursive_relationship`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`digital_object_id` INTEGER  NOT NULL,
	`related_digital_object_id` INTEGER,
	`relationship_type_id` INTEGER,
	`relationship_description` TEXT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `digital_object_recursive_relationship_FI_1` (`digital_object_id`),
	CONSTRAINT `digital_object_recursive_relationship_FK_1`
		FOREIGN KEY (`digital_object_id`)
		REFERENCES `digital_object` (`id`),
	INDEX `digital_object_recursive_relationship_FI_2` (`related_digital_object_id`),
	CONSTRAINT `digital_object_recursive_relationship_FK_2`
		FOREIGN KEY (`related_digital_object_id`)
		REFERENCES `digital_object` (`id`),
	INDEX `digital_object_recursive_relationship_FI_3` (`relationship_type_id`),
	CONSTRAINT `digital_object_recursive_relationship_FK_3`
		FOREIGN KEY (`relationship_type_id`)
		REFERENCES `term` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- physical_object
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `physical_object`;


CREATE TABLE `physical_object`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255),
	`description` TEXT,
	`information_object_id` INTEGER  NOT NULL,
	`location_id` INTEGER,
	`tree_id` INTEGER,
	`tree_left_id` INTEGER,
	`tree_right_id` INTEGER,
	`tree_parent_id` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `physical_object_FI_1` (`information_object_id`),
	CONSTRAINT `physical_object_FK_1`
		FOREIGN KEY (`information_object_id`)
		REFERENCES `information_object` (`id`),
	INDEX `physical_object_FI_2` (`location_id`),
	CONSTRAINT `physical_object_FK_2`
		FOREIGN KEY (`location_id`)
		REFERENCES `term` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- actor
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `actor`;


CREATE TABLE `actor`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`authorized_form_of_name` VARCHAR(255)  NOT NULL,
	`type_of_entity_id` INTEGER,
	`identifiers` VARCHAR(255),
	`history` TEXT,
	`legal_status` TEXT,
	`functions` TEXT,
	`mandates` TEXT,
	`internal_structures` TEXT,
	`general_context` TEXT,
	`authority_record_identifier` VARCHAR(255),
	`institution_identifier` VARCHAR(255),
	`rules` TEXT,
	`status_id` INTEGER,
	`level_of_detail_id` INTEGER,
	`sources` TEXT,
	`tree_id` INTEGER,
	`tree_left_id` INTEGER,
	`tree_right_id` INTEGER,
	`tree_parent_id` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `actor_FI_1` (`type_of_entity_id`),
	CONSTRAINT `actor_FK_1`
		FOREIGN KEY (`type_of_entity_id`)
		REFERENCES `term` (`id`),
	INDEX `actor_FI_2` (`status_id`),
	CONSTRAINT `actor_FK_2`
		FOREIGN KEY (`status_id`)
		REFERENCES `term` (`id`),
	INDEX `actor_FI_3` (`level_of_detail_id`),
	CONSTRAINT `actor_FK_3`
		FOREIGN KEY (`level_of_detail_id`)
		REFERENCES `term` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- actor_name
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `actor_name`;


CREATE TABLE `actor_name`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`actor_id` INTEGER  NOT NULL,
	`name` VARCHAR(255),
	`name_type_id` INTEGER,
	`name_note` VARCHAR(255),
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `actor_name_FI_1` (`actor_id`),
	CONSTRAINT `actor_name_FK_1`
		FOREIGN KEY (`actor_id`)
		REFERENCES `actor` (`id`),
	INDEX `actor_name_FI_2` (`name_type_id`),
	CONSTRAINT `actor_name_FK_2`
		FOREIGN KEY (`name_type_id`)
		REFERENCES `term` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- actor_recursive_relationship
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `actor_recursive_relationship`;


CREATE TABLE `actor_recursive_relationship`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`actor_id` INTEGER  NOT NULL,
	`related_actor_id` INTEGER,
	`relationship_type_id` INTEGER,
	`relationship_description` TEXT,
	`relationship_start_date` DATE,
	`relationship_end_date` DATE,
	`date_display` VARCHAR(255),
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `actor_recursive_relationship_FI_1` (`actor_id`),
	CONSTRAINT `actor_recursive_relationship_FK_1`
		FOREIGN KEY (`actor_id`)
		REFERENCES `actor` (`id`),
	INDEX `actor_recursive_relationship_FI_2` (`related_actor_id`),
	CONSTRAINT `actor_recursive_relationship_FK_2`
		FOREIGN KEY (`related_actor_id`)
		REFERENCES `actor` (`id`),
	INDEX `actor_recursive_relationship_FI_3` (`relationship_type_id`),
	CONSTRAINT `actor_recursive_relationship_FK_3`
		FOREIGN KEY (`relationship_type_id`)
		REFERENCES `term` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- actor_term_relationship
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `actor_term_relationship`;


CREATE TABLE `actor_term_relationship`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`actor_id` INTEGER  NOT NULL,
	`term_id` INTEGER  NOT NULL,
	`relationship_type_id` INTEGER,
	`relationship_note` TEXT,
	`relationship_start_date` DATE,
	`relationship_end_date` DATE,
	`date_display` VARCHAR(255),
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `actor_term_relationship_FI_1` (`actor_id`),
	CONSTRAINT `actor_term_relationship_FK_1`
		FOREIGN KEY (`actor_id`)
		REFERENCES `actor` (`id`),
	INDEX `actor_term_relationship_FI_2` (`term_id`),
	CONSTRAINT `actor_term_relationship_FK_2`
		FOREIGN KEY (`term_id`)
		REFERENCES `term` (`id`),
	INDEX `actor_term_relationship_FI_3` (`relationship_type_id`),
	CONSTRAINT `actor_term_relationship_FK_3`
		FOREIGN KEY (`relationship_type_id`)
		REFERENCES `term` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- contact_information
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `contact_information`;


CREATE TABLE `contact_information`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`actor_id` INTEGER  NOT NULL,
	`contact_type` VARCHAR(255),
	`primary_contact` INTEGER,
	`street_address` TEXT,
	`city` VARCHAR(255),
	`region` VARCHAR(255),
	`postal_code` VARCHAR(20),
	`country_id` INTEGER,
	`longtitude` FLOAT,
	`latitude` FLOAT,
	`telephone` VARCHAR(255),
	`fax` VARCHAR(255),
	`website` VARCHAR(255),
	`email` VARCHAR(255),
	`note` TEXT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `contact_information_FI_1` (`actor_id`),
	CONSTRAINT `contact_information_FK_1`
		FOREIGN KEY (`actor_id`)
		REFERENCES `actor` (`id`),
	INDEX `contact_information_FI_2` (`country_id`),
	CONSTRAINT `contact_information_FK_2`
		FOREIGN KEY (`country_id`)
		REFERENCES `term` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- place
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `place`;


CREATE TABLE `place`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`term_id` INTEGER  NOT NULL,
	`address` TEXT,
	`country_id` INTEGER,
	`place_type_id` INTEGER,
	`longtitude` FLOAT,
	`latitude` FLOAT,
	`altitude` FLOAT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `place_FI_1` (`term_id`),
	CONSTRAINT `place_FK_1`
		FOREIGN KEY (`term_id`)
		REFERENCES `term` (`id`),
	INDEX `place_FI_2` (`country_id`),
	CONSTRAINT `place_FK_2`
		FOREIGN KEY (`country_id`)
		REFERENCES `term` (`id`),
	INDEX `place_FI_3` (`place_type_id`),
	CONSTRAINT `place_FK_3`
		FOREIGN KEY (`place_type_id`)
		REFERENCES `term` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- map
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `map`;


CREATE TABLE `map`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(255),
	`description` TEXT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- place_map_relationship
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `place_map_relationship`;


CREATE TABLE `place_map_relationship`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`place_id` INTEGER  NOT NULL,
	`map_id` INTEGER  NOT NULL,
	`map_icon_image_id` INTEGER,
	`map_icon_description` TEXT,
	`relationship_type_id` INTEGER,
	`relationship_note` TEXT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `place_map_relationship_FI_1` (`place_id`),
	CONSTRAINT `place_map_relationship_FK_1`
		FOREIGN KEY (`place_id`)
		REFERENCES `place` (`id`),
	INDEX `place_map_relationship_FI_2` (`map_id`),
	CONSTRAINT `place_map_relationship_FK_2`
		FOREIGN KEY (`map_id`)
		REFERENCES `map` (`id`),
	INDEX `place_map_relationship_FI_3` (`map_icon_image_id`),
	CONSTRAINT `place_map_relationship_FK_3`
		FOREIGN KEY (`map_icon_image_id`)
		REFERENCES `digital_object` (`id`),
	INDEX `place_map_relationship_FI_4` (`relationship_type_id`),
	CONSTRAINT `place_map_relationship_FK_4`
		FOREIGN KEY (`relationship_type_id`)
		REFERENCES `term` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- repository
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `repository`;


CREATE TABLE `repository`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`actor_id` INTEGER  NOT NULL,
	`identifier` VARCHAR(255),
	`repository_type_id` INTEGER,
	`officers_in_charge` TEXT,
	`geocultural_context` TEXT,
	`collecting_policies` TEXT,
	`buildings` TEXT,
	`holdings` TEXT,
	`finding_aids` TEXT,
	`opening_times` TEXT,
	`access_conditions` TEXT,
	`disabled_access` TEXT,
	`transport` TEXT,
	`research_services` TEXT,
	`reproduction_services` TEXT,
	`public_facilities` TEXT,
	`description_identifier` VARCHAR(255),
	`institution_identifier` VARCHAR(255),
	`rules` TEXT,
	`status_id` INTEGER,
	`level_of_detail_id` INTEGER,
	`sources` TEXT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `repository_FI_1` (`actor_id`),
	CONSTRAINT `repository_FK_1`
		FOREIGN KEY (`actor_id`)
		REFERENCES `actor` (`id`),
	INDEX `repository_FI_2` (`repository_type_id`),
	CONSTRAINT `repository_FK_2`
		FOREIGN KEY (`repository_type_id`)
		REFERENCES `term` (`id`),
	INDEX `repository_FI_3` (`status_id`),
	CONSTRAINT `repository_FK_3`
		FOREIGN KEY (`status_id`)
		REFERENCES `term` (`id`),
	INDEX `repository_FI_4` (`level_of_detail_id`),
	CONSTRAINT `repository_FK_4`
		FOREIGN KEY (`level_of_detail_id`)
		REFERENCES `term` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- repository_term_relationship
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `repository_term_relationship`;


CREATE TABLE `repository_term_relationship`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`repository_id` INTEGER  NOT NULL,
	`term_id` INTEGER  NOT NULL,
	`relationship_type_id` INTEGER,
	`relationship_note` TEXT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `repository_term_relationship_FI_1` (`repository_id`),
	CONSTRAINT `repository_term_relationship_FK_1`
		FOREIGN KEY (`repository_id`)
		REFERENCES `repository` (`id`),
	INDEX `repository_term_relationship_FI_2` (`term_id`),
	CONSTRAINT `repository_term_relationship_FK_2`
		FOREIGN KEY (`term_id`)
		REFERENCES `term` (`id`),
	INDEX `repository_term_relationship_FI_3` (`relationship_type_id`),
	CONSTRAINT `repository_term_relationship_FK_3`
		FOREIGN KEY (`relationship_type_id`)
		REFERENCES `term` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- term
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `term`;


CREATE TABLE `term`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`taxonomy_id` INTEGER  NOT NULL,
	`term_name` VARCHAR(255),
	`scope_note` TEXT,
	`code_alpha` VARCHAR(5),
	`code_alpha2` VARCHAR(5),
	`code_numeric` INTEGER,
	`sort_order` INTEGER,
	`source` VARCHAR(255),
	`locked` INTEGER,
	`tree_id` INTEGER,
	`tree_left_id` INTEGER,
	`tree_right_id` INTEGER,
	`tree_parent_id` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `term_FI_1` (`taxonomy_id`),
	CONSTRAINT `term_FK_1`
		FOREIGN KEY (`taxonomy_id`)
		REFERENCES `taxonomy` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- taxonomy
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `taxonomy`;


CREATE TABLE `taxonomy`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(50),
	`term_use` VARCHAR(5),
	`note` TEXT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- term_recursive_relationship
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `term_recursive_relationship`;


CREATE TABLE `term_recursive_relationship`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`term_id` INTEGER  NOT NULL,
	`related_term_id` INTEGER,
	`relationship_type_id` INTEGER,
	`relationship_description` VARCHAR(255),
	`relationship_start_date` DATE,
	`relationship_end_date` DATE,
	`date_display` VARCHAR(255),
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `term_recursive_relationship_FI_1` (`term_id`),
	CONSTRAINT `term_recursive_relationship_FK_1`
		FOREIGN KEY (`term_id`)
		REFERENCES `term` (`id`),
	INDEX `term_recursive_relationship_FI_2` (`related_term_id`),
	CONSTRAINT `term_recursive_relationship_FK_2`
		FOREIGN KEY (`related_term_id`)
		REFERENCES `term` (`id`),
	INDEX `term_recursive_relationship_FI_3` (`relationship_type_id`),
	CONSTRAINT `term_recursive_relationship_FK_3`
		FOREIGN KEY (`relationship_type_id`)
		REFERENCES `term` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- event
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `event`;


CREATE TABLE `event`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255),
	`description` TEXT,
	`start_date` DATE,
	`start_time` TIME,
	`end_date` DATE,
	`end_time` TIME,
	`date_display` VARCHAR(255),
	`event_type_id` INTEGER,
	`actor_role_id` INTEGER,
	`information_object_id` INTEGER  NOT NULL,
	`actor_id` INTEGER  NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `event_FI_1` (`event_type_id`),
	CONSTRAINT `event_FK_1`
		FOREIGN KEY (`event_type_id`)
		REFERENCES `term` (`id`),
	INDEX `event_FI_2` (`actor_role_id`),
	CONSTRAINT `event_FK_2`
		FOREIGN KEY (`actor_role_id`)
		REFERENCES `term` (`id`),
	INDEX `event_FI_3` (`information_object_id`),
	CONSTRAINT `event_FK_3`
		FOREIGN KEY (`information_object_id`)
		REFERENCES `information_object` (`id`),
	INDEX `event_FI_4` (`actor_id`),
	CONSTRAINT `event_FK_4`
		FOREIGN KEY (`actor_id`)
		REFERENCES `actor` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- event_term_relationship
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `event_term_relationship`;


CREATE TABLE `event_term_relationship`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`event_id` INTEGER  NOT NULL,
	`term_id` INTEGER  NOT NULL,
	`relationship_type_id` INTEGER,
	`description` TEXT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `event_term_relationship_FI_1` (`event_id`),
	CONSTRAINT `event_term_relationship_FK_1`
		FOREIGN KEY (`event_id`)
		REFERENCES `event` (`id`),
	INDEX `event_term_relationship_FI_2` (`term_id`),
	CONSTRAINT `event_term_relationship_FK_2`
		FOREIGN KEY (`term_id`)
		REFERENCES `term` (`id`),
	INDEX `event_term_relationship_FI_3` (`relationship_type_id`),
	CONSTRAINT `event_term_relationship_FK_3`
		FOREIGN KEY (`relationship_type_id`)
		REFERENCES `term` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- system_event
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `system_event`;


CREATE TABLE `system_event`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`system_event_type_id` INTEGER,
	`object_class` VARCHAR(255),
	`object_id` INTEGER,
	`pre_event_snapshot` TEXT,
	`post_event_snapshot` TEXT,
	`date` DATETIME,
	`user_name` VARCHAR(255),
	`user_id` INTEGER  NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `system_event_FI_1` (`system_event_type_id`),
	CONSTRAINT `system_event_FK_1`
		FOREIGN KEY (`system_event_type_id`)
		REFERENCES `term` (`id`),
	INDEX `system_event_FI_2` (`user_id`),
	CONSTRAINT `system_event_FK_2`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- historical_event
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `historical_event`;


CREATE TABLE `historical_event`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`term_id` INTEGER  NOT NULL,
	`historical_event_type_id` INTEGER,
	`start_date` DATE,
	`start_time` TIME,
	`end_date` DATE,
	`end_time` TIME,
	`date_display` VARCHAR(255),
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `historical_event_FI_1` (`term_id`),
	CONSTRAINT `historical_event_FK_1`
		FOREIGN KEY (`term_id`)
		REFERENCES `term` (`id`),
	INDEX `historical_event_FI_2` (`historical_event_type_id`),
	CONSTRAINT `historical_event_FK_2`
		FOREIGN KEY (`historical_event_type_id`)
		REFERENCES `term` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- function_description
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `function_description`;


CREATE TABLE `function_description`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`term_id` INTEGER  NOT NULL,
	`function_description_type_id` INTEGER,
	`classification` TEXT,
	`domain` TEXT,
	`dates` TEXT,
	`history` TEXT,
	`legislation` TEXT,
	`general_context` TEXT,
	`description_identifier` VARCHAR(255),
	`institution_identifier` VARCHAR(255),
	`rules` TEXT,
	`status_id` INTEGER,
	`level_id` INTEGER,
	`sources` TEXT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `function_description_FI_1` (`term_id`),
	CONSTRAINT `function_description_FK_1`
		FOREIGN KEY (`term_id`)
		REFERENCES `term` (`id`),
	INDEX `function_description_FI_2` (`function_description_type_id`),
	CONSTRAINT `function_description_FK_2`
		FOREIGN KEY (`function_description_type_id`)
		REFERENCES `term` (`id`),
	INDEX `function_description_FI_3` (`status_id`),
	CONSTRAINT `function_description_FK_3`
		FOREIGN KEY (`status_id`)
		REFERENCES `term` (`id`),
	INDEX `function_description_FI_4` (`level_id`),
	CONSTRAINT `function_description_FK_4`
		FOREIGN KEY (`level_id`)
		REFERENCES `term` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- right
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `right`;


CREATE TABLE `right`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`information_object_id` INTEGER  NOT NULL,
	`digital_object_id` INTEGER  NOT NULL,
	`physical_object_id` INTEGER  NOT NULL,
	`permission_id` INTEGER,
	`description` TEXT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `right_FI_1` (`information_object_id`),
	CONSTRAINT `right_FK_1`
		FOREIGN KEY (`information_object_id`)
		REFERENCES `information_object` (`id`),
	INDEX `right_FI_2` (`digital_object_id`),
	CONSTRAINT `right_FK_2`
		FOREIGN KEY (`digital_object_id`)
		REFERENCES `digital_object` (`id`),
	INDEX `right_FI_3` (`physical_object_id`),
	CONSTRAINT `right_FK_3`
		FOREIGN KEY (`physical_object_id`)
		REFERENCES `physical_object` (`id`),
	INDEX `right_FI_4` (`permission_id`),
	CONSTRAINT `right_FK_4`
		FOREIGN KEY (`permission_id`)
		REFERENCES `term` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- right_term_relationship
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `right_term_relationship`;


CREATE TABLE `right_term_relationship`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`right_id` INTEGER  NOT NULL,
	`term_id` INTEGER  NOT NULL,
	`relationship_type_id` INTEGER,
	`description` TEXT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `right_term_relationship_FI_1` (`right_id`),
	CONSTRAINT `right_term_relationship_FK_1`
		FOREIGN KEY (`right_id`)
		REFERENCES `right` (`id`),
	INDEX `right_term_relationship_FI_2` (`term_id`),
	CONSTRAINT `right_term_relationship_FK_2`
		FOREIGN KEY (`term_id`)
		REFERENCES `term` (`id`),
	INDEX `right_term_relationship_FI_3` (`relationship_type_id`),
	CONSTRAINT `right_term_relationship_FK_3`
		FOREIGN KEY (`relationship_type_id`)
		REFERENCES `term` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- right_actor_relationship
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `right_actor_relationship`;


CREATE TABLE `right_actor_relationship`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`right_id` INTEGER  NOT NULL,
	`actor_id` INTEGER  NOT NULL,
	`relationship_type_id` INTEGER,
	`description` TEXT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `right_actor_relationship_FI_1` (`right_id`),
	CONSTRAINT `right_actor_relationship_FK_1`
		FOREIGN KEY (`right_id`)
		REFERENCES `right` (`id`),
	INDEX `right_actor_relationship_FI_2` (`actor_id`),
	CONSTRAINT `right_actor_relationship_FK_2`
		FOREIGN KEY (`actor_id`)
		REFERENCES `actor` (`id`),
	INDEX `right_actor_relationship_FI_3` (`relationship_type_id`),
	CONSTRAINT `right_actor_relationship_FK_3`
		FOREIGN KEY (`relationship_type_id`)
		REFERENCES `term` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- menu
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `menu`;


CREATE TABLE `menu`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(100),
	`url` VARCHAR(255),
	`tree_id` INTEGER,
	`tree_left_id` INTEGER,
	`tree_right_id` INTEGER,
	`tree_parent_id` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- static_page
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `static_page`;


CREATE TABLE `static_page`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(255),
	`permalink` VARCHAR(255),
	`page_content` TEXT,
	`stylesheet` VARCHAR(255),
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- user
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `user`;


CREATE TABLE `user`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`user_name` VARCHAR(50),
	`email` VARCHAR(100),
	`sha1_password` VARCHAR(40),
	`salt` VARCHAR(32),
	`actor_id` INTEGER  NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `user_FI_1` (`actor_id`),
	CONSTRAINT `user_FK_1`
		FOREIGN KEY (`actor_id`)
		REFERENCES `actor` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- user_term_relationship
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `user_term_relationship`;


CREATE TABLE `user_term_relationship`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER  NOT NULL,
	`term_id` INTEGER  NOT NULL,
	`relationship_type_id` INTEGER,
	`repository_id` INTEGER  NOT NULL,
	`description` TEXT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `user_term_relationship_FI_1` (`user_id`),
	CONSTRAINT `user_term_relationship_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`),
	INDEX `user_term_relationship_FI_2` (`term_id`),
	CONSTRAINT `user_term_relationship_FK_2`
		FOREIGN KEY (`term_id`)
		REFERENCES `term` (`id`),
	INDEX `user_term_relationship_FI_3` (`relationship_type_id`),
	CONSTRAINT `user_term_relationship_FK_3`
		FOREIGN KEY (`relationship_type_id`)
		REFERENCES `term` (`id`),
	INDEX `user_term_relationship_FI_4` (`repository_id`),
	CONSTRAINT `user_term_relationship_FK_4`
		FOREIGN KEY (`repository_id`)
		REFERENCES `repository` (`id`)
)Type=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
