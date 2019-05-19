<?php

/*
Plugin Name: Education Comparison2
Description: Short Code: [Education-City-Comparison-part2]
Version: 1.1
Author: Zoe
*/

// User cannot access the plugin directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Add short code for the plugin
function generate_ecc2_short_code() {
	include 'education-com-2.php';
}

add_shortcode( 'Education-City-Comparison-part2', 'generate_ecc2_short_code' );

// Add the scripts
function add_ecc2_scripts() {
	wp_enqueue_script( 'edu2city_script', plugins_url( '/js/edu2city_script.js', __FILE__ ), array( 'jquery' ), '1.1', true );
	wp_enqueue_script( 'edu2dia_script', plugins_url( '/js/edu2dia_script.js', __FILE__ ), array( 'jquery' ), '1.1', true );
	wp_enqueue_style( 'edu2city_style', plugins_url( '/css/edu2city_style.css', __FILE__ ), array(), '1.1' );
	wp_enqueue_style( 'edu2dia_style', plugins_url( '/css/edu2dia_style.css', __FILE__ ), array(), '1.1' );

}

add_action( 'wp_enqueue_scripts', 'add_ecc2_scripts' );
