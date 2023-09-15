<?php 

get_header();

global $post;
$xoxo_fn_option = xoxo_fn_theme_option();
$style 	= '';

if(function_exists('rwmb_meta')){
	$style 	= get_post_meta(get_the_ID(),'xoxo_fn_page_style', true);
}

if($style == 'ws' && !xoxo_fn_if_has_sidebar()){
	$style	= 'full';
}

// CHeck if page is password protected	
if(post_password_required($post)){
	$protected = xoxo_fn_protectedpage();
	echo wp_kses($protected, 'post');
}
else
{
 	
?>




<div class="xoxo_fn_full_page_template">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
	<?php xoxo_fn_get_page_title(); ?>
				
	<!-- ALL PAGES -->		
	<div class="xoxo_fn_full_page_in">

		<?php if($style == 'full' || $style == 'ffull'){ ?>
		
		<div class="container">
			<div class="full_content">
				<?php the_content(); ?>

				<?php wp_link_pages(
					array(
						'before'      => '<div class="xoxo_fn_pagelinks"><span class="title">' . esc_html__( 'Pages:', 'xoxo' ). '</span>',
						'after'       => '</div>',
						'link_before' => '<span class="number">',
						'link_after'  => '</span>',
					)); 
				?>
			</div>
		</div>
		
		<?php if ( comments_open() || get_comments_number()){?>
		<div class="clearfix"></div>
		<div class="xoxo_fn_comment_wrapper">
			<div class="container">
				<div class="xoxo_fn_commentss" id="comments">
					<?php echo wp_kses(xoxo_fn_get_comments(),'post'); ?>
				</div>
			</div>
		</div>
		<?php } ?>
		
		
		<?php }else if($style == 'ffull'){ ?>
		
		<div class="full_content">
			<?php the_content(); ?>

			<?php wp_link_pages(
				array(
					'before'      => '<div class="xoxo_fn_pagelinks"><span class="title">' . esc_html__( 'Pages:', 'xoxo' ). '</span>',
					'after'       => '</div>',
					'link_before' => '<span class="number">',
					'link_after'  => '</span>',
				)); 
			?>
		</div>
		
		<?php if ( comments_open() || get_comments_number()){?>
		<div class="clearfix"></div>
		<div class="xoxo_fn_comment_wrapper">
			<div class="container">
				<div class="xoxo_fn_commentss" id="comments">
					<?php echo wp_kses(xoxo_fn_get_comments(),'post'); ?>
				</div>
			</div>
		</div>
		<?php } ?>
		
		<?php }else if($style == 'ws'){ ?>
		
		<div class="xoxo_fn_hassidebar">
			<div class="container">
				<div class="sidebarpage">

					<div class="xoxo_fn_leftsidebar">
						<div class="ls_content">
							<?php the_content(); ?>

							<?php wp_link_pages(
								array(
									'before'      => '<div class="xoxo_fn_pagelinks"><span class="title">' . esc_html__( 'Pages:', 'xoxo' ). '</span>',
									'after'       => '</div>',
									'link_before' => '<span class="number">',
									'link_after'  => '</span>',
								)); 
							?>
							<?php if ( comments_open() || get_comments_number()){?>
							<div class="clearfix"></div>
							<div class="xoxo_fn_comment_wrapper">
								<div class="container">
									<div class="xoxo_fn_commentss" id="comments">
										<?php echo wp_kses(xoxo_fn_get_comments(),'post'); ?>
									</div>
								</div>
							</div>
							<?php } ?>
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
		
		<?php } ?>
		
	<?php endwhile; endif; ?>
	</div>
</div>





<?php } ?>

<?php get_footer(); ?>  