<?php
	
	echo '<article class="' . implode( ' ', get_post_class( $class_array ) ) . ' btPostSingleItemColumns">';
		echo '<div class="port">';
			echo '<div class="boldCell">';
				echo '<div class="boldRow bottomSmallSpaced">';
					
					$extra_class = 'col-sm-12';
					if ( $media_html != '' ) {
							$extra_class = 'col-sm-3';
							echo '<div class="rowItem col-sm-9 btTextCenter btGridGap5">' . $media_html . '</div><!-- /rowItem -->';
					}
					echo '<div class="rowItem ' . esc_attr( BoldThemesFramework::$left_alignment_class )  . ' ' . esc_attr( $extra_class ) . '">';
				
					echo '<div class="btClear btSeparator bottomSmallSpaced noBorder visible-ms visible-xs"><hr></div>';
					if( boldthemes_get_option( 'hide_headline' ) ) {
						echo boldthemes_get_heading_html( $categories_html, get_the_title(), $meta_html , 'large', $dash, '', '' ) ;
					}
					
					$extra_class = '';
					
					if ( $post_format == 'link' && $media_html == '' ) {
						$extra_class = 'linkOrQuote';
					}
			
					echo '<div class="btArticleBody portfolioBody bottomSmallSpaced ' . esc_attr( $extra_class ) . '">' . $content_html . '</div>';
					
					echo wp_kses_post( $tags_html );
					echo '<div class="btClear btSeparator bottomSmallSpaced noBorder"><hr></div>' . $share_html;
																	
					if ( $multipage ) { 
						echo '<div class="btClear btSeparator bottomSmallSpaced noBorder"><hr></div>';
						wp_link_pages( array( 
							'before'      => '<ul>' . esc_html__( 'Pages:', 'industrial' ),
							'separator'   => '<li>',
							'after'       => '</ul>'
						));	
					}

					echo '</div><!-- /rowItem -->';
				echo '</div><!-- /boldRow -->';

				if ( boldthemes_get_option( 'blog_author_info' ) ) {
					echo '<div class="boldRow">';
						echo '<div class="rowItem col-sm-12 btAboutAutor ' . esc_attr( BoldThemesFramework::$left_alignment_class )  . '">';
							
							echo wp_kses_post( $about_author_html );

						echo '</div><!-- /rowItem -->';
					echo '</div><!-- /boldRow -->';
				}

			echo '</div><!-- /boldCell -->';
		echo '</div><!-- /port -->';
	echo '</article>';

?>