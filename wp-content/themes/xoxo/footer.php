<?php 
$xoxo_fn_option 	= xoxo_fn_theme_option();

// magic cursor options
$magic_cursor 		= array();
if(isset($xoxo_fn_option['magic_cursor'])){
	$magic_cursor 	= $xoxo_fn_option['magic_cursor'];
}
$mcursor__count		= 0;
$mcursor__default 	= 'no';
$mcursor__link 		= 'no';
$mcursor__slider 	= 'no';
if(!empty($magic_cursor)){
	$mcursor__count = count($magic_cursor);
	foreach($magic_cursor as $key => $value) {
		if($value == 'default'){$mcursor__default 	= 'yes';}
		if($value == 'link'){$mcursor__link 		= 'yes';}
		if($value == 'slider'){$mcursor__slider 	= 'yes';}
	}
}
if(isset($_GET['remove_mcursor'])){
	$mcursor__count = 0;
}

// totop switcher
$totop_switcher = 'enable';
if(isset($xoxo_fn_option['totop_switcher'])){
	$totop_switcher = $xoxo_fn_option['totop_switcher'];
}


// footer logo
if(isset($xoxo_fn_option['footer_logo']['url']) && $xoxo_fn_option['footer_logo']['url'] != ''){
	$logo = $xoxo_fn_option['footer_logo']['url'];
}else{
	$logo = get_template_directory_uri().'/framework/img/logo/footer-logo.png';
}


// footer subscribe form
$footer_subscribe_switcher = 'disable';
$footer_subscribe_shortocde = '';
if(isset($xoxo_fn_option['footer_subscribe_switcher'])){
	$footer_subscribe_switcher = $xoxo_fn_option['footer_subscribe_switcher'];
}
if($footer_subscribe_switcher == 'enable'){
	if(isset($xoxo_fn_option['footer_subscribe_shortocde'])){
		$footer_subscribe_shortocde = $xoxo_fn_option['footer_subscribe_shortocde'];
	}
}

?>
			</div>
			
			<div class="clearfix"></div>
			
			<!-- Footer -->
			<footer id="xoxo_fn_footer">
				<div class="xoxo_fn_footer">
					
					<?php if($footer_subscribe_shortocde != ''){ ?>
					<div class="footer_top">
						<div class="container">
							<div class="footer_subscribe_form">
								<?php echo wp_kses(xoxo_fn_getSVG_theme('paper-plane'),'post');?>
								<h3 class="fsf_title">Stay in the loop</h3>
								<p class="fsf_desc">Get the latest posts delivered right to your email.</p>
								<?php //echo do_shortcode( shortcode_unautop( '[wpforms id="1836" title="false"]' ) ); ?>
								<?php echo do_shortcode( shortcode_unautop( $footer_subscribe_shortocde ) ); ?>
							</div>
						</div>
					</div>
					<?php } ?>
					
					<div class="footer_bottom">
						<div class="container">
							<div class="footer_btm_in">
								<span class="wing_left"></span>
								<span class="wing_right"></span>
								<?php if ( is_active_sidebar( 'footer-bottom-widget' )){ ?>
								<div class="footer_widgets">
									<?php dynamic_sidebar( 'footer-bottom-widget' ); ?>
								</div>
								<?php } ?>
								<div class="footer_copyright">
									<p>
										<?php 
											if(isset($xoxo_fn_option['footer__copyright'])){
												echo wp_kses(do_shortcode( shortcode_unautop( $xoxo_fn_option['footer__copyright'] )) , 'post');
											}else{
												$linkS = '<a href="https://frenify.com/" target="_blank">';
												$linkE = '</a>';
												$copyright = sprintf( esc_html__( '&copy; 2023 %1$sFrenify%2$s, All Rights Reserved.', 'xoxo' ), $linkS, $linkE );
												echo wp_kses($copyright, 'post');
											}
										?>
									</p>
								</div>
							</div>
						</div>
					</div>
					
				</div>
			</footer>
			<!-- !Footer -->

		</div>
			
	</div>
	<!-- All website content ends here -->
	
	
	<?php if($mcursor__count > 0){ ?>
	<div class="frenify-cursor cursor-outer" data-default="<?php echo esc_attr($mcursor__default);?>" data-link="<?php echo esc_attr($mcursor__link);?>" data-slider="<?php echo esc_attr($mcursor__slider);?>"><span class="fn-cursor"></span></div>
	<div class="frenify-cursor cursor-inner" data-default="<?php echo esc_attr($mcursor__default);?>" data-link="<?php echo esc_attr($mcursor__link);?>" data-slider="<?php echo esc_attr($mcursor__slider);?>"><span class="fn-cursor"><span class="fn-left"></span><span class="fn-right"></span></span></div>
	<?php } ?>
	

	<?php if($totop_switcher == 'enable') { ?>
	<a class="xoxo_fn_totop">
		<span class="progress_wrapper"><span class="progress"></span></span>
		<?php echo wp_kses(xoxo_fn_getSVG_theme('arrowo'),'post');?>
   	</a>
	<?php } ?>
   	
   	
   	<?php 
		$single_sticky_title = 'enable';
		if(isset($xoxo_fn_option['single_sticky_title'])){
			$single_sticky_title = $xoxo_fn_option['single_sticky_title'];
		}

		$ajax_reading = false;
		if($single_sticky_title == 'enable' && is_singular('post')){
			$ajax_reading = true;
		}
	
	?>
  	<?php if($ajax_reading){ ?>
   	<div class="fn__blog_anchor">
		<span class="closer"></span>
   		<div class="ba_in">
   			<div class="ba_heading">
   				<?php esc_html_e('Quick Navigation','xoxo'); ?>
   			</div>
   			<div class="ba_content">
   				<ul>
   					<li class="ready">
   						<div class="ba_item" data-id="<?php echo esc_attr(get_the_ID());?>">
   							<span class="ba_count"><span>01</span></span>
							<h4><span><?php the_title();?></span></h4>
   						</div>
   					</li>
   				</ul>
   			</div>
   		</div>
   	</div>
   	<?php } ?>

</div>
<!-- HTML ends here -->



<div class="clearfix"></div>
<?php wp_footer(); ?>
</body>
</html>