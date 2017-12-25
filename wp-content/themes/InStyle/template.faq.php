<?php
/*
Template Name: Faq Page
*/

global $gk_tpl;

$fullwidth = true;

gk_load('header');
gk_load('before', null, array('sidebar' => false));

?>

<section id="gk-mainbody" class="gk-faq">
	<?php the_post(); ?>
	
	<?php get_template_part( 'content', 'page' ); ?>
	
	<?php if(get_option($gk_tpl->name . '_pages_show_comments_on_pages', 'Y') == 'Y') : ?>
	<?php //comments_template( '', true ); ?>
	<?php endif; ?>
</section>

<?php

gk_load('after', null, array('sidebar' => false));
gk_load('footer');

// EOF