<?php

if ( !is_null( boldthemes_get_id_by_slug('portfolio') ) && boldthemes_get_id_by_slug('portfolio') != '' ) {
	BoldThemesFramework::$page_for_header_id = boldthemes_get_id_by_slug( 'portfolio' );
}

get_header();

if ( have_posts() ) {
	
	while ( have_posts() ) {
	
		the_post();
		
		$images = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_images', 'type=image' );
		if ( $images == null ) $images = array();
		$video = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_video' );
		$audio = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_audio' );
		
		$link_title = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_link_title' );
		$link_url = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_link_url' );
		$quote = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_quote' );
		$quote_author = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_quote_author' );
		
		$permalink = get_permalink();
		
		$post_format = get_post_format();
	
		$media_html = '';
		
		if ( has_post_thumbnail() ) {
		
			$post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
			$img = wp_get_attachment_image_src( $post_thumbnail_id, 'large' );
			
			if ( $img != '' ) {
				$media_html = boldthemes_get_media_html( 'image', array( $permalink, $img[0] ) );
			}

		} else if ( count( $images ) == 1 ) {
		
			foreach ( $images as $img ) {
				$img = wp_get_attachment_image_src( $img['ID'], 'large' );
				$media_html = boldthemes_get_media_html( 'image', array( $permalink, $img[0] ) );
				break;
			}
			
		} else if ( count( $images ) > 1 ) {

			$images_ids = array();
			foreach ( $images as $img ) {
				$images_ids[] = $img['ID'];
			}			
			$media_html = boldthemes_get_media_html( 'gallery', array( $images_ids ) );
			
		} 
		
		if ( $video != '' ) {
			
			$media_html = boldthemes_get_media_html( 'video', array( $video ) );
			
		} else if ( $audio != '' ) {
			
			$media_html = boldthemes_get_media_html( 'audio', array( $audio ) );
			
		}
		
		$content_html = apply_filters( 'the_content', get_the_content( '', false ) );
		$content_html = str_replace( ']]>', ']]&gt;', $content_html );
		
		$categories = wp_get_post_terms( get_the_ID(), 'portfolio_category' );
		$categories_html = boldthemes_get_post_categories( array( 'categories' => $categories ) );

		if ( is_search() ) $share_html = '';
		
		$pf_use_dash = boldthemes_get_option( 'pf_use_dash' );
		
		$class_array = array( 'btArticleListItem', 'animate', 'animate-fadein', 'animate-moveup', 'btTextLeft', 'gutter' );
		
		if ( $media_html != '' ) $class_array[] = 'wPhoto';

		$content_final_html = get_post()->post_excerpt != '' ? '<p>' . esc_html( get_the_excerpt() ) . '</p>' : $content_html;

		include( get_template_directory() . '/views/portfolio/list/standard.php' );

	}
	
	boldthemes_pagination();
	
} else {
	if ( is_search() ) { ?>
		<article class="btNoSearchResults">
			<?php echo boldthemes_get_heading_html( esc_html__( 'We are sorry, no results for: ', 'industrial' ) . get_search_query(), '', "<a href='" . site_url() . "'>" . esc_html__( 'Back to homepage', 'industrial' )."</a>", 'extralarge', 'bottom', '', '' ) ?>
		</article>
	<?php }
}
 
?>

<?php

get_footer();

?>