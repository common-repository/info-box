<?php
	if ( ! defined( 'ABSPATH' ) ) exit; 
	$post_type = "infobox_panels";
	
    $AllInfobox = array(  'p' => $WPSM_Infobox_ID, 'post_type' => $post_type, 'orderby' => 'ASC');
    $loop = new WP_Query( $AllInfobox );
	
	while ( $loop->have_posts() ) : $loop->the_post();
		//get the post id
		$post_id = get_the_ID();
		
		$Infobox_Settings = unserialize(get_post_meta( $post_id, 'Infobox_Settings', true));
		if(count($Infobox_Settings)) 
		{
			$option_names = array(
				"infobox_radius"      	 => "yes",
				"show_infobox_title_align" => "center",
				"enable_infobox_border"   => "yes",
				"Infobox_shadow"         => "yes",
				"box_layout"              => 4,
				"infobox_desc_font_clr"  => "#5e5e5e",
				"infobox_title_clr"  => "#5e5e5e",
				"infobox_bg_clr"  => "#eaeaea",
				"infobox_border_clr"  => "#d9d9d9",
				"show_infobox_desc_align"  => "center",
				"title_size"         => "24",
				"des_size"     		 => "20",
				"font_family"     	 => "Open Sans",
				"custom_css"      =>"",
				);
			
			foreach($option_names as $option_name => $default_value) {
				if(isset($Infobox_Settings[$option_name])) 
					${"" . $option_name}  = $Infobox_Settings[$option_name];
				else
					${"" . $option_name}  = $default_value;
			}
		}
				
		
		$infobox_data = unserialize(get_post_meta( $post_id, 'wpsm_infobox_data', true));
		$TotalCount =  get_post_meta( $post_id, 'wpsm_infobox_count', true );
		if($TotalCount>0) 
		{
			$i=1;
			switch($box_layout){
					case(12):
						$row=1;
					break;
					case(6):
						$row=2;
					break;
					case(4):
						$row=3;
					break;
					case(3):
						$row=4;
					break;
				}
		?>
		
				<style>
					<?php 
					require('style.php');
					echo $custom_css; ?>
				</style>
				<div id="infobox_main_container_<?php echo $post_id;  ?>" style="infobox_main_container">
					<div class="wpsm_row">  
					<?php
					foreach($infobox_data as $infobox_single_data)
					{
						 $infobox_title = $infobox_single_data['infobox_title'];
						 $infobox_desc = $infobox_single_data['infobox_desc'];
						
					?>
					<div class=" wpsm_col-md-<?php echo $box_layout; ?> wpsm_col-sm-6 infobox_singel_box">
						<div class="wpsm_panel wpsm_panel-default wpsm_panel_default_<?php echo $post_id; ?> ">
						  
						  <div class="wpsm_panel-heading">
							<h3 class="wpsm_panel-title">
							<?php  echo $infobox_title; ?></h3>
						  </div> 
							<?php 
							if(preg_match('/\S+/',$infobox_desc)) { ?>					 
						 <div class="wpsm_panel-body">
							<?php echo do_shortcode($infobox_desc); ?>
						  </div>
						  <?php } ?> 
						</div>
					</div>
					<?php
					if($i%$row==0){
						?>
						</div>
						<div class="wpsm_row">
						<?php 
					}	
					
					 
					 $i++;
					
					}
					?>
					</div>
				</div>
				
				
			<?php
		}
		else{
			echo "<h3> No Infobox Found </h3>";
		}
	endwhile; ?>