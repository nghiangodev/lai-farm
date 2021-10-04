<?php

add_action( 'after_setup_theme', 'boldthemes_theme_init' );
add_action( 'after_setup_theme', 'boldthemes_image_sizes' );
add_action( 'widgets_init', 'boldthemes_widgets_init' );
add_action( 'wp_enqueue_scripts', 'boldthemes_enqueue' );
add_action( 'admin_enqueue_scripts', 'boldthemes_wp_admin_style' );
add_action( 'init', 'boldthemes_add_excerpt_to_page' );

// callbacks

/**
 * Theme setup
 */
if ( ! function_exists( 'boldthemes_theme_init' ) ) {
	function boldthemes_theme_init() {  
		// add theme support
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
		add_theme_support( 'post-formats', array( 'image', 'gallery', 'video', 'audio', 'link', 'quote' ) );
		add_theme_support( 'title-tag' );
		
		// load translated strings
		load_theme_textdomain( 'industrial', get_template_directory() . '/languages' );
		
		// date format
		BoldThemesFramework::$date_format = get_option( 'date_format' );
	}
}

/**
 * Image sizes
 */
if ( ! function_exists( 'boldthemes_image_sizes' ) ) {
	function boldthemes_image_sizes() {
		
		update_option( 'thumbnail_size_w', 160 );
		update_option( 'thumbnail_size_h', 160 );
		
		update_option( 'medium_size_w', 640 );
		update_option( 'medium_size_h', 0 );

		update_option( 'medium_large_size_w', 1024 );
		update_option( 'medium_large_size_h', 0 );
		
		update_option( 'large_size_w', 1280 );
		update_option( 'large_size_h', 0 );
		
		/* Small */

		add_image_size( 'boldthemes_small', 320, 0, true );
		add_image_size( 'boldthemes_small_rectangle', 320, 240, true );
		add_image_size( 'boldthemes_small_square', 320, 320, true );
		
		/* Medium */

		add_image_size( 'boldthemes_medium', 640 );
		add_image_size( 'boldthemes_medium_rectangle', 640, 480, true );
		add_image_size( 'boldthemes_medium_square', 640, 640, true );
		
		/* Large */
		
		add_image_size( 'boldthemes_large_square', 1280, 1280, true );
		add_image_size( 'boldthemes_large_rectangle', 1280, 640, true );
		add_image_size( 'boldthemes_large_vertical_rectangle', 640, 1280, true );
	}
}

/**
 * Remove Recent Comments widget style and register sidebar and widget areas
 */
if ( ! function_exists( 'boldthemes_widgets_init' ) ) {
	function boldthemes_widgets_init() {  
		global $wp_widget_factory;  
		if ( isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments']) ) {
			remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
		}
		register_sidebar( array (
			'name' 			=> esc_html__( 'Sidebar', 'industrial' ),
			'id' 			=> 'primary_widget_area',
			'description'   => 'Main sidebar',
			'before_widget' => '<div class="btBox %2$s">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<h4><span>',
			'after_title' 	=> '</span></h4>',
		));
	}
}

/**
 * Add excerpt to page
 */
if ( ! function_exists( 'boldthemes_add_excerpt_to_page' ) ) {
	function boldthemes_add_excerpt_to_page() {
		 add_post_type_support( 'page', 'excerpt' );
	}
}

/**
 * Enqueue scripts/styles
 */
if ( ! function_exists( 'boldthemes_enqueue' ) ) {
	function boldthemes_enqueue() {
		wp_enqueue_style( 'boldthemes_css', get_template_directory_uri() . '/framework/css/style.css' );
	}
}

/**
 * Admin style
 */
if ( ! function_exists( 'boldthemes_wp_admin_style' ) ) {
	function boldthemes_wp_admin_style() {
		wp_enqueue_style( 'boldthemes_admin_css', get_template_directory_uri() . '/framework/css/admin_style.css', array(), false );
	}
}
