<?php
/*
Plugin Name: Our Team
Plugin URI: http://www.seoheap.com/
Description: People
Author: James Cantrell
Version: 12.0.0
Author URI: http://www.seoheap.com/
*/

add_action( 'init', 'people' );
function people() {
	register_post_type( 'people',array(
		'labels' => array(
			'name' => __( 'Our Team' ),
			'singular_name' => __( 'team' )
		),
		'public' => true,
		'has_archive' => true,
		'supports'=>array('title','editor','thumbnail'),
		'register_meta_box_cb' => 'add_people_metaboxes',
		'rewrite' => array( 'slug' => 'our-team', 'with_front'=> false ),

	));
	register_taxonomy(
		'position',
		'people',
		array(
			'hierarchical'=>false,
			'label'=>'Positions',
			'query_var'=>true,
			'rewrite'=>array(
				'slug'=>'our-team/position',
				'with_front'=> false,
				'feed'=> true,
				'pages'=> true
			)
		)
	);
	register_taxonomy(
		'peoplegroup',
		'people',
		array(
			'hierarchical'=>true,
			'label'=>'Groups',
			'query_var'=>true,
			'rewrite'=>array(
				'slug'=>'our-team/groups',
				'with_front'=> false,
				'feed'=> true,
				'pages'=> true
			)
		)
	);
}
function add_people_metaboxes() {
    add_meta_box('wpt_people_sample', 'Email', 'wpt_people_sample', 'people', 'side', 'default');	
}
function wpt_people_sample() {
	global $post;
	// Noncename needed to verify where the data originated
	echo '<input type="hidden" name="peoplemeta_noncename" id="peoplemeta_noncename" value="' .
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	$position = get_post_meta($post->ID, '_email', true);
	echo 'Email: <input type="text" name="_email" id="position" value="' . $position  . '" class="widefat"/>';
}
function wpt_save_people_meta($post_id, $post) {
	if (!isset($_POST['peoplemeta_noncename']) || !wp_verify_nonce( $_POST['peoplemeta_noncename'], plugin_basename(__FILE__) )) {
		return $post->ID;
	}
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;
	$meta['_email'] = $_POST['_email'];
	foreach ($meta as $key => $value) {
		$value = implode(',', (array)$value);
		if(get_post_meta($post->ID, $key, FALSE)) {
			update_post_meta($post->ID, $key, $value);
		} else {
			add_post_meta($post->ID, $key, $value);
		}
		if (!$value)
			delete_post_meta($post->ID, $key);
	}
}
add_action('save_post', 'wpt_save_people_meta', 1, 2); // save the custom fields

function people_shortcode($atts) {
	ob_start();
	include dirname(__FILE__).'/shortcode.php';
	$cont=ob_get_contents();
	ob_end_clean();
	return $cont;
}
add_shortcode('people','people_shortcode' );

add_action( 'init', 'people_rewrites_init' );
function people_rewrites_init(){
	$id=get_page_by_path('contact-us');
	if (isset($id->ID)) {
		add_rewrite_rule(
			'contact\-us/([^/]+)/?',
			'index.php?page_id='.$id->ID.'&person=$matches[1]',
			'top'
		);
		global $wp;
		$wp->add_query_var( 'person' );
	}
}

class shpersonWidget extends WP_Widget {
    function shpersonWidget() {
		$this->options = array(
			array(
				'name'=>'title',
				'label'=>'Title',
				'type'=>'text',
				'default'=>''
			),
			array(
				'name'=>'theperson',
				'label'=>'Person',
				'type'=>'person'
			)
		);
        parent::__construct(false,$name='Person');	
    }
    function widget($args,$instance) {
		extract($args);
		extract($instance);
		$title=apply_filters('widget_title',$instance['title']);
		echo $before_widget;  
		if ($title) {
			echo $before_title,$instance['title'],$after_title;
		}
		include dirname(__FILE__).'/view.php';
		echo $after_widget;
    }
    function update($new_instance,$old_instance) {				
		$instance=$old_instance;
		foreach ($this->options as $val) {
			switch ($val['type']) {
				case 'select':
				case 'person':
					$instance[$val['name']] = $new_instance[$val['name']];
					break;				
				case 'text':
					$instance[$val['name']] = strip_tags($new_instance[$val['name']]);
					break;
				case 'checkbox':
					$instance[$val['name']] = ($new_instance[$val['name']]=='on') ? true : false;
					break;
			}
		}
        return $instance;
    }
    function form($instance) {
		$new=(empty($instance));
		foreach ($this->options as $val) {
			if ($new && $val['default']) {
				$instance[$val['name']]=$val['default'];
			}
			$label='<label for="'.$this->get_field_id($val['name']).'">'.$val['label'].'</label>';
			if (!isset($instance[$val['name']]))
				$instance[$val['name']]=NULL;
			switch ($val['type']) {
				case 'select':
					echo '<p>',$label,'<br/>';
					selectbox($this->get_field_name($val['name']),$val['options'],$instance[$val['name']]);
					echo '</p>';
					break;
				case 'text':
					echo '<p>',$label,'<br />';
					echo '<input class="widefat" id="',$this->get_field_id($val['name']),'" name="',$this->get_field_name($val['name']),'" type="text" value="',esc_attr($instance[$val['name']]),'"/></p>';
					break;
				case 'checkbox':
					$checked=($instance[$val['name']]) ? ' checked="checked"' : '';
					echo '<input id="',$this->get_field_id($val['name']),'" name="',$this->get_field_name($val['name']),'" type="checkbox"',$checked,'/> ',$label.'<br/>';
					break;
				case 'person':
					$args = array(
						'posts_per_page'  => -1,
						'offset'          => 0,
						'numberposts'	  => 0,
						'orderby'         => 'post_title',
						'order'           => 'ASC',
						'post_type'       => 'people',
					);
					$posts=get_posts($args);
					$opts=array();
					foreach ($posts as $p) {
						$opts[$p->ID]=$p->post_title;
					}
					echo '<p>',$label,'<br/>';
					selectbox($this->get_field_name($val['name']),$opts,$instance[$val['name']]);
					echo '</p>';
					break;					
			}
		}
	}
}

add_action('widgets_init', create_function('', 'return register_widget("shpersonWidget");'));
