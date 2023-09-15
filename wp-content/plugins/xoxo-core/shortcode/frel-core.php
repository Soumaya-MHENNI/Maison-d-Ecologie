<?php

// Exit if accessed directly. 
if ( ! defined( 'ABSPATH' ) ) { exit; }


if ( ! class_exists( 'Frel_Core' ) ) 
{
	
	class Frel_Core {
		
		// ---------------------------------------------------------
		// VARIABLES
		// ---------------------------------------------------------
		private static $instance = null;
		
		public $version = '1.0.0.0';
		
		private $plugin_path = null;
		
		
		// ---------------------------------------------------------
		// FUNCTIONS
		// ---------------------------------------------------------
		
		// Disable class cloning
		public function __clone() 
		{

			// Cloning instances of the class is forbidden
			_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'xoxo-core' ));

		}
		
		
		// Disable unserializing the class.
		public function __wakeup() 
		{

			// Unserializing instances of the class is forbidden.
			_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'xoxo-core' ));

		}
		
		
		public function __construct() 
		{
			
			$this->includes();
			$this->init_hooks();
			
		
		}
		
		
		// Includes
		public function includes() 
		{

			require_once( __DIR__ . '/frel-plugin.php' );
			require_once( __DIR__ . '/includes/frel-helper.php' );
			require_once( __DIR__ . '/includes/xoxo_fn_vote.php' );
			require_once( __DIR__ . '/includes/xoxo_fn_reactions.php' );
		}
		
		
		// Hook into actions and filters.
		private function init_hooks() 
		{

			add_action( 'plugins_loaded', [ $this, 'init' ] );

		}
		
		
		// Check if elementor exists
		public function init() 
		{
			
			// Frel Classes
			new \Frel\Frel_Plugin();
		}
		
		
		// Warning when the site doesn't have Elementor installed or activated.
		public function admin_notice_missing_main_plugin() 
		{
			$message = sprintf(
				/* translators: 1: Frel 2: Elementor */
				esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'xoxo-core' ),
				'<strong>' . esc_html__( 'Frel', 'xoxo-core' ) . '</strong>',
				'<strong>' . esc_html__( 'Elementor', 'xoxo-core' ) . '</strong>'
			);
			printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

		}
		
		
		
		
		// Returns the instance.
		public static function get_instance() 
		{
			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}
			return self::$instance;
		}
		
	}
	
}


if ( ! function_exists( 'frel_load' ) ) 
{
	// Returns instanse of the plugin class.
	function Frel_load() 
	{
		return frel_Core::get_instance();
	}
	
	frel_load();
}
// ---------------------------------------------------------
// REDUX remove demo mode
// ---------------------------------------------------------
function removeDemoModeLinkByFrenify() { 
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
    }
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );    
    }
	
}
add_action('init', 'removeDemoModeLinkByFrenify');


function xoxo_fn_shortcode__year() {
    $output = date('Y');
    return esc_html($output);
}
add_shortcode('current_year', 'xoxo_fn_shortcode__year');


function xoxo_fn_fixedcolpost_items($query_args,$paged = 1){
	$all_count = $query_args['ajax__all_count'];
	$ppp = $query_args['posts_per_page'];
	$query_args['paged'] = $paged;
	
	unset($query_args['ajax__all_count']);
	
	
	// GET Pagination
	$pagination_added = false;
	$pagination = xoxo_fn_custom_pagination(ceil($all_count/$ppp),$paged);
	
	$loop = new \WP_Query($query_args);
	$list = '';
	$read_text = esc_html__('Read More', 'xoxo-core');
	$xxxxx = xoxo_fn_getSVG_theme('xxxxx');
	$arrow = xoxo_fn_getSVG_theme('arrow');
	$key = $myKey = 0;
	$count = $loop->post_count;
	if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post();
		$key++;
		$myKey = $key%6;
		$postID			= get_the_ID();
		$permalink 		= get_permalink();
		$postImage		= get_the_post_thumbnail_url($postID, 'full');
		$postTitle		= get_the_title();
		$category		= xoxo_fn_get_categories(	$postID, 'single', 'post', 1, '');
		$img_holder 	= '';
		$has_image		= 0;
		if($postImage != ''){
			$has_image	= 1;
			$img_holder = '<div class="blog__image"><img src="'.$postImage.'" alt="" />'.$category.'<a href="'.$permalink.'"></a>'.$xxxxx.'</div>';
		}
		$postTitle 		= '<div class="title"><h3><a href="'.$permalink.'">'.$postTitle.'</a></h3></div>';
		$title_holder = '<div class="title_holder"><div class="meta_read">';
		if($has_image == 0){
			$title_holder .= $category;
		}
		$title_holder .= $postTitle.''.xoxo_fn_metas($postID,'search').'</div><div class="read_more second third"><a href="'.$permalink.'"><span class="text">'.$read_text.'</span><span class="icon"><span class="arrow">'.$arrow.'</span><span class="triple"></span></span></a></div></div>';
		if($myKey == 1){
			$img_holder = '<div class="abs_img" data-bg-img="'.$postImage.'"><a href="'.$permalink.'"></a></div>';
			$title_holder = '<div class="title_holder">'.$category.$postTitle.xoxo_fn_metas($postID,'single').'</div>';
			$list .= '<div class="item__group"><div class="left_items">';
		}else if($myKey == 2){
			$list .= '<div class="right_items">';
		}
		$list .= '<div class="item" data-has-img="'.$has_image.'">'.$img_holder.$title_holder.'</div>';
		if($count == $key && $myKey !=1){
			$list.= $pagination;
			$pagination_added = true;
		}
	
		if($myKey == 1){
			$list .= '</div>';
		}else if($myKey == 0){
			$list .= '</div></div>';
		}
		
	endwhile; endif; wp_reset_postdata();
	
	if($myKey == 1){
		$list .= '</div>';
		if(!$pagination_added){
			$list .= '<div class="right_items">'.$pagination.'</div>';
		}
	}else if($myKey != 0){
		$list .= '</div></div>';
	}
	return $list;
}


function xoxo_fn_parallaxclassicpost_items($query_args,$paged = 1){
	$all_count = $query_args['ajax__all_count'];
	$ppp = $query_args['posts_per_page'];
	$query_args['paged'] = $paged;
	
	unset($query_args['ajax__all_count']);
	
	
	// GET Pagination
	$pagination_added = false;
	$pagination = xoxo_fn_custom_pagination(ceil($all_count/$ppp),$paged);
	
	$loop = new \WP_Query($query_args);
	$list = '';
	$xxxxx = xoxo_fn_getSVG_theme('xxxxx');
	$key = 0;
	if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post();
		$key++;$key = $key%2;
		$postID			= get_the_ID();
		$permalink 		= get_permalink();
		$postImage		= get_the_post_thumbnail_url($postID, 'full');
		$postTitle		= get_the_title();
		$category		= xoxo_fn_get_categories(	$postID, 'single', 'post', 1, '');
		$postTitle 		= '<div class="title"><h3><a href="'.$permalink.'">'.$postTitle.'</a></h3></div>';
		$img_holder = '<div class="img_holder"><div class="img_in"><div class="abs_img moving_effect" data-bg-img="'.$postImage.'"></div></div><a href="'.$permalink.'"></a>'.$xxxxx.'</div>';
		$title_holder = '<div class="title_holder"><div class="title_in">'.$category.$postTitle.xoxo_fn_metas($postID,'search').'</div>';
		$list .= '<div class="item item_'.$key.'">'.$img_holder.$title_holder.'</div></div>';
		
		
	endwhile; endif; wp_reset_postdata();
	
	$list .= $pagination;
	
	return $list;
}



function xoxo_fn_ajaxgridpost_items($query_args,$clicked = 0){
	$ratio = $query_args['ajax__ratio'];
	$all_count = $query_args['ajax__all_count'];
	$ppp = $query_args['posts_per_page'];
	$query_args['paged'] = $clicked+1;
	
	unset($query_args['ajax__ratio']);
	unset($query_args['ajax__all_count']);
	
	$size = 'margin-bottom: calc('.$ratio.' * 100%);';
	$size .= 'margin-bottom: -moz-calc('.$ratio.' * 100%);';
	$size .= 'margin-bottom: -webkit-calc('.$ratio.' * 100%);';
	$thumb = '<img style="'.$size.'" src="'.XOXO_CORE_SHORTCODE_URL.'assets/img/thumb-square.jpg" alt="" />';
	$loop = new \WP_Query($query_args);
	$list = '';
	
	if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post();
		$postID			= get_the_ID();
		$permalink 		= get_permalink();
		$postImage		= get_the_post_thumbnail_url($postID, 'full');
		$postTitle		= get_the_title();

		$postTitle 		= '<div class="title"><h3><a href="'.$permalink.'">'.$postTitle.'</a></h3></div>';
		$categories 	= xoxo_fn_get_categories($postID, 'single', 'post', 1);
		$metas 			= xoxo_fn_metas($postID,'search');
		$titleHolder 	= '<div class="title_holder">'.$categories.$postTitle.$metas.'<span class="title_left_wing"></span></div>';

		$list .= '<li><div class="item"><span class="main_left_wing"></span><a class="full_link" href="'.$permalink.'"></a>'.$thumb.'<div class="bg_overlay"></div><div class="img"><div class="abs_img" data-bg-img="'.$postImage.'"></div></div>'.$titleHolder.'</div></li>';
	endwhile; endif; wp_reset_postdata();
	
	if($clicked > 0){
		$disabled = '';
		if((count($loop) + ($ppp*$clicked)) >= $all_count){
			$disabled = 'disabled';
		}
		return array('list' => $list,'disabled' => $disabled);
	}
	return $list;
}

function xoxo_fn_cs_ajax_grid_filter_posts(){
	check_ajax_referer( 'xoxo-secure', 'security' );
	$arguments = array();
	
	if(isset($_POST['myarguments'])){
		$arguments = $_POST['myarguments'];
	}
	
	$clicked = 1;
	if(!empty($_POST['clicked'])){
		$clicked = (int)sanitize_text_field($_POST['clicked']);
	}
	
	
	$list = xoxo_fn_ajaxgridpost_items($arguments,$clicked);
	
	
	
	$buffyArray = array(
		'list' 		=> $list['list'],
		'disabled'	=> $list['disabled'],
    );
	
	die(json_encode($buffyArray));
}

function xoxo_fn_cs_ajax_fixed_col_posts(){
	check_ajax_referer( 'xoxo-secure', 'security' );
	$arguments = array();
	
	if(isset($_POST['myarguments'])){
		$arguments = $_POST['myarguments'];
	}
	
	$paged = 1;
	if(!empty($_POST['paged'])){
		$paged = (int)sanitize_text_field($_POST['paged']);
	}
	
	
	$list = xoxo_fn_fixedcolpost_items($arguments,$paged);
	
	
	
	$buffyArray = array(
		'list' 		=> $list,
    );
	
	die(json_encode($buffyArray));
}

function xoxo_fn_cs_ajax_parallax_classic_posts(){
	check_ajax_referer( 'xoxo-secure', 'security' );
	$arguments = array();
	
	if(isset($_POST['myarguments'])){
		$arguments = $_POST['myarguments'];
	}
	
	$paged = 1;
	if(!empty($_POST['paged'])){
		$paged = (int)sanitize_text_field($_POST['paged']);
	}
	
	
	$list = xoxo_fn_parallaxclassicpost_items($arguments,$paged);
	
	
	
	$buffyArray = array(
		'list' 		=> $list,
    );
	
	die(json_encode($buffyArray));
}

function xoxo_fn_cs_posts_triple($slug,$post_number){
	$postList 	= '';
	$query_args 	= array(
		'post_type' 			=> "post",
		'post_status' 			=> "publish",
		'ignore_sticky_posts' 	=> true,
		'posts_per_page' 		=> $post_number,
	);
	$query_args['tax_query'] = array(
		array(
			'taxonomy' 	=> 'category',
			'field' 	=> 'slug',
			'terms' 	=> array($slug),
			'operator'	=> 'IN'
		)
	);
	$loop 		= new \WP_Query($query_args);
	$xxxxx 		= xoxo_fn_getSVG_theme('xxxxx');
	$arrow		= xoxo_fn_getSVG_theme('arrow');
	$read_text 	= esc_html__('Read More', 'xoxo-core');
	$key = $myKey = 0;
	if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post();
		$key++; $myKey = $key%3;
		$loopPostID			= get_the_ID();
		$mediaID 			= get_post_thumbnail_id( $loopPostID );
		$src 				= wp_get_attachment_image_src( $mediaID, 'full');
		$imageURL = $img_holder = $readSecond = $postTitle = '';
		$has_image			= 0;
		if(isset($src[0])){$imageURL = $src[0];}
		if($imageURL != ''){$has_image = 1;}
		$permalink			= get_the_permalink();
		$title				= get_the_title();
		if($title !== ''){
			$postTitle 	= '<h3 class="fn__maintitle"><a href="'.$permalink.'">'.$title.'</a></h3>';
		}
		$img_holder = '<div class="blog__image">'.xoxo_fn_get_categories(	$loopPostID, 'single', 'post', 1, '').'<div class="abs_img" data-bg-img="'.$imageURL.'"><a href="'.$permalink.'"></a>'.$xxxxx.'</div></div>';
		$title_holder = '<div class="title_holder"><div class="meta_read">'.$postTitle.''.xoxo_fn_metas($loopPostID,'search').'</div><div class="read_more second third"><a href="'.$permalink.'"><span class="text">'.$read_text.'</span><span class="icon"><span class="arrow">'.$arrow.'</span><span class="triple"></span></span></a></div></div>';
		if($myKey == 1){
			$postList .= '<ul class="list_'.($key%6).'">';
		}
		$postList .= '<li><div class="item" data-has-img="'.$has_image.'">'.$img_holder.$title_holder.'</div></li>';
		if($myKey == 0){
			$postList .= '</ul><div class="post_spacing"></div>';
		}
	endwhile; endif; wp_reset_postdata();
	if($myKey != 0){
		$postList .= '</ul><div class="post_spacing"></div>';
	}
	return  $postList;
}

function xoxo_fn_cs_posts_top($slug,$post_number){
	$postList 	= '<ul>';
	$query_args 	= array(
		'post_type' 			=> "post",
		'post_status' 			=> "publish",
		'ignore_sticky_posts' 	=> true,
		'posts_per_page' 		=> $post_number,
	);
	$query_args['orderby'] 		= 'meta_value_num';
	$query_args['meta_key'] 	= 'xoxo_post_views_count';
	$query_args['tax_query'] 	= array(
		array(
			'taxonomy' 	=> 'category',
			'field' 	=> 'slug',
			'terms' 	=> array($slug),
			'operator'	=> 'IN'
		)
	);
	$loop 		= new \WP_Query($query_args);
	$xxxxx 		= xoxo_fn_getSVG_theme('xxxxx');
	$arrow		= xoxo_fn_getSVG_theme('arrow');
	$wave		= '<span>'.xoxo_fn_getSVG_theme('wave2').'</span>';
	$read_text 	= esc_html__('Read More', 'xoxo-core');
	$key = 0;
	if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post();
		$key++;
		$loopPostID			= get_the_ID();
		$mediaID 			= get_post_thumbnail_id( $loopPostID );
		$src 				= wp_get_attachment_image_src( $mediaID, 'full');
		$imageURL = $img_holder = $readSecond = $postTitle = '';
		$has_image			= 0;
		if(isset($src[0])){$imageURL = $src[0];}
		if($imageURL != ''){$has_image = 1;}
		$permalink			= get_the_permalink();
		$title				= get_the_title();
		if($title !== ''){
			$postTitle 	= '<h3 class="fn__maintitle"><a href="'.$permalink.'">'.$title.'</a></h3>';
		}
		$img_holder = '<div class="blog__image">'.xoxo_fn_get_categories(	$loopPostID, 'single', 'post', 1, '').'<div class="abs_img" data-bg-img="'.$imageURL.'"><a href="'.$permalink.'"></a>'.$xxxxx.'</div></div>';
		$title_holder = '<div class="title_holder"><div class="meta_read">'.$postTitle.''.xoxo_fn_metas($loopPostID,'search').'</div><div class="read_more second third"><a href="'.$permalink.'"><span class="text">'.$read_text.'</span><span class="icon"><span class="arrow">'.$arrow.'</span><span class="triple"></span></span></a></div></div>';
		$left = '<div class="top_left"><span class="number">'.$key.'</span><span class="decor">'.$wave.$wave.$wave.'</span></div>';
		$postList .= '<li><div class="item" data-has-img="'.$has_image.'"><div class="post_top">'.$left.$img_holder.'</div>'.$title_holder.'</div></li>';
		
	endwhile; endif; wp_reset_postdata();
	$postList .= '</ul>';
	return  $postList;
}

function xoxo_fn_cs_ajax_get_last_posts_by_category(){
	check_ajax_referer( 'xoxo-secure', 'security' );
	
	$layout = 'triple_post';
	if(isset($_POST['layout'])){
		$layout = $_POST['layout'];
	}
	$slug = '';
	if(isset($_POST['slug'])){
		$slug = $_POST['slug'];
	}
	
	$count = 3;
	if(isset($_POST['count'])){
		$count = (int)sanitize_text_field($_POST['count']);
	}
	$list = '';
	if($layout == 'triple_post'){
		$list = xoxo_fn_cs_posts_triple($slug,$count);
	}else if($layout == 'top_post'){
		$list = xoxo_fn_cs_posts_top($slug,$count);
	}
	
	
	
	$buffyArray = array(
		'list' 		=> $list,
    );
	
	die(json_encode($buffyArray));
}





add_action( 'show_user_profile', 'xoxo_fn_user_social_fields' );
add_action( 'edit_user_profile', 'xoxo_fn_user_social_fields' );

function xoxo_fn_user_social_fields( $user ) {
		$userID				= $user->ID;
		// icons
		$facebook_icon 		= '<i class="fn-icon-facebook"></i>';
		$twitter_icon 		= '<i class="fn-icon-twitter"></i>';
		$pinterest_icon 	= '<i class="fn-icon-pinterest"></i>';
		$linkedin_icon 		= '<i class="fn-icon-linkedin"></i>';
		$behance_icon 		= '<i class="fn-icon-behance"></i>';
		$vimeo_icon 		= '<i class="fn-icon-vimeo-1"></i>';
		$google_icon 		= '<i class="fn-icon-gplus"></i>';
		$youtube_icon 		= '<i class="fn-icon-youtube-play"></i>';
		$instagram_icon 	= '<i class="fn-icon-instagram"></i>';
		$github_icon 		= '<i class="fn-icon-github"></i>';
		$flickr_icon 		= '<i class="fn-icon-flickr"></i>';
		$dribbble_icon 		= '<i class="fn-icon-dribbble"></i>';
		$dropbox_icon 		= '<i class="fn-icon-dropbox"></i>';
		$paypal_icon 		= '<i class="fn-icon-paypal"></i>';
		$picasa_icon 		= '<i class="fn-icon-picasa"></i>';
		$soundcloud_icon 	= '<i class="fn-icon-soundcloud"></i>';
		$whatsapp_icon 		= '<i class="fn-icon-whatsapp"></i>';
		$skype_icon 		= '<i class="fn-icon-skype"></i>';
		$slack_icon 		= '<i class="fn-icon-slack"></i>';
		$wechat_icon 		= '<i class="fn-icon-wechat"></i>';
		$icq_icon 			= '<i class="fn-icon-icq"></i>';
		$rocketchat_icon 	= '<i class="fn-icon-rocket"></i>';
		$telegram_icon 		= '<i class="fn-icon-telegram"></i>';
		$vkontakte_icon 	= '<i class="fn-icon-vkontakte"></i>';
		$rss_icon		 	= '<i class="fn-icon-rss"></i>';

?>
    <h3><?php esc_html_e("Xoxo extra profile Information", 'xoxo-core'); ?></h3>

    <table class="form-table">
		<tr>
			<th><label for="xoxo_fn_user_image"><?php esc_html_e("Image URL", 'xoxo-core'); ?></label></th>
			<td>
				<input type="text" name="xoxo_fn_user_image" id="xoxo_fn_user_image" value="<?php echo esc_attr( get_the_author_meta( 'xoxo_fn_user_image', $userID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e("Please insert your profile image URL (media URL or any website image URL)", 'xoxo-core'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="xoxo_fn_user_name"><?php esc_html_e("Full Name", 'xoxo-core'); ?></label></th>
			<td>
				<input type="text" name="xoxo_fn_user_name" id="xoxo_fn_user_name" value="<?php echo esc_attr( get_the_author_meta( 'xoxo_fn_user_name', $userID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e("Please enter your full name", 'xoxo-core'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="xoxo_fn_user_desc"><?php esc_html_e("Information", 'xoxo-core'); ?></label></th>
			<td>
				<textarea name="xoxo_fn_user_desc" cols="30" rows="5" id="xoxo_fn_user_desc" class="regular-text"><?php echo esc_html( get_the_author_meta( 'xoxo_fn_user_desc', $userID ) ); ?></textarea><br />
				<span class="description"><?php esc_html_e("Please enter some description name", 'xoxo-core'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="xoxo_fn_user_facebook"><span><?php echo wp_kses($facebook_icon, 'post');?></span><?php esc_html_e("Facebook URL", 'xoxo-core'); ?></label></th>
			<td>
				<input type="text" name="xoxo_fn_user_facebook" id="xoxo_fn_user_facebook" value="<?php echo esc_attr( get_the_author_meta( 'xoxo_fn_user_facebook', $userID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e("Please enter your facebook profile address", 'xoxo-core'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="xoxo_fn_user_twitter"><span><?php echo wp_kses($twitter_icon, 'post');?></span><?php esc_html_e("Twitter URL", 'xoxo-core'); ?></label></th>
			<td>
				<input type="text" name="xoxo_fn_user_twitter" id="xoxo_fn_user_twitter" value="<?php echo esc_attr( get_the_author_meta( 'xoxo_fn_user_twitter', $userID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e("Please enter your twitter profile address", 'xoxo-core'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="xoxo_fn_user_pinterest"><span><?php echo wp_kses($pinterest_icon, 'post');?></span><?php esc_html_e("Pinterest URL", 'xoxo-core'); ?></label></th>
			<td>
				<input type="text" name="xoxo_fn_user_pinterest" id="xoxo_fn_user_pinterest" value="<?php echo esc_attr( get_the_author_meta( 'xoxo_fn_user_pinterest', $userID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e("Please enter your pinterest profile address", 'xoxo-core'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="xoxo_fn_user_linkedin"><span><?php echo wp_kses($linkedin_icon, 'post');?></span><?php esc_html_e("Linkedin URL", 'xoxo-core'); ?></label></th>
			<td>
				<input type="text" name="xoxo_fn_user_linkedin" id="xoxo_fn_user_linkedin" value="<?php echo esc_attr( get_the_author_meta( 'xoxo_fn_user_linkedin', $userID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e("Please enter your linkedin profile address", 'xoxo-core'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="xoxo_fn_user_behance"><span><?php echo wp_kses($behance_icon, 'post');?></span><?php esc_html_e("Behance URL", 'xoxo-core'); ?></label></th>
			<td>
				<input type="text" name="xoxo_fn_user_behance" id="xoxo_fn_user_behance" value="<?php echo esc_attr( get_the_author_meta( 'xoxo_fn_user_behance', $userID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e("Please enter your linkedin profile address", 'xoxo-core'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="xoxo_fn_user_vimeo"><span><?php echo wp_kses($vimeo_icon, 'post');?></span><?php esc_html_e("Vimeo URL", 'xoxo-core'); ?></label></th>
			<td>
				<input type="text" name="xoxo_fn_user_vimeo" id="xoxo_fn_user_vimeo" value="<?php echo esc_attr( get_the_author_meta( 'xoxo_fn_user_vimeo', $userID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e("Please enter your linkedin profile address", 'xoxo-core'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="xoxo_fn_user_google"><span><?php echo wp_kses($google_icon, 'post');?></span><?php esc_html_e("Google URL", 'xoxo-core'); ?></label></th>
			<td>
				<input type="text" name="xoxo_fn_user_google" id="xoxo_fn_user_google" value="<?php echo esc_attr( get_the_author_meta( 'xoxo_fn_user_google', $userID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e("Please enter your google profile address", 'xoxo-core'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="xoxo_fn_user_youtube"><span><?php echo wp_kses($youtube_icon, 'post');?></span><?php esc_html_e("Youtube URL", 'xoxo-core'); ?></label></th>
			<td>
				<input type="text" name="xoxo_fn_user_youtube" id="xoxo_fn_user_youtube" value="<?php echo esc_attr( get_the_author_meta( 'xoxo_fn_user_youtube', $userID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e("Please enter your youtube profile address", 'xoxo-core'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="xoxo_fn_user_instagram"><span><?php echo wp_kses($instagram_icon, 'post');?></span><?php esc_html_e("Instagram URL", 'xoxo-core'); ?></label></th>
			<td>
				<input type="text" name="xoxo_fn_user_instagram" id="xoxo_fn_user_instagram" value="<?php echo esc_attr( get_the_author_meta( 'xoxo_fn_user_instagram', $userID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e("Please enter your instagram profile address", 'xoxo-core'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="xoxo_fn_user_github"><span><?php echo wp_kses($github_icon, 'post');?></span><?php esc_html_e("Github URL", 'xoxo-core'); ?></label></th>
			<td>
				<input type="text" name="xoxo_fn_user_github" id="xoxo_fn_user_github" value="<?php echo esc_attr( get_the_author_meta( 'xoxo_fn_user_github', $userID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e("Please enter your github profile address", 'xoxo-core'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="xoxo_fn_user_flickr"><span><?php echo wp_kses($flickr_icon, 'post');?></span><?php esc_html_e("Flickr URL", 'xoxo-core'); ?></label></th>
			<td>
				<input type="text" name="xoxo_fn_user_flickr" id="xoxo_fn_user_flickr" value="<?php echo esc_attr( get_the_author_meta( 'xoxo_fn_user_flickr', $userID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e("Please enter your flickr profile address", 'xoxo-core'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="xoxo_fn_user_dribbble"><span><?php echo wp_kses($dribbble_icon, 'post');?></span><?php esc_html_e("Dribbble URL", 'xoxo-core'); ?></label></th>
			<td>
				<input type="text" name="xoxo_fn_user_dribbble" id="xoxo_fn_user_dribbble" value="<?php echo esc_attr( get_the_author_meta( 'xoxo_fn_user_dribbble', $userID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e("Please enter your dribbble profile address", 'xoxo-core'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="xoxo_fn_user_dropbox"><span><?php echo wp_kses($dropbox_icon, 'post');?></span><?php esc_html_e("Dropbox URL", 'xoxo-core'); ?></label></th>
			<td>
				<input type="text" name="xoxo_fn_user_dropbox" id="xoxo_fn_user_dropbox" value="<?php echo esc_attr( get_the_author_meta( 'xoxo_fn_user_dropbox', $userID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e("Please enter your dropbox profile address", 'xoxo-core'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="xoxo_fn_user_paypal"><span><?php echo wp_kses($paypal_icon, 'post');?></span><?php esc_html_e("Paypal URL", 'xoxo-core'); ?></label></th>
			<td>
				<input type="text" name="xoxo_fn_user_paypal" id="xoxo_fn_user_paypal" value="<?php echo esc_attr( get_the_author_meta( 'xoxo_fn_user_paypal', $userID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e("Please enter your paypal profile address", 'xoxo-core'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="xoxo_fn_user_picasa"><span><?php echo wp_kses($picasa_icon, 'post');?></span><?php esc_html_e("Picasa URL", 'xoxo-core'); ?></label></th>
			<td>
				<input type="text" name="xoxo_fn_user_picasa" id="xoxo_fn_user_picasa" value="<?php echo esc_attr( get_the_author_meta( 'xoxo_fn_user_picasa', $userID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e("Please enter your picasa profile address", 'xoxo-core'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="xoxo_fn_user_soundcloud"><span><?php echo wp_kses($soundcloud_icon, 'post');?></span><?php esc_html_e("Soundcloud URL", 'xoxo-core'); ?></label></th>
			<td>
				<input type="text" name="xoxo_fn_user_soundcloud" id="xoxo_fn_user_soundcloud" value="<?php echo esc_attr( get_the_author_meta( 'xoxo_fn_user_soundcloud', $userID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e("Please enter your soundcloud profile address", 'xoxo-core'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="xoxo_fn_user_whatsapp"><span><?php echo wp_kses($whatsapp_icon, 'post');?></span><?php esc_html_e("Whatsapp URL", 'xoxo-core'); ?></label></th>
			<td>
				<input type="text" name="xoxo_fn_user_whatsapp" id="xoxo_fn_user_whatsapp" value="<?php echo esc_attr( get_the_author_meta( 'xoxo_fn_user_whatsapp', $userID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e("Please enter your whatsapp profile address", 'xoxo-core'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="xoxo_fn_user_skype"><span><?php echo wp_kses($skype_icon, 'post');?></span><?php esc_html_e("Skype URL", 'xoxo-core'); ?></label></th>
			<td>
				<input type="text" name="xoxo_fn_user_skype" id="xoxo_fn_user_skype" value="<?php echo esc_attr( get_the_author_meta( 'xoxo_fn_user_skype', $userID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e("Please enter your skype profile address", 'xoxo-core'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="xoxo_fn_user_slack"><span><?php echo wp_kses($slack_icon, 'post');?></span><?php esc_html_e("Slack URL", 'xoxo-core'); ?></label></th>
			<td>
				<input type="text" name="xoxo_fn_user_slack" id="xoxo_fn_user_slack" value="<?php echo esc_attr( get_the_author_meta( 'xoxo_fn_user_slack', $userID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e("Please enter your slack profile address", 'xoxo-core'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="xoxo_fn_user_wechat"><span><?php echo wp_kses($wechat_icon, 'post');?></span><?php esc_html_e("WeChat URL", 'xoxo-core'); ?></label></th>
			<td>
				<input type="text" name="xoxo_fn_user_wechat" id="xoxo_fn_user_wechat" value="<?php echo esc_attr( get_the_author_meta( 'xoxo_fn_user_wechat', $userID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e("Please enter your wechat profile address", 'xoxo-core'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="xoxo_fn_user_icq"><span><?php echo wp_kses($icq_icon, 'post');?></span><?php esc_html_e("ICQ URL", 'xoxo-core'); ?></label></th>
			<td>
				<input type="text" name="xoxo_fn_user_icq" id="xoxo_fn_user_icq" value="<?php echo esc_attr( get_the_author_meta( 'xoxo_fn_user_icq', $userID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e("Please enter your icq profile address", 'xoxo-core'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="xoxo_fn_user_rocketchat"><span><?php echo wp_kses($rocketchat_icon, 'post');?></span><?php esc_html_e("RocketChat URL", 'xoxo-core'); ?></label></th>
			<td>
				<input type="text" name="xoxo_fn_user_rocketchat" id="xoxo_fn_user_rocketchat" value="<?php echo esc_attr( get_the_author_meta( 'xoxo_fn_user_rocketchat', $userID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e("Please enter your rocketchat profile address", 'xoxo-core'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="xoxo_fn_user_telegram"><span><?php echo wp_kses($telegram_icon, 'post');?></span><?php esc_html_e("Telegram URL", 'xoxo-core'); ?></label></th>
			<td>
				<input type="text" name="xoxo_fn_user_telegram" id="xoxo_fn_user_telegram" value="<?php echo esc_attr( get_the_author_meta( 'xoxo_fn_user_telegram', $userID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e("Please enter your telegram profile address", 'xoxo-core'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="xoxo_fn_user_vkontakte"><span><?php echo wp_kses($vkontakte_icon, 'post');?></span><?php esc_html_e("Vkontakte URL", 'xoxo-core'); ?></label></th>
			<td>
				<input type="text" name="xoxo_fn_user_vkontakte" id="xoxo_fn_user_vkontakte" value="<?php echo esc_attr( get_the_author_meta( 'xoxo_fn_user_vkontakte', $userID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e("Please enter your vkontakte profile address", 'xoxo-core'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="xoxo_fn_user_rss"><span><?php echo wp_kses($rss_icon, 'post');?></span><?php esc_html_e("RSS URL", 'xoxo-core'); ?></label></th>
			<td>
				<input type="text" name="xoxo_fn_user_rss" id="xoxo_fn_user_rss" value="<?php echo esc_attr( get_the_author_meta( 'xoxo_fn_user_rss', $userID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e("Please enter your rss profile address", 'xoxo-core'); ?></span>
			</td>
		</tr>
    </table>
<?php }


add_action( 'personal_options_update', 'xoxo_fn_user_social_fields_save' );
add_action( 'edit_user_profile_update', 'xoxo_fn_user_social_fields_save' );

function xoxo_fn_user_social_fields_save( $user_id ) {
    if ( !current_user_can( 'edit_user', $user_id ) ) { 
        return false; 
    }
    update_user_meta( $user_id, 'xoxo_fn_user_image', 		$_POST['xoxo_fn_user_image'] );
    update_user_meta( $user_id, 'xoxo_fn_user_name', 			$_POST['xoxo_fn_user_name'] );
    update_user_meta( $user_id, 'xoxo_fn_user_desc', 			$_POST['xoxo_fn_user_desc'] );
    update_user_meta( $user_id, 'xoxo_fn_user_facebook', 		$_POST['xoxo_fn_user_facebook'] );
    update_user_meta( $user_id, 'xoxo_fn_user_twitter', 		$_POST['xoxo_fn_user_twitter'] );
    update_user_meta( $user_id, 'xoxo_fn_user_pinterest', 	$_POST['xoxo_fn_user_pinterest'] );
    update_user_meta( $user_id, 'xoxo_fn_user_linkedin', 		$_POST['xoxo_fn_user_linkedin'] );
    update_user_meta( $user_id, 'xoxo_fn_user_behance', 		$_POST['xoxo_fn_user_behance'] );
    update_user_meta( $user_id, 'xoxo_fn_user_vimeo', 		$_POST['xoxo_fn_user_vimeo'] );
    update_user_meta( $user_id, 'xoxo_fn_user_google', 		$_POST['xoxo_fn_user_google'] );
    update_user_meta( $user_id, 'xoxo_fn_user_youtube', 		$_POST['xoxo_fn_user_youtube'] );
    update_user_meta( $user_id, 'xoxo_fn_user_instagram', 	$_POST['xoxo_fn_user_instagram'] );
    update_user_meta( $user_id, 'xoxo_fn_user_github', 		$_POST['xoxo_fn_user_github'] );
    update_user_meta( $user_id, 'xoxo_fn_user_flickr', 		$_POST['xoxo_fn_user_flickr'] );
    update_user_meta( $user_id, 'xoxo_fn_user_dribbble', 		$_POST['xoxo_fn_user_dribbble'] );
    update_user_meta( $user_id, 'xoxo_fn_user_dropbox', 		$_POST['xoxo_fn_user_dropbox'] );
    update_user_meta( $user_id, 'xoxo_fn_user_paypal', 		$_POST['xoxo_fn_user_paypal'] );
    update_user_meta( $user_id, 'xoxo_fn_user_picasa', 		$_POST['xoxo_fn_user_picasa'] );
    update_user_meta( $user_id, 'xoxo_fn_user_soundcloud', 	$_POST['xoxo_fn_user_soundcloud'] );
    update_user_meta( $user_id, 'xoxo_fn_user_whatsapp', 		$_POST['xoxo_fn_user_whatsapp'] );
    update_user_meta( $user_id, 'xoxo_fn_user_skype', 		$_POST['xoxo_fn_user_skype'] );
    update_user_meta( $user_id, 'xoxo_fn_user_slack', 		$_POST['xoxo_fn_user_slack'] );
    update_user_meta( $user_id, 'xoxo_fn_user_wechat', 		$_POST['xoxo_fn_user_wechat'] );
    update_user_meta( $user_id, 'xoxo_fn_user_icq', 			$_POST['xoxo_fn_user_icq'] );
    update_user_meta( $user_id, 'xoxo_fn_user_rocketchat', 	$_POST['xoxo_fn_user_rocketchat'] );
    update_user_meta( $user_id, 'xoxo_fn_user_telegram', 		$_POST['xoxo_fn_user_telegram'] );
    update_user_meta( $user_id, 'xoxo_fn_user_vkontakte', 	$_POST['xoxo_fn_user_vkontakte'] );
    update_user_meta( $user_id, 'xoxo_fn_user_rss', 			$_POST['xoxo_fn_user_rss'] );
}
add_filter( 'plugin_row_meta', 'xoxo_core_fn_plugin_row_meta', 10, 2 );