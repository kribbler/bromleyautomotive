<?php
$args = array(
    'posts_per_page'  => 1,
    'offset'          => 0,
	'numberposts'	  => 0,
    'post_type'       => 'people',
	'include'=>$theperson
);
$posts=get_posts($args);
foreach ($posts as $p) { 
	echo '<p>',snippet($p->post_content,20),'</p>';
	echo '<a href="',get_the_permalink($p->ID),'" class="btn">Read More</a>';
}
