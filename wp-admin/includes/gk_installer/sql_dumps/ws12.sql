--
-- Table structure for table `#__wysija_user_field`
--

CREATE TABLE IF NOT EXISTS `{$table_prefix}wysija_user_field` (
  `field_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `column_name` varchar(250) NOT NULL DEFAULT '',
  `type` tinyint(3) unsigned DEFAULT '0',
  `values` text,
  `default` varchar(250) NOT NULL DEFAULT '',
  `is_required` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `error_message` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`field_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
