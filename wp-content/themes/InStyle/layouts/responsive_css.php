<?php 
	
	/**
	 *
	 * Template part loading the responsive CSS code
	 *
	 **/
	
	// create an access to the template main object
	global $gk_tpl;
	global $fullwidth;
	
	// disable direct access to the file	
	defined('GAVERN_WP') or die('Access denied');
	
?>

<style type="text/css">
	.gk-page { max-width: <?php echo get_option($gk_tpl->name . '_template_width', 980); ?>px; }
	<?php if(
		get_option($gk_tpl->name . '_page_layout', 'right') != 'none' && 
		gk_is_active_sidebar('sidebar') && 
		($fullwidth != true) && !is_woocommerce()
	) : ?>
	#gk-mainbody-columns > aside { width: <?php echo get_option($gk_tpl->name . '_sidebar_width', '30'); ?>%;}
	#gk-mainbody-columns > section { width: <?php echo 100 - get_option($gk_tpl->name . '_sidebar_width', '30'); ?>%; }
	
	<?php elseif(
		get_option($gk_tpl->name . '_wooc_layout', 'right') != 'none' && 
		gk_is_active_sidebar('sidebar_wc') && 
		($fullwidth != true) && is_woocommerce()
	) : ?>
	#gk-mainbody-columns > aside { width: <?php echo get_option($gk_tpl->name . '_wc_sidebar_width', '30'); ?>%;}
	#gk-mainbody-columns > section { width: <?php echo 100 - get_option($gk_tpl->name . '_wc_sidebar_width', '30'); ?>%; }
	<?php else : ?>
	#gk-mainbody-columns > section { width: 100%; }
	<?php endif; ?>
	
	<?php if(
		get_option($gk_tpl->name . '_inner_inset_position', 'right') != 'none' && 
		gk_is_active_sidebar('inner_inset') && 
		($fullwidth != true)
	) : ?>
	#gk-inset { width: <?php echo get_option($gk_tpl->name . '_inner_inset_width', '30'); ?>%;}
	#gk-mainbody > article .content { width: <?php echo 100 - get_option($gk_tpl->name . '_inner_inset_width', '30'); ?>%; }
	<?php else : ?>
	#gk-mainbody > article .content { width: 100%; }
	<?php endif; ?>
	
	
	@media (min-width: <?php echo get_option($gk_tpl->name . '_tablet_width', '800') + 1; ?>px) {
		#gk-mainmenu-collapse { height: auto!important; }
	}
	
	@media (max-width: 370px) {
		#btn-cart { 
			float: none!important;
			margin-bottom: 10px!important;	
		}
	}
	
</style>

<?php
// check the dependencies for the desktop.small.css file
if(get_option($gk_tpl->name . "_shortcodes3_state", 'Y') == 'Y') {
     wp_enqueue_style('gavern-desktop-small', gavern_file_uri('css/desktop.small.css'), array('gavern-shortcodes-template'), false, '(max-width: '. get_option($gk_tpl->name . '_theme_width', '1280') . 'px)');
} elseif(get_option($gk_tpl->name . "_shortcodes2_state", 'Y') == 'Y') {
     wp_enqueue_style('gavern-desktop-small', gavern_file_uri('css/desktop.small.css'), array('gavern-shortcodes-elements'), false, '(max-width: '. get_option($gk_tpl->name . '_theme_width', '1280') . 'px)');
} elseif(get_option($gk_tpl->name . "_shortcodes1_state", 'Y') == 'Y') {
     wp_enqueue_style('gavern-desktop-small', gavern_file_uri('css/desktop.small.css'), array('gavern-shortcodes-typography'), false, '(max-width: '. get_option($gk_tpl->name . '_theme_width', '1280') . 'px)');
} else {
     wp_enqueue_style('gavern-desktop-small', gavern_file_uri('css/desktop.small.css'), array('gavern-extensions'), false, '(max-width: '. get_option($gk_tpl->name . '__theme_width', '1280') . 'px)');
}

// tablet.css is always loaded after the desktop.small.css file
wp_enqueue_style('gavern-tablet', gavern_file_uri('css/tablet.css'), array('gavern-extensions'), false, '(max-width: '. get_option($gk_tpl->name . '_tablet_width', '1030') . 'px)');

// tablet.small.css is always loaded after the tablet.css file
wp_enqueue_style('gavern-tablet-small', gavern_file_uri('css/tablet.small.css'), array('gavern-tablet'), false, '(max-width: '. get_option($gk_tpl->name . '_small_tablet_width', '820') . 'px)');

// mobile.css is always loaded after the tablet.small.css file
wp_enqueue_style('gavern-mobile', gavern_file_uri('css/mobile.css'), array('gavern-tablet-small'), false, '(max-width: '. get_option($gk_tpl->name . '_mobile_width', '580') . 'px)');