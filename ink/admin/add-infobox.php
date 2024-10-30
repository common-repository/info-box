<?php if ( ! defined( 'ABSPATH' ) ) exit;  ?>
<div style=" overflow: hidden;padding: 10px;">
<style>
	.html_editor_button{
		border-radius:0px;
		background-color: #9C9C9C;
		border-color: #9C9C9C;
		margin-bottom:20px;
	}
	</style>
	<h3><?php _e('Add Infobox',wpshopmart_infobox_text_domain); ?></h3>
	<input type="hidden" name="infobox_save_data_action" value="infobox_save_data_action" />
	<ul class="clearfix" id="infobox_panel">
	<?php
			$i=1;
			$infobox_data = unserialize(get_post_meta( $post->ID, 'wpsm_infobox_data', true));
			 $TotalCount =  get_post_meta( $post->ID, 'wpsm_infobox_count', true );
			if($TotalCount) 
			{
				if($TotalCount!=-1)
				{
					foreach($infobox_data as $infobox_single_data)
					{
						 $infobox_title = $infobox_single_data['infobox_title'];
						 $infobox_desc = $infobox_single_data['infobox_desc'];
						 
						?>
						<li class="wpsm_ac-panel single_color_box" >
							<span class="ac_label"><?php _e('Box Title',wpshopmart_infobox_text_domain); ?></span>
							<input type="text" id="infobox_title[]" name="infobox_title[]" value="<?php echo esc_attr($infobox_title); ?>" placeholder="Enter Box Title Here" class="wpsm_ac_label_text">
							<span class="ac_label"><?php _e('Box Description',wpshopmart_infobox_text_domain); ?></span>
							<textarea  id="infobox_desc[]" name="infobox_desc[]"  placeholder="Enter Box Description Here" class="wpsm_ac_label_text"><?php echo esc_html($infobox_desc); ?></textarea>
							<a type="button" class="btn btn-primary btn-block html_editor_button" data-remodal-target="modal" href="#" id="<?php echo $i; ?>"  onclick="open_editor(<?php echo $i; ?>)">Use WYSIWYG Editor </a>
							
							
							
							<a class="remove_button" href="#delete" id="remove_bt" ><i class="fa fa-trash-o"></i></a>
							
						</li>
						<?php 
						$i++;
					} // end of foreach
				}else{
						echo "<h2>No Infobox Found</h2>";
				}
			}
			else 
			{
				  for($i=1; $i<=3; $i++)
				  {
					  ?>
					 <li class="wpsm_ac-panel single_color_box" >
						<span class="ac_label"><?php _e('Box Title',wpshopmart_infobox_text_domain); ?></span>
						<input type="text" id="infobox_title[]" name="infobox_title[]" value="Lorem ipsum dolor sit amet" placeholder="Enter Box Title Here" class="wpsm_ac_label_text">
						<span class="ac_label"><?php _e('Box Description',wpshopmart_infobox_text_domain); ?></span>
						
						<textarea  id="infobox_desc[]" name="infobox_desc[]"  placeholder="Enter Box Description Here" class="wpsm_ac_label_text">Lorem ipsum dolor sit amet, vix ut case porro facilisis, alia possit neglegentur vis te. Has cu eirmod abhorreant, vel civibus efficiantur cu. Eu summo elitr vix, iusto putant maluisset per ut, ne etiam vivendum adipisci vel. </textarea>
						<a type="button" class="btn btn-primary btn-block html_editor_button" data-remodal-target="modal" href="#" id="<?php echo $i; ?>"  onclick="open_editor(<?php echo $i; ?>)">Use WYSIWYG Editor </a>
								
						
					<a class="remove_button" href="#delete" id="remove_bt" ><i class="fa fa-trash-o"></i></a>
						
					</li>
					 <?php
				}
			}
			?>
	</ul>
	
	<div class="remodal" data-remodal-options=" closeOnOutsideClick: false" data-remodal-id="modal" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
	  <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
	  <div>
		<h2 id="modal1Title">Accordion Editor</h2>
		<p id="modal1Desc">
		  <?php
			$content = '';
			$editor_id = 'get_text';
			wp_editor( $content, $editor_id );
		?>
		<input type="hidden" value="" id="get_id" />
		</p>
	  </div>
	  <br>
	  <button data-remodal-action="cancel" class="remodal-cancel">Cancel</button>
	  <button data-remodal-action="confirm" class="remodal-confirm" onclick="insert_html()">OK</button>
	</div>
	
	<div style="display:block;margin-top:20px;overflow:hidden;width: 100%;float:left;">
		<a class="wpsm_ac-panel add_wpsm_ac_new" id="add_new_ac" onclick="add_new_content()"   >
			<?php _e('Add New InfoBox', wpshopmart_infobox_text_domain); ?>
		</a>
		<a  style="float: left;padding:10px !important;background:#31a3dd;" class=" add_wpsm_ac_new delete_all_acc" id="delete_all_infobox"    >
			<i style="font-size:57px;"class="fa fa-trash-o"></i>
			<span style="display:block"><?php _e('Delete All',wpshopmart_infobox_text_domain); ?></span>
		</a>
	</div>
	
</div>

<?php require('add-infobox-js-footer.php'); ?>