/* Credential */
DROP TABLE IF EXISTS `#__hnauth_credential`;
CREATE TABLE IF NOT EXISTS `#__hnauth_credential` (
	`id` BIGINT(18) NOT NULL AUTO_INCREMENT,
	`template` ENUM('moodle') NOT NULL,
	`usergroupid` BIGINT(18) NOT NULL,
	`authname` VARCHAR(25) NOT NULL,
	`title` VARCHAR(100) NOT NULL,
	`uri` TEXT NOT NULL,
	`publickey` TEXT NOT NULL,
	`secretkey` TEXT NOT NULL,
	`ttl` BIGINT(18) NOT NULL DEFAULT 30,
	`algorithm` VARCHAR(10) NOT NULL DEFAULT 'HS256',
	`behaviors` TEXT NULL,
	`obs` TEXT NULL,
	`created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`modified` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`published` TINYINT(1) NOT NULL DEFAULT '1',
    PRIMARY KEY (`id`),
    INDEX `ind_hnauth_credential_template` (`template`),
    INDEX `ind_hnauth_credential_usergroupid` (`usergroupid`),
    INDEX `ind_hnauth_credential_authname` (`authname`),
  	UNIQUE `unq_hnauth_credential_authname` (`authname`),
    INDEX `ind_hnauth_credential_published` (`published`)
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB;

/* Fist Register */
INSERT INTO `#__hnauth_credential` (
	`id`,
	`template`,
	`usergroupid`,
	`authname`,
	`title`,
	`uri`,
	`publickey`,
	`secretkey`,
	`behaviors`,
	`obs`,
	`published`
) VALUES (
	/* id */ 1,
	/* template */ 'moodle',
	/* usergroupid */ 1,
	/* authname */ 'moodle',
	/* title */ 'Moodle',
	/* uri */ 'http://example.com/:token',
	/* publickey */ 'publickey',
	/* secretkey */ 'secretkey',
	/* behaviors */ '{"fields":{"city":"joomla-field-city"},"template":{"user":"user","groups":"groups","attach":{"roles":["student"]}}}',
	/* obs */ 'Simple Moodle Integration',
	/* published */ 0
);
