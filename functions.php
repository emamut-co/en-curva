<?php
add_theme_support( 'post-thumbnails' );
add_theme_support( 'post-formats', array( 'video' ) );

function emamut_setup()
{
  load_theme_textdomain( 'emamut' );
}
add_action( 'after_setup_theme', 'emamut_setup' );

function add_theme_scripts()
{
  wp_enqueue_style('app.css', get_template_directory_uri() . '/dist/css/app.css');
  wp_enqueue_script('app.js', get_template_directory_uri() . '/dist/js/app.js', array (), 1.1, true);
}
add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );

register_nav_menus( array(
  'primary' => __( 'Primary Menu', 'emamut' ),
) );

function register_navwalker(){
  require_once get_template_directory() . '/helpers/TGM-Plugin-Activation-2.6.1/class-tgm-plugin-activation.php';
  require_once get_template_directory() . '/helpers/required-plugins.php';
  require_once get_template_directory() . '/helpers/rest_custom_endpoints.php';
  require_once get_template_directory() . '/helpers/class-wp-bootstrap-navwalker.php';
}
add_action( 'after_setup_theme', 'register_navwalker' );

function config_custom_logo() {
  add_theme_support( 'custom-logo' );
}
add_action( 'after_setup_theme' , 'config_custom_logo' );

function theme_get_custom_logo() {
  if ( has_custom_logo() ) {
    $logo = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ) , 'full' );

    echo '<img class="img-fluid" id="logo" src="' . esc_url( $logo[0] ) . '" alt="' . get_bloginfo( 'name' ) . '">';
  }
  else
    echo '<h1>' . get_bloginfo( 'name' ) . '</h1>';
}

add_action('wp_head', 'myplugin_ajaxurl');
function myplugin_ajaxurl() {
  echo "<script type=\"text/javascript\">
      let siteURL = '" . get_site_url() . "',
      themePath = '" . get_template_directory_uri() ."'
    </script>";
}

// add_filter('the_content', function($content) {
//   return str_replace(array("<iframe", "</iframe>"), array('<div class="iframe-container"><iframe', "</iframe></div>"), $content);
// });

// add_filter('embed_oembed_html', function ($html, $url, $attr, $post_id) {
//   if(strpos($html, 'youtube.com') !== false || strpos($html, 'youtu.be') !== false)
//     return '<div class="embed-responsive embed-responsive-16by9">' . $html . '</div>';
//   else
//     return $html;
// }, 10, 4);

// add_filter('embed_oembed_html', function($code) {
//   return str_replace('<iframe', '<iframe class="embed-responsive-item" ', $code);
// });
