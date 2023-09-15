<?php // Custom Comment template
function xoxo_fn_comment( $comment, $args, $depth ) {
	global $post;
	$icon = xoxo_fn_getSVG_theme('reply');
	
   	switch ( $comment->comment_type ) {
		case 'pingback' :
		case 'trackback' : ?> <li class="post pingback"><div><p><?php esc_html_e( 'Pingback:', 'xoxo' ); ?> <?php esc_url(comment_author_link()); ?><?php edit_comment_link( esc_html__( 'Edit', 'xoxo' ), '<span class="edit-link">', '</span>' ); ?></p></div></li><?php
		break;
			
		default :

    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
        <div id="comment-<?php comment_ID(); ?>" class="comment-body">
           
           <div class="comment-top">
				<div class="comment-avatar">
					<div class="img"><?php echo get_avatar( $comment, 80 ); ?></div>
				</div>
				<div class="commment-text-wrap">

					<div class="comment-data">
						<h4 class="author"><?php esc_url(comment_author_link()); ?></h4>
						<div class="author_meta">
							<?php 
							printf('<span class="date_meta">%3$s / at %1$s</span>', get_comment_time('g:i a'), get_comment_ID(), get_comment_date('F j, Y') );
							edit_comment_link(esc_html__('edit', 'xoxo'),'','');
							comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'link_text' => 'asdasd', 'before' => '<span class="comment-reply">'.$icon,'after' => '</span>'))); 
							?>
						</div>
					</div>
				</div>
           </div>
            
                
                
			<div class="comment-text">
				<?php if ($comment->comment_approved == '0') : ?>
					<span class="waiting"><?php esc_html_e('Your comment is awaiting moderation', 'xoxo') ?></span>
				<?php endif; ?>
				<div class="desc">
					<?php comment_text() ?>
				</div>
			</div>
        </div>
    
<?php }} ?>

<?php
// Do not delete these lines

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php esc_html_e('This post is password protected. Enter the password to view comments.', 'xoxo'); ?></p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->

<?php if ( have_comments()) : ?>
	<?php if(wp_count_comments() !== 0){?>
	<div class="container">
		<div class="comment_top">
			<div class="respond-title">
				<h3 class="fn_title"><?php comments_number( esc_html__( 'No Comment', 'xoxo' ), esc_html__( 'One Comment:', 'xoxo' ), esc_html__( '% Comments:', 'xoxo' ) );?></h3>
			</div>
			<?php }?>
			<div class="comment-list">
				<ul class="list">
					<?php wp_list_comments('type=all&callback=xoxo_fn_comment'); ?>
				</ul>
			</div>
		</div>
	</div>
		
    <?php
		// Are there comments to navigate through?
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
	?>
	<nav class="comment-navigation">
		<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'xoxo' ) ); ?></div>
		<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'xoxo' ) ); ?></div>
	</nav>
	<?php endif; // Check for comment navigation ?>

<?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->
	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments"><?php esc_html_e('Comments are closed.', 'xoxo'); ?></p>

	<?php endif; ?>
<?php endif; ?>


<?php 
		
	add_filter('comment_form_fields', 'xoxo_reorder_comment_fields' );
	function xoxo_reorder_comment_fields( $fields ){

		$new_fields = array(); // сюда соберем поля в новом порядке

		$myorder = array('comment','author','email'); // нужный порядок

		foreach( $myorder as $key ){
			$new_fields[ $key ] = $fields[ $key ];
			unset( $fields[ $key ] );
		}

		// если остались еще какие-то поля добавим их в конец
		if( $fields ){
			foreach( $fields as $key => $val ){
				$new_fields[ $key ] = $val;
			}
		}
			
		return $new_fields;
	}
		
	$comment_form = array( 
		'fields' => apply_filters( 'comment_form_default_fields', array(
			'author' => '<div class="input-half input-holder input-author"><input class="com-text" id="author" name="author" placeholder="'.esc_html__('Name', 'xoxo').'" type="text"  value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" tabindex="1" /></div>',
		
			'email'  => '<div class="input-half input-holder input-email"><input class="com-text" id="emailme" placeholder="'.esc_html__('Email', 'xoxo').'" name="email" type="text"  value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" tabindex="2" /></div>',
			 )),
			
			'comment_form_logged_in' => '<div class="input-holder"><textarea placeholder="'.esc_html__('Comment', 'xoxo').'" id="comment" name="comment" aria-required="true" rows="10" tabindex="3"></textarea></div>',
		
			'comment_field' => '<div class="input-holder"><textarea placeholder="'.esc_html__('Comment', 'xoxo').'" id="comment" name="comment" aria-required="true" rows="10" tabindex="3"></textarea></div>',
		
			'comment_notes_before' => '',
			'comment_notes_after' => '',
			'submit_field' => '<div class="input-holder"><span class="xoxo_submit">%1$s %2$s</span></div>',
		
			'title_reply'=>'<span class="comment-title">'. esc_html__('Leave a reply', 'xoxo') .'</span>'
	);
	comment_form($comment_form, $post->ID);
?>