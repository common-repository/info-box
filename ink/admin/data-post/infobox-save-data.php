<?php
if ( ! defined( 'ABSPATH' ) ) exit; 
if(isset($PostID) && isset($_POST['infobox_save_data_action']) ) {
			$TotalCount = count($_POST['infobox_title']);
			$InfoboxArray = array();
			if($TotalCount) {
				for($i=0; $i < $TotalCount; $i++) {
					$infobox_title = stripslashes(sanitize_text_field($_POST['infobox_title'][$i]));
					$infobox_desc = stripslashes($_POST['infobox_desc'][$i]);

					$InfoboxArray[] = array(
						'infobox_title' => $infobox_title,
						'infobox_desc' => $infobox_desc,
					);
				}
				update_post_meta($PostID, 'wpsm_infobox_data', serialize($InfoboxArray));
				update_post_meta($PostID, 'wpsm_infobox_count', $TotalCount);
			} else {
				$TotalCount = -1;
				update_post_meta($PostID, 'wpsm_infobox_count', $TotalCount);
				$InfoboxArray = array();
				update_post_meta($PostID, 'wpsm_infobox_data', serialize($InfoboxArray));
			}
		}
 ?>