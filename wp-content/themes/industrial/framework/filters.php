<?php

add_filter( 'get_search_form', 'boldthemes_search_form' );
add_filter( 'the_content_more_link', 'boldthemes_remove_more_link_scroll' );
add_filter( 'wp_list_categories', 'boldthemes_cat_count_span' );
add_filter( 'get_archives_link', 'boldthemes_arch_count_span' );
add_filter( 'wp_nav_menu_items', 'boldthemes_remove_menu_item_whitespace' );
add_filter( 'wp_video_shortcode', 'boldthemes_wp_video_shortcode', 10, 5 );
add_filter( 'wp_video_shortcode_library', 'boldthemes_wp_video_shortcode_library' );
add_filter( 'wp_audio_shortcode_library', 'boldthemes_wp_audio_shortcode_library' );

// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)
add_filter( 'woocommerce_add_to_cart_fragments', 'boldthemes_woocommerce_header_add_to_cart_fragment' );

add_filter( 'wp_kses_allowed_html', 'boldthemes_allowed_html' );
			
/**
* Adds product count
*/
function boldthemes_woocommerce_header_add_to_cart_fragment( $fragments ) {
	ob_start(); ?>
	<span class="cart-contents" title="<?php _e( 'View your shopping cart', 'industrial' ); ?>"><?php echo WC()->cart->get_cart_contents_count(); ?></span> 
	<?php
	$fragments['span.cart-contents'] = ob_get_clean();
	return $fragments;
}

/**
 * Custom search form
 *
 * @return string
 */
if ( ! function_exists( 'boldthemes_search_form' ) ) {
	function boldthemes_search_form( $form ) {
		$form = '<div class="btSearch">';
		$form .= boldthemes_get_icon_html( 'fa_f002', '#', '', 'btIcoDefaultType btIcoDefaultColor', '' );
		$form .= '
		<div class="btSearchInner gutter" role="search">
			<div class="btSearchInnerContent port">
				<form action="' . esc_url_raw( home_url( '/' ) ) . '" method="get"><input type="text" name="s" placeholder="' . esc_attr( esc_html__( 'Looking for...', 'industrial' ) ) . '" class="untouched">
				<button type="submit" data-icon="&#xf105;"></button>
				</form>
				<div class="btSearchInnerClose">' . boldthemes_get_icon_html( 'fa_f00d', '#', '', '', '' ) . '</div>
			</div>
		</div>';
		$form .= '</div>';
		return $form;
	}
}

/**
 * Removes more link scroll
 *
 * @return string
 */
if ( ! function_exists( 'boldthemes_remove_more_link_scroll' ) ) {
	function boldthemes_remove_more_link_scroll( $link ) {
		$link = preg_replace( '|#more-[0-9]+|', '', $link );
		return $link;
	}
}

/**
 * Category list custom HTML
 *
 * @return string
 */
if ( ! function_exists( 'boldthemes_cat_count_span' ) ) {
	function boldthemes_cat_count_span( $links ) {
		return $links;
	}
}

/**
 * Archive link custom HTML
 *
 * @return string 
 */
if ( ! function_exists( 'boldthemes_arch_count_span' ) ) {
	function boldthemes_arch_count_span( $links ) {
		return $links;
	}
}

/**
 * Removes whitespace between tags in menu items
 */
if ( ! function_exists( 'boldthemes_remove_menu_item_whitespace' ) ) {
	function boldthemes_remove_menu_item_whitespace( $items ) {
		return preg_replace( '/>(\s|\n|\r)+</', '><', $items );
	}
}

/**
 * Video shortcode custom HTML
 *
 * @return string
 */
if ( ! function_exists( 'boldthemes_wp_video_shortcode' ) ) {
	function boldthemes_wp_video_shortcode( $item_html, $atts, $video, $post_id, $library ) {
		$replace_value = 'width: ' . $atts['width'] . 'px';
		$replace_with  = 'width: 100%';
		return str_ireplace( $replace_value, $replace_with, $item_html );
	}
}

/**
 * Enqueue video shortcode custom JS
 *
 * @return string 
 */
if ( ! function_exists( 'boldthemes_wp_video_shortcode_library' ) ) {
	function boldthemes_wp_video_shortcode_library() {
		wp_enqueue_style( 'wp-mediaelement' );
		wp_enqueue_script( 'boldthemes_video_shortcode', get_template_directory_uri() . '/framework/js/video_shortcode.js', array( 'mediaelement' ), '', true );
		return 'boldthemes_mejs';
	}
}

/**
 * Enqueue audio shortcode custom JS
 *
 * @return string 
 */
if ( ! function_exists( 'boldthemes_wp_audio_shortcode_library' ) ) {
	function boldthemes_wp_audio_shortcode_library() {
		wp_enqueue_style( 'wp-mediaelement' );
		wp_enqueue_script( 'boldthemes_audio_shortcode', get_template_directory_uri() . '/framework/js/audio_shortcode.js', array( 'mediaelement' ), '', true );
		return 'boldthemes_mejs';
	}
}

/**
 * Alowed html
 */
if ( ! function_exists( 'boldthemes_allowed_html' ) ) {
	function boldthemes_allowed_html( $tags ) {
		$allowed_attributes = array(
			'class' => true,
			'id' => true,
			'class' => true,
			'target' => true,
			'title' => true,
			'src' => true,
			'style' => true,
			'data-ico-fa' => true,
			'data-ico-icon7stroke' => true,
			'id' => true,
			'href' => true
        );
		$tags['span'] = $allowed_attributes;
		$tags['div'] = $allowed_attributes;
		$tags['a'] = $allowed_attributes;
		$tags['iframe'] = array(
			'src'         => true,
			'height'      => true,
			'width'       => true,
			'scrolling'   => true,
			'frameborder' => true,
		);
		return $tags;
	}
}