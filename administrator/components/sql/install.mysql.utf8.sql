/* Credential */
DROP TABLE IF EXISTS `#__hnauth_credential`;
CREATE TABLE IF NOT EXISTS `#__hnauth_credential` (
	`id` BIGINT(18) NOT NULL AUTO_INCREMENT,
	`code` VARCHAR(45) NOT NULL,
	`title` VARCHAR(100) NOT NULL,
	`uri` TEXT NOT NULL,
	`publickey` TEXT NOT NULL,
	`secretkey` TEXT NOT NULL,
	`obs` TEXT NULL,
	`created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`modified` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`published` TINYINT(1) NOT NULL DEFAULT '1',
    PRIMARY KEY (`id`),
  	UNIQUE KEY `unq_hnauth_credential_code` (`code`),
    INDEX `ind_hnauth_credential_code` (`code`),
    INDEX `ind_hnauth_credential_published` (`published`)
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB;
