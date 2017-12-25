<?php

/**
 *
 * Woocommerce Page
 *
 **/

global $gk_tpl;

$fullwidth = true;
$wooc_sidebar =false;
array('sidebar' => false);
if (get_option($gk_tpl->name . '_wooc_layout', 'right') != 'none' && gk_is_active_sidebar('sidebar_wc')) {
	$wooc_sidebar = true;
}

if ($wooc_sidebar) :
	$fullwidth = false;
else : $fullwidth = true;
endif;

gk_load('header');

if ($wooc_sidebar) :
	gk_load('before', null, array('sidebar_wc' => true));
else:
	gk_load('before', null, array('sidebar' => false));
endif;

?>

<section id="gk-mainbody">
	<?php do_action('woocommerce_before_main_content'); ?>

	<?php woocommerce_content(); ?>
	
	<?php do_action('woocommerce_after_main_content'); ?>
</section>

<?php

if($wooc_sidebar) :
	gk_load('after', null, array('sidebar_wc' => true));
else :
	gk_load('after', null, array('sidebar' => false));
endif;

gk_load('footer');

// EOF