<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
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

global $post, $product;

?>
<div class="images">
	<?php
		if ( has_post_thumbnail() ) {
			$image_caption = get_post( get_post_thumbnail_id() )->post_excerpt;
			$image_link    = wp_get_attachment_url( get_post_thumbnail_id() );
			$image_link = '<a href="' . esc_url_raw( $image_link ) . '" class="lightbox" data-title="' . esc_attr( $image_caption ) . '"></a>';
			
			$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'shop_single' );
			$image = $image[0];
			
			echo boldthemes_get_image_html( 
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
					'el_class' => 'btTextCenter'
				)
			);

		} else {

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_html__( 'Placeholder', 'industrial' ) ), $post->ID );

		}
	?>

	<?php do_action( 'woocommerce_product_thumbnails' ); ?>
</div>
