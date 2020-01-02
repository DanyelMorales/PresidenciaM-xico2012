<?php
/*************************************************************************
 * BANNER PLUGIN
 * -----------------------------------------------------------------------
 * Creado por: Helynai Elizabeth Chuc Maldonado.
 *************************************************************************/
 
// Create Custom Post Type
	
	function register_banner_posttype() {
		$labels = array(
			'name' 				=> _x( 'Banners', 'post type general name' ),
			'singular_name'		=> _x( 'Banner', 'post type singular name' ),
			'add_new' 			=> __( 'Add New Banner' ),
			'add_new_item' 		=> __( 'Add New Banner' ),
			'edit_item' 		=> __( 'Edit Banner' ),
			'new_item' 			=> __( 'New Banner' ),
			'view_item' 		=> __( 'View Banner' ),
			'search_items' 		=> __( 'Search Banner' ),
			'not_found' 		=> __( 'Banner' ),
			'not_found_in_trash'=> __( 'Banner' ),
			'parent_item_colon' => __( 'Banner' ),
			'menu_name'			=> __( 'Banners' )
		);
		
		$taxonomies = array();
		
		$supports = array('title','thumbnail');
		
		$post_type_args = array(
			'labels' 			=> $labels,
			'singular_label' 	=> __('Banner'),
			'public' 			=> true,
			'show_ui' 			=> true,
			'publicly_queryable'=> true,
			'query_var'			=> true,
			'capability_type' 	=> 'post',
			'has_archive' 		=> false,
			'hierarchical' 		=> false,
			'rewrite' 			=> array('slug' => 'banners', 'with_front' => false ),
			'supports' 			=> $supports,
			'menu_position' 	=> 27, // Where it is in the menu. Change to 6 and it's below posts. 11 and it's below media, etc.
			'menu_icon' 		=> get_template_directory_uri() . '/inc/banner/images/icon.png',
			'taxonomies'		=> $taxonomies
		 );
		 register_post_type('banners',$post_type_args);
	}
	add_action('init', 'register_banner_posttype');



// Meta Box for Slider URL

	$bannerlink_2_metabox = array( 
		'id' => 'bannerlink',
		'title' => 'Banner Link',
		'page' => array('banners'),
		'context' => 'normal',
		'priority' => 'default',
		'fields' => array(
					
					array(
						'name' 			=> 'Banner URL',
						'desc' 			=> '',
						'id' 				=> 'Hely_bannerurl',
						'class' 			=> 'Hely_bannerurl',
						'type' 			=> 'text',
						'rich_editor' 	=> 0,			
						'max' 			=> 0				
					),
					
					array(
						'name' 			=> 'Banner URL Post',
						'desc' 			=> '',
						'id' 				=> 'Hely_bannerUrlPost',
						'class' 			=> 'Hely_bannerUrlPost',
						'type' 			=> 'text',
						'rich_editor' 	=> 0,			
						'max' 			=> 0				
					),
				
					array(
						'name' 			=> 'Banner Alternative',
						'desc' 			=> '',
						'id' 				=> 'Hely_bannerAlternative',
						'class' 			=> 'Hely_bannerAlternative',
						'type' 			=> 'text',
						'rich_editor' 	=> 0,			
						'max' 			=> 0				
					),
					)
	);			
				
	add_action('admin_menu', 'wptuts_add_bannerlink_2_meta_box');
	function wptuts_add_bannerlink_2_meta_box() {
	
		global $bannerlink_2_metabox;		
	
		foreach($bannerlink_2_metabox['page'] as $page) {
			add_meta_box($bannerlink_2_metabox['id'], $bannerlink_2_metabox['title'], 'wptuts_show_bannerlink_2_box', $page, 'normal', 'default', $bannerlink_2_metabox);
		}
	}
	
	// function to show meta boxes
	function wptuts_show_bannerlink_2_box()	{
		global $post;
		global $bannerlink_2_metabox;
		global $wptuts_prefix;
		global $wp_version;
		
		// Use nonce for verification
		echo '<input type="hidden" name="wptuts_bannerlink_2_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
		
		echo '<table class="form-table">';
	
		foreach ($bannerlink_2_metabox['fields'] as $field) {
			// get current post meta data
	
			$meta = get_post_meta($post->ID, $field['id'], true);
			
			echo '<tr>',
					'<th style="width:20%"><label for="', $field['id'], '">', stripslashes($field['name']), '</label></th>',
					'<td class="wptuts_field_type_' . str_replace(' ', '_', $field['type']) . '">';
			switch ($field['type']) {
				case 'text':
					echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" /><br/>', '', stripslashes($field['desc']);
					break;
			}
			echo    '<td>',
				'</tr>';
		}
		
		echo '</table>';
	}	
	
	// Save data from meta box
	add_action('save_post', 'wptuts_bannerlink_2_save');
	function wptuts_bannerlink_2_save($post_id) {
		global $post;
		global $bannerlink_2_metabox;
		
		// verify nonce
		if (!wp_verify_nonce($_POST['wptuts_bannerlink_2_meta_box_nonce'], basename(__FILE__))) {
			return $post_id;
		}
	
		// check autosave
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}
	
		// check permissions
		if ('page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id)) {
				return $post_id;
			}
		} elseif (!current_user_can('edit_post', $post_id)) {
			return $post_id;
		}
		
		foreach ($bannerlink_2_metabox['fields'] as $field) {
		
			$old = get_post_meta($post_id, $field['id'], true);
			$new = $_POST[$field['id']];
			
			if ($new && $new != $old) {
				if($field['type'] == 'date') {
					$new = wptuts_format_date($new);
					update_post_meta($post_id, $field['id'], $new);
				} else {
					if(is_string($new)) {
						$new = $new;
					} 
					update_post_meta($post_id, $field['id'], $new);
					
					
				}
			} elseif ('' == $new && $old) {
				delete_post_meta($post_id, $field['id'], $old);
			}
		}
	}