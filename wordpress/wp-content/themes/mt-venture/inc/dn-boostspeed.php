<?php

/**
 * Tối ưu contact form
 * @author Đoàn Nguyễn
 */
function dn_load_cf7($arr){
  if ( is_page_template( 'page-contact.php' ) ) {
      return $arr;
  } else {
      return false;
  }
}

// add_filter( 'wpcf7_load_js', 'dn_load_cf7' );
// add_filter( 'wpcf7_load_css', 'dn_load_cf7' );

/**
 * Remove WP Embed Script
 * @author Đoàn Nguyễn
 */
function stop_loading_wp_embed() {
	if (!is_admin()) {
		wp_deregister_script('wp-embed');
	}
}
add_action('init', 'stop_loading_wp_embed');


// Remove the REST API endpoint.
remove_action( 'rest_api_init', 'wp_oembed_register_route' );
// Turn off oEmbed auto discovery.
add_filter( 'embed_oembed_discover', '__return_false' );
// Don't filter oEmbed results.
remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );
// Remove oEmbed discovery links.
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
// Remove oEmbed-specific JavaScript from the front-end and back-end.
remove_action( 'wp_head', 'wp_oembed_add_host_js' );
//Remove WordPress Version Number
remove_action('wp_head', 'wp_generator');
/**
 * Remove emoji
 * @author Đoàn Nguyễn
 */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

/**
 * Remove Thumbnails default
 * @author Đoàn Nguyễn
 */
remove_image_size('1536x1536');
remove_image_size('2048x2048');
function dntheme_remove_default_image_sizes( $sizes) {
    // unset( $sizes['thumbnail']);
    // unset( $sizes['medium']);
    // unset( $sizes['large']);

    return $sizes;
}
// add_filter('intermediate_image_sizes_advanced', 'dntheme_remove_default_image_sizes');


add_action( 'wp_enqueue_scripts', 'dntheme_remove_enqueue_scripts' );
function dntheme_remove_enqueue_scripts() {
      wp_dequeue_style('wp-block-library');
}
//Remove Gutenberg Block Library CSS from loading on the frontend
function smartwp_remove_wp_block_library_css(){
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'wc-block-style' ); // Remove WooCommerce block CSS
}
add_action( 'wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100 );