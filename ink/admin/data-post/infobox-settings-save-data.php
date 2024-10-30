<?php
if ( ! defined( 'ABSPATH' ) ) exit; 
if(isset($PostID) && isset($_POST['infobox_setting_save_action'])) {
			$infobox_radius     	  = sanitize_option('infobox_radius', $_POST['infobox_radius']);
			$show_infobox_title_align    = sanitize_option('show_infobox_title_align',$_POST['show_infobox_title_align']);
			$enable_infobox_border   = sanitize_option('enable_infobox_border',$_POST['enable_infobox_border']);
			$Infobox_shadow          = sanitize_option('Infobox_shadow',$_POST['Infobox_shadow']);
			$infobox_shadow          = sanitize_option('infobox_shadow',$_POST['infobox_shadow']);
			$box_layout               = sanitize_text_field($_POST['box_layout']);
			$infobox_desc_font_clr   = sanitize_text_field($_POST['infobox_desc_font_clr']);
			$infobox_bg_clr   = sanitize_text_field($_POST['infobox_bg_clr']);
			$infobox_border_clr   = sanitize_text_field($_POST['infobox_border_clr']);
			$infobox_title_clr  = sanitize_text_field($_POST['infobox_title_clr']);
			$show_infobox_desc_align   = sanitize_option('show_infobox_desc_align',$_POST['show_infobox_desc_align']);
			$title_size 		      = sanitize_text_field($_POST['title_size']);
			$des_size         	      = sanitize_text_field($_POST['des_size']);
			$font_family              = sanitize_text_field($_POST['font_family']);
			$custom_css         = stripslashes($_POST['custom_css']);
			
			
		
			$Infobox_Settings_Array = serialize( array(
				'infobox_radius' 			=> $infobox_radius,
				'show_infobox_title_align' 	=> $show_infobox_title_align,
				'enable_infobox_border' 	=> $enable_infobox_border,
				'Infobox_shadow' 		    => $Infobox_shadow,
				'infobox_shadow' 		    => $infobox_shadow,
				'infobox_masonry' 		    => $infobox_masonry,
				'box_layout' 		        => $box_layout,
				'infobox_desc_font_clr' 	=> $infobox_desc_font_clr,
				'infobox_bg_clr' 			=> $infobox_bg_clr,
				'infobox_border_clr' 		=> $infobox_border_clr,
				'infobox_title_clr' 		=> $infobox_title_clr,
				'show_infobox_desc_align' 	=> $show_infobox_desc_align,
				'title_size' 			    => $title_size,
				'des_size' 				    => $des_size,
				'font_family' 			    => $font_family,
				'custom_css' 			    => $custom_css,
				) );

			update_post_meta($PostID, 'Infobox_Settings', $Infobox_Settings_Array);
		}
?>