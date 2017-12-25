--
-- Table structure for table `#__wysija_email_user_stat`
--

CREATE TABLE IF NOT EXISTS `{$table_prefix}wysija_email_user_stat` (
  `user_id` int(10) unsigned NOT NULL,
  `email_id` int(10) unsigned NOT NULL,
  `sent_at` int(10) unsigned NOT NULL,
  `opened_at` int(10) unsigned DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`email_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
