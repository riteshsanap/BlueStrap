<?php
/**
 * Initialize the custom theme options.
 */
add_action( 'admin_init', 'custom_theme_options' );

/**
 * Build the custom settings & update OptionTree.
 */
function custom_theme_options() {
  /**
   * Get a copy of the saved settings array. 
   */
  $saved_settings = get_option( 'option_tree_settings', array() );
  
  /**
   * Custom settings array that will eventually be 
   * passes to the OptionTree Settings API Class.
   */
  $custom_settings = array( 
    'contextual_help' => array( 
      'sidebar'       => ''
    ),
    'sections'        => array( 
      array(
        'id'          => 'general',
        'title'       => 'General'
      ),
      array(
        'id'          => 'slider',
        'title'       => 'Slider'
      ),
      array(
        'id'          => 'pst_format',
        'title'       => 'Post'
      ),
      array(
        'id'          => 'ads',
        'title'       => 'Advertisement'
      )
    ),
    'settings'        => array( 
      array(
        'id'          => 'custom_logo',
        'label'       => 'Logo',
        'desc'        => 'Upload your custom logo image. Set logo max-height in styling options.',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'blog_heading',
        'label'       => 'Blog Title',
        'desc'        => 'Your Blog heading',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'blog_subheading',
        'label'       => 'Blog Description / Subheading',
        'desc'        => 'Your Blog Description / Subheading',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'favicon',
        'label'       => 'Favicon',
        'desc'        => 'Upload a 16x16px Png/Gif image that will be your favicon
<br /><br />
<strong>Note :</strong> after uploading the Favicon the effects sometimes does not take place quickly, so clear cache to view the changes',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'slider_pos',
        'label'       => 'Slider - Position',
        'desc'        => 'Select where to show the slider.',
        'std'         => 'sld-fl',
        'type'        => 'radio',
        'section'     => 'slider',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'sld-fl',
            'label'       => 'Below Navbar - Full Size Slider',
            'src'         => ''
          ),
          array(
            'value'       => 'sld-ps-ar',
            'label'       => 'Above Posts in Post Area',
            'src'         => ''
          ),
          array(
            'value'       => 'sld-dis',
            'label'       => 'Disable Slider',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'slider_cat',
        'label'       => 'Slider Category',
        'desc'        => 'Show Posts in slider from the Selected Category',
        'std'         => '',
        'type'        => 'category-select',
        'section'     => 'slider',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'slider_inv',
        'label'       => 'Slide Interval',
        'desc'        => 'The Time between Slides to Change',
        'std'         => '5000',
        'type'        => 'numeric-slider',
        'section'     => 'slider',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '0,10000,500',
        'class'       => ''
      ),
      array(
        'id'          => 'slider_num',
        'label'       => 'Number of Slides',
        'desc'        => 'Number of Posts to be shown in the Slider',
        'std'         => '5',
        'type'        => 'numeric-slider',
        'section'     => 'slider',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '0,20,1',
        'class'       => ''
      ),
      array(
        'id'          => 'slider_len',
        'label'       => 'Excerpt Length',
        'desc'        => 'How many words to show in Caption on the slider',
        'std'         => '50',
        'type'        => 'numeric-slider',
        'section'     => 'slider',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '0,200,1',
        'class'       => ''
      ),
      array(
        'id'          => 'slider_max',
        'label'       => 'Slider - Max Height',
        'desc'        => '<code>max-height</code> CSS attribute value to keep slider in check from using whole when displaying bigger images.',
        'std'         => '350px',
        'type'        => 'text',
        'section'     => 'slider',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'pst_display',
        'label'       => 'Post Display Style',
        'desc'        => 'Show posts in Different styles',
        'std'         => 'pst-blog',
        'type'        => 'radio',
        'section'     => 'pst_format',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'pst-blog',
            'label'       => 'Blog',
            'src'         => ''
          ),
          array(
            'value'       => 'pst-mag',
            'label'       => 'Magazine',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'pst_excerpt',
        'label'       => 'Excerpt Length',
        'desc'        => 'The numbers of words shown for excerpt in Magazine style.',
        'std'         => '50',
        'type'        => 'numeric-slider',
        'section'     => 'pst_format',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '0,250,1',
        'class'       => ''
      ),
      array(
        'id'          => 'pst_pagi',
        'label'       => 'Pagination',
        'desc'        => 'Select the Pagination Style',
        'std'         => 'pagi-num',
        'type'        => 'radio',
        'section'     => 'pst_format',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'pagi-num',
            'label'       => 'Numbered Pagination',
            'src'         => ''
          ),
          array(
            'value'       => 'pagi-link',
            'label'       => 'Text Link',
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'more_text',
        'label'       => 'Post - More Text',
        'desc'        => 'Show <code>Read More</code> Text when using <code>&amp;lt;!-- More --&amp;gt;</code> tag. Add a blank spaces to Remove Read More Text',
        'std'         => 'Continue Reading ...',
        'type'        => 'text',
        'section'     => 'pst_format',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'pst_thumb',
        'label'       => 'Thumbnail Disable',
        'desc'        => 'Disable Featured Post Thumbnails <br/> <br/> <b>Enable</b> - shows the Thumbnails on all pages <br/><br/> <b>Disable</b> - Disables it on all the Pages<br/><br/> <b>Disable on Post page</b> - Disable Thumbnails on post page i.e <code>single.php</code>',
        'std'         => 'pst-thumb-enable',
        'type'        => 'radio',
        'section'     => 'pst_format',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'pst-thumb-enable',
            'label'       => 'Enable',
            'src'         => ''
          ),
          array(
            'value'       => 'pst-thumb-disable',
            'label'       => 'Disable',
            'src'         => ''
          ),
          array(
            'value'       => 'pst-thumb-single',
            'label'       => 'Disable on Post Page',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'adv_sec',
        'label'       => 'Advertisement Section',
        'desc'        => '<b>Please Note :</b> Advertisement Sections have not been styled so has to give users freedom to make them to their Liking.',
        'std'         => '',
        'type'        => 'textblock-titled',
        'section'     => 'ads',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'head_ads',
        'label'       => 'Header Advertisement',
        'desc'        => 'Add the <b>HTML</b> code for Header Advertisement',
        'std'         => '',
        'type'        => 'textarea',
        'section'     => 'ads',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'below_pst_title',
        'label'       => 'Below Post Title',
        'desc'        => 'Add HTML code for Ads to show below Post Title (Only Applicable on Post Pages i.e. <code>single.php</code>)',
        'std'         => '',
        'type'        => 'textarea',
        'section'     => 'ads',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'pst_content_below',
        'label'       => 'Below Post Content',
        'desc'        => 'Add HTML code for Ads to show below Post Content (Only Applicable on Post Pages i.e. <code>single.php</code>)',
        'std'         => '',
        'type'        => 'textarea',
        'section'     => 'ads',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
            array(
        'id'          => 'help_txt',
        'label'       => 'Information',
        'desc'        => 'Thank you for using BlueStrap theme, for Maximizing BlueStrap features please use following plugins :<br/><br/><ul><li><b>WordPress SEO by Yoast</b> - This Plugin is Considered Best for SEO by many users (including myself)</li><li><b>YARPP (Yet Another Related Post Plugin)</b> - Use the plugin to enable Related Posts that are displayed on Post pages i.e <code>single.php</code></li></ul>',
        'std'         => '',
        'type'        => 'textblock-titled',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      )
    )
  );
  
  /* allow settings to be filtered before saving */
  $custom_settings = apply_filters( 'option_tree_settings_args', $custom_settings );
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( 'option_tree_settings', $custom_settings ); 
  }
  
}