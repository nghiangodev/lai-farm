<?php

class BoldThemesFramework {
	
	// vars
	
	public static $pfx = 'boldthemes_theme';
	public static $page_for_header_id;
	public static $date_format;
	public static $sidebar;
	public static $has_sidebar;
	public static $fonts;
	public static $customize_fonts;
	public static $meta_boxes = array();
	public static $crush_vars = array();
	public static $crush_vars_def = array();
	public static $left_alignment_class = 'btTextLeft';
	public static $right_alignment_class = 'btTextRight';

	public static $media_html;
	public static $media_position;
	public static $blog_side_info;
	public static $meta_html;
	public static $tags_html;
	public static $share_html;

	public static $hide_headline;
	public static $default_headline_content;
	public static $post_format;
	public static $content_excerpt_html;
	public static $blog_single_rating;
	public static $content_html;

	public static $blog_author_info;

	public static $class_array;

	public static $prev_next_html;

	public static $categories_html;
	public static $categories_html_single;

	public static $blog_dash;

	public static $permalink;
	public static $blog_use_dash;
	public static $date_author_html;
	public static $supertitle_html;
	public static $subtitle_html;
	public static $content_final_html;

	public static $media_is_feat;

	public static $cf;
	public static $cf_right_html;
	public static $full_title;
	public static $pf_dash;
	public static $data_items_split;
	public static $meta_right_html;

	public static $blog_next_prev;
	
	public static $author_url;
}

require_once( get_template_directory() . '/framework/actions.php' );
require_once( get_template_directory() . '/framework/filters.php' );

if ( file_exists( get_template_directory() . '/css-crush/CssCrush.php' ) ) {
	require_once( get_template_directory() . '/css-crush/CssCrush.php' );
} else {
	if ( ! class_exists( 'CssCrush\Functions' ) ) {
		require_once( get_template_directory() . '/framework/BTCrushFunctions.php' );
		require_once( get_template_directory() . '/framework/BTCrushUtil.php' );
		require_once( get_template_directory() . '/framework/BTCrushColor.php' );
		require_once( get_template_directory() . '/framework/BTCrushRegex.php' );
	}
}
require_once( get_template_directory() . '/framework/boldthemes_basic_functions.php' );
require_once( get_template_directory() . '/framework/boldthemes_functions.php' );
require_once( get_template_directory() . '/framework/sanitization.php' );
require_once( get_template_directory() . '/framework/customization.php' );
require_once( get_template_directory() . '/framework/editor-buttons/editor-buttons.php' );
require_once( get_template_directory() . '/framework/class-tgm-plugin-activation.php' );
require_once( get_template_directory() . '/framework/woocommerce_hooks.php' );
require_once( get_template_directory() . '/framework/woocommerce_functions.php' );

require_once( get_template_directory() . '/framework/config-meta-boxes.php' );