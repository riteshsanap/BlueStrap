<?php get_header(); ?>
	
	<!-- section -->
	<section role="main" id="main">
		<div class="wrapper container">
		<?php if(ot_get_option('slider_pos') =='sld-fl') { ?>
		<div class="col-md-12 slider-full">
			<?php wpden_bs_slider(); ?>
		</div>
		<?php } ?>
		
<div id="primary" class="primary col-md-8 col-xs-12 <?php if(ot_get_option('pst_display') =='pst-mag') { echo('mag-pst');} ?>">
		<?php if(ot_get_option('slider_pos') =='sld-ps-ar') { ?>
		
			<?php wpden_bs_slider(); ?>
		
		<?php } ?>
<?php if(ot_get_option('pst_display') == 'pst-mag') { ?>
		<?php get_template_part('magazine'); ?>
<?php } else { ?>
		<?php get_template_part('loop'); ?>
<?php } ?>
		<?php get_template_part('pagination'); ?>
		</div><!-- END Primary -->
		<?php get_sidebar(); ?>
		</div><!-- END Wrapper -->
	</section>
	<!-- /section -->
<?php get_footer(); ?>