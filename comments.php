<div class="comments">
	<?php if (post_password_required()) : ?>
	<h5 class="alert alert-info"><span class="glyphicon glyphicon-info-sign"></span> <?php _e( 'Post is password protected. Enter the password to view any comments.', 'wpden' ); ?></h5>
</div>

	<?php return; endif; ?>

<?php if (have_comments()) : ?>

	<h2><?php comments_number(); ?></h2>

	<ul>
		<?php wp_list_comments('type=comment&callback=wpden_comments'); // Custom callback in functions.php ?>
	</ul> 
	<div class="cm-pagination">
		<?php paginate_comments_links(array('type'=>'list') ) ?>
	<div class="fix"></div>

		
	</div>
	
<?php elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
	
	<h5 class="alert alert-info"><span class="glyphicon glyphicon-info-sign"></span> <?php _e( 'Comments are closed here.', 'wpden' ); ?></h5>
	
<?php endif; ?>
<?php 
$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );

$wpden_cm_fields = array(

	'comment_notes_after' => '<p class="form-allowed-tags alert alert-info">' .
    sprintf(
      __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s' ),
      ' <code>' . allowed_tags() . '</code>'
    ) . '</p>',

	'comment_field' =>  '<div class="comment-form-comment input-group"><label for="comment" class="input-group-addon">' . _x( 'Comment', 'noun','wpden' ) .
    '</label><textarea id="comment" name="comment" class="form-control" cols="45" rows="8" aria-required="true">' .
    '</textarea></div>',

	  'fields' => apply_filters( 'comment_form_default_fields', array(
       'author' =>
      '<div class="comment-form-author input-group input-group-lg">' .
      '<label for="author" class="input-group-addon">' . __( 'Name', 'wpden' ) . '</label> ' .
      '<input id="author" class="form-control" name="author" type="text" placeholder="' . esc_attr( $commenter['comment_author'] ) .
      '"' . $aria_req . ' /> ' . ( $req ? '<span class="required input-group-addon alert-danger"><span class="glyphicon glyphicon-star"></span></span>' : '' ) . '</div>',

    'email' =>
      '<div class="comment-form-email input-group input-group-lg"><label for="email" class="input-group-addon">' . __( 'Email', 'wpden' ) . '</label> 
      <input id="email" name="email" type="text" class="form-control" placeholder="' . esc_attr(  $commenter['comment_author_email'] ) .
      '"' . $aria_req . ' />' . ( $req ? '<span class="required input-group-addon alert-danger"><span class="glyphicon glyphicon-star"></span></span>' : '' ) .'</div>',

    'url' =>
      '<div class="comment-form-url input-group input-group-lg"><label for="url" class="input-group-addon">' .
      __( 'Website', 'wpden' ) . '</label>' .
      '<input id="url" name="url" type="text" class="form-control" placeholder="' . esc_attr( $commenter['comment_author_url'] ) .
      '" /></div>'
        )
	  ) );

comment_form($wpden_cm_fields); ?>

</div>