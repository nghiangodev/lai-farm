<?php

$boldthemes_options = get_option( BoldThemesFramework::$pfx . '_theme_options' );
if ( isset( $boldthemes_options['pf_settings_page_slug'] ) && $boldthemes_options['pf_settings_page_slug'] != '' ) {
	BoldThemesFramework::$page_for_header_id = boldthemes_get_id_by_slug( $boldthemes_options['pf_settings_page_slug'] );
}

get_header();

if ( have_posts() ) {

	the_post();

	$pf_use_dash = boldthemes_get_option( 'pf_use_dash' );
	$dash = $pf_use_dash ? 'bottom' : '';

	$images = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_images', 'type=image' );
	if ( $images == null ) $images = array();
	$video = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_video' );
	$audio = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_audio' );
	$data_items_split = 3;
	
	$subheading = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_subheading' );
	
	$full_title = get_the_title();
	if( $subheading != '' ) {
		$full_title .= '<span class="btPortfolioSubtitle">' . $subheading . '</span>';		
		$data_items_split ++;
	}
	
	$categories = wp_get_post_terms( get_the_ID(), 'portfolio_category' );
	$categories_html = boldthemes_get_post_categories( array( 'categories' => $categories ) );
	
	$permalink = get_permalink();

	$first_img = '';

	$cf_right_html = '';
	
	$cf = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_custom_fields' );
	if ( $cf != '' ) {
		$cf = array_values( boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_custom_fields' ) );
		for ( $i = 0; $i < $data_items_split; $i++ ) {
			if ( $i < count( $cf ) ) {
				$item = $cf[ $i ];
				$item_key = substr( $item, 0, strpos( $item, ':' ) );
				$item_value = substr( $item, strpos( $item, ':' ) + 1 );
				$cf_right_html .= '<dt>' . $item_key . '</dt>';
				$cf_right_html .= '<dd>' . $item_value . '</dd>';
			}
		}
	}

	$meta_right_html = '';
	
	$meta_right_html = $meta_right_html . $cf_right_html;
	
	$slider_images = array();
			
	if ( has_post_thumbnail() ) {

		$post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
		$first_img = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
		$first_img = $first_img[0];
		
		$first_thumb = wp_get_attachment_image_src( $post_thumbnail_id, 'medium' );
		$first_thumb = $first_thumb[0];
		
		$first_post = get_post( $post_thumbnail_id );
		$first_text = $first_post->post_excerpt;
		$first_description = $first_post->post_content;
		
		if ( count( $images ) > 0 ) {
			$n = 0;
			foreach ( $images as $img ) {
				$src = wp_get_attachment_image_src( $img['ID'], 'full' );
				$src = $src[0];
				
				$thumb = wp_get_attachment_image_src( $img['ID'], 'medium' );
				$thumb = $thumb[0];
				
				$img_post = get_post( $img['ID'] );
				$text = $img_post->post_excerpt;
				
				$slider_images[ $n ]['src'] = $src;
				$slider_images[ $n ]['thumb'] = $thumb;
				$slider_images[ $n ]['text'] = $text;
				$slider_images[ $n ]['description'] = $img_post->post_content;
				
				$n++;
			}
		}
		
	} else if ( count( $images ) > 0 ) {
		$n = 0;
		foreach ( $images as $img ) {
			
			if ( boldthemes_get_option( 'pf_ghost_slider' ) ) {
		
				if ( $n == 0 ) {
				
					$first_img = wp_get_attachment_image_src( $img['ID'], 'full' );
					$first_img = $first_img[0];
					
					$first_thumb = wp_get_attachment_image_src( $img['ID'], 'medium' );
					$first_thumb = $first_thumb[0];
						
					$first_post = get_post( $img['ID'] );
					$first_text = $first_post->post_excerpt;
					$first_description = $first_post->post_content;

				} else {
			
					$src = wp_get_attachment_image_src( $img['ID'], 'full' );
					$src = $src[0];
					
					$thumb = wp_get_attachment_image_src( $img['ID'], 'medium' );
					$thumb = $thumb[0];

					$this_post = get_post( $img['ID'] );

					$text = $this_post->post_excerpt;

					$slider_images[ $n ]['src'] = $src;
					$slider_images[ $n ]['thumb'] = $thumb;
					$slider_images[ $n ]['text'] = $text;
					$slider_images[ $n ]['description'] = $this_post->post_content;
				
				}
			
			} else {
				
				$src = wp_get_attachment_image_src( $img['ID'], 'full' );
				$src = $src[0];
				
				$thumb = wp_get_attachment_image_src( $img['ID'], 'medium' );
				$thumb = $thumb[0];

				$this_post = get_post( $img['ID'] );

				$text = $this_post->post_excerpt;

				$slider_images[ $n ]['src'] = $src;
				$slider_images[ $n ]['thumb'] = $thumb;
				$slider_images[ $n ]['text'] = $text;
				$slider_images[ $n ]['description'] = $this_post->post_content;
				
			}
			
			$n++;
		}
	
	}
	
	if ( boldthemes_get_option( 'pf_ghost_slider' ) ) {
		$gr_class = '';
	} else {
		$gr_class = ' btRemoveGhost';
	}
	
	?>
		<section class="boldSection fullScreenHeight btGhost btDarkSkin<?php echo esc_attr( $gr_class ); ?>">
			<div class="port">
				<div class="boldCell">
					<div class="boldRow ">
						<div class="rowItem col-sm-12 col-md-12 btTextLeft inherit btMiddleVertical">
							<div class="rowItemContent">
								<div class="btCloseGhost"><?php echo boldthemes_get_icon_html( 's7_e680', '#', '', 'btIcoOutlineType btIcoDefaultColor btIcoMediumSize' ); ?></div>
								<div class="slidedVariable largeSliderHeight"<?php if ( count( $slider_images ) == 0 ) echo ' ' . 'data-nocenter="yes"'; ?>>
								
								<?php if ( boldthemes_get_option( 'pf_ghost_slider' ) ) { ?>
									<div class="slidedItem fullScreenHeight firstItem <?php if ( count( $slider_images ) == 0 ) echo 'onlyItem'; ?>" data-thumb="<?php echo esc_attr( $first_thumb ); ?>" data-text="<?php echo esc_attr( $first_text ); ?>" data-description="<?php echo esc_attr( $first_description ); ?>">
										<div class="port wBackground cover" style="<?php echo esc_attr( 'background-image:url(' . $first_img . ')' ); ?>">
											<div class="boldCell" data-slick="yes">
												<div class="btSlideGutter gutter">
													<div class="btSlidePane port">
														<div class="col-sm-9 rowItem <?php echo (esc_attr( BoldThemesFramework::$left_alignment_class )) ?>">
															<?php echo boldthemes_get_heading_html( $categories_html, $full_title, boldthemes_get_the_excerpt( get_the_ID() ), 'extralarge', $dash, '', '' ) ;; ?>
														</div><!-- /boldBlogArticle -->
														<div class="col-sm-3 rowItem <?php echo (esc_attr( BoldThemesFramework::$right_alignment_class )) ?>">
															<dl class="btArticleMeta">
																<?php echo wp_kses_post( $meta_right_html ); ?>
															</dl>
														</div>
													</div>
												</div><!-- /.boldCell-->
											</div><!-- /.boldCell-->
										</div><!-- /.fullScreen -->
									</div><!-- /.slidedItem -->
								<?php }	

								foreach( $slider_images as $slider_image ) {
									echo '<div class="slidedItem fullScreenHeight" data-thumb="' . esc_attr( $slider_image['thumb'] ) . '" data-text="' . esc_attr( $slider_image['text'] ) . '" data-description="' . esc_attr( $slider_image['description'] ) . '">';
										echo '<div class="variableImg"><img src="' . esc_attr( $slider_image['src'] ) . '" alt="' . esc_attr( $slider_image['src'] ) . '"></div>';
									echo '</div><!-- /.slidedItem -->';
								} ?>
								</div><!-- /slided -->
								<span class="btGetInfo"><?php echo boldthemes_get_icon_html( 'fa_f129', '#', '', 'btIcoDefaultColor btIcoOutlineType btIcoExtraSmallSize' ); ?></span>
								<div class="btInfoBar">
									<div class="btInfoBarMeta">
										<p><strong></strong> <?php echo get_the_title(); ?></p>
										<p><strong><?php esc_html_e( 'Title:', 'industrial' ); ?></strong> <span class="btPortfolioSliderCaption"></span></p>
										<p><strong><?php esc_html_e( 'Description:', 'industrial' ); ?></strong> <span class="btPortfolioSliderDescription"></span></p>
									</div><!-- /boldInfoBarMeta -->
								</div><!-- /boldInfoBar -->
							</div><!-- /rowItemContent -->
						</div><!-- /rowItem -->
					</div><!-- /boldRow -->
				</div><!-- /boldCell -->
			</div><!-- /port -->
		</section>

	<?php
	
	$permalink = get_permalink();

	$media_html = '';
	
	$has_thumb = 'no';
	
	if ( has_post_thumbnail() ) {
	
		$has_thumb = 'yes';
		
	}
	
	if ( count( $images ) == 1 ) {
	
		foreach ( $images as $img ) {
			$img = wp_get_attachment_image_src( $img['ID'], 'large' );
			$media_html = boldthemes_get_media_html( 'image_single_post', array( $permalink, $img[0] ) );
			break;
		}
		
	} else if ( count( $images ) > 1 ) {
	
		$images_ids = array();
		foreach ( $images as $img ) {
			$images_ids[] = $img['ID'];
		}
		if ( intval( boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_grid_gallery' ) ) != 0 ) {
			$media_html = boldthemes_get_media_html( 'grid_gallery', array( $images_ids , boldthemes_get_option( 'pf_grid_gallery_columns' ), $has_thumb, boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_grid_gallery_format' ), 'no', boldthemes_get_option( 'pf_grid_gallery_gap' ) ) );
		} else {
			$media_html = boldthemes_get_media_html( 'gallery', array( $images_ids ) );
		}
		
	} else if ( $video != '' ) {
		
		$media_html = boldthemes_get_media_html( 'video', array( $video ) );
		
	} else if ( $audio != '' ) {
		
		$media_html = boldthemes_get_media_html( 'audio', array( $audio ) );
		
	}

	$content_html = apply_filters( 'the_content', get_the_content( '', false ) );
	$content_html = str_replace( ']]>', ']]&gt;', $content_html );
	
		$prev_next_html = '';
		$prev = get_adjacent_post( false, '', true );
		$prev_next_html .= '<div class="rowItem col-sm-12 col-md-6 ' . esc_attr( BoldThemesFramework::$left_alignment_class )  . '">';
		if ( '' != $prev ) {
			$prev_next_html .= '<h4 class="nbs nsPrev"><a href="' . esc_url_raw( get_permalink( $prev ) ) . '">';
			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $prev->ID ), 'thumbnail' );
			$url = $thumb[0];	
			$prev_next_html .= '<span class="nbsImage"><span class="nbsImgHolder" style="background-image:url(\'' . $url . '\');"></span></span>';
			$prev_next_html .= '<span class="nbsItem"><span class="nbsDir">' . esc_html__( 'previous', 'industrial' ) . '</span><span class="nbsTitle">' . esc_html( $prev->post_title ) . '</span></span>';
			$prev_next_html .= '</a></h4>';
		}
		$prev_next_html .= '</div>';

		$next = get_adjacent_post( false, '', false );
		
		$prev_next_html .= '<div class="rowItem col-sm-12 col-md-6 ' . esc_attr( BoldThemesFramework::$right_alignment_class )  . '">';
		if ( '' != $next ) {
			$prev_next_html .= '<h4 class="nbs nsNext"><a href="' . esc_url_raw( get_permalink( $next ) ) . '">';
			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $next->ID ), 'thumbnail' );
			$url = $thumb[0];
			$prev_next_html .= '<span class="nbsItem"><span class="nbsDir">' . esc_html__( 'next', 'industrial' ) . '</span><span class="nbsTitle">' . esc_html( $next->post_title ) . '</span></span>';
			$style_el = '';
			if ($url != '') $style_el = ' style="background-image:url(\'' . $url . '\');"';			
			$prev_next_html .= '<span class="nbsImage"><span class="nbsImgHolder"' . $style_el . '></span></span>';
			$prev_next_html .= '</a></h4>';
			
		}
		$prev_next_html .= '</div>';
	
	$class_array = array( 'boldSection', 'boldArticle', 'portfolioItem', 'gutter' );
	if ( $content_html != '' ) $class_array[] = 'divider';

	$extra_class = 'col-sm-12';
	if ( ( $cf != '' && count( $cf ) > $data_items_split ) || $categories_html != '' || $cf_right_html != '' ) {
		$extra_class = ' col-sm-9';
	}
	
	if (boldthemes_get_option( 'pf_single_view' ) == 'columns' ) {
		include( get_template_directory() . '/views/portfolio/single/columns.php' );	
	} else {
		include( get_template_directory() . '/views/portfolio/single/standard.php' );
	}

	include( get_template_directory() . '/views/comments.php' );
}

get_footer();
