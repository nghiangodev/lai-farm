<?php

	$share_html = '<div class="btIconRow">' . boldthemes_get_share_html( $permalink, 'blog', 'btIcoExtraSmallSize', 'btIcoDefaultType btIcoDefaultColor' ) . '</div>';

	$meta_html = '';
	if ( $blog_author || $blog_date || $show_comments_number ) {
		$meta_html .= '';
		if ( $blog_date && ! $blog_side_info ) $meta_html .= boldthemes_get_post_date(); 
		if ( $blog_author && ! $blog_side_info ) $meta_html .= boldthemes_get_post_author();
		if ( $show_comments_number ) {
			if ( $meta_html != '' ) {
				$meta_html .= boldthemes_get_post_comments();
			} else {
				$categories_html .= boldthemes_get_post_comments();
			}
		}
	}

	$dash = $blog_use_dash ? 'bottom' : '';
	
	echo '<article class="' . esc_attr( implode( ' ', get_post_class( $class_array ) ) ) . '">';
		echo '<div class="port">';
			echo '<div class="boldCell">';
				echo '<div class = "boldRow">';
					echo '<div class="rowItem col-sm-12">';
						echo '<div class="rowItemContent ' . esc_attr( BoldThemesFramework::$left_alignment_class )  . '">';
							if ( $blog_side_info ) {
									echo '<div class="articleSideGutter btTextCenter">';
									$avatar_html = get_avatar( get_the_author_meta( 'ID' ), 144 ); 
										
									if ( $avatar_html != '' ) {
										echo '<div class="asgItem avatar"><a href="' . esc_url_raw( $author_url ) . '">' . $avatar_html . '</a></div>';
									}
									if ( $blog_author ) {
										echo '<div class="asgItem title"><span>' . boldthemes_get_post_author() . '</span></div>';
									}
									if ( $blog_date ) {
										echo '<div class="asgItem date"><small>' . boldthemes_get_post_date( array( 'prefix' => '', 'suffix' => '' ) ) . '</small></div>';
									}	
									
									echo '</div>';
								}
								
								$extra_class = '';
								if ( $post_format == 'link' && $media_html == '' ) {
									$extra_class = ' linkOrQuote';
								}

								echo '<div class="btArticleListBody' . $extra_class . '">';				
									if ( $media_html != '' ) {
										echo ' ' . $media_html;
									}

									echo '<div class="btClear btSeparator bottomSmallSpaced noBorder"><hr></div>';
									echo boldthemes_get_heading_html( $categories_html, '<a href="' . esc_url_raw( $permalink ) . '">' . get_the_title() . '</a>', $meta_html, 'large', $dash, '', '' );
									echo '<div class="btArticleListBodyContent">' . $content_final_html . '</div>';
									echo '<div class="btClear btSeparator bottomSmallSpaced noBorder"><hr></div>';
									echo '<div class="boldRow btArticleFooter">';
										echo '<div class="boldRowInner">';
											echo '<div class="rowItem col-md-6 col-ms-12 btShareArticle btMiddleVertical ' . esc_attr( BoldThemesFramework::$left_alignment_class ) .'"><div class="rowItemContent">' . $share_html . '</div></div>';
											 $continue_ico = 'fa_f061';
											 $continue_ico_style = 'btnRightPosition';
											 if ( is_rtl() ) {
												 $continue_ico_style = 'btnLeftPosition';
												 $continue_ico = 'fa_f060';
											 };
											 $continue_ico_style .= ' btContinueReading btnOutlineStyle btnNormalColor btnExtraSmall btnNormalWidth btnIco';
											echo '<div class="rowItem col-md-6 col-ms-12 btReadArticle btMiddleVertical ' . esc_attr( BoldThemesFramework::$right_alignment_class ) . '"><div class="rowItemContent">' . boldthemes_get_button_html( $continue_ico, $permalink, esc_html__( 'CONTINUE READING', 'industrial' ), $continue_ico_style , '', '' ) . '</div></div>';
										echo '</div><!-- /boldRowInner -->';
									echo '</div><!-- /boldRow -->';
								echo '</div><!-- /btArticleListBody -->' ;
							echo '</div><!-- /rowItemContent -->' ;
						echo '</div><!-- /rowItem -->';
				echo '</div><!-- /boldRow -->';			
			echo '</div><!-- boldCell -->';			
		echo '</div><!-- port -->';
	echo '</article><!-- /articles -->';

?>