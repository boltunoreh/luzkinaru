--
-- Table structure for table `#__wysija_list`
--

CREATE TABLE IF NOT EXISTS `{$table_prefix}wysija_list` (
  `list_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `namekey` varchar(255) DEFAULT NULL,
  `description` text,
  `unsub_mail_id` int(10) unsigned NOT NULL DEFAULT '0',
  `welcome_mail_id` int(10) unsigned NOT NULL DEFAULT '0',
  `is_enabled` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `is_public` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `created_at` int(10) unsigned DEFAULT NULL,
  `ordering` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`list_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
