<?php 
if ( ! defined( 'ABSPATH' ) ) exit; 
 $PostId = $post->ID;
 $Infobox_Settings = unserialize(get_post_meta( $PostId, 'Infobox_Settings', true));
		
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
?>

<Script>

 //Title Size Slider 
  jQuery(function() {
    jQuery( "#title_size_id" ).slider({
		orientation: "horizontal",
		range: "min",
		max: 60,
		min:5,
		slide: function( event, ui ) {
		jQuery( "#title_size" ).val( ui.value );
      }
		});
		
		jQuery( "#title_size_id" ).slider("value",<?php echo $title_size; ?> );
		jQuery( "#title_size" ).val( jQuery( "#title_size_id" ).slider( "value") );
    
  });
</script>
<Script>

 //minimum flake size script
  jQuery(function() {
    jQuery( "#des_size_id" ).slider({
		orientation: "horizontal",
		range: "min",
		max: 30,
		min:5,
		slide: function( event, ui ) {
		jQuery( "#des_size" ).val( ui.value);
      }
		});
		
		jQuery( "#des_size_id" ).slider("value",<?php echo $des_size; ?>);
		jQuery( "#des_size" ).val( jQuery( "#des_size_id" ).slider( "value") );
    
  });
</script>  
<input type="hidden" id="infobox_setting_save_action" name="infobox_setting_save_action" value="infobox_setting_save_action"/>
		
<table class="form-table acc_table">
	<tbody>
	<tr >
			<th scope="row"><label><?php _e('Info Box Background Color',wpshopmart_infobox_text_domain); ?></label></th>
			<td>
				<input id="infobox_bg_clr" name="infobox_bg_clr" type="text" value="<?php echo $infobox_bg_clr; ?>" class="my-color-field" data-default-color="#000000" />
				
			</td>
		</tr>
		
		<tr >
			<th scope="row"><label><?php _e('Box Title Font Color',wpshopmart_infobox_text_domain); ?></label></th>
			<td>
				<input id="infobox_title_clr" name="infobox_title_clr" type="text" value="<?php echo $infobox_title_clr; ?>" class="my-color-field" data-default-color="#ffffff" />
				
			</td>
		</tr>
		
		
		
		<tr >
			<th scope="row"><label><?php _e('Box Description Font Color',wpshopmart_infobox_text_domain); ?></label></th>
			<td>
				<input id="infobox_desc_font_clr" name="infobox_desc_font_clr" type="text" value="<?php echo $infobox_desc_font_clr; ?>" class="my-color-field" data-default-color="#000000" />
				
			</td>
		</tr>
		<tr >
			<th scope="row"><label><?php _e('Box Border Color',wpshopmart_infobox_text_domain); ?></label></th>
			<td>
				<input id="infobox_border_clr" name="infobox_border_clr" type="text" value="<?php echo $infobox_border_clr; ?>" class="my-color-field" data-default-color="#000000" />
				
			</td>
		</tr>
		
		
		
		<tr>
			<th scope="row"><label><?php _e('Title Position Alignment',wpshopmart_infobox_text_domain); ?></label></th>
			<td>
				<span style="display:block;margin-bottom:10px"><input type="radio" name="show_infobox_title_align" id="show_infobox_title_align" value="left" <?php if($show_infobox_title_align == 'left' ) { echo "checked"; } ?> /> Left</span>
				<span style="display:block;margin-bottom:10px"><input type="radio" name="show_infobox_title_align" id="show_infobox_title_align" value="center" <?php if($show_infobox_title_align == 'center' ) { echo "checked"; } ?> /> Center </span>
				<span style="display:block;margin-bottom:10px"><input type="radio" name="show_infobox_title_align" id="show_infobox_title_align" value="right" <?php if($show_infobox_title_align == 'right' ) { echo "checked"; } ?>  /> Right </span>
				
			</td>
		</tr>
		
		<tr>
			<th scope="row"><label><?php _e('Description Position Alignment',wpshopmart_infobox_text_domain); ?></label></th>
			<td>
				<span style="display:block;margin-bottom:10px"><input type="radio" name="show_infobox_desc_align" id="show_infobox_desc_align" value="left" <?php if($show_infobox_desc_align == 'left' ) { echo "checked"; } ?> /> Left</span>
				<span style="display:block;margin-bottom:10px"><input type="radio" name="show_infobox_desc_align" id="show_infobox_desc_align" value="center" <?php if($show_infobox_desc_align == 'center' ) { echo "checked"; } ?> /> Center </span>
				<span style="display:block;margin-bottom:10px"><input type="radio" name="show_infobox_desc_align" id="show_infobox_desc_align" value="right" <?php if($show_infobox_desc_align == 'right' ) { echo "checked"; } ?>  /> Right </span>
				
			</td>
		</tr>
		
		<tr >
			<th><?php _e('Box Design Layout',wpshopmart_infobox_text_domain); ?> </th>
			<td>
				
				<select name="box_layout" id="box_layout" class="standard-dropdown" style="width:100%" >
					
						<option value="12"  <?php if($box_layout == '12') { echo "selected"; } ?>>One Column Layout</option>
						<option value="6"  <?php if($box_layout == '6') { echo "selected"; } ?>>Two Column Layout</option>
						<option value="4"  <?php if($box_layout == '4') { echo "selected"; } ?>>Three Column Layout</option>
						<option value="3"  <?php if($box_layout == '3') { echo "selected"; } ?>>Four Column Layout</option>
						
				</select>
					<div style="margin-top:15px;display:block;overflow:hidden;width:100%;"> <a style="margin-top:10px" href="https://wpshopmart.com/plugins/colorbox-pro/" target="_balnk">Unlock More column Layout In Premium Version</a> </div>
			
			</td>
		</tr>
		
		
		
		
		
		
		<tr class="setting_color">
			<th><?php _e('Title/Icon Font Size',wpshopmart_infobox_text_domain); ?> </th>
			<td>
				<div id="title_size_id" class="size-slider" ></div>
				<input type="text" class="slider-text" id="title_size" name="title_size"  readonly="readonly">
				
			</td>
		</tr>
		
		<tr class="setting_color">
			<th><?php _e('Description Font Size',wpshopmart_infobox_text_domain); ?> </th>
			<td>
				<div id="des_size_id" class="size-slider" ></div>
				<input type="text" class="slider-text" id="des_size" name="des_size"  readonly="readonly">
				
			</td>
		</tr>
		<tr >
			<th><?php _e('Font Style/Family',wpshopmart_infobox_text_domain); ?> </th>
			<td>
				<select name="font_family" id="font_family" class="standard-dropdown" style="width:100%" >
					<optgroup label="Default Fonts">
						<option value="Arial"           <?php if($font_family == 'Arial' ) { echo "selected"; } ?>>Arial</option>
						<option value="Arial Black"       <?php if($font_family == 'Arial Black' ) { echo "selected"; } ?>>Arial Black</option>
						<option value="Courier New"     <?php if($font_family == 'Courier New' ) { echo "selected"; } ?>>Courier New</option>
						<option value="Georgia"         <?php if($font_family == 'Georgia' ) { echo "selected"; } ?>>Georgia</option>
						<option value="Grande"          <?php if($font_family == 'Grande' ) { echo "selected"; } ?>>Grande</option>
						<option value="Helvetica" 	    <?php if($font_family == 'Helvetica' ) { echo "selected"; } ?>>Helvetica Neue</option>
						<option value="Impact"         <?php if($font_family == 'Impact' ) { echo "selected"; } ?>>Impact</option>
						<option value="Lucida"         <?php if($font_family == 'Lucida' ) { echo "selected"; } ?>>Lucida</option>
						<option value="Lucida Grande"         <?php if($font_family == 'Lucida Grande' ) { echo "selected"; } ?>>Lucida Grande</option>
						<option value="Open Sans"   <?php if($font_family == 'Open Sans' ) { echo "selected"; } ?>>Open Sans</option>
						<option value="OpenSansBold"   <?php if($font_family == 'OpenSansBold' ) { echo "selected"; } ?>>OpenSansBold</option>
						<option value="Palatino Linotype"       <?php if($font_family == 'Palatino Linotype' ) { echo "selected"; } ?>>Palatino</option>
						<option value="Sans"           <?php if($font_family == 'Sans' ) { echo "selected"; } ?>>Sans</option>
						<option value="sans-serif"           <?php if($font_family == 'sans-serif' ) { echo "selected"; } ?>>Sans-Serif</option>
						<option value="Tahoma"         <?php if($font_family == 'Tahoma' ) { echo "selected"; } ?>>Tahoma</option>
						<option value="Times New Roman"          <?php if($font_family == 'Times New Roman' ) { echo "selected"; } ?>>Times New Roman</option>
						<option value="Trebuchet"      <?php if($font_family == 'Trebuchet' ) { echo "selected"; } ?>>Trebuchet</option>
						<option value="Verdana"        <?php if($font_family == 'Verdana' ) { echo "selected"; } ?>>Verdana</option>
					</optgroup>
				</select>
				
				<div style="margin-top:15px;display:block;overflow:hidden;width:100%;"> <a style="margin-top:10px" href="https://wpshopmart.com/plugins/colorbox-pro/" target="_balnk">Unlock Google Font Style In Premium Version</a> </div>
			
			</td>
		</tr>
		
		<tr>
			<th scope="row"><label><?php _e('Enable Box Border',wpshopmart_infobox_text_domain); ?></label></th>
			<td>
				<div class="switch">
					<input type="radio" class="switch-input" name="enable_infobox_border" value="yes" id="enable_infobox_border" <?php if($enable_infobox_border == 'yes' ) { echo "checked"; } ?>   >
					<label for="enable_infobox_border" class="switch-label switch-label-off"><?php _e('Yes',wpshopmart_infobox_text_domain); ?></label>
					<input type="radio" class="switch-input" name="enable_infobox_border" value="no" id="disable_infobox_border"  <?php if($enable_infobox_border == 'no' ) { echo "checked"; } ?> >
					<label for="disable_infobox_border" class="switch-label switch-label-on"><?php _e('No',wpshopmart_infobox_text_domain); ?></label>
					<span class="switch-selection"></span>
				</div>
				
			</td>
		</tr>
		
		<tr>
			<th scope="row"><label><?php _e('Enable Box Radius ',wpshopmart_infobox_text_domain); ?></label></th>
			<td>
				<div class="switch">
					<input type="radio" class="switch-input" name="infobox_radius" value="yes" id="enable_infobox_radius" <?php if($infobox_radius == 'yes' ) { echo "checked"; } ?>  >
					<label for="enable_infobox_radius" class="switch-label switch-label-off"><?php _e('Yes',wpshopmart_infobox_text_domain); ?></label>
					<input type="radio" class="switch-input" name="infobox_radius" value="no" id="disable_infobox_radius" <?php if($infobox_radius == 'no' ) { echo "checked"; } ?> >
					<label for="disable_infobox_radius" class="switch-label switch-label-on"><?php _e('No',wpshopmart_infobox_text_domain); ?></label>
					<span class="switch-selection"></span>
				</div>
				<div style="margin-top:15px;display:block;overflow:hidden;width:100%;"> <a style="margin-top:10px" href="https://wpshopmart.com/plugins/colorbox-pro/" target="_balnk">Unlock Border Radius Customization In Premium Version</a> </div>
			
			</td>
		</tr>
		
		
		
		<tr>
			<th scope="row"><label><?php _e('Enable Box Shadow',wpshopmart_infobox_text_domain); ?></label></th>
			<td>
				<div class="switch">
					<input type="radio" class="switch-input" name="Infobox_shadow" value="yes" id="enable_Infobox_shadow" <?php if($Infobox_shadow == 'yes' ) { echo "checked"; } ?>  >
					<label for="enable_Infobox_shadow" class="switch-label switch-label-off"><?php _e('Yes',wpshopmart_infobox_text_domain); ?></label>
					<input type="radio" class="switch-input" name="Infobox_shadow" value="no" id="disable_Infobox_shadow"  <?php if($Infobox_shadow == 'no' ) { echo "checked"; } ?> >
					<label for="disable_Infobox_shadow" class="switch-label switch-label-on"><?php _e('No',wpshopmart_infobox_text_domain); ?></label>
					<span class="switch-selection"></span>
				</div>
				
					
			</td>
		</tr>
			<tr>
			<th scope="row"><label><?php _e('Enable Individual Color Option On Each Box ',wpshopmart_infobox_text_domain); ?></label></th>
			<td>
				<div class="switch wpsm_off">
					<input type="radio" class="switch-input" name="ind_color" value="yes" id="enable_ind_color"   >
					<label for="enable_ind_color" class="switch-label switch-label-off"><?php _e('Yes',wpshopmart_infobox_text_domain); ?></label>
					<input type="radio" class="switch-input" name="ind_color" value="no" id="disable_ind_color"  checked>
					<label for="disable_ind_color" class="switch-label switch-label-on"><?php _e('No',wpshopmart_infobox_text_domain); ?></label>
					<span class="switch-selection"></span>
				</div>
				<div style="margin-top:10px;display:block;overflow:hidden;width:100%;"> <a style="margin-top:10px" href="https://wpshopmart.com/plugins/colorbox-pro/" target="_balnk">Available In Premium Version</a></div>
			</td>
		</tr>
		
		<tr>
			<th scope="row"><label><?php _e('Enable Link On Box ',wpshopmart_infobox_text_domain); ?></label></th>
			<td>
				<div class="switch wpsm_off">
					<input type="radio" class="switch-input" name="acc_hover" value="yes" id="enable_acc_hover"   >
					<label for="enable_acc_hover" class="switch-label switch-label-off"><?php _e('Yes',wpshopmart_infobox_text_domain); ?></label>
					<input type="radio" class="switch-input" name="acc_hover" value="no" id="disable_acc_hover"  checked>
					<label for="disable_acc_hover" class="switch-label switch-label-on"><?php _e('No',wpshopmart_infobox_text_domain); ?></label>
					<span class="switch-selection"></span>
				</div>
				<div style="margin-top:10px;display:block;overflow:hidden;width:100%;"> <a style="margin-top:10px" href="https://wpshopmart.com/plugins/colorbox-pro/" target="_balnk">Available In Premium Version</a></div>
			</td>
		</tr>
		
	</tbody>
</table>

<script>
		jQuery(function() {
jQuery(".wpsm_off *").attr("disabled", "disabled").off('click');

});
		
		</script>