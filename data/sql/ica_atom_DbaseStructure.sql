-- phpMyAdmin SQL Dump
-- version 2.8.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Oct 23, 2007 at 04:29 PM
-- Server version: 5.0.22
-- PHP Version: 5.2.0

SET FOREIGN_KEY_CHECKS=0;
-- 
-- Database: `ica_atom`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `actor`
-- 

CREATE TABLE `actor` (
  `id` int(11) NOT NULL auto_increment,
  `authorized_form_of_name` varchar(255) collate utf8_unicode_ci NOT NULL,
  `type_of_entity_id` int(11) default NULL,
  `identifiers` varchar(255) collate utf8_unicode_ci default NULL,
  `history` text collate utf8_unicode_ci,
  `legal_status` text collate utf8_unicode_ci,
  `functions` text collate utf8_unicode_ci,
  `mandates` text collate utf8_unicode_ci,
  `internal_structures` text collate utf8_unicode_ci,
  `general_context` text collate utf8_unicode_ci,
  `authority_record_identifier` varchar(255) collate utf8_unicode_ci default NULL,
  `institution_identifier` varchar(255) collate utf8_unicode_ci default NULL,
  `rules` text collate utf8_unicode_ci,
  `status_id` int(11) default NULL,
  `level_of_detail_id` int(11) default NULL,
  `sources` text collate utf8_unicode_ci,
  `tree_id` int(11) default NULL,
  `tree_left_id` int(11) default NULL,
  `tree_right_id` int(11) default NULL,
  `tree_parent_id` int(11) default NULL,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `actor_FI_1` (`type_of_entity_id`),
  KEY `actor_FI_2` (`status_id`),
  KEY `actor_FI_3` (`level_of_detail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `actor_name`
-- 

CREATE TABLE `actor_name` (
  `id` int(11) NOT NULL auto_increment,
  `actor_id` int(11) default NULL,
  `name` varchar(255) collate utf8_unicode_ci default NULL,
  `name_type_id` int(11) default NULL,
  `name_note` varchar(255) collate utf8_unicode_ci default NULL,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `actor_name_FI_1` (`actor_id`),
  KEY `actor_name_FI_2` (`name_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `actor_recursive_relationship`
-- 

CREATE TABLE `actor_recursive_relationship` (
  `id` int(11) NOT NULL auto_increment,
  `actor_id` int(11) default NULL,
  `related_actor_id` int(11) default NULL,
  `relationship_type_id` int(11) default NULL,
  `relationship_description` text collate utf8_unicode_ci,
  `relationship_start_date` date default NULL,
  `relationship_end_date` date default NULL,
  `date_display` varchar(255) collate utf8_unicode_ci default NULL,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `actor_recursive_relationship_FI_1` (`actor_id`),
  KEY `actor_recursive_relationship_FI_2` (`related_actor_id`),
  KEY `actor_recursive_relationship_FI_3` (`relationship_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `actor_term_relationship`
-- 

CREATE TABLE `actor_term_relationship` (
  `id` int(11) NOT NULL auto_increment,
  `actor_id` int(11) default NULL,
  `term_id` int(11) default NULL,
  `relationship_type_id` int(11) default NULL,
  `relationship_note` text collate utf8_unicode_ci,
  `relationship_start_date` date default NULL,
  `relationship_end_date` date default NULL,
  `date_display` varchar(255) collate utf8_unicode_ci default NULL,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `actor_term_relationship_FI_1` (`actor_id`),
  KEY `actor_term_relationship_FI_2` (`term_id`),
  KEY `actor_term_relationship_FI_3` (`relationship_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `contact_information`
-- 

CREATE TABLE `contact_information` (
  `id` int(11) NOT NULL auto_increment,
  `actor_id` int(11) default NULL,
  `contact_type` varchar(255) collate utf8_unicode_ci default NULL,
  `primary_contact` int(11) default NULL,
  `street_address` text collate utf8_unicode_ci,
  `city` varchar(255) collate utf8_unicode_ci default NULL,
  `region` varchar(255) collate utf8_unicode_ci default NULL,
  `postal_code` varchar(20) collate utf8_unicode_ci default NULL,
  `country_id` int(11) default NULL,
  `longtitude` float default NULL,
  `latitude` float default NULL,
  `telephone` varchar(255) collate utf8_unicode_ci default NULL,
  `fax` varchar(255) collate utf8_unicode_ci default NULL,
  `website` varchar(255) collate utf8_unicode_ci default NULL,
  `email` varchar(255) collate utf8_unicode_ci default NULL,
  `note` text collate utf8_unicode_ci,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `contact_information_FI_1` (`actor_id`),
  KEY `contact_information_FI_2` (`country_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `digital_object`
-- 

CREATE TABLE `digital_object` (
  `id` int(11) NOT NULL auto_increment,
  `information_object_id` int(11) default NULL,
  `useage_id` int(11) default NULL,
  `name` varchar(255) collate utf8_unicode_ci default NULL,
  `description` text collate utf8_unicode_ci,
  `mime_type_id` int(11) default NULL,
  `media_type_id` int(11) default NULL,
  `sequence` int(11) default NULL,
  `byte_size` int(11) default NULL,
  `checksum` varchar(100) collate utf8_unicode_ci default NULL,
  `checksum_type_id` int(11) default NULL,
  `location_id` int(11) default NULL,
  `tree_id` int(11) default NULL,
  `tree_left_id` int(11) default NULL,
  `tree_right_id` int(11) default NULL,
  `tree_parent_id` int(11) default NULL,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `digital_object_FI_1` (`information_object_id`),
  KEY `digital_object_FI_2` (`useage_id`),
  KEY `digital_object_FI_3` (`mime_type_id`),
  KEY `digital_object_FI_4` (`media_type_id`),
  KEY `digital_object_FI_5` (`checksum_type_id`),
  KEY `digital_object_FI_6` (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `digital_object_metadata`
-- 

CREATE TABLE `digital_object_metadata` (
  `id` int(11) NOT NULL auto_increment,
  `digital_object_id` int(11) default NULL,
  `element` varchar(255) collate utf8_unicode_ci default NULL,
  `value` text collate utf8_unicode_ci,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `digital_object_metadata_FI_1` (`digital_object_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `digital_object_recursive_relationship`
-- 

CREATE TABLE `digital_object_recursive_relationship` (
  `id` int(11) NOT NULL auto_increment,
  `digital_object_id` int(11) default NULL,
  `related_digital_object_id` int(11) default NULL,
  `relationship_type_id` int(11) default NULL,
  `relationship_description` text collate utf8_unicode_ci,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `digital_object_recursive_relationship_FI_1` (`digital_object_id`),
  KEY `digital_object_recursive_relationship_FI_2` (`related_digital_object_id`),
  KEY `digital_object_recursive_relationship_FI_3` (`relationship_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `event`
-- 

CREATE TABLE `event` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) collate utf8_unicode_ci default NULL,
  `description` text collate utf8_unicode_ci,
  `start_date` date default NULL,
  `start_time` time default NULL,
  `end_date` date default NULL,
  `end_time` time default NULL,
  `date_display` varchar(255) collate utf8_unicode_ci default NULL,
  `event_type_id` int(11) default NULL,
  `actor_role_id` int(11) default NULL,
  `information_object_id` int(11) default NULL,
  `actor_id` int(11) default NULL,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `event_FI_1` (`event_type_id`),
  KEY `event_FI_2` (`actor_role_id`),
  KEY `event_FI_3` (`information_object_id`),
  KEY `event_FI_4` (`actor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=50 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `event_term_relationship`
-- 

CREATE TABLE `event_term_relationship` (
  `id` int(11) NOT NULL auto_increment,
  `event_id` int(11) default NULL,
  `term_id` int(11) default NULL,
  `relationship_type_id` int(11) default NULL,
  `description` text collate utf8_unicode_ci,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `event_term_relationship_FI_1` (`event_id`),
  KEY `event_term_relationship_FI_2` (`term_id`),
  KEY `event_term_relationship_FI_3` (`relationship_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `function_description`
-- 

CREATE TABLE `function_description` (
  `id` int(11) NOT NULL auto_increment,
  `term_id` int(11) default NULL,
  `function_description_type_id` int(11) default NULL,
  `classification` text collate utf8_unicode_ci,
  `domain` text collate utf8_unicode_ci,
  `dates` text collate utf8_unicode_ci,
  `history` text collate utf8_unicode_ci,
  `legislation` text collate utf8_unicode_ci,
  `general_context` text collate utf8_unicode_ci,
  `description_identifier` varchar(255) collate utf8_unicode_ci default NULL,
  `institution_identifier` varchar(255) collate utf8_unicode_ci default NULL,
  `rules` text collate utf8_unicode_ci,
  `status_id` int(11) default NULL,
  `level_id` int(11) default NULL,
  `sources` text collate utf8_unicode_ci,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `function_description_FI_1` (`term_id`),
  KEY `function_description_FI_2` (`function_description_type_id`),
  KEY `function_description_FI_3` (`status_id`),
  KEY `function_description_FI_4` (`level_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `historical_event`
-- 

CREATE TABLE `historical_event` (
  `id` int(11) NOT NULL auto_increment,
  `term_id` int(11) default NULL,
  `historical_event_type_id` int(11) default NULL,
  `start_date` date default NULL,
  `start_time` time default NULL,
  `end_date` date default NULL,
  `end_time` time default NULL,
  `date_display` varchar(255) collate utf8_unicode_ci default NULL,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `historical_event_FI_1` (`term_id`),
  KEY `historical_event_FI_2` (`historical_event_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `information_object`
-- 

CREATE TABLE `information_object` (
  `id` int(11) NOT NULL auto_increment,
  `identifier` varchar(255) collate utf8_unicode_ci default NULL,
  `title` varchar(255) collate utf8_unicode_ci default NULL,
  `alternateTitle` varchar(255) collate utf8_unicode_ci default NULL,
  `version` varchar(255) collate utf8_unicode_ci default NULL,
  `level_of_description_id` int(11) default NULL,
  `extent_and_medium` text collate utf8_unicode_ci,
  `archival_history` text collate utf8_unicode_ci,
  `acquisition` text collate utf8_unicode_ci,
  `scope_and_content` text collate utf8_unicode_ci,
  `appraisal` text collate utf8_unicode_ci,
  `accruals` text collate utf8_unicode_ci,
  `arrangement` text collate utf8_unicode_ci,
  `access_conditions` text collate utf8_unicode_ci,
  `reproduction_conditions` text collate utf8_unicode_ci,
  `physical_characteristics` text collate utf8_unicode_ci,
  `finding_aids` text collate utf8_unicode_ci,
  `location_of_originals` text collate utf8_unicode_ci,
  `location_of_copies` text collate utf8_unicode_ci,
  `related_units_of_description` text collate utf8_unicode_ci,
  `rules` text collate utf8_unicode_ci,
  `collection_type_id` int(11) default NULL,
  `repository_id` int(11) default NULL,
  `tree_id` int(11) default NULL,
  `tree_left_id` int(11) default NULL,
  `tree_right_id` int(11) default NULL,
  `tree_parent_id` int(11) default NULL,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `information_object_FI_1` (`level_of_description_id`),
  KEY `information_object_FI_2` (`collection_type_id`),
  KEY `information_object_FI_3` (`repository_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=36 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `information_object_recursive_relationship`
-- 

CREATE TABLE `information_object_recursive_relationship` (
  `id` int(11) NOT NULL auto_increment,
  `information_object_id` int(11) default NULL,
  `related_information_object_id` int(11) default NULL,
  `relationship_type_id` int(11) default NULL,
  `relationship_description` text collate utf8_unicode_ci,
  `relationship_start_date` date default NULL,
  `relationship_end_date` date default NULL,
  `date_display` varchar(255) collate utf8_unicode_ci default NULL,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `information_object_recursive_relationship_FI_1` (`information_object_id`),
  KEY `information_object_recursive_relationship_FI_2` (`related_information_object_id`),
  KEY `information_object_recursive_relationship_FI_3` (`relationship_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `information_object_term_relationship`
-- 

CREATE TABLE `information_object_term_relationship` (
  `id` int(11) NOT NULL auto_increment,
  `information_object_id` int(11) default NULL,
  `term_id` int(11) default NULL,
  `relationship_type_id` int(11) default NULL,
  `relationship_note` text collate utf8_unicode_ci,
  `relationship_start_date` date default NULL,
  `relationship_end_date` date default NULL,
  `date_display` varchar(255) collate utf8_unicode_ci default NULL,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `information_object_term_relationship_FI_1` (`information_object_id`),
  KEY `information_object_term_relationship_FI_2` (`term_id`),
  KEY `information_object_term_relationship_FI_3` (`relationship_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=31 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `map`
-- 

CREATE TABLE `map` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) collate utf8_unicode_ci default NULL,
  `description` text collate utf8_unicode_ci,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `menu`
-- 

CREATE TABLE `menu` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) collate utf8_unicode_ci default NULL,
  `url` varchar(255) collate utf8_unicode_ci default NULL,
  `tree_id` int(11) default NULL,
  `tree_left_id` int(11) default NULL,
  `tree_right_id` int(11) default NULL,
  `tree_parent_id` int(11) default NULL,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `note`
-- 

CREATE TABLE `note` (
  `id` int(11) NOT NULL auto_increment,
  `information_object_id` int(11) default NULL,
  `actor_id` int(11) default NULL,
  `repository_id` int(11) default NULL,
  `function_description_id` int(11) default NULL,
  `note` text collate utf8_unicode_ci,
  `note_type_id` int(11) default NULL,
  `user_id` int(11) default NULL,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `note_FI_1` (`information_object_id`),
  KEY `note_FI_2` (`actor_id`),
  KEY `note_FI_3` (`repository_id`),
  KEY `note_FI_4` (`function_description_id`),
  KEY `note_FI_5` (`note_type_id`),
  KEY `note_FI_6` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `physical_object`
-- 

CREATE TABLE `physical_object` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) collate utf8_unicode_ci default NULL,
  `description` text collate utf8_unicode_ci,
  `information_object_id` int(11) default NULL,
  `location_id` int(11) default NULL,
  `tree_id` int(11) default NULL,
  `tree_left_id` int(11) default NULL,
  `tree_right_id` int(11) default NULL,
  `tree_parent_id` int(11) default NULL,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `physical_object_FI_1` (`information_object_id`),
  KEY `physical_object_FI_2` (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `place`
-- 

CREATE TABLE `place` (
  `id` int(11) NOT NULL auto_increment,
  `term_id` int(11) default NULL,
  `address` text collate utf8_unicode_ci,
  `country_id` int(11) default NULL,
  `place_type_id` int(11) default NULL,
  `longtitude` float default NULL,
  `latitude` float default NULL,
  `altitude` float default NULL,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `place_FI_1` (`term_id`),
  KEY `place_FI_2` (`country_id`),
  KEY `place_FI_3` (`place_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `place_map_relationship`
-- 

CREATE TABLE `place_map_relationship` (
  `id` int(11) NOT NULL auto_increment,
  `place_id` int(11) default NULL,
  `map_id` int(11) default NULL,
  `map_icon_image_id` int(11) default NULL,
  `map_icon_description` text collate utf8_unicode_ci,
  `relationship_type_id` int(11) default NULL,
  `relationship_note` text collate utf8_unicode_ci,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `place_map_relationship_FI_1` (`place_id`),
  KEY `place_map_relationship_FI_2` (`map_id`),
  KEY `place_map_relationship_FI_3` (`map_icon_image_id`),
  KEY `place_map_relationship_FI_4` (`relationship_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `repository`
-- 

CREATE TABLE `repository` (
  `id` int(11) NOT NULL auto_increment,
  `actor_id` int(11) default NULL,
  `identifier` varchar(255) collate utf8_unicode_ci default NULL,
  `repository_type_id` int(11) default NULL,
  `officers_in_charge` text collate utf8_unicode_ci,
  `geocultural_context` text collate utf8_unicode_ci,
  `collecting_policies` text collate utf8_unicode_ci,
  `buildings` text collate utf8_unicode_ci,
  `holdings` text collate utf8_unicode_ci,
  `finding_aids` text collate utf8_unicode_ci,
  `opening_times` text collate utf8_unicode_ci,
  `access_conditions` text collate utf8_unicode_ci,
  `disabled_access` text collate utf8_unicode_ci,
  `transport` text collate utf8_unicode_ci,
  `research_services` text collate utf8_unicode_ci,
  `reproduction_services` text collate utf8_unicode_ci,
  `public_facilities` text collate utf8_unicode_ci,
  `description_identifier` varchar(255) collate utf8_unicode_ci default NULL,
  `institution_identifier` varchar(255) collate utf8_unicode_ci default NULL,
  `rules` text collate utf8_unicode_ci,
  `status_id` int(11) default NULL,
  `level_of_detail_id` int(11) default NULL,
  `sources` text collate utf8_unicode_ci,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `repository_FI_1` (`actor_id`),
  KEY `repository_FI_2` (`repository_type_id`),
  KEY `repository_FI_3` (`status_id`),
  KEY `repository_FI_4` (`level_of_detail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `repository_term_relationship`
-- 

CREATE TABLE `repository_term_relationship` (
  `id` int(11) NOT NULL auto_increment,
  `repository_id` int(11) default NULL,
  `term_id` int(11) default NULL,
  `relationship_type_id` int(11) default NULL,
  `relationship_note` text collate utf8_unicode_ci,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `repository_term_relationship_FI_1` (`repository_id`),
  KEY `repository_term_relationship_FI_2` (`term_id`),
  KEY `repository_term_relationship_FI_3` (`relationship_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `right`
-- 

CREATE TABLE `right` (
  `id` int(11) NOT NULL auto_increment,
  `information_object_id` int(11) default NULL,
  `digital_object_id` int(11) default NULL,
  `physical_object_id` int(11) default NULL,
  `permission_id` int(11) default NULL,
  `description` text collate utf8_unicode_ci,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `right_FI_1` (`information_object_id`),
  KEY `right_FI_2` (`digital_object_id`),
  KEY `right_FI_3` (`physical_object_id`),
  KEY `right_FI_4` (`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `right_actor_relationship`
-- 

CREATE TABLE `right_actor_relationship` (
  `id` int(11) NOT NULL auto_increment,
  `right_id` int(11) default NULL,
  `actor_id` int(11) default NULL,
  `relationship_type_id` int(11) default NULL,
  `description` text collate utf8_unicode_ci,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `right_actor_relationship_FI_1` (`right_id`),
  KEY `right_actor_relationship_FI_2` (`actor_id`),
  KEY `right_actor_relationship_FI_3` (`relationship_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `right_term_relationship`
-- 

CREATE TABLE `right_term_relationship` (
  `id` int(11) NOT NULL auto_increment,
  `right_id` int(11) default NULL,
  `term_id` int(11) default NULL,
  `relationship_type_id` int(11) default NULL,
  `description` text collate utf8_unicode_ci,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `right_term_relationship_FI_1` (`right_id`),
  KEY `right_term_relationship_FI_2` (`term_id`),
  KEY `right_term_relationship_FI_3` (`relationship_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `static_page`
-- 

CREATE TABLE `static_page` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) collate utf8_unicode_ci default NULL,
  `permalink` varchar(255) collate utf8_unicode_ci default NULL,
  `page_content` text collate utf8_unicode_ci,
  `stylesheet` varchar(255) collate utf8_unicode_ci default NULL,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `unique_permalink` (`permalink`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `system_event`
-- 

CREATE TABLE `system_event` (
  `id` int(11) NOT NULL auto_increment,
  `system_event_type_id` int(11) default NULL,
  `object_class` varchar(255) collate utf8_unicode_ci default NULL,
  `object_id` int(11) default NULL,
  `pre_event_snapshot` text collate utf8_unicode_ci,
  `post_event_snapshot` text collate utf8_unicode_ci,
  `date` datetime default NULL,
  `user_name` varchar(255) collate utf8_unicode_ci default NULL,
  `user_id` int(11) default NULL,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `system_event_FI_1` (`system_event_type_id`),
  KEY `system_event_FI_2` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `taxonomy`
-- 

CREATE TABLE `taxonomy` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) collate utf8_unicode_ci default NULL,
  `term_use` varchar(5) collate utf8_unicode_ci default NULL,
  `note` text collate utf8_unicode_ci,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=27 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `term`
-- 

CREATE TABLE `term` (
  `id` int(11) NOT NULL auto_increment,
  `taxonomy_id` int(11) default NULL,
  `term_name` varchar(255) collate utf8_unicode_ci default NULL,
  `scope_note` text collate utf8_unicode_ci,
  `code_alpha` varchar(5) collate utf8_unicode_ci default NULL,
  `code_alpha2` varchar(5) collate utf8_unicode_ci default NULL,
  `code_numeric` int(11) default NULL,
  `sort_order` int(11) default NULL,
  `source` varchar(255) collate utf8_unicode_ci default NULL,
  `locked` int(11) default NULL,
  `tree_id` int(11) default NULL,
  `tree_left_id` int(11) default NULL,
  `tree_right_id` int(11) default NULL,
  `tree_parent_id` int(11) default NULL,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `term_FI_1` (`taxonomy_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=354 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `term_recursive_relationship`
-- 

CREATE TABLE `term_recursive_relationship` (
  `id` int(11) NOT NULL auto_increment,
  `term_id` int(11) default NULL,
  `related_term_id` int(11) default NULL,
  `relationship_type_id` int(11) default NULL,
  `relationship_description` varchar(255) collate utf8_unicode_ci default NULL,
  `relationship_start_date` date default NULL,
  `relationship_end_date` date default NULL,
  `date_display` varchar(255) collate utf8_unicode_ci default NULL,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `term_recursive_relationship_FI_1` (`term_id`),
  KEY `term_recursive_relationship_FI_2` (`related_term_id`),
  KEY `term_recursive_relationship_FI_3` (`relationship_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `user`
-- 

CREATE TABLE `user` (
  `id` int(11) NOT NULL auto_increment,
  `user_name` varchar(50) collate utf8_unicode_ci default NULL,
  `email` varchar(100) collate utf8_unicode_ci default NULL,
  `sha1_password` varchar(40) collate utf8_unicode_ci default NULL,
  `salt` varchar(32) collate utf8_unicode_ci default NULL,
  `actor_id` int(11) default NULL,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `user_FI_1` (`actor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `user_term_relationship`
-- 

CREATE TABLE `user_term_relationship` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) default NULL,
  `term_id` int(11) default NULL,
  `relationship_type_id` int(11) default NULL,
  `repository_id` int(11) default NULL,
  `description` text collate utf8_unicode_ci,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `user_term_relationship_FI_1` (`user_id`),
  KEY `user_term_relationship_FI_2` (`term_id`),
  KEY `user_term_relationship_FI_3` (`relationship_type_id`),
  KEY `user_term_relationship_FI_4` (`repository_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;

-- 
-- Constraints for dumped tables
-- 

-- 
-- Constraints for table `actor`
-- 
ALTER TABLE `actor`
  ADD CONSTRAINT `actor_FK_1` FOREIGN KEY (`type_of_entity_id`) REFERENCES `term` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `actor_FK_2` FOREIGN KEY (`status_id`) REFERENCES `term` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `actor_FK_3` FOREIGN KEY (`level_of_detail_id`) REFERENCES `term` (`id`) ON DELETE SET NULL;

-- 
-- Constraints for table `actor_name`
-- 
ALTER TABLE `actor_name`
  ADD CONSTRAINT `actor_name_FK_1` FOREIGN KEY (`actor_id`) REFERENCES `actor` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `actor_name_FK_2` FOREIGN KEY (`name_type_id`) REFERENCES `term` (`id`) ON DELETE SET NULL;

-- 
-- Constraints for table `actor_recursive_relationship`
-- 
ALTER TABLE `actor_recursive_relationship`
  ADD CONSTRAINT `actor_recursive_relationship_FK_1` FOREIGN KEY (`actor_id`) REFERENCES `actor` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `actor_recursive_relationship_FK_2` FOREIGN KEY (`related_actor_id`) REFERENCES `actor` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `actor_recursive_relationship_FK_3` FOREIGN KEY (`relationship_type_id`) REFERENCES `term` (`id`);

-- 
-- Constraints for table `actor_term_relationship`
-- 
ALTER TABLE `actor_term_relationship`
  ADD CONSTRAINT `actor_term_relationship_FK_1` FOREIGN KEY (`actor_id`) REFERENCES `actor` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `actor_term_relationship_FK_2` FOREIGN KEY (`term_id`) REFERENCES `term` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `actor_term_relationship_FK_3` FOREIGN KEY (`relationship_type_id`) REFERENCES `term` (`id`);

-- 
-- Constraints for table `contact_information`
-- 
ALTER TABLE `contact_information`
  ADD CONSTRAINT `contact_information_FK_1` FOREIGN KEY (`actor_id`) REFERENCES `actor` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `contact_information_FK_2` FOREIGN KEY (`country_id`) REFERENCES `term` (`id`) ON DELETE SET NULL;

-- 
-- Constraints for table `digital_object`
-- 
ALTER TABLE `digital_object`
  ADD CONSTRAINT `digital_object_FK_1` FOREIGN KEY (`information_object_id`) REFERENCES `information_object` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `digital_object_FK_2` FOREIGN KEY (`useage_id`) REFERENCES `term` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `digital_object_FK_3` FOREIGN KEY (`mime_type_id`) REFERENCES `term` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `digital_object_FK_4` FOREIGN KEY (`media_type_id`) REFERENCES `term` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `digital_object_FK_5` FOREIGN KEY (`checksum_type_id`) REFERENCES `term` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `digital_object_FK_6` FOREIGN KEY (`location_id`) REFERENCES `term` (`id`) ON DELETE SET NULL;

-- 
-- Constraints for table `digital_object_metadata`
-- 
ALTER TABLE `digital_object_metadata`
  ADD CONSTRAINT `digital_object_metadata_FK_1` FOREIGN KEY (`digital_object_id`) REFERENCES `digital_object` (`id`) ON DELETE CASCADE;

-- 
-- Constraints for table `digital_object_recursive_relationship`
-- 
ALTER TABLE `digital_object_recursive_relationship`
  ADD CONSTRAINT `digital_object_recursive_relationship_FK_1` FOREIGN KEY (`digital_object_id`) REFERENCES `digital_object` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `digital_object_recursive_relationship_FK_2` FOREIGN KEY (`related_digital_object_id`) REFERENCES `digital_object` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `digital_object_recursive_relationship_FK_3` FOREIGN KEY (`relationship_type_id`) REFERENCES `term` (`id`);

-- 
-- Constraints for table `event`
-- 
ALTER TABLE `event`
  ADD CONSTRAINT `event_FK_1` FOREIGN KEY (`event_type_id`) REFERENCES `term` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `event_FK_2` FOREIGN KEY (`actor_role_id`) REFERENCES `term` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `event_FK_3` FOREIGN KEY (`information_object_id`) REFERENCES `information_object` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `event_FK_4` FOREIGN KEY (`actor_id`) REFERENCES `actor` (`id`) ON DELETE CASCADE;

-- 
-- Constraints for table `event_term_relationship`
-- 
ALTER TABLE `event_term_relationship`
  ADD CONSTRAINT `event_term_relationship_FK_1` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `event_term_relationship_FK_2` FOREIGN KEY (`term_id`) REFERENCES `term` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `event_term_relationship_FK_3` FOREIGN KEY (`relationship_type_id`) REFERENCES `term` (`id`);

-- 
-- Constraints for table `function_description`
-- 
ALTER TABLE `function_description`
  ADD CONSTRAINT `function_description_FK_1` FOREIGN KEY (`term_id`) REFERENCES `term` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `function_description_FK_2` FOREIGN KEY (`function_description_type_id`) REFERENCES `term` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `function_description_FK_3` FOREIGN KEY (`status_id`) REFERENCES `term` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `function_description_FK_4` FOREIGN KEY (`level_id`) REFERENCES `term` (`id`) ON DELETE SET NULL;

-- 
-- Constraints for table `historical_event`
-- 
ALTER TABLE `historical_event`
  ADD CONSTRAINT `historical_event_FK_1` FOREIGN KEY (`term_id`) REFERENCES `term` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `historical_event_FK_2` FOREIGN KEY (`historical_event_type_id`) REFERENCES `term` (`id`) ON DELETE CASCADE;

-- 
-- Constraints for table `information_object`
-- 
ALTER TABLE `information_object`
  ADD CONSTRAINT `information_object_FK_1` FOREIGN KEY (`level_of_description_id`) REFERENCES `term` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `information_object_FK_2` FOREIGN KEY (`collection_type_id`) REFERENCES `term` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `information_object_FK_3` FOREIGN KEY (`repository_id`) REFERENCES `repository` (`id`) ON DELETE SET NULL;

-- 
-- Constraints for table `information_object_recursive_relationship`
-- 
ALTER TABLE `information_object_recursive_relationship`
  ADD CONSTRAINT `information_object_recursive_relationship_FK_1` FOREIGN KEY (`information_object_id`) REFERENCES `information_object` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `information_object_recursive_relationship_FK_2` FOREIGN KEY (`related_information_object_id`) REFERENCES `information_object` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `information_object_recursive_relationship_FK_3` FOREIGN KEY (`relationship_type_id`) REFERENCES `term` (`id`);

-- 
-- Constraints for table `information_object_term_relationship`
-- 
ALTER TABLE `information_object_term_relationship`
  ADD CONSTRAINT `information_object_term_relationship_FK_1` FOREIGN KEY (`information_object_id`) REFERENCES `information_object` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `information_object_term_relationship_FK_2` FOREIGN KEY (`term_id`) REFERENCES `term` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `information_object_term_relationship_FK_3` FOREIGN KEY (`relationship_type_id`) REFERENCES `term` (`id`);

-- 
-- Constraints for table `note`
-- 
ALTER TABLE `note`
  ADD CONSTRAINT `note_FK_1` FOREIGN KEY (`information_object_id`) REFERENCES `information_object` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `note_FK_2` FOREIGN KEY (`actor_id`) REFERENCES `actor` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `note_FK_3` FOREIGN KEY (`repository_id`) REFERENCES `repository` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `note_FK_4` FOREIGN KEY (`function_description_id`) REFERENCES `function_description` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `note_FK_5` FOREIGN KEY (`note_type_id`) REFERENCES `term` (`id`),
  ADD CONSTRAINT `note_FK_6` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

-- 
-- Constraints for table `physical_object`
-- 
ALTER TABLE `physical_object`
  ADD CONSTRAINT `physical_object_FK_1` FOREIGN KEY (`information_object_id`) REFERENCES `information_object` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `physical_object_FK_2` FOREIGN KEY (`location_id`) REFERENCES `term` (`id`) ON DELETE SET NULL;

-- 
-- Constraints for table `place`
-- 
ALTER TABLE `place`
  ADD CONSTRAINT `place_FK_1` FOREIGN KEY (`term_id`) REFERENCES `term` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `place_FK_2` FOREIGN KEY (`country_id`) REFERENCES `term` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `place_FK_3` FOREIGN KEY (`place_type_id`) REFERENCES `term` (`id`) ON DELETE SET NULL;

-- 
-- Constraints for table `place_map_relationship`
-- 
ALTER TABLE `place_map_relationship`
  ADD CONSTRAINT `place_map_relationship_FK_1` FOREIGN KEY (`place_id`) REFERENCES `place` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `place_map_relationship_FK_2` FOREIGN KEY (`map_id`) REFERENCES `map` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `place_map_relationship_FK_3` FOREIGN KEY (`map_icon_image_id`) REFERENCES `digital_object` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `place_map_relationship_FK_4` FOREIGN KEY (`relationship_type_id`) REFERENCES `term` (`id`);

-- 
-- Constraints for table `repository`
-- 
ALTER TABLE `repository`
  ADD CONSTRAINT `repository_FK_1` FOREIGN KEY (`actor_id`) REFERENCES `actor` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `repository_FK_2` FOREIGN KEY (`repository_type_id`) REFERENCES `term` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `repository_FK_3` FOREIGN KEY (`status_id`) REFERENCES `term` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `repository_FK_4` FOREIGN KEY (`level_of_detail_id`) REFERENCES `term` (`id`) ON DELETE SET NULL;

-- 
-- Constraints for table `repository_term_relationship`
-- 
ALTER TABLE `repository_term_relationship`
  ADD CONSTRAINT `repository_term_relationship_FK_1` FOREIGN KEY (`repository_id`) REFERENCES `repository` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `repository_term_relationship_FK_2` FOREIGN KEY (`term_id`) REFERENCES `term` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `repository_term_relationship_FK_3` FOREIGN KEY (`relationship_type_id`) REFERENCES `term` (`id`);

-- 
-- Constraints for table `right`
-- 
ALTER TABLE `right`
  ADD CONSTRAINT `right_FK_1` FOREIGN KEY (`information_object_id`) REFERENCES `information_object` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `right_FK_2` FOREIGN KEY (`digital_object_id`) REFERENCES `digital_object` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `right_FK_3` FOREIGN KEY (`physical_object_id`) REFERENCES `physical_object` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `right_FK_4` FOREIGN KEY (`permission_id`) REFERENCES `term` (`id`) ON DELETE SET NULL;

-- 
-- Constraints for table `right_actor_relationship`
-- 
ALTER TABLE `right_actor_relationship`
  ADD CONSTRAINT `right_actor_relationship_FK_1` FOREIGN KEY (`right_id`) REFERENCES `right` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `right_actor_relationship_FK_2` FOREIGN KEY (`actor_id`) REFERENCES `term` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `right_actor_relationship_FK_3` FOREIGN KEY (`relationship_type_id`) REFERENCES `term` (`id`);

-- 
-- Constraints for table `right_term_relationship`
-- 
ALTER TABLE `right_term_relationship`
  ADD CONSTRAINT `right_term_relationship_FK_1` FOREIGN KEY (`right_id`) REFERENCES `right` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `right_term_relationship_FK_2` FOREIGN KEY (`term_id`) REFERENCES `term` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `right_term_relationship_FK_3` FOREIGN KEY (`relationship_type_id`) REFERENCES `term` (`id`);

-- 
-- Constraints for table `system_event`
-- 
ALTER TABLE `system_event`
  ADD CONSTRAINT `system_event_FK_1` FOREIGN KEY (`system_event_type_id`) REFERENCES `term` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `system_event_FK_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL;

-- 
-- Constraints for table `term`
-- 
ALTER TABLE `term`
  ADD CONSTRAINT `term_FK_1` FOREIGN KEY (`taxonomy_id`) REFERENCES `taxonomy` (`id`) ON DELETE CASCADE;

-- 
-- Constraints for table `term_recursive_relationship`
-- 
ALTER TABLE `term_recursive_relationship`
  ADD CONSTRAINT `term_recursive_relationship_FK_1` FOREIGN KEY (`term_id`) REFERENCES `term` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `term_recursive_relationship_FK_2` FOREIGN KEY (`related_term_id`) REFERENCES `term` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `term_recursive_relationship_FK_3` FOREIGN KEY (`relationship_type_id`) REFERENCES `term` (`id`);

-- 
-- Constraints for table `user`
-- 
ALTER TABLE `user`
  ADD CONSTRAINT `user_FK_1` FOREIGN KEY (`actor_id`) REFERENCES `actor` (`id`) ON DELETE SET NULL;

-- 
-- Constraints for table `user_term_relationship`
-- 
ALTER TABLE `user_term_relationship`
  ADD CONSTRAINT `user_term_relationship_FK_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_term_relationship_FK_2` FOREIGN KEY (`term_id`) REFERENCES `term` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_term_relationship_FK_3` FOREIGN KEY (`relationship_type_id`) REFERENCES `term` (`id`),
  ADD CONSTRAINT `user_term_relationship_FK_4` FOREIGN KEY (`repository_id`) REFERENCES `repository` (`id`) ON DELETE CASCADE;

SET FOREIGN_KEY_CHECKS=1;
