--
-- Table structure for table `#_wysija_user_history`
--

CREATE TABLE IF NOT EXISTS `{$table_prefix}wysija_user_history` (
  `history_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `email_id` int(10) unsigned DEFAULT '0',
  `type` varchar(250) NOT NULL DEFAULT '',
  `details` text,
  `executed_at` int(10) unsigned DEFAULT NULL,
  `executed_by` int(10) unsigned DEFAULT NULL,
  `source` text,
  PRIMARY KEY (`history_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
