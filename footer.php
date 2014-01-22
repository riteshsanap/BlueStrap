			<!-- footer -->
			<footer class="footer" role="contentinfo">
				<div id="footer-col">
				<div class="wrapper container">
				<div class="col1 col-md-4">
					<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-widget-area-1')) ?>	
					</div>
					<div class="col2 col-md-4">
						<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-widget-area-2')) ?>	
					</div>
					<div class="col3 col-md-4">
						<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-widget-area-3')) ?>	
					</div>
				</div>
</div>
				<!-- copyright -->
				<div class="copyright">
				<div class="wrapper container">
					<div class="col-md-6 leftside">&copy; <?php echo date("Y"); ?> Copyright <?php bloginfo('name'); ?>.</div>
				 <div class="col-md-6 maincopy">
				 	<?php _e('Powered by', 'wpden'); ?> 
					<a href="//wordpress.org" title="WordPress" class="label label-danger">WordPress</a> &amp; 
					<?php _e('Theme','wpden'); ?>  by <a href="<?php _e('http://www.best2know.info/','wpden'); ?>" class="label label-danger"><?php _e('Ritesh Sanap','wpden'); ?></a>
				</div>
				 </div><!-- END Wrapper -->
				</div>
				<!-- /copyright -->
			</footer>
			<!-- /footer -->
		
		</div>
		<!-- /Wrapper-Page -->

		<?php wp_footer(); ?>
	</body>
</html>