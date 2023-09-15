<?php

function xoxo_fn_inline_styles() {
	
	$xoxo_fn_option = xoxo_fn_theme_option();
	
	
	
	wp_enqueue_style('xoxo_fn_inline', get_template_directory_uri().'/framework/css/inline.css', array(), XOXO_THEME_URL, 'all');
	/************************** START styles **************************/
	$xoxo_fn_custom_css 		= "";
	
	
	// fix adminbar issue
	$xoxo_fn_custom_css .= "
		@media(max-width: 600px){
			#wpadminbar{position: fixed;}
		}
	";
	
	$headingFont = 'Montserrat';
	if(isset($xoxo_fn_option['heading_font']['font-family'])){
		$headingFont = $xoxo_fn_option['heading_font']['font-family'];
	}
	
	$bodyFont = 'Work Sans';
	if(isset($xoxo_fn_option['body_font']['font-family'])){
		$bodyFont = $xoxo_fn_option['body_font']['font-family'];
	}
	$xoxo_fn_custom_css .= "
		:root{
			--hff: {$headingFont};
			--bff: {$bodyFont};
		}
	";
	
	$single_comment_action = 'closed';
	if(isset($xoxo_fn_option['single_comment_action'])){
		$single_comment_action = $xoxo_fn_option['single_comment_action'];
	}
	if($single_comment_action == 'open'){
		$xoxo_fn_custom_css .= ".fn__comments{display: block;}";
	}
	
	// Magic Cursor
	$mcursor_color 		= '#fff';
	if(isset($xoxo_fn_option['mcursor_color'])){
		$mcursor_color 	= $xoxo_fn_option['mcursor_color'];
	}
	$mcursor_5 			= xoxo_fn_hex2rgba($mcursor_color,0.7);
	$mcursor_1	 		= xoxo_fn_hex2rgba($mcursor_color,0.1);
	$xoxo_fn_custom_css .= "
		.cursor-inner.cursor-slider.cursor-hover span:after,
		.cursor-inner.cursor-slider.cursor-hover span:before{
			background-color: {$mcursor_color};
		}
		.cursor-outer .fn-cursor,.cursor-inner.cursor-slider:not(.cursor-hover) .fn-cursor{
			border-color: {$mcursor_5};
		}
		.cursor-inner .fn-cursor,.cursor-inner .fn-left:before,.cursor-inner .fn-left:after,.cursor-inner .fn-right:before,.cursor-inner .fn-right:after{
			background-color: {$mcursor_5};
		}
		.cursor-inner.cursor-hover .fn-cursor{
			background-color: {$mcursor_1};
		}
	";
	
	
	
	
	/* Main Color #1 */
	$body_bg_color = '#fff5cf';
	if(isset($xoxo_fn_option['body_bg_color'])){
		$body_bg_color = $xoxo_fn_option['body_bg_color'];
	}
	
	/* Main Color #1 */
	$main_color_1 = '#ffcc00';
	if(isset($xoxo_fn_option['main_color_1'])){
		$main_color_1 = $xoxo_fn_option['main_color_1'];
	}
	
	/* Main Color #2 */
	$main_color_2 = '#f16363';
	if(isset($xoxo_fn_option['main_color_2'])){
		$main_color_2 = $xoxo_fn_option['main_color_2'];
	}
	
	/* Heading Color */
	$heading_color = '#000';
	if(isset($xoxo_fn_option['heading_color'])){
		$heading_color = $xoxo_fn_option['heading_color'];
	}
	
	/* Heading Hover Color */
	$heading_hover_color = '#f16363';
	if(isset($xoxo_fn_option['heading_hover_color'])){
		$heading_hover_color = $xoxo_fn_option['heading_hover_color'];
	}
	
	/* Body Color */
	$body_color = '#000';
	if(isset($xoxo_fn_option['body_color'])){
		$body_color = $xoxo_fn_option['body_color'];
	}
	
	$xoxo_fn_custom_css .= "
		:root{
			--xoxo-bbc: {$body_bg_color};
			--xoxo-mc1: {$main_color_1};
			--xoxo-mc2: {$main_color_2};
			--xoxo-hc: {$heading_color};
			--xoxo-hhc: {$heading_hover_color};
			--xoxo-bc: {$body_color};
		}
	";
	
	$blog_gap = 60;
	if(isset($xoxo_fn_option['blog_gap'])){
		$blog_gap = $xoxo_fn_option['blog_gap'];
	}
	$blog_gap = (int)$blog_gap;
	$blog_gap_6 = $blog_gap + 6;
	$blog_gap__1200 = (int)(($blog_gap * 2)/3);
	$blog_gap__1200_6 = $blog_gap__1200 + 6;
	$blog_gap__1040 = (int)($blog_gap / 2);
	$blog_gap__1040_6 = $blog_gap__1040 + 6;
	$xoxo_fn_custom_css .= "
		.xoxo_fn_rightsidebar{
			padding-left: {$blog_gap}px;
		}
		.xoxo_fn_bloglist .post_item{
			padding-left: {$blog_gap}px;
			margin-bottom: {$blog_gap_6}px;
		}
		.xoxo_fn_hassidebar .widget_block{
			margin-bottom: {$blog_gap_6}px;
		}
		.xoxo_fn_hassidebar .sidebarpage{
			margin-left: -{$blog_gap}px;
		}
		@media(max-width: 1200px){
			.xoxo_fn_rightsidebar{
				padding-left: {$blog_gap__1200}px;
			}
			.xoxo_fn_bloglist .post_item{
				padding-left: {$blog_gap__1200}px;
				margin-bottom: {$blog_gap__1200_6}px;
			}
			.xoxo_fn_hassidebar .widget_block{
				margin-bottom: {$blog_gap__1200_6}px;
			}
			.xoxo_fn_hassidebar .sidebarpage{
				margin-left: -{$blog_gap__1200}px;
			}
		}
		@media(max-width: 768px){
			.xoxo_fn_rightsidebar{
				padding-left: {$blog_gap__1040}px;
			}
			.xoxo_fn_bloglist .post_item{
				padding-left: {$blog_gap__1040}px;
				margin-bottom: {$blog_gap__1040_6}px;
			}
			.xoxo_fn_hassidebar .widget_block{
				margin-bottom: {$blog_gap__1040_6}px;
			}
			.xoxo_fn_hassidebar .sidebarpage{
				margin-left: -{$blog_gap__1040}px;
			}
		}
	";
	
	
	/****************************** END styles *****************************/
	if(isset($xoxo_fn_option['custom_css'])){
		$xoxo_fn_custom_css .= "{$xoxo_fn_option['custom_css']}";	
	}

	wp_add_inline_style( 'xoxo_fn_inline', $xoxo_fn_custom_css );

			
}

?>