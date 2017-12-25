<?php

/**
 *
 * Woocommerce functions:
 *
 **/
 
 global $gk_tpl;
 
// Display 9 products per page.
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 9;' ), 20 );

// Change number or products per row to 3
add_filter('loop_shop_columns', 'loop_columns');
	if (!function_exists('loop_columns')) {
		function loop_columns() {
		return 3; // 3 products per row
		}
	}

// Redefine woocommerce_output_related_products()
function woocommerce_output_related_products() {
	woocommerce_related_products(4,1); // Display 4 products in rows of 1
}
// Redefine the breadcrumb
function gavern_woocommerce_breadcrumb() {
	woocommerce_breadcrumb(array(
		'delimiter'   => '',
		'wrap_before' => '<div class="gk-woocommerce-breadcrumbs">',
		'wrap_after'  => '</div>',
		'before' => '<span>',
		'after' => '</span>'
	));
}

// remove old breadcrumb callback
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
// add our own breadcrumb callback
add_action( 'woocommerce_before_main_content', 'gavern_woocommerce_breadcrumb', 20, 0);


remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );

add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 20 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 40 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );

// Display short description on catalog pages.
function wc_short_description($amount) {
	global $product;
	global $woocommerce;
	
	$input = $product->get_post_data()->post_excerpt;
	$output = '';
	$input = strip_tags($input);
	
	if (function_exists('mb_substr')) {
		$output = mb_substr($input, 0, $amount);
		if (mb_strlen($input) > $amount){
			$output .= '&hellip;';
		}
	}
	else {
		$output = substr($input, 0, $amount);
		if (strlen($input) > $amount){
			$output .= '&hellip;';
		}
	}	
	
	return '<p class="short-desc">'.$output.'</p>';
}


//remove add to cart, select options buttons on catalog pages
if(!(get_option($gk_tpl->name . '_woocommerce_show_loop_button', 'Y') == 'Y')) : 
function remove_loop_button(){
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
}

add_action('init','remove_loop_button');
endif;

//product details button on catalog pages
if(!(get_option($gk_tpl->name . '_woocommerce_show_details_button', 'Y') == 'N')) : 
	function add_product_details_button() {
	$product_id = null;
		echo '<a class="btn wc-product-details" href="'.get_permalink($product_id).'">'.__('Product details', GKTPLNAME).'</a>';
	}
	
add_action( 'woocommerce_after_shop_loop_item', 'add_product_details_button' );
endif;
