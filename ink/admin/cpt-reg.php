<?php
if ( ! defined( 'ABSPATH' ) ) exit; 
$labels = array(
				'name'                => _x( 'Info Box', 'Info Box', wpshopmart_infobox_text_domain ),
				'singular_name'       => _x( 'Info Box', 'Info Box', wpshopmart_infobox_text_domain ),
				'menu_name'           => __( 'Info Box', wpshopmart_infobox_text_domain ),
				'parent_item_colon'   => __( 'Parent Item:', wpshopmart_infobox_text_domain ),
				'all_items'           => __( 'All Info Box', wpshopmart_infobox_text_domain ),
				'view_item'           => __( 'View Info Box', wpshopmart_infobox_text_domain ),
				'add_new_item'        => __( 'Add New Info Box', wpshopmart_infobox_text_domain ),
				'add_new'             => __( 'Add New Info Box', wpshopmart_infobox_text_domain ),
				'edit_item'           => __( 'Edit Info Box', wpshopmart_infobox_text_domain ),
				'update_item'         => __( 'Update Info Box', wpshopmart_infobox_text_domain ),
				'search_items'        => __( 'Search Info Box', wpshopmart_infobox_text_domain ),
				'not_found'           => __( 'No Info Box Found', wpshopmart_infobox_text_domain ),
				'not_found_in_trash'  => __( 'No Info Box found in Trash', wpshopmart_infobox_text_domain ),
			);
			$args = array(
				'label'               => __( 'Info Box Panels', wpshopmart_infobox_text_domain ),
				'description'         => __( 'Info Box Panels', wpshopmart_infobox_text_domain ),
				'labels'              => $labels,
				'supports'            => array( 'title', '', '', '', '', '', '', '', '', '', '', ),
				//'taxonomies'          => array( 'category', 'post_tag' ),
				 'hierarchical'        => false,
				'public'              => false,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'show_in_nav_menus'   => false,
				'show_in_admin_bar'   => false,
				'menu_position'       => 5,
				'menu_icon'           => 'dashicons-info',
				'can_export'          => true,
				'has_archive'         => true,
				'exclude_from_search' => false,
				'publicly_queryable'  => false,
				'capability_type'     => 'page',
			);
			register_post_type( 'infobox_panels', $args );
			
 ?>