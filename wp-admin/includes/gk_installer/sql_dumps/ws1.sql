--
-- Table structure for table `#__wysija_campaign`
--

CREATE TABLE IF NOT EXISTS `{$table_prefix}wysija_campaign` (
  `campaign_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`campaign_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
