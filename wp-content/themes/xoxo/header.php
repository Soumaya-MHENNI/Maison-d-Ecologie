<!DOCTYPE html >
<html <?php language_attributes(); ?>>

<head>
<?php global $post; ?>

<meta charset="<?php esc_attr(bloginfo( 'charset' )); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<?php wp_head(); ?>

</head>
<?php 
	$xoxo_fn_option 		= xoxo_fn_theme_option();
	$core_ready				= 'core_absent';
	if(isset($xoxo_fn_option)){
		$core_ready 		= 'core_ready';
	}
	
?>
<body <?php body_class();?>>
	<?php wp_body_open(); ?>
	<div class="clearfix"></div>
	
	<!-- HTML starts here -->
	<div class="xoxo-fn-wrapper <?php echo esc_attr($core_ready); ?>">


		<!-- Header starts here -->
		<?php get_template_part( 'inc/templates/desktop-navigation' );?>
		<!-- Header ends here -->

		<!-- Header starts here -->
		<?php get_template_part( 'inc/templates/mobile-navigation' );?>
		<!-- Header ends here -->

		<div class="xoxo_fn_content">
			<div class="xoxo_fn_pages">
				<div class="xoxo_fn_page_ajax">