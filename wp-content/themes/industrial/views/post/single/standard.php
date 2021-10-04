<?php

		echo '<article class="' . esc_attr( implode( ' ', get_post_class( $class_array ) ) ) . ' btPostSingleItemStandard">';
			echo '<div class="port">';
				echo '<div class="boldCell">';

				if( boldthemes_get_option( 'hide_headline' ) ) {
					echo '<div class="boldRow bottomSmallSpaced">';
						echo '<div class="rowItem col-sm-12 btArticleHeader ' . esc_attr( BoldThemesFramework::$left_alignment_class )  . '">';
								echo boldthemes_get_heading_html( $categories_html, get_the_title(), $meta_html , 'large', $dash, '', '' ) ;	
						echo '</div><!-- /rowItem -->';
					echo '</div><!-- /boldRow -->';
				}

				if ( $media_html != '' ) {
					echo '<div class="boldRow bottomSmallSpaced">';
						echo '<div class="rowItem col-sm-12 btTextCenter">' . $media_html . '</div><!-- /rowItem -->';
					echo '</div><!-- /boldRow -->';
				}


							
				echo '<div class="boldRow">';
					echo '<div class="rowItem col-sm-12">';
			
				$extra_class = '';
				
				if ( $post_format == 'link' && $media_html == '' ) {
					$extra_class = ' btLinkOrQuote';
				}
				
						echo '<div class="btArticleBody portfolioBody ' . esc_attr( BoldThemesFramework::$left_alignment_class )  . esc_attr( $extra_class ) . '">' . $content_html;

					echo '</div>';
				echo '</div><!-- /rowItem -->';
			echo '</div><!-- /boldRow -->';

			echo '<div class="boldRow topSmallSpaced bottomSmallSpaced">';
				echo '<div class="rowItem col-sm-6 tagsRowItem  ' . esc_attr( BoldThemesFramework::$left_alignment_class )  . '">';

					echo wp_kses_post( $tags_html );

				echo '</div><!-- /rowItem -->';
				echo '<div class="rowItem col-sm-6 cellRight shareRowItem  ' . esc_attr( BoldThemesFramework::$right_alignment_class )  . '">';

					echo '<div class="socialRow">' . $share_html . '</div>';
			
				echo '</div><!-- /rowItem -->';
			echo '</div><!-- /boldRow -->';

            if( $multipage ) { 
				echo '<div class="boldRow bottomSmallSpaced">';
					echo '<div class="rowItem col-sm-12 btLinkPages">';
						echo '<div class="btClear btSeparator border"><hr></div>';
						wp_link_pages( array( 
							'before'      => '<ul>' . esc_html__( 'Pages:', 'industrial' ),
							'separator'   => '<li>',
							'after'       => '</ul>'
						));

					echo '</div><!-- /rowItem -->';
				echo '</div><!-- /boldRow -->';
			}
			if ( boldthemes_get_option( 'blog_author_info' ) ) {
				echo '<div class="boldRow bottomSmallSpaced">';
					echo '<div class="rowItem col-sm-12 btAboutAutor">';
						
						echo wp_kses_post( $about_author_html );

					echo '</div><!-- /rowItem -->';
				echo '</div><!-- /boldRow -->';
			}

			echo '</div><!-- /boldCell -->';
		echo '</div><!-- /port -->';
	echo '</article>';

?>