<?php

/**
 * Returns heading HTML
 *
 * @param string $superheadline
 * @param string $headline
 * @param string $subheadline
 * @param string $headline_size // small/medium/large/extralarge
 * @param string $dash // no/top/bottom
 * @param string $el_class
 * @param string $el_style
 * @return string
 */
 
 if ( ! function_exists( 'boldthemes_get_heading_html' ) ) {
	function boldthemes_get_heading_html( $superheadline, $headline, $subheadline, $headline_size, $dash, $el_class, $el_style ) {

		if ( $superheadline != '' ) {
			$superheadline = '<div class="btSuperTitle"><span>' . wp_kses_post( $superheadline ) . '</span></div>';
		}

		if ( $subheadline != '' ) {
			$subheadline = '<div class="btSubTitle">' . wp_kses_post( $subheadline ) . '</div>';
		}
		
		$h_tag = 'h1';
		$class = '';

		$style_attr = '';
		if ( $el_style != '' ) {
			$style_attr = 'style="' . esc_attr( $el_style ) . '"';
		}

		if ( $headline_size != 'no' ) {
			$class .= $headline_size;
		}
		if ( $headline_size == 'extralarge' || $headline_size == 'huge' ) {
			$h_tag = 'h1';
		} else if ( $headline_size == 'large' ) {
			$h_tag = 'h2';
		} else if ( $headline_size == 'medium' ) {
			$h_tag = 'h3';
		} else {
			$h_tag = 'h4';
		}

		if ( $dash == 'yes' ) {
			$dash = 'top';
		}
		
		if ( $dash != 'no' && $dash != '' ) {
			$dash = str_replace( ' ', 'Dash ', $dash );
			$class .= ' btDash ' . $dash . 'Dash';
		}

		if ( $el_class != '' ) {
			$class .= ' ' . $el_class;
		}
		
		$output = '<header class="header btClear ' . $class . '" ' . $style_attr . '>';
		
		$output .= $superheadline;

		
		
        if ( $headline != '' || $subheadline != '' ) {
				$output .= '<div class="dash">';
					$pattern = "/<(b|u|i|em|del)([> ])/";
					$replace = '<$1 class="animate">';
					$headline = preg_replace( $pattern, $replace, $headline );
					if ( $headline != '' ) {
						$output .= '<' . $h_tag . '><span class="headline">' . $headline . '</span></' . $h_tag . '>';
					}					
				$output .= '</div>';
				$output .= $subheadline;			
		}
		
        $output .= '</header>';	

		return $output;
		
	}
}

/**
 * Returns image with link HTML
 *
 * @param string $image
 * @param string $caption_text
 * @param string $size
 * @param string $url 
 * @param string $target
 * @param string $el_style 
 * @param string $el_class 
 * @return string
 */
 if ( ! function_exists( 'boldthemes_get_image_html' ) ) {
	function boldthemes_get_image_html( $arg ) {
		
		$image = isset( $arg['image'] ) ? $arg['image'] : '';
        $caption_title = isset( $arg['caption_title'] ) ? $arg['caption_title'] : '';
        $caption_text = isset( $arg['caption_text'] ) ? $arg['caption_text'] : '';
        $content = isset( $arg['content'] ) ? $arg['content'] : '';
        $size = isset( $arg['size'] ) ? $arg['size'] : '';
        $shape = isset( $arg['shape'] ) ? $arg['shape'] : '';
        $lazy_load = isset( $arg['lazy_load'] ) ? $arg['lazy_load'] : false;
        $url = isset( $arg['url'] ) ? $arg['url'] : '';
        $target = isset( $arg['target'] ) ? $arg['target'] : '';
        $show_titles = isset( $arg['show_titles'] ) ? $arg['show_titles'] : '';
        $el_style = isset( $arg['el_style'] ) ? $arg['el_style'] : '';
        $el_class = isset( $arg['el_class'] ) ? $arg['el_class'] : '';
        $alt = isset( $arg['alt'] ) ? $arg['alt'] : '';

		$el_style = sanitize_text_field( $el_style );
		$el_class = sanitize_text_field( $el_class );

		$target = ! empty( $target ) ? $target : '_self';

		if( $show_titles == 'yes' || $show_titles == 'true' || $show_titles == 1 ) {
			$show_titles = true;
		} else {
			$show_titles = false;
		}
		
		if ( $size == '' ) $size = 'large';
		if ( $shape == 'circle' ) {
			$el_class .= ' btCircleImage';
		} else if ( $shape == 'outlined' ) {
			$el_class .= ' btOutlinedImage';
		} else if ( $shape == 'rounded' ) {
			$el_class .= ' btRoundedImage';
		} else {
			if ( $show_titles ) $el_class .= ' btHasTitles';
		}
		if ( $content != '' ) $el_class .= ' btHasComplexContent'; 
			
		$style_html = '';
		if ( $el_style != '' ) {
			$style_html= ' ' . 'style="' . esc_attr( $el_style ) . '"';
		}

		if ( $caption_title != '' ) {
			$img_title = $caption_title;
		} else {
			$img_title = $caption_text;
		}
		
		if ( $lazy_load ) {
			$output = '<div class = "btImage"><img src="' . esc_url_raw( get_template_directory_uri() . '/gfx/blank.gif' ) . '" data-image_src="' . ( $image ) . '" alt="' . esc_attr( $alt ) . '" title="' . esc_attr( $img_title ) . '" class="btLazyLoadImage" ></div>';
		} else {
			$output = '<div class = "btImage"><img src="' . esc_url_raw( $image ) . '" alt="' . esc_attr( $alt ) . '" title="' . esc_attr( $img_title ) . '"></div>';	
		}
		
		// $output = '<div class="btImage"><img src="' . esc_url_raw( $image ) . '" alt="' . esc_attr( $alt ) . '" title="' . esc_attr( $img_title ) . '"></div>';
		
		if ( strpos( $url, '<a href' ) === 0 ) {
			$link = $url;
		} else {
			$link = '';
			if ( $url != '' && $url != '#' && substr( $url, 0, 4 ) != 'http' && substr( $url, 0, 5 ) != 'https' && substr( $url, 0, 6 ) != 'mailto' ) {
				
				$link = boldthemes_get_permalink_by_slug( $url );
			} else {
				$link = $url;
			}			
			$link = '<a href="' . esc_url_raw( $link ) . '" target="' . esc_attr( $target ) . '" title="' . esc_attr( $caption_title ) . '"></a>';
		}
		
		if ( $url != '' ) {
			$link_output = '<div class="bpgPhoto ' . $el_class . '" ' . $style_html . '> 
					' . $link . '
					<div class="boldPhotoBox"><div class="bpbItem">' . $output . '</div></div>
					<div class="captionPane btDarkSkin btTextCenter">
						<div class="captionTable">
							<div class="captionCell">
								<div class="captionTxt">';
									if ( $content != '' ) {
										$link_output .= $content;
									} else if ( $caption_title != '' || $caption_text != '' ) {
										$link_output .=	boldthemes_get_heading_html( $caption_text, $caption_title, '', 'extrasmall', '', '', '' );
									}
			$link_output .=		'</div>
							</div>
						</div>
					</div>';
					if ( $show_titles ) {
						$link_output .= '
						<div class="btShowTitle">
							<div class="btShowTitleCaptionTxt">' . boldthemes_get_heading_html( $caption_text, $caption_title, '', 'small', '', '', '' ) . '</div>
						</div>';
					}
			$link_output .= '</div>';
			
			$output = $link_output;
		} else {
			$output = '<div class="bpgPhoto ' . $el_class . '" ' . $style_html . '>' . $output . '</div>';
		}
 		
		return $output;
	}
}

/**
 * Returns button HTML
 *
 * @param string $icon
 * @param string $url
 * @param string $text
 * @param string $el_class 
 * @param string $el_style 
 * @param string $target 
 * @return string
 */
 if ( ! function_exists( 'boldthemes_get_button_html' ) ) {
	function boldthemes_get_button_html( $icon, $url, $text, $el_class, $el_style = '', $target = '' ) {
		
		$style_attr = '';
		if ( $el_style != '' ) {
			$style_attr = 'style="' . esc_attr( $el_style ) . '"';
		}

		if ( $url == '' ) {
			$url = '#';
		}

		if ( $text != '' ) {
			$text = '<span class="btnInnerText">' . wp_kses_post( $text ) . '</span>';
		}

		if ( is_array( $el_class ) ) $el_class = implode( ' ', $el_class );

		if ( $icon == '' || $icon == 'no_icon' ) {
			$el_class .= " btnNoIcon";
		}

		$link = '';
	
		if ( $url != '' && $url != '#' && substr( $url, 0, 4 ) != 'http' && substr( $url, 0, 5 ) != 'https' && substr( $url, 0, 6 ) != 'mailto' ) {
			$link = boldthemes_get_permalink_by_slug( $url );
		} else {
			$link = $url;
		}

		$output = '<a href="' . esc_url_raw( $link ) . '" class="btBtn ' . esc_attr( $el_class ) . '"' . ' ' . $style_attr . $target . '>';
			if ( $icon == '' || $icon == 'no_icon' ) {
				$output .= $text;
			} else {
				$output .= $text . boldthemes_get_icon_html( $icon, '', '', '' );
			}
		$output .= '</a>';
		
		return $output;
	}
}

/**
 * Returns icon HTML
 *
 * @param string $icon
 * @param string $url
 * @param string $text
 * @param string $el_class 
 * @return string
 */
 if ( ! function_exists( 'boldthemes_get_icon_html' ) ) {
	function boldthemes_get_icon_html( $icon, $url, $text, $el_class, $target = '', $el_style = '' ) {
		
		$icon_set = substr( $icon, 0, 2 );
		$icon = substr( $icon, 3 );
		
		if( substr( $url, 0, 3 ) == 'www' ) $url = 'http://' . $url;

		$link = '';
		
		if ( $url != '' && $url != '#' && substr( $url, 0, 4 ) != 'http' && substr( $url, 0, 5 ) != 'https' && substr( $url, 0, 6 ) != 'mailto' ) {
			$link = boldthemes_get_permalink_by_slug( $url );
		} else {
			$link = $url;
		}
		
		if ( $text != '' ) $text = '<span>' . wp_kses_post( $text ) . '</span>';

		if ( $link == '' ) {
			$ico_tag = 'span ';
			$ico_tag_end = 'span';	
		} else {
			$target_attr = 'target="_self"';
			if ( $target != '' ) $target_attr = ' target="' . ( $target ) . '"';
			$ico_tag = 'a href="' . esc_url_raw( $link ) . '" ' . $target_attr;
			$ico_tag_end = 'a';
		}

		if ( $el_style != '' ) {			
			return '<span class="btIco ' . esc_attr( $el_class ) . '" style="' . esc_attr( $el_style ) . '"><' . $ico_tag . ' data-ico-' . esc_attr( $icon_set ) . '="&#x' . esc_attr( $icon ) . ';" class="btIcoHolder">' . wp_kses_post( $text ) . '</' . $ico_tag_end . '></span>';
		} else {
			return '<span class="btIco ' . esc_attr( $el_class ) . '"><' . $ico_tag . ' data-ico-' . esc_attr( $icon_set ) . '="&#x' . esc_attr( $icon ) . ';" class="btIcoHolder">' . wp_kses_post( $text ) . '</' . $ico_tag_end . '></span>';
		}
	}
}

/**
 * Returns the permalink for a page based on the incoming slug.
 *
 * @param   string  $slug   The slug of the page to which we're going to link.
 * @return  string          The permalink of the page
 */
 if ( ! function_exists( 'boldthemes_get_permalink_by_slug' ) ) {
	function boldthemes_get_permalink_by_slug( $slug ) {
		$permalink = null;
		$args = array(
			'name'          => $slug,
			'max_num_posts' => 1
		);
		
		$args = array_merge( $args, array( 'post_type' => 'any' ) );
		
		$query = new WP_Query( $args );
		if( $query->have_posts() ) {
			$query->the_post();
			$permalink = get_permalink( get_the_ID() );
			wp_reset_postdata();
		}
		if ( $permalink ) {
			return $permalink;
		}
		return $slug;
	}
}
