--
-- Table structure for table `#__wysija_url_mail`
--

CREATE TABLE IF NOT EXISTS `{$table_prefix}wysija_url_mail` (
  `email_id` int(11) NOT NULL AUTO_INCREMENT,
  `url_id` int(10) unsigned NOT NULL,
  `unique_clicked` int(10) unsigned NOT NULL DEFAULT '0',
  `total_clicked` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`email_id`,`url_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
