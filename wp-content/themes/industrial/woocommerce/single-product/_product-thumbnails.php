<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     4.8.0 
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product, $woocommerce;

if ( boldthemes_woocommerce_is_new_version() ) {
	$attachment_ids = $product->get_gallery_image_ids();
}else{	
	$attachment_ids = $product->get_gallery_attachment_ids();
}

if ( $attachment_ids ) {
	$loop 		= 0;
	$columns 	= apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
	?>
	<div class="thumbnails <?php echo 'columns-' . esc_attr( $columns ); ?>"><?php

		foreach ( $attachment_ids as $attachment_id ) {

			$classes = array( '' );

			if ( $loop === 0 || $loop % $columns === 0 )
				$classes[] = 'first';

			if ( ( $loop + 1 ) % $columns === 0 )
				$classes[] = 'last';

			$image_title 	= esc_attr( get_the_title( $attachment_id ) );
			$image_caption 	= esc_attr( get_post_field( 'post_excerpt', $attachment_id ) );		

			$image_link = wp_get_attachment_url( $attachment_id );			
			
			if ( ! $image_link ) {
				continue;
			} else {
				$image_link = '<a href="' . esc_url_raw( $image_link ) . '" class="lightbox" data-title="' . esc_attr( $image_caption ) . '"></a>';
			}

			$image = wp_get_attachment_image_src( $attachment_id, 'shop_thumbnail' );
			$image = $image[0];
				
			$classes[] = 'btTextCenter';

			$image_class = esc_attr( implode( ' ', $classes ) );
			
			echo '<div class="btSingleProductThumb">' . boldthemes_get_image_html( 
				array(
					'image' => $image,
					'caption_title' => $image_caption,
					'caption_text' => '',
					'content' => '',
					'size' => '',
					'shape' => '',
					'url' => $image_link,
					'target' => '',
					'show_titles' => false,
					'el_style' => '',
					'el_class' => $image_class
				)
			) . '</div>';

			$loop++;
		}

	?></div>
	<?php
}
