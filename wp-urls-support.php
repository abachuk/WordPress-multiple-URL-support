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
 
?>