<?php if ( ! defined( 'ABSPATH' ) ) exit;  ?>
<script>
var j = 1000;
	function add_new_content(){
	var output = 	'<li class="wpsm_ac-panel single_color_box" >'+
		'<span class="ac_label"><?php _e("Box Title",wpshopmart_infobox_text_domain); ?></span>'+
		'<input type="text" id="infobox_title[]" name="infobox_title[]" value="" placeholder="Enter Box Title Here" class="wpsm_ac_label_text">'+
		'<span class="ac_label"l><?php _e("Box Description",wpshopmart_infobox_text_domain); ?></span>'+
		'<textarea  id="infobox_desc[]" name="infobox_desc[]"  placeholder="Enter Box Description Here" class="wpsm_ac_label_text"></textarea>'+
		'<a type="button" class="btn btn-primary btn-block html_editor_button" data-remodal-target="modal" href="#"  id="'+j+'" onclick="open_editor('+j+')">Use WYSIWYG Editor </a>'+
		'<a class="remove_button" href="#delete" id="remove_bt"><i class="fa fa-trash-o"></i></a>'+
		'</li>';
	jQuery(output).hide().appendTo("#infobox_panel").slideDown("slow");
	j++;
	call_icon();
	}
	jQuery(document).ready(function(){

	  jQuery('#infobox_panel').sortable({
	  
	   revert: true,
	     
	  });
	});
	
	
</script>
<script>
	jQuery(function(jQuery)
		{
			var infobox = 
			{
				infobox_ul: '',
				init: function() 
				{
					this.infobox_ul = jQuery('#infobox_panel');

					this.infobox_ul.on('click', '.remove_button', function() {
					if (confirm('Are you sure you want to delete this?')) {
						jQuery(this).parent().slideUp(600, function() {
							jQuery(this).remove();
						});
					}
					return false;
					});
					 jQuery('#delete_all_infobox').on('click', function() {
						if (confirm('Are you sure you want to delete all the Colorbox?')) {
							jQuery(".single_color_box").slideUp(600, function() {
								jQuery(".single_color_box").remove();
							});
							jQuery('html, body').animate({ scrollTop: 0 }, 'fast');
							
						}
						return false;
					});
					
			   }
			};
		infobox.init();
	});
</script>


<script>
	
	
	function open_editor(id){
		

		var value = jQuery("#"+id).closest('li').find('textarea').val();
		
		 jQuery("#get_text-html").click();
		jQuery("#get_text").val(value);
		
		jQuery("#get_id").val(jQuery("#"+id).attr('id'));
	 }
	
	
	function insert_html(){
		jQuery("#get_text-html").click();
		var html_text = jQuery("#get_text").val();
		var id = jQuery("#get_id").val();
		jQuery("#"+id).closest('li').find('textarea').val(html_text);
			
	}
	
	
</script>