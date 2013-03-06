<?php
 
/*
Plugin Name:    Server Name Support
Description:    Allows the blog to be accessed with different server names
Author:         Alex Bachuk
Version:        0.0.1

Description: forked from Michal Wojciechowski http://odyniec.net/blog/2010/02/wordpress-blog-and-multiple-server-names/comment-page-1/#comment-58549
*/
 
$abs_home = preg_replace('!://[a-z0-9.-]*!', '://' . $_SERVER['SERVER_NAME'], get_option('home'));
 
function abs_home() {
    global $abs_home; 
    return $abs_home;
}
 
function abs_replace_host($url, $path = '') {
    return preg_replace('!://[a-z0-9.-]*!', '://' . $_SERVER['SERVER_NAME'], $url);
}
 
add_filter('pre_option_home', 'abs_home');
add_filter('pre_option_siteurl', 'abs_home');
add_filter('pre_option_url', 'abs_home');
add_filter('stylesheet_uri', 'abs_replace_host');
add_filter('stylesheet_directory_uri', 'abs_replace_host'); 
add_filter('admin_url', 'abs_replace_host');


/// CREDIT http://wordpress.org/support/view/plugin-reviews/relative-url//////

add_action( 'template_redirect', 'relative_url' );

  function relative_url() {
    // Don't do anything if:
    // - In feed
    // - In sitemap by WordPress SEO plugin
    if ( is_feed() || get_query_var( 'sitemap' ) )
      return;
    $filters = array(
      'post_link',       // Normal post link
      'post_type_link',  // Custom post type link
      'page_link',       // Page link
      'attachment_link', // Attachment link
      'get_shortlink',   // Shortlink
      'post_type_archive_link',    // Post type archive link
      'get_pagenum_link',          // Paginated link
      'get_comments_pagenum_link', // Paginated comment link
      'term_link',   // Term link, including category, tag
      'search_link', // Search link
      'day_link',   // Date archive link
      'month_link',
      'year_link',

      // site location
      'option_siteurl',
      'blog_option_siteurl',
      'option_home',
      'admin_url',
      'home_url',
      'includes_url',
      'site_url',
      'site_option_siteurl',
      'network_home_url',
      'network_site_url',

      // debug only filters
      'get_the_author_url',
      'get_comment_link',
      'wp_get_attachment_image_src',
      'wp_get_attachment_thumb_url',
      'wp_get_attachment_url',
      'wp_login_url',
      'wp_logout_url',
      'wp_lostpassword_url',
      'get_stylesheet_uri',
      // 'get_stylesheet_directory_uri',
      // 'plugins_url',
      // 'plugin_dir_url',
      // 'stylesheet_directory_uri',
      // 'get_template_directory_uri',
      // 'template_directory_uri',
      'get_locale_stylesheet_uri',
      'script_loader_src', // plugin scripts url
      'style_loader_src', // plugin styles url
      'get_theme_root_uri'
      // 'home_url'
    );

    foreach ( $filters as $filter ) {
      add_filter( $filter, 'wp_make_link_relative' );
    }
    home_url($path = '', $scheme = null);

?>
