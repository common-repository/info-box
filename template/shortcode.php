<?php
if ( ! defined( 'ABSPATH' ) ) exit;
add_shortcode( 'WPSM_INFOBOX', 'InfoboxShortCode' );
function InfoboxShortCode( $Id ) {
	ob_start();	
	if(!isset($Id['id'])) 
	 {
		$WPSM_Infobox_ID = "";
	 } 
	else 
	{
		$WPSM_Infobox_ID = $Id['id'];
	}
	require("content.php"); 
	wp_reset_query();
    return ob_get_clean();
}
?>