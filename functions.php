<?php

add_action( 'wp_enqueue_scripts', 'cw_enqueue_styles' );
function cw_enqueue_styles() {

    $parent_style = 'parent-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style )
    );

    wp_enqueue_script( 'control-script', get_stylesheet_directory_uri() . '/script.js' );
    wp_enqueue_style( 'animate-styles' , get_stylesheet_directory_uri() . '/animate.css' );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

// Register Custom Post Type
function cw_course_posttype() {

	$labels = array(
		'name'                => 'Courses',
		'singular_name'       => 'Course',
		'menu_name'           => 'Courses',
		'name_admin_bar'      => 'Courses',
		'parent_item_colon'   => 'Parent Item:',
		'all_items'           => 'All Courses',
		'add_new_item'        => 'Add New Course',
		'add_new'             => 'Add New',
		'new_item'            => 'New Course',
		'edit_item'           => 'Edit Course',
		'update_item'         => 'Update Course',
		'view_item'           => 'View Course',
		'search_items'        => 'Search Courses',
		'not_found'           => 'Not found',
		'not_found_in_trash'  => 'Not found in Trash',
	);
	$args = array(
		'label'               => 'cw_course',
		'description'         => 'Courses for coursework thing',
		'labels'              => $labels,
		'supports'            => array( 'title', 'thumbnail', ),
		'taxonomies'          => array( 'cw_course_type' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-book-alt',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'cw_course', $args );

	register_taxonomy(
	    'cw_course_type',
	    'cw_course',
	    array(
	        'labels' => array(
	            'name' => 'Course Categories',
	            'add_new_item' => 'Add New Category',
	            'new_item_name' => "New Category"
	        ),
	        'show_ui' => true,
	        'show_tagcloud' => false,
	        'hierarchical' => true
	    )
	);

}

// Hook into the 'init' action
add_action( 'init', 'cw_course_posttype', 0 );

function add_courses_metaboxes() {
	add_meta_box('course_inst', 'Instructions', 'course_inst', 'cw_course', 'normal', 'high');
	add_meta_box('course_name', 'Course Name', 'course_name', 'cw_course', 'normal', 'default');
	add_meta_box('course_desc', 'Course Description', 'course_desc', 'cw_course', 'normal', 'default');
	add_meta_box('course_url', 'Course URL', 'course_url', 'cw_course', 'normal', 'default');
	add_meta_box('course_prof', 'Course Instructor', 'course_prof', 'cw_course', 'normal', 'default');
	add_meta_box('course_email', 'Instructor Email', 'course_email', 'cw_course', 'normal', 'default');
}
add_action( 'add_meta_boxes', 'add_courses_metaboxes' );

function course_inst() {
	echo '<p>Add a course here to generate a new course box and populate it with the included data.</p>';
	echo '<p>The title of the course should be DEPT:###</p>';
	echo '<p>Course name, description, url, instructor, and instructor email set the respective values in the course box.</p>';
}

function course_name() {
	global $post;
	echo '<input type="hidden" name="coursemeta_noncename" id="coursemeta_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	$name = get_post_meta($post->ID, '_name', true);
	echo '<input type="text" name="_name" value="' . $name . '" />';
}

function course_desc() {
	global $post;
	echo '<input type="hidden" name="coursemeta_noncename" id="coursemeta_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	$desc = get_post_meta($post->ID, '_desc', true);
	echo '<textarea cols="50" rows="5" name="_desc" value="' . $desc . '">' . $desc . '</textarea>';
}

function course_url() {
	global $post;
	echo '<input type="hidden" name="coursemeta_noncename" id="coursemeta_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	$url = get_post_meta($post->ID, '_url', true);
	echo '<input type="text" name="_url" value="' . $url . '" />';
	echo '<p>Note: The URL must contain the http:// or it will not work correctly.</p>';
}

function course_prof() {
	global $post;
	echo '<input type="hidden" name="coursemeta_noncename" id="coursemeta_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	$prof = get_post_meta($post->ID, '_prof', true);
	echo '<input type="text" name="_prof" value="' . $prof . '" />';
}

function course_email() {
	global $post;
	echo '<input type="hidden" name="coursemeta_noncename" id="coursemeta_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '"/>';
	$email = get_post_meta($post->ID, '_email', true);
	echo '<input type="text" name="_email" value="' . $email . '" />';
}

function cw_save_course_meta($post_id, $post) {
	if ( !wp_verify_nonce( $_POST['coursemeta_noncename'], plugin_basename(__FILE__) )) {
		return $post->ID;
	}
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;

	$course_meta['_name'] = $_POST['_name'];
	$course_meta['_desc'] = $_POST['_desc'];
	$course_meta['_url'] = $_POST['_url'];
	$course_meta['_prof'] = $_POST['_prof'];
	$course_meta['_email'] = $_POST['_email'];

	foreach ($course_meta as $key => $value) {
		if( $post->post_type == 'revision' ) return;
		$value = implode(',', (array)$value);
		if(get_post_meta($post->ID, $key, FALSE)) {
			update_post_meta($post->ID, $key, $value);
		} else {
			add_post_meta($post->ID, $key, $value);
		}
		if(!value) delete_post_meta($post->ID, $key);
	}
}
add_action( 'save_post', 'cw_save_course_meta', 1, 2 );


function cw_page_meta() {
	global $post;
	if ('page-coursework.php' == get_post_meta( $post->ID, '_wp_page_template', true) ) {
		remove_post_type_support('page', 'editor');
		add_meta_box('cw_page_inst', 'Instructions', 'cw_page_inst', 'page', 'normal', 'high');
		add_meta_box('cw_info_first', 'First Info Box', 'cw_info_first', 'page', 'normal', 'high');
		add_meta_box('cw_info_second', 'Second Info Box', 'cw_info_second', 'page', 'normal', 'high');
	}
}
add_action( 'add_meta_boxes', 'cw_page_meta' );

function cw_page_inst() {
	echo '<p>Use the First and Second Info Box fields here to set the text of the info boxes.';
	echo '<p>The featured image will appear as the splash image at the top.</p>';
}

function cw_info_first() {
	global $post;
	echo '<input type="hidden" name="cwpagemeta_noncename" id="cwpagemeta_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	$info_first = get_post_meta($post->ID, 'info_first', true);
	echo '<textarea cols="100" rows="10" name="info_first" value="' . $info_first . '">' . wpautop($info_first) . '</textarea>';
	echo '<p>First info box content. Line breaks will be converted into &lt;p&gt;&lt;/p&gt; tags.</p>';
}

function cw_info_second() {
	global $post;
	echo '<input type="hidden" name="cwpagemeta_noncename" id="cwpagemeta_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	$info_second = get_post_meta($post->ID, 'info_second', true);
	echo '<textarea cols="100" rows="10" name="info_second" value="' . $info_second . '">' . wpautop($info_second) . '</textarea>';
	echo '<p>Second info box content.Line breaks will be converted into &lt;p&gt;&lt;/p&gt; tags.</p>';
}

function cw_save_page_meta($post_id, $post) {
	if ( !wp_verify_nonce( $_POST['cwpagemeta_noncename'], plugin_basename(__FILE__) )) {
		return $post->ID;
	}
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;

	$cwpage_meta['info_first'] = $_POST['info_first'];
	$cwpage_meta['info_second'] = $_POST['info_second'];

	foreach ($cwpage_meta as $key => $value) {
		if( $post->post_type == 'revision' ) return;
		$value = implode(',', (array)$value);
		if(get_post_meta($post->ID, $key, FALSE)) {
			update_post_meta($post->ID, $key, $value);
		} else {
			add_post_meta($post->ID, $key, $value);
		}
		if(!value) delete_post_meta($post->ID, $key);
	}
}
add_action( 'save_post', 'cw_save_page_meta', 1, 2 );

function cw_customizer( $wp_customize ) {
	$wp_customize->add_section(
		'cw_options',
		array(
			'title' => 'Coursework Settings',
			'description' => 'Customize the coursework/lab infographics',
			'priority' => 160,
			)
		);

	$wp_customize->add_setting(
		'cw_bg_color',
		array(
			'default' => '#f8b800',
			'sanitize_callback' => 'sanitize_hex_color',
			)
		);

	$wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize, 'cw_bg_color', array(
		'label' => 'Background Color',
		'section' => 'cw_options',
		'description' => 'BG color for entire infographic element<br>Default color is VCU Gold #F8B800',
		)));

	$wp_customize->add_setting(
		'infobox_bg_color',
		array(
			'default' => '#f8b800',
			'sanitize_callback' => 'sanitize_hex_color',
			)
		);

	$wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize, 'infobox_bg_color', array(
		'label' => 'Infobox Background Color',
		'section' => 'cw_options',
		'description' => 'BG color for text info boxes<br>Default color is VCU Gold #F8B800',
		)));

	$wp_customize->add_setting(
		'cw_bg_img',
		array(
			'default' => 'http://catacombs.garethbk.com/wp-content/uploads/2015/08/bg-tile-line.png',
			)
		);

	$wp_customize->add_control(
		'cw_bg_img',
		array(
			'label' => 'Background Image URL',
			'section' => 'cw_options',
			'type' => 'text',
			'description' => 'Set the URL for the background image; recommended to use a transparent tiling pattern.  Useful resource: http://www.transparenttextures.com/',
			)
		);

	$wp_customize->add_setting(
		'cw_copy_size',
		array(
			'default' => '20px',
			)
		);

	$wp_customize->add_control(
		'cw_copy_size',
		array(
			'label' => 'Body Copy Font Size',
			'section' => 'cw_options',
			'type' => 'text',
			'description' => 'Set the text size for copy in the info boxes and course boxes.  Can be in px, em, rem, etc. - include the unit, e.g. 24px, 1.5em, etc.',
			)
		);
}

add_action( 'customize_register', 'cw_customizer' );

function cw_customizer_css() {
	?>
	<style type="text/css">
		.cw-container { background-color: <?php echo get_theme_mod( 'cw_bg_color' ); ?>; background-image: <?php echo 'url(' . get_theme_mod( 'cw_bg_img' ) . ')'; ?>; }
		.info-box { background-color: <?php echo get_theme_mod( 'infobox_bg_color' ); ?>; }
		.info-box p { font-size: <?php echo get_theme_mod( 'cw_copy_size' ); ?>; }
		.course-area p { font-size: <?php echo get_theme_mod( 'cw_copy_size' ); ?>; }

	</style>
	<?php
}

add_action( 'wp_footer', 'cw_customizer_css' );

















// Register Custom Post Type
function cw_research_posttype() {

	$labels = array(
		'name'                => 'Research',
		'singular_name'       => 'Research',
		'menu_name'           => 'Research',
		'name_admin_bar'      => 'Research',
		'parent_item_colon'   => 'Parent Item:',
		'all_items'           => 'All Research',
		'add_new_item'        => 'Add New Research',
		'add_new'             => 'Add New',
		'new_item'            => 'New Research',
		'edit_item'           => 'Edit Research',
		'update_item'         => 'Update Research',
		'view_item'           => 'View Research',
		'search_items'        => 'Search Research',
		'not_found'           => 'Not found',
		'not_found_in_trash'  => 'Not found in Trash',
	);
	$args = array(
		'label'               => 'cw_research',
		'description'         => 'Research opportunities post type',
		'labels'              => $labels,
		'supports'            => array( 'title', 'thumbnail', ),
		'taxonomies'          => array( 'cw_research_type' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-lightbulb',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'cw_research', $args );

	register_taxonomy(
	    'cw_research_type',
	    'cw_research',
	    array(
	        'labels' => array(
	            'name' => 'Research Categories',
	            'add_new_item' => 'Add New Category',
	            'new_item_name' => "New Category"
	        ),
	        'show_ui' => true,
	        'show_tagcloud' => false,
	        'hierarchical' => true
	    )
	);

}

// Hook into the 'init' action
add_action( 'init', 'cw_research_posttype', 0 );

function add_research_metaboxes() {
	add_meta_box('research_inst', 'Instructions', 'research_inst', 'cw_research', 'normal', 'high');
	add_meta_box('research_dept', 'Department', 'research_dept', 'cw_research', 'normal', 'default');
	add_meta_box('research_area', 'Research Area', 'research_area', 'cw_research', 'normal', 'default');
	add_meta_box('research_url', 'Research URL', 'research_url', 'cw_research', 'normal', 'default');
	add_meta_box('research_prof', 'Instructor Name', 'research_prof', 'cw_research', 'normal', 'default');
	add_meta_box('research_email', 'Instructor Email', 'research_email', 'cw_research', 'normal', 'default');
}
add_action( 'add_meta_boxes', 'add_research_metaboxes' );

function research_inst() {
	echo '<p>Add a research area here to generate a new box and populate it with the included data.</p>';
	echo '<p>The title of the post can be anything; it is not used directly in the content.</p>';
	echo '<p>Departent, area, url, instructor name, and instructor email set the respective values in the course box.</p>';
}

function research_dept() {
	global $post;
	echo '<input type="hidden" name="researchmeta_noncename" id="researchmeta_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	$dept = get_post_meta($post->ID, '_dept', true);
	echo '<input type="text" name="_dept" value="' . $dept . '" />';
}

function research_area() {
	global $post;
	echo '<input type="hidden" name="researchmeta_noncename" id="researchmeta_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	$area = get_post_meta($post->ID, '_area', true);
	echo '<textarea cols="50" rows="5" name="_area" value="' . $area . '">' . $area . '</textarea>';
}

function research_url() {
	global $post;
	echo '<input type="hidden" name="researchmeta_noncename" id="researchmeta_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	$url = get_post_meta($post->ID, '_url', true);
	echo '<input type="text" name="_url" value="' . $url . '" />';
	echo '<p>Note: The URL must contain the http:// or it will not work correctly.</p>';
}

function research_prof() {
	global $post;
	echo '<input type="hidden" name="researchmeta_noncename" id="researchmeta_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	$prof = get_post_meta($post->ID, '_prof', true);
	echo '<input type="text" name="_prof" value="' . $prof . '" />';
}

function research_email() {
	global $post;
	echo '<input type="hidden" name="researchmeta_noncename" id="researchmeta_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '"/>';
	$email = get_post_meta($post->ID, '_email', true);
	echo '<input type="text" name="_email" value="' . $email . '" />';
}

function cw_save_research_meta($post_id, $post) {
	if ( !wp_verify_nonce( $_POST['researchmeta_noncename'], plugin_basename(__FILE__) )) {
		return $post->ID;
	}
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;

	$research_meta['_dept'] = $_POST['_dept'];
	$research_meta['_area'] = $_POST['_area'];
	$research_meta['_url'] = $_POST['_url'];
	$research_meta['_prof'] = $_POST['_prof'];
	$research_meta['_email'] = $_POST['_email'];

	foreach ($research_meta as $key => $value) {
		if( $post->post_type == 'revision' ) return;
		$value = implode(',', (array)$value);
		if(get_post_meta($post->ID, $key, FALSE)) {
			update_post_meta($post->ID, $key, $value);
		} else {
			add_post_meta($post->ID, $key, $value);
		}
		if(!value) delete_post_meta($post->ID, $key);
	}
}
add_action( 'save_post', 'cw_save_research_meta', 1, 2 );

function research_page_meta() {
	global $post;
	if ( 'page-research.php' == get_post_meta( $post->ID, '_wp_page_template', true ) ){
		remove_post_type_support('page', 'editor');
		add_meta_box('research_page_inst', 'Instructions', 'research_page_inst', 'page', 'normal', 'high');
		add_meta_box('research_info_first', 'First Info Box', 'research_info_first', 'page', 'normal', 'high');
		add_meta_box('research_info_second', 'Second Info Box', 'research_info_second', 'page', 'normal', 'high');
	}
}


add_action( 'add_meta_boxes', 'research_page_meta' );



function research_page_inst() {
	echo '<p>Use the First and Second Info Box fields here to set the text of the info boxes.';
	echo '<p>The featured image will appear as the splash image at the top.</p>';
}

function research_info_first() {
	global $post;
	echo '<input type="hidden" name="researchpagemeta_noncename" id="researchpagemeta_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	$info_first = get_post_meta($post->ID, 'info_first', true);
	echo '<textarea cols="100" rows="10" name="info_first" value="' . $info_first . '">' . wpautop($info_first) . '</textarea>';
	echo '<p>First info box content. Line breaks will be converted into &lt;p&gt;&lt;/p&gt; tags.</p>';
}

function research_info_second() {
	global $post;
	echo '<input type="hidden" name="researchpagemeta_noncename" id="researchpagemeta_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	$info_second = get_post_meta($post->ID, 'info_second', true);
	echo '<textarea cols="100" rows="10" name="info_second" value="' . $info_second . '">' . wpautop($info_second) . '</textarea>';
	echo '<p>Second info box content.Line breaks will be converted into &lt;p&gt;&lt;/p&gt; tags.</p>';
}

function research_save_page_meta($post_id, $post) {
	if ( !wp_verify_nonce( $_POST['researchpagemeta_noncename'], plugin_basename(__FILE__) )) {
		return $post->ID;
	}
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;

	$researchpage_meta['info_first'] = $_POST['info_first'];
	$researchpage_meta['info_second'] = $_POST['info_second'];

	foreach ($researchpage_meta as $key => $value) {
		if( $post->post_type == 'revision' ) return;
		$value = implode(',', (array)$value);
		if(get_post_meta($post->ID, $key, FALSE)) {
			update_post_meta($post->ID, $key, $value);
		} else {
			add_post_meta($post->ID, $key, $value);
		}
		if(!value) delete_post_meta($post->ID, $key);
	}
}
add_action( 'save_post', 'research_save_page_meta', 1, 2 );