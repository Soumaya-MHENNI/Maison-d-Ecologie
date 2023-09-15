<?php

get_header();

global $post;
$xoxo_fn_pagestyle = 'ws';

$layout = 'classic';
if(isset($xoxo_fn_option['blog_author_layout'])){
	$layout = $xoxo_fn_option['blog_author_layout'];
}

// Check if page is password protected	
if(post_password_required($post)){
	$protected = xoxo_fn_protectedpage();
	echo wp_kses($protected, 'post');
}else{ ?>

<div class="xoxo_fn_index">
	
	<?php xoxo_fn_get_page_title(); ?>
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
						<?php xoxo_fn_pagination(); ?>
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
</div>

<?php } ?>

<?php get_footer(); ?>  