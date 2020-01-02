<?php
/*************************************************************************
 * TWITTER PLUGIN
 * -----------------------------------------------------------------------
 * Creado por: Helynai Elizabeth Chuc Maldonado.
 *************************************************************************/
// Create Custom Post Type
	
	function register_twitter_posttype() {
		$labels = array(
			'name' 				=> _x( 'TwitterAccounts', 'post type general name' ),
			'singular_name'		=> _x( 'TwitterAccount', 'post type singular name' ),
			'add_new' 			=> __( 'Add New Account' ),
			'add_new_item' 		=> __( 'Add New Account' ),
			'edit_item' 		=> __( 'Edit Account' ),
			'new_item' 			=> __( 'New Account' ),
			'view_item' 		=> __( 'View Account' ),
			'search_items' 		=> __( 'Search Account' ),
			'not_found' 		=> __( 'Account' ),
			'not_found_in_trash'=> __( 'Account' ),
			'parent_item_colon' => __( 'Account' ),
			'menu_name'			=> __( 'TwitterAccounts' )
		);
		
		$taxonomies = array();
		
		$supports = array('title','thumbnail');
		
		$post_type_args = array(
			'labels' 			=> $labels,
			'singular_label' 	=> __('twitterAccounts'),
			'public' 			=> true,
			'show_ui' 			=> true,
			'publicly_queryable'=> true,
			'query_var'			=> true,
			'capability_type' 	=> 'post',
			'has_archive' 		=> false,
			'hierarchical' 		=> false,
			'rewrite' 			=> array('slug' => 'twitterAccounts', 'with_front' => false ),
			'supports' 			=> $supports,
			'menu_position' 	=> 27, // Where it is in the menu. Change to 6 and it's below posts. 11 and it's below media, etc.
			'menu_icon' 		=> get_template_directory_uri() . '/inc/twitterPlug/images/icon.png',
			'taxonomies'		=> $taxonomies
		 );
		 register_post_type('twitterAccounts',$post_type_args);
	}
	add_action('init', 'register_twitter_posttype');



// Meta Box for Slider URL

	$twitterlink_2_metabox = array( 
		'id' => 'twitterlink',
		'title' => 'Twitter Link',
		'page' => array('twitterAccounts'),
		'context' => 'normal',
		'priority' => 'default',
		'fields' => array(
					
					array(
						'name' 			=> 'Twitter Account',
						'desc' 			=> '',
						'id' 				=> 'Hely_AccountPost',
						'class' 			=> 'Hely_AccountPost',
						'type' 			=> 'text',
						'rich_editor' 	=> 0,			
						'max' 			=> 0				
					),
					
					array(
						'name' 			=> 'Twitter Account Id',
						'desc' 			=> '',
						'id' 				=> 'Hely_AccountidPost',
						'class' 			=> 'Hely_AccountidPost',
						'type' 			=> 'text',
						'rich_editor' 	=> 0,			
						'max' 			=> 0				
					),
										array(
						'name' 			=> 'Twitter box Height',
						'desc' 			=> '400px optimal',
						'id' 				=> 'Hely_AccountPostHeight',
						'class' 			=> 'Hely_AccountPostHeight',
						'type' 			=> 'text',
						'rich_editor' 	=> 0,			
						'max' 			=> 0				
					),
										array(
						'name' 			=> 'Twitter box Width',
						'desc' 			=> '450px optimal',
						'id' 				=> 'Hely_AccountPostWidth',
						'class' 			=> 'Hely_AccountPostWidth',
						'type' 			=> 'text',
						'rich_editor' 	=> 0,			
						'max' 			=> 0				
					),
					)
	);			
				
	add_action('admin_menu', 'wptuts_add_twitterlink_2_meta_box');
	function wptuts_add_twitterlink_2_meta_box() {
	
		global $twitterlink_2_metabox;		
	
		foreach($twitterlink_2_metabox['page'] as $page) {
			add_meta_box($twitterlink_2_metabox['id'], $twitterlink_2_metabox['title'], 'wptuts_show_twitterlink_2_box', $page, 'normal', 'default', $twitterlink_2_metabox);
		}
	}
	
	// function to show meta boxes
	function wptuts_show_twitterlink_2_box()	{
		global $post;
		global $twitterlink_2_metabox;
		global $wptuts_prefix;
		global $wp_version;
		
		// Use nonce for verification
		echo '<input type="hidden" name="wptuts_twitterlink_2_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
		
		echo '<table class="form-table">';
	
		foreach ($twitterlink_2_metabox['fields'] as $field) {
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
	add_action('save_post', 'wptuts_twitterlink_2_save');
	function wptuts_twitterlink_2_save($post_id) {
		global $post;
		global $twitterlink_2_metabox;
		
		// verify nonce
		if (!wp_verify_nonce($_POST['wptuts_twitterlink_2_meta_box_nonce'], basename(__FILE__))) {
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
		
		foreach ($twitterlink_2_metabox['fields'] as $field) {
		
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