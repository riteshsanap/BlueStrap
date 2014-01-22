<?php if (have_posts()): while (have_posts()) : the_post(); ?>
	
	<!-- article -->
	<article id="post-<?php the_ID(); ?>" <?php 
	if(is_sticky()) {
		post_class('well well-default');
	} else post_class('panel panel-default panel-body'); ?>>
	
		<!-- post title -->
		<h1 class="post-title">
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
			<?php if(is_sticky()) {
				echo('<div class="label label-primary pull-right">Featured</div>');
			} ?>
		</h1>
		<!-- /post title -->
		<div class="post-meta">
		<!-- post details -->
		<span class="date"><span class="glyphicon glyphicon-calendar"></span> <?php the_time('F j, Y'); ?></span>
		<span class="author"><span class="glyphicon glyphicon-user"></span> <?php the_author_posts_link(); ?></span>
		<span class="comments"><span class="glyphicon glyphicon-comment"></span> <?php comments_popup_link( __( 'Comments', 'html5blank' ), __( '1 Comment', 'html5blank' ), __( '% Comments', 'html5blank' )); ?></span>
		 <?php edit_post_link('Edit', '<span class="edit-link glyphicon glyphicon-edit"></span> ', ''); ?>
		<!-- /post details -->
		</div>
		<div class="post-body">
		<?php if(ot_get_option('pst_thumb') != 'pst-thumb-disable'){ ?>
			<!-- post thumbnail -->
		<?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
		<div class="thumbnail-container pull-left">
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="thumbnail">
				<?php the_post_thumbnail(array(150,150)); // Declare pixel size you need inside the array ?>
			</a></div>
		<?php endif; ?>
		<!-- /post thumbnail -->
		<?php } ?>
		<?php the_content(wpden_custom_readmore());?>
		
					<div class="ps-pagination">
			<?php wp_link_pages(
			array(
				'before' => '<ul class="pagination ps-pages"><a>Pages</a>',
				'after' => '</ul>',
				'link_before' => '<span>',
				'link_after' => '</span>'
				)
		); ?> 
		</div>

		<div class="fix"></div>
		</div>
		
		
	</article>
	<!-- /article -->
	
<?php endwhile; ?>

<?php else: ?>

	<!-- article -->
	<article>
		<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
	</article>
	<!-- /article -->

<?php endif; ?>