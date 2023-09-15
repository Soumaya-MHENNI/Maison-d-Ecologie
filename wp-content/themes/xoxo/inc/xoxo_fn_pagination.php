<?php
function xoxo_fn_pagination($pages = '', $ajax = false, $range = 2, $echo = true, $query = ''){  
	$currentPage 	= '';
	$showitems 		= ($range * 1) + 1;
	$output			= '';
	
	
	global $xoxo_fn_paged;
    
	if(get_query_var('paged')){
		$xoxo_fn_paged = get_query_var('paged');
	}elseif(get_query_var('page')) {
		$xoxo_fn_paged = get_query_var('page');
	}else {
		$xoxo_fn_paged = 1;
	}

	global $wp_query;
	if($pages == '' || $ajax){
		$pages = $wp_query->max_num_pages;
		if(!$pages){$pages = 1;}
	}
	if($query != '' & !empty($query)){
		$pages = $query->max_num_pages;
		if(!$pages){$pages = 1;}
	}
	
	

	if(1 != $pages){
		$output .= '<div class="xoxo_fn_pagination"><div class="container"><div class="pag_in"><div class="pag_inner"><span class="left_wing"></span><span class="right_wing"></span><ul>';
		
		$list = '';
		for ($i=1; $i <= $pages; $i++){
			if (1 != $pages &&( !($i >= $xoxo_fn_paged+$range+1 || $i <= $xoxo_fn_paged-$range-1) || $pages <= $showitems )){
				
				if($xoxo_fn_paged == $i){
					$list .= "<li class='active'><span class='current'>".esc_html($i)."</span></li>";
				}else{
					$list .= "<li><a href='".esc_url( get_pagenum_link($i))."' class='inactive' >".esc_html($i)."</a></li>";
				}
				if($xoxo_fn_paged == $i){
					$currentPage = $i;
				}
				
			}
		}
		if(($xoxo_fn_paged - $range) >= 2){
			$output .= "<li><a href='".esc_url( get_pagenum_link(1))."' class='inactive'>1</a></li>";
		}
		
		if(($xoxo_fn_paged - $range) >= 3){
			$output .= "<li><span class='triple'>...</span></li>";
		}
		$output .= $list;
		
		$limit = $xoxo_fn_paged+$range+1;
		
		if(($limit != $pages) && ($limit < $pages)){
			$output .= "<li><span class='triple'>...</span></li>";
		}
		if(($currentPage < $pages) && ($limit <= $pages)){
			$output .= "<li><a href='".esc_url( get_pagenum_link($pages))."' class='inactive'>".$pages."</a></li>";
		}

		$output .= "</ul></div></div></div></div>\n";
	}
	if($echo){
		echo wp_kses($output, 'post');
	}else{
		return $output;
	}
	
}
function xoxo_fn_custom_pagination($count, $paged = 1, $range = 2){  
	$currentPage 	= '';
	$showitems 		= ($range * 1) + 1;
	$output			= '';
	
	if($count == 1){return $output;}
	
	$output .= '<div class="xoxo_fn_pagination"><ul>';

	$list = '';
	for ($i=1; $i <= $count; $i++){
		if (1 != $count &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $count <= $showitems )){

			if($paged == $i){
				$list .= "<li class='active'><span class='current'>".esc_html($i)."</span></li>";
			}else{
				$list .= "<li><a href='#' data-page='".$i."' class='inactive' >".esc_html($i)."</a></li>";
			}
			if($paged == $i){
				$currentPage = $i;
			}

		}
	}
	if(($paged - $range) >= 2){
		$output .= "<li><a href='#' data-page='1' class='inactive'>1</a></li>";
	}

	if(($paged - $range) >= 3){
		$output .= "<li><span class='triple'>...</span></li>";
	}
	$output .= $list;

	$limit = $paged+$range+1;

	if(($limit != $count) && ($limit < $count)){
		$output .= "<li><span class='triple'>...</span></li>";
	}
	if(($currentPage < $count) && ($limit <= $count)){
		$output .= "<li><a data-page='".$count."' href='#' class='inactive'>".$count."</a></li>";
	}

	$output .= "</ul></div>\n";
	
	return $output;
	
}



?>
