<?php

get_header();

global $post;
$xoxo_fn_pagestyle = 'full';

if($xoxo_fn_pagestyle == 'ws' && !xoxo_fn_if_has_sidebar()){
	$xoxo_fn_pagestyle = 'full';
}

$layout = 'classic';
if(isset($xoxo_fn_option['blog_category_layout'])){
	$layout = $xoxo_fn_option['blog_category_layout'];
}
if($layout == 'classic_s'){
	$xoxo_fn_pagestyle = 'ws';
	$layout = 'classic';
}else if($layout == 'masonry_s'){
	$xoxo_fn_pagestyle = 'ws';
	$layout = 'masonry';
}

// Check if page is password protected	
if(post_password_required($post)){
	$protected = xoxo_fn_protectedpage();
	echo wp_kses($protected, 'post');
}else{ ?>

<div class="xoxo_fn_index">
	
	<?php xoxo_fn_get_page_title(); ?>

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
	

	<?php } ?>
</div>

<?php } ?>

<?php get_footer(); ?>  