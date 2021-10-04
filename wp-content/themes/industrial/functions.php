<?php

// Register action/filter callbacks

add_action( 'after_setup_theme', 'industrial_register_menus' );
add_action( 'wp_enqueue_scripts', 'industrial_enqueue_scripts_styles' );
add_action( 'tgmpa_register', 'industrial_register_plugins' );
add_action( 'wp_enqueue_scripts', 'industrial_load_fonts' );
add_action( 'admin_init', 'industrial_admin_init' );

add_theme_support( 'customize-selective-refresh-widgets' );

add_filter( 'body_class', 'industrial_body_classes' );

add_editor_style();

// callbacks

/**
 * Register navigation menus
 */
if ( ! function_exists( 'industrial_register_menus' ) ) {
	function industrial_register_menus() {
		register_nav_menus( array (
			'primary' => esc_html__( 'Primary Menu', 'industrial' ),
			'footer'  => esc_html__( 'Footer Menu', 'industrial' )
		));
	}
}

/**
 * Enqueue scripts and styles
 */
if ( ! function_exists( 'industrial_enqueue_scripts_styles' ) ) {
	function industrial_enqueue_scripts_styles() {
		
		BoldThemesFramework::$crush_vars_def = array( 'accentColor', 'alternateColor', 'bodyFont', 'menuFont', 'headingFont', 'headingSuperTitleFont', 'headingSubTitleFont', 'logoHeight' );

		// Create override file without local settings

		if ( function_exists( 'boldthemes_csscrush_file' ) ) {
			boldthemes_csscrush_file( get_stylesheet_directory() . '/style.crush.css', array( 'source_map' => true, 'minify' => false, 'output_file' => 'style', 'formatter' => 'block', 'boilerplate' => false, 'plugins' => array( 'loop', 'ease' ) ) );
		}

		//custom accent color and font style

		$accent_color = boldthemes_get_option( 'accent_color' );
		$alternate_color = boldthemes_get_option( 'alternate_color' );
		$body_font = urldecode( boldthemes_get_option( 'body_font' ) );
		$menu_font = urldecode( boldthemes_get_option( 'menu_font' ) );
		$heading_font = urldecode( boldthemes_get_option( 'heading_font' ) );
		$heading_supertitle_font = urldecode( boldthemes_get_option( 'heading_supertitle_font' ) );
		$heading_subtitle_font = urldecode( boldthemes_get_option( 'heading_subtitle_font' ) );
		$logo_height = urldecode( boldthemes_get_option( 'logo_height' ) );

		if ( $accent_color != '' ) {
			BoldThemesFramework::$crush_vars['accentColor'] = $accent_color;
		}

		if ( $alternate_color != '' ) {
			BoldThemesFramework::$crush_vars['alternateColor'] = $alternate_color;
		}

		if ( $body_font != 'no_change' ) {
			BoldThemesFramework::$crush_vars['bodyFont'] = $body_font;
		}

		if ( $menu_font != 'no_change' ) {
			BoldThemesFramework::$crush_vars['menuFont'] = $menu_font;
		}

		if ( $heading_font != 'no_change' ) {
			BoldThemesFramework::$crush_vars['headingFont'] = $heading_font;
		}

		if ( $heading_supertitle_font != 'no_change' ) {
			BoldThemesFramework::$crush_vars['headingSuperTitleFont'] = $heading_supertitle_font;
		}

		if ( $heading_subtitle_font != 'no_change' ) {
			BoldThemesFramework::$crush_vars['headingSubTitleFont'] = $heading_subtitle_font;
		}
		
		if ( $logo_height != '' ) {
			BoldThemesFramework::$crush_vars['logoHeight'] = $logo_height;
		}

		// custom theme css
		wp_enqueue_style( 'industrial-style', get_template_directory_uri() . '/style.css', array(), false, 'screen' );

		wp_enqueue_style( 'industrial-print', get_template_directory_uri() . '/print.css', array(), false, 'print' );
		
		// custom magnific popup css
		wp_enqueue_style( 'industrial-magnific-popup', get_template_directory_uri() . '/magnific-popup.css', array(), false, 'screen' );
		
		// third-party js
		wp_enqueue_script( 'slick-min', get_template_directory_uri() . '/framework/js/slick.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'jquery-magnific-popup-min', get_template_directory_uri() . '/framework/js/jquery.magnific-popup.min.js', array( 'jquery' ), '', true );
		if ( ! wp_is_mobile() ) wp_enqueue_script( 'iscroll', get_template_directory_uri() . '/framework/js/iscroll.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'fancySelect', get_template_directory_uri() . '/framework/js/fancySelect.js', array( 'jquery' ), '', true );			
		wp_enqueue_script( 'html5shiv-min', get_template_directory_uri() . '/framework/js/html5shiv.min.js', array(), true );
		wp_enqueue_script( 'respond-min', get_template_directory_uri() . '/framework/js/respond.min.js', array(), true );

		// custom miscellaneous js
		wp_enqueue_script( 'industrial-header-misc', get_template_directory_uri() . '/framework/js/header.misc.js', array( 'jquery' ), '', false );
		// custom tile hover effect js			
		wp_enqueue_script( 'industrial-misc', get_template_directory_uri() . '/framework/js/misc.js', array( 'jquery' ), '', true );
		// custom header related js
		wp_enqueue_script( 'industrial-dir-hover', get_template_directory_uri() . '/framework/js/dir.hover.js', array( 'jquery' ), '', true );
		wp_add_inline_script( 'industrial-header-misc', boldthemes_set_global_uri(), 'before' );
		// custom slider js
		wp_enqueue_script( 'industrial-sliders', get_template_directory_uri() . '/framework/js/sliders.js', array( 'jquery' ), '', true );
		// custom parallax js
		wp_enqueue_script( 'industrial-bt-parallax', get_template_directory_uri() . '/framework/js/bt_parallax.js', array( 'jquery' ), '', true );

		// dequeue cost calculator plugin style
		wp_dequeue_style( 'bt_cc_style' );
		
		if ( file_exists( get_template_directory() . '/css-override.php' ) ) {
			require_once( get_template_directory() . '/css-override.php' );
			if ( count( BoldThemesFramework::$crush_vars ) > 0 ) wp_add_inline_style( 'industrial-style', $css_override );
		}
		
		if ( boldthemes_get_option( 'custom_css' ) != '' ) {
			wp_add_inline_style( 'industrial-style', boldthemes_get_option( 'custom_css' ) );
		}

		if ( boldthemes_get_option( 'custom_js_top' ) != '' ) {
			wp_add_inline_script( 'industrial-header-misc', boldthemes_get_option( 'custom_js_top' ) );
		}

		if ( boldthemes_get_option( 'custom_js_bottom' ) != '' ) {
			wp_add_inline_script( 'industrial-misc', boldthemes_get_option( 'custom_js_bottom' ) );
		}		
		
	}
}

/**
 * Register the required plugins for this theme
 */
if ( ! function_exists( 'industrial_register_plugins' ) ) {
	function industrial_register_plugins() {

		$plugins = array(
	 
			array(
				'name'               => esc_html__( 'Industrial', 'industrial' ), // The plugin name.
				'slug'               => 'industrial', // The plugin slug (typically the folder name).
				'source'             => get_template_directory() . '/plugins/industrial.zip', // The plugin source.
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'version'            => '1.4.0', ///!do not change this comment! E.g. 1.0.0. If set, the active plugin must be this version or higher.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			),
			array(
				'name'               => esc_html__( 'Cost Calculator', 'industrial' ), // The plugin name.
				'slug'               => 'bt' . '_cost_calculator', // The plugin slug (typically the folder name).
				'source'             => get_template_directory() . '/plugins/' . 'bt' . '_cost_calculator.zip', // The plugin source.
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'version'            => '2.3.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			),
			array(
				'name'               => esc_html__( 'Bold Builder', 'industrial' ), // The plugin name.
				'slug'               => 'bold-page-builder', // The plugin slug (typically the folder name).
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			),
			array(
				'name'               => esc_html__( 'BoldThemes WordPress Importer', 'industrial' ), // The plugin name.
				'slug'               => 'bt' . '_wordpress_importer', // The plugin slug (typically the folder name).
				'source'             => get_template_directory() . '/plugins/' . 'bt' . '_wordpress_importer.zip', // The plugin source.
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'version'            => '1.0.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			),
			array(
				'name'               => esc_html__( 'Meta Box', 'industrial' ), // The plugin name.
				'slug'               => 'meta-box', // The plugin slug (typically the folder name).
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			),
			array(
				'name'               => esc_html__( 'Contact Form 7', 'industrial' ), // The plugin name.
				'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			),
			array(
				'name'               => esc_html__( 'WooSidebars', 'industrial' ), // The plugin name.
				'slug'               => 'woosidebars', // The plugin slug (typically the folder name).
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			),
			array(
				'name'               => esc_html__( 'WordPress Charts and Graphs', 'industrial' ), // The plugin name.
				'slug'               => 'visualizer', // The plugin slug (typically the folder name).
				'required'           => false, // If false, the plugin is only 'recommended' instead of required.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			)
		);
	 
		$config = array(
			'default_path' => '',                      // Default absolute path to pre-packaged plugins.
			'menu'         => 'tgmpa-install-plugins', // Menu slug.
			'has_notices'  => true,                    // Show admin notices or not.
			'dismissable'  => false,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,                   // Automatically activate plugins after installation or not.
			'message'      => '',                      // Message to output right before the plugins table.
			'strings'      => array(
				'page_title'                      => esc_html__( 'Install Required Plugins', 'industrial' ),
				'menu_title'                      => esc_html__( 'Install Plugins', 'industrial' ),
				'installing'                      => esc_html__( 'Installing Plugin: %s', 'industrial' ), // %s = plugin name.
				'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'industrial' ),
				'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'industrial' ), // %1$s = plugin name(s).
				'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'industrial' ), // %1$s = plugin name(s).
				'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'industrial' ), // %1$s = plugin name(s).
				'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'industrial' ), // %1$s = plugin name(s).
				'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'industrial' ), // %1$s = plugin name(s).
				'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'industrial' ), // %1$s = plugin name(s).
				'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'industrial' ), // %1$s = plugin name(s).
				'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'industrial' ), // %1$s = plugin name(s).
				'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'industrial' ),
				'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'industrial' ),
				'return'                          => esc_html__( 'Return to Required Plugins Installer', 'industrial' ),
				'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'industrial' ),
				'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s', 'industrial' ), // %s = dashboard link.
				'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
			)
		);
	 
		tgmpa( $plugins, $config );
	 
	}
}

/**
 * Loads custom Google Fonts
 */
if ( ! function_exists( 'industrial_load_fonts' ) ) {
	function industrial_load_fonts() {
		$body_font = urldecode( boldthemes_get_option( 'body_font' ) );
		$heading_font = urldecode( boldthemes_get_option( 'heading_font' ) );
		$menu_font = urldecode( boldthemes_get_option( 'menu_font' ) );
		$heading_subtitle_font = urldecode( boldthemes_get_option( 'heading_subtitle_font' ) );
		$heading_supertitle_font = urldecode( boldthemes_get_option( 'heading_supertitle_font' ) );
		
		$font_families = array();
		
		if ( $body_font != 'no_change' ) {
			$font_families[] = $body_font . ':100,200,300,400,500,600,700,800,900,100italic,200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic';
		} else {
			/*
			Translators: If there are characters in your language that are not supported
			by chosen font(s), translate this to 'off'. Do not translate into your own language.
			 */
			if ( 'off' !== _x( 'on', 'Roboto font: on or off', 'industrial' ) ) {
				$font_families[] = 'Roboto' . ':100,200,300,400,500,600,700,800,900,100italic,200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic';
			}
		}
		
		if ( $heading_font != 'no_change' ) {
			$font_families[] = $heading_font . ':100,200,300,400,500,600,700,800,900,100italic,200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic';
		} else {
			/*
			Translators: If there are characters in your language that are not supported
			by chosen font(s), translate this to 'off'. Do not translate into your own language.
			 */
			if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'industrial' ) ) {
				$font_families[] = 'Montserrat' . ':100,200,300,400,500,600,700,800,900,100italic,200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic';
			}
		}
		
		if ( $menu_font != 'no_change' ) {
			$font_families[] = $menu_font . ':100,200,300,400,500,600,700,800,900,100italic,200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic';
		} else {
			/*
			Translators: If there are characters in your language that are not supported
			by chosen font(s), translate this to 'off'. Do not translate into your own language.
			 */
			if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'industrial' ) ) {
				$font_families[] = 'Montserrat' . ':100,200,300,400,500,600,700,800,900,100italic,200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic';
			}
		}

		if ( $heading_subtitle_font != 'no_change' ) {
			$font_families[] = $heading_subtitle_font . ':100,200,300,400,500,600,700,800,900,100italic,200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic';
		} else {
			/*
			Translators: If there are characters in your language that are not supported
			by chosen font(s), translate this to 'off'. Do not translate into your own language.
			 */
			if ( 'off' !== _x( 'on', 'Roboto font: on or off', 'industrial' ) ) {
				$font_families[] = 'Roboto' . ':100,200,300,400,500,600,700,800,900,100italic,200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic';
			}
		}

		if ( $heading_supertitle_font != 'no_change' ) {
			$font_families[] = $heading_supertitle_font . ':100,200,300,400,500,600,700,800,900,100italic,200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic';
		} else {
			/*
			Translators: If there are characters in your language that are not supported
			by chosen font(s), translate this to 'off'. Do not translate into your own language.
			 */
			if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'industrial' ) ) {
				$font_families[] = 'Montserrat' . ':100,200,300,400,500,600,700,800,900,100italic,200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic';
			}
		}

		if ( count( $font_families ) > 0 ) {
			$query_args = array(
				'family' => urlencode( implode( '|', $font_families ) ),
				'subset' => urlencode( 'latin,latin-ext' ),
			);
			$font_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
			wp_enqueue_style( 'industrial-fonts', $font_url, array(), '1.0.0' );
		}
	}
}

if ( ! function_exists( 'industrial_admin_init' ) ) {
	function industrial_admin_init() {
		if ( function_exists( 'boldthemes_csscrush_file' ) ) {
			boldthemes_csscrush_file( get_stylesheet_directory() . '/editor-style.crush.css', array( 'source_map' => true, 'minify' => false, 'output_file' => 'editor-style', 'formatter' => 'block', 'boilerplate' => false, 'plugins' => array( 'loop', 'ease' ) ) );
		}
	}
}

/**
 * body classes
 */
if ( ! function_exists( 'industrial_body_classes' ) ) {
	function industrial_body_classes( $classes ) {
		return array_merge( $classes, boldthemes_get_body_class() );
	}
}

// set content width
if ( ! isset( $content_width ) ) {
	$content_width = 1200;
}

require_once( get_template_directory() . '/php/before_framework.php' );

require_once( get_template_directory() . '/framework/framework.php' );

require_once( get_template_directory() . '/php/after_framework.php' );