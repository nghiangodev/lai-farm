<?php
/**
 * Description tab
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     4.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;

$heading = esc_html( apply_filters( 'woocommerce_product_description_heading', esc_html__( 'Product Description', 'industrial' ) ) );

if ( $heading ) {
	echo boldthemes_get_heading_html( '', $heading, '', 'small', '', '', '' ) ;
}
the_content(); 

?>
