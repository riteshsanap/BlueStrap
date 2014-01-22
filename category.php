<?php get_header(); ?>
	
	<!-- section -->
	<section role="main" id="main">
		<div class="wrapper container">
		<div id="primary" class="primary col-md-8 col-xs-12 <?php if(ot_get_option('pst_display') =='pst-mag') { echo('mag-pst');} ?>">	
			<div class="well well-default archive-title well-sm">
			<h1><span class="label label-primary pull-right">Category</span><?php echo single_cat_title(); ?>
			</h1>
			</div>
<?php if(ot_get_option('pst_display') == 'pst-mag') { ?>
		<?php get_template_part('magazine'); ?>
<?php } else { ?>
		<?php get_template_part('loop'); ?>
<?php } ?>
		<?php get_template_part('pagination'); ?>
	</div><?php get_sidebar(); ?>
</div>
	</section>
	<!-- /section -->
	

<?php get_footer(); ?>