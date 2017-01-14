<?php get_header(); ?>
<?php
	$args = array(
		'posts_per_page'		=> 10,
		'post_type'				=> 'slides'
	);
	$slides = get_posts($args);
?>
<div id="owl-home_slider" class="owl-carousel owl-theme">
	<div class="item">
	 <img src="<?php echo get_template_directory_uri();?>/images/home-carousel/Home-Scratch-and-Dent-Removal.jpg">
	 <div class="banner-content left">
		<div class="slide_title">Museum exhibit ready.</div>
		<div class="slide_subtitle">We erase dents and scratches returning your vehicle to the way it was new. You’ll drive with confidence again.</div>
		<a href="<?php bloginfo('wpurl');?>/services/repair-work/collision-repair/">Visit Collision Repair »</a>
	 </div>
	</div>
	<div class="item">
	 <img src="<?php echo get_template_directory_uri();?>/images/home-carousel/Home-Rust-Removal.jpg">
	 <div class="banner-content right">
		<div class="slide_title">Hiding your rust?</div>
		<div class="slide_subtitle">Is your vehicle an embarrassing eyesore? Don't let rust take control of where you're hiding your car. Bring your car back to the way it was when it was brand new, when you were proud to be driving it.</div>
		<a href="<?php bloginfo('wpurl');?>/services/repair-work/corrosion-repair/">Visit Corrosion Repair »</a>
	 </div>
	</div>
	<div class="item">
	 <img src="<?php echo get_template_directory_uri();?>/images/home-carousel/Home-RV-and-Commercial.jpg">
	 <div class="banner-content left">
		<div class="slide_title">Fixing broken homes.</div>
		<div class="slide_subtitle">No matter the size or the number of wheels we’ve got you covered. The bigger, the better.</div>
		<a href="<?php bloginfo('wpurl');?>/services/repair-work/rv-and-commercial-repairs/">Visit RV and Commercial Repairs »</a>
	 </div>
	</div>	
	<div class="item">
	 <img src="<?php echo get_template_directory_uri();?>/images/home-carousel/Home-Auto-Painting.jpg">
	 <div class="banner-content left">
		<div class="slide_title">The parking space showroom.</div>
		<div class="slide_subtitle">Whether it's a touch up or entirely fresh paint, we’ll transform your car into something you'll go out of your way to show off. We take great pride in turning parking lots into showrooms.</div>
		<a href="<?php bloginfo('wpurl');?>/services/painting-protection/auto-painting/">Visit Auto Painting »</a>
	 </div>
	</div>
	<div class="item">
	 <img src="<?php echo get_template_directory_uri();?>/images/home-carousel/Home-Spray-on-Liners.jpg">
	 <div class="banner-content left">
		<div class="slide_title">Be sure your back is covered.</div>
		<div class="slide_subtitle">Don't be scared about what you toss in the back of your truck. We have durable solutions to protect your vehicle from whatever you want to throw at it, or in it.</div>
		<a href="<?php bloginfo('wpurl');?>/services/painting-protection/spray-on-liners/">Visit Spray on Liners »</a>
	 </div>
	</div>
	<div class="item">
	 <img src="<?php echo get_template_directory_uri();?>/images/home-carousel/Home-Rust-Prevention.jpg">
	 <div class="banner-content right">
		<div class="slide_title">Don't think of dollar signs every time it rains.</div>
		<div class="slide_subtitle">If rust isn't properly prevented it can quickly eat away at your car leaving you with an unsafe and embarrassing problem. Stop fearing the harsh Canadian weather and prevent rust before it becomes visible and damaging.</div>
		<a href="<?php bloginfo('wpurl');?>/services/painting-protection/rust-proofing/">Visit Rust Proofing »</a>
	 </div>
	</div>
	<div class="item">
	 <img src="<?php echo get_template_directory_uri();?>/images/home-carousel/Home-Classic-and-Antique-Restoration.jpg">
	 <div class="banner-content right">
		<div class="slide_title">Beauty before age.</div>
		<div class="slide_subtitle">You can put lipstick on your Camaro, but it's still just a Camaro with lipstick. Our love of classic automobiles makes us the shop for all of your classic restoration needs.</div>
		<a href="<?php bloginfo('wpurl');?>/services/additional-services/classic-car-restoration/">Visit Classic Car Restoration »</a>
	 </div>
	</div>


</div>

<div class="white-wrap page-content">
	<?php if (have_posts()): ?>
		<?php while(have_posts()) : the_post(); ?>
			<div class="container-fluid column_resize">
				<div class="row">
					<div class="span5">
						<h3><?php echo the_title();?></h3>
						<?php the_content(); ?>
						<div class="align-center">
							<a href="<?php bloginfo('wpurl');?>/gallery/" class="white_button1">View our gallery »</a>
						</div>
					</div>
					<div class="span2">&nbsp;</div>
					<div class="span5">
						<h4>News from the shop.</h4>
						<?php echo do_shortcode('[custom-facebook-feed num=1]');?>
						<div class="align-center">
							<a href="<?php bloginfo('wpurl');?>/news-updates/" class="white_button1">View More »</a>
						</div>
					</div>
				</div>
			</div>
		<?php endwhile; ?>
	<?php else : ?>
		<?php get_template_part('404'); ?>
	<?php endif; ?>
</div>


<?php echo rwmb_meta( 'personal' );?>

<div class="container-fluid home_services">
	<div class="row">
		<div class="span12">
			<div class="service_explainer">
				<?php echo rwmb_meta( 'dd_services_explainer'); ?>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="span1">&nbsp;</div>
		<div class="span10">
			<div class="container-fluid">
				<div class="row home_dropdowns">
					<div class="span4 pull_down block_repair_work">
						<div class="icon_pull" id="icon_repair_work"></div>
						<h4>Repair Work&nbsp;</h4>
						<?php show_pull_down_menu('Repair Work');?>
					</div>
					<div class="span4 pull_down block_painting_protection">
						<div class="icon_pull" id="icon_painting_protection"></div>
						<h4>Painting Protection&nbsp;</h4>
						<?php show_pull_down_menu('Painting & Protection');?>
					</div>
					<div class="span4 pull_down block_additional_services">
						<div class="icon_pull" id="icon_additional_services"></div>
						<h4>Additional Services&nbsp;</h4>
						<?php show_pull_down_menu('Additional Services');?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<h3 class="align-center">Our Team</h3>
			<div class="home_our_team">
				<?php echo rwmb_meta( 'dd_describe_our_team' ); ?>
			</div>
			<div class="container-fluid">
				<div class="row">
					<?php
					$front_page_team_ids = array(rwmb_meta( 'dd_our_team_member_1'),rwmb_meta( 'dd_our_team_member_2'),rwmb_meta( 'dd_our_team_member_3'));
					echo do_shortcode('[people limit="3" cols="3" include="'.implode(',',$front_page_team_ids).'"]'); ?>
					<div class="align-center">
						<a class="white_button1 margin_bottom_40" href="<?php bloginfo('wpurl');?>/about-us">More about us &raquo;</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<a class="back_to_top" href="#">BACK TO TOP</a>

<?php echo do_shortcode('[testimonials limit="-1"]'); ?>

<?php get_footer(); 