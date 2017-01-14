<!-- .page-body-content -->
</div>
<footer>
	<div class="container-fluid">
		<div class="row">
			<div class="span2">
				<a href="<?php echo site_url();?>" class="m-left-20">
					<img src="<?php echo get_stylesheet_directory_uri().'/images/logo-footer.jpg';?>" alt="<?php echo esc_attr(get_bloginfo('sitename'));?>" class="logo">
				</a>
			</div>

			<div class="span6">
				<?php dynamic_sidebar( 'footer-col-1' ); ?>
			</div>

			<div class="span3">
				<?php dynamic_sidebar( 'footer-col-4' ); ?>
			</div>
			
			<div class="span1">
				<?php dynamic_sidebar( 'social-links' ); ?>
			</div>
		</div>

		<div class="row">
			<div class="span12">
				<?php
					if(has_nav_menu('footer-menu')){
						wp_nav_menu(array(
							'theme_location' => 'footer-menu',
							'container' => '',
							'menu_class' => 'footer_menu',
							'menu_id' => 'navigation-footer',
							'depth' => 3,
						));
					}
				?>
			</div>
		</div>

		<div class="row">
			<div class="span12 footer-copyright">
				Copyright &copy <?php echo date('Y');?> Bromley Automotive. All Rights Reserved<br>
				<a href="http://firesideagency.ca" target="_blank">Website Design and Development by Fireside in Orillia.</a>
			</div>
		</div>
	</div>
</footer>

<script type="text/javascript">
jQuery(document).ready(function($){
	$('#activate_mobile_menu').click(function($){
	      jQuery('#mobile_menu_holder').toggle("slide");
	});

	$('#mobile_close').click(function(){
		jQuery('#mobile_menu_holder').toggle("slide");
	})
});
</script>
<?php
wp_footer();
?>
</body>
</html>