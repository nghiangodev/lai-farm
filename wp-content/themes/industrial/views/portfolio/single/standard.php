<?php

	$extra_class = 'col-sm-12';
	if ( ( $cf != '' && count( $cf ) > $data_items_split ) || ! boldthemes_get_option( 'hide_headline' ) ) {
		$extra_class = ' col-sm-9';
	}

	echo '<article class="' . esc_attr( implode( ' ', get_post_class( $class_array ) ) ) . ' btPortfolioSingleItemStandard">';
		echo '<div class="port">';
			echo '<div class="boldCell">';
			
			if ( boldthemes_get_option( 'hide_headline' ) ) {
				echo '<div class="boldRow btArticleHeader">';
					echo '<div class="rowItem col-sm-9 ' . esc_attr( BoldThemesFramework::$left_alignment_class )  . '">';
						
						echo boldthemes_get_heading_html( $categories_html, $full_title, boldthemes_get_the_excerpt( get_the_ID() ), 'large', $dash, 'wArticleMeta', '' ) ;
						
					echo '</div><!-- /rowItem -->';
					echo '<div class="rowItem col-sm-3 ' . esc_attr( BoldThemesFramework::$right_alignment_class )  . '">';
						echo '<dl class="btArticleMeta onBottom">';
						echo wp_kses_post( $meta_right_html );
						echo '</dl>';
					echo '</div><!-- /rowItem -->';
				echo '</div><!-- /boldRow -->';
			}
			
			if ( $media_html != '' ) {
				echo '<div class="boldRow boldRow topSmallSpaced bottomSmallSpaced">';
					echo '<div class="rowItem col-sm-12 btTextCenter btGridGap5">' . $media_html . '</div><!-- /rowItem -->';
				echo '</div><!-- /boldRow -->';
			}
			
			echo '<div class="boldRow">';
				echo '<div class="rowItem ' . esc_attr( BoldThemesFramework::$left_alignment_class )  . ' ' . esc_attr( $extra_class ) . '">';
					echo '<div class="boldArticleBody btArticleBody">' . $content_html . '</div>';
				echo '</div><!-- /rowItem -->';
				
				if ( ( $cf != '' && count( $cf ) > $data_items_split ) || ! boldthemes_get_option( 'hide_headline' ) ) {
					echo '<div class="rowItem col-sm-3 ' . esc_attr( BoldThemesFramework::$right_alignment_class )  . '">';
						echo '<dl class="btArticleMeta onBottom">';
						if ( ! boldthemes_get_option( 'hide_headline' ) ) {
							echo wp_kses_post( $cf_right_html );
						}
						for ( $i = $data_items_split; $i < count( $cf ); $i++ ) {
							$item = $cf[ $i ];
							$item_key = substr( $item, 0, strpos( $item, ':' ) );
							$item_value = substr( $item, strpos( $item, ':' ) + 1 );
							echo '<dt>' . $item_key . '</dt>';
							echo '<dd>' . $item_value . '</dd>';
						}
						echo '</dl>';
					echo '</div><!-- /rowItem -->';
				}
			echo '</div><!-- /boldRow -->';
			
			echo '<div class="boldRow bottomSmallSpaced">';
				echo '<div class="rowItem col-sm-12 ' . esc_attr( BoldThemesFramework::$right_alignment_class )  . ' btArticleShare">';
					echo '<div class="socialRow ">' . boldthemes_get_share_html( $permalink, 'pf', 'btIcoSmallSize', 'btIcoDefaultType btIcoDefaultColor' ) . '</div>';
				echo '</div><!-- /rowItem -->';
			echo '</div><!-- /boldRow >';
			
			echo '<div class="boldRow">';
				echo '<div class="rowItem col-sm-12 btLinkPages">';
					
				wp_link_pages( array( 
					'before'      => '<ul>' . esc_html__( 'Pages:', 'industrial' ),
					'separator'   => '<li>',
					'after'       => '</ul>'
				));
				
				echo '</div><!-- /rowItem -->';
			echo '</div><!-- /boldRow -->';
		echo '</div><!-- /port -->';
	echo '</article>';

?>