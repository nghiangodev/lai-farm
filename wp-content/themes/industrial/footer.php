		</div><!-- /boldthemes_content -->
<?php

if ( BoldThemesFramework::$has_sidebar ) {
	echo '<aside class="btSidebar ' . esc_attr( BoldThemesFramework::$left_alignment_class )  . '">';
		dynamic_sidebar( 'primary_widget_area' );
	echo '</aside>';					
}

?> 
	</div><!-- /contentHolder -->
</div><!-- /contentWrap -->

<?php

$page_slug = boldthemes_get_option( 'footer_page_slug' );
if ( $page_slug != '' ) {
	$page_id = boldthemes_get_id_by_slug( $page_slug );
	$translated_page_id = $page_id;
	$translated_page_id = apply_filters( 'wpml_object_id', $page_id, 'page', TRUE );
	if ( ! is_null( $translated_page_id ) ) {
		$page = get_post( $translated_page_id );
		$content = $page->post_content;
		$content = apply_filters( 'the_content', $content );
		$content = preg_replace( '/data-edit_url="(.*?)"/s', 'data-edit_url="' . get_edit_post_link( $page_id, '' ) . '"', $content );
		echo str_replace( ']]>', ']]&gt;', $content );
	}
}

if ( boldthemes_get_option( 'footer_dark_skin' ) ) {
	echo '<footer class="btDarkSkin">';
} else {
	echo '<footer>';
}

$custom_text_html = '';
$custom_text = boldthemes_get_option( 'custom_text' );
if ( $custom_text != '' ) {
	$custom_text_html = '<p class="copyLine">' . $custom_text . '</p>';
}

if ( is_active_sidebar( 'footer_widgets' ) ) {
	echo '
	<section class="boldSection btSiteFooterWidgets gutter topSpaced bottomSemiSpaced btDoubleRowPadding">
		<div class="port">
			<div class="boldRow ' . esc_attr( BoldThemesFramework::$left_alignment_class ) . '" id="boldSiteFooterWidgetsRow">';
			dynamic_sidebar( 'footer_widgets' );
	echo '	
			</div>
		</div>
	</section>';
}

?>
<?php if ( $custom_text_html != '' || has_nav_menu( 'footer' )) { ?>
	<section class="boldSection gutter btSiteFooter btGutter">
		<div class="port">
			<div class="boldRow">
				<div class="rowItem btFooterCopy col-md-6 col-sm-12 <?php echo esc_attr( BoldThemesFramework::$left_alignment_class ) ?>">
					<?php echo wp_kses_post( $custom_text_html ); ?>
				</div><!-- /copy -->
				<div class="rowItem btFooterMenu col-md-6 col-sm-12 <?php echo esc_attr( BoldThemesFramework::$right_alignment_class ) ?>">
					<?php wp_nav_menu( array( 'theme_location' => 'footer', 'container' => 'ul', 'depth' => 1, 'fallback_cb' => false ) ); ?>
				</div>
			</div><!-- /boldRow -->
		</div><!-- /port -->
	</section>
<?php } ?>

</footer>

</div><!-- /pageWrap -->

<?php

wp_footer();

?>
</body>
</html>