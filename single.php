<?php get_header(); ?>
	
	<!-- section -->
	<section role="main" id="main">
		<div class="wrapper container">
		<div id="primary" class="primary col-md-8 col-xs-12 ">
	<?php if (have_posts()): while (have_posts()) : the_post(); ?>
<?php post_share(); ?>		
		<!-- article -->
		<article id="post-<?php the_ID(); ?>" <?php post_class('panel panel-default panel-body'); ?>>

			<!-- post title -->
		<h1 class="post-title">
		<?php the_title(); ?>
		</h1>
		<!-- /post title -->
		<div class="post-meta">
		<!-- post details -->
		<span class="date"><span class="glyphicon glyphicon-calendar"></span> <?php the_time('F j, Y'); ?></span>
		<span class="author"><span class="glyphicon glyphicon-user"></span> <?php the_author_posts_link(); ?></span>
		<span class="comments"><span class="glyphicon glyphicon-comment"></span> <?php comments_popup_link( __( 'Comments', 'wpden' ), __( '1 Comment', 'wpden' ), __( '% Comments', 'wpden' )); ?></span>
		<?php edit_post_link('Edit', '<span class="edit-link glyphicon glyphicon-edit"></span> ', ''); ?>
		<!-- /post details -->
		</div> 
		<div class="post-body">
		<?php if(ot_get_option('below_pst_title') !== '') { ?> 
		<div class="pst-ad-above">
			<?php echo ot_get_option('below_pst_title'); ?>
		</div>
		<?php } ?>
		<?php if((ot_get_option('pst_thumb') != 'pst-thumb-single') && (ot_get_option('pst_thumb') != 'pst-thumb-disable')) { ?>
				<!-- post thumbnail -->
			<?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
			<div class="thumbnail-container pull-left">
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="thumbnail">
					<?php the_post_thumbnail(array(200,200)); ?>
				</a></div>
			<?php endif; ?>
			<!-- /post thumbnail -->
		<?php } ?>
			<?php the_content(); // Dynamic Content ?>

			<div class="ps-pagination">
				<?php wp_link_pages(array('before' => '<ul class="pagination ps-pages"><a>Pages</a>',
				'after' => '</ul>', 'link_before' => '<span>', 'link_after' => '</span>')); ?> 
			</div>

			<?php if(function_exists('related_posts') || (ot_get_option('pst_content_below') != '')) { ?>
	<div id="belowpst-stuff" class="well well-default well-sm">
		<div class="relatedpst col-md-6">
		<?php if(function_exists('related_posts')) { related_posts(); } ?>
		</div>
		<?php if(ot_get_option('pst_content_below') != '') { ?> 
		<div class="pst-ad-below col-md-6"><?php echo ot_get_option('pst_content_below'); ?></div>
		<?php } ?><div class="fix"></div>
	</div>
<?php } ?>
			<div class="fix"></div>
			</div>
			<div class="post-footer">
			<span class="cat-foot">
			<span class="glyphicon glyphicon-book"></span> <?php _e( 'Categorised in: ', 'wpden' ); the_category(', '); // Separated by commas ?>
			</span>
			<span class="tags-foot">
			<?php the_tags( __( '<span class="glyphicon glyphicon-tags"></span> Tags: ', 'wpden' ), ', ', '<br>'); // Separated by commas with a line break at the end ?>
			</span>
<div class="fix"></div>
				</div>
			<?php comments_template(); ?>
			
		</article>
		<!-- /article -->
		
	<?php endwhile; ?>
	
	<?php else: ?>
	
		<!-- article -->
		<article>
			
			<h1><?php _e( 'Sorry, nothing to display.', 'wpden' ); ?></h1>
			
		</article>
		<!-- /article -->
	
	<?php endif; ?>
	</div><?php get_sidebar(); ?></div>
	</section>
	<!-- /section -->
	


<?php get_footer(); ?>