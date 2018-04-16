<?php
/*
 *  Plugin Name: Website Helper Functions
 *  Description: helper functions that built the podcast elements of the website. This only includes the shortcodes used to build the podcast pages: the podcast list, the podcast pages sidebar. Please use this as the site is currently using a parent theme. The purpose of this plugin is to add modifications for the site due to lack of child theme.
 * Author: Slapshot Studio Dev Team
 * Author URI: http://slapshotstudio.com
 * Version: 1.0
 */
 require 'puc/plugin-update-checker.php';
 $myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
 	'https://github.com/payatola2287/podcast-helpers/',
 	__FILE__,
 	'thekep-slapshot-podcast-helpers'
 );
 require 'inc/ViewHelper.php';
 /* REQUIRED CSS FILES */
function add_css_to_s(){
  $plugin_url = plugin_dir_url( __FILE__ );
  wp_enqueue_style( 'podcaster-helpers', $plugin_url . 'assets/css/styles.css' );
}
add_action( 'after_setup_theme','add_css_to_s' );

function grid( $atts ){
  $atts = shortcode_atts( array(
    'col' => 3
  ),$atts );
  ViewHelper::post_grid();
}
add_shortcode( 'tk_posts_grid','grid' );
