<?php
get_header();
global $post;
$xoxo_fn_option = xoxo_fn_theme_option();


$single_auto_loading_post = 'enable';
if(isset($xoxo_fn_option['single_auto_loading_post'])){
	$single_auto_loading_post = $xoxo_fn_option['single_auto_loading_post'];
}
//$single_auto_loading_post = 'disable';

// Check if page is password protected	
if(post_password_required($post)){
	$protected = xoxo_fn_protectedpage();
	echo wp_kses($protected, 'post');
}else{?>

<div class="xoxo_fn_singlepost">
	<div class="container">
		<?php if($single_auto_loading_post == 'enable'){ ?>
		<div class="xoxo_fn_singleajax">
		<?php } ?>
			<?php get_template_part( 'inc/templates/single-post-template');?>
		<?php if($single_auto_loading_post == 'enable'){ ?>
		</div>
		<?php } ?>
		<?php if($single_auto_loading_post == 'enable'){ ?>
		<div class="fn__preloader">
			<span class="icon"></span>
			<span class="text"><?php esc_html_e('Loading','xoxo');?></span>
		</div>
		<?php } ?>
	</div>
</div>

<?php } ?>

<?php get_footer(); ?>  