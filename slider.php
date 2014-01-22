<?php 
/* 
Slider for BlueStrap Theme 
Based on BootStrap 3 Carousel
by Ritesh Sanap
version 1.0
*/

function wpden_bs_slider() { 
$slidercat = ot_get_option('slider_cat');
$sliderpst = ot_get_option('slider_num');
?>

<?php function wpden_slider_css() {
if(ot_get_option('slider_max') != '350px') { 
?>
<style type="text/css">
	.slider-img, .carousel-inner{
		max-height: <?php echo trim(ot_get_option('slider_max')); ?>;
	}
</style>
<?php } } add_action('wp_footer','wpden_slider_css',99999);
 ?>
<div id="slider">
<div class="carousel slide  panel panel-default" id="theCarousel" data-interval="<?php echo ot_get_option('slider_inv'); ?>">
 <div class="carousel-inner">

<?php 
 query_posts('cat='.$slidercat.'&order=DESC&orderby=date&posts_per_page='.$sliderpst.'&ignore_sticky_posts=1');
if (have_posts()) : $count = 0; 
while(have_posts()) : the_post(); $count++;
$sliderimg = post_thumbnail_wpden(); 
?>
              <div class="item<?php if($count == '1') {
              	echo " active";
              	}?>">
              	<a href="<?php the_permalink(); ?>">
                <img src="<?php echo $sliderimg; ?>" alt="1" class="img-responsive slider-img thumbnail" />
                <div class="carousel-caption">
                  <h4><?php the_title(); ?></h4>
                  <?php if(ot_get_option('slider_len') !=='0') { ?>
                  	<p><?php wpden_excerpt('wpden_slider_len','wpden_slider_more'); ?></p>
                	<?php  } ?>
                  
                </div>
                </a>
              </div>
          <?php endwhile; endif; ?>
            </div>
<ol class="carousel-indicators slider-indicator">
<?php 
if (have_posts()) : $count = 0; 
while(have_posts()) : the_post(); $count++;
$slidercount = $count-1;
?>
<li data-target="#theCarousel" data-slide-to="<?php echo $slidercount; ?>" <?php if($count == '1') { echo ('class="active"'); } ?>></li>
<?php endwhile; endif; ?>
            </ol>
            <a href="#theCarousel" class="carousel-control left" data-slide="prev"><span class="icon-prev"></span></a>
            <a href="#theCarousel" class="carousel-control right" data-slide="next"><span class="icon-next"></span></a>
          </div>
        </div>
<?php wp_reset_query(); } ?>