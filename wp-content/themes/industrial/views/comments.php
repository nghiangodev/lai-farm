<?php

	echo '<section class="boldSection gutter bottomSemiSpaced">';
		echo '<div class="port">';
			echo '<div class="boldRow">';
				echo '<div class="rowItem col-sm-12 ' . esc_attr( BoldThemesFramework::$left_alignment_class )  . '">';
									
				if ( comments_open() || get_comments_number() ) {
					echo '<div class="btClear btSeparator bottomSmallSpaced border"><hr></div>';
					comments_template();
				}

				echo '</div><!-- /rowItem -->';
			echo '</div><!-- /boldRow -->';
			echo '<div class="boldRow">';
				echo '<div class="rowItem col-sm-12">';
					echo '<div class="btClear btSeparator bottomMediumSpaced border"><hr></div>';
				echo '</div><!-- /rowItem -->';
			echo '</div><!-- /boldRow -->';
			echo '<div class="boldRow btNextPrevRow neighboringArticles bottomSmallSpaced">' . $prev_next_html . '</div><!-- /boldRow -->';
		echo '</div><!-- /port -->';
	echo '</section>';

?>