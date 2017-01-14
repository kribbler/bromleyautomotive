<?php get_header(); ?>
<div class="white-wrap container-fluid page-content">
	<?php if (have_posts()): ?>
		<?php while(have_posts()) : the_post(); ?>
			<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );?>
			<div class="row banner_image banner_image2" style="background-image: url(<?php echo $image[0];?>);">
			</div>
			<div class="row">
				<div class="span12">
					<h1><?php the_title();?></h1>
				</div>
				<div class="span12">
					<div class="container margin_bottom_40">
						<?php the_content(); ?>
					</div>
				</div>
			</div>
		<?php endwhile; ?>
	<?php else : ?>
		<?php get_template_part('404'); ?>
	<?php endif; ?>
</div>

<div class="container-fluid">
	<div class="row relative_me">
	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d19119.899757318446!2d-79.52171052829735!3d44.5726730236272!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4d2aadb93c7041ab%3A0x6ff3f86faf9c867a!2s1934+12+Line+N%2C+Oro-Medonte%2C+ON+L0L+1T0%2C+Canada!5e0!3m2!1sen!2suk!4v1441701490639" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
<div class="google_directions">
<a href="https://www.google.co.uk/maps/dir//1934+12+Line+N,+Oro-Medonte,+ON+L0L+1T0,+Canada/@44.572673,-79.5217105,14.25z/data=!4m13!1m4!3m3!1s0x4d2aadb93c7041ab:0x6ff3f86faf9c867a!2s1934+12+Line+N,+Oro-Medonte,+ON+L0L+1T0,+Canada!3b1!4m7!1m0!1m5!1m1!1s0x4d2aadb93c7041ab:0x6ff3f86faf9c867a!2m2!1d-79.5122369!2d44.570258" class="btn directions" target="_blank">Get Directions ></a>
</div>
	</div>
</div>

<?php get_footer(); ?>
