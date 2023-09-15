<?php 
	$xoxo_fn_option = xoxo_fn_theme_option();

	$logos = xoxo_fn_getLogo('mobile');

	$logo  = '<div class="fn_logo">';
		$logo .= '<a href="'.esc_url(home_url('/')).'">';
			$logo .= '<img class="mobile_logo" src="'.esc_url($logos[1]).'" alt="'.esc_html__('logo', 'xoxo').'" />';
			$logo .= '<img class="mobile_retina_logo" src="'.esc_url($logos[0]).'" alt="'.esc_html__('logo', 'xoxo').'" />';
		$logo .= '</a>';
	$logo .= '</div>';


	if(has_nav_menu('mobile_menu')){
		$menu = wp_nav_menu( array('theme_location'  => 'mobile_menu','menu_class' => 'mobile_menu', 'echo' => false, 'link_before' => '<span><span>', 'link_after' => '</span><span class="suffix">//</span></span>') );
	}

	$search_switcher = 'enable';
	if(isset($xoxo_fn_option['search_switcher'])){
		$search_switcher = $xoxo_fn_option['search_switcher'];
	}

	$featured_bar = 'enable';
	if(isset($xoxo_fn_option['featured_bar'])){
		$featured_bar = $xoxo_fn_option['featured_bar'];
	}
	$socialList = xoxo_fn_getSocialList();
	$social_switcher = 'disable';
	if($socialList !== ''){
		$social_switcher = 'enable';
	}
?>

<!-- Mobile Navigation -->
<div class="xoxo_fn_mobnav">
	<div class="mob_top">
		<div class="logo">
			<?php echo wp_kses($logo, 'post'); ?>
		</div>
		<?php if(has_nav_menu('mobile_menu')){ ?>
		<div class="right__triggerr">
			<?php if($search_switcher == 'enable') { ?>
			<a class="mobsearch_opener" href="#">
				<?php echo wp_kses_post(xoxo_fn_getSVG_theme('search'));?>
			</a>
			<?php } ?>
			<a class="mobmenu_opener" href="#">
				<span><span>
			</a>
		</div>
		<?php } ?>
	</div>
	
	<div class="mob_bot">
		<?php 
			if($social_switcher == 'enable'){
				echo wp_kses($socialList,'post');
			}else{ ?>
				<div class="border_top"></div>
			<?php }
			if(has_nav_menu('mobile_menu')){
				echo wp_kses($menu, 'post');
			}
		?>
	</div>
</div>
<!-- !Mobile Navigation -->