--
-- Table structure for table `#__wysija_campaign_list`
--

CREATE TABLE IF NOT EXISTS `{$table_prefix}wysija_campaign_list` (
  `list_id` int(10) unsigned NOT NULL,
  `campaign_id` int(10) unsigned NOT NULL,
  `filter` text,
  PRIMARY KEY (`list_id`,`campaign_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
