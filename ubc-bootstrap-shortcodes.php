<?php
/*
Plugin Name: UBC Bootstrap shortcodes
Plugin URI:  http://educ.ubc.ca
Description: A plugin that allows users to use shortcodes that utilizes some of the built in styles from twitter bootstrap.
Version: 2.02
Author: David Brabbins
License: GPL2
*/

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

//Span class for input color options filler for custom boxes
function colour_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
      'option' => 'pomegranate',
      ), $atts ) );
   return '<span class="' . esc_attr($option) . '">' . do_shortcode($content) . '</span>';
}
add_shortcode( 'colour', 'colour_shortcode' );

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
	  'link' => '#',
	  'title' => do_shortcode($content)
      ), $atts ) );
   return '<a href="' . esc_attr($link) . '" title="' . esc_attr($title) . '" class="btn btn-' . esc_attr($name) . '">' . do_shortcode($content) . '</a>';
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

//Lead Shortcode
function lead_shortcode( $atts, $content = null ) {
   return '<span class="lead">' . do_shortcode($content) . '</span>';
}
add_shortcode( 'lead', 'lead_shortcode' );

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
