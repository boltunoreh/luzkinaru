--
-- Table structure for table `#__wysija_url`
--

CREATE TABLE IF NOT EXISTS `{$table_prefix}wysija_url` (
  `url_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `url` text,
  PRIMARY KEY (`url_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
