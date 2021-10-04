<?php
add_action( 'init', 'boldthemes_buttons' );
if ( ! function_exists( 'boldthemes_buttons' ) ) {
	function boldthemes_buttons() {
		add_filter( 'mce_buttons_2', 'boldthemes_register_buttons' );
		add_filter( 'tiny_mce_before_init', 'boldthemes_insert_formats' ); 
		add_filter( 'mce_external_languages', 'boldthemes_add_tinymce_lang' );
	}
}

if ( ! function_exists( 'boldthemes_add_tinymce_lang' ) ) {
	function boldthemes_add_tinymce_lang( $arr ) {
		$arr['boldthemes'] = get_template_directory() . '/framework/editor-buttons/editor-lang.php';
		return $arr;
	}
}

// Callback function to insert 'styleselect' into the $buttons array
function boldthemes_register_buttons( $buttons ) {
	array_unshift( $buttons, 'styleselect' );
	return $buttons;
}


// Callback function to filter the MCE settings
function boldthemes_insert_formats( $init_array ) {  
	// Define the style_formats array
	$style_formats = array(  
		// Each array child is a format with it's own settings
		array(  
			'title' => 'Blockquote',  
			'block' => 'blockquote',
			'wrapper' => true,
			
		),  
		array(  
			'title' => 'Cite',  
			'block' => 'cite',
			'wrapper' => true,
		),
		array(  
			'title' => 'Small',  
			'block' => 'small',
			'wrapper' => true,
		),
	);  
	// Insert the array, JSON ENCODED, into 'style_formats'
	$init_array['style_formats'] = json_encode( $style_formats );  
	
	return $init_array;  
  
}
