<?php

if ( ! function_exists( 'boldthemes_customize_header_style' ) ) {
	function boldthemes_customize_header_style( $wp_customize ) {
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[header_style]', array(
			'default'           => BoldThemes_Customize_Default::$data['header_style'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'header_style', array(
			'label'     => esc_html__( 'Header Style', 'industrial' ),
			'section'   => BoldThemesFramework::$pfx . '_header_footer_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[header_style]',
			'priority'  => 62,
			'type'      => 'select',
			'choices'   => array(
				'no_change'       => esc_html__( 'Default', 'industrial' ),
				'btAccentDarkHeader' => esc_html__( 'Accent + Dark', 'industrial' ),
				'btAccentLightHeader' => esc_html__( 'Accent + Light', 'industrial' ),
				'btLightAccentHeader' => esc_html__( 'Light + Accent', 'industrial' ),
				'btLightAlternateHeader' => esc_html__( 'Light + Alternate', 'industrial' ),
				'btLightHeader' => esc_html__( 'Light + Dark elements', 'industrial' )				
			)
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_header_style' );

add_filter( 'boldthemes_extra_class', 'industrial_extra_class' );
add_filter( 'visualizer-chart-wrapper-class', 'industrial_charts_class', 10, 2 );
add_filter( 'boldthemes_product_headline_size', 'boldthemes_product_headline_size' );
add_filter( 'boldthemes_header_headline_dash', 'boldthemes_header_headline_dash' );

/**
 * Extra classes
 */
if ( ! function_exists( 'industrial_extra_class' ) ) {
	function industrial_extra_class( $extra_class ) {
		if ( boldthemes_get_option( 'buttons_shape' ) == "no_change" ) {
			$extra_class[] = 'btHardRoundedButtons' ;
		}
		return $extra_class;
	}
	
}

/**
 * Charts class
 */
if ( ! function_exists( 'industrial_charts_class' ) ) {
	function industrial_charts_class( $class, $id ) {
		return 'btVisualizer';
	}
}

/**
 * Default header dash
 */
if ( ! function_exists( 'boldthemes_header_headline_dash' ) ) {
	function boldthemes_header_headline_dash() {
		return ""; // 
	}
}

/**
 * Product headline size
 */
if ( ! function_exists( 'boldthemes_product_headline_size' ) ) {
	function boldthemes_product_headline_size( $size ) {
		return 'extralarge';
	}
}

/**
 * Header headline output
 */
if ( ! function_exists( 'boldthemes_header_headline' ) ) {
	function boldthemes_header_headline( $arg = array() ) {
		
		
		BoldThemesFramework::$hide_headline = boldthemes_get_option( 'hide_headline' );
		
		if ( ( ! BoldThemesFramework::$hide_headline && ! is_404() ) ) {
			$extra_class = '';
			
			$dash  = '';
			$use_dash = boldthemes_get_option( 'sidebar_use_dash' );
			if ( $use_dash ) $dash  = apply_filters( 'boldthemes_header_headline_dash', 'bottom' );
			$title = is_front_page() ? get_bloginfo( 'description' ) : wp_title( '', false );

			if ( BoldThemesFramework::$page_for_header_id != '' ) {
				$feat_image = wp_get_attachment_url( get_post_thumbnail_id( BoldThemesFramework::$page_for_header_id ) );
				
				$excerpt = boldthemes_get_the_excerpt( BoldThemesFramework::$page_for_header_id );
				if ( ! $feat_image ) {
					if ( is_singular() &&  !is_singular( "product" ) ) {
						$feat_image = wp_get_attachment_url( get_post_thumbnail_id() );
					} else {
						$feat_image = false;
					}
				}
			} else {
				if ( is_singular() ) {
					$feat_image = wp_get_attachment_url( get_post_thumbnail_id() );
				} else {
					$feat_image = false;
				}
				$excerpt = boldthemes_get_the_excerpt( get_the_ID() );
			}

			
			
			$parallax = isset( $arg['parallax'] ) ? $arg['parallax'] : '0.8';
			$parallax_class = 'btParallax';
			if ( wp_is_mobile() ) {
				$parallax = 0;
				$parallax_class = '';
			}
			
			$supertitle = '';
			$subtitle = $excerpt;
			
			$breadcrumbs = isset( $arg['breadcrumbs'] ) ? $arg['breadcrumbs'] : true;

			if ( $breadcrumbs ) {
				$heading_args = boldthemes_breadcrumbs( false, $title, $subtitle );
				$supertitle = $heading_args['supertitle'];
				$title = $heading_args['title'];
				$subtitle = $heading_args['subtitle'];
			}

			// yoast plugin checking
			if ( $title != '' && is_singular() ) {
				if ( class_exists( 'WPSEO_Options' ) ) {
					$title = get_the_title();
				}
			}
			
			if ( $title != '' || $supertitle != '' || $subtitle != '' ) {
				$extra_class .= boldthemes_get_option( 'below_menu' ) ? ' topLargeSpaced' : ' topSemiSpaced';
				$extra_class .= boldthemes_get_option( 'menu_type' ) == 'hCenter' ? ' btTextCenter' : ' btTextLeft';
				$extra_class .= $feat_image ? ' wBackground cover ' . $parallax_class . ' btDarkSkin btBackgroundOverlay btSolidDarkBackground ' : ' ';
				$feat_image_style = '';
				if ( $feat_image != '' ) {
					$feat_image_style = ' ' . 'style="background-image:url(' . esc_url_raw( $feat_image ) . ')"' . ' ';
				}
				echo '<section class="boldSection bottomSemiSpaced btPageHeadline gutter ' . esc_attr( $extra_class ) . '"' . $feat_image_style . 'data-parallax="' . esc_attr( $parallax ) . '" data-parallax-offset="0"><div class="port">';
				echo boldthemes_get_heading_html( $supertitle, $title, $subtitle, apply_filters( 'boldthemes_header_headline_size', 'large' ), $dash, '', '' );
				echo '</div></section>';
			}
			
		}
 	}
}
