<?php
if ( ! class_exists( 'BoldThemes_Customize_Default' ) ) {
  
	class BoldThemes_Customize_Default {

		public static $data = array(
		
			// GENERAL SETTINGS
			
			'logo'                       => '',
			'alt_logo'                   => '',
			'accent_color'               => '',
			'alternate_color'            => '',
			'page_background'            => '',
			'hide_headline'              => false,
			'template_skin'              => false,
			'sidebar'                    => 'right',
			'sidebar_use_dash'           => true,
			'disable_preloader'          => true,
			'preloader_text'             => '',
			'autoplay_interval'          => '',
			'custom_css'                 => '',
			'custom_js_top'              => '',
			'custom_js_bottom'           => '',
			
			// HEADER AND FOOTER
			
			'logo_height'               => '',
			'menu_type'                 => 'hRight',
			'boxed_menu'                => true,
			'page_width'                => false,
			'header_style'				=> 'no_change',
			'below_menu'                => false,
			'top_tools_in_menu'         => false,
			'sticky_header'             => false,
			'hide_menu'                 => false,
			'footer_dark_skin'          => false,
			'custom_text'               => '',
			'footer_page_slug'          => '',
			
			// TYPOGRAPHY
			
			'body_font'                 => 'no_change',
			'heading_font'              => 'no_change',
			'heading_supertitle_font'   => 'no_change',
			'heading_subtitle_font'     => 'no_change',
			'menu_font'                 => 'no_change',
			'buttons_shape' 			=> 'no_change',
			
			// BLOG
			
			'blog_ghost_slider'         => false,
			'blog_grid_gallery_columns' => '3',
			'blog_grid_gallery_gap'     => '40',
			'blog_list_view'            => 'standard',
			'blog_single_view'          => 'standard',
			'blog_author'               => true,
			'blog_date'                 => true,
			'blog_side_info'            => false,
			'blog_author_info'          => false,
		    'blog_share_facebook'       => true,
		    'blog_share_twitter'        => true,
		    'blog_share_linkedin'       => true,
		    'blog_share_vk'             => true,
		    'blog_share_whatsapp'       => true,
		    'blog_use_dash'             => true,
		    'sticky_in_grid'            => false,
		    'blog_settings_page_slug'   => '',
			'blog_next_prev'            => true,
			'blog_square_avatar'        => false,
			
			// PORTFOLIO
			
			'pf_ghost_slider'           => true,
			'pf_grid_gallery_columns'   => '4',
			'pf_grid_gallery_gap'       => '40',
			'pf_single_view'            => 'standard',
			'pf_share_facebook'         => true,
			'pf_share_twitter'          => true,
			'pf_share_linkedin'         => true,
			'pf_share_vk'               => true,
			'pf_share_whatsapp'         => true,
			'pf_use_dash'               => true,
			'pf_settings_page_slug'     => '',

			// SHOP
			
			'shop_share_facebook'       => true,
			'shop_share_twitter'        => true,
			'shop_share_linkedin'       => true,
			'shop_share_vk'             => true,
			'shop_share_whatsapp'       => true,
			'shop_use_dash'             => true,
			'shop_settings_page_slug'   => ''	
		
		);
	}
}

if ( ! function_exists( 'boldthemes_custom_controls' ) ) {
	function boldthemes_custom_controls() {
		class BoldThemes_Customize_Textarea_Control extends WP_Customize_Control {
			public function render_content() {
				?>
				<label>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<textarea rows="5" style="width:98%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value()); ?></textarea>
				</label>
				<?php
			}
		}
		
		class BoldThemes_Reset_Control extends WP_Customize_Control {
			public function render_content() {
				?>
				<div style="margin: 5px 0px 10px 0px">
				<label><span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span></label>			
					<input type="submit" onclick="var c = confirm('<?php echo esc_js( esc_html__( 'Reset theme settings to default values?', 'industrial' ) ); ?>'); if (c != true) return false;var href=window.location.href;if (href.indexOf('?') > -1) {window.location.replace(href + '&boldthemes_reset=reset')} else {window.location.replace(href + '?boldthemes_reset=reset')};return false;" name="boldthemes_reset" id="boldthemes_reset" class="button" value="Reset">
				</div>
				<?php
			}
		}
	}
}
add_action( 'customize_register', 'boldthemes_custom_controls' );

if ( ! function_exists( 'boldthemes_js_bottom' ) ) {
	function boldthemes_js_bottom() {
		$j = boldthemes_get_option( 'custom_js_bottom' );
		wp_register_script( 'bt-js-bottom-script', '' );
		wp_enqueue_script( 'bt-js-bottom-script' );
		wp_add_inline_script( 'bt-js-bottom-script', '' . wp_kses_post( $j ) . '' );
	}
}

if ( ! function_exists( 'boldthemes_custom_text' ) ) {
	function boldthemes_custom_text( $text ) {
		return $text;
	}
}

if ( ! function_exists( 'boldthemes_custom_js' ) ) {
	function boldthemes_custom_js( $js ) {
		return trim( $js );
	}
}

if ( ! function_exists( 'boldthemes_customize_register' ) ) {
	function boldthemes_customize_register( $wp_customize ) {
		
		global $wpdb;
		
		if ( isset( $_GET['boldthemes_reset'] ) && $_GET['boldthemes_reset'] == 'reset' ) {
			$wpdb->query( 'delete from ' . $wpdb->options . ' where option_name = "' . BoldThemesFramework::$pfx . '_theme_options"' );
			header( 'Location: ' . wp_customize_url());
		}

		$wp_customize->remove_section( 'colors' );
		
		$wp_customize->add_section( BoldThemesFramework::$pfx . '_general_section' , array(
			'title'      => esc_html__( 'General Settings', 'industrial' ),
			'priority'   => 10,
		));
		$wp_customize->add_section( BoldThemesFramework::$pfx . '_header_footer_section' , array(
			'title'      => esc_html__( 'Header and Footer', 'industrial' ),
			'priority'   => 20,
		));
		$wp_customize->add_section( BoldThemesFramework::$pfx . '_typo_section' , array(
			'title'      => esc_html__( 'Typography', 'industrial' ),
			'priority'   => 30,
		));
		$wp_customize->add_section( BoldThemesFramework::$pfx . '_blog_section' , array(
			'title'      => esc_html__( 'Blog', 'industrial' ),
			'priority'   => 40,
		));
		$wp_customize->add_section( BoldThemesFramework::$pfx . '_pf_section' , array(
			'title'      => esc_html__( 'Portfolio', 'industrial' ),
			'priority'   => 50,
		));
		$wp_customize->add_section( BoldThemesFramework::$pfx . '_shop_section' , array(
			'title'      => esc_html__( 'Shop', 'industrial' ),
			'priority'   => 60,
		));

		require_once( get_template_directory() . '/framework/web_fonts.php' );
	}
}
add_action( 'customize_register', 'boldthemes_customize_register' );


/* GENERAL SETTINGS */

// LOGO
if ( ! function_exists( 'boldthemes_customize_logo' ) ) {
	function boldthemes_customize_logo( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[logo]', array(
			'default'           => BoldThemes_Customize_Default::$data['logo'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_image'
		));
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo', array(
			'label'    => esc_html__( 'Logo', 'industrial' ),
			'section'  => BoldThemesFramework::$pfx . '_general_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[logo]',
			'priority' => 20,
			'context'  => BoldThemesFramework::$pfx . '_logo'
		)));
	}
}
add_action( 'customize_register', 'boldthemes_customize_logo' );

// ALTERNATE LOGO
if ( ! function_exists( 'boldthemes_customize_alt_logo' ) ) {
	function boldthemes_customize_alt_logo( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[alt_logo]', array(
			'default'           => BoldThemes_Customize_Default::$data['alt_logo'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_image'
		));
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'alt_logo', array(
			'label'    => esc_html__( 'Alternate Logo', 'industrial' ),
			'section'  => BoldThemesFramework::$pfx . '_general_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[alt_logo]',
			'priority' => 22,
			'context'  => BoldThemesFramework::$pfx . '_alt_logo'
		)));
	}
}
add_action( 'customize_register', 'boldthemes_customize_alt_logo' );

// ACCENT COLOR
if ( ! function_exists( 'boldthemes_customize_accent_color' ) ) {
	function boldthemes_customize_accent_color( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[accent_color]', array(
			'default'        	   => BoldThemes_Customize_Default::$data['accent_color'],
			'type'           	   => 'option',
			'capability'     	   => 'edit_theme_options',
			'sanitize_callback'    => 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_color', array(
			'label'    => esc_html__( 'Primary Accent Color', 'industrial' ),
			'section'  => BoldThemesFramework::$pfx . '_general_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[accent_color]',
			'priority' => 26,
			'context'  => BoldThemesFramework::$pfx . '_accent_color'
		)));
	}
}
add_action( 'customize_register', 'boldthemes_customize_accent_color' );

// ALTERNATE COLOR
if ( ! function_exists( 'boldthemes_customize_alternate_color' ) ) {
	function boldthemes_customize_alternate_color( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[alternate_color]', array(
			'default'        	   => BoldThemes_Customize_Default::$data['alternate_color'],
			'type'           	   => 'option',
			'capability'     	   => 'edit_theme_options',
			'sanitize_callback'    => 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'alternate_color', array(
			'label'    => esc_html__( 'Secondary Accent Color', 'industrial' ),
			'section'  => BoldThemesFramework::$pfx . '_general_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[alternate_color]',
			'priority' => 26,
			'context'  => BoldThemesFramework::$pfx . 'alternate_color'
		)));
	}
}
add_action( 'customize_register', 'boldthemes_customize_alternate_color' );

// PAGE BACKGROUND
if ( ! function_exists( 'boldthemes_customize_page_background' ) ) {
	function boldthemes_customize_page_background( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[page_background]', array(
			'default'           => BoldThemes_Customize_Default::$data['page_background'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_image'
		));
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'page_background', array(
			'label'    => esc_html__( 'Page Background', 'industrial' ),
			'section'  => BoldThemesFramework::$pfx . '_general_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[page_background]',
			'priority' => 27,
			'context'  => BoldThemesFramework::$pfx . '_page_background'
		)));
	}
}
add_action( 'customize_register', 'boldthemes_customize_page_background' );

// BOXED PAGE

BoldThemes_Customize_Default::$data['page_width'] = 'no_change';

if ( ! function_exists( 'boldthemes_customize_page_width' ) ) {
	function boldthemes_customize_page_width( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[page_width]', array(
			'default'           => BoldThemes_Customize_Default::$data['page_width'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'page_width', array(
			'label'     => esc_html__( 'Page Width', 'industrial' ),
			'section'   => BoldThemesFramework::$pfx . '_general_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[page_width]',
			'priority'  => 95,
			'type'      => 'select',
			'choices'   => array(
				'no_change'       => esc_html__( 'Default', 'industrial' ),
				'btBoxedPage' 	=> esc_html__( 'Boxed', 'industrial' )	
			)
		));
	}
}

add_action( 'customize_register', 'boldthemes_customize_page_width' );

// HEADER STYLE

BoldThemes_Customize_Default::$data['header_style'] = 'no_change';

if ( ! function_exists( 'boldthemes_customize_header_style' ) ) {
	function boldthemes_customize_header_style( $wp_customize ) {
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[header_style]', array(
			'default'           => BoldThemes_Customize_Default::$data['header_style'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'header_style', array(
			'label'     => esc_html__( 'Header Style', 'industrial' ),
			'section'   => BoldThemesFramework::$pfx . '_header_footer_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[header_style]',
			'priority'  => 62,
			'type'      => 'select',
			'choices'   => array(
				'no_change'       => esc_html__( 'Default', 'industrial' ),
				'btAccentDarkHeader' => esc_html__( 'Accent + Dark', 'industrial' ),
				'btAccentLightHeader' => esc_html__( 'Accent + Light', 'industrial' )	
			)
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_header_style' );

// HIDE HEADLINE
if ( ! function_exists( 'boldthemes_customize_hide_headline' ) ) {
	function boldthemes_customize_hide_headline( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[hide_headline]', array(
				'default'           => BoldThemes_Customize_Default::$data['hide_headline'],
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'boldthemes_sanitize_checkbox'
		));
		$wp_customize->add_control( 'hide_headline', array(
				'label'    => esc_html__( 'Hide Default Headline', 'industrial' ),
				'section'  => BoldThemesFramework::$pfx . '_general_section',
				'settings' => BoldThemesFramework::$pfx . '_theme_options[hide_headline]',
				'priority' => 64,
				'type'     => 'checkbox'
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_hide_headline' );

// TEMPLATE SKIN
if ( ! function_exists( 'boldthemes_customize_template_skin' ) ) {
	function boldthemes_customize_template_skin( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[template_skin]', array(
			'default'           => BoldThemes_Customize_Default::$data['template_skin'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_checkbox'
		));
		$wp_customize->add_control( 'template_skin', array(
			'label'    => esc_html__( 'Use Dark Skin', 'industrial' ),
			'section'  => BoldThemesFramework::$pfx . '_general_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[template_skin]',
			'priority' => 80,
			'type'     => 'checkbox'
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_template_skin' );

// SIDEBAR
if ( ! function_exists( 'boldthemes_customize_sidebar' ) ) {
	function boldthemes_customize_sidebar( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[sidebar]', array(
			'default'           => BoldThemes_Customize_Default::$data['sidebar'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'sidebar', array(
			'label'     => esc_html__( 'Sidebar', 'industrial' ),
			'section'   => BoldThemesFramework::$pfx . '_general_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[sidebar]',
			'priority'  => 93,
			'type'      => 'select',
			'choices'   => array(
				'no_sidebar' => esc_html__( 'No Sidebar', 'industrial' ),
				'left'       => esc_html__( 'Left', 'industrial' ),
				'right'      => esc_html__( 'Right', 'industrial' )
			)
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_sidebar' );

// USE DASH SIDEBAR
if ( ! function_exists( 'boldthemes_customize_sidebar_use_dash' ) ) {
	function boldthemes_customize_sidebar_use_dash( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[sidebar_use_dash]', array(
			'default'           => BoldThemes_Customize_Default::$data['sidebar_use_dash'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_checkbox'
		));
		$wp_customize->add_control( 'sidebar_use_dash', array(
			'label'    => esc_html__( 'Use Dash in Sidebar Widgets', 'industrial' ),
			'section'  => BoldThemesFramework::$pfx . '_general_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[sidebar_use_dash]',
			'priority' => 98,
			'type'     => 'checkbox'
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_sidebar_use_dash' );

// DISABLE PRELOADER
if ( ! function_exists( 'boldthemes_customize_disable_preloader' ) ) {
	function boldthemes_customize_disable_preloader( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[disable_preloader]', array(
			'default'           => BoldThemes_Customize_Default::$data['disable_preloader'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_checkbox'
		));
		$wp_customize->add_control( 'disable_preloader', array(
			'label'    => esc_html__( 'Disable Preloader', 'industrial' ),
			'section'  => BoldThemesFramework::$pfx . '_general_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[disable_preloader]',
			'priority' => 101,
			'type'     => 'checkbox'
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_disable_preloader' );

// PRELOADER TEXT
if ( ! function_exists( 'boldthemes_customize_preloader_text' ) ) {
	function boldthemes_customize_preloader_text( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[preloader_text]', array(
			'default'           => BoldThemes_Customize_Default::$data['preloader_text'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'preloader_text', array(
			'label'    => esc_html__( 'Preloader Text', 'industrial' ),
			'section'  => BoldThemesFramework::$pfx . '_general_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[preloader_text]',
			'priority' => 102,
			'type'     => 'text'
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_preloader_text' );

// AUTOPLAY INTERVAL
if ( ! function_exists( 'boldthemes_customize_autoplay_interval' ) ) {
	function boldthemes_customize_autoplay_interval( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[autoplay_interval]', array(
			'default'           => BoldThemes_Customize_Default::$data['autoplay_interval'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'autoplay_interval', array(
			'label'    => esc_html__( 'Fullscreen Animations Autoplay Interval (ms)', 'industrial' ),
			'section'  => BoldThemesFramework::$pfx . '_general_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[autoplay_interval]',
			'priority' => 103,
			'type'     => 'text'
		));	
	}
}
add_action( 'customize_register', 'boldthemes_customize_autoplay_interval' );

// CUSTOM CSS
if ( ! function_exists( 'boldthemes_customize_custom_css' ) ) {
	function boldthemes_customize_custom_css( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[custom_css]', array(
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( new BoldThemes_Customize_Textarea_Control( 
			$wp_customize, 
			'custom_css', array(
				'label'    => esc_html__( 'Custom CSS', 'industrial' ),
				'section'  => BoldThemesFramework::$pfx . '_general_section',
				'priority' => 104,
				'settings' => BoldThemesFramework::$pfx . '_theme_options[custom_css]'
			)
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_custom_css' );

// RESET
if ( ! function_exists( 'boldthemes_customize_reset' ) ) {
	function boldthemes_customize_reset( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[reset]', array(
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( new BoldThemes_Reset_Control( $wp_customize, 'reset', array(
			'label'    => esc_html__( 'Reset Theme Settings', 'industrial' ),
			'section'  => BoldThemesFramework::$pfx . '_general_section',
			'priority' => 150,
			'settings' => BoldThemesFramework::$pfx . '_theme_options[reset]'
		)));
	}
}
add_action( 'customize_register', 'boldthemes_customize_reset' );


/* HEADER AND FOOTER */

// LOGO HEIGHT
if ( ! function_exists( 'boldthemes_customize_logo_height' ) ) {
	function boldthemes_customize_logo_height( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[logo_height]', array(
			'default'           => BoldThemes_Customize_Default::$data['logo_height'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'logo_height', array(
			'label'    => esc_html__( 'Logo Height (in px)', 'industrial' ),
			'section'  => BoldThemesFramework::$pfx . '_header_footer_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[logo_height]',
			'priority' => 50,
			'type'     => 'text'
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_logo_height' );

// MENU TYPE
if ( ! function_exists( 'boldthemes_customize_menu_type' ) ) {
	function boldthemes_customize_menu_type( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[menu_type]', array(
			'default'           => BoldThemes_Customize_Default::$data['menu_type'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'menu_type', array(
			'label'     => esc_html__( 'Menu Type', 'industrial' ),
			'section'   => BoldThemesFramework::$pfx . '_header_footer_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[menu_type]',
			'priority'  => 60,
			'type'      => 'select',
			'choices'   => array(
				'hLeft'       => esc_html__( 'Horizontal Left', 'industrial' ),
				'hCenter'     => esc_html__( 'Horizontal Centered', 'industrial' ),
				'hRight'      => esc_html__( 'Horizontal Right', 'industrial' ),
				'hLeftBelow'  => esc_html__( 'Horizontal Left Below Logo', 'industrial' ),
				'hRightBelow' => esc_html__( 'Horizontal Right Below Logo', 'industrial' ),
				'vLeft'       => esc_html__( 'Vertical Left', 'industrial' ),
				'vRight'      => esc_html__( 'Vertical Right', 'industrial' )
			)
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_menu_type' );

// BOXED MENU
if ( ! function_exists( 'boldthemes_customize_boxed_menu' ) ) {
	function boldthemes_customize_boxed_menu( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[boxed_menu]', array(
			'default'           => BoldThemes_Customize_Default::$data['boxed_menu'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_checkbox'
		));
		$wp_customize->add_control( 'boxed_menu', array(
			'label'    => esc_html__( 'Boxed Menu', 'industrial' ),
			'section'  => BoldThemesFramework::$pfx . '_header_footer_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[boxed_menu]',
			'priority' => 65,
			'type'     => 'checkbox'
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_boxed_menu' );

// BELOW MENU
if ( ! function_exists( 'boldthemes_customize_below_menu' ) ) {
	function boldthemes_customize_below_menu( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[below_menu]', array(
			'default'           => BoldThemes_Customize_Default::$data['below_menu'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_checkbox'
		));
		$wp_customize->add_control( 'below_menu', array(
			'label'    => esc_html__( 'Show Content Below Menu', 'industrial' ),
			'section'  => BoldThemesFramework::$pfx . '_header_footer_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[below_menu]',
			'priority' => 70,
			'type'     => 'checkbox'
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_below_menu' );

// TOP TOOLS IN MENU AREA
if ( ! function_exists( 'boldthemes_customize_top_tools_in_menu' ) ) {
	function boldthemes_customize_top_tools_in_menu( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[top_tools_in_menu]', array(
			'default'           => BoldThemes_Customize_Default::$data['top_tools_in_menu'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_checkbox'
		));
		$wp_customize->add_control( 'top_tools_in_menu', array(
			'label'    => esc_html__( 'Show Top Right Widgets in Menu Area', 'industrial' ),
			'section'  => BoldThemesFramework::$pfx . '_header_footer_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[top_tools_in_menu]',
			'priority' => 70,
			'type'     => 'checkbox'
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_top_tools_in_menu' );

// STICKY HEADER
if ( ! function_exists( 'boldthemes_customize_sticky_header' ) ) {
	function boldthemes_customize_sticky_header( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[sticky_header]', array(
			'default'           => BoldThemes_Customize_Default::$data['sticky_header'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_checkbox'
		));
		$wp_customize->add_control( 'sticky_header', array(
			'label'    => esc_html__( 'Use Sticky Header', 'industrial' ),
			'section'  => BoldThemesFramework::$pfx . '_header_footer_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[sticky_header]',
			'priority' => 80,
			'type'     => 'checkbox'
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_sticky_header' );

// HIDE MENU
if ( ! function_exists( 'boldthemes_customize_hide_menu' ) ) {
	function boldthemes_customize_hide_menu( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[hide_menu]', array(
			'default'           => BoldThemes_Customize_Default::$data['hide_menu'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_checkbox'
		));
		$wp_customize->add_control( 'hide_menu', array(
			'label'    => esc_html__( 'Hide Menu on Load', 'industrial' ),
			'section'  => BoldThemesFramework::$pfx . '_header_footer_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[hide_menu]',
			'priority' => 80,
			'type'     => 'checkbox'
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_hide_menu' );

// FOOTER DARK SKIN
if ( ! function_exists( 'boldthemes_customize_footer_dark_skin' ) ) {
	function boldthemes_customize_footer_dark_skin( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[footer_dark_skin]', array(
			'default'           => BoldThemes_Customize_Default::$data['footer_dark_skin'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_checkbox'
		));
		$wp_customize->add_control( 'footer_dark_skin', array(
			'label'    => esc_html__( 'Use Dark Skin in Footer', 'industrial' ),
			'section'  => BoldThemesFramework::$pfx . '_header_footer_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[footer_dark_skin]',
			'priority' => 80,
			'type'     => 'checkbox'
		));	
	}
}
add_action( 'customize_register', 'boldthemes_customize_footer_dark_skin' );

// CUSTOM TEXT
if ( ! function_exists( 'boldthemes_customize_custom_text' ) ) {
	function boldthemes_customize_custom_text( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[custom_text]', array(
			'default'           => BoldThemes_Customize_Default::$data['custom_text'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'custom_text', array(
			'label'    => esc_html__( 'Custom Footer Text', 'industrial' ),
			'section'  => BoldThemesFramework::$pfx . '_header_footer_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[custom_text]',
			'priority' => 120,
			'type'     => 'text'
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_custom_text' );

// FOOTER PAGE SLUG
if ( ! function_exists( 'boldthemes_customize_footer_page_slug' ) ) {
	function boldthemes_customize_footer_page_slug( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[footer_page_slug]', array(
			'default'           => BoldThemes_Customize_Default::$data['footer_page_slug'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'footer_page_slug', array(
			'label'    => esc_html__( 'Footer Page Slug', 'industrial' ),
			'section'  => BoldThemesFramework::$pfx . '_header_footer_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[footer_page_slug]',
			'priority' => 120,
			'type'     => 'text'
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_footer_page_slug' );


/* TYPOGRAPHY */

// BODY FONT
if ( ! function_exists( 'boldthemes_customize_body_font' ) ) {
	function boldthemes_customize_body_font( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[body_font]', array(
			'default'           => BoldThemes_Customize_Default::$data['body_font'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'body_font', array(
			'label'     => esc_html__( 'Body Font', 'industrial' ),
			'section'   => BoldThemesFramework::$pfx . '_typo_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[body_font]',
			'priority'  => 97,
			'type'      => 'select',
			'choices'   => BoldThemesFramework::$customize_fonts
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_body_font' );

// HEADING FONT
if ( ! function_exists( 'boldthemes_customize_heading_font' ) ) {
	function boldthemes_customize_heading_font( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[heading_font]', array(
			'default'           => BoldThemes_Customize_Default::$data['heading_font'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'heading_font', array(
			'label'     => esc_html__( 'Heading Font', 'industrial' ),
			'section'   => BoldThemesFramework::$pfx . '_typo_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[heading_font]',
			'priority'  => 100,
			'type'      => 'select',
			'choices'   => BoldThemesFramework::$customize_fonts
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_heading_font' );

// SUPERTITLE HEADING FONT
if ( ! function_exists( 'boldthemes_customize_heading_supertitle_font' ) ) {
	function boldthemes_customize_heading_supertitle_font( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[heading_supertitle_font]', array(
			'default'           => BoldThemes_Customize_Default::$data['heading_supertitle_font'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'heading_supertitle_font', array(
			'label'     => esc_html__( 'Heading Supertitle Font', 'industrial' ),
			'section'   => BoldThemesFramework::$pfx . '_typo_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[heading_supertitle_font]',
			'priority'  => 100,
			'type'      => 'select',
			'choices'   => BoldThemesFramework::$customize_fonts
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_heading_supertitle_font' );

// HEADING SUBTITLE FONT
if ( ! function_exists( 'boldthemes_customize_heading_subtitle_font' ) ) {
	function boldthemes_customize_heading_subtitle_font( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[heading_subtitle_font]', array(
			'default'           => BoldThemes_Customize_Default::$data['heading_subtitle_font'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'heading_subtitle_font', array(
			'label'     => esc_html__( 'Heading Subtitle Font', 'industrial' ),
			'section'   => BoldThemesFramework::$pfx . '_typo_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[heading_subtitle_font]',
			'priority'  => 100,
			'type'      => 'select',
			'choices'   => BoldThemesFramework::$customize_fonts
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_heading_subtitle_font' );

// MENU FONT
if ( ! function_exists( 'boldthemes_customize_heading_menu_font' ) ) {
	function boldthemes_customize_heading_menu_font( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[menu_font]', array(
			'default'           => BoldThemes_Customize_Default::$data['menu_font'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'menu_font', array(
			'label'     => esc_html__( 'Menu Font', 'industrial' ),
			'section'   => BoldThemesFramework::$pfx . '_typo_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[menu_font]',
			'priority'  => 100,
			'type'      => 'select',
			'choices'   => BoldThemesFramework::$customize_fonts
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_heading_menu_font' );

// BUTTONS SHAPE
if ( ! function_exists( 'boldthemes_customize_heading_buttons_shape' ) ) {
	function boldthemes_customize_heading_buttons_shape( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[buttons_shape]', array(
			'default'           => BoldThemes_Customize_Default::$data['buttons_shape'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'buttons_shape', array(
			'label'     => esc_html__( 'Buttons Shape', 'industrial' ),
			'section'   => BoldThemesFramework::$pfx . '_typo_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[buttons_shape]',
			'priority'  => 100,
			'type'      => 'select',
			'choices'   => array(
				'btHardRoundedButtons' => esc_html__( 'Hard Rounded', 'industrial' ),
				'btSoftRoundedButtons' => esc_html__( 'Soft Rounded', 'industrial' ),
				'btSquareButtons' => esc_html__( 'Square', 'industrial' )			
			)
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_heading_buttons_shape' );


/* BLOG */

// GHOST SLIDER
if ( ! function_exists( 'boldthemes_customize_blog_ghost_slider' ) ) {
	function boldthemes_customize_blog_ghost_slider( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[blog_ghost_slider]', array(
			'default'           => BoldThemes_Customize_Default::$data['blog_ghost_slider'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_checkbox'
		));
		$wp_customize->add_control( 'blog_ghost_slider', array(
			'label'    => esc_html__( 'Show Fullscreen Overlay on Load', 'industrial' ),
			'section'  => BoldThemesFramework::$pfx . '_blog_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[blog_ghost_slider]',
			'priority' => 1,
			'type'     => 'checkbox'
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_blog_ghost_slider' );

// GRID GALLERY COLUMNS
if ( ! function_exists( 'boldthemes_customize_blog_grid_gallery_columns' ) ) {
	function boldthemes_customize_blog_grid_gallery_columns( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[blog_grid_gallery_columns]', array(
			'default'           => BoldThemes_Customize_Default::$data['blog_grid_gallery_columns'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'blog_grid_gallery_columns', array(
			'label'     => esc_html__( 'Grid Gallery Columns', 'industrial' ),
			'section'   => BoldThemesFramework::$pfx . '_blog_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[blog_grid_gallery_columns]',
			'priority'  => 6,
			'type'      => 'select',
			'choices'   => array(
				'3' => esc_html__( '3', 'industrial' ),
				'4' => esc_html__( '4', 'industrial' ),
				'5' => esc_html__( '5', 'industrial' ),
				'6' => esc_html__( '6', 'industrial' )				
			)
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_blog_grid_gallery_columns' );

// GRID GALLERY GAP
if ( ! function_exists( 'boldthemes_customize_blog_grid_gallery_gap' ) ) {
	function boldthemes_customize_blog_grid_gallery_gap( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[blog_grid_gallery_gap]', array(
			'default'           => BoldThemes_Customize_Default::$data['blog_grid_gallery_gap'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'blog_grid_gallery_gap', array(
			'label'     => esc_html__( 'Grid Gallery Gap', 'industrial' ),
			'section'   => BoldThemesFramework::$pfx . '_blog_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[blog_grid_gallery_gap]',
			'priority'  => 7,
			'type'      => 'select',
			'choices'   => array(
				'0' => esc_html__( '0px', 'industrial' ),
				'1' => esc_html__( '1px', 'industrial' ),
				'2' => esc_html__( '2px', 'industrial' ),
				'3' => esc_html__( '3px', 'industrial' ),
				'4' => esc_html__( '4px', 'industrial' ),
				'5' => esc_html__( '5px', 'industrial' ),
				'6' => esc_html__( '6px', 'industrial' ),
				'7' => esc_html__( '7px', 'industrial' ),
				'8' => esc_html__( '8px', 'industrial' ),
				'9' => esc_html__( '9px', 'industrial' ),
				'10' => esc_html__( '10px', 'industrial' ),
				'15' => esc_html__( '15px', 'industrial' ),
				'20' => esc_html__( '20px', 'industrial' ),
				'30' => esc_html__( '30px', 'industrial' ),
				'40' => esc_html__( '40px', 'industrial' )
			)
		));	
	}
}
add_action( 'customize_register', 'boldthemes_customize_blog_grid_gallery_gap' );
		
// BLOG LIST VIEW
if ( ! function_exists( 'boldthemes_customize_blog_list_view' ) ) {
	function boldthemes_customize_blog_list_view( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[blog_list_view]', array(
			'default'           => BoldThemes_Customize_Default::$data['blog_list_view'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'blog_list_view', array(
			'label'     => esc_html__( 'Archive Layout', 'industrial' ),
			'section'   => BoldThemesFramework::$pfx . '_blog_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[blog_list_view]',
			'priority'  => 8,
			'type'      => 'select',
			'choices'   => array(
				'standard' => esc_html__( 'Standard', 'industrial' ),
				'columns' => esc_html__( 'Columns', 'industrial' ),
				'columns-swap' => esc_html__( 'Columns Swap', 'industrial' ),
				'simple' => esc_html__( 'Simple', 'industrial' )
			)
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_blog_list_view' );
		
// BLOG SINGLE VIEW
if ( ! function_exists( 'boldthemes_customize_blog_single_view' ) ) {
	function boldthemes_customize_blog_single_view( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[blog_single_view]', array(
			'default'           => BoldThemes_Customize_Default::$data['blog_single_view'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'blog_single_view', array(
			'label'     => esc_html__( 'Single Post Layout', 'industrial' ),
			'section'   => BoldThemesFramework::$pfx . '_blog_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[blog_single_view]',
			'priority'  => 8,
			'type'      => 'select',
			'choices'   => array(
				'standard' => esc_html__( 'Standard', 'industrial' ),
				'columns' => esc_html__( 'Columns', 'industrial' )
			)
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_blog_single_view' );
		
// AUTHOR
if ( ! function_exists( 'boldthemes_customize_blog_author' ) ) {
	function boldthemes_customize_blog_author( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[blog_author]', array(
			'default'           => BoldThemes_Customize_Default::$data['blog_author'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_checkbox'
		));
		$wp_customize->add_control( 'blog_author', array(
			'label'    => esc_html__( 'Show Author Name', 'industrial' ),
			'section'  => BoldThemesFramework::$pfx . '_blog_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[blog_author]',
			'priority' => 8,
			'type'     => 'checkbox'
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_blog_author' );

// SQUARE AVATAR
if ( ! function_exists( 'boldthemes_customize_blog_square_avatar' ) ) {
	function boldthemes_customize_blog_square_avatar( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[blog_square_avatar]', array(
			'default'           => BoldThemes_Customize_Default::$data['blog_square_avatar'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_checkbox'
		));
		$wp_customize->add_control( 'blog_square_avatar', array(
			'label'    => esc_html__( 'Show Square Avatar', 'industrial' ),
			'section'  => BoldThemesFramework::$pfx . '_blog_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[blog_square_avatar]',
			'priority' => 8,
			'type'     => 'checkbox'
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_blog_square_avatar' );
		
// DATE
if ( ! function_exists( 'boldthemes_customize_blog_date' ) ) {
	function boldthemes_customize_blog_date( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[blog_date]', array(
			'default'           => BoldThemes_Customize_Default::$data['blog_date'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_checkbox'
		));
		$wp_customize->add_control( 'blog_date', array(
			'label'    => esc_html__( 'Show Post Date', 'industrial' ),
			'section'  => BoldThemesFramework::$pfx . '_blog_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[blog_date]',
			'priority' => 10,
			'type'     => 'checkbox'
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_blog_date' );

// BLOG SIDE INFO
if ( ! function_exists( 'boldthemes_customize_blog_side_info' ) ) {
	function boldthemes_customize_blog_side_info( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[blog_side_info]', array(
			'default'           => BoldThemes_Customize_Default::$data['blog_side_info'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_checkbox'
		));
		$wp_customize->add_control( 'blog_side_info', array(
			'label'    => esc_html__( 'Show Author Avatar in List', 'industrial' ),
			'section'  => BoldThemesFramework::$pfx . '_blog_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[blog_side_info]',
			'priority' => 12,
			'type'     => 'checkbox'
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_blog_side_info' );
		
// AUTHOR INFO
if ( ! function_exists( 'boldthemes_customize_blog_author_info' ) ) {
	function boldthemes_customize_blog_author_info( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[blog_author_info]', array(
			'default'           => BoldThemes_Customize_Default::$data['blog_author_info'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_checkbox'
		));
		$wp_customize->add_control( 'blog_author_info', array(
			'label'    => esc_html__( 'Show Author Info in Post', 'industrial' ),
			'section'  => BoldThemesFramework::$pfx . '_blog_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[blog_author_info]',
			'priority' => 15,
			'type'     => 'checkbox'
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_blog_author_info' );
		
// USE DASH
if ( ! function_exists( 'boldthemes_customize_blog_use_dash' ) ) {
	function boldthemes_customize_blog_use_dash( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[blog_use_dash]', array(
			'default'           => BoldThemes_Customize_Default::$data['blog_use_dash'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_checkbox'
		));
		$wp_customize->add_control( 'blog_use_dash', array(
			'label'    => esc_html__( 'Use Dash in Headlines', 'industrial' ),
			'section'  => BoldThemesFramework::$pfx . '_blog_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[blog_use_dash]',
			'priority' => 50,
			'type'     => 'checkbox'
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_blog_use_dash' );
		
// STICKY POSTS IN GRID/TILES
if ( ! function_exists( 'boldthemes_customize_sticky_in_grid' ) ) {
	function boldthemes_customize_sticky_in_grid( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[sticky_in_grid]', array(
			'default'           => BoldThemes_Customize_Default::$data['sticky_in_grid'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_checkbox'
		));
		$wp_customize->add_control( 'sticky_in_grid', array(
			'label'    => esc_html__( 'Show Sticky Posts in Grid/Tiles', 'industrial' ),
			'section'  => BoldThemesFramework::$pfx . '_blog_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[sticky_in_grid]',
			'priority' => 60,
			'type'     => 'checkbox'
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_sticky_in_grid' );
		
// SETTINGS PAGE SLUG
if ( ! function_exists( 'boldthemes_customize_blog_settings_page_slug' ) ) {
	function boldthemes_customize_blog_settings_page_slug( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[blog_settings_page_slug]', array(
			'default'           => BoldThemes_Customize_Default::$data['blog_settings_page_slug'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'blog_settings_page_slug', array(
			'label'    => esc_html__( 'Settings Page Slug', 'industrial' ),
			'section'  => BoldThemesFramework::$pfx . '_blog_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[blog_settings_page_slug]',
			'priority' => 60,
			'type'     => 'text'
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_blog_settings_page_slug' );


/* PORTFOLIO */
		
// GHOST SLIDER
if ( ! function_exists( 'boldthemes_customize_pf_ghost_slider' ) ) {
	function boldthemes_customize_pf_ghost_slider( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[pf_ghost_slider]', array(
			'default'           => BoldThemes_Customize_Default::$data['pf_ghost_slider'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_checkbox'
		));
		$wp_customize->add_control( 'pf_ghost_slider', array(
			'label'    => esc_html__( 'Show Fullscreen Overlay Gallery', 'industrial' ),
			'section'  => BoldThemesFramework::$pfx . '_pf_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[pf_ghost_slider]',
			'priority' => 3,
			'type'     => 'checkbox'
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_pf_ghost_slider' );

// GRID GALLERY COLUMNS
if ( ! function_exists( 'boldthemes_customize_pf_grid_gallery_columns' ) ) {
	function boldthemes_customize_pf_grid_gallery_columns( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[pf_grid_gallery_columns]', array(
			'default'           => BoldThemes_Customize_Default::$data['pf_grid_gallery_columns'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'pf_grid_gallery_columns', array(
			'label'     => esc_html__( 'Grid Gallery Columns', 'industrial' ),
			'section'   => BoldThemesFramework::$pfx . '_pf_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[pf_grid_gallery_columns]',
			'priority'  => 5,
			'type'      => 'select',
			'choices'   => array(
				'3' => esc_html__( '3', 'industrial' ),
				'4' => esc_html__( '4', 'industrial' ),
				'5' => esc_html__( '5', 'industrial' ),
				'6' => esc_html__( '6', 'industrial' )				
			)
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_pf_grid_gallery_columns' );
		
// GRID GALLERY GAP
if ( ! function_exists( 'boldthemes_customize_pf_grid_gallery_gap' ) ) {
	function boldthemes_customize_pf_grid_gallery_gap( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[pf_grid_gallery_gap]', array(
			'default'           => BoldThemes_Customize_Default::$data['pf_grid_gallery_gap'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'pf_grid_gallery_gap', array(
			'label'     => esc_html__( 'Grid Gallery Gap', 'industrial' ),
			'section'   => BoldThemesFramework::$pfx . '_pf_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[pf_grid_gallery_gap]',
			'priority'  => 8,
			'type'      => 'select',
			'choices'   => array(
				'0' => esc_html__( '0px', 'industrial' ),
				'1' => esc_html__( '1px', 'industrial' ),
				'2' => esc_html__( '2px', 'industrial' ),
				'3' => esc_html__( '3px', 'industrial' ),
				'4' => esc_html__( '4px', 'industrial' ),
				'5' => esc_html__( '5px', 'industrial' ),
				'6' => esc_html__( '6px', 'industrial' ),
				'7' => esc_html__( '7px', 'industrial' ),
				'8' => esc_html__( '8px', 'industrial' ),
				'9' => esc_html__( '9px', 'industrial' ),
				'10' => esc_html__( '10px', 'industrial' ),
				'15' => esc_html__( '15px', 'industrial' ),
				'20' => esc_html__( '20px', 'industrial' ),
				'30' => esc_html__( '30px', 'industrial' ),
				'40' => esc_html__( '40px', 'industrial' )
			)
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_pf_grid_gallery_gap' );

// PORTFOLIO SINGLE VIEW
if ( ! function_exists( 'boldthemes_customize_pf_single_view' ) ) {
	function boldthemes_customize_pf_single_view( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[pf_single_view]', array(
			'default'           => BoldThemes_Customize_Default::$data['pf_single_view'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'pf_single_view', array(
			'label'     => esc_html__( 'Single project view', 'industrial' ),
			'section'   => BoldThemesFramework::$pfx . '_pf_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[pf_single_view]',
			'priority'  => 8,
			'type'      => 'select',
			'choices'   => array(
				'standard' => esc_html__( 'Standard', 'industrial' ),
				'columns' => esc_html__( 'Columns', 'industrial' )
			)
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_pf_single_view' );

// USE DASH
if ( ! function_exists( 'boldthemes_customize_pf_use_dash' ) ) {
	function boldthemes_customize_pf_use_dash( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[pf_use_dash]', array(
			'default'           => BoldThemes_Customize_Default::$data['pf_use_dash'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_checkbox'
		));
		$wp_customize->add_control( 'pf_use_dash', array(
			'label'    => esc_html__( 'Use Dash in Headlines', 'industrial' ),
			'section'  => BoldThemesFramework::$pfx . '_pf_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[pf_use_dash]',
			'priority' => 50,
			'type'     => 'checkbox'
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_pf_use_dash' );

// SETTINGS PAGE SLUG
if ( ! function_exists( 'boldthemes_customize_pf_settings_page_slug' ) ) {
	function boldthemes_customize_pf_settings_page_slug( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[pf_settings_page_slug]', array(
			'default'           => BoldThemes_Customize_Default::$data['pf_settings_page_slug'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'pf_settings_page_slug', array(
			'label'    => esc_html__( 'Settings Page Slug', 'industrial' ),
			'section'  => BoldThemesFramework::$pfx . '_pf_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[pf_settings_page_slug]',
			'priority' => 60,
			'type'     => 'text'
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_pf_settings_page_slug' );


/* SHOP */

// USE DASH
if ( ! function_exists( 'boldthemes_customize_shop_use_dash' ) ) {
	function boldthemes_customize_shop_use_dash( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[shop_use_dash]', array(
			'default'           => BoldThemes_Customize_Default::$data['shop_use_dash'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_checkbox'
		));
		$wp_customize->add_control( 'shop_use_dash', array(
			'label'    => esc_html__( 'Use Dash in Headlines', 'industrial' ),
			'section'  => BoldThemesFramework::$pfx . '_shop_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[shop_use_dash]',
			'priority' => 50,
			'type'     => 'checkbox'
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_shop_use_dash' );

// SETTINGS PAGE SLUG
if ( ! function_exists( 'boldthemes_customize_shop_settings_page_slug' ) ) {
	function boldthemes_customize_shop_settings_page_slug( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[shop_settings_page_slug]', array(
			'default'           => BoldThemes_Customize_Default::$data['shop_settings_page_slug'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'shop_settings_page_slug', array(
			'label'    => esc_html__( 'Settings Page Slug', 'industrial' ),
			'section'  => BoldThemesFramework::$pfx . '_shop_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[shop_settings_page_slug]',
			'priority' => 60,
			'type'     => 'text'
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_shop_settings_page_slug' );