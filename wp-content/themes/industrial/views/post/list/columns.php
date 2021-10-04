<?php

	$blog_date_side = boldthemes_get_post_date( array( 'prefix' => '', 'suffix' => '' ) );

	$dash = $blog_use_dash ? 'bottom' : '';

	$meta_html = '';
	if ( ( $blog_author || $blog_date || $show_comments_number ) && ! $blog_side_info ) {
		$meta_html .= '';
		if ( $blog_date ) $meta_html .= boldthemes_get_post_date(); 
		if ( $show_comments_number ) $meta_html .= boldthemes_get_post_comments();
		if ( $blog_author ) $meta_html .= '<p class="btArticleListBodyAuthor">' . boldthemes_get_post_author() . '</p>' ;
	}
	
	if ( $blog_side_info && $show_comments_number ) {
		$categories_html .= boldthemes_get_post_comments();
	}

	if( boldthemes_get_option( 'sidebar' ) ) {
		$left_col_class = ' col-md-6 ';
		$right_col_class = ' col-md-6 ';
	} else {
		$left_col_class = ' col-md-6 ';
		$right_col_class = ' col-md-6 ';

	}
	
	echo '<article class="' . implode( ' ', get_post_class( $class_array ) ) . ' btBlogColumnView">';
		echo '<div class="port">';
			echo '<div class="boldCell">';

				echo '<div class = "boldRow bottomExtraSmallSpaced">';
					echo '<div class="rowItem col-sm-12">';
						echo '<div class="rowItemContent">';

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
									echo '<div class="asgItem date"><small>' . $blog_date_side . '</small></div>';
								}
								
								echo '</div>';
							}

							echo '<div class = "btArticleListBody">'; 
								echo '<div class = "boldRow">';
									if ( $media_html != '' ) {
										echo '<div class="rowItem ' . esc_attr( $left_col_class ) . ' btTextCenter"><div class="rowItemContent">' . $media_html . '</div></div>';
									}

									echo '<div class="rowItem ' . esc_attr( BoldThemesFramework::$left_alignment_class )  . ' ' . esc_attr( $right_col_class ) . '">';
										echo '<div class="rowItemContent">';
											echo boldthemes_get_heading_html( $categories_html, '<a href="' . esc_url_raw( $permalink ) . '">' . get_the_title() . '</a>', $meta_html , 'medium', $dash, '', '' );
											echo '<div class="btArticleListBodyContent">' . $content_final_html . '</div>';
											echo '<div class="btIconRow">' . boldthemes_get_share_html( $permalink, 'blog', 'btIcoExtraSmallSize', 'btIcoDefaultType btIcoDefaultColor' ) . '</div>';
										echo '</div><!-- /rowItemContent -->' ;
									echo '</div><!-- /rowItem -->';
								echo '</div><!-- /boldRow -->';
							echo '</div><!-- /btArticleListColumsBodyContent -->';
						
						echo '</div><!-- /rowItemContent -->';
					echo '</div><!-- /rowItem -->';
				echo '</div><!-- /boldRow -->';
			
			echo '</div><!-- boldCell -->';			
		echo '</div><!-- port -->';
	echo '</article><!-- /articles -->';

?>