<?php

/**
 *
 * 404 Page
 *
 **/
 
global $gk_tpl; 

gk_load('header');
gk_load('before');

?>

<section id="gk-mainbody" class="page404">
<p><img src="http://alazankina.ru/wp-content/themes/InStyle/images/404.jpg"></p>
<!-- 	<p>
		<?php _e( 'Похоже, страница не найдена.', GKTPLNAME); ?>
		<small>
			<?php _e('Попробуйте найти нужный вид съемки или услуги в меню.', GKTPLNAME); ?>
		</small>
	</p> -->
</section>

<?php

gk_load('after');
gk_load('footer');

// EOF