<?php
	if(is_author()){
		$userID = get_post_field( 'post_author', get_the_ID() );
		echo wp_kses_post(xoxo_fn_get_wideget_author($userID));
	}
	if(!is_author()){
?>

<div class="xoxo_fn_sidebar">
	<?php 
		if(function_exists('rwmb_meta')){
			$sidebar = get_post_meta(get_the_ID(),'xoxo_fn_page_sidebar', true);
			if ( is_active_sidebar( $sidebar ) ){
				dynamic_sidebar($sidebar);
			}else if ( is_active_sidebar( 'main-sidebar' ) ){
				dynamic_sidebar('main-sidebar');
			}
		}else{
			if(is_active_sidebar( 'main-sidebar')){
				dynamic_sidebar('main-sidebar');
			}
		}
	?>
</div>
<?php } ?>