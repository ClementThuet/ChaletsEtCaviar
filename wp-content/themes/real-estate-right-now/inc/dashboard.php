<?php
/**
 * @author William Sergio Minossi
 * @copyright 2017
 */
   if(memory_status()) 
    { 
?>
      <div id="realestaterightnow-status-box">
        <div class="realestaterightnow-block-title">
          Optional
        </div>   
      <div id="realestaterightnow-help-status">
      <?php
        if($activated == '1' )
        {
           echo '<img alt="aux" id="connect_status" src="'.get_template_directory_uri().'/images/pluggedx64.png" />';
           echo '<div class= "realestaterightnow_status_row"> Opt-in: <font color="green">OK</font></div>';
           echo '</div>';
            ?> 
            <div id="realestaterightnow-connect-tip">
            Thank you for help us improve our theme. 
            You will get <strong>automatic</strong> updates for Real Estate Theme for free.
          </div> 
          <div id="realestaterightnow-update-theme">
            <form id="realestaterightnow-update-theme2" action="<?php get_theme_file_uri()?>/wp-admin/themes.php?page=real_estate" method="post" target="_self" >
                <?php      
                if($realestaterightnow_update_theme == '1')
                 $checked = 'checked';
                else
                  $checked = '';
                echo '<input id="realestaterightnow_update_theme3" name="realestaterightnow_update_theme" type="checkbox" '.$checked. ' value="yes" />  Check to enable theme automatic update.';
                ?>
            </form>
          </div>       
          <?php
        }
        else
        {
             echo '<img alt="aux" id="connect_status" src="'.get_template_directory_uri().'/images/unpluggedx64.png" />';
             echo '<div class= "realestaterightnow_status_row"> Opt-in: <font color="red">Not Yet!</font></div>';
             echo '<a href="#" id="realestaterightnow-btn-connect-now" class="button button-primary">Opt-in Now</a>';
             echo '<img alt="aux" src="/wp-admin/images/wpspin_light-2x.gif" id="realestaterightnow-imagewait" style="visibility:hidden" />';
             echo '</div>';
          ?>
          <div id="realestaterightnow-connect-tip">
            Please help us improve our theme. 
            Click Opt-in and let us know about you and your site (some not sensitive data about your usage of the theme 
            will be sent to us).
            You will get automatic updates for Real Estate Theme for free.
          </div> 
            <input type="hidden" id="version2" name="version" value="<?php echo $themeversion;?>" />
		    <input type="hidden" id="email2" name="email" value="<?php echo $email;?>" />
		    <input type="hidden" id="username2" name="username" value="<?php echo $username;?>" />
		    <input type="hidden" id="produto2" name="produto" value="real-estate-right-now" />
		    <input type="hidden" id="wpversion2" name="wpversion" value="<?php echo $wpversion;?>" />
          <?php    
        }
        ?>
   </div> 
   <?php } // end connect div 
   ?>
   <div id="realestaterightnow-steps3">
       <div class="realestaterightnow-block-title"> 
           <img alt="aux" src="<?php echo get_template_directory_uri()?>/images/3steps.png" />
           <br />   <br />
           Follow this 3 steps after install the theme:
       </div>
    <div class="realestaterightnow-help-container1">
        <div class="realestaterightnow-help-column realestaterightnow-help-column-1">
        <img alt="aux" src="<?php echo get_template_directory_uri()?>/images/step1.png" />
          <h3>Install Plugins</h3>
          After activate the theme, will show up top of your desktop:
           <em>Begin Installing Plugins</em>.
           <br />
          Just click over to install and activate all the required plugins.
           <br />
           Free Plugins included:
           <br />
           - Real Estate Plugin
           <br />
           - Anti Hacker Protection 
           <br />
           - Slider, Shortcodes, More ...
           <br />
       </div> <!-- "Column1">  -->      
        <div class="realestaterightnow-help-column realestaterightnow-help-column-2">
            <img alt="aux" src="<?php echo get_template_directory_uri()?>/images/step2.png" />
            <h3>Install Demo Data (optional)</h3>
            To get the same look and feel of the demo site, install the demo data (only if you have now a blank website).
            <br />  
            If necessary, to clear all data of your site and begin from fresh start, 
            we suggest to use this free plugin:
            Reset WP 
            <br /><br />
            To use one click install demo feature, go to:
            <br />
            <strong>dashboard => Appearance => Import Demo Data</strong>
            <br /><br />
        </div> <!-- "columns 2">  --> 
       <div class="realestaterightnow-help-column realestaterightnow-help-column-3">
            <img alt="aux" src="<?php echo get_template_directory_uri()?>/images/step3.png" />
            <h3>Theme Management</h3>  
            To manage the theme, click Appearance => Customize at the left menu or click the button bellow...
            <br /><br />   
            <a href="<?php echo get_site_url()?>/wp-admin/customize.php?return=%2Fwp-admin%2Findex.php" class="button button-primary">Theme Management</a>
        </div> <!-- "Column 3">  --> 
    </div> <!-- "Container 1 " -->    
   </div> <!-- "realestaterightnow-steps3"> -->
   <div id="realestaterightnow-services3">
     <div class="realestaterightnow-block-title">
      Help, Support, Troubleshooting:
    </div>
    <div class="realestaterightnow-help-container1">
        <div class="realestaterightnow-help-column realestaterightnow-help-column-1">
           <img alt="aux" src="<?php echo get_template_directory_uri()?>/images/support.png" />
          <h3>Help and more tips</h3>
          Just click the HELP button at top right corner this page.
          <br /><br />
          <?php 
          $billurl ='http://billminozzi.com'; ?> 
          <a href="<?php echo $billurl;?>/dove" class="button button-primary">Support</a>
          <br /><br />
       </div> <!-- "Column1">  -->   
        <div class="realestaterightnow-help-column realestaterightnow-help-column-2">
            <img alt="aux" src="<?php echo get_template_directory_uri()?>/images/service_configuration.png" />
          <h3>OnLine Guide, Demo, Support...</h3>  
          You will find our complete and updated OnLine guide, demo video, faqs page, link to support page and more usefull stuff in our site.
          <br /><br />
          <?php 
          $site = 'http://realestatetheme.eu'; ?> 
         <a href="<?php echo $site;?>" class="button button-primary">Go</a>
         <!--
         &nbsp;&nbsp;&nbsp;&nbsp;
                  <a href="<?php echo $site;?>/premium" class="button button-primary">Upgrade to Premium</a>
         -->
        </div> <!-- "columns 2">  --> 
       
       <div class="realestaterightnow-help-column realestaterightnow-help-column-3">
       
       
   
          <img alt="aux" src="<?php echo get_template_directory_uri() ?>/images/system_health.png" />
          <h3>Troubleshooting Guide</h3>  
          Use old WordPress version, Low memory, some plugin with Javascript error, wrong permalink settings are some possible problems. Read this and fix it quickly!
          <br /><br />
          <a href="http://siterightaway.net/troubleshooting/" class="button button-primary">Troubleshooting Page</a>

     
       
       
       </div> <!-- "Column 3">  --> 
    </div> <!-- "Container1 ">  -->   
   </div> <!-- "services"> -->