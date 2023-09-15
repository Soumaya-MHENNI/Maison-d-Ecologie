<?php

get_header();

$xoxo_fn_option 			= xoxo_fn_theme_option();



$seo_page_title 			= 'h3';
if(isset($xoxo_fn_option['seo_page_title'])){
	$seo_page_title 		= $xoxo_fn_option['seo_page_title'];
}
$seo_page_title__start 		= sprintf( '<%1$s class="fn__title fn_animated_text">', $seo_page_title );
$seo_page_title__end 		= sprintf( '</%1$s>', $seo_page_title );


// SEO

$seo_404_not_found 			= 'h3';
if(isset($xoxo_fn_option['seo_404_not_found'])){
	$seo_404_not_found 		= $xoxo_fn_option['seo_404_not_found'];
}
$nothing_found				= esc_html__('Nothing found', 'xoxo');;
$seo_404_not_found__start 	= sprintf( '<%1$s class="fn__maintitle">', $seo_404_not_found );
$seo_404_not_found__end 	= sprintf( '</%1$s>', $seo_404_not_found );

$seo_404_desc 				= 'p';
if(isset($xoxo_fn_option['seo_404_desc'])){
	$seo_404_desc 			= $xoxo_fn_option['seo_404_desc'];
}
$seo_404_desc__start 		= sprintf( '<%1$s class="fn__desc">', $seo_404_desc );
$seo_404_desc__end 			= sprintf( '</%1$s>', $seo_404_desc );


if(isset($_GET['from'])){
	$from = sanitize_text_field($_GET['from']);
}
$fromAjax = false;
$loop = array();
if(isset($from) && ($from == 'ajax')){
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$fromAjax = true;
	
	// new query
	$query_args		= array('post_status' => 'publish');
		
	$post_type 		= '';
	if(isset($_GET['post_type'])){
		$post_type 	= sanitize_text_field($_GET['post_type']);
	}
	if($post_type == 1){
		$query_args['post_type'] = ['post'];
	}else{
		$query_args['post_type'] = ['page','post'];
	}
	
	$text = '';
	if(!empty($_GET['s'])){
		$text  = sanitize_text_field($_GET['s']);
	}
	
	$from_title = false;
	if(isset($_GET['only_from_title'])){
		$only_from_title = sanitize_text_field($_GET['only_from_title']);
	}
	
	if(isset($only_from_title) && $only_from_title == '1'){
		$from_title = true;
	}
	$query_args['s'] = $text;
	$query_args['paged'] = $paged;
	
	if($from_title && $post_type == 'post'){
		add_filter( 'posts_where', '__search_by_title_post', 10, 2 );
	}else if($from_title){
		add_filter( 'posts_where', '__search_by_title_only', 10, 2 );
	}
	$loop = new WP_Query($query_args);
	if($from_title){
// 		commented by frenify
//		remove_filter( 'posts_where', '__search_by_title_post' );
//		remove_filter( 'posts_where', '__search_by_title_only' );
	}
}
?>
	
<div class="xoxo_fn_searchlist">
	
	
	<!-- If it comes from Ajax -->
	<?php if($fromAjax){ ?>
	
	<?php xoxo_fn_get_page_title(); ?>
	<div class="xoxo_fn_searchpagelist">
		<?php if($loop->have_posts()){ ?>
		<div class="container">
		<?php } ?>
		<?php if($loop->have_posts()){ ?>
			<div class="xoxo_fn_bloglist blog_layout_classic">
				<ul>
					<?php get_template_part( 'inc/templates/posts', '', array('from_page' => 'search', 'from_ajax' => $fromAjax, 'loop' => $loop)  );?>
				</ul>
			</div>
			<?php xoxo_fn_pagination($loop->found_posts, true);wp_reset_postdata(); ?>
			<?php }else{ ?>
			<div class="xoxo_fn_protected">
				<div class="container">
					<div class="message_holder">
						<span class="icon">
							<?php echo wp_kses_post(xoxo_fn_getSVG_theme('browser'));?>
						</span>
						<?php 
							echo wp_kses($seo_404_not_found__start,'post');
							echo esc_html($nothing_found);
							echo wp_kses($seo_404_not_found__end,'post');
						?>
						<?php 
							echo wp_kses($seo_404_desc__start,'post');
							esc_html_e('Sorry, no content matched your criteria. Try searching for something else.', 'xoxo');
							echo wp_kses($seo_404_desc__end,'post');
						?>
						<div class="container-custom">
							<form action="<?php echo esc_url(home_url('/')); ?>" method="get" >
								<input type="text" placeholder="<?php esc_attr_e('Search here...','xoxo');?>" name="s" autocomplete="off" />
								<div class="search"><input type="submit" class="pe-7s-search" value="Search" /></div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
		<?php if(have_posts()){ ?>
		</div>
		<?php } ?>
	</div>

	<?php }else{ ?>

	<?php 
		if(have_posts()){
			xoxo_fn_get_page_title();
		}
	?>

	<div class="xoxo_fn_searchpagelist">
		<?php if(have_posts()){ ?>
		<div class="container">
		<?php } ?>
		<?php if(have_posts()){ ?>
			<div class="xoxo_fn_bloglist blog_layout_classic">
				<ul>
					<?php get_template_part( 'inc/templates/posts', '', array('from_page' => 'search')  );?>
				</ul>
			</div>
			<?php xoxo_fn_pagination(); ?>
			<?php }else{ ?>
			<div class="xoxo_fn_protected">
				<div class="container">
					<div class="message_holder">
						<span class="icon">
							<?php echo wp_kses_post(xoxo_fn_getSVG_theme('browser'));?>
						</span>
						<?php 
							echo wp_kses($seo_404_not_found__start,'post');
							echo esc_html($nothing_found);
							echo wp_kses($seo_404_not_found__end,'post');
						?>
						<?php 
							echo wp_kses($seo_404_desc__start,'post');
							esc_html_e('Sorry, no content matched your criteria. Try searching for something else.', 'xoxo');
							echo wp_kses($seo_404_desc__end,'post');
						?>
						<div class="container-custom">
							<form action="<?php echo esc_url(home_url('/')); ?>" method="get" >
								<input type="text" placeholder="<?php esc_attr_e('Search here...','xoxo');?>" name="s" autocomplete="off" />
								<div class="search"><input type="submit" class="pe-7s-search" value="<?php esc_attr_e('Search','xoxo');?>" /></div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
		<?php if(have_posts()){ ?>
		</div>
		<?php } ?>
	</div>

	<?php wp_reset_postdata(); ?>
	
	<?php } ?>
	
</div>
<!-- /SEARCH --> 
        
<?php get_footer(); ?>