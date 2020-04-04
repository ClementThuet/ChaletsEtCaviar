<?php /**
 * @author Bill Minozzi
 * @copyright 2017
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 if( is_admin()) {
    add_action('current_screen', 'this_screen');
    function this_screen()
    {
        require_once(ABSPATH . 'wp-admin/includes/screen.php');
        $current_screen = get_current_screen();
        //echo $current_screen->id;
        // die();
        if ($current_screen->id === "edit-realestatefields") {
            add_filter('contextual_help', 'RealEstate_contextual_help_fields', 10, 3);
        }
         elseif ($current_screen->id === "products") {
            add_filter('contextual_help', 'RealEstate_contextual_help_products', 10, 3);
        } 
         elseif ($current_screen->id === "edit-agents") {
            add_filter('contextual_help', 'RealEstate_contextual_help_agents', 10, 3);
        }
         elseif ($current_screen->id === "edit-locations") {
            add_filter('contextual_help', 'RealEstate_contextual_help_locations', 10, 3);
        }
        elseif ($current_screen->id === "toplevel_page_real_estate_plugin" or  $current_screen->id === "admin_page_rep_settings") {
            add_filter('contextual_help', 'RealEstate_main_help', 10, 3);
        }             
        else {
            if (isset($_GET['page'])) {
                if (sanitize_text_field($_GET['page']) == 'real_estate_plugin') {
                    add_filter('contextual_help', 'RealEstate_main_help', 10, 3);
                }
            }
        }
    }
}
function RealEstate_main_help($contextual_help, $screen_id, $screen)
{
    $myhelp = '<br> The easiest way to manage, list and sell yours properties online.';
    $myhelp .= '<br />';
    $myhelp .= 'Follow the 3 steps in this main screen after install the plugin. <br />';
    $myhelp .= '<br />';
    $myhelp .= 'You will find Context Help in many screens.';
    $myhelp .= '<br />';
    $myhelp .= 'You can find also our complete OnLine Guide  <a href="http://realestateplugin.eu/help/index.html" target="_self">here.</a>';

$myhelpdemo = '<br />';
    $myhelpdemo .= 'If you want to import demo data, download the demo data from this link:';

 $myhelpdemo .= '<br />';
 
    $myhelpdemo .= 'http://realestateplugin.eu/demo-data/download-demo.php';

    $myhelpdemo .= '<br /><br />';

    $myhelpdemo .= 'After download:';
 $myhelpdemo .= '<br />';
 
    $myhelpdemo .= '1. Log in to that site as an administrator. ';
$myhelpdemo .= '<br />';
    $myhelpdemo .= '2. Go to Tools: Import in the WordPress admin panel.'; 
$myhelpdemo .= '<br />';
    $myhelpdemo .= '3. Install the "WordPress" importer from the list.'; 
$myhelpdemo .= '<br />';
    $myhelpdemo .= '4. Activate & Run Importer.'; 
$myhelpdemo .= '<br />';
    $myhelpdemo .= '5. Upload the file downloaded using the form provided on that page.'; 
$myhelpdemo .= '<br />';
    $myhelpdemo .= '6. You will first be asked to map the authors in this export file to users'; 
$myhelpdemo .= '<br />';
    $myhelpdemo .= 'on the site. For each author, you may choose to map to an';
$myhelpdemo .= '<br />';
    $myhelpdemo .= 'existing user on the site or to create a new user. ';
$myhelpdemo .= '<br />';
    $myhelpdemo .= '7. WordPress will then import the demo data into you site.';
$myhelpdemo .= '<br />'; 


    $screen->add_help_tab(array(
        'id' => 'RealEstate-overview-tab',
        'title' => __('Overview', 'realestate'),
        'content' => '<p>' . $myhelp . '</p>',
        ));
        
        
    $screen->add_help_tab(array(
        'id' => 'import-demo',
        'title' => __('Import Demo Data', 'realestate'),
        'content' => '<p>' . $myhelpdemo . '</p>',
        ));          
        
        
    return $contextual_help;
} 
function RealEstate_contextual_help_fields($contextual_help, $screen_id, $screen)
{
     $myhelp = 'In the FIELDS screen you can manage the main table fields.
    This fields will show up 
    in your main properties form management, search bar and search widget.
    <br />
    Each row represents one field.
    <br /> 
    For example:
    <br />
    <ul>
    <li>Pool</li>
    <li>Balcony</li> 
    <li>Garage</li>    
    <li>And So On</li>  
    </ul>
    <br />
    You don\'t need include this fields: Address, Purpose, Beds, Baths, Price, Year, Area, Property name, Featured. 
     <br />    <br />   
    Technical WordPress guys call this of Metadata.
    <br />
    Don\'t create 2 fields with the same name.
    <br />
    <br />
    ';
     $myhelpAdd = 'To add fields in the table, click the button Add New. This can open the empty window to include your information:
     <br />
    <ul>
    <li>Field Name</li>
    <li>Field Label</li>
    <li>Field Order</li>
    <li>Show in Search Bar (your frontpage)</li>
    <li>Show in Search Widget (your frontpage)</li>  
    <li>Type of Field</li>    
    <li>And So On</li>  
    </ul>    
    In that screen, move the mouse pointer over each field to get help about that field.
    <br />
    Just fill out and click OK button.
    <br />      
     ';
    $myhelpTypes = 'You have available this types of fields (Control Types):
    <br />
    <ul>
    <li>Text (Used by text and numbers)</li>
    <li>CheckBox</li>
    <li>Drop Down (also called select box)</li> 
    <li>Google Map (For example: usefull in Real Estate business)</li> 
    <li>Range Select (you can define de value min, max and step)</li>    
    <!-- <li>Range Slider (you can define de value min, max and step)</li>  -->
    </ul>    
    <br />
    For more details about HTML input types, please, check this page:
<a href="https://www.w3schools.com/html/html_form_input_types.asp ">https://www.w3schools.com/html/html_form_input_types.asp 
</a>
   <br />
'; 
    $myhelpEdit = 'You can manage the table, i mean, Add, Edit and Trash Fields.
    <br />
    At the Add Fields and Edit Fields forms, put the mouse over each row and the menu show up. Then, click over Edit or Trash.
    <br />
    To know more about Edit Fields, please, check the Add Fields Form Option at this help menu.
     ';  
    $screen->add_help_tab(array(
        'id' => 'RealEstate-overview-tab',
        'title' => __('Overview', 'realestate'),
        'content' => '<p>' . $myhelp . '</p>',
        ));
      $screen->add_help_tab(array(
        'id' => 'RealEstate-field-types',
        'title' => __('Field Types', 'realestate'),
        'content' => '<p>' . $myhelpTypes . '</p>',
        ));   
     $screen->add_help_tab(array(
        'id' => 'RealEstate-overview-add',
        'title' => __('Add Fields Form', 'realestate'),
        'content' => '<p>' . $myhelpAdd . '</p>',
        )); 
     $screen->add_help_tab(array(
        'id' => 'RealEstate-field-edit',
        'title' => __('Edit and Trash Fields', 'realestate'),
        'content' => '<p>' . $myhelpEdit . '</p>',
        ));      
    return $contextual_help;
} 
function RealEstate_contextual_help_products($contextual_help, $screen_id, $screen)
{
    $myhelp = 'In the PROPERTIES screen you can manage (include, edit or delete) items in your Properties Table.
    This properties will show up in your site front page.
    <br />
    We suggest you take some time to complete your Field table before this step.
    <br />
    Dashboard => RealEstate => Fields Table.
    <br />
    You will find some fields automatically included by the system (Title, Price, Featured and Year).
    Just add your properties in this table.
    <br />
    ';
     $myhelpAdd = 'To add fields in the table, click the button Add New. This can open the empty window to include your information:
     <br />
    <ul>
    <li>Field Name</li>
    <li>Field Label</li>
    <li>Field Order</li>
    <li>Show in Search Bar (your frontpage)</li>
    <li>Show in Search Widget (your frontpage)</li>  
    <li>Type of Field</li>    
    <li>And So On</li>  
    </ul>    
    In that screen, move the mouse pointer over each field to get help about that field.
    <br />
    Just fill out and click OK button.
    <br />      
     ';
    $myhelpAgents = 'Use the Agents control it is optional. To add new agents, go to:
    <br />
    Dashboard=> Real Estate => Agents
    <br />
    <br />
'; 
    $myhelpLocation = 'Use the Location control it is optional. Maybe you want use it if you have more than one location.
    To add new locations, go to:
    <br />
    Dashboard=> Real Estate => Locations
    <br />  
    If you are, for example, in Florida, maybe you want add: 
    <ul>
    <li>Fort Lauderdale</li>
    <li>Miami</li>
    <li>And So On...</li> 
    </ul>    
    <br />
   <br />
'; 
    $myhelpEdit = 'You can manage the table, i mean, Add, Edit and Trash Properties.
    <br />
    Use the Add New Buttom or to Edit, put the mouse over each row and the menu will show up. Then, click over Edit or Trash.
    <br />
     ';  

     $myhelpFeatured = 'You can add one main image to each property. 
    In the Property Form, click the button Set Featured Image at bottom right corner.
    <br />
    Read below Images and Gallery menu voice about how to create a Image\'s gallery with many images to show up at the top of your property\'s page.
    <br />
    <br />
     ';  
     
     
    $myhelpGallery = 'You can add many Images or one gallery for each property.
    Just go to Property Form and add the images (or the gallery) in the main description field (click the Add Media buttom). 
    <br />
    Use the default WordPress Gallery or our plugin will create automatically one nice slider gallery. To enable the plugin gallery, go to
    <br />
    Dashboard => Real Estate => Settings
    <br />
    and look for <em>Replace the Wordpress Gallery with Flexslider Gallery</em>?
    <br />
    Then, check Yes and Save Changes.
    <br />
    
    This images and gallery will be visible in single property page.
    <br />
    To get more info about galleries, <a href="https://en.support.wordpress.com/gallery/" target="_blank">visit WordPress Help site.</a>.
    
    <br />
     '; 
         
 
     
         
    $screen->add_help_tab(array(
        'id' => 'RealEstate-overview-tab',
        'title' => __('Overview', 'realestate'),
        'content' => '<p>' . $myhelp . '</p>',
        ));
      $screen->add_help_tab(array(
        'id' => 'RealEstate-products-agents',
        'title' => __('Agents', 'realestate'),
        'content' => '<p>' . $myhelpAgents . '</p>',
        ));   
     $screen->add_help_tab(array(
        'id' => 'RealEstate-products-location',
        'title' => __('Location', 'realestate'),
        'content' => '<p>' . $myhelpLocation . '</p>',
        )); 
     $screen->add_help_tab(array(
        'id' => 'RealEstate-products-edit',
        'title' => __('Edit and Trash Properties', 'realestate'),
        'content' => '<p>' . $myhelpEdit . '</p>',
        ));
     $screen->add_help_tab(array(
        'id' => 'RealEstate-products-featured',
        'title' => __('Featured Images', 'realestate'),
        'content' => '<p>' . $myhelpFeatured . '</p>',
        ));
     $screen->add_help_tab(array(
        'id' => 'RealEstate-products-gallery',
        'title' => __('Images and Gallery', 'realestate'),
        'content' => '<p>' . $myhelpGallery . '</p>',
        ));           
    return $contextual_help;
} 
function RealEstate_contextual_help_agents($contextual_help, $screen_id, $screen)
{
    $myhelpAgents = 'Use the Agents table it is optional. 
    <br />
';
    $screen->add_help_tab(array(
        'id' => 'RealEstate-overview-tab',
        'title' => __('Overview', 'realestate'),
        'content' => '<p>' . $myhelpAgents . '</p>',
        ));
    return $contextual_help;
}
function RealEstate_contextual_help_locations($contextual_help, $screen_id, $screen)
{
    $myhelpLocation = 'Use the Location table it is optional. Maybe you want use it if you have more than one location.
    <br />  
    If you are, for example, in Florida, maybe you want add: 
    <ul>
    <li>Fort Lauderdale</li>
    <li>Miami</li>
    <li>And So On...</li> 
    </ul>    
   <br />
';
    $screen->add_help_tab(array(
        'id' => 'RealEstate-overview-tab',
        'title' => __('Overview', 'realestate'),
        'content' => '<p>' . $myhelpLocation . '</p>',
        ));
     return $contextual_help;
}
/////////// Pointers ////////////////


        add_action( 'admin_enqueue_scripts', 'realestate_adm_enqueue_scripts2' );
        function realestate_adm_enqueue_scripts2() {
            global $bill_current_screen;
            
            // wp_enqueue_style( 'wp-pointer' );
            wp_enqueue_script( 'wp-pointer' );
            require_once(ABSPATH . 'wp-admin/includes/screen.php');
            $myscreen = get_current_screen();
            $bill_current_screen = $myscreen->id;
 
 
 
 
                    
           
            if($bill_current_screen == 'products' or $bill_current_screen == 'toplevel_page_real_estate_plugin' or $bill_current_screen == 'edit-realestatefields' )
              {}
            else
              return;
           
            
            $dismissed = explode( ',', (string) get_user_meta( get_current_user_id(), 'dismissed_wp_pointers', true ) );

//print_r($dismissed);



            if (in_array($bill_current_screen, $dismissed))
             return;

            add_action( 'admin_print_footer_scripts', 'realestate_admin_print_footer_scripts' );
        }
        function realestate_admin_print_footer_scripts() {
            global $bill_current_screen;
            $pointer_content = '<h3>Help Available for this Window!</h3>';
            $pointer_content .= '<p>Just Click Help Button to get content help for this window.';
        ?>
        <script type="text/javascript">
        //<![CDATA[
            // setTimeout( function() { this_pointer.pointer( 'close' ); }, 400 );
        jQuery(document).ready( function($) {
            
            $('#contextual-help-link').pointer({
                content: '<?php echo $pointer_content; ?>',
                position: {
                        edge: 'top',
                        align: 'right'
                    },
                close: function() {
                    // Once the close button is hit
                    $.post( ajaxurl, {
                            pointer: '<?php echo $bill_current_screen; ?>',
                            action: 'dismiss-wp-pointer'
                        });
                }
            }).pointer('open');
            /* $('.wp-pointer-undefined .wp-pointer-arrow').css("right", "50px"); */
        });
        //]]>
        </script>
        <?php
        }?>