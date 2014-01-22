<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>
<?php /* Below Meta tags are required for using of Responsive Desgin */ ?>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<?php wp_head(); /* Required for WordPress to Function Properly. */ ?>
<?php if(ot_get_option('favicon') !=='') { ?>
<!-- Favicon -->
<link href="<?php echo ot_get_option('favicon'); ?>" rel="shortcut icon">
<?php } ?>
</head>
	<body <?php body_class(); ?>>
	
		<!-- wrapper Page-->
		<div class="wrapper-page">
	
			<!-- header -->
			<header class="header clear" role="banner">
				<div class="wrapper container">
					<!-- logo -->
					<div class="logo col-md-12">
					<div class="col-md-6">
					<a class="home-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
<?php function blogtitle() { if(ot_get_option('blog_heading') !=='') { echo ot_get_option('blog_heading');} else{ bloginfo( 'name' ); } } ?>
				<?php if(ot_get_option('custom_logo') !=='') { ?>

<img src="<?php echo ot_get_option('custom_logo'); ?>" alt="<?php blogtitle(); ?>" title="<?php blogtitle(); ?>"/>
				<?php } ?>
				<h1 class="site-title <?php if(ot_get_option('custom_logo') !=='') { echo('hidden'); } ?>">
				<?php blogtitle(); ?>
								</h1>
				<h2 class="site-description <?php if(ot_get_option('custom_logo') !=='') { echo('hidden'); } ?>">
				<?php if(ot_get_option('blog_subheading') !=='') { 
							echo ot_get_option('blog_subheading');
							} else{
									bloginfo( 'description' ); } ?>
				</h2>
			</a>
				</div>
				<?php if(ot_get_option('head_ads') !== '') { ?> 
				<div class="header-ad col-md-6"><?php echo ot_get_option('head_ads'); ?></div>
				<?php } ?>
				<div class="fix"></div>
					</div>
					</div><!-- Wrapper -->
					<!-- /logo -->
					
					<!-- nav -->
<nav class="nav-head" role="navigation">
<div class="wrapper container">
	<!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#wpheadnav" id="navtoggle">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
  </div>
<div class="collapse navbar-collapse" id="wpheadnav">
<?php wpden_head_nav(); ?></div>
<?php /* Search form for Navbar */ ?>
<form role="search" method="get" class="search-form navbar-form" action="<?php echo home_url(); ?>">
<div class="form-group">
<input type="search" class="search-field form-control" placeholder="To search, type and hit enter." value="" name="s">
<input type="submit" class="search-submit btn btn-default" value="Search">
</div>
</form>
</div>
</nav>
<!-- /nav -->
</header>
<!-- /header -->