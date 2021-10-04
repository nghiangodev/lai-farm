<?php

// PAGE
boldthemes_add_mb( array( 'id' => 'page', 'title' => esc_html__( 'Settings', 'industrial' ), 'post_type' => 'page', 'autosave' => true ) );
boldthemes_add_mb_field( 
	array(
		'mb_id'    => 'page',
		'field_id' => 'menu_name',
		'name'     => esc_html__( 'Menu Name', 'industrial' ),
		'type'     => 'text'
	)
);
boldthemes_add_mb_field( 
	array(
		'mb_id'    => 'page',
		'field_id' => 'animations',
		'name'     => esc_html__( 'Animations', 'industrial' ),
		'type'     => 'select',
		'options'  => array(
			'normal'    => esc_html__( 'Normal', 'industrial' ),
			'half_page' => esc_html__( 'Half Page', 'industrial' ),
			'impress'   => esc_html__( 'Impress', 'industrial' )
		)
	)
);
boldthemes_add_mb_field( 
	array(
		'mb_id'    => 'page',
		'field_id' => 'override',
		'name'     => esc_html__( 'Override Global Settings', 'industrial' ),
		'type'     => 'boldthemestext',
		'clone'    => true
	)
);

// POST
boldthemes_add_mb( array( 'id' => 'post', 'title' => esc_html__( 'Settings', 'industrial' ), 'post_type' => 'post', 'autosave' => true ) );
boldthemes_add_mb_field( 
	array(
		'mb_id'    => 'post',
		'field_id' => 'menu_name',
		'name'     => esc_html__( 'Menu Name', 'industrial' ),
		'type'     => 'text'
	)
);
boldthemes_add_mb_field( 
	array(
		'mb_id'    => 'post',
		'field_id' => 'description',
		'name'     => esc_html__( 'Meta Description', 'industrial' ),
		'type'     => 'textarea'
	)
);
boldthemes_add_mb_field( 
	array(
		'mb_id'    => 'post',
		'field_id' => 'images',
		'name'     => esc_html__( 'Images', 'industrial' ),
		'type'     => 'image_advanced'
	)
);
boldthemes_add_mb_field( 
	array(
		'mb_id'    => 'post',
		'field_id' => 'grid_gallery',
		'name'     => esc_html__( 'Grid Gallery', 'industrial' ),
		'type'     => 'checkbox'
	)
);
boldthemes_add_mb_field( 
	array(
		'mb_id'    => 'post',
		'field_id' => 'grid_gallery_format',
		'name'     => esc_html__( 'Grid Gallery Format', 'industrial' ),
		'type'     => 'text'
	)
);
boldthemes_add_mb_field( 
	array(
		'mb_id'    => 'post',
		'field_id' => 'video',
		'name'     => esc_html__( 'Video', 'industrial' ),
		'type'     => 'text'
	)
);
boldthemes_add_mb_field( 
	array(
		'mb_id'    => 'post',
		'field_id' => 'audio',
		'name'     => esc_html__( 'Audio', 'industrial' ),
		'type'     => 'textarea'
	)
);
boldthemes_add_mb_field( 
	array(
		'mb_id'    => 'post',
		'field_id' => 'link_title',
		'name'     => esc_html__( 'Link', 'industrial' ),
		'type'     => 'text'
	)
);
boldthemes_add_mb_field( 
	array(
		'mb_id'    => 'post',
		'field_id' => 'link_url',
		'name'     => esc_html__( 'Link URL', 'industrial' ),
		'type'     => 'text'
	)
);
boldthemes_add_mb_field( 
	array(
		'mb_id'    => 'post',
		'field_id' => 'quote',
		'name'     => esc_html__( 'Quote', 'industrial' ),
		'type'     => 'text'
	)
);
boldthemes_add_mb_field( 
	array(
		'mb_id'    => 'post',
		'field_id' => 'quote_author',
		'name'     => esc_html__( 'Quote Author', 'industrial' ),
		'type'     => 'text'
	)
);
boldthemes_add_mb_field( 
	array(
		'mb_id'    => 'post',
		'field_id' => 'tile_format',
		'name'     => esc_html__( 'Tile Format', 'industrial' ),
		'type'     => 'select',
		'options'  => array( '11' => '1:1', '21' => '2:1', '22' => '2:2', '12' => '1:2' )
	)
);
boldthemes_add_mb_field( 
	array(
		'mb_id'    => 'post',
		'field_id' => 'override',
		'name'     => esc_html__( 'Override Global Settings', 'industrial' ),
		'type'     => 'boldthemestext',
		'clone'    => true
	)
);

// PORTFOLIO
boldthemes_add_mb( array( 'id' => 'portfolio', 'title' => esc_html__( 'Settings', 'industrial' ), 'post_type' => 'portfolio', 'autosave' => true ) );
boldthemes_add_mb_field( 
	array(
		'mb_id'    => 'portfolio',
		'field_id' => 'description',
		'name'     => esc_html__( 'Meta Description', 'industrial' ),
		'type'     => 'textarea'
	)
);
boldthemes_add_mb_field( 
	array(
		'mb_id'    => 'portfolio',
		'field_id' => 'subheading',
		'name'     => esc_html__( 'Subheading', 'industrial' ),
		'type'     => 'text'
	)
);
boldthemes_add_mb_field( 
	array(
		'mb_id'    => 'portfolio',
		'field_id' => 'images',
		'name'     => esc_html__( 'Images', 'industrial' ),
		'type'     => 'image_advanced'
	)
);
boldthemes_add_mb_field( 
	array(
		'mb_id'    => 'portfolio',
		'field_id' => 'grid_gallery',
		'name'     => esc_html__( 'Grid Gallery', 'industrial' ),
		'type'     => 'checkbox'
	)
);
boldthemes_add_mb_field( 
	array(
		'mb_id'    => 'portfolio',
		'field_id' => 'grid_gallery_format',
		'name'     => esc_html__( 'Grid Gallery Format', 'industrial' ),
		'type'     => 'text'
	)
);
boldthemes_add_mb_field( 
	array(
		'mb_id'    => 'portfolio',
		'field_id' => 'video',
		'name'     => esc_html__( 'Video', 'industrial' ),
		'type'     => 'text'
	)
);
boldthemes_add_mb_field( 
	array(
		'mb_id'    => 'portfolio',
		'field_id' => 'audio',
		'name'     => esc_html__( 'Audio', 'industrial' ),
		'type'     => 'textarea'
	)
);
boldthemes_add_mb_field( 
	array(
		'mb_id'    => 'portfolio',
		'field_id' => 'tile_format',
		'name'     => esc_html__( 'Tile Format', 'industrial' ),
		'type'     => 'select',
		'options'  => array( '11' => '1:1', '21' => '2:1', '22' => '2:2', '12' => '1:2' )
	)
);
boldthemes_add_mb_field( 
	array(
		'mb_id'    => 'portfolio',
		'field_id' => 'custom_fields',
		'name'     => esc_html__( 'Custom Fields', 'industrial' ),
		'type'     => 'boldthemestext1',
		'clone'    => true
	)
);
boldthemes_add_mb_field( 
	array(
		'mb_id'    => 'portfolio',
		'field_id' => 'override',
		'name'     => esc_html__( 'Override Global Settings', 'industrial' ),
		'type'     => 'boldthemestext',
		'clone'    => true
	)
);

// PRODUCT
boldthemes_add_mb( array( 'id' => 'product', 'title' => esc_html__( 'Settings', 'industrial' ), 'post_type' => 'product', 'autosave' => true ) );
boldthemes_add_mb_field( 
	array(
		'mb_id'    => 'product',
		'field_id' => 'override',
		'name'     => esc_html__( 'Override Global Settings', 'industrial' ),
		'type'     => 'boldthemestext',
		'clone'    => true
	)
);

/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/
 */

add_filter( 'rwmb_meta_boxes', 'boldthemes_register_meta_boxes' );

/**
 * Register meta boxes
 *
 * @return void
 */
if ( ! function_exists( 'boldthemes_register_meta_boxes' ) ) {
	function boldthemes_register_meta_boxes( $meta_boxes ) {
		/**
		 * Prefix of meta keys (optional)
		 * Use underscore (_) at the beginning to make keys hidden
		 * Alt.: You also can make prefix empty to disable it
		 */
		
		$prefix = BoldThemesFramework::$pfx . '_';
		
		$mb_count = count( $meta_boxes );

		foreach( BoldThemesFramework::$meta_boxes as $meta_box ) {
			$meta_boxes[] = array(
				// Meta box title - Will appear at the drag and drop handle bar. Required.
				'title' => $meta_box['title'],

				// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
				'pages' => array( $meta_box['post_type'] ),

				// Auto save: true, false (default). Optional.
				'autosave' => $meta_box['autosave'],
			);
	
			// List of meta fields
			$f = 0;
			foreach( $meta_box['fields'] as $field ) {
				$meta_boxes[ $mb_count ]['fields'][] = array(
					'name' => $field['name'],
					'id'   => $prefix . $field['id'],
					'type' => $field['type'],
					'order' => $field['order']
				);
				
				if ( isset( $field['options'] ) ) {
					 $meta_boxes[ $mb_count ]['fields'][ $f ]['options'] = $field['options'];
				}
				
				if ( isset( $field['clone'] ) ) {
					$meta_boxes[ $mb_count ]['fields'][ $f ]['clone'] = $field['clone'];
				}				
				
				$f++;
			}
			
			usort( $meta_boxes[ $mb_count ]['fields'], 'boldthemes_mb_fields_sort' );
			
			$mb_count++;
		}

		return $meta_boxes;

	}
}

/**
 * Sort fields
 */
if ( ! function_exists( 'boldthemes_mb_fields_sort' ) ) {
	function boldthemes_mb_fields_sort( $a, $b ) {
		return $a['order'] > $b['order'];
	}
}