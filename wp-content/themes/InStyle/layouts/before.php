<?php 
	
	/**
	 *
	 * Template elements before the page content
	 *
	 **/
	
	// create an access to the template main object
	global $gk_tpl;
	
	// disable direct access to the file	
	defined('GAVERN_WP') or die('Access denied');
	
	// check if the sidebar is set to be a left column
	$args = array();
	$args_val = $args == null || ($args != null && $args['sidebar'] == true || $args['sidebar_wc'] == true );
	
	$gk_mainbody_class = '';
	
	if(get_option($gk_tpl->name . '_page_layout', 'right') == 'left' && gk_is_active_sidebar('sidebar') && $args_val && !is_woocommerce()) {
		$gk_mainbody_class .= ' class= "gk-column-left"';
	}
	
	if(get_option($gk_tpl->name . '_wooc_layout', 'right') == 'left' && gk_is_active_sidebar('sidebar_wc') && $args_val && is_woocommerce()) {
		$gk_mainbody_class .= ' class= "gk-column-wc-left"';
	}

	if(is_page('services')) {
		$gk_mainbody_class = ' class= "pumbel-services"';
	}
	
?>

<div class="gk-page-wrap<?php if(get_option($gk_tpl->name . '_template_homepage_mainbody', 'N') == 'N' && is_home()) : ?> gk-is-homepage<?php endif; ?>">
	<div class="gk-page">
		<div id="gk-mainbody-columns"<?php echo $gk_mainbody_class; ?>>	
			<section>
				<?php if(gk_is_active_sidebar('top1')) : ?>
				<div id="gk-top1">
					<div class="widget-area">
						<?php gk_dynamic_sidebar('top1'); ?>
						
						<!--[if IE 8]>
						<div class="ie8clear"></div>
						<![endif]-->
					</div>
				</div>
				<?php endif; ?>
				
				<?php if(gk_is_active_sidebar('top2')) : ?>
				<div id="gk-top2">
					<div class="widget-area">
						<?php gk_dynamic_sidebar('top2'); ?>
						
						<!--[if IE 8]>
						<div class="ie8clear"></div>
						<![endif]-->
					</div>
				</div>
				<?php endif; ?>
				
				<!-- Mainbody, breadcrumbs -->
				<?php if(gk_show_breadcrumbs()) : ?>
				<div id="gk-breadcrumb-area">
					<?php gk_breadcrumbs_output(); ?>
				</div>
				<?php endif; ?>
			
				<?php if(gk_is_active_sidebar('mainbody_top')) : ?>
				<div id="gk-mainbody-top">
					<?php gk_dynamic_sidebar('mainbody_top'); ?>
				</div>
				<?php endif; ?>