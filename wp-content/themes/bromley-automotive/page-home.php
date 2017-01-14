<?php
/*
 * Template Name: Home Page
 */
?>

<?php get_header(); ?>
<?php
	$args = array(
		'posts_per_page'		=> 10,
		'post_type'				=> 'slides'
	);
	$slides = get_posts($args);
?>
<div id="owl-home_slider" class="owl-carousel owl-theme">
	<?php foreach ( $slides as $slide ) : setup_postdata( $slide );
	echo '<div class="item">';
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $slide->ID ), 'single-post-thumbnail' );
	echo '<img src="' . $image[0] . '" />';
	echo '<div class="slide_title">' . $slide->post_title . '</div>';
	echo '<div class="slide_subtitle">' . apply_filters('the_content', $slide->post_content) . '</div>';
	echo '</div>';
	endforeach;
	wp_reset_postdata();?>
</div>

<div class="white-wrap container page-content">
	<?php if (have_posts()): ?>
		<?php while(have_posts()) : the_post(); ?>
			<?php the_content(); ?>
			<?php echo rwmb_meta( 'personal' );?>
		<?php endwhile; ?>
	<?php else : ?>
		<?php get_template_part('404'); ?>
	<?php endif; ?>
</div>

<?php
	$args = array(
		'posts_per_page'		=> 10,
		'post_type'				=> 'testimonials',
		'order'					=> 'ASC',
		'order_by'				=> 'ID'
	);
	$slides = get_posts($args);
?>

<a class="back_to_top" href="#">BACK TO TOP</a>
<div id="owl-home_testimonials" class="owl-carousel owl-theme">
	<?php foreach ( $slides as $slide ) : setup_postdata( $slide );
	echo '<div class="home_testimonial">';
	the_content();
	echo '<a class="blue_button1" href="#">View our reviews on Google+</a>';
	echo '</div>';
	endforeach;
	wp_reset_postdata();?>
</div>


<script type="text/javascript">
</script>
<?php get_footer(); ?>