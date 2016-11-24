CREATE TABLE IF NOT EXISTS `group` (
  `id` int(5) NOT NULL auto_increment,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(64) NOT NULL,
  `group_id` int(5) NOT NULL,
  `status` enum('active','inactive','suspended') NOT NULL DEFAULT 'inactive',
  `verify_code` varchar(8) DEFAULT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(250) DEFAULT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `auth_key` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`),
  FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;