<?php
global $post;
$id=0;
if (is_single())
	$id=$post->ID;
$oldpost=$post;
$args = array(
    'posts_per_page'  => (isset($atts['limit']))?(($atts['limit']==="-1")?-1:(int)$atts['limit']):-1,
    'offset'          => 0,
	'numberposts'	  => 0,
    'orderby'         => 'random',
    'order'           => 'DESC',
    'post_type'       => 'people',
);
if (!empty($atts['include'])) {
	$args['include']=$atts['include'];
}
if (!empty($atts['group'])) {
	$args['peoplegroup']=$atts['group'];
}
$p=get_posts($args);
?>

<div class="people<?php echo (isset($atts['widget'])) ? '' : ' people_shortcode'; ?>">
<?php
$cols=(isset($atts['cols']) && ($atts['cols']<=12)) ? (int) $atts['cols'] : ((isset($atts['widget'])) ? 1 : 2);
$count=0;
echo '<div class="row">';
global $post;
foreach ($p as $post) {
	if ($post->ID==$id)
		continue;
	echo '<div class="span',(12/$cols),' ',(has_post_thumbnail() ? '' : ' noimage'),'">';
	echo '<div class="imgcont">';
	echo '<a href="',the_permalink(),'">';
	the_post_thumbnail('thumbnail');
	echo '</a>';
	echo '</div>';
	echo '<div><div class="title">';
	echo '<a href="',the_permalink(),'">';
	the_title();
	echo '</a>';
	$email=get_post_meta($post->ID, '_email', true);
	if ($email)
		echo '<a href="/contact-us/',htmlq($post->post_name),'" class="emaillink">Email</a>';
	echo '</div>';
	echo '<div class="desc">';
	echo snippet($post->post_content,20),'... ';
	echo '<a href="',the_permalink(),'" class="readmore">More &gt;</a>';	
	echo '</div>';		
	echo '</div></div>';	
	$count++;
	if ($count>0 && $count%$cols==0)
		echo '</div><div class="row">';
}
echo '</div>';
?>
</div>
<div class="clear"></div>
<?php
$post=$oldpost;