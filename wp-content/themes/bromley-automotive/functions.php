<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

add_image_size('testimonial-thumbnail',297,150,false);
add_image_size('service-banner',1200,523,false);
 
/**
 * Proper way to enqueue scripts and styles
 */
function theme_name_scripts() {
	wp_enqueue_style( 'google-fonts', 'http://fonts.googleapis.com/css?family=Maven+Pro:400,700|Roboto:400,700' );
	
    if (is_front_page()) {
        wp_enqueue_style( 'owl.carousel', get_template_directory_uri() . '/css/owl.carousel.css' );
        wp_enqueue_style( 'owl.theme', get_template_directory_uri() . '/css/owl.theme.css' );
        wp_enqueue_style( 'owl.transitions', get_template_directory_uri() . '/css/owl.transitions.css' );
    }
    wp_enqueue_style( 'style-name', get_stylesheet_uri() );
    
    //wp_enqueue_script( 'script-name', get_template_directory_uri() . '/js/example.js', array(), '1.0.0', true );
    //wp_enqueue_script( 'jquery1.9.1', get_template_directory_uri() . '/js/jquery-1.9.1.min.js', array(), '1.9.1', true );
    wp_enqueue_script( 'jquery', '//code.jquery.com/jquery-2.1.4.min.js', array(), '2.1.4' );
    //plugin('jquery'); // default wordpress jquery
	plugin('chosen');
	wp_enqueue_script( 'bootstrap-transition', get_template_directory_uri() . '/js/bootstrap-transition.js', array(), '', true );

    if (is_front_page()) {
        wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'), '', true );
        wp_enqueue_script( 'owl-my-carousel', get_template_directory_uri() . '/js/owl-my-carousel.js', array('owl-carousel'), '', true );
    }

    //wp_enqueue_script( 'select', get_template_directory_uri() . '/js/select.js', array(), '', true );
    wp_enqueue_script( 'jquery-pagination', get_template_directory_uri() . '/js/jPaginate.js', array(), '', true );
    wp_enqueue_script( 'my-scripts', get_template_directory_uri() . '/js/scripts.js', array(), '', true );
    
}

add_action( 'wp_enqueue_scripts', 'theme_name_scripts' );

add_action('init', 'dd_register_my_menus');

function dd_register_my_menus() {
	register_nav_menus(
			array(
				'header-main-menu' => __('Header Main Menu'),
				'header-secondary-menu' => __('Header Secondary Menu'),
				'footer-menu' => __('Footer Menu'),

                'header-main-menu-smaller' => 'Header Main Menu for Smaller Window',
                'header-secondary-menu-smaller' => 'Header Secondary Menu for Smaller Window',


                'mobile-menu'   => __('Mobile Menu')
			)
	);
}

function dd_generate_dropdown($items = array(),$checked_elm=false,$default = 'Please select...',$use_checkbox=false,$echo = true){
	static $unique_id;
	$unique_id++;
	$dropdown_id = 'dropdown_'.$unique_id;
	$return = '<div class="dropdown" id="'.esc_attr($dropdown_id).'">';
		//$return .= '<span class="row"><label>'.esc_html($default).'</label></span>';
		array_unshift($items,$default);
	foreach($items as $id=>$item){
		$checkbox_name = esc_attr('checkbox-'.$unique_id.'-'.$id);
		$return .= '<input type="'.($use_checkbox?"checkbox":"radio").'" '.checked($item==$checked_elm,true,false).' name="'.esc_attr($dropdown_id).'[]" id="'.esc_attr($checkbox_name).'"><label for="'.$checkbox_name.'">'.esc_html($item).'</label>';
	}
	$return .= '</div>';
	if($echo)
		echo $return;
	else
		return $return;
}

function my_widgets_init(){
	register_sidebar( array(
        'name' => 'Header Top Right',
        'id' => 'header-top-right',
        'before_widget' => '<div id="%1$s" class="header_top_right sidebar_widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="sidebar_title"><h3>',
        'after_title' => '</h3></div>',
    ) );

    register_sidebar( array(
        'name' => 'Social Links',
        'id' => 'social-links',
        'before_widget' => '<div id="%1$s" class="social_links sidebar_widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="sidebar_title"><h3>',
        'after_title' => '</h3></div>',
    ) );
	
	register_sidebar( array(
        'name' => 'Footer Services Menu',
        'id' => 'footer-col-1',
        'before_widget' => '<div id="%1$s" class="footer sidebar_widget f_col_1 %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="sidebar_title"><h3>',
        'after_title' => '</h3></div>',
    ) );

    register_sidebar( array(
        'name' => 'Footer Address',
        'id' => 'footer-col-4',
        'before_widget' => '<div id="%1$s" class="footer sidebar_widget f_col_4 %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="sidebar_title"><h3>',
        'after_title' => '</h3></div>',
    ) );
/*	DR - Changed to being hard coded in.
    register_sidebar( array(
        'name' => 'Footer Copyright',
        'id' => 'footer-copyright',
        'before_widget' => '<div id="%1$s" class="footer-copyright sidebar_widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="sidebar_title"><h3>',
        'after_title' => '</h3></div>',
    ) );
	*/
	
}

/*
This is rebuilt inside the front-page.php file
add_action( 'init', 'create_post_type' );
function create_post_type() {
    register_post_type( 'slides',
        array(
            'labels' => array(
            'name' => __( 'Slides' ),
            'singular_name' => __( 'Slide' )
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title', 'editor', 'thumbnail', 'wp_custom_post_template_meta_box'),
        )   
    );

    
}*/

add_action( 'widgets_init', 'my_widgets_init' );



/*
* Add Custom Meta Boxes to the different pages
*/

add_filter('rwmb_meta_boxes', 'dd_register_meta_boxes');

function dd_register_meta_boxes($meta_boxes) {
    $post_id = isset($_GET['post']) && $_GET['post'] ? $_GET['post'] : (isset($_POST['post_ID']) ? $_POST['post_ID'] : false);

    $post_data    = get_post($post_id, ARRAY_A);
    $slug       = $post_data['post_name'];

    /*
    * To show a metabox on whatever page is called the Home Page
    */
    if ($post_id && get_option('show_on_front') == 'page' && get_option('page_on_front') == $post_id) {
        $members = create_team_array();

        $meta_boxes[] = array(
            'title'    => 'Extra Content',
            'context'    => 'normal',
            'priority'    => '',
            'pages'    => array('page'),
            'fields'    => array(
                array(
                    'name'    => 'Services Explainer',
                    'id'    => 'dd_services_explainer',
                    'type'    => 'textarea',
                    'desc'   => 'This is a short paragraph explaining your services',
                ),
                array(
                    'name'    => 'Describe Our Team',
                    'id'    => 'dd_describe_our_team',
                    'type'    => 'wysiwyg',
                    'desc'    => 'Just a simple paragraph explaining the team members shown on your homepage'
                ),
                array(
                    'name'      => 'Our Team - Member 1',
                    'id'        => 'dd_our_team_member_1',
                    'type'      => 'select',
                    'options'   => $members,
                    'desc'    => 'Select team member to show on front page'
                ),
                array(
                    'name'      => 'Our Team - Member 2',
                    'id'        => 'dd_our_team_member_2',
                    'type'      => 'select',
                    'options'   => $members,
                    'desc'    => 'Select team member to show on front page'
                ),
                array(
                    'name'      => 'Our Team - Member 3',
                    'id'        => 'dd_our_team_member_3',
                    'type'      => 'select',
                    'options'   => $members,
                    'desc'    => 'Select team member to show on front page'
                )
            ),
        );
    }

    if ($post_data['post_type'] == 'page' && $post_data['post_name'] == 'about-us') {
        
        $meta_boxes[] = array(
            'title'    => 'Extra Content',
            'context'    => 'normal',
            'priority'    => '',
            'pages'    => array('page'),
            'fields'    => array(
                array(
                    'name'    => 'Describe Our Team',
                    'id'    => 'dd_describe_our_team',
                    'type'    => 'textarea',
                    'desc'    => 'Just a simple paragraph explaining the team members shown on your homepage'
                ),
                array(
                    'name'    => 'Gallery Image',
                    'id'    => 'dd_about_us_gallery_image',
                    'type'    => 'image_advanced',
                    'desc'    => 'Just an image to be placed about Gallery link',
                    'max_file_uploads'  => 1
                ),
               
            ),
        );
    }

    if ($post_data['post_type'] == 'page' && $post_data['post_name'] == 'contact-us') {
        
        $meta_boxes[] = array(
            'title'    => 'Extra Content',
            'context'    => 'normal',
            'priority'    => '',
            'pages'    => array('page'),
            'fields'    => array(
                array(
                    'name'    => 'Banner Text',
                    'id'    => 'dd_banner_text_contact_us',
                    'type'    => 'textarea',
                    'desc'    => 'Text to be displayed on banner area'
                ),
                /*
                            // Map requires at least one address field (with type = text)
                array(
                    'id'   => 'dd_address',
                    'name' => 'Address',
                    'type' => 'text',
                    'std'  => '1934 12 Line N, Oro-Medonte, ON L0L 1T0, Canada',
                ),
                array(
                    'id'            => 'dd_map',
                    'name'          => 'Location',
                    'type'          => 'map',
                    // Default location: 'latitude,longitude[,zoom]' (zoom is optional)
                    'std'           => '44.572673,-79.5217105,14.25',
                    // Name of text field where address is entered. Can be list of text fields, separated by commas (for ex. city, state)
                    'address_field' => 'dd_address',
                ),
                */
            ),
        );
    }

    /*if ($post_data['post_type'] == 'people') {
        $meta_boxes[] = array(
            'title'    => 'On Front Page',
            'context'    => 'normal',
            'priority'    => '',
            'pages'    => array('people'),
            'fields'    => array(
                array(
                    'name'    => 'Show On Front Page',
                    'id'    => 'dd_show_member_on_front_page',
                    'type'    => 'checkbox',
                    'desc'   => 'Check to show this team member on Front Page',
                )
            ),
        );
    }*/


    //echo "<pre>"; var_dump($post_data['post_type']);var_dump($meta_boxes); die();
    return $meta_boxes;
}

function my_wpcf7_form_elements($html) {
    $text = 'Please select a service';
    $html = str_replace('<option value="">---</option>', '<option value="">' . $text . '</option>', $html);
    return $html;
}
add_filter('wpcf7_form_elements', 'my_wpcf7_form_elements');

function create_team_array() {
    $team = get_people();
    $members = array();
    if ($team) {
        foreach ($team as $member) {
            $members[$member->ID] = $member->post_title;
        }
    }

    return $members;
}

function get_people() {
    $args = array(
        'post_type'             => 'people',
        'order'                 => 'ASC',
        'order_by'              => 'ID'
    );
    $team = get_posts($args);
    return $team;
}

function get_our_team_page_content() {
    $page = get_page_by_title( 'Our Team' );
    return apply_filters('the_content', $page->post_content);
}

add_action('do_meta_boxes', 'replace_featured_image_box');  
function replace_featured_image_box()  {  
    remove_meta_box( 'postimagediv', 'page', 'side' );  
    add_meta_box('postimagediv', __('Banner Image'), 'post_thumbnail_meta_box', 'page', 'side', 'low');  
}  

function show_team() {
    $team = get_people();

    echo '<div class="container margin-top-bottom-40">';
        $i = 0;
        foreach ( $team as $post ) : setup_postdata( $post );
            if ($i % 3 == 0) {
                echo '<div class="row">';
            }
            echo '<div class="span4 margin_bottom_40">';
            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail' );
            echo '<img class="align-left" src="' . $image[0] . '" />';
            echo '<div class="member_title">' . $post->post_title . '</div>';
            
            $positions = wp_get_post_terms( $post->ID, 'position' );
            if ($positions) {
                foreach ($positions as $position) {
                    echo '<div class="member_position">' . $position->name . '</div>';
                }
            }

            echo '</div>';
            $i++;
            if ($i %3 == 0) {
                echo "</div>";
            } 

        endforeach;
        if ($i % 3 != 0) echo "</div>";
        echo '<div class="container center_me"><a class="white_button1" href="#">Meet the entire team ></a></div>';
    echo '</div>';
    wp_reset_postdata();
}

class Et_Navigation extends Walker_Nav_Menu
{
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $display_depth = ($depth + 1); 
        if($display_depth == '1') {
            $class_names = 'nav-sublist-dropdown';
            $container = 'container';
        } else {
            $class_names = 'nav-sublist';
            $container = '';
        }

        $indent = str_repeat("\t", $depth);

         $output .= "\n$indent<ul class=".$class_names.">\n";
    }

    function end_lvl( &$output, $depth = 1, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }

    function start_el ( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $class_names = $value = '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = ' class="' . esc_attr( $class_names ) . '"';

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= $indent . '<li' . $id . $value . $class_names .'>';

        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . apply_filters('custom_menu_link', esc_attr( $item->url )) .'"' : '';

        $description = '';
        if(strpos($class_names,'image-item') !== false){$description = '<img src="'.do_shortcode($item->description).'" alt=" "/>';}

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= $description;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    } 


}

function show_pull_down_menu($menu_name) {
    $menu = wp_get_nav_menu_object( 'header-main-menu' );
    $menuitems = wp_get_nav_menu_items( $menu->term_id, array( 'order' => 'DESC' ) );
    $parent_id = NULL;
    echo '<ul>';
    foreach( $menuitems as $item ){
        if ($item->title == $menu_name) {
            $parent_id = $item->ID;
        }
        if (isset($parent_id) && $parent_id == $item->menu_item_parent) {
            echo '<li>';
            echo '<a href="'.$item->url.'">'.$item->title.'</a>';
            echo '</li>';
        }
        
    }
    echo '</ul>';
    //echo "<pre>"; var_dump($submenus); echo "</pre>";
}