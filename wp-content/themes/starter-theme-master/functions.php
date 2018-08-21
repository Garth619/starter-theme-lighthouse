<?php 



/* jQuery from Google
-------------------------------------------------------------- */


/*
if (!is_admin()) add_action("wp_enqueue_scripts", "my_jquery_enqueue", 11);
function my_jquery_enqueue() {
   wp_deregister_script('jquery');
   wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js", false, null,true);
   wp_enqueue_script('jquery');
}
*/


function scripts() {
  wp_deregister_script('jquery');
  wp_deregister_script( 'wp-embed' );
  wp_deregister_script( 'wp_customize_support_script' );
}
add_action( 'wp_enqueue_scripts', 'scripts', 1 );




/* Enqueued Scripts
-------------------------------------------------------------- */



 function load_my_styles_scripts() {
     // Load my stylesheet
     // wp_enqueue_style( 'styles', get_template_directory_uri() . '/style.css', '', 1, 'all' ); 

     // Load my javascripts
     // wp_enqueue_script( 'jquery-addon', get_template_directory_uri() . '/js/custom-min.js', array('jquery'), '', true );
 }
 
 add_action( 'wp_enqueue_scripts', 'load_my_styles_scripts', 20 );
 
 
 // Critical Styles in the header
 
/*
add_action( 'wp_head', 'internal_css_print' );
function internal_css_print() {
   echo '<style>';
   
   include_once get_template_directory() . '/style.css';
  
   echo '</style>';
}
*/



/* Force Gravity Forms to init scripts in the footer and ensure that the DOM is loaded before scripts are executed
-------------------------------------------------------------- */


add_filter( 'gform_init_scripts_footer', '__return_true' );
add_filter( 'gform_cdata_open', 'wrap_gform_cdata_open', 1 );
function wrap_gform_cdata_open( $content = '' ) {
if ( ( defined('DOING_AJAX') && DOING_AJAX ) || isset( $_POST['gform_ajax'] ) ) {
return $content;
}
$content = 'document.addEventListener( "DOMContentLoaded", function() { ';
return $content;
}
add_filter( 'gform_cdata_close', 'wrap_gform_cdata_close', 99 );
function wrap_gform_cdata_close( $content = '' ) {
if ( ( defined('DOING_AJAX') && DOING_AJAX ) || isset( $_POST['gform_ajax'] ) ) {
return $content;
}
$content = ' }, false );';
return $content;
}



/* No Tab Conflicts Gravity Forms
 --------------------------------------------------------------------------------------- */

add_filter( 'gform_tabindex', 'gform_tabindexer', 10, 2 );
function gform_tabindexer( $tab_index, $form = false ) {
  $starting_index = 1000; // if you need a higher tabindex, update this number
  if( $form )
    add_filter( 'gform_tabindex_' . $form['id'], 'gform_tabindexer' );
  return GFCommon::$tab_index >= $starting_index ? GFCommon::$tab_index : $starting_index;
}





/* Remove Unnecessary Scripts
-------------------------------------------------------------- */
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');

/* Register Nav-Menus
-------------------------------------------------------------- */

register_nav_menus(array(
    'main_menu' => 'Main Menu',
    
));

/* Widgets
-------------------------------------------------------------- */

if (function_exists('register_sidebars')) {

    register_sidebar(array(
        'name' => 'Recent Posts',
        'id' => 'sidebar',
        'description' => '',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>'
    ));
    
    register_sidebar(array(
        'name' => 'Category',
        'id' => 'category_sidebar',
        'description' => '',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>'
    ));
    
    register_sidebar(array(
        'name' => 'Archive',
        'id' => 'archive_sidebar',
        'description' => '',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>'
    ));

 }

/* Add Theme Support Page Thumbnails
-------------------------------------------------------------- */

add_theme_support('post-thumbnails');

/* Modify the_excerpt() " read more "
-------------------------------------------------------------- */

function new_excerpt_more($more)
{
    global $post;
    return '... <a href="' . get_permalink($post->ID) . '">' . 'read more' . '</a>';
}

add_filter('excerpt_more', 'new_excerpt_more');

/* Add Page Slug to Body Class
-------------------------------------------------------------- */
function add_slug_body_class($classes)
{
    global $post;
    if (isset($post)) {
        $classes[] = $post->post_type . '-' . $post->post_name;
    }
    return $classes;
}

add_filter('body_class', 'add_slug_body_class');



/* ACF: CREATE OPTIONS PAGE
-------------------------------------------------------------- */

if( function_exists('acf_add_options_page') ) {

  acf_add_options_page(array(
    'page_title' 	=> 'Theme Options',
    'menu_title'	=> 'Theme Options',
    'menu_slug' 	=> 'theme-options',
    'capability'	=> 'edit_posts',
    'redirect'		=> false
  ));

}



/* ALLOW SVGs IN MEDIA UPLOAD
-------------------------------------------------------------- */
function cc_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}

add_filter('upload_mimes', 'cc_mime_types');



/* Combine all js, minify and inject in the footer
 --------------------------------------------------------------------------------------- */

add_action( 'wp_footer', 'merge_include_js', 9);
function merge_include_js() {
  $jsDirLastMod = filemtime(get_stylesheet_directory().'/js');
  $mainJSLastMod = filemtime(get_stylesheet_directory().'/main.js');
  $_jsLastMod = filemtime(get_stylesheet_directory().'/speed/_js.js');

  if ($jsDirLastMod > $_jsLastMod || $mainJSLastMod > $_jsLastMod) {
    include(get_stylesheet_directory() . '/speed/JSMin.php');

    $mergedJs = file_get_contents(ABSPATH . WPINC . '/js/jquery/jquery.js');

    $gravityFiles = array(
      WP_PLUGIN_DIR."/gravityforms/js/jquery.json.min.js",
      WP_PLUGIN_DIR."/gravityforms/js/gravityforms.min.js",
      WP_PLUGIN_DIR."/gravityforms/js/jquery.maskedinput.min.js",
      WP_PLUGIN_DIR."/gravityforms/js/placeholders.jquery.min.js"
    );

    foreach ($gravityFiles as $gravityFormJsFile) {
      $mergedJs .= file_get_contents($gravityFormJsFile);
    }

    $files = glob(get_stylesheet_directory() . '/js/*.js');

    foreach($files as $file) {
      $mergedJs .= file_get_contents($file);
    }

    $mergedJs .= file_get_contents(get_stylesheet_directory() . '/main.js');

    $mergedJs = JSMin::minify($mergedJs);

    file_put_contents(get_stylesheet_directory() . '/speed/_js.js', $mergedJs);

    echo '<script>';
    include_once get_stylesheet_directory().'/speed/_js.js';
    echo  '</script>';
  } else {
    echo '<script>';
    include_once get_stylesheet_directory().'/speed/_js.js';
    echo  '</script>';
  }
}



/* Minify Html
 --------------------------------------------------------------------------------------- */

/*
require get_stylesheet_directory() . '/speed/HTMLmin.php';

function wp_html_compressor() {
  function wp_html_compressor_main($data)
  {
    return html_compress($data);
  }

  ob_start('wp_html_compressor_main');
}
add_action('get_header', 'wp_html_compressor');
*/






