<?php
/*
Plugin Name: UBC Bootstrap shortcodes
Plugin URI:  http://educ.ubc.ca
Description: A plugin that allows users to use shortcodes that utilizes some of the built in styles from twitter bootstrap.
Version: 2.01
Author: David Brabbins
License: GPL2
*/
function ubc_bootstrap_shortcodes_column_update_plugin(){
   
   include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
   if( is_plugin_active(  'bootstrap-shortcodes/bootstraps-shortcode.php' ) ) {
      deactivate_plugins( 'bootstrap-shortcodes/bootstraps-shortcode.php' );
      activate_plugin(    'bootstrap-shortcodes/ubc-bootstrap-shortcodes.php' );
   }

}
ubc_bootstrap_shortcodes_column_update_plugin();


//thumbnails short with class works should work with column shortcode
function thumbnails_shortcode( $atts, $content = null ) {
   return '<div class="thumbnails">' . do_shortcode($content) . '</div>';
}
add_shortcode( 'thumbnails', 'thumbnails_shortcode' );

//Div class filler for custom boxes
function container_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
      'style' => 'class',
      ), $atts ) );
   return '<div class="' . esc_attr($style) . '">' . do_shortcode($content) . '</div>';
}
add_shortcode( 'container', 'container_shortcode' );

//labels shortcode
function label_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
      'name' => 'block',
      ), $atts ) );
   return '<span class="label label-' . esc_attr($name) . '">' . do_shortcode($content) . '</span>';
}
add_shortcode( 'label', 'label_shortcode' );

//alert shortcode
function alert_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
      'name' => 'block',
      ), $atts ) );
   return '<div class="alert alert-' . esc_attr($name) . '">' . do_shortcode($content) . '</div>';
}
add_shortcode( 'alert', 'alert_shortcode' );

//Well shortcode
function well_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
      'name' => '',
      ), $atts ) );
   return '<div class="well well-' . esc_attr($name) . '">' . do_shortcode($content) . '</div>';
}
add_shortcode( 'well', 'well_shortcode' );

//badge shortcode
function badge_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
      'name' => '',
      ), $atts ) );
   return '<span class="badge badge-' . esc_attr($name) . '">' . do_shortcode($content) . '</span>';
}
add_shortcode( 'badge', 'badge_shortcode' );

//link with href button shortcode
function button_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
      'name' => 'primary',
	  'link' => 'href'
      ), $atts ) );
   return '<a href="' . esc_attr($link) . '" class="btn btn-' . esc_attr($name) . '">' . do_shortcode($content) . '</a>';
}
add_shortcode( 'button', 'button_shortcode' );

//span button shortcode
function spanbutton_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
      'name' => 'primary',
      ), $atts ) );
   return '<span class="btn btn-' . esc_attr($class) . '">' . do_shortcode($content) . '</span>';
}
add_shortcode( 'buttoncon', 'spanbutton_shortcode' );

//icon button shortcode, use the icon name without the icon-. Defaults to the globe.
function icon_shortcode( $atts ) {
	extract( shortcode_atts( array(
      'name' => 'plane',
      ), $atts ) );
   return '<i class="icon-' . esc_attr($name) . '"></i>';
}
add_shortcode( 'icon', 'icon_shortcode' );

//Back to Top Shortcode
function back_shortcode( $atts ) {
   return '<div class="row-fluid ubc7-back-to-top clearfix"><div class="span4"><a href="#" title="Back to top">Back to top <span class="ubc7-arrow up-arrow grey"></span></a></div></div>';
}
add_shortcode( 'back_to_top', 'back_shortcode' );

//Line Break Shortcode
function break_shortcode( $atts ) {
   return '<hr />';
}
add_shortcode( 'break', 'break_shortcode' );