<?php
if ( ! defined( 'ABSPATH' ) ) exit; 
class wpsm_infobox {
	private static $instance;
    public static function forge() {
        if (!isset(self::$instance)) {
            $className = __CLASS__;
            self::$instance = new $className;
        }
        return self::$instance;
    }
	
	private function __construct() {
		add_action('admin_enqueue_scripts', array(&$this, 'wpsm_infobox_admin_scripts'));
        if (is_admin()) {
			add_action('init', array(&$this, 'infobox_register_cpt'), 1);
			add_action('add_meta_boxes', array(&$this, 'wpsm_infobox_meta_boxes_group'));
			add_action('admin_init', array(&$this, 'wpsm_infobox_meta_boxes_group'), 1);
			add_action('save_post', array(&$this, 'add_infobox_meta_box_save'), 9, 1);
			add_action('save_post', array(&$this, 'infobox_settings_meta_box_save'), 9, 1);
		}
    }
	
	// admin scripts
	public function wpsm_infobox_admin_scripts(){
		if(get_post_type()=="infobox_panels"){
			
			wp_enqueue_media();
			wp_enqueue_script('jquery-ui-datepicker');
			//color-picker css n js
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_script( 'wpsm_infobox-color-pic', wpshopmart_infobox_directory_url.'assets/js/color-picker.js', array( 'wp-color-picker' ), false, true );
			wp_enqueue_style('wpsm_infobox-panel-style', wpshopmart_infobox_directory_url.'assets/css/panel-style.css');
			  
			//font awesome css
			wp_enqueue_style('wpsm_infobox-font-awesome', wpshopmart_infobox_directory_url.'assets/css/font-awesome/css/font-awesome.min.css');
			wp_enqueue_style('wpsm_infobox_bootstrap', wpshopmart_infobox_directory_url.'assets/css/bootstrap.css');
			
			wp_enqueue_style('wpsm_infobox_jquery-css', wpshopmart_infobox_directory_url .'assets/css/ac_jquery-ui.css');
			
			wp_enqueue_style('wpsm_infobox_remodal-css', wpshopmart_infobox_directory_url .'assets/modal/remodal.css');
			wp_enqueue_style('wpsm_infobox_remodal-default-theme-css', wpshopmart_infobox_directory_url .'assets/modal/remodal-default-theme.css');
		
			
			wp_enqueue_script( 'wpsm_infobox-bootstrap-js', wpshopmart_infobox_directory_url.'assets/js/bootstrap.js');
			
			
			// settings
			wp_enqueue_style('wpsm_infobox_settings-css', wpshopmart_infobox_directory_url.'assets/css/settings.css');
			
			
			//css editor 
			wp_enqueue_style('wpsm_infobox_codemirror-css', wpshopmart_infobox_directory_url.'assets/codex/codemirror.css');
			wp_enqueue_style('wpsm_infobox_ambiance', wpshopmart_infobox_directory_url.'assets/codex/ambiance.css');
			wp_enqueue_style('wpsm_infobox_show-hint-css', wpshopmart_infobox_directory_url.'assets/codex/show-hint.css');
			
			wp_enqueue_script('wpsm_infobox_codemirror-js',wpshopmart_infobox_directory_url.'assets/codex/codemirror.js',array('jquery'));
			wp_enqueue_script('wpsm_infobox_css-js',wpshopmart_infobox_directory_url.'assets/codex/css.js',array('jquery'));
			wp_enqueue_script('wpsm_infobox_css-hint-js',wpshopmart_infobox_directory_url.'assets/codex/css-hint.js',array('jquery'));
			
			wp_enqueue_script('wpsm_infobox_min-js',wpshopmart_infobox_directory_url.'assets/modal/remodal.min.js',array('jquery'), false, true);
	
		}
	}
	
	public function infobox_register_cpt(){
		require_once('cpt-reg.php');
		add_filter( 'manage_edit-infobox_panels_columns', array(&$this, 'infobox_panels_columns' )) ;
		add_action( 'manage_infobox_panels_posts_custom_column', array(&$this, 'infobox_panels_manage_columns' ), 10, 2 );
	}
	
	function infobox_panels_columns( $columns ){
        $columns = array(
            'cb' => '<input type="checkbox" />',
            'title' => __( 'Colorbox' ),
            'shortcode' => __( 'Colorbox Shortcode' ),
            'date' => __( 'Date' )
        );
        return $columns;
    }

    function infobox_panels_manage_columns( $column, $post_id ){
        global $post;
        switch( $column ) {
          case 'shortcode' :
            echo '<input style="width:225px" type="text" value="[WPSM_INFOBOX id='.$post_id.']" readonly="readonly" />';
            break;
          default :
            break;
        }
    }
	
	// metaboxes
	public function wpsm_infobox_meta_boxes_group(){
		add_meta_box('add_infobox', __('Add Infobox Panel', wpshopmart_infobox_text_domain), array(&$this, 'wpsm_add_infobox_meta_box_function'), 'infobox_panels', 'normal', 'low' );
		add_meta_box ('infobox_shortcode', __('Infobox Shortcode', wpshopmart_infobox_text_domain), array(&$this, 'wpsm_pic_infobox_shortcode'), 'infobox_panels', 'normal', 'low');
		add_meta_box('ib_rateus', __('Rate Us If You Like This Plugin', wpshopmart_infobox_text_domain), array(&$this, 'wpsm_ib_rateus_meta_box_function'), 'infobox_panels', 'side', 'low');
		add_meta_box('infobox_setting', __('Infobox Settings', wpshopmart_infobox_text_domain), array(&$this, 'wpsm_add_infobox_setting_meta_box_function'), 'infobox_panels', 'side', 'low');
		add_meta_box ('infobox_pro_get', __('Get Pro Version', wpshopmart_infobox_text_domain), array(&$this, 'wpsm_pic_ib_pro_demo_shortcode'), 'infobox_panels', 'normal', 'low');
		add_meta_box ('infobox_pro_more', __('More Premium Plugin from Wpshopmart', wpshopmart_infobox_text_domain), array(&$this, 'wpsm_pic_ib_pro_more'), 'infobox_panels', 'normal', 'low');
		
	}
	
	public function wpsm_add_infobox_meta_box_function($post){
		require_once('add-infobox.php');
	}
	
	public function wpsm_pic_infobox_shortcode(){
		?>
		<style>
			#infobox_shortcode{
			background:#fff!important;
			box-shadow: 0 0 20px rgba(0,0,0,.2);
			}
			#infobox_shortcode .hndle , #infobox_shortcode .handlediv{
			display:none;
			}
			#infobox_shortcode p{
			color:#000;
			font-size:15px;
			}
			#infobox_shortcode input {
			font-size: 16px;
			padding: 8px 10px;
			width:100%;
			}
			.customcss-title{
				background: #000;
				padding: 10px;
				margin: 0px;
				color: #fff;
				font-size: 18px;
				
			}
			
		</style>
		<h3>Infobox Shortcode</h3>
		<p><?php _e("Use below shortcode in any Page/Post to publish your Infobox", wpshopmart_infobox_text_domain);?></p>
		<input readonly="readonly" type="text" value="<?php echo "[WPSM_INFOBOX id=".get_the_ID()."]"; ?>">
		<br/>
		<br/>
		<br/>
		<?php
		 $PostId = get_the_ID();
		$Infobox_Settings = unserialize(get_post_meta( $PostId, 'Infobox_Settings', true));
		if(isset($Infobox_Settings['custom_css'])){  
		     $custom_css   = $Infobox_Settings['custom_css'];
		}
		else{
		$custom_css="";
		}		
		?>
		<h3 class="customcss-title">Custom Css</h3>
		<textarea name="custom_css" id="custom_css" ><?php echo $custom_css ; ?></textarea>
		<p>Enter Css without <strong>&lt;style&gt; &lt;/style&gt; </strong> tag</p>
		<br>
		<script>
		  var editor = CodeMirror.fromTextArea(document.getElementById("custom_css"), {
		   lineNumbers: true,
		   styleActiveLine: true,
			matchBrackets: true,
			hint:true,
			theme : 'ambiance',
			extraKeys: {"Ctrl-Space": "autocomplete"},
		  });
	  
		</script>
		<?php 
	}
	
	
	
	
	public function wpsm_add_infobox_setting_meta_box_function($post){
		require_once('settings.php');
	}
	
	public function add_infobox_meta_box_save($PostID) {
		require('data-post/infobox-save-data.php');
    }
	
	public function infobox_settings_meta_box_save($PostID){
		require('data-post/infobox-settings-save-data.php');
	}
	
	public function wpsm_ib_rateus_meta_box_function(){
		?>
		<style>
			#ib_rateus{
				background:#e22496;
				text-align:center;
			}
			#ib_rateus .hndle , #ib_rateus .handlediv{
			display:none;
			}
			#ib_rateus h1{
			color:#fff;
			
			}
			 #ib_rateus h3 {
			color:#fff;
			font-size:15px;
			}
			#ib_rateus .button-hero{
			display:block;
			text-align:center;
			margin-bottom:15px;
			background:#fff;
			color:#000;
			box-shadow:none;
			text-shadow: none;
			font-weight:600;
			border:0px;
			}
			.wpsm-rate-us{
			text-align:center;
			}
			.wpsm-rate-us span.dashicons {
				width: 40px;
				height: 40px;
				font-size:20px;
				color : #ffffff !important;
			}
			.wpsm-rate-us span.dashicons-star-filled:before {
				content: "\f155";
				font-size: 40px;
			}
		</style>
		   <h1>Rate Us </h1>
			<h3>Show us some love, If you like our product then please give us some valuable feedback on wordpress</h3>
			<a href="https://wordpress.org/plugins/info-box/" target="_blank" class="button button-primary button-hero ">RATE HERE</a>
			<a class="wpsm-rate-us" style=" text-decoration: none; height: 40px; width: 40px;" href="https://wordpress.org/plugins/info-box/" target="_blank">
				<span class="dashicons dashicons-star-filled"></span>
				<span class="dashicons dashicons-star-filled"></span>
				<span class="dashicons dashicons-star-filled"></span>
				<span class="dashicons dashicons-star-filled"></span>
				<span class="dashicons dashicons-star-filled"></span>
			</a>
		<?php 
	}
	
	public function wpsm_pic_ib_pro_demo_shortcode(){
		?>
		<style>
			#infobox_pro_get{
			background:#fff!important;
			box-shadow: 0 0 20px rgba(0,0,0,.2);
			}
			#infobox_pro_get .hndle , #infobox_pro_get .handlediv{
			display:none;
			}
			#infobox_pro_get p{
			color:#000;
			font-size:15px;
			}
			
			
			
		</style>
		<h1>Pro Version Demos</h1>
		<div style="overflow:hidden;display:block;width:100%;padding-top:20px">
			<div class="col-md-12">
				<div class="col-md-3" style="margin-bottom:20px;">
					<a class="button button-primary button-hero " style="width:100%;text-align:center"  href="http://demo.wpshopmart.com/colorbox-pro/" target="_new">Colorbox Main Demo</a>
				</div>
				<div class="col-md-3" style="margin-bottom:20px;">
					<a class="button button-primary button-hero " style="width:100%;text-align:center"  href="http://demo.wpshopmart.com/colorbox-pro/masonry-layout/" target="_new">Masonry Effect</a>
				</div>
				<div class="col-md-3" style="margin-bottom:20px;">
					<a class="button button-primary button-hero " style="width:100%;text-align:center"  href="http://demo.wpshopmart.com/colorbox-pro/same-height/" target="_blank">Same Height</a>
				</div>
				<div class="col-md-3" style="margin-bottom:20px;">
					<a class="button button-primary button-hero " style="width:100%;text-align:center"  href="http://demo.wpshopmart.com/colorbox-pro/box-with-random-color/" target="_blank">Random Color</a>
				</div>
				<div class="col-md-3" style="margin-bottom:20px;">
					<a class="button button-primary button-hero " style="width:100%;text-align:center"  href="http://demo.wpshopmart.com/colorbox-pro/box-with-links/" target="_blank">Box With Link</a>
				</div>
				<div class="col-md-3" style="margin-bottom:20px;">
					<a class="button button-primary button-hero " style="width:100%;text-align:center"  href="http://demo.wpshopmart.com/colorbox-pro/box-animations/" target="_blank">Box With Animations</a>
				</div>
				<div class="col-md-3" style="margin-bottom:20px;">
					<a class="button button-primary button-hero " style="width:100%;text-align:center"  href="http://demo.wpshopmart.com/colorbox-pro/box-overlays/" target="_blank">Box Overlay/Styles</a>
				</div>
				<div class="col-md-3" style="margin-bottom:20px;">
					<a class="button button-primary button-hero " style="width:100%;text-align:center"  href="http://demo.wpshopmart.com/colorbox-pro/1-column/" target="_blank">Box Column Layout 1</a>
				</div>
				<div class="col-md-3" style="margin-bottom:20px;">
					<a class="button button-primary button-hero " style="width:100%;text-align:center"  href="http://demo.wpshopmart.com/colorbox-pro/2-column-layout/" target="_blank">Box Column Layout 2</a>
				</div>
				<div class="col-md-3" style="margin-bottom:20px;">
					<a class="button button-primary button-hero " style="width:100%;text-align:center"  href="http://demo.wpshopmart.com/colorbox-pro/3-column-layout/" target="_blank">Box Column Layout 3</a>
				</div>
				<div class="col-md-3" style="margin-bottom:20px;">
					<a class="button button-primary button-hero " style="width:100%;text-align:center"  href="http://demo.wpshopmart.com/colorbox-pro/4-column/" target="_blank">Box Column Layout 4</a>
				</div>
				<div class="col-md-3" style="margin-bottom:20px;">
					<a class="button button-primary button-hero " style="width:100%;text-align:center"  href="http://demo.wpshopmart.com/colorbox-pro/5-column/" target="_blank">Box Column Layout 5</a>
				</div>
				<div class="col-md-3" style="margin-bottom:20px;">
					<a class="button button-primary button-hero " style="width:100%;text-align:center"  href="http://demo.wpshopmart.com/colorbox-pro/6-col/" target="_blank">Box Column Layout 6</a>
				</div>
				<div class="col-md-3" style="margin-bottom:20px;">
					<a class="button button-primary button-hero " style="width:100%;text-align:center"  href="http://demo.wpshopmart.com/colorbox-pro/8-column/" target="_blank">Box Column Layout 8</a>
				</div>
				<div class="col-md-3" style="margin-bottom:20px;">
					<a class="button button-primary button-hero " style="width:100%;text-align:center"  href="http://demo.wpshopmart.com/colorbox-pro/10-column/" target="_blank">Box Column Layout 10</a>
				</div>
			
			</div>
			<div class="col-md-12">
				<div class="col-md-4" style="margin-bottom:20px;">
					<a class="portfolio_read_more_btn " href="https://wpshopmart.com/plugins/colorbox-pro/" target="_blank">Get Colorbox Pro Only In $5</a>
				</div>
				<div class="col-md-4" style="margin-bottom:20px;">
					<a class="portfolio_demo_btn  " href="http://demo.wpshopmart.com/colorbox-pro/" target="_blank">View Complete Demo</a>
				</div>
			</div>
		</div>
		<?php
		
	}
	
	public function wpsm_pic_ib_pro_more(){
	?>
		<style>
			#infobox_pro_more{
			background:#fff!important;
			box-shadow: 0 0 20px rgba(0,0,0,.2);
			}
			#infobox_pro_more .hndle , #infobox_pro_more .handlediv{
			display:none;
			}
			#infobox_pro_more p{
			color:#000;
			font-size:15px;
			}
			.wpsm-theme-container {
				background: #fff;
				padding-left: 0px;
				padding-right: 0px;
				box-shadow: 0 0 20px rgba(0,0,0,.2);
			}
			.wpsm_site-img-responsive {
				display: block;
				width: 100%;
				height: auto;
			}
			.wpsm_product_wrapper {
				padding: 20px;
				overflow: hidden;
			}
			.wpsm_product_wrapper h3 {
				float: left;
				margin-bottom: 0px;
				color: #000 !important;
				letter-spacing: 0px;
				text-transform: uppercase;
				font-size: 18px;
				font-weight: 700;
				text-align: left;
				margin:0px;
			}
			.wpsm_product_wrapper h3 span {
				display: block;
				float: left;
				width: 100%;
				overflow: hidden;
				font-size: 14px;
				color: #919499;
				margin-top: 6px;
			}
			.wpsm_product_wrapper .price {
				float: right;
				font-size: 24px;
				color: #000;
				font-family: sans-serif;
				font-weight: 500;
			}
			.wpsm-btn-block {
				overflow: hidden;
				float: left;
				width: 100%;
				margin-top: 20px;
				display: block;
			}
			.portfolio_read_more_btn {
				border: 1px solid #E83F33;
				border-radius: 0px;
				margin-bottom: 10px;
				text-transform: uppercase;
				font-weight: 700;
				font-size: 15px;
				padding: 12px 12px;
				display: block;
				text-align:center;
				width:100%;
				border-radius: 2px;
				cursor: pointer;
				letter-spacing: 1px;
				outline: none;
				position: relative;
				text-decoration: none !important;
				color: #fff !important;
				-webkit-transition: all ease 0.5s;
				-moz-transition: all ease 0.5s;
				transition: all ease 0.5s;
				background: #E83F33;
				padding-left: 22px;
				padding-right: 22px;
			}
			.portfolio_demo_btn {
				border: 1px solid #919499;
				border-radius: 0px;
				margin-bottom: 10px;
				text-transform: uppercase;
				font-weight: 700;
				font-size: 15px;
				padding: 12px 12px;
				display: block;
				text-align:center;
				width:100%;
				border-radius: 2px;
				cursor: pointer;
				letter-spacing: 1px;
				outline: none;
				position: relative;
				text-decoration: none !important;
				background-color: #242629;
				border-color: #242629;
				color: #fff !important;
				-webkit-transition: all ease 0.5s;
				-moz-transition: all ease 0.5s;
				transition: all ease 0.5s;
				padding-left: 22px;
				padding-right: 22px;
			}
		</style>
		<h1>More Recommended Premium Plugin From Wpshopmart</h1>
			<div style="overflow:hidden;display:block;width:100%;padding-top:20px;padding-bottom:20px">
				<div class="col-md-12">
					<div class="col-md-4"> 
						<a href="https://wpshopmart.com/plugins/colorbox-pro/" target="_blank" title="ColorBox Pro">
							<div class="wpsm-theme-container" style="">
								<img width="700" height="394" src="<?php echo wpshopmart_infobox_directory_url.'assets/images/cb.png'; ?>" class="wpsm_site-img-responsive wp-post-image" alt="Colorbox and panels pro plugin">
								<div class="wpsm_product_wrapper">
									<h3>ColorBox Pro <span>wordpress</span></h3>
									<span class="price"><span class="amount">$5</span></span>
									<div class="wpsm-btn-block" style="">
																		
										<a title="Check Detail" target="_blank" href="https://wpshopmart.com/plugins/colorbox-pro/" class="portfolio_read_more_btn pull-left">Check Detail</a>
										<a title="View Demo" target="_blank" href="http://demo.wpshopmart.com/colorbox-pro/" class="portfolio_demo_btn pull-right">View Demo</a>
									</div>
								</div>
							</div>
						</a>
					</div>
					<div class="col-md-4"> 
						<a href="https://wpshopmart.com/plugins/accordion-pro/" target="_blank" title="Accordion Pro">
							<div class="wpsm-theme-container" style="">
								<img width="700" height="394" src="<?php echo wpshopmart_infobox_directory_url.'assets/images/ac.png'; ?>" class="wpsm_site-img-responsive wp-post-image" alt="Colorbox and panels pro plugin">
								<div class="wpsm_product_wrapper">
									<h3>Accordion Pro<span>wordpress</span></h3>
									<span class="price"><span class="amount">$9</span></span>
									<div class="wpsm-btn-block" style="">
																		
										<a title="Check Detail" target="_blank" href="https://wpshopmart.com/plugins/accordion-pro/" class="portfolio_read_more_btn pull-left">Check Detail</a>
										<a title="View Demo" target="_blank" href="http://demo.wpshopmart.com/accordion-pro/" class="portfolio_demo_btn pull-right">View Demo</a>
									</div>
								</div>
							</div>
						</a>
					</div>
					
					<div class="col-md-4"> 
						<a href="https://wpshopmart.com/plugins/coming-soon-pro/" target="_blank" title="Coming Soon Pro">
							<div class="wpsm-theme-container" style="">
								<img width="700" height="394" src="<?php echo wpshopmart_infobox_directory_url.'assets/images/csp.png'; ?>" class="wpsm_site-img-responsive wp-post-image" alt="Colorbox and panels pro plugin">
								<div class="wpsm_product_wrapper">
									<h3>Coming Soon Pro <span>wordpress</span></h3>
									<span class="price"><span class="amount">$19</span></span>
									<div class="wpsm-btn-block" style="">
										<a title="Check Detail" target="_blank" href="https://wpshopmart.com/plugins/coming-soon-pro/" class="portfolio_read_more_btn pull-left">Check Detail</a>
										<a title="View Demo" target="_blank" href="https://wpshopmart.com/coming-soon-pro-demo-page/" class="portfolio_demo_btn pull-right">View Demo</a>
									</div>
								</div>
							</div>
						</a>
					</div>
				</div>
			</div>		
	<?php 	
		
	}
	
}
global $wpsm_infobox;
$wpsm_infobox = wpsm_infobox::forge();

 ?>