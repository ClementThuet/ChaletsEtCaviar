<?php
/**
 * @author William Sergio Minozzi
 * @copyright 2017
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
?>

   <div id="realestate-services3">
     <div class="realestate-block-title">
      Server Check
    </div>

   <div class="realestate-help-container1">
        <div class="realestate-help-column realestate-help-column-1">
          <h3>Memory Status</h3>
            <?php 
            $ds = 256;
            $du = 60;
 $realestate_memory = realestate_check_memory();
    if ( $realestate_memory['msg_type'] == 'notok')
       {
        echo 'Unable to get your Memory Info';
    }
    else
    {
              $ds = $realestate_memory['wp_limit'];
              $du = $realestate_memory['usage'];
            if ($ds > 0)
                $perc = number_format(100 * $du / $ds, 2);
            else
                $perc = 0;
            if ($perc > 100)
                $perc = 100;
            $color = '#e87d7d';
            $color = '#029E26';
            if ($perc > 50)
                $color = '#e8cf7d';
            if ($perc > 70)
                $color = '#ace97c';
            if ($perc > 50)
                $color = '#F7D301';
            if ($perc > 70)
                $color = '#ff0000';
            ;
            echo '<p><li style="max-width:50%;font-weight:bold;padding:5px 15px;border-radius:4px;-moz-border-radius:4px;-webkit-border-radius:4px;background-color:#0073aa;margin-left:13px;color:white;">' .
                'Memory Usage' . '<div style="border:1px solid #ccc;background:white;width:100%;margin:2px 5px 2px 0;padding:1px">' .
                '<div style="width: ' . $perc . '%;background-color:' . $color .
                ';height:6px"></div></div>' . $du . ' of ' . $ds . ' MB Usage' . '</li>'; ?>
                       <br /> <br />
           For details, click the Memory Checkup Tab above.
           <br /> <br /> 
       <?php } ?>
       </div>  
       <!-- "Column1">  --> 
        <div class="realestate-help-column realestate-help-column-2">
            <h3>Permalink Settingss</h3>
            
            
      <?php      
      $permalinkopt = get_option('permalink_structure');
      //echo $permalinkopt;
      //echo '<br />';
        if ($permalinkopt != '/%postname%/')
           { ?>
           
                     <img alt="aux" width="40px" src="<?php echo REALESTATEURL?>assets/images/noktick.png" />
             <br />
 
                     <br />
                     Wrong Permalink settings !
                     <br />
                     Please, fix it to avoid 404 error page.
                     <br />
                     To correct, just follow this steps:
                     <br />
                     Dashboard => Settings => Permalinks => Post Name (check)
                     <br />  
                     Click Save Changes
                      <?php
           }
        else
          echo '<img alt="aux" width="40px" src="'.REALESTATEURL.'assets/images/oktick.png" />';
        
        
      ?>
          
            
            
            
            
            
            
   
             <br /> <br /> 
        </div> <!-- "columns 2">  -->
        <div class="realestate-help-column realestate-help-column-3">
             
             
             <h3 style="color:red;">Premium Version Disabled.</h3>
             Get Color Options, more pages:
<br />
- Last Properties
<br />
- Featured Properties
<br />
- Order by Price/Year Ascending/Descending
<br />
- Shortcode to list  only properties for rent (or for sale)
<br />
- Create Blocks type Gallery or Page List
<br />
- Combine Shortcodes
<br />
- Number of Properties to show
<br />
- Show or Hide Pagination
<br />
- Show or Hide Search Box
<br />

          
             
           <?php $site = 'http://realestateplugin.eu/premium/'; ?>
           <a href="<?php echo $site; ?>" class="button button-primary">Learn More</a>
        </div> 
        <!-- "Column 3">  --> 
    </div> <!-- "Container 1 " -->
</div>

   <div id="realestate-steps3">
       <div class="realestate-block-title"> 
           <img alt="aux" src="<?php echo REALESTATEURL?>assets/images/3steps.png" />
           <br />   <br />
           Follow this 3 steps after install the plugin:
       </div>
    <div class="realestate-help-container1">
        <div class="realestate-help-column realestate-help-column-1">
        <img alt="aux" src="<?php echo REALESTATEURL?>assets/images/step1.png" />
          <h3>Configurate Settings</h3>
          Go to <br />
          Dasboard=>Real Estate=>Settings
          <br />
          <em>Fill out the information</em>:
           <br />
          - Your Currency
           <br />
          - Meters - Feets  
           <br />
           - Your Contact eMail
           <br />
           - And So On ...
           <br /> <br />
           <strong>Import Demo Data:</strong>
           <br />
           If you want import demo data, click the Help Button at top right corner
           and take a look Import Demo Data or, if you are using our theme, you can import together with theme demo import.
           <br />
           If you import demo data, you can skip step 2. 
       </div> <!-- "Column1">  -->      
        <div class="realestate-help-column realestate-help-column-2">
            <img alt="aux" src="<?php echo REALESTATEURL?>assets/images/step2.png" />
            <h3>Fill Out Fields and Properties Table</h3>
            <strong>Go to Fiels Table:</strong><br /> 
            Dashboard=>Real Estate=>Fields Table
            <br />
            They are the fields to show up at your properties form.
            For example: 
            <br />  
            - Google Maps
            <br />  
            - Pool
            <br />
            - Balcony
            <br />
            - Garage
            <br />
            - And So On. 
            <br /><br />
            You don't need include this fields: Address, Purpose, Beds, Baths, Price, Year, Area.
            <br /><br />
            <strong>Go to Properties Table:</strong><br /> 
            Dashboard=>Real Estate=>Properties Table 
            <br /> 
            And fill out this table with yours products.
            <br /> 
            For example:
            <br />
            - Apartments
            - Offices
            - And So On.
            <br /><br />          
            
        </div> <!-- "columns 2">  --> 
       <div class="realestate-help-column realestate-help-column-3">
            <img alt="aux" src="<?php echo REALESTATEURL?>assets/images/step3.png" />
            <h3>Paste the code in your page:</h3>
            Go to your page and copy and paste this code: 
            <br />[realestate]
            <br /><br />
            To show only the Search Bar, just past this shortcode in your page: 
            <br />[realestate onlybar="yes"]

            <br /><br />
            To create one Team page, just past this shortcode in your page:
            <br />[realestate_team]
            <br /><strong>The Premium Version have dozens of extra codes... </strong>
        </div> 
        <!-- "Column 3">  --> 
    </div> <!-- "Container 1 " -->    
   </div> <!-- "realestate-steps3"> -->
   <div id="realestate-services3">
     <div class="realestate-block-title">
      Help, Demo, Support, Troubleshooting:
    </div>
    <div class="realestate-help-container1">
        <div class="realestate-help-column realestate-help-column-1">
           <img alt="aux" src="<?php echo REALESTATEURL?>assets/images/support.png" />
          <h3>Help and more tips</h3>
          Just click the HELP button at top right corner this page for context help. Also <em>Tooltip</em> available in Fields form.
          <br /><br />
       </div> <!-- "Column1">  -->   
        <div class="realestate-help-column realestate-help-column-2">
            <img alt="aux" src="<?php echo REALESTATEURL?>assets/images/service_configuration.png" />
          <h3>OnLine Guide, Support, Demo, Demo Video, Faq...</h3>  
          You will find our complete and updated OnLine guide, demo video, faqs page, link to support page and more usefull stuff in our site.
          <br /><br />
          <?php $site = 'http://realestateplugin.eu'; ?>
         <a href="<?php echo $site;?>" class="button button-primary">Go</a>
        </div> <!-- "columns 2">  --> 
       <div class="realestate-help-column realestate-help-column-3">


          <img alt="aux" src="<?php echo REALESTATEURL?>assets/images/system_health.png" />
          <h3>Troubleshooting Guide</h3>  
          Use old WordPress version, Low memory, some plugin with Javascript error, wrong permalink settings are some possible problems. Read this and fix it quickly!
          <br /><br />
          <a href="http://siterightaway.net/troubleshooting/" class="button button-primary">Troubleshooting Page</a>




          <br /><br />
       </div> <!-- "Column 3">  --> 
    </div> <!-- "Container1 ">  -->   
   </div> <!-- "services"> -->