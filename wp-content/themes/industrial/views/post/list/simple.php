<?php

	$share_html = '<div class="btIconRow">' . boldthemes_get_share_html( $permalink, 'blog', 'btIcoExtraSmallSize', 'btIcoDefaultType btIcoDefaultColor' ) . '</div>';

	$blog_date_side = boldthemes_get_post_date( array( 'prefix' => '', 'suffix' => '' ) );
	
	$dash = '';

	$meta_html = '';
	if ( $blog_author || $blog_date || $show_comments_number ) {
		$meta_html .= '';
		if ( $blog_date && ! $blog_side_info ) $meta_html .= boldthemes_get_post_date();
		if ( $blog_date && $blog_side_info ) $categories_html .= boldthemes_get_post_date();
		if ( $blog_author ) $categories_html .= boldthemes_get_post_author();
		if ( $show_comments_number ) $categories_html .= boldthemes_get_post_comments();
	}
	
	$l_class = esc_attr( BoldThemesFramework::$left_alignment_class )  . ' ' . ' col-sm-3';
	$r_class = 'col-sm-9';
	
	if ( $blog_side_info != '' ) {
		$l_class = 'btTextCenter col-sm-2';
		$r_class = 'col-sm-10';
	}

	echo '<article class="' . implode( ' ', get_post_class( $class_array ) ) . ' btBlogSimpleView">';
		echo '<div class="port">';
			echo '<div class="boldCell">';
				echo '<div class = "boldRow bottomSmallSpaced">';
					echo '<div class="rowItem ' . $l_class . ' btBlogSimpleViewCategories">';
					if ( $meta_html != '' ) echo boldthemes_get_heading_html( $meta_html, '', '', 'large', '', '', '' );
					if ( $blog_side_info ) {
						echo '<div class="simpleArticleSideGutter">';
						$avatar_html = get_avatar( get_the_author_meta( 'ID' ), 144 ); 					
						if ( $avatar_html != '' ) {
							echo '<div class="asgItem avatar"><a href="' . esc_url_raw( $author_url ) . '">' . $avatar_html . '</a></div>';
						}					
						echo '</div>';
					}
					echo '</div>';
					echo '<div class="rowItem ' . esc_attr( BoldThemesFramework::$left_alignment_class )  . ' ' . $r_class . ' ">';
						echo '<div class="rowItemContent">';
							echo boldthemes_get_heading_html( $categories_html, '<a href="' . esc_url_raw( $permalink ) . '">' . get_the_title() . '</a>', '', 'large', $dash, '', '' );
						echo '</div>' ;
					echo '</div>';

				echo '</div><!-- /boldRow -->';
			echo '</div><!-- boldCell -->';			
		echo '</div><!-- port -->';
	echo '</article><!-- /articles -->';