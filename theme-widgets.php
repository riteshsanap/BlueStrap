<?php
/*-----------------------------------------------------------------------------------

CLASS INFORMATION

Description: A custom Tabber widget by WPDen.net.
Date Created: 2013.
Author: Ritesh Sanap.
Since: 1.0.0
-----------------------------------------------------------------------------------*/

class WPDen_tabwidget extends WP_Widget {
	var $settings = array( 'number', 'thumb_size', 'order', 'pop', 'latest', 'comments', 'tags', 'days' );

	/*----------------------------------------
	  Constructor.
	  ----------------------------------------

	  * The constructor. Sets up the widget.
	----------------------------------------*/

	function WPDen_tabwidget () {

		/* Widget settings. */
		$widget_ops = array( 'classname' => 'widget_wpden_tabs', 'description' => __( 'This widget is the Tabs that classically goes into the sidebar. It contains the Popular posts, Latest Posts, Recent comments and a Tag cloud.', 'WPDen' ) );

		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'wpden_tabber' );

		/* Create the widget. */
		$this->WP_Widget( 'wpden_tabber', __('WPDen - Tabber', 'wpden' ), $widget_ops, $control_ops );

	} // End Constructor

	function widget($args, $instance) {
		extract( $args, EXTR_SKIP );
		$instance = $this->wpden_enforce_defaults( $instance );
		extract( $instance, EXTR_SKIP );
		echo $before_widget;
		?>

<div id="tabs">

    <ul class="wpdenTabs nav nav-pills">
    
    <?php if ( $order == "latest" && !$latest == "on") { ?>
    	<li class="latest"><a href="#tab-latest" data-toggle="tab"><?php _e( 'Latest', 'wpden' ); ?></a></li>
    <?php } elseif ( $order == "comments" && !$comments == "on") { ?>
    	<li class="comments"><a href="#tab-comm" data-toggle="tab"><?php _e( 'Comments', 'wpden' ); ?></a></li>
    <?php } elseif ( $order == "tags" && !$tags == "on") { ?>
    	<li class="tags"><a href="#tab-tags" data-toggle="tab"><?php _e( 'Tags', 'wpden' ); ?></a></li>
    <?php } ?>
    <?php if (!$pop == "on") { ?>
    	<li class="popular"><a href="#tab-pop" data-toggle="tab"><?php _e( 'Popular', 'wpden' ); ?></a></li><?php } ?>
    <?php if ($order <> "latest" && !$latest == "on") { ?>
    	<li class="latest"><a href="#tab-latest" data-toggle="tab"><?php _e( 'Latest', 'wpden' ); ?></a></li><?php } ?>
    <?php if ($order <> "comments" && !$comments == "on") { ?>
    	<li class="comments"><a href="#tab-comm" data-toggle="tab"><?php _e( 'Comments', 'wpden' ); ?></a></li><?php } ?>
    <?php if ($order <> "tags" && !$tags == "on") { ?>
    	<li class="tags"><a href="#tab-tags" data-toggle="tab"><?php _e( 'Tags', 'wpden' ); ?></a></li>
    <?php } ?>
    
    </ul>

    <div class="clear"></div>

    <div class="boxes box inside tab-content">

        <?php if ( $order == "latest" && !$latest == "on") { ?>
        <ul id="tab-latest" class="list tab-pane">
            <?php if ( function_exists( 'wpden_tabwidget_lastest') ) wpden_tabwidget_lastest($number, $thumb_size); ?>
        </ul>
        <?php } elseif ( $order == "comments" && !$comments == "on") { ?>
		<ul id="tab-comm" class="list tab-pane">
            <?php if ( function_exists( 'wpden_tabwidget_comments') ) wpden_tabwidget_comments($number, $thumb_size); ?>
        </ul>
        <?php } elseif ( $order == "tags" && !$tags == "on") { ?>
        <div id="tab-tags" class="list tab-pane">
            <?php wp_tag_cloud( 'smallest=12&largest=20' ); ?>
        </div>
        <?php } ?>

        <?php if (!$pop == "on") { ?>
        <ul id="tab-pop" class="list tab-pane">
            <?php if ( function_exists( 'wpden_tabwidget_popular') ) wpden_tabwidget_popular($number, $thumb_size, $days); ?>
        </ul>
        <?php } ?>
        <?php if ($order <> "latest" && !$latest == "on") { ?>
        <ul id="tab-latest" class="list tab-pane">
            <?php if ( function_exists( 'wpden_tabwidget_lastest') ) wpden_tabwidget_lastest($number, $thumb_size); ?>
        </ul>
        <?php } ?>
        <?php if ($order <> "comments" && !$comments == "on") { ?>
		<ul id="tab-comm" class="list tab-pane">
            <?php if ( function_exists( 'wpden_tabwidget_comments') ) wpden_tabwidget_comments($number, $thumb_size); ?>
        </ul>
        <?php } ?>
        <?php if ($order <> "tags" && !$tags == "on") { ?>
        <div id="tab-tags" class="list tab-pane">
            <?php wp_tag_cloud( 'smallest=12&largest=20' ); ?>
        </div>
        <?php } ?>

    </div><!-- /.boxes -->

</div><!-- /WPDEN Tabber -->

         <?php
         echo $after_widget;
   }

   /*----------------------------------------
	  update()
	  ----------------------------------------

	* Function to update the settings from
	* the form() function.

	* Params:
	* - Array $new_instance
	* - Array $old_instance
	----------------------------------------*/

	function update ( $new_instance, $old_instance ) {
		$new_instance = $this->wpden_enforce_defaults( $new_instance );
		return $new_instance;
	} // End update()

	function wpden_enforce_defaults( $instance ) {
		$defaults = $this->wpden_get_settings();
		$instance = wp_parse_args( $instance, $defaults );
		$instance['number'] = intval( $instance['number'] );
		if ( $instance['number'] < 1 )
			$instance['number'] = $defaults['number'];
		$instance['thumb_size'] = absint( $instance['thumb_size'] );
		if ( empty( $instance['order'] ) )
			$instance['order'] = $defaults['order'];
		return $instance;
	}

	/**
	 * Provides an array of the settings with the setting name as the key and the default value as the value
	 * This cannot be called get_settings() or it will override WP_Widget::get_settings()
	 */
	function wpden_get_settings() {
		// Set the default to a blank string
		$settings = array_fill_keys( $this->settings, '' );
		// Now set the more specific defaults
		$settings['number'] = 5;
		$settings['thumb_size'] = 45;
		$settings['order'] = 'pop';
		return $settings;
	}

   /*----------------------------------------
	 form()
	 ----------------------------------------

	  * The form on the widget control in the
	  * widget administration area.

	  * Make use of the get_field_id() and
	  * get_field_name() function when creating
	  * your form elements. This handles the confusing stuff.

	  * Params:
	  * - Array $instance
	----------------------------------------*/

   function form( $instance ) {
		$instance = $this->wpden_enforce_defaults( $instance );
		extract( $instance, EXTR_SKIP );
?>
       <p>
	       <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts:', 'wpden' ); ?>
	       <input class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo esc_attr( $instance['number'] ); ?>" />
	       </label>
       </p>
       <p>
	       <label for="<?php echo $this->get_field_id( 'thumb_size' ); ?>"><?php _e( 'Thumbnail Size (0=disable):', 'wpden' ); ?>
	       <input class="widefat" id="<?php echo $this->get_field_id( 'thumb_size' ); ?>" name="<?php echo $this->get_field_name( 'thumb_size' ); ?>" type="text" value="<?php echo esc_attr( $instance['thumb_size'] ); ?>" />
	       </label>
       </p>
       <p>
	       <label for="<?php echo $this->get_field_id( 'days' ); ?>"><?php _e( 'Popular limit (days):', 'wpden' ); ?>
	       <input class="widefat" id="<?php echo $this->get_field_id( 'days' ); ?>" name="<?php echo $this->get_field_name( 'days' ); ?>" type="text" value="<?php echo esc_attr( $instance['days'] ); ?>" />
	       </label>
       </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'order' ); ?>"><?php _e( 'First Visible Tab:', 'wpden' ); ?></label>
            <select name="<?php echo $this->get_field_name( 'order' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'order' ); ?>">
                <option value="pop" <?php selected( $instance['order'], 'pop' ); ?>><?php _e( 'Popular', 'wpden' ); ?></option>
                <option value="latest" <?php selected( $instance['order'], 'latest' ); ?>><?php _e( 'Latest', 'wpden' ); ?></option>
                <option value="comments" <?php selected( $instance['order'], 'comments' ); ?>><?php _e( 'Comments', 'wpden' ); ?></option>
                <option value="tags" <?php selected( $instance['order'], 'tags' ); ?>><?php _e( 'Tags', 'wpden' ); ?></option>
            </select>
        </p>
       <p><strong><?php _e( 'Hide Tabs:', 'wpden' ); ?></strong></p>
       <p>
        <input id="<?php echo $this->get_field_id( 'pop' ); ?>" name="<?php echo $this->get_field_name( 'pop' ); ?>" type="checkbox" <?php checked( $instance['pop'], 'on' ); ?>><?php _e( 'Popular', 'wpden' ); ?></input>
	   </p>
	   <p>
	       <input id="<?php echo $this->get_field_id( 'latest' ); ?>" name="<?php echo $this->get_field_name( 'latest' ); ?>" type="checkbox" <?php checked( $instance['latest'], 'on' ); ?>><?php _e( 'Latest', 'wpden' ); ?></input>
	   </p>
	   <p>
	       <input id="<?php echo $this->get_field_id( 'comments' ); ?>" name="<?php echo $this->get_field_name( 'comments' ); ?>" type="checkbox" <?php checked( $instance['comments'], 'on' ); ?>><?php _e( 'Comments', 'wpden' ); ?></input>
	   </p>
	   <p>
	       <input id="<?php echo $this->get_field_id( 'tags' ); ?>" name="<?php echo $this->get_field_name( 'tags' ); ?>" type="checkbox" <?php checked( $instance['tags'], 'on' ); ?>><?php _e( 'Tags', 'wpden' ); ?></input>
       </p>
<?php
	} // End form()

} // End Class

/*----------------------------------------
  Register the widget on `widgets_init`.
  ----------------------------------------

  * Registers this widget.
----------------------------------------*/

add_action( 'widgets_init', create_function( '', 'return register_widget("WPDen_tabwidget");' ), 1 );
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* WPDEN Tabber - Javascript */
/*-----------------------------------------------------------------------------------*/
// Add Javascript
if(is_active_widget( null,null,'wpden_tabber' ) == true) {
	add_action( 'wp_footer','wpden_tabber_js' );
}

function wpden_tabber_js(){
?>
<!-- WPDEN Tabber Widget -->
<script type="text/javascript">
jQuery(document).ready(function(){
	// UL = .wpden_tabs
	// Tab contents = .inside

	var tag_cloud_class = '#tagcloud';

	//Fix for tag clouds - unexpected height before .hide()
	var tag_cloud_height = jQuery( '#tagcloud').height();

	//jQuery( '.inside ul li:last-child').css( 'border-bottom','0px' ); // remove last border-bottom from list in tab content
	jQuery( '.wpdenTabs').each(function(){
		jQuery(this).children( 'li').children( 'a:first').addClass( 'active' ); // Add .selected class to first tab on load
	});
	jQuery( '.inside > *').hide();
	jQuery( '.inside > *:first-child').show();

	jQuery( '.wpdenTabs li a').click(function(evt){ // Init Click funtion on Tabs

		var clicked_tab_ref = jQuery(this).attr( 'href' ); // Strore Href value

		jQuery(this).parent().parent().children( 'li').children( 'a').removeClass( 'active' ); //Remove selected from all tabs
		jQuery(this).addClass( 'active' );
		jQuery(this).parent().parent().parent().children( '.inside').children( '*').hide();

		jQuery( '.inside ' + clicked_tab_ref).fadeIn(500);

		 evt.preventDefault();

	})
})
</script>
<?php
}

/*-----------------------------------------------------------------------------------*/
/* WPDEN Tabber - Popular Posts */
/*-----------------------------------------------------------------------------------*/
if (!function_exists( 'wpden_tabwidget_popular')) {
	function wpden_tabwidget_popular( $posts = 5, $size = 45, $days = null ) {
		global $post;

		if ( $days ) {
			global $popular_days;
			$popular_days = $days;

			// Register the filtering function
			add_filter('posts_where', 'filter_where');
		}

		$popular = get_posts( array( 'suppress_filters' => false, 'ignore_sticky_posts' => 1, 'orderby' => 'comment_count', 'numberposts' => $posts) );
		foreach($popular as $post) :
			setup_postdata($post);
	?>
	<li>
		<?php if ($size <> 0) { ?><img src="<?php echo resize_thumbnail_wpden($size,$size,post_thumbnail_wpden()); ?>" height="<?php echo $size; ?>" width="<?php echo $size; ?>" class="thumbnail" alt="<?php the_title(); ?>"/>	<?php	} ?>
		<a title="<?php the_title(); ?>" href="<?php the_permalink() ?>"><?php the_title(); ?></a>
		<span class="meta"><?php the_time( get_option( 'date_format' ) ); ?></span>
		<div class="fix"></div>
	</li>
	<?php endforeach;
	}
}

//Create a new filtering function that will add our where clause to the query
function filter_where($where = '') {
  global $popular_days;
  //posts in the last X days
  $where .= " AND post_date > '" . date('Y-m-d', strtotime('-'.$popular_days.' days')) . "'";
  return $where;
}

/*-----------------------------------------------------------------------------------*/
/* WPDEN Tabber - Latest Posts */
/*-----------------------------------------------------------------------------------*/
if (!function_exists( 'wpden_tabwidget_lastest')) {
	function wpden_tabwidget_lastest( $posts = 5, $size = 45 ) {
		global $post;
		$latest = get_posts( 'ignore_sticky_posts=1&numberposts='. $posts .'&orderby=post_date&order=desc' );
		foreach($latest as $post) :
			setup_postdata($post);
	?>
	<li>
		<?php if ($size <> 0) { ?><img src="<?php echo resize_thumbnail_wpden($size,$size,post_thumbnail_wpden()); ?>" height="<?php echo $size; ?>" width="<?php echo $size; ?>" class="thumbnail"  alt="<?php the_title(); ?>" />	<?php	} ?>
		<a title="<?php the_title(); ?>" href="<?php the_permalink() ?>"><?php the_title(); ?></a>
		<span class="meta"><?php the_time( get_option( 'date_format' ) ); ?></span>
		<div class="fix"></div>
	</li>
	<?php endforeach;
	}
}



/*-----------------------------------------------------------------------------------*/
/* WPDEN Tabber - Latest Comments */
/*-----------------------------------------------------------------------------------*/
if (!function_exists( 'wpden_tabwidget_comments')) {
	function wpden_tabwidget_comments( $posts = 5, $size = 35 ) {
		global $wpdb;

		$comments = get_comments( array( 'number' => $posts, 'status' => 'approve' ) );
		if ( $comments ) {
			foreach ( (array) $comments as $comment) {
			$post = get_post( $comment->comment_post_ID );
			?>
				<li class="recentcomments">
					<?php if ( $size > 0 ) echo get_avatar( $comment, $size ); ?>
					<a href="<?php echo get_comment_link($comment->comment_ID); ?>" title="<?php echo wp_filter_nohtml_kses($comment->comment_author); ?> <?php _e( 'on', 'wpden' ); ?> <?php echo $post->post_title; ?>"><?php echo wp_filter_nohtml_kses($comment->comment_author); ?>: <?php echo stripslashes( substr( wp_filter_nohtml_kses( $comment->comment_content ), 0, 50 ) ); ?><?php _e('...','wpden'); ?></a>
					<div class="fix"></div>
				</li>
			<?php
			}
 		}
	}
}

?>