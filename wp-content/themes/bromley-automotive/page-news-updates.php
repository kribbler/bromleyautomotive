<?php get_header(); ?>

<div class="white-wrap container page-content news_page">
	<?php if (have_posts()): ?>
		<h1><?php the_title();?></h1>
		<div id="fb_social"><img src="<?php echo get_template_directory_uri();?>/images/logo_fb.png" /><p>BROMLEY SOCIAL</p></div>
		<?php while(have_posts()) : the_post(); ?>
			<div class="container">
				<div class="row">
					<!--<div class="span2">&nbsp;</div>-->
					<!--<div class="span8">-->
						<?php the_content(); ?>
					<!--</div>-->
					<!--<div class="span2">&nbsp;</div>-->
				</div>
			</div>
		<?php endwhile; ?>
		<?php else : ?>
			<?php get_template_part('404'); ?>
		<?php endif; ?>
</div>

<!--<script src="http://c.fzilla.com/1291523190-jpaginate.js"></script>-->

<script>  
</script>  

<?php get_footer(); ?>
