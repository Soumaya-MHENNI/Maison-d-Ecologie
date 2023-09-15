<?php 
	$paged = (get_query_var('page')) ? get_query_var('page') : 1;
	echo xoxo_fn_single_post(get_the_ID(),$paged);
?>