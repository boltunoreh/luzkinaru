<?php 
	
	/**
	 *
	 * Template header
	 *
	 **/
	
	// create an access to the template main object
	global $gk_tpl;

?>
<?php do_action('gavernwp_doctype'); ?>
<html <?php do_action('gavernwp_html_attributes'); ?>>
<head>
	<title><?php do_action('gavernwp_title'); ?></title>
	<?php do_action('gavernwp_metatags'); ?>
	
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="shortcut icon" href="<?php get_stylesheet_directory_uri(); ?>/favicon.ico" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php
	wp_enqueue_style('gavern-normalize', gavern_file_uri('css/normalize.css'), false);
	wp_enqueue_style('gavern-font-awesome', gavern_file_uri('css/font-awesome.css'), array('gavern-normalize'));
	wp_enqueue_style('gavern-template', gavern_file_uri('css/template.css'), array('gavern-font-awesome'));
	wp_enqueue_style('gavern-wp', gavern_file_uri('css/wp.css'), array('gavern-template'));
	wp_enqueue_style('gavern-stuff', gavern_file_uri('css/stuff.css'), array('gavern-wp'));
	wp_enqueue_style('gavern-wpextensions', gavern_file_uri('css/wp.extensions.css'), array('gavern-stuff'));
	wp_enqueue_style('gavern-extensions', gavern_file_uri('css/extensions.css'), array('gavern-wpextensions'));
	?>
	<?php if(get_option($gk_tpl->name . '_woocommerce_css', 'Y') == 'Y') : 
		wp_enqueue_style('gavern-woocommerce', gavern_file_uri('css/woocommerce.css'), array('gavern-extensions'));
	endif; ?>
	<!--[if IE 9]>
	<link rel="stylesheet" href="<?php echo gavern_file_uri('css/ie9.css'); ?>" />
	<![endif]-->
	<!--[if lt IE 9]>
	<link rel="stylesheet" href="<?php echo gavern_file_uri('css/ie8.css'); ?>" />
	<![endif]-->
	
	<?php if(is_singular() && get_option('thread_comments' )) wp_enqueue_script( 'comment-reply' ); ?>
	
	<?php do_action('gavernwp_ie_scripts'); ?>
	
	<?php gk_head_shortcodes(); ?>
		  
	<?php 
	 gk_load('responsive_css'); 
	 
	 if(get_option($gk_tpl->name . "_overridecss_state", 'Y') == 'Y') {
	   wp_enqueue_style('gavern-override', gavern_file_uri('css/override.css'), array('gavern-style'));
	 }
	?>
	
	<?php
	if(get_option($gk_tpl->name . '_prefixfree_state', 'N') == 'Y') {
	  wp_enqueue_script('gavern-prefixfree', gavern_file_uri('js/prefixfree.js'));
	} 
	?>
	
	<?php gk_head_style_css(); ?>
	<?php gk_head_style_pages(); ?>
	

	<?php wp_head(); ?>
	
	<?php do_action('gavernwp_fonts'); ?>
	<?php gk_head_config(); ?>
	<?php wp_enqueue_script("jquery"); ?>
	
	<?php
	    wp_enqueue_script('gavern-scripts', gavern_file_uri('js/gk.scripts.js'), array('jquery'), false, true);
	    wp_enqueue_script('gavern-menu', gavern_file_uri('js/gk.menu.js'), array('jquery', 'gavern-scripts'), false, true);
	?>
	
	<?php do_action('gavernwp_head'); ?>
	
	<?php 
		echo stripslashes(
			htmlspecialchars_decode(
				str_replace( '&#039;', "'", get_option($gk_tpl->name . '_head_code', ''))
			)
		); 
	?>
</head>
<body <?php do_action('gavernwp_body_attributes'); ?>>
	<div id="gk-bg">
		<?php if(gk_is_active_sidebar('top_bar')) : ?>
		<div id="gk-top-bar">
			<div class="gk-page widget-area">
				<?php gk_dynamic_sidebar('top_bar'); ?>
			</div>
		</div>
		<?php endif; ?>
		<header id="gk-head">
			<div>
				<div class="gk-page" id="gk-header-nav">
					<?php if(get_option($gk_tpl->name . "_branding_logo_type", 'css') != 'none') : ?>
						<a href="<?php echo home_url(); ?>" class="<?php echo get_option($gk_tpl->name . "_branding_logo_type", 'css'); ?>Logo"><?php gk_blog_logo(); ?></a>
					<?php endif; ?>
					
					<?php if(gk_show_menu('mainmenu') && get_option($gk_tpl->name . '_menu_type', 'overlay') == 'classic') : ?>
						<?php gavern_menu('mainmenu', 'main-menu-mobile', array('walker' => new GKMenuWalkerMobile(), 'items_wrap' => '<i class="fa fa-reorder"></i><select onchange="window.location.href=this.value;"><option value="#">'.__('Select a page', GKTPLNAME).'</option>%3$s</select>', 'container' => 'div')); ?>
					<?php endif; ?>
					
					<div id="gk-top-nav">
						<?php if(gk_is_active_sidebar('user_area')) : ?>
							<div id="gk-user-area">
								<?php gk_dynamic_sidebar('user_area'); ?>
							</div>
						<?php endif; ?>
						
						<div id="gk-top-right">
							<?php if(gk_is_active_sidebar('cart')) : ?>
							<div id="btn-cart">
								<?php _e('Shopping Cart', GKTPLNAME); ?>
							</div>
							<?php endif; ?>
							
							<div id="gk-top-menu">
								<?php gavern_menu('topmenu', 'gk-top-menu'); ?>
							</div>
						</div>
					</div>
					
					<div id ="gk-main-menu" <?php if(get_option($gk_tpl->name . '_menu_type', 'overlay') == 'overlay') : ?> class="gk-menu-overlay" <?php endif; ?>>
						<nav class="gk-menu-wrap">
						<?php if(gk_show_menu('mainmenu')) : ?>
							<?php gavern_menu('mainmenu', 'gk-main-menu', array('walker' => new GKMenuWalker())); ?>
						<?php endif; ?>
						</nav>
					</div>
					
				</div>
			</div>	
		</header>