<?php
if ( ! function_exists( 'boldthemes_woocommerce_is_new_version' ) ) {	 
	/**
	 * Get the woocommerce version and set functions.
	 * @return bool
	 */
	function boldthemes_woocommerce_is_new_version() {

		if ( ! class_exists( 'WooCommerce' ) ) {
			return false;
		}

		global $woocommerce;
		if ( version_compare( $woocommerce->version, '3.0', '>=') )  {
			return true;
		}
		
		return false;			
	}
}


/**
 * Add to cart button.
 */
if ( ! function_exists( 'boldthemes_wc_get_add_to_cart_button' ) ) {
	function boldthemes_wc_get_add_to_cart_button( $product ) {
		return sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="btBtn btnFilledStyle btnSmall btnNormal btnAlternateColor add_to_cart_button ajax_add_to_cart %s"><span class="btnInnerText">%s</span></a>',
			esc_url( $product->add_to_cart_url() ),
			esc_attr( isset( $quantity ) ? $quantity : 1 ),
			esc_attr( $product->get_id() ),
			esc_attr( $product->get_sku() ),
			esc_attr( isset( $class ) ? $class : '' ),
			esc_html( $product->add_to_cart_text() )
		);
	}
}

/**
 * Share buttons.
 */
if ( ! function_exists( 'boldthemes_wc_get_share_buttons' ) ) {
	function boldthemes_wc_get_share_buttons( $permalink ) {
		return boldthemes_get_share_html( $permalink, 'shop', 'btIcoSmallSize', 'btIcoDefaultType btIcoDefaultColor' );
	}
}

/**
 * Show the product title in the product loop.
 */
if (  ! function_exists( 'woocommerce_template_loop_product_title' ) ) {
	function woocommerce_template_loop_product_title() {
		global $product;

		$subtitle = '';

		if ( boldthemes_woocommerce_is_new_version() ) {
			if ( get_option( 'woocommerce_enable_review_rating' ) !== 'no' && $rating_html = wc_get_rating_html( $product->get_average_rating() ) ) {
				$subtitle = $rating_html;
			}
		} else {
			if ( get_option( 'woocommerce_enable_review_rating' ) !== 'no' && $rating_html = $product->get_rating_html() ) {
				$subtitle = $rating_html;
			}
		}

		if ( $subtitle == '' ) {
			$subtitle = '<span class="btNoStarRating"></span>';	;
		}
		
		/*if ( boldthemes_woocommerce_is_new_version() ) {
			$supertitle = '<span class = "btArticleCategories">' . wc_get_product_category_list( $product->get_id(),'', '<span class="btArticleCategory">', '</span>' ) . "</span>";
		} else {
			$supertitle = '<span class = "btArticleCategories">' . $product->get_categories( '', '<span class="btArticleCategory">', '</span>' ) . '</span>';
		}*/
		
		$categories = wp_get_post_terms( $product->get_id(), 'product_cat' );
		$supertitle = boldthemes_get_post_categories( array( 'categories' => $categories ) );

		$title = '<a href = "' . get_permalink() . '">' . get_the_title() . '</a>';
		
		$dash = boldthemes_get_option( 'shop_use_dash' );
		if ( $dash != '' ) {
			$dash = 'top';
		}

		echo boldthemes_get_heading_html( $supertitle, $title, $subtitle, 'extrasmall', $dash, '', '' ) ;

	}
}

if ( ! function_exists( 'woocommerce_get_product_thumbnail' ) ) {
 
	/**
	 * Get the product thumbnail, or the placeholder if not set.
	 *
	 * @subpackage	Loop
	 * @param string $size (default: 'shop_catalog')
	 * @param int $deprecated1 Deprecated since WooCommerce 2.0 (default: 0)
	 * @param int $deprecated2 Deprecated since WooCommerce 2.0 (default: 0)
	 * @return string
	 */
	function woocommerce_get_product_thumbnail( $size = 'shop_catalog', $deprecated1 = 0, $deprecated2 = 0 ) {
		global $post;

		if ( has_post_thumbnail() ) {
			$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $size );
			return boldthemes_get_image_html( 
				array(
					'image' => $thumbnail[0],
					'caption_title' => '',
					'caption_text' => '',
					'content' => '',
					'size' => '',
					'shape' => '',
					'url' => get_post_permalink(),
					'target' => '_self',
					'show_titles' => false,
					'el_style' => '',
					'el_class' => 'btTextCenter'
				)
			);
		} elseif ( wc_placeholder_img_src() ) {
			return wc_placeholder_img( $size );
		}
	}
}