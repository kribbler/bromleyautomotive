<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
 
$services=services::instance();
$topinfo=$services->metadata('topinfo');
$rightcolumn=$services->metadata('rightcolumn');
$points=!empty($rightcolumn->points) ? preg_split('#[\r\n]+#',$rightcolumn->points) : array();
array_walk($points,'trim');
$points=array_filter($points);
$rimg=rwmb_meta('rightimage',array('type'=>'image','size'=>'medium'));
$side = rwmb_meta('bannerside')=="right"?"right":"left";
if ($rimg) {
	$rimg=array_pop($rimg);
	if (isset($rimg['url']))
		$rimg=$rimg['url'];
	else
		$rimg=false;
} else
	$rimg=false;
$rimg=$rimg ? '<div class="rightimage"><img src="'.htmlq($rimg).'"/></div>' : '';

$title=$post->post_title;

$span=12;
if ($rimg || $points) {
	$span=7;	
}
global $post;
$children=get_children(array(
	'post_parent' => $post->ID,
	'post_type'   => 'services', 
	'numberposts' => -1,
	'post_status' => 'any',
	'orderby'=>'menu_order',
	'order'=>'ASC'
));
$parents=array();
$is_parent = ($children)?true:false;
$siblings=array();
$sibling_selectbox_title='service';
if (!empty($post->post_parent)) {
	$siblings=get_posts(array(
		//'post_parent' => $post->post_parent,
		'post_type'   => 'services', 
		'numberposts' => -1,
		'post_status' => 'any',
		'post__not_in'=>array($post->ID),
		'orderby'=>'menu_order',
		'order'=>'ASC'
	));
	$sort=$sort2=$sort3=array();
	foreach ($siblings as $k=>$a) {
		if (empty($a->post_parent)) {
			$parents[$a->ID]=$a->post_title;
			unset($siblings[$k]);
		} else {
			$sort[$k]=$a->post_parent;
			$sort2[$k]=$a->menu_order;	
			$sort3[$k]=$a->ID;	
		}
	}
	array_multisort($sort,SORT_ASC,$sort2,SORT_ASC,$sort3,SORT_ASC,$siblings);
	
	$p=get_post($post->post_parent);
	$sibling_selectbox_title=preg_replace('#services?#i','',$p->post_title);
	$sibling_selectbox_title.=' service';
}

?>
<div class="container-fluid">
<div class="service<?php echo ($is_parent) ? ' parentservice' : ''; ?>">
<div class="main">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'service-banner' ); ?>
	<div class="row banner_image banner_higher" style="<?php echo ($image[0]?"background-image: url(".$image[0].");":'');?>">
	
	<?php
		/*$image=get_the_post_thumbnail(NULL,'full');
		if ($image) {
			
			echo '<div class="header_img_container">';	
			echo $image;
		}*/
		echo '<div class="service_header">';
		echo '<div class="banner-content">';
		if (empty($topinfo->header) && !$siblings)
			$topinfo->header=$post->post_title;
		if($topinfo->header||$topinfo->description)
			echo '<div class="banner-content '.(!$is_parent?$side:"").'">';
		if (!empty($topinfo->header))
			echo '<h1 class="slide_title">',html($topinfo->header),'</h1>';
		if (!empty($topinfo->description))
			echo '<div class="slide_subtitle">',$topinfo->description,'</div>';
		if($topinfo->header||$topinfo->description)
			echo '</div>';
		echo '</div>';
		if ($children) {
			echo '<ul class="services_children">';
			foreach ($children as $post) {
				echo '<li>';
				echo '<a href="',the_permalink(),'">';
				the_title();
				echo '</a>';
				echo '</li>';
			}
			echo '</ul>';
			wp_reset_postdata();?>
				<div class="buttons">
					<a href="/gallery/#<?php echo htmlq($post->post_name); ?>" class="btn gallery">View Photo Gallery ></a>
					<a href="/contact-us/?subject=<?php echo htmlq(urlencode($title)); ?>" class="btn bookanappointment">Book an Appointment ></a>
				</div>
			<?php 
		}
		echo '</div>';
		if ($image)
			echo '</div>';
	?>
	</div>
	<?php if(!$is_parent){?>
	<div class="entry-content">
		<div class="container-fluid margin-top-bottom-40 services">
	    	<div class="row">
	        <div class="span<?php echo $span; ?>">
				<?php if ($post->post_title!=$topinfo->header) { ?>
				<h1><?php the_title(); ?></h1>
				<?php } ?>
				<?php the_content();?>
				<div class="buttons">
					<a href="/gallery/#<?php echo htmlq($post->post_name); ?>" class="btn gallery">View Photo Gallery ></a>
					<a href="/contact-us/?subject=<?php echo htmlq(urlencode($title)); ?>" class="btn bookanappointment">Book an Appointment ></a>
				</div>
	        </div>
	        <?php if ($rimg || $points) { ?>
	        	<div class="span<?php echo 12-$span; ?>">
	            	<?php echo $rimg;
					if ($points) {
						echo '<h4>Tips Of The Trade</h4>';
						echo '<ul class="service_points">';
						foreach ($points as $a) {
							echo '<li>',html($a),'</li>';
						}
						echo '</ul>';
					}
					?>
					<h4>See What Else We Do</h4>
					<?php
					if ($siblings) {
						echo '<div class="custom_select margin_left_40">';
						echo '<select id="changepost" class="wpcf7-select">';
						echo '<option value="">Select another service...</value>';
						$coptgroup='';
						$count_optgroup=0;
						foreach ($siblings as $post) {
							$optgroup=$parents[$post->post_parent];
							if ($optgroup!=$coptgroup) {
								$coptgroup=$optgroup;
								if ($count_optgroup)
									echo '</optgroup>';
								$count_optgroup+=1;
								echo '<optgroup label="',htmlq($optgroup),'">';
							}
							echo '<option value="',the_permalink(),'">',the_title(),'</option>';	
						}
						if ($count_optgroup)
							echo '</optgroup>';
						echo '</select>';
						echo '</div>';
						wp_reset_postdata();
						$siblings=false;
					}
					?>
	            </div>
	        <?php } ?>
	        <?php if ($siblings) {
	        	echo '<div class="custom_select">';
				echo '<select id="changepost" class="wpcf7-select">';
				echo '<option value="">Select another service...</value>';
				$coptgroup='';
				$count_optgroup=0;
				foreach ($siblings as $post) {
					
					$optgroup=$parents[$post->post_parent];
					if ($optgroup!=$coptgroup) {
						$coptgroup=$optgroup;
						if ($count_optgroup)
							echo '</optgroup>';
						$count_optgroup+=1;
						echo '<optgroup label="',htmlq($optgroup),'">';
					}
					echo '<option value="',the_permalink(),'">',the_title(),'</option>';	
				}
				if ($count_optgroup)
					echo '</optgroup>';
				echo '</select>';
				echo '</div>';
				wp_reset_postdata();
			} ?>
	        </div>
	    </div>
	</div><!-- .entry-content -->
		<?php }?>

	<?php edit_post_link( __( 'Edit', 'twentyfifteen' ), '<footer class="entry-footer row"><span class="edit-link">', '</span></footer><!-- .entry-footer -->' ); ?>

</article><!-- #post-## -->
</div></div>
</div>
<script>
jQuery(document).ready(function($) {
	$('#changepost').change(function() {
		var v=$(this).val();
		if (!v)
			return false;
		window.location=v;
	});
});
</script>