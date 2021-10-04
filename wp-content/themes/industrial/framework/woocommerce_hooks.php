<?php

add_action( 'after_setup_theme', 'boldthemes_woocommerce_support' );

add_filter( 'woocommerce_show_page_title', '__return_false' );
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
add_filter( 'woocommerce_product_tabs', 'boldthemes_woo_remove_product_tabs', 98 );
add_filter( 'woocommerce_output_related_products_args', 'boldthemes_change_number_related_products' );
add_filter( 'loop_shop_per_page', 'boldthemes_loop_shop_per_page', 20 );
add_filter( 'loop_shop_columns', 'boldthemes_loop_shop_columns' );

remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description', 10 );
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

/**
 * WooCommerce support
 */
if ( ! function_exists( 'boldthemes_woocommerce_support' ) ) {
	function boldthemes_woocommerce_support() {
		add_theme_support( 'woocommerce' );
	}
}

/**
 * Remove product tabs
 */
if ( ! function_exists( 'boldthemes_woo_remove_product_tabs' ) ) {
	function boldthemes_woo_remove_product_tabs( $tabs ) {
		unset( $tabs['reviews'] ); // Remove the reviews tab
		return $tabs;
	}
}

/**
 * Change number of related products
 */
if ( ! function_exists( 'boldthemes_change_number_related_products' ) ) {
	function boldthemes_change_number_related_products( $args ) {
		$args['posts_per_page'] = 4; // # of related products
		$args['columns'] = 4; // # of columns per row
		return $args;
	}
}

/**
 * Loop shop per page
 */
if ( ! function_exists( 'boldthemes_loop_shop_per_page' ) ) {
	function boldthemes_loop_shop_per_page( $cols ) {
		return 12;
	}
}

/**
 * Loop columns
 */
if ( ! function_exists( 'boldthemes_loop_shop_columns' ) ) {
	function boldthemes_loop_shop_columns() {
		return 4; // 4 products per row
	}
}