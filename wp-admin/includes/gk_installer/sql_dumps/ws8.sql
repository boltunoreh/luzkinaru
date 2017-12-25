--
-- Table structure for table `#__wysija_queue`
--

CREATE TABLE IF NOT EXISTS `{$table_prefix}wysija_queue` (
  `user_id` int(10) unsigned NOT NULL,
  `email_id` int(10) unsigned NOT NULL,
  `send_at` int(10) unsigned NOT NULL DEFAULT '0',
  `priority` tinyint(4) NOT NULL DEFAULT '0',
  `number_try` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`email_id`),
  KEY `SENT_AT_INDEX` (`send_at`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
