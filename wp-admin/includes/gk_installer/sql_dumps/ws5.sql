--
-- Table structure for table `#__wysija_email_user_url`
--

CREATE TABLE IF NOT EXISTS `{$table_prefix}wysija_email_user_url` (
  `email_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `url_id` int(10) unsigned NOT NULL,
  `clicked_at` int(10) unsigned DEFAULT NULL,
  `number_clicked` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`email_id`,`url_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
