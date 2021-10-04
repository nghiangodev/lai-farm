<?php

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

/**
 * Post media HTML
 *
 * @param string
 * @param array
 * @return string
 */
if ( ! function_exists( 'boldthemes_get_media_html' ) ) {
	function boldthemes_get_media_html( $type, $data ) {
		
		$html = '';
		
		if ( $type == 'image' ) {
		
			$data_attr = '';
			if ( isset( $data[2] ) ) {
				$data_attr = 'data-hw="' . esc_attr( $data[2] ) . '"';
			}
			$html = '<div class="btMediaBox" ' . $data_attr . '><div class="bpbItem">';
			$html .= '<a href="' . esc_url_raw( $data[0] ) . '"><img src="' . esc_url_raw( $data[1] ) . '" alt="' . esc_attr( basename( $data[1] ) ) . '"></a>';
			$html .= '</div></div>';
			
		} else if ( $type == 'image_single_post' ) {
		
			$data_attr = '';
			if ( isset( $data[2] ) ) {
				$data_attr = 'data-hw="' . esc_attr( $data[2] ) . '"';
			}
			$html = '<div class="btMediaBox" ' . $data_attr . '><div class="bpbItem">';
			$html .= '<img src="' . esc_url_raw( $data[1] ) . '" alt="' . esc_attr( basename( $data[1] ) ) . '">';
			$html .= '</div></div>';			
			
		} else if ( $type == 'gallery' ) {
			
			$data_attr = '';
			if ( isset( $data[1] ) ) {
				$data_attr = ' ' . 'data-hw="' . esc_attr( $data[1] ) . '"';
			}
			if ( isset( $data[2] ) ) {
				$html = '<div class="btMediaBox btCarouselSmallNav"' . sanitize_text_field( $data_attr ) . '>' . do_shortcode( '[gallery ids="' . join( ',', $data[0] ) . '" size="' . esc_attr( $data[2] ) . '"]' ) . '</div>';
			} else {
				$html = '<div class="btMediaBox btCarouselSmallNav"' . sanitize_text_field( $data_attr ) . '>' . do_shortcode( '[gallery ids="' . join( ',', $data[0] ) . '"]' ) . '</div>';
			}
			
		} else if ( $type == 'grid_gallery' ) {
			
			$html = '<div class="btMediaBox">' . do_shortcode( '[bt' . '_grid_gallery ids="' . esc_attr( join( ',', $data[0] ) ) . '" columns="' . esc_attr( $data[1] ) . '" has_thumb="' . esc_attr( $data[2] ) . '" format="' . esc_attr( $data[3] ) . '" lightbox="' . esc_attr( $data[4] ) . '" grid_gap="' . esc_attr( $data[5] ) . '"]' ) . '</div>';
			
		} else if ( $type == 'video' ) {
		
			$hw = 9 / 16;
			
			$html = '<div class="btMediaBox video" data-hw="' . esc_attr( $hw ) . '"><img class="aspectVideo" src="' . esc_url_raw( get_template_directory_uri() . '/gfx/video-16.9.png' ) . '" alt="' . esc_url_raw( get_template_directory_uri() . '/gfx/video-16.9.png' ) . '" role="presentation" aria-hidden="true">';

			if ( strpos( $data[0], 'https' ) === false ) {
				$url_protocol = 'http';
			} else {
				$url_protocol = 'https';
			}

			if ( strpos( $data[0], 'vimeo.com/' ) > 0 ) {
				$video_id = substr( $data[0], strpos( $data[0], 'vimeo.com/' ) + 10 );
				$html .= '<ifra' . 'me src="' . esc_url_raw( $url_protocol . '://player.vimeo.com/video/' . $video_id ) . '" allowfullscreen></ifra' . 'me>';
			} else {
				$yt_id_pattern = '~(?:http|https|)(?::\/\/|)(?:www.|)(?:youtu\.be\/|youtube\.com(?:\/embed\/|\/v\/|\/watch\?v=|\/ytscreeningroom\?v=|\/feeds\/api\/videos\/|\/user\S*[^\w\-\s]|\S*[^\w\-\s]))([\w\-]{11})[a-z0-9;:@#?&%=+\/\$_.-]*~i';
				$youtube_id = ( preg_replace( $yt_id_pattern, '$1', $data[0] ) );
				if ( strlen( $youtube_id ) == 11 ) {
					$html .= '<ifra' . 'me width="560" height="315" src="' . esc_url_raw( $url_protocol . '://www.youtube.com/embed/' . $youtube_id ) . '" allowfullscreen></ifra' . 'me>';
				} else {
					$html = '<div class="btMediaBox video" data-hw="' . esc_attr( $hw ) . '">';				
					$html .= do_shortcode( $data[0] );
				}
			}
			
			$html .= '</div>';
			
			if ( $data[0] == '' ) {
				$html = '';
			}

		} else if ( $type == 'video_frame_data_src' ) {
		
			$hw = 9 / 16;
			
			$html = '<div class="btMediaBox video" data-hw="' . esc_attr( $hw ) . '"><img class="aspectVideo" src="' . esc_url_raw( get_template_directory_uri() . '/gfx/video-16.9.png' ) . '" alt="' . esc_url_raw( get_template_directory_uri() . '/gfx/video-16.9.png' ) . '" role="presentation" aria-hidden="true">';

			if ( strpos( $data[0], 'https' ) === false ) {
				$url_protocol = 'http';
			} else {
				$url_protocol = 'https';
			}

			if ( strpos( $data[0], 'vimeo.com/' ) > 0 ) {
				$video_id = substr( $data[0], strpos( $data[0], 'vimeo.com/' ) + 10 );
				$html .= '<ifra' . 'me data-src="' . esc_url_raw( $url_protocol . '://player.vimeo.com/video/' . $video_id ) . '" allowfullscreen></ifra' . 'me>';
			} else {
				$yt_id_pattern = '~(?:http|https|)(?::\/\/|)(?:www.|)(?:youtu\.be\/|youtube\.com(?:\/embed\/|\/v\/|\/watch\?v=|\/ytscreeningroom\?v=|\/feeds\/api\/videos\/|\/user\S*[^\w\-\s]|\S*[^\w\-\s]))([\w\-]{11})[a-z0-9;:@#?&%=+\/\$_.-]*~i';
				$youtube_id = ( preg_replace( $yt_id_pattern, '$1', $data[0] ) );
				if ( strlen( $youtube_id ) == 11 ) {
					$html .= '<ifra' . 'me width="560" height="315" data-src="' . esc_url_raw( $url_protocol . '://www.youtube.com/embed/' . $youtube_id ) . '" allowfullscreen></ifra' . 'me>';
				} else {
					$html = '<div class="btMediaBox video" data-hw="' . esc_attr( $hw ) . '">';				
					$html .= do_shortcode( $data[0] );
				}
			}
			
			$html .= '</div>';
			
			if ( $data[0] == '' ) {
				$html = '';
			}
			
		} else if ( $type == 'audio' ) {
		
			if ( strpos( $data[0], '</ifra' . 'me>' ) > 0 ) {
				$html = '<div class="btMediaBox audio">' . wp_kses( $data[0], array( 'iframe' => array( 'height' => array(), 'src' =>array() ) ) ) . '</div>';
			} else {
				$html = '<div class="btMediaBox audio">' . do_shortcode( $data[0] ) . '</div>';
			}
			
			if ( $data[0] == '' ) {
				$html = '';
			}
		
		} else if ( $type == 'link' ) {
		
			$html = '<div class="btMediaBox btDarkSkin btLink"><p><a href="' . esc_url_raw( $data[0] ) . '">' . wp_kses_post( $data[1] ) . '</a></p><cite><a href="' . esc_url_raw( $data[0] ) . '">' . wp_kses_post( $data[0] ) . '</a></cite></div>';
			
			if ( $data[1] == '' || $data[0] == '' ) {
				$html = '';
			}
			
		} else if ( $type == 'quote' ) {
		
			$html = '<div class="btMediaBox btQuote btDarkSkin"><p>' . wp_kses_post( $data[0] ) . '</p><cite>' . wp_kses_post( $data[1] ) . '</cite></div>';
			
			if ( $data[0] == '' || $data[1] == '' ) {
				$html = '';
			}
		
		}
		
		return $html;
	}
}

/**
 * Returns share icons HTML
 *
 * @return string
 */
if ( ! function_exists( 'boldthemes_get_share_html' ) ) {
	function boldthemes_get_share_html( $permalink, $type = 'blog', $size = 'btIcoExtraSmallSize', $style = 'btIcoOutlineType btIcoDefaultColor' ) {
		if ( function_exists( 'boldthemes_get_share_html2' ) ) {
			return boldthemes_get_share_html2( $permalink, $type, $size, $style );
		}
	}
}

/**
 * Logo
 */
if ( ! function_exists( 'boldthemes_logo' ) ) {
	function boldthemes_logo( $type = 'header' ) {
		$logo = boldthemes_get_option( 'logo' );
		$alt_logo = boldthemes_get_option( 'alt_logo' );
		$hw = '';
		if ( ! is_string( $logo ) ) { // erased from disk
			$logo = '';
		}
		if ( $logo != '' ) {
			$image_id = 0;
			if( is_numeric( $logo ) ) {
				$image_id = $logo + 0;
			} else {
				$tmp = $logo;
				if ( strpos( $logo, '/wp-content' ) === 0 ) {
					$logo = get_site_url() . $logo;
				}
				$image_id = attachment_url_to_postid( $logo );
				if ( $image_id == 0 ) {
					$logo = $tmp;
				}
				$image_id = attachment_url_to_postid( $logo );
			}
			if( $image_id > 0) {
				$image = wp_get_attachment_image_src( $image_id, 'full' );
				if ( $image ) {
					$logo = $image[0];
					$width = $image[1];
					$height = $image[2];
					if ( $height ) $hw = $width / $height;	
					else $hw = 3;
				} else {
					$logo = '';
				}
			} else {
				$logo = '';
			}
		}

		if ( ! is_string( $alt_logo ) ) { // erased from disk
			$alt_logo = '';
		}
		
		if ( $alt_logo != '' ) {
			$image_id = 0;
			if( is_numeric( $alt_logo ) ) {
				$image_id = $alt_logo + 0;
			} else {
				$tmp = $alt_logo;
				if ( strpos( $alt_logo, '/wp-content' ) === 0 ) {
					$alt_logo = get_site_url() . $alt_logo;
				}
				$image_id = attachment_url_to_postid( $alt_logo );
				if ( $image_id == 0 ) {
					$alt_logo = $tmp;
				}
				$image_id = attachment_url_to_postid( $alt_logo );		
			}
			
			if( $image_id > 0) {
				$image = wp_get_attachment_image_src( $image_id, 'full' );
				if ( $image ) {
					$alt_logo = $image[0];
					$width = $image[1];
					$height = $image[2];
					$hw = $width / $height;				
				} else {
					$alt_logo = '';
				}
			} else {
				$alt_logo = '';
			}
		}
		
		$home_link = home_url( '/' );
		if ( $logo != '' && $logo != ' ' ) {
			if ( $type == 'header' ) {
				echo '<a href="' . esc_url_raw( $home_link ) . '"><img class="btMainLogo" data-hw="' . esc_attr( $hw ) . '" src="' . esc_url_raw( $logo ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '">';
				if ( $alt_logo != '' && $alt_logo != ' ' ) echo '<img class="btAltLogo" src="' . esc_url_raw( $alt_logo ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '">';
				echo '</a>';
			} else if ( $type == 'footer' ) {
				echo '<a href="' . esc_url_raw( $home_link ) . '"><img src="' . esc_url_raw( $logo ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '"></a>';
			} else if ( $type == 'preloader' ) {
				echo '<img class="preloaderLogo" src="' . esc_url_raw( $logo ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" data-alt-logo="' . esc_attr( $alt_logo ) . '">';
			}
		} else {
			echo '<a href="' . esc_url_raw( $home_link ) . '" class="btTextLogo">' . get_bloginfo( 'name' ) . '</a>';
		}
	}
}

/**
 * Top bar HTML output
 */
 if ( ! function_exists( 'boldthemes_top_bar_html' ) ) {
	function boldthemes_top_bar_html( $type = 'top' ) {

		if ( is_active_sidebar( 'header_left_widgets' ) || is_active_sidebar( 'header_right_widgets' ) ) {
			if ( $type == 'top' ) { ?>
				<div class="topBar btClear">
					<div class="topBarPort btClear">
						<?php if ( is_active_sidebar( 'header_left_widgets' ) && boldthemes_get_option( 'menu_type' ) != 'hLeftBelow' && boldthemes_get_option( 'menu_type' ) != 'hRightBelow' ) { ?>
						<div class="topTools btTopToolsLeft <?php echo( esc_attr( BoldThemesFramework::$left_alignment_class ) ); ?>">
							<?php dynamic_sidebar( 'header_left_widgets' ); ?>
						</div><!-- /ttLeft -->
						<?php } ?>
						<?php if ( is_active_sidebar( 'header_right_widgets' ) ) { ?>
						<div class="topTools btTopToolsRight <?php echo ( esc_attr( BoldThemesFramework::$right_alignment_class ) ) ?>">
							<?php dynamic_sidebar( 'header_right_widgets' ); ?>
						</div><!-- /ttRight -->
						<?php } ?>
					</div><!-- /topBarPort -->
				</div><!-- /topBar -->
			<?php } else if( $type == 'menu' ) { ?>
				<?php if ( is_active_sidebar( 'header_right_widgets' ) ) { ?>
					<div class="topBarInMenu">
						<div class="topBarInMenuCell">
							<?php dynamic_sidebar( 'header_right_widgets' ); ?>
						</div><!-- /topBarInMenu -->
					</div><!-- /topBarInMenuCell -->
				<?php } ?>
			<?php }	else if( $type == 'menu-half' ) { ?>	
				<?php if ( is_active_sidebar( 'header_left_widgets' ) ) { ?>
					<div class="topBarInLogoArea">
						<div class="topBarInLogoAreaCell">
							<?php dynamic_sidebar( 'header_left_widgets' ); ?>
						</div><!-- /topBarInLogoAreaCell -->
					</div><!-- /topBarInLogoArea -->
				<?php } ?>
			<?php }
		}

	}
}

/**
 * Preloader HTML output
 */
 if ( ! function_exists( 'boldthemes_preloader_html' ) ) {
	function boldthemes_preloader_html() {
		if ( ! boldthemes_get_option( 'disable_preloader' ) ) { ?>
			<div id="btPreloader" class="btPreloader fullScreenHeight">
				<div class="animation">
					<div><?php boldthemes_logo( 'preloader' ); ?></div>
					<div class="btLoader"></div>
					<p><?php echo boldthemes_get_option( 'preloader_text' ); ?></p>
				</div>
			</div><!-- /.preloader -->
		<?php }
	}
}

/**
 * Share links.
 */
if ( ! function_exists( 'boldthemes_get_share_link' ) ) {
	function boldthemes_get_share_link( $service, $url ) {
		if ( $service == 'facebook' ) {
			return 'https://www.facebook.com/sharer/sharer.php?u=' . $url;
		} else if ( $service == 'twitter' ) {
			return 'https://twitter.com/intent/tweet?text=' . $url;
		} else if ( $service == 'linkedin' ) {
			return 'https://www.linkedin.com/shareArticle?url=' . $url;
		} else if ( $service == 'vk' ) {
			return 'https://vkontakte.ru/share.php?url=' . $url;		
		} else if ( $service == 'whatsapp' ) {
			return 'https://api.whatsapp.com/send?text=' . $url;		
		} else {
			return '#';
		}
	}
}

/**
 * Get option.
 */
if ( ! function_exists( 'boldthemes_get_option' ) ) {
	function boldthemes_get_option( $opt ) {

		global $boldthemes_options;
		global $boldthemes_page_options;

		if ( isset( BoldThemes_Customize_Default::$data[ $opt ] ) ) {
			if ( isset( $_GET[ $opt ] ) || isset( $_GET[ 'bt_' . $opt ] ) ) {
				$ret = isset( $_GET[ $opt ] ) ? $_GET[ $opt ] : $_GET[ 'bt_' . $opt ];
				if ( $ret === 'true' ) {
					$ret = true;
				} else if ( $ret === 'false' ) {
					$ret = false;
				}
				return $ret;
			}			
		}
		if ( $boldthemes_page_options !== null && array_key_exists( BoldThemesFramework::$pfx . '_' . $opt, $boldthemes_page_options ) && $boldthemes_page_options[ BoldThemesFramework::$pfx . '_' . $opt ] === 'null' ) {
			return BoldThemes_Customize_Default::$data[ $opt ];
		}
		if ( $boldthemes_page_options !== null && array_key_exists( BoldThemesFramework::$pfx . '_' . $opt, $boldthemes_page_options ) ) {
			$ret = $boldthemes_page_options[ BoldThemesFramework::$pfx . '_' . $opt ];
			if ( $ret === 'true' ) {
				$ret = true;
			} else if ( $ret === 'false' ) {
				$ret = false;
			}
			return $ret;
		}
		if ( $boldthemes_options !== null && $boldthemes_options !== false && array_key_exists( $opt, $boldthemes_options ) ) {
			$ret = $boldthemes_options[ $opt ];
			if ( $ret === 'true' ) {
				$ret = true;
			} else if ( $ret === 'false' ) {
				$ret = false;
			}
			return $ret;
		} else { 
			if ( $boldthemes_options !== null ) {
				return BoldThemes_Customize_Default::$data[ $opt ];
			} else {
				$boldthemes_options = get_option( BoldThemesFramework::$pfx . '_theme_options' );
				if ( is_array( $boldthemes_options ) && array_key_exists( $opt, $boldthemes_options ) ) {
					$ret = $boldthemes_options[ $opt ];
					if ( $ret === 'true' ) {
						$ret = true;
					} else if ( $ret === 'false' ) {
						$ret = false;
					}
					return $ret;
				} else {
					return BoldThemes_Customize_Default::$data[ $opt ];
				}
			}
		}

	}
}

/**
 * Pagination output for post archive
 */
if ( ! function_exists( 'boldthemes_pagination' ) ) {
	function boldthemes_pagination() {
	
		$prev = get_previous_posts_link( esc_html__( 'Newer Posts', 'industrial' ) );
		$next = get_next_posts_link( esc_html__( 'Older Posts', 'industrial' ) );
		
		$pattern = '/(<a href=".*">)(.*)(<\/a>)/';
		
		echo '<div class="btPagination boldSection gutter">';
			echo '<div class="port">';
				if ( $prev != '' ) {
					echo '<div class="paging onLeft">';
						echo '<p class="pagePrev">';
							echo preg_replace( $pattern, '<span class="nbsItem"><span class="nbsTitle">$2</span></span>', $prev );
						echo '</p>';
					echo '</div>';
				}
				if ( $next != '' ) {
					echo '<div class="paging onRight">';
						echo '<p class="pageNext">';
							echo preg_replace( $pattern, '<span class="nbsItem"><span class="nbsTitle">$2</span></span>', $next );
						echo '</p>';
					echo '</div>';
				}
			echo '</div>';
		echo '</div>';
	}
}

/**
 * Custom comments HTML output
 */
if ( ! function_exists( 'boldthemes_theme_comment' ) ) {
	function boldthemes_theme_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		
		$rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );
		
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
			// Display trackbacks differently than normal comments.
		?>
		<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
			<p><?php esc_html_e( 'Pingback:', 'industrial' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( '(Edit)', 'industrial' ), '<span class="edit-link">', '</span>' ); ?></p>
		<?php
				break;
			default :
			// Proceed with normal comments.
			global $post;
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			<article id="comment-<?php comment_ID(); ?>" class = "">
				<?php 
					$blog_square_avatar = boldthemes_get_option( 'blog_square_avatar' );
					$avatar_html = ( $blog_square_avatar ) ? get_avatar( $comment, 140, '', '', array('class' => 'square_avatar') ) : get_avatar( $comment, 140 );
					
					if ( $avatar_html != '' ) {
						echo '<div class="commentAvatar">' . wp_kses_post( $avatar_html ) . '</div>';
					}
				?>
				<div class="commentTxt">
					<div class="vcard divider">
						<?php
							printf( '<h5 class="author"><span class="fn">%1$s</span></h5>', get_comment_author_link() );
							echo '<p class="posted">' . sprintf( esc_html__( '%1$s at %2$s', 'industrial' ), get_comment_date(), get_comment_time() ) . '</p>';
							if ( $rating > 0 && get_option( 'woocommerce_enable_review_rating' ) == 'yes' ) { ?>
								<div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" class="star-rating" title="<?php echo sprintf( esc_html__( 'Rated %d out of 5', 'industrial' ), $rating ) ?>">
									<span style="width:<?php echo wp_kses_post( ( $rating / 5 ) * 100 ); ?>%"><strong itemprop="ratingValue"><?php echo wp_kses_post( $rating ); ?></strong> <?php esc_html_e( 'out of 5', 'industrial' ); ?></span>
								</div>
							<?php }
						?>
					</div>

					<?php if ( '0' == $comment->comment_approved ) : ?>
						<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'industrial' ); ?></p>
					<?php endif; ?>

					<div class="comment">
						

						<?php comment_text();

						if ( comments_open() ) {
							echo '<p class="reply">';
								comment_reply_link( array_merge( $args, array( 'reply_text' => esc_html__( 'Reply', 'industrial' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) );
							echo '</p>';
						}
						edit_comment_link( esc_html__( 'Edit', 'industrial' ), '<p class="edit-link">', '</p>' ); ?>
					</div>
				</div>
				
				
			</article>
		<?php
			break;
		endswitch;
	}
}

/**
 * Custom MetaBox getter function
 *
 * @return string
 */
if ( ! function_exists( 'boldthemes_rwmb_meta' ) ) {
	function boldthemes_rwmb_meta( $key, $args = array(), $post_id = null ) {
		if ( function_exists( 'rwmb_meta' ) ) {
			return rwmb_meta( $key, $args, $post_id );
		} else {
			return null;
		}
	}
}

/**
 * Custom MetaBox input used for Override Global Settings
 */
if ( ! class_exists( 'RWMB_BoldThemesText_Field' ) && class_exists( 'RWMB_Field' ) ) {
	class RWMB_BoldThemesText_Field extends RWMB_Field {
	
		static function admin_enqueue_scripts() {			
			wp_enqueue_script( 
				'boldthemes_text',
				get_template_directory_uri() . '/framework/js/boldthemes_text.js',
				array( 'jquery' ),
				'',
				true
			);
		}

		static function html( $meta, $field ) {	
			$meta_key = substr( $meta, 0, strpos( $meta, ':' ) );
			$meta_value = substr( $meta, strpos( $meta, ':' ) + 1 );
			$vars = BoldThemes_Customize_Default::$data;
			$select = '<select class="boldthemes_key_select" style="vertical-align:baseline;height:auto;">';
			$select .= '<option value=""></option>';
			foreach ( $vars as $key => $var ) {
				$selected_html = '';
				if ( BoldThemesFramework::$pfx . '_' . $key == $meta_key ) {
					$selected_html = 'selected="selected"';
				}
				$select .= '<option value="' . esc_attr( BoldThemesFramework::$pfx . '_' . $key ) . '" ' . $selected_html . '>' . esc_html( $key ) . '</option>';
			}
			$select .= '</select>';
			$input = ' <input type="text" class="boldthemes_value" value="' . esc_attr( $meta_value ) . '">';
			return sprintf(
				'<input type="hidden" class="rwmb-text" name="%s" id="%s" value="%s" placeholder="%s" %s>%s',
				$field['field_name'],
				$field['id'],
				$meta,
				$field['placeholder'],
				'',
				self::datalist_html($field)
			) . $select . $input;
		}

		static function normalize_field( $field ) {
			$field = wp_parse_args( $field, array(
				'size'        => 30,
				'datalist'    => false,
				'placeholder' => '',
			) );
			return $field;
		}

		static function datalist_html( $field ) {
			return '';
		}
	}
}

/**
 * Custom MetaBox input used for custom key-value pairs
 */
if ( ! class_exists( 'RWMB_BoldThemesText1_Field' ) && class_exists( 'RWMB_Field' ) ) {
	class RWMB_BoldThemesText1_Field extends RWMB_Field {
	
		static function admin_enqueue_scripts() {			
			wp_enqueue_script( 
				'boldthemes_text',
				get_template_directory_uri() . '/framework/js/boldthemes_text.js',
				array( 'jquery' ),
				'',
				true
			);
		}

		static function html( $meta, $field ) {
		
			$meta_key = substr( $meta, 0, strpos( $meta, ':' ) );
			$meta_value = substr( $meta, strpos( $meta, ':' ) + 1 );
			
			$key_input = '<input type="text" class="boldthemes_key" value="' . esc_attr( $meta_key ) . '">';
			
			$input = ' <input type="text" class="boldthemes_value" value="' . esc_attr( $meta_value ) . '">';
			
			return sprintf(
				'<input type="hidden" class="rwmb-text" name="%s" id="%s" value="%s" placeholder="%s" %s>%s',
				$field['field_name'],
				$field['id'],
				$meta,
				$field['placeholder'],
				'',
				self::datalist_html( $field )
			) . $key_input . $input;
		}
		
		static function normalize_field( $field ) {
			$field = wp_parse_args( $field, array(
				'size'        => 30,
				'datalist'    => false,
				'placeholder' => '',
			) );
			return $field;
		}

		static function datalist_html( $field ) {
			return '';
		}
	}
}

/**
 * Get array of data for a range of posts, used in grid layout
 *
 * @param int $number
 * @param int $offset
 * @param string $cat_slug Category slug
 * @param string $post_type
 * @param string $related
 * @param string $sticky_in_grid
 * @return array Array of data for a range of posts
 */
if ( ! function_exists( 'boldthemes_get_posts_data' ) ) {
	function boldthemes_get_posts_data( $number, $offset, $cat_slug, $post_type = 'blog' ) {

		if ( $post_type == 'post' ) {
			 $post_type = 'blog';
		}
		
		$posts_data1 = array();
		$posts_data2 = array();
		
		$sticky = false;
		if ( intval( boldthemes_get_option( 'sticky_in_grid' ) ) == 1 && $post_type == 'blog' ) {
			$sticky = true;
			$sticky_array = get_option( 'sticky_posts' );
		}

		if ( $offset == 0 && $sticky && count( $sticky_array ) > 0 ) {
			$recent_posts_q_sticky = new WP_Query( array( 'post__in' => $sticky_array, 'post_status' => 'publish' ) );
			$posts_data1 = boldthemes_get_posts_array( $recent_posts_q_sticky, $post_type, array() );
		}
		
		if ( $number > 0 ) {
			if ( $post_type == 'portfolio' ) {
				if ( $cat_slug != '' ) {
					$recent_posts_q = new WP_Query( array( 'post_type' => 'portfolio', 'posts_per_page' => $number, 'offset' => $offset, 'tax_query' => array( array( 'taxonomy' => 'portfolio_category', 'field' => 'slug', 'terms' => explode( ',', $cat_slug ) ) ), 'post_status' => 'publish' ) );
				} else {
					$recent_posts_q = new WP_Query( array( 'post_type' => 'portfolio', 'posts_per_page' => $number, 'offset' => $offset, 'post_status' => 'publish' ) );
				}
			} else {
				if ( $cat_slug != '' ) {
					$recent_posts_q = new WP_Query( array( 'posts_per_page' => $number, 'offset' => $offset, 'category_name' => $cat_slug, 'post_status' => 'publish' ) );
				} else {
					$recent_posts_q = new WP_Query( array( 'posts_per_page' => $number, 'offset' => $offset, 'post_status' => 'publish' ) );
				}
			}
		}

		if ( $sticky ) {
			$posts_data2 = boldthemes_get_posts_array( $recent_posts_q, $post_type, $sticky_array );
		} else {
			$posts_data2 = boldthemes_get_posts_array( $recent_posts_q, $post_type, array() );
		}		

		return array_merge( $posts_data1, $posts_data2 );

	}
}

/**
 * boldthemes_get_posts_data helper function
 *
 * @param object
 * @param array 
 * @return array 
 */
if ( ! function_exists( 'boldthemes_get_posts_array' ) ) {
	function boldthemes_get_posts_array( $recent_posts_q, $post_type = 'blog', $sticky_arr ) {
		
		$posts_data = array();

		while ( $recent_posts_q->have_posts() ) {
			$recent_posts_q->the_post();
			$post = get_post();
			$post_author = $post->post_author;
			$post_id = get_the_ID();
			if ( in_array( $post_id, $sticky_arr ) ) {
				continue;
			}
			$posts_data[] = boldthemes_get_posts_array_item( $post_type, $post_id, $post_author );
		}
		
		wp_reset_postdata();
		
		return $posts_data;
	}
}

/**
 * boldthemes_get_posts_array helper function
 *
 * @return array
 */
if ( ! function_exists( 'boldthemes_get_posts_array_item' ) ) {
	function boldthemes_get_posts_array_item( $post_type = 'blog', $post_id, $post_author ) {
		
		$post_data = array();
		$post_data['permalink'] = get_permalink( $post_id );
		$post_data['format'] = get_post_format( $post_id );
		$post_data['title'] = get_the_title( $post_id );
		
		$post_data['excerpt'] = get_the_excerpt( $post_id );
		
		$post_data['date'] = date_i18n( BoldThemesFramework::$date_format, get_the_time( 'G', $post_id ) );
		
		$user_data = get_userdata( $post_author );
		if ( $user_data ) {
			$author = $user_data->data->display_name;
			$author_url = get_author_posts_url( $post_author );
			$post_data['author'] = '<a href="' . esc_url_raw( $author_url ) . '">' . esc_html( $author ) . '</a>';
			$post_data['author_id'] = $user_data->data->ID;
			$post_data['author_url'] = $author_url;
			$post_data['author_name'] = $author;
		} else {
			$post_data['author'] = '';
			$post_data['author_id'] = '';
			$post_data['author_url'] = '';
			$post_data['author_name'] = '';
		}

		if ( $post_type == 'portfolio' ) {
			$categories = wp_get_post_terms( $post_id, 'portfolio_category' );
		} else {
			$categories = get_the_category( $post_id );
		}
		
		if ( $post_type == 'portfolio' ) {
			BoldThemesFramework::$categories_html = boldthemes_get_post_categories( array( 'categories' => $categories ) );
		} else {
			BoldThemesFramework::$categories_html = boldthemes_get_post_categories( array( 'categories' => $categories ) );
		}

		$post_data['category'] = BoldThemesFramework::$categories_html;
		
		$comments_open = comments_open( $post_id );
		$comments_number = get_comments_number( $post_id );
		if ( ! $comments_open && $comments_number == 0 ) {
			$comments_number = false;
		}			
		
		$post_data['thumbnail'] = get_post_thumbnail_id( $post_id );
		$post_data['images'] = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_images', 'type=image', $post_id );
		if ( $post_data['images'] == null ) $post_data['images'] = array();
		$post_data['video'] = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_video', array(), $post_id );
		$post_data['audio'] = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_audio', array(), $post_id );
		$post_data['grid_gallery'] = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_grid_gallery', array(), $post_id );
		$post_data['link_title'] = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_link_title', array(), $post_id );
		$post_data['link_url'] = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_link_url', array(), $post_id );
		$post_data['quote'] = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_quote', array(), $post_id );
		$post_data['quote_author'] = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_quote_author', array(), $post_id );
		$post_data['tile_format'] = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_tile_format', array(), $post_id );
		$post_data['comments'] = $comments_number;
		$post_data['ID'] = $post_id;
		
		return $post_data;
	}
}

/**
 * Returns post excerpt by post id
 *
 * @param int
 * @return string 
 */
if ( ! function_exists( 'boldthemes_get_the_excerpt' ) ) {
	function boldthemes_get_the_excerpt( $post_id ) {
		$excerpt = get_post_field( 'post_excerpt', $post_id );
		return $excerpt;
	}
}

/**
 * Returns page id by slug
 *
 * @return string
 */
if ( ! function_exists( 'boldthemes_get_id_by_slug' ) ) {
	function boldthemes_get_id_by_slug( $page_slug ) {
		$page = get_posts(
			array(
				'name'      => $page_slug,
				'post_type' => 'page'
			)
		);
		if ( isset( $page[0] ) ) {
			return $page[0]->ID;
		}
		return null;
	}
}

/**
 * Creates override of global options for individual posts
 */
if ( ! function_exists( 'boldthemes_set_override' ) ) {
	function boldthemes_set_override() {
		global $boldthemes_options;
		$boldthemes_options = get_option( BoldThemesFramework::$pfx . '_theme_options' );

		global $boldthemes_page_options;
		$boldthemes_page_options = array();
		 
		if ( ! is_404() ) {
			$tmp_boldthemes_page_options = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_override' );
			if ( ! is_array( $tmp_boldthemes_page_options ) ) $tmp_boldthemes_page_options = array();
			$tmp_boldthemes_page_options = boldthemes_transform_override( $tmp_boldthemes_page_options );

			$tmp_boldthemes_page_options1 = '';
			if ( ( is_search() || is_archive() || is_home() ) && get_option( 'page_for_posts' ) != 0 ) {
				$tmp_boldthemes_page_options1 = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_override', array(), get_option( 'page_for_posts' ) );
			} else if ( is_singular( 'post' ) && isset( $tmp_boldthemes_page_options[ BoldThemesFramework::$pfx . '_blog_settings_page_slug'] ) && $tmp_boldthemes_page_options[ BoldThemesFramework::$pfx . '_blog_settings_page_slug'] != '' ) { // override with override
				$tmp_boldthemes_page_options1 = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_override', array(), boldthemes_get_id_by_slug( $tmp_boldthemes_page_options[ BoldThemesFramework::$pfx . '_blog_settings_page_slug'] ) );
			} else if ( is_singular( 'post' ) && isset( $boldthemes_options['blog_settings_page_slug'] ) && $boldthemes_options['blog_settings_page_slug'] != '' ) {
				$tmp_boldthemes_page_options1 = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_override', array(), boldthemes_get_id_by_slug( $boldthemes_options['blog_settings_page_slug'] ) );
			}

			if ( is_singular( 'portfolio' ) && isset( $tmp_boldthemes_page_options[ BoldThemesFramework::$pfx . '_pf_settings_page_slug'] ) && $tmp_boldthemes_page_options[ BoldThemesFramework::$pfx . '_pf_settings_page_slug'] != '' ) { 
				// override with override
				$tmp_boldthemes_page_options1 = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_override', array(), boldthemes_get_id_by_slug( $tmp_boldthemes_page_options[ BoldThemesFramework::$pfx . '_pf_settings_page_slug'] ) );
			} else if ( is_singular( 'portfolio' ) && isset( $boldthemes_options['pf_settings_page_slug'] ) && $boldthemes_options['pf_settings_page_slug'] != '' ) {
				$tmp_boldthemes_page_options1 = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_override', array(), boldthemes_get_id_by_slug( $boldthemes_options['pf_settings_page_slug'] ) );
			}
				
			if ( is_post_type_archive( 'portfolio' ) || is_tax( 'portfolio_category' )) {
				if ( ! is_null( boldthemes_get_id_by_slug( 'portfolio' ) ) && boldthemes_get_id_by_slug( 'portfolio' ) != '' ) {
					$tmp_boldthemes_page_options1 = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_override', array(), boldthemes_get_id_by_slug( 'portfolio' ) );
				} else if ( get_option( 'page_for_posts' ) ) {
					$tmp_boldthemes_page_options1 = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_override', array(), get_option( 'page_for_posts' ) );
				}
			}

			if ( function_exists( 'is_shop' ) && is_shop() && get_option( 'woocommerce_shop_page_id' ) ) {
				$tmp_boldthemes_page_options1 = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_override', array(), get_option( 'woocommerce_shop_page_id' ) );
			}
			if ( function_exists( 'is_product_category' ) && is_product_category() && get_option( 'woocommerce_shop_page_id' ) ) {
				$tmp_boldthemes_page_options1 = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_override', array(), get_option( 'woocommerce_shop_page_id' ) );
			}
			if ( function_exists( 'is_product' ) && is_product() && isset( $boldthemes_options['shop_settings_page_slug'] ) && $boldthemes_options['shop_settings_page_slug'] != '' ) {
				$tmp_boldthemes_page_options1 = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_override', array(), boldthemes_get_id_by_slug( $boldthemes_options['shop_settings_page_slug'] ) );
			}
			
			$post_type = get_post_type();

			$is_tribe = false;
			if (
				( function_exists( 'tribe_is_day' ) && tribe_is_day() ) ||
				( function_exists( 'tribe_is_month' ) && tribe_is_month() ) ||
				( function_exists( 'tribe_is_week' ) && tribe_is_week() ) ||
				( function_exists( 'tribe_is_past' ) && tribe_is_past() ) ||
				( function_exists( 'tribe_is_upcoming' ) && tribe_is_upcoming() ) ||
				( function_exists( 'tribe_is_map' ) && tribe_is_map() ) ||
				( function_exists( 'tribe_is_photo' ) && tribe_is_photo() ) ||
				( function_exists( 'tribe_is_event' ) && tribe_is_event() ) ||
				( function_exists( 'tribe_is_venue' ) && tribe_is_venue() )
			) {
				$is_tribe = true;
			}

			if ( ( $post_type == 'tribe_events' || $post_type == 'tribe_venue' || $post_type == 'tribe_organizer' || $is_tribe ) && isset( $boldthemes_options['events_settings_page_slug'] )  && $boldthemes_options['events_settings_page_slug'] != '' ) {
				BoldThemesFramework::$page_for_header_id = boldthemes_get_id_by_slug( $boldthemes_options['events_settings_page_slug'] );
				$tmp_boldthemes_page_options1 = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_override', array(), boldthemes_get_id_by_slug( $boldthemes_options['events_settings_page_slug'] ) );
			} 

			if ( is_array( $tmp_boldthemes_page_options1 ) ) {
				if ( is_singular() ) {
					$tmp_boldthemes_page_options = array_merge( boldthemes_transform_override( $tmp_boldthemes_page_options1 ), $tmp_boldthemes_page_options );
				} else {
					$tmp_boldthemes_page_options = boldthemes_transform_override( $tmp_boldthemes_page_options1 );
				}
			}

			foreach ( $tmp_boldthemes_page_options as $key => $value ) {
				$boldthemes_page_options[ $key ] = $value;
			}
			
		}
	}
}

/**
 * boldthemes_set_override helper function
 *
 * @param array
 * @return array
 */
if ( ! function_exists( 'boldthemes_transform_override' ) ) {
	function boldthemes_transform_override( $arr ) {
		$new_arr = array();
		foreach( $arr as $item ) {
			$key = substr( $item, 0, strpos( $item, ':' ) );
			$value = substr( $item, strpos( $item, ':' ) + 1 );
			$new_arr[ $key ] = $value;
		}
		return $new_arr;
	}
}

/**
 * theme name and version in data attribute
 */
if ( ! function_exists( 'boldthemes_theme_data' ) ) {
	function boldthemes_theme_data() {
		$data = wp_get_theme();
		echo 'data-bt-theme="' . esc_attr( $data['Name'] ) . ' ' . esc_attr( $data['Version'] ) . '"';
	}
}

/**
 * Header meta tags output
 */
if ( ! function_exists( 'boldthemes_header_meta' ) ) {
	function boldthemes_header_meta() {
		$desc = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_description' );
		
		if ( $desc != '' ) {
			echo '<meta name="description" content="' . esc_attr( $desc ) . '">';
		}
		
		if ( is_single() ) {
			echo '<meta property="twitter:card" content="summary">';

			echo '<meta property="og:title" content="' . get_the_title() . '" />';
			echo '<meta property="og:type" content="article" />';
			echo '<meta property="og:url" content="' . get_permalink() . '" />';
			
			$img = null;

			$boldthemes_featured_slider = boldthemes_get_option( 'blog_ghost_slider' ) && has_post_thumbnail();
			if ( $boldthemes_featured_slider ) {
				$post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
				$img = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
				$img = $img[0];
			} else {
				$images = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_images', 'type=image' );
				if ( is_array( $images ) ) {
					foreach ( $images as $img ) {
						$img = $img['full_url'];
						break;
					}
				}
			}
			if ( $img ) {
				echo '<meta property="og:image" content="' . esc_attr( $img ) . '" />';
			}
			
			if ( $desc != '' ) {
				echo '<meta property="og:description" content="' . esc_attr( $desc ) . '" />';
			}
		}
		
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<?php echo '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<meta name="mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-capable" content="yes">';
		
	}
}

/**
 * Header menu output
 */
if ( ! function_exists( 'boldthemes_nav_menu' ) ) {
	function boldthemes_nav_menu( $walker = false ) {
		$blog_page_menu = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_menu_name', array(), get_option( 'page_for_posts' ) );
		$shop_page_menu = false;
		if ( function_exists( 'is_woocommerce' ) && is_woocommerce() && get_option( 'woocommerce_shop_page_id' ) ) {
			$shop_page_menu = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_menu_name', array(), get_option( 'woocommerce_shop_page_id' ) );
		}		
		if ( $walker ) {
			if ( is_home() && $blog_page_menu != '' ) {
				wp_nav_menu( array( 'menu' => $blog_page_menu, 'container' => '', 'depth' => 3, 'fallback_cb' => false, 'walker' => $walker ) ); 
			} else if ( boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_menu_name' ) != '' ) {
				wp_nav_menu( array( 'menu' => boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_menu_name' ), 'container' => '', 'depth' => 3, 'fallback_cb' => false, 'walker' => $walker ) ); 
			} else {
				$blog_page_menu = '';
				$blog_page_menu = apply_filters( 'alternative_menu', $blog_page_menu );
				if ( $blog_page_menu != '') {
					wp_nav_menu( array( 'menu' => $blog_page_menu, 'container' => '', 'depth' => 3, 'fallback_cb' => false, 'walker' => $walker ) );
				} else {
					wp_nav_menu( array( 'theme_location' => 'primary', 'container' => '', 'depth' => 3, 'fallback_cb' => false, 'walker' => $walker ) );
				}
			}
		} else {
			if ( is_home() && $blog_page_menu != '' ) {
				wp_nav_menu( array( 'menu' => $blog_page_menu, 'container' => '', 'depth' => 3, 'fallback_cb' => false ) );
			} else if ( $shop_page_menu ) {
				wp_nav_menu( array( 'menu' => $shop_page_menu, 'container' => '', 'depth' => 3, 'fallback_cb' => false ) );				
			} else if ( boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_menu_name' ) != '' ) {
				wp_nav_menu( array( 'menu' => boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_menu_name' ), 'container' => '', 'depth' => 3, 'fallback_cb' => false ) ); 
			} else {
				$blog_page_menu = '';
				$blog_page_menu = apply_filters( 'alternative_menu', $blog_page_menu );
				if ( $blog_page_menu != '') {
					wp_nav_menu( array ( 'menu' => $blog_page_menu, 'container' => '', 'depth' => 3, 'fallback_cb' => false ) );
				} else {
					wp_nav_menu( array( 'theme_location' => 'primary', 'container' => '', 'depth' => 3, 'fallback_cb' => false ) );
				}
			}
		}
	}
}

/**
 * Returns custom header class
 *
 * @return string
 */
if ( ! function_exists( 'boldthemes_get_body_class' ) ) {
	function boldthemes_get_body_class() {
		
		$extra_class[] = 'bodyPreloader'; 
		
		$menu_type = boldthemes_get_option( 'menu_type' );
		if ( $menu_type == 'hCenter' ) {
			$extra_class[] = 'btMenuCenterEnabled'; 
		} else if ( $menu_type == 'hLeft' ) {
			$extra_class[] = 'btMenuLeftEnabled';
		}  else if ( $menu_type == 'hRight' ) {
			$extra_class[] = 'btMenuRightEnabled';
		} else if ( $menu_type == 'hLeftBelow' ) {
			$extra_class[] = 'btMenuLeftEnabled';
			$extra_class[] = 'btMenuBelowLogo';
		} else if ( $menu_type == 'hRightBelow' ) {
			$extra_class[] = 'btMenuRightEnabled';
			$extra_class[] = 'btMenuBelowLogo';
		} else if ( $menu_type == 'hCenterBelow' ) {
			$extra_class[] = 'btMenuCenterEnabled';
			$extra_class[] = 'btMenuBelowLogo';
		} else if ( $menu_type == 'vLeft' ) {
			$extra_class[] = 'btMenuVerticalLeftEnabled';
		} else if ( $menu_type == 'vRight' ) {
			$extra_class[] = 'btMenuVerticalRightEnabled';
		} else {
			$extra_class[] = 'btMenuRightEnabled';
		}

		if ( boldthemes_get_option( 'sticky_header' ) ) {
			$extra_class[] = 'btStickyEnabled';
		}

		if ( boldthemes_get_option( 'hide_menu' ) ) {
			$extra_class[] = 'btHideMenu';
		}
		
		if ( boldthemes_get_option( 'hide_headline' ) != "true" ) {
			$extra_class[] = 'btHideHeadline';
		}

		if ( boldthemes_get_option( 'template_skin' ) ) {
			$extra_class[] = 'btDarkSkin';
		} else {
			$extra_class[] = 'btLightSkin';
		}

		if ( boldthemes_get_option( 'below_menu' ) ) {
			$extra_class[] = 'btBelowMenu';
		}

		if ( ! boldthemes_get_option( 'sidebar_use_dash' ) ) {
			$extra_class[] = 'btNoDashInSidebar';
		}

		if ( boldthemes_get_option( 'top_tools_in_menu' ) ) {
			$extra_class[] = 'btTopToolsInMenuArea';
		}
		
		if ( boldthemes_get_option( 'disable_preloader' ) ) {
			$extra_class[] = 'btRemovePreloader';
		}
		
		if ( boldthemes_get_option( 'buttons_shape' ) != "no_change" ) {
			$extra_class[] = boldthemes_get_option( 'buttons_shape' );
		}
		
		if ( boldthemes_get_option( 'header_style' ) != "no_change" ) {
			$extra_class[] = boldthemes_get_option( 'header_style' );
		}
		
		if ( boldthemes_get_option( 'page_width' ) != "no_change" ) {
			$extra_class[] = boldthemes_get_option( 'page_width' );
		}

		BoldThemesFramework::$sidebar = boldthemes_get_option( 'sidebar' );

		if ( ! ( ( BoldThemesFramework::$sidebar == 'left' || BoldThemesFramework::$sidebar == 'right' ) && ! is_404() ) ) {
			BoldThemesFramework::$has_sidebar = false;
			$extra_class[] = 'btNoSidebar';
		} else {
			BoldThemesFramework::$has_sidebar = true;
			if ( BoldThemesFramework::$sidebar == 'left' ) {
				$extra_class[] = 'btWithSidebar btSidebarLeft';
			} else {
				$extra_class[] = 'btWithSidebar btSidebarRight';
			}
		}
		
		$animations = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_animations' );
		if ( $animations == 'half_page' ) {
			$extra_class[] = 'btHalfPage';
		}
		
		$extra_class = apply_filters( 'boldthemes_extra_class', $extra_class );
		
		return $extra_class;
	}
}

/**
 * Enqueue comment script
 */
if ( ! function_exists( 'boldthemes_header_init' ) ) {
	function boldthemes_header_init() {
		if ( is_singular() ) {
			wp_enqueue_script( 'comment-reply' );
		}
		if ( is_rtl() ) {
			BoldThemesFramework::$left_alignment_class = 'btTextRight';
			BoldThemesFramework::$right_alignment_class = 'btTextLeft';
		} else {
			BoldThemesFramework::$left_alignment_class = 'btTextLeft';
			BoldThemesFramework::$right_alignment_class = 'btTextRight';
		}
	}
}

/**
 * Set JS AJAX URL and JS text labels
 */
if ( ! function_exists( 'boldthemes_set_global_uri' ) ) {
	function boldthemes_set_global_uri() {
		$data = 'window.BoldThemesURI = "' . esc_js( get_template_directory_uri() ) . '"; window.BoldThemesAJAXURL = "' . esc_js( admin_url( 'admin-ajax.php' ) ) . '";';
		$data .= 'window.boldthemes_text = [];';
		$data .= 'window.boldthemes_text.previous = \'' . esc_html__( 'previous', 'industrial' ) . '\';';
		$data .= 'window.boldthemes_text.next = \'' . esc_html__( 'next', 'industrial' ) . '\';';
		return $data;
	}
}

/**
 * Get post date
 */
if ( ! function_exists( 'boldthemes_get_post_date' ) ) {
	function boldthemes_get_post_date( $arg = array() ) {
		$prefix = isset( $arg['prefix'] ) ? $arg['prefix'] : '<span class="btArticleDate">';
		$suffix = isset( $arg['suffix'] ) ? $arg['suffix'] : '</span>';
		return $prefix . esc_html( date_i18n( BoldThemesFramework::$date_format, get_the_time( 'G' ) ) ) . $suffix;
	}
}

/**
 * Get post author
 */
if ( ! function_exists( 'boldthemes_get_post_author' ) ) {
	function boldthemes_get_post_author( $author_url = false ) {
		$post = get_post();
		$post_author_id = $post->post_author;
		if ( ! $author_url ) {
			$author_url = get_author_posts_url( get_the_author_meta( 'ID', $post_author_id ) );
		}
		return '<a href="' . esc_url_raw( $author_url ) . '" class="btArticleAuthor">' . esc_html__( 'by', 'industrial' ) . ' ' . esc_html( get_the_author_meta( 'display_name', $post_author_id )  ) . '</a>';
	}
}

/**
 * Get post author 2
 */
if ( ! function_exists( 'boldthemes_get_post_author2' ) ) {
	function boldthemes_get_post_author2( $author_url ) {
		$output = '<span class="btArticleAuthor">';
		$output .= '<a href="' . esc_url_raw( $author_url ) . '" class="btArticleAuthorURL">' . 'by' . ' ' . esc_html( get_the_author() ) . '</a>';
		$output .= '</span>';
		return $output;
	}
}

/**
 * Get post comments
 */
if ( ! function_exists( 'boldthemes_get_post_comments' ) ) {
	function boldthemes_get_post_comments( $post_id = 0 ) {
		if ( $post_id != 0 ) {
			return '<a href="' . esc_url_raw( get_permalink( $post_id ) ) . '#comments" class="btArticleComments">' . get_comments_number( $post_id ) . '</a>';
		} else {
			return '<a href="' . esc_url_raw( get_permalink() ) . '#comments" class="btArticleComments">' . get_comments_number() . '</a>';
		}
	}
}

/**
 * Get post meta data
 */
if ( ! function_exists( 'boldthemes_get_post_meta' ) ) {
	function boldthemes_get_post_meta() {
		$blog_author = boldthemes_get_option( 'blog_author' );
		$blog_date = boldthemes_get_option( 'blog_date' );
		$comments_open = comments_open();
		$comments_number = get_comments_number();
		$show_comments_number = true;
		if ( ! $comments_open && $comments_number == 0 ) {
			$show_comments_number = false;
		}
		BoldThemesFramework::$meta_html = '';
		if ( $blog_author || $blog_date || $show_comments_number ) {
			if ( $blog_date ) BoldThemesFramework::$meta_html .= boldthemes_get_post_date(); 
			if ( $blog_author ) BoldThemesFramework::$meta_html .= boldthemes_get_post_author();
			if ( $show_comments_number ) BoldThemesFramework::$meta_html .= boldthemes_get_post_comments();
		}
		return BoldThemesFramework::$meta_html;
	}
}

/**
 * Get post categories
 */
if ( ! function_exists( 'boldthemes_get_post_categories' ) ) {
	function boldthemes_get_post_categories( $arg = array() ) {
		
		$categories = isset( $arg['categories'] ) ? $arg['categories'] : get_the_category();
		$csv = isset( $arg['csv'] ) ? $arg['csv'] : false;
		$no_link = isset( $arg['no_link'] ) ? $arg['no_link'] : false;
		
		BoldThemesFramework::$categories_html = '';
		if ( $categories ) {
			BoldThemesFramework::$categories_html = '<span class="btArticleCategories">';
			foreach ( $categories as $cat ) {
				if ( ! $no_link ) BoldThemesFramework::$categories_html .= '<a href="' . esc_url_raw( get_term_link( $cat->term_id ) ) . '" class="btArticleCategory cat-item-' . $cat->term_id . '">';
				BoldThemesFramework::$categories_html .= esc_html( $cat->name );
				if ( ! $no_link ) BoldThemesFramework::$categories_html .= '</a>';
				if ( $csv ) {
					BoldThemesFramework::$categories_html .= ', ';
				}
			}
			if ( $csv ) {
				BoldThemesFramework::$categories_html = trim( BoldThemesFramework::$categories_html, ', ' );
			}
			BoldThemesFramework::$categories_html .= '</span>';
		}
		return BoldThemesFramework::$categories_html;
	}
}

/**
 * Breadcrumbs
 */
if ( ! function_exists( 'boldthemes_breadcrumbs' ) ) {
	function boldthemes_breadcrumbs( $simple = false, $title, $subtitle ) {
		$home_link = home_url( '/' );
		$output  = '';
		$item_prefix = '<li>';
		$item_suffix = '</li>';
		if ( $simple ) {
			$item_prefix = '';
			$item_suffix = ' / ';
		}

		if ( ! is_404() && ! is_front_page() ) {
		
			if ( ! $simple ) {
				$output .= '<div class="btBreadCrumbs"><nav><ul>';
				if ( ! is_singular() || is_page() ) {
					$output .= '<li><a href="' . esc_url_raw( $home_link ) . '">' . esc_html__( 'Home', 'industrial' ) . '</a></li>';
				}
			} else {
				if ( ! is_singular() || is_page() ) {
					$output .= '<a href="' . esc_url_raw( $home_link ) . '">' . esc_html__( 'Home', 'industrial' ) . '</a>';
				}
			}
			
			if ( is_home() ) {
				
				$subtitle = '';
				
				$page_for_posts = get_option( 'page_for_posts' );
				if ( $page_for_posts ) {
					$page = get_post( $page_for_posts );
					$subtitle = $page->post_excerpt;
				}
			
			} else if ( is_page() ) {

				$ancestors = get_ancestors( get_the_ID(), 'page' );
				$ancestors = array_reverse( $ancestors );
			
				foreach( $ancestors as $ancestor ) {
					$output .= wp_kses_post( $item_prefix ) . '<a href="' . esc_url_raw( get_permalink( $ancestor ) ) . '">' . wp_kses_post( get_the_title( $ancestor ) ) . '</a>' . wp_kses_post( $item_suffix );
				}
				
				$page = get_post( get_the_ID() );
				$subtitle = $page->post_excerpt;
		  
			} else if ( is_singular( 'post' ) ) {
				
				$output .= boldthemes_get_post_categories();
				
				$subtitle = boldthemes_get_post_meta();
				
			} else if ( is_singular( 'portfolio' ) ) {
				
				$categories = wp_get_post_terms( get_the_ID(), 'portfolio_category' );
				$output .= boldthemes_get_post_categories( array( 'categories' => $categories ) );
				
				$subtitle = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_subheading' );
				
			} else if ( is_singular( 'product' ) ) {
				
				$id = get_queried_object_id();
				$categories = wp_get_post_terms( $id, 'product_cat' );
				$output .= boldthemes_get_post_categories( array( 'categories' => $categories ) );
				
				$pf = new WC_Product_Factory();
				$product = $pf->get_product( $id );
				$rating_count = $product->get_rating_count();
				if ( $rating_count > 0 ) {
					
					if ( boldthemes_woocommerce_is_new_version() ) {
						$subtitle = wc_get_rating_html( $product->get_average_rating() );
					}else{
						$subtitle = $product->get_rating_html();
					}
				}
				
			} else if ( is_post_type_archive( 'portfolio' ) ) {
				
				$output .= $item_prefix . esc_html__( 'Portfolio', 'industrial' ) . $item_suffix;
				
			} else if ( is_attachment() ) {
			
				$output .= $item_prefix . get_the_title() . $item_suffix;
				
			} else if ( is_category() ) {

				$output .= $item_prefix . esc_html__( 'Category', 'industrial' ) . $item_suffix;

				$subtitle = '';
				
			} else if ( is_tax() ) {
				
				$output .= $item_prefix . esc_html__( 'Category', 'industrial' ) . $item_suffix;
				
				$title = single_term_title( '', false );
				$subtitle = '';				
		  
			} else if ( is_tag() ) {
			
				$output .= $item_prefix . esc_html__( 'Tag', 'industrial' ) . $item_suffix;
				
				$subtitle = '';
		  
			} else if ( is_author() ) {
			
				$output .= $item_prefix . esc_html__( 'Author', 'industrial' ) . $item_suffix;
				
				$subtitle = '';
				
			} else if ( is_day() ) {

				$output .= $item_prefix . get_the_time( 'Y / m / d' ) . $item_suffix;
		  
			} else if ( is_month() ) {
			
				$output .= $item_prefix . get_the_time( 'Y / m' ) . $item_suffix;
		  
			} else if ( is_year() ) {
			
				$output .= $item_prefix . get_the_time( 'Y' ) . $item_suffix;			
				
			} else if ( is_search() ) {
				
				$output .= $item_prefix . esc_html__( 'Search', 'industrial' ) . $item_suffix;

				$title = get_search_query();
				$subtitle = '';
				
			}
			
			if ( ! $simple ) {
				$output .= '</ul></nav></div>';
			}
			
		}
		
		return array( 'supertitle' => $output, 'title' => $title, 'subtitle' => $subtitle );
	
	}
}

/**
 * Get related posts
 */
if ( ! function_exists( 'boldthemes_get_related_posts' ) ) {
	function boldthemes_get_related_posts( $post_id = false, $num = 3 ) {
		$num++;
		if ( ! $post_id ) {
			$post_id = get_the_ID();
		}
		$cat_list = '';
		$cat_arr = get_the_category( $post_id );
		if ( count( $cat_arr ) == 0 ) {
			$cat_list = 0;
		}
		foreach ( $cat_arr as $cat ) {
			$cat_list .= $cat->name . ',';
		}
		$cat_list = rtrim( $cat_list, ',' );
		$related_posts = boldthemes_get_posts_data( $num, 0, $cat_list );
		$i = 0;
		$has_this = false;
		foreach ( $related_posts as $item ) {
			if ( $item['ID'] == $post_id ) {
				unset( $related_posts[ $i ] );
				$has_this = true;
			}
			$i++;
		}
		if ( ! $has_this ) {
			unset( $related_posts[ $i - 1 ] );
		}
		$related_posts = apply_filters('bt_related_posts_array', $related_posts);
		return $related_posts;
	}
}

/**
 * Remove customize setting
 */
if ( ! function_exists( 'boldthemes_remove_customize_setting' ) ) {
	function boldthemes_remove_customize_setting( $id ) {
		remove_action( 'customize_register', 'boldthemes_customize_' . $id );
	}
}

/**
 * Add meta box
 */
if ( ! function_exists( 'boldthemes_add_mb' ) ) {
	function boldthemes_add_mb( $arr ) { // id, title, post_type, autosave
		BoldThemesFramework::$meta_boxes[ $arr['id'] ] = array(
			'title'     => $arr['title'],
			'post_type' => $arr['post_type'],
			'autosave'  => $arr['autosave'],
			'fields'    => array()
		);
	}
}

/**
 * Remove meta box
 */
if ( ! function_exists( 'boldthemes_remove_meta_box' ) ) {
	function boldthemes_remove_meta_box( $id ) {
		unset( BoldThemesFramework::$meta_boxes[ $id ] );
	}
}

/**
 * Add meta box field
 */
if ( ! function_exists( 'boldthemes_add_mb_field' ) ) {
	function boldthemes_add_mb_field( $arr ) { // mb_id, field_id, name, type, order*, options*, clone*
		 BoldThemesFramework::$meta_boxes[ $arr['mb_id'] ]['fields'][ $arr['field_id'] ] = array(
			'id'   => $arr['field_id'],
			'name' => $arr['name'],
			'type' => $arr['type']
		);
		
		if ( isset( $arr['order'] ) ) {
			BoldThemesFramework::$meta_boxes[ $arr['mb_id'] ]['fields'][ $arr['field_id'] ]['order'] = $arr['order'];
		} else {
			BoldThemesFramework::$meta_boxes[ $arr['mb_id'] ]['fields'][ $arr['field_id'] ]['order'] = count( BoldThemesFramework::$meta_boxes[ $arr['mb_id'] ]['fields'] );
		}
		
		if ( isset( $arr['options'] ) ) {
			BoldThemesFramework::$meta_boxes[ $arr['mb_id'] ]['fields'][ $arr['field_id'] ]['options'] = $arr['options'];
		}
		
		if ( isset( $arr['clone'] ) ) {
			BoldThemesFramework::$meta_boxes[ $arr['mb_id'] ]['fields'][ $arr['field_id'] ]['clone'] = $arr['clone'];
		}
	}
}

/**
 * Remove meta box field
 */
if ( ! function_exists( 'boldthemes_remove_mb_field' ) ) {
	function boldthemes_remove_mb_field( $mb_id, $field_id ) {
		unset( BoldThemesFramework::$meta_boxes[ $mb_id ][ 'fields' ][ $field_id ] );
	}
}
