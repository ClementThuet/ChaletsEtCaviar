<?php
/**
 * @author Bill Minozzi
 * @copyright 2017
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>    
<script type="text/javascript">
function goBack() {
   window.history.back(); 
}
</script>    
<?php 
$my_theme =  strtolower(wp_get_theme());
if ($my_theme == 'twenty fourteen')
{
?>
<style type="text/css">
<!--
	.site::before {
    width: 0px !important;
}
-->
</style>
<?php 
}
 get_header();
  ?>
	    <div id="container2"> 
         <?php 
        if(isset($_SERVER['HTTP_REFERER']))
         {?>
          <center>
          <button onclick="goBack()">
          <?php 
          echo __('Back', 'realestate');?> 
          </button>
          <br /><br />
          </center>
        <?php } ?> 
        
 
             <?php realestaterightnow_profile(); ?>           
                                
            <div id="content2" role="main">
            
              

                     
            
            
            
            
				<?php realestate_detail();
               $RealEstate_enable_contact_form = trim(get_option('RealEstate_enable_contact_form', 'yes'));
               if ($RealEstate_enable_contact_form == 'yes')
               {               
                ?>
                 <br />
                 <center>
                 <button id="RealEstate_cform">
                 <?php echo __('Contact Us', 'realestate'); ?>
                 </button>
                 </center>
                 <br />
			</div> 
            <?php 
            } 
               if ($RealEstate_enable_contact_form == 'yes')               
                   include_once (REALESTATEPATH . 'includes/contact-form/multi-contact-show-form.php');  
         ?>  
		</div>
<?php 
        $registered_sidebars = wp_get_sidebars_widgets();
        foreach( $registered_sidebars as $sidebar_name => $sidebar_widgets ) {
        	unregister_sidebar( $sidebar_name );
        }
get_footer(); 
?>