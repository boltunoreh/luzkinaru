<?php

function gk_installer_run($table_prefix, $wpdb) {
	// set the predefined options
	gk_installer_predefined_options($wpdb, $table_prefix);
	// page url
	$page_url = get_option('siteurl');
	// load the SQL dumps files
	$comments_dump = file_get_contents(dirname(__FILE__) . '/sql_dumps/comments.sql');
	$options_dump = file_get_contents(dirname(__FILE__) . '/sql_dumps/options.sql');
	$postmeta_dump = file_get_contents(dirname(__FILE__) . '/sql_dumps/postmeta.sql');
	$posts_dump = file_get_contents(dirname(__FILE__) . '/sql_dumps/posts.sql');
	$term_rel_dump = file_get_contents(dirname(__FILE__) . '/sql_dumps/term_relationships.sql');
	$term_tax_dump = file_get_contents(dirname(__FILE__) . '/sql_dumps/term_taxonomy.sql');
	$terms_dump = file_get_contents(dirname(__FILE__) . '/sql_dumps/terms.sql');
	
	// WC Tables	
	$woocommerce_attribute_taxonomies_dump = file_get_contents(dirname(__FILE__) . '/sql_dumps/woocommerce_attribute_taxonomies.sql');
	//$woocommerce_downloadable_product_permissions_dump = file_get_contents(dirname(__FILE__) . '/sql_dumps/woocommerce_downloadable_product_permissions.sql');
	$woocommerce_order_itemmeta_dump = file_get_contents(dirname(__FILE__) . '/sql_dumps/woocommerce_order_itemmeta.sql');
	$woocommerce_order_items_dump = file_get_contents(dirname(__FILE__) . '/sql_dumps/woocommerce_order_items.sql');
	$woocommerce_tax_rates_dump = file_get_contents(dirname(__FILE__) . '/sql_dumps/woocommerce_tax_rates.sql');
	//$woocommerce_tax_rate_locations_dump = file_get_contents(dirname(__FILE__) . '/sql_dumps/woocommerce_tax_rate_locations.sql');
	$woocommerce_termmeta_dump = file_get_contents(dirname(__FILE__) . '/sql_dumps/woocommerce_termmeta.sql');
	
	// Wysija tables
	$wysija_campaign_dump = file_get_contents(dirname(__FILE__) . '/sql_dumps/wysija_campaign.sql');
	$wysija_campaign_list_dump = file_get_contents(dirname(__FILE__) . '/sql_dumps/wysija_campaign_list.sql');
	$wysija_email_dump = file_get_contents(dirname(__FILE__) . '/sql_dumps/wysija_email.sql');
	$wysija_email_user_stat_dump = file_get_contents(dirname(__FILE__) . '/sql_dumps/wysija_email_user_stat.sql');
	$wysija_email_user_url_dump = file_get_contents(dirname(__FILE__) . '/sql_dumps/wysija_email_user_url.sql');
	$wysija_form_dump = file_get_contents(dirname(__FILE__) . '/sql_dumps/wysija_form.sql');
	$wysija_list_dump = file_get_contents(dirname(__FILE__) . '/sql_dumps/wysija_list.sql');
	$wysija_queue_dump = file_get_contents(dirname(__FILE__) . '/sql_dumps/wysija_queue.sql');
	$wysija_url_dump = file_get_contents(dirname(__FILE__) . '/sql_dumps/wysija_url.sql');
	$wysija_url_mail_dump = file_get_contents(dirname(__FILE__) . '/sql_dumps/wysija_url_mail.sql');
	$wysija_user_dump = file_get_contents(dirname(__FILE__) . '/sql_dumps/wysija_user.sql');
	$wysija_user_field_dump = file_get_contents(dirname(__FILE__) . '/sql_dumps/wysija_user_field.sql');
	$wysija_user_history_dump = file_get_contents(dirname(__FILE__) . '/sql_dumps/wysija_user_history.sql');
	$wysija_user_list_dump = file_get_contents(dirname(__FILE__) . '/sql_dumps/wysija_user_list.sql');
	
	//
	//
	// replace all variables with the proper values
	//
	//
	$comments_dump = str_replace(array('{$table_prefix}', '{$page_url}'), array($table_prefix, $page_url), $comments_dump);
	$options_dump = str_replace(array('{$table_prefix}', '{$page_url}', '{$inactive_widgets}'), array($table_prefix, $page_url, 's:'.(16 + strlen($table_prefix)).':\"'.$table_prefix.'inactive_widgets'), $options_dump);
	$postmeta_dump = str_replace(array('{$table_prefix}', '{$page_url}'), array($table_prefix, $page_url), $postmeta_dump);
	$posts_dump = str_replace(array('{$table_prefix}', '{$page_url}'), array($table_prefix, $page_url), $posts_dump);
	$term_rel_dump = str_replace(array('{$table_prefix}', '{$page_url}'), array($table_prefix, $page_url), $term_rel_dump);
	$term_tax_dump = str_replace(array('{$table_prefix}', '{$page_url}'), array($table_prefix, $page_url), $term_tax_dump);
	$terms_dump = str_replace(array('{$table_prefix}', '{$page_url}'), array($table_prefix, $page_url), $terms_dump);
	
	
	// WC Tables
	$woocommerce_attribute_taxonomies_dump = str_replace(array('{$table_prefix}', '{$page_url}'), array($table_prefix, $page_url), $woocommerce_attribute_taxonomies_dump);
	//$woocommerce_downloadable_product_permissions_dump = str_replace(array('{$table_prefix}', '{$page_url}'), array($table_prefix, $page_url), $woocommerce_downloadable_product_permissions_dump);
	$woocommerce_order_itemmeta_dump = str_replace(array('{$table_prefix}', '{$page_url}'), array($table_prefix, $page_url), $woocommerce_order_itemmeta_dump);
	$woocommerce_order_items_dump = str_replace(array('{$table_prefix}', '{$page_url}'), array($table_prefix, $page_url), $woocommerce_order_items_dump);
	$woocommerce_tax_rates_dump = str_replace(array('{$table_prefix}', '{$page_url}'), array($table_prefix, $page_url), $woocommerce_tax_rates_dump);
	//$woocommerce_tax_rate_locations_dump = str_replace(array('{$table_prefix}', '{$page_url}'), array($table_prefix, $page_url), $woocommerce_tax_rate_locations_dump);
	$woocommerce_termmeta_dump = str_replace(array('{$table_prefix}', '{$page_url}'), array($table_prefix, $page_url), $woocommerce_termmeta_dump);
	
	
	// Wysija Tables
	$wysija_campaign_dump = str_replace(array('{$table_prefix}', '{$page_url}'), array($table_prefix, $page_url), $wysija_campaign_dump);
	$wysija_campaign_list_dump = str_replace(array('{$table_prefix}', '{$page_url}'), array($table_prefix, $page_url), $wysija_campaign_list_dump);
	$wysija_email_dump = str_replace(array('{$table_prefix}', '{$page_url}'), array($table_prefix, $page_url), $wysija_email_dump);
	$wysija_email_user_stat_dump = str_replace(array('{$table_prefix}', '{$page_url}'), array($table_prefix, $page_url), $wysija_email_user_stat_dump);
	$wysija_email_user_url_dump = str_replace(array('{$table_prefix}', '{$page_url}'), array($table_prefix, $page_url), $wysija_email_user_url_dump);
	$wysija_form_dump = str_replace(array('{$table_prefix}', '{$page_url}'), array($table_prefix, $page_url), $wysija_form_dump);
	$wysija_list_dump = str_replace(array('{$table_prefix}', '{$page_url}'), array($table_prefix, $page_url), $wysija_list_dump);
	$wysija_queue_dump = str_replace(array('{$table_prefix}', '{$page_url}'), array($table_prefix, $page_url), $wysija_queue_dump);
	$wysija_url_dump = str_replace(array('{$table_prefix}', '{$page_url}'), array($table_prefix, $page_url), $wysija_url_dump);
	$wysija_url_mail_dump = str_replace(array('{$table_prefix}', '{$page_url}'), array($table_prefix, $page_url), $wysija_url_mail_dump);
	$wysija_user_dump = str_replace(array('{$table_prefix}', '{$page_url}'), array($table_prefix, $page_url), $wysija_user_dump);
	$wysija_user_field_dump = str_replace(array('{$table_prefix}', '{$page_url}'), array($table_prefix, $page_url), $wysija_user_field_dump);
	$wysija_user_history_dump = str_replace(array('{$table_prefix}', '{$page_url}'), array($table_prefix, $page_url), $wysija_user_history_dump);
	$wysija_user_list_dump = str_replace(array('{$table_prefix}', '{$page_url}'), array($table_prefix, $page_url), $wysija_user_list_dump);
	
	// run the queries from SQL dumps
	$wpdb->query($comments_dump);
	$wpdb->query('ALTER TABLE '.$table_prefix.'comments AUTO_INCREMENT=60;');
	$wpdb->query($options_dump);
	$wpdb->query('ALTER TABLE '.$table_prefix.'options AUTO_INCREMENT=12763;');
	$wpdb->query($postmeta_dump);
	$wpdb->query('ALTER TABLE '.$table_prefix.'postmeta AUTO_INCREMENT=6582;');
	$wpdb->query($posts_dump);
	$wpdb->query('ALTER TABLE '.$table_prefix.'posts AUTO_INCREMENT=1513;');
	$wpdb->query($term_rel_dump);
	// no alter table for the term_relationships
	$wpdb->query($term_tax_dump);
	$wpdb->query('ALTER TABLE '.$table_prefix.'term_taxonomy AUTO_INCREMENT=186;');
	$wpdb->query($terms_dump);
	$wpdb->query('ALTER TABLE '.$table_prefix.'terms AUTO_INCREMENT=191;');
	
	//
	//
	// Creating the unexisitng tables
	//
	//
	
	
	// Create the WC Tables
	$wc1_dump = file_get_contents(dirname(__FILE__) . '/sql_dumps/wc1.sql');
	$wc1_dump = str_replace(array('{$table_prefix}', '{$page_url}'), array($table_prefix, $page_url), $wc1_dump);
	$wpdb->query($wc1_dump);
	$wc2_dump = file_get_contents(dirname(__FILE__) . '/sql_dumps/wc2.sql');
	$wc2_dump = str_replace(array('{$table_prefix}', '{$page_url}'), array($table_prefix, $page_url), $wc2_dump);
	$wpdb->query($wc2_dump);
	$wc3_dump = file_get_contents(dirname(__FILE__) . '/sql_dumps/wc3.sql');
	$wc3_dump = str_replace(array('{$table_prefix}', '{$page_url}'), array($table_prefix, $page_url), $wc3_dump);
	$wpdb->query($wc3_dump);
	$wc4_dump = file_get_contents(dirname(__FILE__) . '/sql_dumps/wc4.sql');
	$wc4_dump = str_replace(array('{$table_prefix}', '{$page_url}'), array($table_prefix, $page_url), $wc4_dump);
	$wpdb->query($wc4_dump);
	$wc5_dump = file_get_contents(dirname(__FILE__) . '/sql_dumps/wc5.sql');
	$wc5_dump = str_replace(array('{$table_prefix}', '{$page_url}'), array($table_prefix, $page_url), $wc5_dump);
	$wpdb->query($wc5_dump);
	$wc6_dump = file_get_contents(dirname(__FILE__) . '/sql_dumps/wc6.sql');
	$wc6_dump = str_replace(array('{$table_prefix}', '{$page_url}'), array($table_prefix, $page_url), $wc6_dump);
	$wpdb->query($wc6_dump);
	$wc7_dump = file_get_contents(dirname(__FILE__) . '/sql_dumps/wc7.sql');
	$wc7_dump = str_replace(array('{$table_prefix}', '{$page_url}'), array($table_prefix, $page_url), $wc7_dump);
	$wpdb->query($wc7_dump);
	
	
	// WC Tables
	$wpdb->query($woocommerce_attribute_taxonomies_dump);
	$wpdb->query('ALTER TABLE '.$table_prefix.'woocommerce_attribute_taxonomies AUTO_INCREMENT=2;');
	//$wpdb->query($woocommerce_downloadable_product_permissions_dump);
	//$wpdb->query('ALTER TABLE '.$table_prefix.'woocommerce_downloadable_product_permissions AUTO_INCREMENT=[#WC2#];');
	$wpdb->query($woocommerce_order_itemmeta_dump);
	$wpdb->query('ALTER TABLE '.$table_prefix.'woocommerce_order_itemmeta AUTO_INCREMENT=17;');
	$wpdb->query($woocommerce_order_items_dump);
	$wpdb->query('ALTER TABLE '.$table_prefix.'woocommerce_order_items AUTO_INCREMENT=3;');
	$wpdb->query($woocommerce_tax_rates_dump);
	$wpdb->query('ALTER TABLE '.$table_prefix.'woocommerce_tax_rates AUTO_INCREMENT=6;');
	//$wpdb->query($woocommerce_tax_rate_locations_dump);
	//$wpdb->query('ALTER TABLE '.$table_prefix.'woocommerce_tax_rate_locations AUTO_INCREMENT=[#WC6#];');
	$wpdb->query($woocommerce_termmeta_dump);
	$wpdb->query('ALTER TABLE '.$table_prefix.'woocommerce_termmeta AUTO_INCREMENT=74;');
	
	
	
	// Wysija
	
	$ws1_dump = file_get_contents(dirname(__FILE__) . '/sql_dumps/ws1.sql');
	$ws1_dump = str_replace(array('{$table_prefix}', '{$page_url}'), array($table_prefix, $page_url), $ws1_dump);
	$wpdb->query($ws1_dump);
	$ws2_dump = file_get_contents(dirname(__FILE__) . '/sql_dumps/ws2.sql');
	$ws2_dump = str_replace(array('{$table_prefix}', '{$page_url}'), array($table_prefix, $page_url), $ws2_dump);
	$wpdb->query($ws2_dump);
	$ws3_dump = file_get_contents(dirname(__FILE__) . '/sql_dumps/ws3.sql');
	$ws3_dump = str_replace(array('{$table_prefix}', '{$page_url}'), array($table_prefix, $page_url), $ws3_dump);
	$wpdb->query($ws3_dump);
	$ws4_dump = file_get_contents(dirname(__FILE__) . '/sql_dumps/ws4.sql');
	$ws4_dump = str_replace(array('{$table_prefix}', '{$page_url}'), array($table_prefix, $page_url), $ws4_dump);
	$wpdb->query($ws4_dump);
	$ws5_dump = file_get_contents(dirname(__FILE__) . '/sql_dumps/ws5.sql');
	$ws5_dump = str_replace(array('{$table_prefix}', '{$page_url}'), array($table_prefix, $page_url), $ws5_dump);
	$wpdb->query($ws5_dump);
	$ws6_dump = file_get_contents(dirname(__FILE__) . '/sql_dumps/ws6.sql');
	$ws6_dump = str_replace(array('{$table_prefix}', '{$page_url}'), array($table_prefix, $page_url), $ws6_dump);
	$wpdb->query($ws6_dump);
	$ws7_dump = file_get_contents(dirname(__FILE__) . '/sql_dumps/ws7.sql');
	$ws7_dump = str_replace(array('{$table_prefix}', '{$page_url}'), array($table_prefix, $page_url), $ws7_dump);
	$wpdb->query($ws7_dump);
	$ws8_dump = file_get_contents(dirname(__FILE__) . '/sql_dumps/ws8.sql');
	$ws8_dump = str_replace(array('{$table_prefix}', '{$page_url}'), array($table_prefix, $page_url), $ws8_dump);
	$wpdb->query($ws8_dump);
	$ws9_dump = file_get_contents(dirname(__FILE__) . '/sql_dumps/ws9.sql');
	$ws9_dump = str_replace(array('{$table_prefix}', '{$page_url}'), array($table_prefix, $page_url), $ws9_dump);
	$wpdb->query($ws9_dump);
	$ws10_dump = file_get_contents(dirname(__FILE__) . '/sql_dumps/ws10.sql');
	$ws10_dump = str_replace(array('{$table_prefix}', '{$page_url}'), array($table_prefix, $page_url), $ws10_dump);
	$wpdb->query($ws10_dump);
	$ws11_dump = file_get_contents(dirname(__FILE__) . '/sql_dumps/ws11.sql');
	$ws11_dump = str_replace(array('{$table_prefix}', '{$page_url}'), array($table_prefix, $page_url), $ws11_dump);
	$wpdb->query($ws11_dump);
	$ws12_dump = file_get_contents(dirname(__FILE__) . '/sql_dumps/ws12.sql');
	$ws12_dump = str_replace(array('{$table_prefix}', '{$page_url}'), array($table_prefix, $page_url), $ws12_dump);
	$wpdb->query($ws12_dump);
	$ws13_dump = file_get_contents(dirname(__FILE__) . '/sql_dumps/ws13.sql');
	$ws13_dump = str_replace(array('{$table_prefix}', '{$page_url}'), array($table_prefix, $page_url), $ws13_dump);
	$wpdb->query($ws13_dump);
	$ws14_dump = file_get_contents(dirname(__FILE__) . '/sql_dumps/ws14.sql');
	$ws14_dump = str_replace(array('{$table_prefix}', '{$page_url}'), array($table_prefix, $page_url), $ws14_dump);
	$wpdb->query($ws14_dump);
	
	// Wysija Tables content
	
	if(trim($wysija_campaign_dump) != '') {
		$wpdb->query($wysija_campaign_dump);
		$wpdb->query('ALTER TABLE '.$table_prefix.'wysija_campaign AUTO_INCREMENT=2;');
	}
	
	if(trim($wysija_campaign_list_dump) != '') {
		$wpdb->query($wysija_campaign_list_dump);
		//$wpdb->query('ALTER TABLE '.$table_prefix.'wysija_campaign_list AUTO_INCREMENT=[#WS2#];');
	}
	
	if(trim($wysija_email_dump) != '') {
		$wpdb->query($wysija_email_dump);
		$wpdb->query('ALTER TABLE '.$table_prefix.'wysija_email AUTO_INCREMENT=3;');
	}
	
	if(trim($wysija_email_user_stat_dump) != '') {
		$wpdb->query($wysija_email_user_stat_dump);
		//$wpdb->query('ALTER TABLE '.$table_prefix.'wysija_email_user_stat AUTO_INCREMENT=[#WS4#];');
	}
	
	if(trim($wysija_email_user_url_dump) != '') {
		$wpdb->query($wysija_email_user_url_dump);
		//$wpdb->query('ALTER TABLE '.$table_prefix.'wysija_email_user_url AUTO_INCREMENT=[#WS5#];');
	}
	
	if(trim($wysija_form_dump) != '') {
		$wpdb->query($wysija_form_dump);
		$wpdb->query('ALTER TABLE '.$table_prefix.'wysija_form AUTO_INCREMENT=3;');
	}
	
	if(trim($wysija_list_dump) != '') {
		$wpdb->query($wysija_list_dump);
		$wpdb->query('ALTER TABLE '.$table_prefix.'wysija_list AUTO_INCREMENT=3;');
	}
	
	if(trim($wysija_queue_dump) != '') {
		$wpdb->query($wysija_queue_dump);
		//$wpdb->query('ALTER TABLE '.$table_prefix.'wysija_queue AUTO_INCREMENT=[#WS8#];');
	}
	
	if(trim($wysija_url_dump) != '') {
		$wpdb->query($wysija_url_dump);
		$wpdb->query('ALTER TABLE '.$table_prefix.'wysija_url AUTO_INCREMENT=1;');
	}
	
	if(trim($wysija_url_mail_dump) != '') {
		$wpdb->query($wysija_url_mail_dump);
		//$wpdb->query('ALTER TABLE '.$table_prefix.'wysija_url_mail AUTO_INCREMENT=[#WS10#];');
	}
	
	if(trim($wysija_user_dump) != '') {
		$wpdb->query($wysija_user_dump);
		$wpdb->query('ALTER TABLE '.$table_prefix.'wysija_user AUTO_INCREMENT=3;');
	}
	
	if(trim($wysija_user_field_dump) != '') {
		$wpdb->query($wysija_user_field_dump);
		$wpdb->query('ALTER TABLE '.$table_prefix.'wysija_user_field AUTO_INCREMENT=3;');
	}
	
	if(trim($wysija_user_history_dump) != '') {
		$wpdb->query($wysija_user_history_dump);
		$wpdb->query('ALTER TABLE '.$table_prefix.'wysija_user_history AUTO_INCREMENT=1;');
	}
	
	if(trim($wysija_user_list_dump) != '') {
		$wpdb->query($wysija_user_list_dump);
		//$wpdb->query('ALTER TABLE '.$table_prefix.'wysija_user_list AUTO_INCREMENT=[#WS14#];');
	}
}

function gk_installer_predefined_options($wpdb, $table_prefix) {
	// set the theme
	update_option('template', "inStyle");
	update_option('stylesheet', "inStyle");
}

// EOF
