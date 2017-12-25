--
-- Table structure for table `#__woocommerce_attribute_taxonomies`
--

CREATE TABLE IF NOT EXISTS `{$table_prefix}woocommerce_attribute_taxonomies` (
  `attribute_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `attribute_name` varchar(200) NOT NULL,
  `attribute_label` longtext,
  `attribute_type` varchar(200) NOT NULL,
  `attribute_orderby` varchar(200) NOT NULL,
  PRIMARY KEY (`attribute_id`),
  KEY `attribute_name` (`attribute_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;