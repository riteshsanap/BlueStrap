<?php get_header(); ?>

	<!-- section -->
	<section role="main" id="main">
		<div class="wrapper container">
		<div id="primary" class="primary col-md-8 col-xs-12 ">
		<!-- article -->
		<article id="error">
		<div class="alert alert-danger error-page">
		<h1><span class="glyphicon glyphicon-warning-sign ico404"></span><?php _e( 'Page not found - 404', 'wpden' ); ?></h1>
		</div>

<div class="alert alert-info"><p>Sorry, The Page you are Looking for <b>cannot be found</b>. Try the Following Options :
<ul class="errlist">
<li>Try Checking the URL for any errors</li>
<li>Use Search box :<div class="fix"></div>
<div class="col-md-6"><?php get_template_part('searchform'); ?></div>
<div class="fix"></div>
</li>
<li>Just Go back to the <a href="<?php echo home_url(); ?>" class="badge badge-default">Home Page</a></li>
</ul>
</p>
</div>
</article>
<!-- /article -->
</div><?php get_sidebar(); ?></div>
</section>
<!-- /section -->
<?php get_footer(); ?>