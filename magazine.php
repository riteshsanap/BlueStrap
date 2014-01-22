<?php 
/* Magazine Style */ ?>
<?php if (have_posts()): while (have_posts()) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('panel panel-default panel-body col-md-6 magazine'); ?>>
<!-- post title -->
<?php if(is_sticky()) {
				echo('<div class="label label-primary mag-sticky-txt">Featured</div>');
			} ?>

		<h1 class="post-title">
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
			<div class="fix"></div>
		</h1>
		<!-- /post title -->
		<div class="post-meta">
		<!-- post details -->
		<span class="date"><span class="glyphicon glyphicon-calendar"></span> <?php the_time('F j, Y'); ?></span>
		<span class="author"><span class="glyphicon glyphicon-user"></span> <?php the_author_posts_link(); ?></span>
		<!-- /post details -->
		</div>
		<div class="post-body">
			<!-- post thumbnail -->
		<?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
		<div class="thumbnail-container pull-left col-md-12">
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="thumbnail">
				<?php the_post_thumbnail(array(300,300)); // Declare pixel size you need inside the array ?>
			</a></div>
		<?php endif; ?>
		<!-- /post thumbnail -->
		<?php wpden_excerpt('wpden_mag_len'); ?>
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
</article>
<?php if(++$j % 2 == 0) {  
/* Added for avoiding Overlapping of Columns in Magazine Style - adds the below DIV after every 2 posts so to keep it nice looking */
	?>
<div class="fix"></div>
<?php } ?> 

<?php endwhile; endif; ?>