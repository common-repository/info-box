<?php
/**
 * Plugin Name: Info Box
 * Version: 1.1.8
 * Description: Info Box is the most easiest drag & drop content box builder. It is display content in grid layout.You can add unlimited boxes with unlimited color scheme.
 * Author: wpshopmart
 * Author URI: https://www.wpshopmart.com
 * Plugin URI: https://www.wpshopmart.com/plugins
 */
 
if ( ! defined( 'ABSPATH' ) ) exit; 
/**
 * DEFINE PATHS
 */
define("wpshopmart_infobox_directory_url", plugin_dir_url(__FILE__));
define("wpshopmart_infobox_text_domain", "wpsm_infobox");

/**
 * PLUGIN Install
 */
require_once("ink/install/installation.php");


/**
 * CPT CLASS
 */
 
require_once("ink/admin/menu.php");

/**
 * SHORTCODE
 */
require_once("template/shortcode.php"); 

?>