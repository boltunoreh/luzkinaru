<?php

/**
 *
 * The template fragment to show post footer
 *
 **/

// disable direct access to the file	
defined('GAVERN_WP') or die('Access denied');

global $gk_tpl; 

$tag_list = get_the_tag_list( '', __( ' ', GKTPLNAME ) );

$params = get_post_custom();
$params_aside = isset($params['gavern-post-params-aside']) ? $params['gavern-post-params-aside'][0] : false;

$param_aside = true;
$param_tags = true;

if($params_aside) {
  $params_aside = unserialize(unserialize($params_aside));
  $param_aside = $params_aside['aside'] == 'Y';
  $param_tags = $params_aside['tags'] == 'Y';
}
?>

<?php if(is_singular()) : ?>

	<?php if(get_option($gk_tpl->name . '_inner_inset_position', 'right') != 'none' && 
		gk_is_active_sidebar('inner_inset')) : ?>
		<?php do_action('gavernwp_before_inner_inset'); ?>
		<aside id="gk-inset">
			<?php gk_dynamic_sidebar('inner_inset'); ?>
		</aside>
		<?php do_action('gavernwp_after_inner_inset'); ?>
	<?php endif; ?>
	
	<?php do_action('gavernwp_after_post_content'); ?>

	<?php if($tag_list != '' && $param_tags): ?>
	<dl class="tags">
		<dt><?php _e('Tagged under:', GKTPLNAME); ?></dt>
		<dd><?php echo $tag_list; ?></dd>
	</dl>
	<?php endif; ?>
		
	<?php if(gk_author(false, true)): ?>
	<footer>
		<?php gk_author(); ?>
	</footer>
	<?php endif; ?>
<?php endif; ?>