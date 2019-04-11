<?php
/*
Author: Eddie Machado
URL: http://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, etc.
*/

// LOAD BONES CORE (if you remove this, the theme will break)
require_once( 'library/bones.php' );

// CUSTOMIZE THE WORDPRESS ADMIN (off by default)
// require_once( 'library/admin.php' );

/*********************
LAUNCH BONES
Let's get everything up and running.
*********************/

function bones_ahoy() {

  //Allow editor style.
  add_editor_style( get_stylesheet_directory_uri() . '/library/css/editor-style.css' );

  // let's get language support going, if you need it
  load_theme_textdomain( 'bonestheme', get_template_directory() . '/library/translation' );

  // USE THIS TEMPLATE TO CREATE CUSTOM POST TYPES EASILY
  require_once( 'library/custom-post-type.php' );

  // launching operation cleanup
  add_action( 'init', 'bones_head_cleanup' );
  // A better title
  add_filter( 'wp_title', 'rw_title', 10, 3 );
  // remove WP version from RSS
  add_filter( 'the_generator', 'bones_rss_version' );
  // remove pesky injected css for recent comments widget
  add_filter( 'wp_head', 'bones_remove_wp_widget_recent_comments_style', 1 );
  // clean up comment styles in the head
  add_action( 'wp_head', 'bones_remove_recent_comments_style', 1 );
  // clean up gallery output in wp
  add_filter( 'gallery_style', 'bones_gallery_style' );

  // enqueue base scripts and styles
  add_action( 'wp_enqueue_scripts', 'bones_scripts_and_styles', 999 );
  // ie conditional wrapper

  // launching this stuff after theme setup
  bones_theme_support();

  // adding sidebars to Wordpress (these are created in functions.php)
  add_action( 'widgets_init', 'bones_register_sidebars' );

  // cleaning up random code around images
  add_filter( 'the_content', 'bones_filter_ptags_on_images' );
  // cleaning up excerpt
  add_filter( 'excerpt_more', 'bones_excerpt_more' );

} /* end bones ahoy */

// let's get this party started
add_action( 'after_setup_theme', 'bones_ahoy' );


/************* OEMBED SIZE OPTIONS *************/

if ( ! isset( $content_width ) ) {
	$content_width = 680;
}

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'bones-thumb-600', 600, 150, true );
add_image_size( 'bones-thumb-300', 300, 100, true );

/*
to add more sizes, simply copy a line from above
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 100 sized image,
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 150 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

add_filter( 'image_size_names_choose', 'bones_custom_image_sizes' );

function bones_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'bones-thumb-600' => __('600px by 150px'),
        'bones-thumb-300' => __('300px by 100px'),
    ) );
}

/*
The function above adds the ability to use the dropdown menu to select
the new images sizes you have just created from within the media manager
when you add media to your content blocks. If you add more image sizes,
duplicate one of the lines in the array and name it according to your
new image size.
*/

/************* THEME CUSTOMIZE *********************/

/* 
  A good tutorial for creating your own Sections, Controls and Settings:
  http://code.tutsplus.com/series/a-guide-to-the-wordpress-theme-customizer--wp-33722
  
  Good articles on modifying the default options:
  http://natko.com/changing-default-wordpress-theme-customization-api-sections/
  http://code.tutsplus.com/tutorials/digging-into-the-theme-customizer-components--wp-27162
  
  To do:
  - Create a js for the postmessage transport method
  - Create some sanitize functions to sanitize inputs
  - Create some boilerplate Sections, Controls and Settings
*/

function bones_theme_customizer($wp_customize) {
  // $wp_customize calls go here.
  //
  // Uncomment the below lines to remove the default customize sections 

  // $wp_customize->remove_section('title_tagline');
  // $wp_customize->remove_section('colors');
  // $wp_customize->remove_section('background_image');
  // $wp_customize->remove_section('static_front_page');
  // $wp_customize->remove_section('nav');

  // Uncomment the below lines to remove the default controls
  // $wp_customize->remove_control('blogdescription');
  
  // Uncomment the following to change the default section titles
  // $wp_customize->get_section('colors')->title = __( 'Theme Colors' );
  // $wp_customize->get_section('background_image')->title = __( 'Images' );
  $wp_customize -> add_section(
    'cobe_front_page',
    array(
      'title' => 'Front Page Options',
      'priority' => 201
    )
  );

  for ($count =1; $count <= 6; $count++) {
    $wp_customize -> add_setting( 'nav-box-page-' . $count, array(
        'default' => '',
        'sanitize_callback' => 'absint'
      )
    );

    $wp_customize -> add_control( 'nav-box-page-' . $count, array(
        'label' => __( '#' . $count . ' Nav Box', 'textdomain' ),
        'section' => 'cobe_front_page',
        'type' => 'dropdown-pages'
      )
    );
  }
}

add_action( 'customize_register', 'bones_theme_customizer' );

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar1',
		'name' => __( 'Sidebar 1', 'bonestheme' ),
		'description' => __( 'The first (primary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	/*
	to add more sidebars or widgetized areas, just copy
	and edit the above sidebar code. In order to call
	your new sidebar just use the following code:

	Just change the name to whatever your new
	sidebar's id is, for example:

	register_sidebar(array(
		'id' => 'sidebar2',
		'name' => __( 'Sidebar 2', 'bonestheme' ),
		'description' => __( 'The second (secondary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	To call the sidebar in your template, you can just copy
	the sidebar.php file and rename it to your sidebar's name.
	So using the above example, it would be:
	sidebar-sidebar2.php

	*/
} // don't remove this bracket!


/************* COMMENT LAYOUT *********************/

// Comment Layout
function bones_comments( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; ?>
  <div id="comment-<?php comment_ID(); ?>" <?php comment_class('cf'); ?>>
    <article  class="cf">
      <header class="comment-author vcard">
        <?php
        /*
          this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
          echo get_avatar($comment,$size='32',$default='<path_to_url>' );
        */
        ?>
        <?php // custom gravatar call ?>
        <?php
          // create variable
          $bgauthemail = get_comment_author_email();
        ?>
        <img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>?s=40" class="load-gravatar avatar avatar-48 photo" height="40" width="40" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
        <?php // end custom gravatar call ?>
        <?php printf(__( '<cite class="fn">%1$s</cite> %2$s', 'bonestheme' ), get_comment_author_link(), edit_comment_link(__( '(Edit)', 'bonestheme' ),'  ','') ) ?>
        <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'bonestheme' )); ?> </a></time>

      </header>
      <?php if ($comment->comment_approved == '0') : ?>
        <div class="alert alert-info">
          <p><?php _e( 'Your comment is awaiting moderation.', 'bonestheme' ) ?></p>
        </div>
      <?php endif; ?>
      <section class="comment_content cf">
        <?php comment_text() ?>
      </section>
      <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
    </article>
  <?php // </li> is added by WordPress automatically ?>
<?php
} // don't remove this bracket!


/*
This is a modification of a function found in the
twentythirteen theme where we can declare some
external fonts. If you're using Google Fonts, you
can replace these fonts, change it in your scss files
and be up and running in seconds.
*/
function bones_fonts() {
  wp_enqueue_style('googleFonts', 'https://fonts.googleapis.com/css?family=Ubuntu+Mono');
  wp_enqueue_style('openSans', 'https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300italic,700');
  wp_enqueue_style('g-cal', get_stylesheet_directory_uri() . '/library/js/jquery-gcal-flow-3.0.1/jquery.gcal_flow.css');
  wp_enqueue_style('animate', get_stylesheet_directory_uri() . '/library/css/animate.css');
  wp_enqueue_style('slideshow', get_stylesheet_directory_uri() . '/library/js/slideshow/simple-slideshow-styles.css');
  wp_enqueue_style('fancybox', get_stylesheet_directory_uri() . '/library/js/fancybox/jquery.fancybox.css');
}

add_action('wp_enqueue_scripts', 'bones_fonts');

/*
Load extra scripts
*/
function extra_scripts() {
  wp_enqueue_script( 'jQuery', get_stylesheet_directory_uri() . '/library/js/jquery-1.11.3.min.js', '1.11.3' );
  wp_enqueue_script( 'vcu-header', 'http://www.pubapps.vcu.edu/identity/widgets/branding/black/responsive/js/vcubranding-black-1.0.js', '1.0');
  //wp_enqueue_script( 'master', get_stylesheet_directory_uri() . '/library/js/master-scripts.js', '1.0' );
  wp_enqueue_script( 'g-cal', get_stylesheet_directory_uri() . '/library/js/jquery-gcal-flow-3.0.1/jquery.gcal_flow.min.js', '3.01');
  wp_enqueue_script( 'instafeed', get_stylesheet_directory_uri() . '/library/js/instafeed.min.js', '1.0' );
  wp_enqueue_script( 'slideshow', get_stylesheet_directory_uri() . '/library/js/slideshow/better-simple-slideshow.js', '1.0' );
  wp_enqueue_script( 'fancybox', get_stylesheet_directory_uri() . '/library/js/fancybox/jquery.fancybox.js', '1.0' );
}

add_action('wp_enqueue_scripts', 'extra_scripts');

function page_scripts() {
  if (is_page ('home' )) {
    wp_enqueue_script( 'front-page', get_stylesheet_directory_uri(). '/library/js/front-page.js', '1.42' );
  }
  elseif (is_page_template( 'template-resources.php' )) {
    wp_enqueue_script( 'resources', get_stylesheet_directory_uri() . '/library/js/resources.js', '1.42' );
  }
  elseif (is_page_template( 'template-research.php' )) {
    wp_enqueue_script( 'research', get_stylesheet_directory_uri() . '/library/js/derp-cloud.js', '1.42' );
  }
  elseif (is_page( 'podcast' )) {
    wp_enqueue_script( 'podcast', get_stylesheet_directory_uri() . '/library/js/podcast.js', '1.42' );
  }
  elseif (is_page_template( 'template-coursework.php' )) {
    wp_enqueue_script( 'coursework', get_stylesheet_directory_uri() . '/library/js/coursework.js', '1.42' );
  }
}

add_action('wp_enqueue_scripts', 'page_scripts');

/**
 * Enables the Excerpt meta box in Page edit screen.
 */
function wpcodex_add_excerpt_support_for_pages() {
  add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'wpcodex_add_excerpt_support_for_pages' );

// Add URL for banner meta box to front page
function front_page_meta() {
  global $post;
  if ('page-front.php' == get_post_meta( $post->ID, '_wp_page_template', true) ) {
    add_meta_box('banner_url', 'Banner link URL', 'banner_url', 'page', 'normal', 'high');
  }
}
add_action( 'add_meta_boxes', 'front_page_meta' );

function banner_url() {
  global $post;
  echo '<input type="hidden" name="bannermeta_noncename" id="bannermeta_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
  $url = get_post_meta($post->ID, '_url', true);
  echo '<input type="text" name="_url" value="' . $url . '" />';
  echo '<p>Note: The URL must contain the http:// or it will not work correctly.</p>';
}

function banner_save_page_meta($post_id, $post) {
  if ( !wp_verify_nonce( $_POST['bannermeta_noncename'], plugin_basename(__FILE__) )) {
    return $post->ID;
  }
  if ( !current_user_can( 'edit_post', $post->ID ))
    return $post->ID;

  $banner_meta['_url'] = $_POST['_url'];

  foreach ($banner_meta as $key => $value) {
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
add_action( 'save_post', 'banner_save_page_meta', 1, 2 );

//add vcu header
if(!function_exists('load_vcu_brand_bar')){
    function load_vcu_brand_bar() {
        global $post;
        $version= '1.0'; 
        $in_footer = false;
        wp_enqueue_script('bsExpandJs', '//branding.vcu.edu/bar/academic/latest.js', null, $version, $in_footer);
        wp_localize_script('my-script', 'my_script_vars', array(
                'postID' => $post->ID
            )
        );
    }
}
add_action('wp_enqueue_scripts', 'load_vcu_brand_bar');


//FOOTER WIDGET
/**
 * Register our sidebars and widgetized areas.
 *
 */
function cobe_footer_widgets_init() {

  register_sidebar( array(
    'name'          => 'Left Footer',
    'id'            => 'left_footer_1',
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '',
    'after_title'   => '',
  ) );

}
add_action( 'widgets_init', 'cobe_footer_widgets_init' );



/* DON'T DELETE THIS CLOSING TAG */ ?>
