<?php 

	$xoxo_fn_option = xoxo_fn_theme_option();
	$default_logo = xoxo_fn_getLogo();

	$logo = '<a href="'.esc_url(home_url('/')).'">';
		$logo .= '<img class="retina_logo" src="'.esc_url($default_logo[0]).'" alt="'.esc_attr__('logo', 'xoxo').'" />';
		$logo .= '<img class="desktop_logo" src="'.esc_url($default_logo[1]).'" alt="'.esc_attr__('logo', 'xoxo').'" />';
	$logo .= '</a>';


	if(has_nav_menu('main_menu')){
		$menu = wp_nav_menu( array('theme_location'  => 'main_menu','menu_class' => 'xoxo_fn_main_nav', 'echo' => false, 'link_before' => '<span><span>', 'link_after' => '</span><span class="suffix">//</span></span>') );
	}

	$socialList = xoxo_fn_getSocialList();
	$social_switcher = 'disable';
	if($socialList !== ''){
		$social_switcher = 'enable';
	}

	$search_switcher = 'enable';
	if(isset($xoxo_fn_option['search_switcher'])){
		$search_switcher = $xoxo_fn_option['search_switcher'];
	}

	$single_sticky_title = 'enable';
	if(isset($xoxo_fn_option['single_sticky_title'])){
		$single_sticky_title = $xoxo_fn_option['single_sticky_title'];
	}
	
	$ajax_reading = false;
	if($single_sticky_title == 'enable' && is_singular('post')){
		$ajax_reading = true;
	}
?>

<!-- Header -->
<header id="xoxo_fn_header">
	<div class="xoxo_fn_header">
		<div class="container">
			<div class="header_top">
				<span class="wing_left"></span>
				<span class="wing_right"></span>
				<?php if($social_switcher == 'enable'){ ?>
				<!-- Social List -->
				<div class="social">
					<?php echo wp_kses($socialList,'post');?>
				</div>
				<!-- !Social List -->
				<?php }else if($search_switcher == 'enable'){ ?>
					<div class="search_opener hide_me">
						<a href="#">
							<span class="text"><?php esc_html_e('Search','xoxo');?></span>
							<span class="icon"><?php echo wp_kses_post(xoxo_fn_getSVG_theme('search'));?></span>
						</a>
					</div>
				<?php } ?>

				<div class="logo">
					<?php echo wp_kses($logo, 'post'); ?>
				</div>

				<?php if($search_switcher == 'enable'){ ?>
				<div class="search_opener">
					<a href="#">
						<span class="text"><?php esc_html_e('Search','xoxo');?></span>
						<span class="icon"><?php echo wp_kses_post(xoxo_fn_getSVG_theme('search'));?></span>
					</a>
				</div>
				<?php } ?>
			</div>
			<?php if(has_nav_menu('main_menu')){ ?>
			<div class="header_bottom">
				<div class="bottom_fixer">
					<div class="xoxo_fn_nav main_nav">
						<span class="wing"></span>
						<div class="menu">
							<?php echo wp_kses($menu, 'post'); ?>
							<div class="more">
								<a href="#">
									<span><?php esc_html_e('More...','xoxo');?></span>
								</a>
								<ul class="sub-menu"><!-- Comes from JS --></ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</header>
<!-- !Header -->




<div class="xoxo_fn_stickynav ajax_<?php echo esc_attr($single_sticky_title);?>">
	<div class="progress"></div>
	<div class="container">
		<div class="transform_hedaer">
			<div class="sticky_header">
				<div class="xoxo_fn_nav sticky_nav">
					<?php if(has_nav_menu('main_menu')){ ?>
					<div class="menu">
						<?php echo wp_kses($menu, 'post'); ?>
						<div class="more">
							<a href="#">
								<span><?php esc_html_e('More...','xoxo');?></span>
							</a>
							<ul class="sub-menu"><!-- Comes from JS --></ul>
						</div>
					</div>
					<?php } ?>
					<div class="icon_bar">
						<div class="icon_bar__item icon_bar__home">
							<a href="<?php echo esc_url(home_url('/')); ?>"><?php echo wp_kses_post(xoxo_fn_getSVG_theme('home'));?></a>
						</div>
						<?php if($social_switcher == 'enable') { ?>
						<div class="icon_bar__item icon_bar__share">
							<a href="#"><?php echo wp_kses_post(xoxo_fn_getSVG_theme('share'));?></a>
							<?php echo wp_kses($socialList,'post');?>
						</div>
						<?php } ?>
						<?php if($search_switcher == 'enable'){ ?>
						<div class="icon_bar__item icon_bar__search">
							<a href="#"><?php echo wp_kses_post(xoxo_fn_getSVG_theme('search'));?></a>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
			<?php if($ajax_reading){ ?>
			<div class="header_post_reading">
				<div class="reading_post">
					<h3>
						<span class="subtitle"><?php esc_html_e('Now Reading:','xoxo'); ?></span>
						<span class="title"><?php the_title();?></span>
					</h3>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
	
</div>



<?php if($search_switcher == 'enable'){ ?>
<!-- Searchbox -->
<div class="xoxo_fn_searchbox">
	<a href="#" class="search_closer"><span></span></a>
	<div class="container">
		<div class="search_content">
			<div class="search_wrapper">
				<form class="main_form" action="<?php echo esc_url(home_url('/')); ?>" method="get" >
					<div class="input">
						<input type="text" placeholder="<?php esc_attr_e('Type at least one character to search...', 'xoxo');?>" name="s" autocomplete="off" />
					</div>
					<div class="search">
						<input type="submit" class="pe-7s-search" value="<?php esc_attr_e('Search', 'xoxo');?>" />
						<?php echo wp_kses_post(xoxo_fn_getSVG_theme('search'));?>
					</div>
				</form>
				<div class="search_result">
					<div class="filterbox">
						<div class="filter title_filter">
							<label>
								<input type="checkbox">
								<span class="icon"><?php echo wp_kses_post(xoxo_fn_getSVG_theme('checked'));?></span>
								<span class="text"><?php esc_html_e('Search in title only','xoxo');?></span>
							</label>
						</div>
						<div class="filter post_filter">
							<label>
								<input type="checkbox">
								<span class="icon"><?php echo wp_kses_post(xoxo_fn_getSVG_theme('checked'));?></span>
								<span class="text"><?php esc_html_e('Search in posts only','xoxo');?></span>
							</label>
						</div>
					</div>
					<div class="resultbox">
						<div class="fn__preloader">
							<span class="icon"></span>
							<span class="text"><?php esc_html_e('Loading','xoxo');?></span>
						</div>
						<div class="result_content">
							<div class="result_list"><ul></ul></div>
							<div class="result_info"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- !Searchbox -->
<?php } ?>

<div class="fn_ajax__preloader">
	<div class="icon"></div>
	<div class="text"><?php esc_html_e('Loading','xoxo');?></div>
</div>






<div class="fn__popupbox_iframe">
	<a href="#" class="iframe_closer"><span></span></a>
	<div class="iframe_content">
		
	</div>
</div>