<!-- pagination -->
<div class="fix"></div>
<?php if(ot_get_option('pst_pagi') == 'pagi-num') { ?>
<div class="ar-pagination">
	<?php wpden_pagination(); ?>
</div>
<?php }  else { ?> 
<ul class="pager">
	<li class="nav-previous alignleft previous"><?php next_posts_link( '&larr; Older posts' ); ?></li>
	<li class="nav-next alignright next"><?php previous_posts_link( 'Newer posts &rarr;' ); ?></li>
	</ul>
<?php } ?>
<!-- /pagination -->