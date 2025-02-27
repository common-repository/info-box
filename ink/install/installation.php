<?php 
if ( ! defined( 'ABSPATH' ) ) exit; 
add_action('plugins_loaded', 'wpsm_infobox_tr');
function wpsm_infobox_tr() {
	load_plugin_textdomain( wpshopmart_infobox_text_domain, FALSE, dirname( plugin_basename(__FILE__)).'/languages/' );
}

function wpsm_infobox_front_script() {
    wp_enqueue_style('wpsm_infobox_bootstrap-front', wpshopmart_infobox_directory_url.'assets/css/bootstrap-front.css');
}

add_action( 'wp_enqueue_scripts', 'wpsm_infobox_front_script' );
add_filter( 'widget_text', 'do_shortcode');

function wpsm_ib_header_info() {
 	if(get_post_type()=="infobox_panels") {
		?>
		<style>
		.wpsm_ac_h_i{
			background:url('<?php echo wpshopmart_infobox_directory_url.'assets/images/slideshow-01.jpg'; ?>') 50% 0 repeat fixed;
				-webkit-box-shadow: 0px 13px 21px -10px rgba(128,128,128,1);
-moz-box-shadow: 0px 13px 21px -10px rgba(128,128,128,1);
box-shadow: 0px 13px 21px -10px rgba(128,128,128,1);
			
			margin-left: -20px;
			font-family: Myriad Pro ;
			cursor: pointer;
			text-align: center;
		}
		.wpsm_ac_h_i .wpsm_ac_h_b{
			color: white;
			font-size: 30px;
			font-weight: bolder;
			padding: 0 0 15px 0;
		}
		.wpsm_ac_h_i .wpsm_ac_h_b .dashicons{
			font-size: 40px;
			position: absolute;
			margin-left: -45px;
			margin-top: -10px;
		}
		 .wpsm_ac_h_small{
			font-weight: bolder;
			color: white;
			font-size: 18px;
			padding: 0 0 15px 15px;
		}

		.wpsm_ac_h_i a{
		text-decoration: none;
		}
		@media screen and ( max-width: 600px ) {
			.wpsm_ac_h_i{ padding-top: 60px; margin-bottom: -50px; }
			.wpsm_ac_h_i .WlTSmall { display: none; }
		}
		.texture-layer {
			background: rgba(0,0,0,0);
    padding-top: 0px;
	padding: 0px 0 23px 0;
		}
		.wpsm_ac_h_i  ul{
			padding:0px 20px 0px 50px;
		}
		.wpsm_ac_h_i  li {
			text-align:left;
			color:#fff;
			font-size: 20px;
			line-height: 1.3;
			font-weight: 600;
			
		}
		.wpsm_ac_h_i  li i{
		margin-right:10px ;
margin-bottom:10px;		
		}
		 
		  .wpsm_ac_h_i .btn-danger{
			      font-size: 29px;
				  background-color: #000000;
				  border-radius:1px;
				  margin-right:10px;
				      margin-top: 0px;
					  border-color:#000;
				 
		  }
		  .wpsm_ac_h_i .btn-success{
			      font-size: 28px;
				  border-radius:1px;
				      background-color: #ffffff;
    border-color: #ffffff;
	color:#000;
		  }
		  .btn-danger {
    color: #fff;
    background-color: #000000 !important;
    border-color: #000000 !important;
}
	
		</style>
		<div class="wpsm_ac_h_i ">
			<div class="texture-layer">
				
					<div class="wpsm_ac_h_b"><a class="btn btn-danger btn-lg " href="https://wpshopmart.com/plugins/info-bro/" target="_blank">Get Pro Version Only In $5</a><a class="btn btn-success btn-lg " href="http://demo.wpshopmart.com/info-bro/" target="_blank">View Demo</a></div>
					<div style="overflow:hidden;display:block;width:100%">
						<a href="https://wpshopmart.com/plugins/info-bro/" target="_blank">
						<div class="col-md-4">
							<ul>
								<li> <i class="fa fa-check"></i>10 Types Of Box Layouts </li>
								<li> <i class="fa fa-check"></i>8 Types Of Loading Animation </li>
								<li> <i class="fa fa-check"></i>500+ Google Fonts Integrated </li>
								<li> <i class="fa fa-check"></i>External Link Option </li>
								<li> <i class="fa fa-check"></i>4 Overlay Effect </li>
								
							</ul>
						</div>
						<div class="col-md-4">
							<ul>
								<li> <i class="fa fa-check"></i>Individual Box Color Option </li>
								<li> <i class="fa fa-check"></i>Icon Color Customization </li>
								<li> <i class="fa fa-check"></i>Border Customization Option </li>
								<li> <i class="fa fa-check"></i>Box Shadow Customization </li>
								<li> <i class="fa fa-check"></i>Border Radius Customization </li>
							</ul>
						</div>
						<div class="col-md-4">
							<ul>
								<li> <i class="fa fa-check"></i>Masonry Effect </li>
								<li> <i class="fa fa-check"></i>Default Settings Option For New Box Groups </li>
								<li> <i class="fa fa-check"></i>Icon Position and Layout Option </li>
								<li> <i class="fa fa-check"></i>Font Alignment </li>
								<li> <i class="fa fa-check"></i>Personal Support </li>
							</ul>
						</div>
						</a>
					</div>
				
			</div>
			<a href="https://wpshopmart.com/plugins/colorbox-pro/" target="_blank"><img src="<?php echo wpshopmart_infobox_directory_url.'assets/images/offer.jpg'; ?>" style="width:100%" /></a>
		
		</div>
		<?php  
	}
}
add_action('in_admin_header','wpsm_ib_header_info'); 

add_action( 'admin_notices', 'wpsm_info_b_review' );
function wpsm_info_b_review() {

	// Verify that we can do a check for reviews.
	$review = get_option( 'wpsm_info_b_review' );
	$time	= time();
	$load	= false;
	if ( ! $review ) {
		$review = array(
			'time' 		=> $time,
			'dismissed' => false
		);
		add_option('wpsm_info_b_review', $review);
		//$load = true;
	} else {
		// Check if it has been dismissed or not.
		if ( (isset( $review['dismissed'] ) && ! $review['dismissed']) && (isset( $review['time'] ) && (($review['time'] + (DAY_IN_SECONDS * 2)) <= $time)) ) {
			$load = true;
		}
	}
	// If we cannot load, return early.
	if ( ! $load ) {
		return;
	}

	// We have a candidate! Output a review message.
	?>
	<div class="notice notice-info is-dismissible wpsm-info-b-review-notice">
		<div style="float:left;margin-right:10px;margin-bottom:5px;">
			<img style="width: 120px;height: auto;" src="<?php echo wpshopmart_infobox_directory_url.'assets/images/show-icon.png'; ?>" />
		</div>
		
		
		<p style="font-size:18px;">'A big sale Get  <strong>30% off </strong> on our every Wordpress Plugins (including Infobox Plugin) hurry up offer is expire on <strong>31st December </strong> USE THIS COUPON CODE  -  <strong style="color:#ef4238">OFF30</strong></p>
		<p style="font-size:18px;"><strong><?php _e( '~ wpshopmart', '' ); ?></strong></p>
		<p style="font-size:19px;"> 
			<a style="color: #fff;background: #ed1c94;padding: 4px 10px 8px 10px;border-radius: 4px;text-decoration: none;" href="https://wpshopmart.com/plugins/" class="wpsm-info-b-dismiss-review-notice wpsm-info-b-review-out" target="_blank" rel="noopener">Grab This Offer Now </a>&nbsp; &nbsp;
			<a style="color: #fff;background: #27d63c;padding: 4px 10px 8px 10px;border-radius: 4px;text-decoration: none;" href="#"  class="wpsm-info-b-dismiss-review-notice wpsm-rate-later" target="_self" rel="noopener"><?php _e( 'No, I am not interested', '' ); ?></a>&nbsp; &nbsp;
			<a style="color: #fff;background: #31a3dd;padding: 4px 10px 8px 10px;border-radius: 4px;text-decoration: none;" href="#" class="wpsm-info-b-dismiss-review-notice wpsm-rated" target="_self" rel="noopener"><?php _e( 'I already Purchased', '' ); ?></a>
		</p>
	</div>
	<script type="text/javascript">
		jQuery(document).ready( function($) {
			$(document).on('click', '.wpsm-info-b-dismiss-review-notice, .wpsm-info-b-dismiss-notice .notice-dismiss', function( event ) {
				if ( $(this).hasClass('wpsm-info-b-review-out') ) {
					var wpsm_rate_data_val = "1";
				}
				if ( $(this).hasClass('wpsm-rate-later') ) {
					var wpsm_rate_data_val =  "2";
					event.preventDefault();
				}
				if ( $(this).hasClass('wpsm-rated') ) {
					var wpsm_rate_data_val =  "3";
					event.preventDefault();
				}

				$.post( ajaxurl, {
					action: 'wpsm_info_b_dismiss_review',
					wpsm_rate_data_info_b : wpsm_rate_data_val
				});
				
				$('.wpsm-info-b-review-notice').hide();
				//location.reload();
			});
		});
	</script>
	<?php
}

add_action( 'wp_ajax_wpsm_info_b_dismiss_review', 'wpsm_info_b_dismiss_review' );
function wpsm_info_b_dismiss_review() {
	if ( ! $review ) {
		$review = array();
	}
	
	if($_POST['wpsm_rate_data_info_b']=="1"){
		
	}
	if($_POST['wpsm_rate_data_info_b']=="2"){
		$review['time'] 	 = time();
		$review['dismissed'] = false;
		update_option( 'wpsm_info_b_review', $review );
	}
	if($_POST['wpsm_rate_data_info_b']=="3"){
		$review['time'] 	 = time();
		$review['dismissed'] = true;
		update_option( 'wpsm_info_b_review', $review );
	}
	
	die;
}
?>