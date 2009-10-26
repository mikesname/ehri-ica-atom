
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- q_acl_action
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `q_acl_action`;


CREATE TABLE `q_acl_action`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`source_culture` VARCHAR(7)  NOT NULL,
	`serial_number` INTEGER  NOT NULL,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- q_acl_action_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `q_acl_action_i18n`;


CREATE TABLE `q_acl_action_i18n`
(
	`name` VARCHAR(255)  NOT NULL,
	`description` TEXT,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	`serial_number` INTEGER  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	UNIQUE KEY `q_acl_action_i18n_U_1` (`name`),
	CONSTRAINT `q_acl_action_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `q_acl_action` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- q_acl_group
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `q_acl_group`;


CREATE TABLE `q_acl_group`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`parent_id` INTEGER,
	`lft` INTEGER  NOT NULL,
	`rgt` INTEGER  NOT NULL,
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	`source_culture` VARCHAR(7)  NOT NULL,
	`serial_number` INTEGER  NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `q_acl_group_FI_1` (`parent_id`),
	CONSTRAINT `q_acl_group_FK_1`
		FOREIGN KEY (`parent_id`)
		REFERENCES `q_acl_group` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- q_acl_group_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `q_acl_group_i18n`;


CREATE TABLE `q_acl_group_i18n`
(
	`name` VARCHAR(255)  NOT NULL,
	`description` TEXT,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	`serial_number` INTEGER  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `q_acl_group_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `q_acl_group` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- q_acl_permission
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `q_acl_permission`;


CREATE TABLE `q_acl_permission`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER,
	`group_id` INTEGER,
	`object_id` INTEGER,
	`action_id` INTEGER  NOT NULL,
	`grant_deny` INTEGER default 0 NOT NULL,
	`conditional` TEXT,
	`constants` TEXT,
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	`serial_number` INTEGER  NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `q_acl_permission_FI_1` (`user_id`),
	CONSTRAINT `q_acl_permission_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `q_user` (`id`)
		ON DELETE CASCADE,
	INDEX `q_acl_permission_FI_2` (`group_id`),
	CONSTRAINT `q_acl_permission_FK_2`
		FOREIGN KEY (`group_id`)
		REFERENCES `q_acl_group` (`id`)
		ON DELETE CASCADE,
	INDEX `q_acl_permission_FI_3` (`object_id`),
	CONSTRAINT `q_acl_permission_FK_3`
		FOREIGN KEY (`object_id`)
		REFERENCES `q_object` (`id`)
		ON DELETE CASCADE,
	INDEX `q_acl_permission_FI_4` (`action_id`),
	CONSTRAINT `q_acl_permission_FK_4`
		FOREIGN KEY (`action_id`)
		REFERENCES `q_acl_action` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- q_acl_user_group
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `q_acl_user_group`;


CREATE TABLE `q_acl_user_group`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER  NOT NULL,
	`group_id` INTEGER  NOT NULL,
	`serial_number` INTEGER  NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `q_acl_user_group_FI_1` (`user_id`),
	CONSTRAINT `q_acl_user_group_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `q_user` (`id`)
		ON DELETE CASCADE,
	INDEX `q_acl_user_group_FI_2` (`group_id`),
	CONSTRAINT `q_acl_user_group_FK_2`
		FOREIGN KEY (`group_id`)
		REFERENCES `q_acl_group` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
