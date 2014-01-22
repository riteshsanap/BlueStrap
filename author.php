<?php get_header(); ?>
	
	<!-- section -->
	<section role="main" id="main">
		<div class="wrapper container">
		<div id="primary" class="primary col-md-8 col-xs-12 <?php if(ot_get_option('pst_display') =='pst-mag') { echo('mag-pst');} ?>">
			<div class="well well-default archive-title well-sm">

			<h1><div class="thumbnail-container pull-left authorimg"><?php echo get_avatar(get_the_author_meta('user_email'),64); ?></div><span class="label label-primary pull-right">Author</span><?php echo get_the_author() ; ?>
			</h1>

	<?php if ( get_the_author_meta('description')) : ?>
	<em><?php the_author_meta('description'); endif; ?></em>
<div class="fix"></div>
			</div>
	
<?php if(ot_get_option('pst_display') == 'pst-mag') { ?>
		<?php get_template_part('magazine'); ?>
<?php } else { ?>
		<?php get_template_part('loop'); ?>
<?php } ?>
		<?php get_template_part('pagination'); ?>
	</div><?php get_sidebar(); ?></div>
	</section>
	<!-- /section -->
	


<?php get_footer(); ?>