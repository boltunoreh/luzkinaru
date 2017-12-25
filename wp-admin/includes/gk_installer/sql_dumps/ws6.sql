--
-- Table structure for table `#__wysija_form`
--

CREATE TABLE IF NOT EXISTS `{$table_prefix}wysija_form` (
  `form_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` tinytext CHARACTER SET utf8 COLLATE utf8_bin,
  `data` longtext CHARACTER SET utf8 COLLATE utf8_bin,
  `styles` longtext CHARACTER SET utf8 COLLATE utf8_bin,
  `subscribed` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`form_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
