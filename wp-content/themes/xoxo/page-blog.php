<?php
/*
	Template Name: Blog Page
*/
get_header();

global $post;
$xoxo_fn_option = xoxo_fn_theme_option();

$xoxo_fn_pagestyle = 'full';

if(function_exists('rwmb_meta')){
	$xoxo_fn_pagestyle 		= get_post_meta(get_the_ID(), 'xoxo_fn_page_style', true);
}
if($xoxo_fn_pagestyle == 'ws' && !xoxo_fn_if_has_sidebar()){
	$xoxo_fn_pagestyle = 'full';
}

$layout = 'classic';
if(isset($xoxo_fn_option['blog_bloglist_layout'])){
	$layout = $xoxo_fn_option['blog_bloglist_layout'];
}
if(function_exists('rwmb_meta')){
	if(isset(get_post_meta(get_the_ID())['xoxo_fn_blogpage_style'])){
		$layout = get_post_meta(get_the_ID(), 'xoxo_fn_blogpage_style', true);
	}
}

// Check if page is password protected	
if(post_password_required($post)){
	$protected = xoxo_fn_protectedpage();
	echo wp_kses($protected, 'post');
}else{ ?>

<div class="xoxo_fn_index">

	<?php xoxo_fn_get_page_title(); ?>
	
	<?php
		$featured_post__html = '';
		$featured_posts_switcher = 'disable';
		if(isset($xoxo_fn_option['featured_posts_switcher'])){
			$featured_posts_switcher = $xoxo_fn_option['featured_posts_switcher'];
		}
		if(function_exists('rwmb_meta')){
			if(isset(get_post_meta(get_the_ID())['xoxo_fn_blogpage_featured'])){
				$featured_posts_switcher = get_post_meta(get_the_ID(), 'xoxo_fn_blogpage_featured', true);
			}
		}
		if($featured_posts_switcher == 'enable'){
			$featured_posts_type = 'random';
			if(isset($xoxo_fn_option['featured_posts_type'])){
				$featured_posts_type = $xoxo_fn_option['featured_posts_type'];
			}
			$featured_posts__count = 3;
			if(isset($xoxo_fn_option['featured_posts__count'])){
				$featured_posts__count = $xoxo_fn_option['featured_posts__count'];
			}
			if($featured_posts_type == 'random'){
				$query_args = array(	
					'post_type' 			=> 'post',
					'post_status' 			=> 'publish',
					'ignore_sticky_posts' 	=> true,
					'posts_per_page' 		=> $featured_posts__count,
					'orderby' 				=> 'rand',
					'meta_query' => array( 
						array(
							'key' => '_thumbnail_id'
						) 
					)
				);
				$loop 	= new \WP_Query($query_args);;
				if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post();
				$postID = get_the_ID();
				$permalink = get_the_permalink();
				$featured_img_url = get_the_post_thumbnail_url($postID,'full');
				$has_img = 0;
				if($featured_img_url != ''){
					$has_img = 1;
				}
				$title = get_the_title();
				$title = $title == '' ? esc_html__('(no title)','xoxo') : $title;
				$featured_post__html .= '<div class="swiper-slide"><div class="item"><div class="img_wrap"><div class="img_holder"><div class="abs_img" data-bg-img="'.$featured_img_url.'"></div></div></div><div class="title_holder"><h3><a href="'.$permalink.'">'.$title.'</a></h3>'.xoxo_fn_metas($postID,true).'</div></div></div>'; 
				endwhile; endif;
			}else if($featured_posts_type == 'custom'){
				if(isset($xoxo_fn_option['featured_posts_custom'])){
					$custom = $xoxo_fn_option['featured_posts_custom'];
					if(!empty($custom)){
						foreach($custom as $postID){
							$permalink = get_the_permalink($postID);
							$featured_img_url = get_the_post_thumbnail_url($postID,'full');
							$has_img = 0;
							if($featured_img_url != ''){
								$has_img = 1;
							}
							$title = get_the_title($postID);
							$title = $title == '' ? esc_html__('(no title)','xoxo') : $title;
							$featured_post__html .= '<div class="swiper-slide"><div class="item"><div class="img_wrap"><div class="img_holder"><div class="abs_img" data-bg-img="'.$featured_img_url.'"></div></div></div><div class="title_holder"><h3><a href="'.$permalink.'">'.$title.'</a></h3>'.xoxo_fn_metas($postID,true).'</div></div></div>'; 
						}
					}
				}
			}
		}

		if($featured_post__html != ''){
			$icon = xoxo_fn_getSVG_theme('arrowo');
			$featured_post__html = '<div class="fn__bp_slider"><div class="container"><div class="bp_slider_in"><div class="swiper-container"><div class="swiper-wrapper">'.$featured_post__html.'</div></div><div class="slider__nav"><a href="#" class="slider_nav prev">'.$icon.'</a><a href="#" class="slider_nav next">'.$icon.'</a></div></div></div></div>';
		}
	  	echo wp_kses($featured_post__html, 'post');
	?>
	
	
	<?php if($xoxo_fn_pagestyle == 'full'){ ?>
	

	<!-- WITHOUT SIDEBAR -->
	<div class="xoxo_fn_nosidebar">
		<div class="container blog_layout_<?php echo esc_attr($layout); ?>_container">
			<div class="xoxo_fn_bloglist blog_layout_<?php echo esc_attr($layout); ?>">
				<ul>
					<?php 
						get_template_part( 
							'inc/templates/posts',
							'',
							array(
								'layout' => $layout
							)
						);
					?>
				</ul>
			</div>
		</div>
		<?php xoxo_fn_pagination(); ?>
	</div>
	<!-- /WITHOUT SIDEBAR -->
	<?php }else{ ?>

	<!-- WITH SIDEBAR -->
	<div class="xoxo_fn_hassidebar">
		<div class="container">
			<div class="sidebarpage">
			
				<div class="xoxo_fn_leftsidebar">
					<div class="ls_content">
						<div class="xoxo_fn_bloglist blog_layout_<?php echo esc_attr($layout); ?>">
							<ul>
								<?php 
									get_template_part( 
										'inc/templates/posts',
										'',
										array(
											'layout' => $layout
										)
									);
								?>
							</ul>
						</div>
						<?php xoxo_fn_pagination();?>
					</div>
				</div>

				<div class="xoxo_fn_rightsidebar">
					<div class="sidebar_in">
						<?php get_sidebar(); ?>
					</div>
				</div>
				
			</div>
		</div>
	</div>
	<!-- /WITH SIDEBAR -->
	

	<?php } ?>
</div>

<?php } ?>

<?php get_footer(); ?>  