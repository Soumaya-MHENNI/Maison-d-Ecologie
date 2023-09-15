<?php 
$list 		= '';
if(is_front_page()) {
	$paged 	= (get_query_var('page')) ? get_query_var('page') : 1;
} else {
	$paged 	= (get_query_var('paged')) ? get_query_var('paged') : 1;
}
//$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
if(!is_search() && !is_archive() && !is_home()){
	query_posts('posts_per_page=&paged='.esc_html($paged));
}

$from_ajax			= false;
if (isset($args['from_ajax'])) {
	$from_ajax 		= $args['from_ajax'];
}
if (isset($args['loop'])) {
	$loop 			= $args['loop'];
}
$layout				= '';
if (isset($args['layout'])) {
	$layout 		= $args['layout'];
}

$key = 0;
if($from_ajax && isset($loop)){
	if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post();$key++;
	$list .= xoxo_fn_get_post($layout);
	endwhile; endif; wp_reset_postdata();
}else{
	$featured = xoxo_fn_featured_posts_to_list();
	$featured__number = $featured[0];
	$featured__content = $featured[1];
	if (have_posts()) : while (have_posts()) : the_post();$key++;
	$list .= xoxo_fn_get_post($layout);
	if($key == $featured__number){
		$list .= $featured__content;
	}
	
	endwhile; endif; wp_reset_postdata();
}
	

echo wp_kses($list, 'post');
?>