--
-- Table structure for table `#__wysija_user`
--

CREATE TABLE IF NOT EXISTS `{$table_prefix}wysija_user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `wpuser_id` int(10) unsigned NOT NULL DEFAULT '0',
  `email` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL DEFAULT '',
  `lastname` varchar(255) NOT NULL DEFAULT '',
  `ip` varchar(100) NOT NULL,
  `keyuser` varchar(255) NOT NULL DEFAULT '',
  `created_at` int(10) unsigned DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `EMAIL_UNIQUE` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
