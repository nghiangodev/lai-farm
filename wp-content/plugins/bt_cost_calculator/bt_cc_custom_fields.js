'use strict';

(function( $ ) {
	
	// my_custom_field START

	// Custom label init

	window.bt_bb_cf_bt_cc_custom_label_content = function( obj ) {
		var html = '';
		if ( obj.param_heading != '' ) {
				html = obj.param_heading;
				html = html.replace( /``/gmi, '&quot;' );
				html = '<b>' + html + '</b>';
		}
		return html;
	}

	window.bt_bb_cf_bt_cc_custom_label_text_content = function( obj ) {
		var html = '';
		if ( obj.param_heading != '' ) {
				html = obj.param_heading;
				html = html.replace( /``/gmi, '&quot;' );
				html = '<b>' + html + '</b>';
		}
		return html;
	}

	// custom field content HTML (window.bt_bb_cf_<custom_field_slug>_content)
	window.bt_bb_cf_my_custom_field_content = function( obj ) {
		
		// obj.param_heading
		// obj.param_value
		// obj.param_name
		// obj.val
		// obj.base

		var html = '';
		if ( obj.val == '' ) {
			if ( obj.param_value !== undefined ) {
				html = obj.param_value;
				html = html.replace( /``/gmi, '&quot;' );
			}
		} else {
			html = obj.val.replace( /``/gmi, '&quot;' );
		}
		
		return '<b>' + obj.param_heading + '</b><input type="password" value="' + html + '">';
	}
	
	// custom field param value preview HTML (window.bt_bb_cf_<custom_field_slug>_param_value_preview)
	window.bt_bb_cf_my_custom_field_param_value_preview = function( param_value ) {
		var param_value_preview = '<b>' + param_value + '</b>';
		return param_value_preview;
	}
	
	// custom field edit dialog submit callback (window.bt_bb_cf_<custom_field_slug>_on_submit)
	window.bt_bb_cf_my_custom_field_on_submit = function( $this ) {
		var return_value = $this.find( 'input' ).val().replace( /"/gmi, '``' );
		return_value = return_value.replace( /\[/gmi, '(' );
		return_value = return_value.replace( /\]/gmi, ')' );
		return return_value;
	}
	
	// my_custom_field END
	
})( jQuery );