<?php 
if ( ! defined( 'ABSPATH' ) ) exit; 
?>
.infobox_main_container{
	display:block;
	overflow:hidden;
	width:100%;
	padding-top:10px;
	padding-bottom:10px;
}
#infobox_main_container_<?php echo $post_id; ?> .wpsm_panel {
	margin-bottom: 0px !important;
	
	<?php if($enable_infobox_border=="yes"){ ?>
	border: 2px solid <?php echo $infobox_border_clr; ?>;
	<?php } else { ?>
	border: 0px solid <?php echo $infobox_border_clr; ?>;
	<?php } ?>
	
	<?php if($infobox_radius=="yes"){ ?>
	border-radius: 4px;
	<?php } else { ?>
	border-radius: 0px;
	<?php } ?>
	<?php if($Infobox_shadow=="yes"){ ?>
	-webkit-box-shadow: 0 0 20px rgba(0,0,0,.2);
	box-shadow: 0 0 20px rgba(0,0,0,.2);
	   
	<?php } ?>
	background:<?php echo $infobox_bg_clr; ?>;
}

#infobox_main_container_<?php echo $post_id; ?> .wpsm_panel-default > .wpsm_panel-heading {
	border-color: rgba(0,0,0,0.05);
	border-top-left-radius: 0px;
	border-top-right-radius: 0px;
	color:<?php echo $infobox_title_clr; ?>;
	background-color:transparent !important;
	padding:15px 15px;
	text-align:<?php echo $show_infobox_title_align; ?>;
	}

#infobox_main_container_<?php echo $post_id; ?> .infobox_singel_box{
  margin-bottom:20px !important;
	  padding-top: 5px;
}
#infobox_main_container_<?php echo $post_id; ?> .wpsm_panel-title{
	margin-top: 0 !important;
	margin-bottom: 0 !important;
	font-size: <?php echo $title_size; ?>px !important;
	font-family: <?php echo $font_family; ?> !important;
	word-wrap:break-word;
	

}
#infobox_main_container_<?php echo $post_id; ?> .wpsm_panel-title span{
	font-size: <?php echo $title_size; ?>px !important;
	vertical-align: middle;
	
}
#infobox_main_container_<?php echo $post_id; ?> .wpsm_panel-body{
	color: <?php echo $infobox_desc_font_clr; ?> !important;
	font-size:<?php echo $des_size; ?>px !important;
	font-family: <?php echo $font_family; ?> !important;
	overflow:hidden;
	text-align:<?php echo $show_infobox_desc_align; ?>;
	background-color:transparent !important;
}




@media (max-width: 992px){
	.infobox_singel_box{ 
		width:50% !important;
	}
}
@media (max-width: 786px){
	.infobox_singel_box{ 
		width:100% !important;
	}
}

.wpsm_row{
	overflow:hidden;
	display:block;
	width:100%;
}