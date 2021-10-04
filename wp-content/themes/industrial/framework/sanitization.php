<?php

/**
 * Checkbox sanitization callback
 */
function boldthemes_sanitize_checkbox( $checked ) {
	// Boolean check.
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

/**
 * CSS sanitization callback
 */
function boldthemes_sanitize_css( $css ) {
	return wp_strip_all_tags( $css );
}

/**
 * Drop-down Pages sanitization callback
 */
function boldthemes_sanitize_dropdown_pages( $page_id, $default = '' ) {
	// Ensure $input is an absolute integer.
	$page_id = absint( $page_id );
	
	// If $page_id is an ID of a published page, return it; otherwise, return the default.
	return ( 'publish' == get_post_status( $page_id ) ? $page_id : $default );
}

/**
 * Email sanitization callback
 */
function boldthemes_sanitize_email( $email, $default = '' ) {
	// Sanitize $input as a hex value without the hash prefix.
	$email = sanitize_email( $email );
	
	// If $email is a valid email, return it; otherwise, return the default.
	return ( ! null( $email ) ? $email : $default );
}

/**
 * HTML sanitization callback
 */
function boldthemes_sanitize_html( $html ) {
	return wp_filter_post_kses( $html );
}

/**
 * Image sanitization callback
 */
function boldthemes_sanitize_image( $image, $default = '' ) {
	
	if ( $image == '' ) {
		return '';
	}

	/*
	 * Array of valid image file types.
	 *
	 * The array includes image mime types that are included in wp_get_mime_types()
	 */
    $mimes = array(
        'jpg|jpeg|jpe' => 'image/jpeg',
        'gif'          => 'image/gif',
        'png'          => 'image/png',
        'bmp'          => 'image/bmp',
        'tif|tiff'     => 'image/tiff',
        'ico'          => 'image/x-icon',
		'svg'          => 'image/svg+xml',
		'svgz'         => 'image/svg+xml'
    );

	// Return an array with file extension and mime_type.
    $file = wp_check_filetype( $image, $mimes );

	// If $image has a valid mime_type, return it; otherwise, return the default.
    return ( $file['ext'] ? $image : $default );
}

/**
 * No-HTML sanitization callback
 */
function boldthemes_sanitize_nohtml( $nohtml ) {
	return wp_filter_nohtml_kses( $nohtml );
}

/**
 * Number sanitization callback
 */
function boldthemes_sanitize_number_absint( $number, $default = '' ) {
	// Ensure $number is an absolute integer (whole number, zero or greater).
	$number = absint( $number );
	
	// If the input is an absolute integer, return it; otherwise, return the default
	return ( $number ? $number : $default );
}

/**
 * Select sanitization callback
 */
function boldthemes_sanitize_select( $input, $setting ) {

	preg_match( '/\[(.*?)\]/', $setting->id, $match );
	$control_id = $match[1];

    $choices = $setting->manager->get_control( $control_id )->choices;

    if ( array_key_exists( $input, $choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

/**
 * URL sanitization callback
 */
function boldthemes_sanitize_url( $url ) {
	return esc_url_raw( $url );
}

add_filter( 'pre_update_option_bt_bb_custom_css', 'boldthemes_bt_bb_custom_css', 10, 3 );
if ( ! function_exists( 'boldthemes_bt_bb_custom_css' ) ) {	
	function boldthemes_bt_bb_custom_css( $new_value, $old_value, $option ) {
		$new_value_final = array();
		foreach( $new_value as $id => $css ) {
			$new_value_final[ $id ] = wp_strip_all_tags( $css );
		}
		return $new_value_final;
	}
}

add_filter( 'option_bt_bb_custom_css', 'boldthemes_get_bt_bb_custom_css', 10, 2 );
if ( ! function_exists( 'boldthemes_get_bt_bb_custom_css' ) ) {	
	function boldthemes_get_bt_bb_custom_css( $value, $option ) {
		$new_value_final = array();
		foreach( $value as $id => $css ) {
			$new_value_final[ $id ] = wp_strip_all_tags( $css );
		}
		return $new_value_final;
	}
}