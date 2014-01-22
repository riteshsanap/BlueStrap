<?php

function wpden_customize_register( $wp_customize )
{
   //All our sections, settings, and controls will be added here

	$wp_customize->add_section('wpden_header_colors', array(
        'title'    => __('Change Header Colors', 'wpden'),
        'priority' => 120,
    ));
	/* Header Background */
    $wp_customize->add_setting( 'header_bgcolor' , array(
    	'default'     => '#2179d8',
    	'transport'   => 'refresh',
	) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_bg_color', array(
	'label'        => __( 'Header Background Color', 'wpden' ),
	'section'    => 'wpden_header_colors',
	'settings'   => 'header_bgcolor',
	) ) );

    /* Header Text Color */
    $wp_customize->add_setting( 'header_textcolor' , array(
    	'default'     => '#ffffff',
    	'transport'   => 'refresh',
	) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_txt_color', array(
	'label'        => __( 'Header Text Color', 'wpden' ),
	'section'    => 'wpden_header_colors',
	'settings'   => 'header_textcolor',
	) ) );

    /* Navbar Background Color */

    $wp_customize->add_setting( 'nav_bgcolor' , array(
    	'default'     => '#141412',
    	'transport'   => 'refresh',
	) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nav_bg_color', array(
	'label'        => __( 'Navbar Background Color', 'wpden' ),
	'section'    => 'wpden_header_colors',
	'settings'   => 'nav_bgcolor',
	) ) );

    /* Navbar Hover & Current Background Color */

    $wp_customize->add_setting( 'nav_hovercolor' , array(
    	'default'     => '#ffffff',
    	'transport'   => 'refresh',
	) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nav_hover_color', array(
	'label'        => __( 'Navbar Hover Background Color', 'wpden' ),
	'section'    => 'wpden_header_colors',
	'settings'   => 'nav_hovercolor',
	) ) );

    /* Navbar Text Color */

    $wp_customize->add_setting( 'nav_txtcolor' , array(
    	'default'     => '#ffffff',
    	'transport'   => 'refresh',
	) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nav_txt_color', array(
	'label'        => __( 'Navbar Text Color', 'wpden' ),
	'section'    => 'wpden_header_colors',
	'settings'   => 'nav_txtcolor',
	) ) );

    /* Navbar Hover & Current Text Color */

    $wp_customize->add_setting( 'nav_hovertxtcolor' , array(
    	'default'     => '#141412',
    	'transport'   => 'refresh',
	) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nav_hover_txt_color', array(
	'label'        => __( 'Navbar Hover Text Color', 'wpden' ),
	'section'    => 'wpden_header_colors',
	'settings'   => 'nav_hovertxtcolor',
	) ) );


}
add_action( 'customize_register', 'wpden_customize_register' );

function wpden_customize_css() { ?>
	<style type="text/css">
	.header { background:<?php echo get_theme_mod('header_bgcolor', '#2179d8'); ?>; }
	.header a{color:#<?php echo get_theme_mod('header_textcolor', '#ffffff'); ?>;}
	.nav li a{color:<?php echo get_theme_mod('nav_txtcolor', '#ffffff'); ?>; }
	ul.nav ul a, .nav ul ul a {color: <?php echo get_theme_mod('nav_hovertxtcolor', '#141412');?>;}
	.nav-head,ul.nav ul a:hover, .nav ul ul a:hover {background:<?php echo get_theme_mod('nav_bgcolor', '#141412'); ?>;color:<?php echo get_theme_mod('nav_txtcolor', '#ffffff'); ?>; }
	.nav a:hover, .nav li.current-menu-item a, li.current_page_item a,.nav li:hover > a, .nav li a:hover,.nav .children, .nav .sub-menu { background:<?php echo get_theme_mod('nav_hovercolor', '#ffffff');?>;
		color: <?php echo get_theme_mod('nav_hovertxtcolor', '#141412');?>}
	</style>
<?php
}
add_action( 'wp_head', 'wpden_customize_css');
?>