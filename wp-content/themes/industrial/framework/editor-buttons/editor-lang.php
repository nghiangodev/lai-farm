<?php

$strings = 'tinyMCE.addI18n( "' . esc_js( _WP_Editors::$mce_locale ) . '.boldthemes_theme",
	{
		drop_cap: "' . esc_js( esc_html__( 'Drop Cap', 'industrial' ) ) . '",
		highlight: "' . esc_js( esc_html__( 'Highlight', 'industrial' ) ) . '"
	}
)';