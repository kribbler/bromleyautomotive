<?php
/*
Plugin Name: Services
Plugin URI: http://www.seoheap.com/
Description: 
Author: James Cantrell
Version: 1.0.0
Author URI: http://www.seoheap.com/
*/
class services extends seoheap {
	static function instance() {
		static $n=0;
		if (is_numeric($n)) {
			$n=new self();
		}
		return $n;
	}
	function __construct() {
		add_action('init',array($this,'init'));
		$this->metaboxes(array(
			'topinfo'=>array(
				'label'=>'Top Info',
				'post_type'=>'services',
				'form'=>array(
					'header'=>'text',
					'description'=>'textarea'
				),
				'position'=>'advanced'
			),
			'rightcolumn'=>array(
				'label'=>'Right Column',
				'post_type'=>'services',
				'form'=>array(
					'image'=>'text',
					'points'=>array(
						'type'=>'textarea',
						'help'=>'One per line'
					)
				),
				'position'=>'side'
			)
		));
	}
	function init() {
		register_post_type('services',array(
			'labels' => array(
				'name' => __( 'Services' ),
				'singular_name' => __( 'services' )
			),
			'public' => true,
			'hierarchical' =>true,
			'has_archive' =>false,
			'supports'=>array('title','editor','thumbnail', 'page-attributes'),
			'rewrite' => array( 'slug' => 'services', 'with_front'=> false ),
		));
		$this->archive('services',dirname(__FILE__).'/views');
	}


}

services::instance();