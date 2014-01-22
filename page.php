<?php get_header(); ?>
	
	<!-- section -->
	<section role="main" id="main">
		<div class="wrapper container">
		<div id="primary" class="primary col-md-8 col-xs-12 ">
	
		<?php if (have_posts()): while (have_posts()) : the_post(); ?>
	
		<!-- article -->
		<article id="post-<?php the_ID(); ?>" <?php post_class('panel panel-default panel-body'); ?>>
		<h1 class="post-title"><?php the_title(); ?></h1>
		<div class="post-meta">
		<!-- post details -->
		<span class="date"><span class="glyphicon glyphicon-calendar"></span> <?php the_time('F j, Y'); ?></span>
		<span class="author"><span class="glyphicon glyphicon-user"></span> <?php the_author_posts_link(); ?></span>
		<?php edit_post_link('Edit', '<span class="edit-link glyphicon glyphicon-edit"></span> ', ''); ?>
		<!-- /post details -->
		</div> 
		<div class="post-body">
			<?php the_content(); ?>
			</div>
			
			<div class="post-footer"></div>
			<?php comments_template(); ?>
		</article>
		<!-- /article -->
		
	<?php endwhile; ?>
	
	<?php else: ?>
	
		<!-- article -->
		<article>
			<h1 class="post-title"><?php the_title(); ?></h1>
			<h2><?php _e( 'Sorry, nothing to display.', 'wpden' ); ?></h2>
			
		</article>
		<!-- /article -->
	
	<?php endif; ?>

	</div><?php get_sidebar(); ?></div>
	</section>
	<!-- /section -->
	


<?php get_footer(); ?>