--
-- Table structure for table `#__wysija_user_list`
--

CREATE TABLE IF NOT EXISTS `{$table_prefix}wysija_user_list` (
  `list_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `sub_date` int(10) unsigned DEFAULT '0',
  `unsub_date` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`list_id`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
