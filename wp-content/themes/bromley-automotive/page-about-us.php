<?php get_header(); ?>

<div class="white-wrap container-fluid page-content">
	<?php if (have_posts()): ?>
		<?php while(have_posts()) : the_post(); ?>
			<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );?>
			<div class="row banner_image banner_image2" style="background-image: url(<?php echo $image[0];?>);">
				<h1><?php the_title();?></h1>
			</div>

			<div class="container margin-top-bottom-40">
				<div class="row">
					<div class="span7">
						<?php the_content(); ?>
					</div>
					<div class="span5 about_gallery">
						<div class="rightimage">
							<?php 
							$files = rwmb_meta( 'dd_about_us_gallery_image', 'type=file' );
							foreach ($files as $file) {
								echo wp_get_attachment_image($file['ID'],'medium');
								
							} ?>
						</div>
						<div class="align-center">
							<a href="<?php bloginfo('wpurl')?>/gallery/" class="blue_button2">View Gallery Of Our Work ></a>
						</div>
					</div>
				</div>
			</div>
		<?php endwhile; ?>
	<?php else : ?>
		<?php get_template_part('404'); ?>
	<?php endif; ?>
</div>

<div class="container-fluid block_our-team">
	<h3 class="align-center">Our Team</h3>
	<div class="home_our_team">
		<?php echo rwmb_meta( 'dd_describe_our_team' ); ?>
	</div>
	<div class="container">
		<div class="row">
			<?php
			//echo do_shortcode('[people limit="-1" cols="3" include="'.implode(',',$front_page_team_ids).'"]');
			$front_page_id = get_option('page_on_front');
			$front_page_team_ids = array(rwmb_meta( 'dd_our_team_member_1', array(), $front_page_id ),rwmb_meta( 'dd_our_team_member_2', array(), $front_page_id ),rwmb_meta( 'dd_our_team_member_3', array(), $front_page_id ));

			//echo do_shortcode('[people limit="3" cols="3" include="'.implode($front_page_team_ids,',').'"]'); 
			echo do_shortcode('[people limit="-1" cols="3" orderby="title" order="ASC"]'); 
			?>
		</div>
	</div>
	
	<?php //echo show_team(); ?>
</div>

<?php get_footer(); ?>
