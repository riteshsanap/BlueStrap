<?php
/*
 *  Author: Ritesh Sanap | @riteshsanap
 *  URL: http://www.best2know.info 
 *  Developed for : http://wpden.net/
 *  Custom functions, support, custom post types and more.
 */
/*------------------------------------*\
	External Modules/Files
\*------------------------------------*/
/**
 * Optional: set 'ot_show_pages' filter to false.
 * This will hide the settings & documentation pages.
 */
add_filter( 'ot_show_pages', '__return_false' );

/**
 * Optional: set 'ot_show_new_layout' filter to false.
 * This will hide the "New Layout" section on the Theme Options page.
 */
add_filter( 'ot_show_new_layout', '__return_false' );

/**
 * Required: set 'ot_theme_mode' filter to true.
 */
add_filter( 'ot_theme_mode', '__return_true' );

/**
 * Required: include OptionTree.
 */
load_template( trailingslashit( get_template_directory() ) . 'option-tree/ot-loader.php' );
/**
 * Theme Options
 */
load_template( trailingslashit( get_template_directory() ) . 'theme-options.php' );

 /* Post Thumbnail Displayer by WPDen.net */
function post_thumbnail_wpden() {
global $post, $posts;
 // If their is Featured Image then it will be called Out
if ( has_post_thumbnail( $post->ID ) ) {
$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
return $image[0];
} else { // Else it will try to grab the First Image from the Post
global $post, $posts;
  $image = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
 if ( isset( $matches [1][0]) ) $image = $matches [1][0];

  if(empty($image)){ //Defines a default image
    $imgurl = get_template_directory_uri(); // Gets the Directory Location for the default Image
    $image = "$imgurl/images/default.png"; // Location of the "Sorry Image Not Available" Image
  } 
  return $image; // Returns the Value or you can say URL of the image
}
}
function resize_thumbnail_wpden($width = '',$height ='', $path = '') {
// Include the library
include_once( 'BFI_Thumb.php' );
 
// Our parameters, do a resize
$params = array( 'width' => $width, 'height' => $height );
 
// Get the URL of our processed image
$image = bfi_thumb( $path, $params );
 
// Print out our img tag
return $image;

}

function post_share() { 
/* The Below Code is basically just HTML but still created it as a function for resuability and Quick Site wide changes */
    ?>
    <div id="share-wrapper">
    <ul class="share-inner-wrp">
        <!-- Facebook -->
        <li class="facebook button-wrap"><a href="#" >Facebook</a></li>
        
        <!-- Twitter -->
        <li class="twitter button-wrap"><a href="#">Tweet</a></li>
        
         <!-- Digg -->
        <li class="digg button-wrap"><a href="#">Digg it</a></li>
        
        <!-- Stumbleupon -->
        <li class="stumbleupon button-wrap"><a href="#">Stumbleupon</a></li>
      
         <!-- Delicious -->
        <li class="delicious button-wrap"><a href="#">Delicious</a></li>
        
        <!-- Google -->
        <li class="google button-wrap"><a href="#">Plus Share</a></li>
        
        <!-- Email -->
        <li class="email button-wrap"><a href="#">Email</a></li>
    </ul>
</div>
<?php 
function share_js_footer() { ?>
<script type="text/javascript">
jQuery(document).ready(function ($) {
    var pageTitle = document.title; //HTML page title
    var pageUrl = location.href; //Location of the page

    //user hovers on the share button   
    $('#share-wrapper li').hover(function() {
        var hoverEl = $(this); //get element
        
        //browsers with width > 699 get button slide effect
        if($(window).width() > 699) { 
            if (hoverEl.hasClass('visible')){
                hoverEl.animate({"margin-left":"-110px"}, "fast").removeClass('visible');
            } else {
                hoverEl.animate({"margin-left":"0px"}, "fast").addClass('visible');
            }
        } 
    });
        
    //user clicks on a share button
    $('.button-wrap').click(function(event) {
            var shareName = $(this).attr('class').split(' ')[0]; //get the first class name of clicked element
            
            switch (shareName) //switch to different links based on different social name
            {
                case 'facebook':
                    var openLink = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(pageUrl) + '&amp;title=' + encodeURIComponent(pageTitle);
                    break;
                case 'twitter':
                    var openLink = 'http://twitter.com/home?status=' + encodeURIComponent(pageTitle + ' ' + pageUrl);
                    break;
                case 'digg':
                    var openLink = 'http://www.digg.com/submit?phase=2&amp;url=' + encodeURIComponent(pageUrl) + '&amp;title=' + encodeURIComponent(pageTitle);
                    break;
                case 'stumbleupon':
                    var openLink = 'http://www.stumbleupon.com/submit?url=' + encodeURIComponent(pageUrl) + '&amp;title=' + encodeURIComponent(pageTitle);
                    break;
                case 'delicious':
                    var openLink = 'http://del.icio.us/post?url=' + encodeURIComponent(pageUrl) + '&amp;title=' + encodeURIComponent(pageTitle);
                    break;
                case 'google':
                    var openLink = 'https://plus.google.com/share?url=' + encodeURIComponent(pageUrl) + '&amp;title=' + encodeURIComponent(pageTitle);
                    break;
                case 'email':
                    var openLink = 'mailto:?subject=' + pageTitle + '&body=Found this useful link for you : ' + pageUrl;
                    break;
            }
        
        //Parameters for the Popup window
        winWidth    = 650;  
        winHeight   = 450;
        winLeft     = ($(window).width()  - winWidth)  / 2,
        winTop      = ($(window).height() - winHeight) / 2, 
        winOptions   = 'width='  + winWidth  + ',height=' + winHeight + ',top='    + winTop    + ',left='   + winLeft;
        
        //open Popup window and redirect user to share website.
        window.open(openLink,'Share This Link',winOptions);
        return false;
    });
});
</script>
<?php }

add_action('wp_footer','share_js_footer');
} 
// Load any external files you have here

/*------------------------------------*\
	Theme Support
\*------------------------------------*/
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

include('theme-widgets.php'); // Adds WPDEN Tabber Widget
include('slider.php'); // Adds Slider to HomePage if Enabled
include_once('customizer.php'); // Load Customizer

if (!isset($content_width))
{
    $content_width = 700;
}

if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 700, '', true); // Large Thumbnail
    add_image_size('medium', 250, '', true); // Medium Thumbnail
    add_image_size('small', 120, '', true); // Small Thumbnail

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');  
}
function wpden_add_editor_styles() {
    add_editor_style('editor-style.css');
}
add_action( 'init', 'wpden_add_editor_styles' ); // Adds Editor Style for TinyMCE Editor

/*------------------------------------*\
	Functions
\*------------------------------------*/

// Custom Header navigation
function wpden_head_nav()
{
	wp_nav_menu(
	array(
		'theme_location'  => 'header-menu',
		'menu'            => '', 
		'container'       => 'div', 
		'container_class' => 'container_class', 
		'container_id'    => '',
		'menu_class'      => 'menu', 
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'nav_fallback',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul class="nav navbar-nav">%3$s</ul>',
		'depth'           => 0,
		'walker'          => ''
		)
	);
}
function nav_fallback() { ?>
<?php wp_page_menu( array('show_home' => 1, 'menu_class' => 'nav navbar-nav') ); ?>
<?php }

function wpden_add_jquery() {
    if(!is_admin()) {
        wp_enqueue_script('jquery'); // Enqueue jQuery
    }
}
/* Version Strings is set to NULL for all the files for better Caching */    
function wpden_header_custom_scripts() { 
    if(!is_admin()) {
wp_enqueue_script('wpden_bs_scripts',  get_template_directory_uri() . '/bs/js/bootstrap.min.js', array('jquery'), null); // BootStrap JS scripts

wp_enqueue_script('wpden_scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), null); // Custom scripts

 }
}

// Load CSS styles
function wpden_stylesheet()
{
    wp_register_style('wpden_bs_style',  get_template_directory_uri() . '/bs/css/bootstrap.min.css', array(), null, 'all');
    wp_enqueue_style('wpden_bs_style'); // Enqueue it!
    wp_register_style('wpdenstyle', get_template_directory_uri() . '/style.css', array('wpden_bs_style'), null, 'all');
    wp_enqueue_style('wpdenstyle'); // Enqueue it!
    wp_register_style('wpdenfonts','http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic|Bitter:400,700', array('wpdenstyle'), null, 'all');
    wp_enqueue_style('wpdenfonts'); // Enqeue it!
}

// Register Navigation
function register_wpden_navs()
{
    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu' => __('Header Menu', 'wpden'), // Main Navigation
    ));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{

    register_sidebar(array(
        'name' => __('Sidebar - Widget Area 1', 'wpden'),
        'description' => __('Primary Sidebar on the Right Side of Content', 'wpden'),
        'id' => 'widget-area-1',
        'before_widget' => '<div id="%1$s" class="%2$s widget panel panel-default">',
        'after_widget' => '</div>',
        'before_title' => '<div class="panel-heading"><h3 class="panel-title">',
        'after_title' => '</h3></div>'
    ));


    register_sidebar(array(
        'name' => __('Footer - Widget Area 1', 'wpden'),
        'description' => __('First Widget area of footer Columns', 'wpden'),
        'id' => 'footer-widget-area-1',
        'before_widget' => '<div id="%1$s" class="%2$s widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
        register_sidebar(array(
        'name' => __('Footer - Widget Area 2', 'wpden'),
        'description' => __('Second Widget area of footer Columns', 'wpden'),
        'id' => 'footer-widget-area-2',
        'before_widget' => '<div id="%1$s" class="%2$s widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
        register_sidebar(array(
        'name' => __('Footer - Widget Area 3', 'wpden'),
        'description' => __('Third Widget area of footer Columns', 'wpden'),
        'id' => 'footer-widget-area-3',
        'before_widget' => '<div id="%1$s" class="%2$s widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}

//  for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function wpden_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'end_size' => '1',
        'mid_size' => '5',
        'current' => max(1, get_query_var('paged')),
        'type' => 'list',
        'total' => $wp_query->max_num_pages

    ));
}
function wpden_slider_more( $more ) {
    return '';
}

function wpden_slider_len( $length ) {
$length = ot_get_option('slider_len',30);
    return $length;
}

// Custom Excerpts for Magzine 
function wpden_mag_len($length) {
$length = ot_get_option('pst_excerpt',50);
    return $length;
}
function wpden_custom_readmore() {
    if(ot_get_option('more_text') != ' ') {
        return ot_get_option('more_text', 'Continue Reading ...');
    } else {
        return '';
    }
    
}
/*  Create the Custom Excerpts callback
forr More Information regarding below Function visit :
http://wpden.net/create-multiple-excerpts-wordpress/
*/
function wpden_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}


// Custom View Article link to Post
function wpden_more_view($more){
    global $post;
    return '<a class="more-link" href="' . get_permalink($post->ID) . '">' . __(ot_get_option('more_text'), 'wpden') . '</a>';
}

add_filter('excerpt_more', 'wpden_more_view'); // Add 'Read More' button instead of [...] for Excerpts

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
/*function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}
/* 
 BootStrap Shortcodes 
you can use Bootstraps Icons, buttons,Label,badge,alert and well with this function in your posts without much trouble
please not : it's still in beta mode.
*/
function wpden_bs_shortcode($args, $content = '') {
 extract(shortcode_atts(array('type' => '','color' => 'default','size' => 'default','link' => '','close' => 'false'), $args));
if($type == 'icon') {
    $output = "<span class='glyphicon glyphicon-{$content}'></span>";
} elseif ($type == 'button') {
    $output = "<a href='{$link}' class='btn btn-{$color} btn-{$size}'>{$content}</a>";
} elseif ($type == 'label') {
    $output = "<span class='label label-{$color}'>{$content}</span></h3>";
} elseif ($type == 'badge') {
    $output = "<span class='badge'>{$content}</span>";
} elseif ($type == 'alert') {
    $output = "<div class='alert alert-{$color}'>";
    if($close == 'true') {
        $output .= "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    }
   $output .="{$content}</div>";
} elseif ($type == 'well') {
   $output = "<div class='well well-{$size}'>{$content}</div>";
} 
return $output;
}
 add_shortcode('wpden', 'wpden_bs_shortcode');

// Threaded Comments
function enable_threaded_comments()
{
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}

// Custom Comments Callback
function wpden_comments($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);
	
	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
    <!-- heads up: starting < for the html tag (li or div) in the next line: -->
    <<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? 'panel panel-default' : 'parent panel panel-default') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard panel-heading">
	<?php echo get_avatar( $comment, 80 ); ?>
    <?php printf(__('<span class="author-txt"><cite class="fn">%s</cite> <span class="says">says:</span></span>'), get_comment_author_link()) ?>
	</div>
 
<div class="panel-body">
    <?php if ($comment->comment_approved == '0') : ?>
    <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.','wpden') ?></em>
    <br />
<?php endif; ?>
<?php if(get_comment_author() == get_the_author()) { ?>
<span class="post-cm-author label label-danger">
 <span class="glyphicon glyphicon-star"></span> <span class="sm-hide-author"><?php _e('Author','wpden'); ?></span> </span>
<?php } ?>
<?php comment_text() ?>
</div>
<div class="panel-footer">
        <div class="comment-meta commentmetadata"> 
            <span class="time-cm">
            <span class="glyphicon glyphicon-time"></span> 
            <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
        <?php
            printf( __('%1$s at %2$s','wpden'), get_comment_date(),  get_comment_time()) ?></a>
</span>
            <?php edit_comment_link(__(' Edit','wpden'),'<span class="edit-cm"><span class="glyphicon glyphicon-edit"></span>','</span>' );
        ?>
    </div>

    <div class="reply">
    <?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
    </div>

  <div class="fix"></div>
</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php }

/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'wpden_add_jquery'); // Adds jQuery at the Header
add_action('wp_footer', 'wpden_header_custom_scripts',2); // Add Custom Scripts to wp_footer
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'wpden_stylesheet',1); // Add Theme Stylesheet
add_action('init', 'register_wpden_navs'); // Add Custom Navigation
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()

// Add Filters
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class 
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)

//add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
//add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether


?>