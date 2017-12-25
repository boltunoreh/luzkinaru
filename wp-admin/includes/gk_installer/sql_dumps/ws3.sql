--
-- Table structure for table `#__wysija_email`
--

CREATE TABLE IF NOT EXISTS `{$table_prefix}wysija_email` (
  `email_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `campaign_id` int(10) unsigned NOT NULL DEFAULT '0',
  `subject` varchar(250) NOT NULL DEFAULT '',
  `body` longtext,
  `created_at` int(10) unsigned DEFAULT NULL,
  `modified_at` int(10) unsigned DEFAULT NULL,
  `sent_at` int(10) unsigned DEFAULT NULL,
  `from_email` varchar(250) DEFAULT NULL,
  `from_name` varchar(250) DEFAULT NULL,
  `replyto_email` varchar(250) DEFAULT NULL,
  `replyto_name` varchar(250) DEFAULT NULL,
  `attachments` text,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `type` tinyint(4) NOT NULL DEFAULT '1',
  `number_sent` int(10) unsigned NOT NULL DEFAULT '0',
  `number_opened` int(10) unsigned NOT NULL DEFAULT '0',
  `number_clicked` int(10) unsigned NOT NULL DEFAULT '0',
  `number_unsub` int(10) unsigned NOT NULL DEFAULT '0',
  `number_bounce` int(10) unsigned NOT NULL DEFAULT '0',
  `number_forward` int(10) unsigned NOT NULL DEFAULT '0',
  `params` text,
  `wj_data` longtext,
  `wj_styles` longtext,
  PRIMARY KEY (`email_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
