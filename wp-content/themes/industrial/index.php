<?php 

if ( get_option( 'page_for_posts' ) ) {
	BoldThemesFramework::$page_for_header_id = get_option( 'page_for_posts' );
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
			
		}
		
		if ( $post_format == 'image' ) {
		
			foreach ( $images as $img ) {
				$img = wp_get_attachment_image_src( $img['ID'], 'large' );
				$media_html = boldthemes_get_media_html( 'image', array( $permalink, $img[0] ) );
				break;
			}
			
		} else if ( $post_format == 'gallery' ) {
		
			if ( count( $images ) > 0 ) {
				$images_ids = array();
				foreach ( $images as $img ) {
					$images_ids[] = $img['ID'];
				}			
				$media_html = boldthemes_get_media_html( 'gallery', array( $images_ids ) );
			}
			
		} else if ( $post_format == 'video' ) {
			
			$media_html = boldthemes_get_media_html( 'video', array( $video ) );
			
		} else if ( $post_format == 'audio' ) {
			
			$media_html = boldthemes_get_media_html( 'audio', array( $audio ) );
			
		} else if ( $post_format == 'link' ) {
			
			$media_html = boldthemes_get_media_html( 'link', array( $link_url, $link_title ) );
			
		} else if ( $post_format == 'quote' ) {
			
			$media_html = boldthemes_get_media_html( 'quote', array( $quote, $quote_author ) );
			
		}
		
		$content_html = apply_filters( 'the_content', get_the_content( '', false ) );
		$content_html = str_replace( ']]>', ']]&gt;', $content_html );
		
		$categories_html = boldthemes_get_post_categories();
		
		if ( is_search() ) $share_html = '';
		
		$blog_author = boldthemes_get_option( 'blog_author' );
		$blog_date = boldthemes_get_option( 'blog_date' );		
		
		$blog_side_info = boldthemes_get_option( 'blog_side_info' );
		$blog_list_view = boldthemes_get_option( 'blog_list_view' );

		$blog_use_dash = boldthemes_get_option( 'blog_use_dash' );
		
		$class_array = array( 'btArticleListItem', 'animate', 'animate-fadein', 'animate-moveup', 'gutter' );
		
		if ( $blog_side_info ) $class_array[] = 'btHasAuthorInfo';
		if ( $media_html != '' ) $class_array[] = 'wPhoto';
		
		$author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );

		$comments_open = comments_open();
		$comments_number = get_comments_number();
		$show_comments_number = true;
		if ( ! $comments_open && $comments_number == 0 ) {
			$show_comments_number = false;
		}

		$post_type = get_post_type();
		
		$content_final_html = get_post()->post_excerpt != '' || is_search() ? '<p>' . esc_html( get_the_excerpt() ) . '</p>' : $content_html;

		if ( boldthemes_get_option( 'blog_list_view' ) == 'columns' ) {
			include( get_template_directory() . '/views/post/list/columns.php' );
		} else if (boldthemes_get_option( 'blog_list_view' ) == 'simple' ) {
			include( get_template_directory() . '/views/post/list/simple.php' );
		} else {
			include( get_template_directory() . '/views/post/list/standard.php' );
		}

	}
	
	boldthemes_pagination();
	
} else {
	if ( is_search() ) { ?>
		<article class="btNoSearchResults boldSection gutter bottomSemiSpaced topSemiSpaced ">
			<div class="port">
			<?php echo boldthemes_get_heading_html( '', esc_html__( 'We are sorry, no results for: ', 'industrial' ) . get_search_query(), '<a href="' . site_url() . '">' . esc_html__( 'Back to homepage', 'industrial' ) . '</a>', 'medium', '', '', '' ) ?>
			</div>
		</article>
	<?php }
}
 
?>

<?php

get_footer();

?>