<?php /**
 * @author Bill Minozzi
 * @copyright 2017
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 function realestate_get_max_beds()
{
    global $wpdb;
    $args = array(
        'numberposts' => 1,
        'post_type' => 'products',
        'meta_key' => 'product-beds',
        'orderby' => 'meta_value_num',
        'order' => 'DESC');
    $posts = get_posts($args);
    foreach ($posts as $post) {
        $x = get_post_meta($post->ID, 'product-beds', true);
        if (!empty($x)) {
            $x = (int)$x;
        }
        else
          $x = 10;
        if($x < 1)
          return '10';
        else
          return $x;
    }
}
 function realestate_get_max_baths()
{
    global $wpdb;
    $args = array(
        'numberposts' => 1,
        'post_type' => 'products',
        'meta_key' => 'product-baths',
        'orderby' => 'meta_value_num',
        'order' => 'DESC');
    $posts = get_posts($args);
    foreach ($posts as $post) {
        $x = get_post_meta($post->ID, 'product-baths', true);
        if (!empty($x)) {
            $x = (int)$x;
        }
        else
          $x = 10;
        if($x < 1)
          return '10';
        else
          return $x;
    }
}
function realestate_message_low_memory()
{
    echo '<div class="notice notice-warning">
                     <br />
                     <b>
                     Real Estate Plugin Warning: Your server running Low Memory !
                     <br />
                     Please, check 
                     <br />
                     Dashboard => Real Estate => (tab) Memory Checkup
                     <br /><br />
                     </b>
                     </div>';
}
Function realestate_check_memory()
{
      global $realestate_memory;
      $realestate_memory['limit'] = (int) ini_get('memory_limit') ;	
      $realestate_memory['usage'] = function_exists('memory_get_usage') ? round(memory_get_usage() / 1024 / 1024, 0) : 0;
      if(!defined("WP_MEMORY_LIMIT"))
      {
        $realestate_memory['msg_type'] = 'notok';  
        return;
      }
      $realestate_memory['wp_limit'] =  trim(WP_MEMORY_LIMIT) ;
    if ($realestate_memory['wp_limit'] > 9999999)
        $realestate_memory['wp_limit'] = ($realestate_memory['wp_limit'] / 1024) / 1024;
    if (!is_numeric($realestate_memory['usage'])) {
        $realestate_memory['msg_type'] = 'notok';  
        return;
    }
    if (!is_numeric($realestate_memory['limit'])) {
        $realestate_memory['msg_type'] = 'notok';  
        return;
    }
    if ($realestate_memory['usage'] < 1) {
        $realestate_memory['msg_type'] = 'notok';  
        return;
    }
  $wplimit = $realestate_memory['wp_limit'];  
  $wplimit = substr($wplimit,0,strlen($wplimit)-1);
  $realestate_memory['wp_limit'] = $wplimit;
  $realestate_memory['percent'] = $realestate_memory['usage'] / $realestate_memory['wp_limit'];
  $realestate_memory['color'] = 'font-weight:normal;';
  if ($realestate_memory['percent'] > .7) $realestate_memory['color'] = 'font-weight:bold;color:#E66F00';
  if ($realestate_memory['percent'] > .85) $realestate_memory['color'] = 'font-weight:bold;color:red';
  $realestate_memory['msg_type'] = 'ok';  
  return $realestate_memory;
}
Function realestate_reorder_terms()
{
     global $wpdb;   
     $args = array(
      'taxonomy' => 'agents',
      'hide_empty' => false,
     );
     $terms = get_terms($args); 
     $qagents = count($terms);
     $RealestateAgents = array();
     if ($qagents > 0)
     {
       $i = 0;
       foreach ( $terms as $term ) 
       {
              $id = $term->term_id;
              $termMeta = get_option( 'agents_' . $id );
              $RealestateAgents[$i]['name'] =  $term->name;
              $RealestateAgents[$i]['description'] =  $term->description;
              $RealestateAgents[$i]['image'] = $termMeta['image'];      
              $RealestateAgents[$i]['function'] = $termMeta['function'];
              $RealestateAgents[$i]['phone'] = $termMeta['phone'];
              $RealestateAgents[$i]['email'] = $termMeta['email'];
              $RealestateAgents[$i]['skype'] = $termMeta['skype'];
              $RealestateAgents[$i]['facebook'] = $termMeta['facebook'];
              $RealestateAgents[$i]['twitter'] = $termMeta['twitter'];
              $RealestateAgents[$i]['linkedin'] = $termMeta['linkedin'];
              $RealestateAgents[$i]['vimeo'] = $termMeta['vimeo'];
              $RealestateAgents[$i]['instagram'] = $termMeta['instagram'];
              $RealestateAgents[$i]['youtube'] = $termMeta['youtube'];         
              $RealestateAgents[$i]['myorder'] = $termMeta['myorder'];         
              $i ++;
       } 
        function cmp($a, $b)
        {
            return strcmp($a["myorder"], $b["myorder"]);
        }
        if ($i > 1)
          usort($RealestateAgents, "cmp");
    }
    Return $RealestateAgents;
}
add_action( 'wp_loaded', 'realestate_get_locations' );
function realestate_get_locations()
{
    global $wpdb;
    /* Properties */ 
    global $wp_query;
    $args = array( 'post_type' => 'products');    
    $wp_query2 = new WP_Query($args);   
    $have_locations = array();
    while ($wp_query2->have_posts())
    {
                 $wp_query2->the_post();
                 $terms3 = get_the_terms( get_the_id(), 'locations');
                 $term3 = $terms3[0]; 
                 if(is_object($term3))
                    {
                         $have_locations[] =  $term3->name; 
                    } 
   } 
   /* end Properties */ 
    $re_locations = array();  
    $args = array(
        'taxonomy'               => 'locations',
        'orderby'                => 'name',
        'order'                  => 'ASC',
        'hide_empty'             => false,
    );
    $the_query = new WP_Term_Query($args);
    foreach($the_query->get_terms() as $term){
       if( in_array($term->name, $have_locations ) )
       {
           $re_locations[] = $term->name;
       }
    }
 return $re_locations; 
}
function realestate_findglooglemap()
{
 global $wpdb;
        $argsfindfields = array(
            'post_status' => 'publish',
            'post_type' => 'realestatefields'
        );
        query_posts( $argsfindfields );
        $afields = array();
        $afieldsid = array();
        $Mapfield_name = '';
        while ( have_posts() ) : the_post();
            $post_id = esc_attr(get_the_ID());
            $Mapfield_name = get_the_title($post_id);
            $field_type = esc_attr(get_post_meta($post_id, 'field-typefield', true));
            if($field_type  == 'googlemap')
              {
                if (!empty ($Mapfield_name) )
                  return 'product-'.$Mapfield_name;
              }
           //   break;
        endwhile;
           return '';
}
function realestate_get_fields($type)
{
  global $wpdb;
   if(!function_exists('get_userdata()')) {
    include(ABSPATH . "/wp-includes/pluggable.php");
   }
    if ( $type == 'search')
    {
    $args = array(
            'post_status' => 'publish',
            'post_type' => 'realestatefields',
            'meta_key' => 'field-order',
            'posts_per_page' => -1,
            'orderby' => 'meta_value_num',
            'order' => 'ASC',
            'meta_query' => array(
            array(
            'key' => 'field-searchbar',
            'value' => '1'
            )
        )
    );
    }
    elseif($type == 'all')
    {
    $args = array(
            'post_status' => 'publish',
            'post_type' => 'realestatefields',
            'meta_key' => 'field-order',
            'posts_per_page' => -1,
            'orderby' => 'meta_value_num',
            'order' => 'ASC'
        );
    }
    elseif ( $type == 'widget')
    {
    $args = array(
            'post_status' => 'publish',
            'post_type' => 'realestatefields',
            'meta_key' => 'field-order',
            'posts_per_page' => -1,
            'orderby' => 'meta_value_num',
            'order' => 'ASC',
            'meta_query' => array(
            array(
            'key' => 'field-searchwidget',
            'value' => '1'
            )
        )
    );
    }    
        query_posts( $args );
        $afields = array();
        $afieldsid = array();
        while ( have_posts() ) : the_post();
            $afieldsid[] = esc_attr(get_the_ID());
        endwhile;
        ob_start();
        wp_reset_query();
        ob_end_clean();       
         return $afieldsid;  
} // end Funcrions
function realestate_get_meta($post_id)
{
    $fields = array(
        'field-label',
        'field-typefield',
        'field-drop_options',
        'field-searchbar',
        'field-searchwidget',
        'field-rangemin',
        'field-rangemax',
        'field-rangestep',
        'field-slidemin',
        'field-slidemax',
        'field-slidestep',  
        'field-order',
        'field-name');
    $tot = count($fields);
    for ($i = 0; $i < $tot; $i++) {
        $field_value[$i] = esc_attr(get_post_meta($post_id, $fields[$i], true));
    }
    $field_value[$tot-1] = esc_attr(get_the_title($post_id));
    return $field_value;
}
function realestate_get_types()
{
    global $wpdb;
    $productmake = array();  
    $args = array(
        'taxonomy'               => 'agents',
        'orderby'                => 'name',
        'order'                  => 'ASC',
        'hide_empty'             => false,
    );
    $the_query = new WP_Term_Query($args);
    $productmake = array();  
    foreach($the_query->get_terms() as $term){ 
       $productmake[] = $term->name;
    }
 return $productmake; 
}
add_action( 'wp_loaded', 'realestate_get_types' );
function realestate_currency()
{
    if (get_option('RealEstatecurrency') == 'Dollar') {
        return "$";
    }
    if (get_option('RealEstatecurrency') == 'Pound') {
        return "&pound;";
    }
    if (get_option('RealEstatecurrency') == 'Yen') {
        return "&yen;";
    }
    if (get_option('RealEstatecurrency') == 'Euro') {
        return "&euro;";
    }
    if (get_option('RealEstatecurrency') == 'Universal') {
        return "&curren;";
    }
    if (get_option('RealEstatecurrency') == 'AUD') {
        return "AUD";
    }
    if (get_option('RealEstatecurrency') == 'Real') {
        return "R&#36;";
    }
     if (get_option('RealEstatecurrency') == 'Krone') {
        return "kr";
    }    
    if (get_option('RealEstatecurrency') == 'Forint') {
        return "Ft"; /* Ft or HUF is also perfect for me. */ 
    }  
// R (for ZAR) our currency - Afric Sul
    if (get_option('RealEstatecurrency') == 'Zar') {
        return "R"; /* Ft or HUF is also perfect for me. */ 
    } 
    if (get_option('RealEstatecurrency') == 'Swiss') {
        return "CHF "; 
    }
}
function realestate_get_max($meta_purpose)
{
    global $wpdb;
    if( empty($meta_purpose))
    {
       if(isset($_GET['meta_purpose'])) 
         $purpose = sanitize_text_field($_GET['meta_purpose']);          
    }
    else
       $purpose = $meta_purpose;
    //echo 'mmpp: '.$purpose;
    if(isset($purpose)) 
      {
         // $purpose = sanitize_text_field($_GET['meta_purpose']);          
         // $purpose = __($purpose, 'realestate');
          if(!empty($purpose))
            $afilter[] = array('key' => 'product-purpose', 'value' => $purpose);
          else
           $afilter[] = array('key' => 'product-purpose', 'value' => 'Rent');
        //     $afilter[] = array('key' => 'product-purpose', 'value' => __('Rent', 'realestate'));
      }
    else
       $afilter[] = array('key' => 'product-purpose', 'value' => 'Rent');
        //  $afilter[] = array('key' => 'product-purpose', 'value' => __('Rent', 'realestate'));
    $args = array(
        'numberposts' => 1,
        'post_type' => 'products',
        'meta_key' => 'product-price',
        'orderby' => 'meta_value_num',
        'meta_query' => $afilter,
        'order' => 'DESC');
    $posts = get_posts($args);
    foreach ($posts as $post) {
        $x = get_post_meta($post->ID, 'product-price', true);
        if (!empty($x)) {
            $x = (int)$x;
            if (is_int($x)) {
                $x = ($x) * 1.2;
                $x = round($x, 0, PHP_ROUND_HALF_EVEN);
                //return $x;
            }
        }
        if($x < 1)
          return '100000';
        else
          return $x;
    }
}
function RealEstate_localization_init_fail()
{
    echo '<div class="error notice">
                     <br />
                     realestatePlugin: Could not load the localization file (Language file).
                     <br />
                     Please, take a look the online Guide item Plugin Setup => Language.
                     <br /><br />
                     </div>';
}
function RealEstate_Show_Notices1()
            {
                    echo '<div class="update-nag notice"><br />';
                    echo 'Warning: Upload directory not found (RealEstate Plugin). Enable debug for more info.';
                    echo '<br /><br /></div>';
            }
function RealEstate_plugin_was_activated()
{
                echo '<div class="updated"><p>';
                $bd_msg = '<img src="'.REALESTATEURL.'assets/images/infox350.png" />';
                $bd_msg .= '<h2>RealEstate Plugin was activated! </h2>';
                $bd_msg .= '<h3>For details and help, take a look at Real Estate Dashboard at your left menu <br />';
                $bd_url = '  <a class="button button-primary" href="admin.php?page=real_estate_plugin">or click here</a>';
                $bd_msg .=  $bd_url;
                echo $bd_msg;
                echo "</p></h3></div>";
     $Multidealerplugin_installed = trim(get_option( 'Multidealerplugin_installed',''));
     if(empty($Multidealerplugin_installed)){
        add_option( 'Multidealerplugin_installed', time() );
        update_option( 'Multidealerplugin_installed', time() );
     }
} 
if( is_admin())
{
   if(get_option('RealEstate_activated', '0') == '1')
   {
     add_action( 'admin_notices', 'RealEstate_plugin_was_activated' );
     $r =  update_option('RealEstate_activated', '0'); 
     if ( ! $r )
        add_option('RealEstate_activated', '0');
   }
} 
if (!function_exists('write_log')) {
    function write_log ( $log )  {
        if ( true === WP_DEBUG ) {
            if ( is_array( $log ) || is_object( $log ) ) {
                error_log( print_r( $log, true ) );
            } else {
                error_log( $log );
            }
        }
    }
}
add_filter( 'plugin_row_meta', 'realestate_custom_plugin_row_meta', 10, 2 );
function realestate_custom_plugin_row_meta( $links, $file ) {
	if ( strpos( $file, 'realestate.php' ) !== false ) {
		$new_links = array(
				'OnLine Guide' => '<a href="http://realestateplugin.eu/guide/" target="_blank">OnLine Guide</a>',
                                'Pro' => '<a href="http://realestateplugin.eu/premium/" target="_blank"><b><font color="#FF6600">Go Pro</font></b></a>'
				);
		$links = array_merge( $links, $new_links );
	}
	return $links;
}
function realestate_get_page()
{
  $page = 1;
  $url = esc_url($_SERVER['REQUEST_URI']);
  $pieces = explode("/", $url);
  for ($i=0; $i < count($pieces); $i++)
  {
    if ($pieces[$i] == 'page' and ($i+1) <  count($pieces))
      {
          $page = $pieces[$i+1];
          if(is_numeric($page))
             return $page;
      }
  }
  return $page;
}
function RealEstate_wrong_permalink()
{
    echo '<div class="notice notice-warning">
                     <br />
                     Real Estate Plugin: Wrong Permalink settings !
                     <br />
                     Please, fix it to avoid 404 error page.
                     <br />
                     To correct, just follow this steps:
                     <br />
                     Dashboard => Settings => Permalinks => Post Name (check)
                     <br />  
                     Click Save Changes
                     <br /><br />
                     </div>';
}
$realestateurl = esc_url($_SERVER['REQUEST_URI']);
if (strpos($realestateurl, '/options-permalink.php') === false)
{            
  $permalinkopt  = get_option('permalink_structure');
  if($permalinkopt != '/%postname%/')
    add_action( 'admin_notices', 'RealEstate_wrong_permalink' );
}
/////////////
function realestaterightnow_ask_for_upgrade()
 { 
    $x = rand(0,4);
    if ($x == 0)
    {
       $banner_image = REALESTATEIMAGES.'/introductory.png';
       $bill_banner_bkg_color = 'turquoise';
       $banner_txt = __( 'Extend standard plugin functionality with new great options.', 'real-estate-right-now'); 
    }
    elseif ($x == 1)
    {
       $banner_image = REALESTATEIMAGES.'/lion.jpg';  
       $bill_banner_bkg_color = 'turquoise';
       $banner_txt = __( 'Make Your Website Look More Professional.', 'real-estate-right-now'); 
    }
       elseif ($x == 2)
     {
       $banner_image = REALESTATEIMAGES.'/apple.jpg';
       $bill_banner_bkg_color = 'orange';
       $banner_txt = __( 'Extend standard plugin functionality with new great options.', 'real-estate-right-now'); 
    } 
       elseif ($x == 3)
    {
       $banner_image = REALESTATEIMAGES.'/racing.jpg';
       $bill_banner_bkg_color = 'orange';
      $banner_txt = __( 'Make Your Website Look More Professional.', 'real-estate-right-now'); 
    }     
    else
    {
       $banner_image = REALESTATEIMAGES.'/keys_from_left.png';
       $bill_banner_bkg_color = 'orange';
       $banner_txt = __( 'Make Your Website Look More Professional.', 'real-estate-right-now'); 
    }
   $banner_tit = __( 'It is time to upgrade your', 'real-estate-right-now');
    echo '<script type="text/javascript" src="' .REALESTATEURL .
            'assets/js/c_o_o_k_i_e.js' . '"></script>';
    ?>
	<script type="text/javascript">
        jQuery(document).ready(function() {
        	var hide_message = jQuery.cookie('bill_go_pro_hide');
/*   hide_message = false;  */
        	if (hide_message == "true") {
        		jQuery(".bill_go_pro_container").css("display", "none");
        	} else {
                 setTimeout( function(){ 
                   jQuery(".bill_go_pro_container").slideDown("slow");
                  }  , 2000 );
        	};
        	jQuery(".bill_go_pro_close_icon").click(function() {
        		jQuery(".bill_go_pro_message").css("display", "none");
        		jQuery.cookie("bill_go_pro_hide", "true", {
        			expires: 15
        		});
        		jQuery(".bill_go_pro_container").css("display", "none");
        	});
        	jQuery(".bill_go_pro_dismiss").click(function(event) {
        		jQuery(".bill_go_pro_message").css("display", "none");
        		jQuery.cookie("bill_go_pro_hide", "true", {
        			expires: 15
        		});
        		event.preventDefault()
        		jQuery(".bill_go_pro_container").css("display", "none");
        	});
        }); // end (jQuery);
	</script>
    <style type="text/css">
            .bill_go_pro_close_icon {
            width:31px;
            height:31px;
            border: 0px solid red;
            /* background: url("http://xxxxxx.com/wp-content/plugins/realestate/assets/images/close_banner.png") no-repeat center center; */
            box-shadow:none;
            float:right;
            margin:8px;
            margin:60px 40px 8px 8px;
            }
            .bill_hide_settings_notice:hover,.bill_hide_premium_options:hover {
            cursor:pointer;
            }
            .bill_hide_premium_options {
            position:relative;
            }
            .bill_go_pro_image {
            float:left;
            margin-right:20px;
            max-height:90px !important;
            }
            .bill_image_go_pro {
            max-width:200px;
            max-height:88px;
            }
            .bill_go_pro_text {
            font-size:18px;
            padding:10px;
            }
            .bill_go_pro_button_primary_container {
            float:left;
            margin-top: 0px;
            }
            .bill_go_pro_dismiss_container
            {
              margin-top: 0px;
            }
            .bill_go_pro_buttons {
              display: flex;
              max-height: 30px;
              margin-top: -10px;
            }        
            .bill_go_pro_container {
                border:1px solid darkgray;
                height:88px;
                padding: 0; 
                margin: 0; 
                background: <?php echo $bill_banner_bkg_color; ?>
            }
            .bill_go_pro_dismiss {
              margin-left:15px !important;
            }
             .button {
                vertical-align: top;
            }           
            @media screen and (max-width:900px) {
                .bill_go_pro_text {
                  font-size:16px;
                  padding:5px;
                  margin-bottom: 10px;
                }
            }
            @media screen and (max-width:800px) {
                .bill_go_pro_container {
                  display:none !important;
                }
            }
	</style>
    <div class="notice notice-success bill_go_pro_container" style="display: none;">
    	<div class="bill_go_pro_message bill_banner_on_plugin_page bill_go_pro_banner">
    		<button class="bill_go_pro_close_icon close_icon notice-dismiss bill_hide_settings_notice" title="<?php _e('Close notice',
    		'real-estate-right-now'); ?>">
    		</button>
    		<div class="bill_go_pro_image">
    			<img class="bill_image_go_pro" title="" src="<?php echo $banner_image;?>" alt="" />
    		</div>
    		<div class="bill_go_pro_text">
    			<?php echo $banner_tit;?>
    				<strong>
    					Real Estate Plugin
    				</strong>
    				<?php _e( 'to', 'real-estate-right-now'); ?>
    					<strong>
    						Pro
    					</strong>
    					<?php _e( 'version!', 'real-estate-right-now'); ?>
    						<br />
    						<span>
    							<?php echo $banner_txt;?>
             				</span>
    		</div>
            <div class="bill_go_pro_buttons">
        		<div class="bill_go_pro_button_primary_container">
        			<a class="button button-primary" target="_blank" href="http://realestateplugin.eu/premium/"><?php _e('Learn More',
        			'real-estate-right-now'); ?></a>
        		</div>
        		<div class="bill_go_pro_dismiss_container">
        			<a class="button button-secondary bill_go_pro_dismiss" target="_blank" href="http://realestateplugin.eu/premium/"><?php _e('Dismiss',
        			'real-estate-right-now'); ?></a>
        		</div>
            </div>
    	</div>
    </div>
<?php               
 } // end Bill ask for upgrade 
 $when_installed = get_option('bill_installed');
 $now = time();
 $delta = $now - $when_installed;
 if ($delta > (3600 * 24 * 8))
 {
    $realestateurl = esc_url($_SERVER['REQUEST_URI']);
    if (strpos($realestateurl, 'post_type=products') !== false or strpos($realestateurl, 'post_type=realestatefields') !== false )
       if (strpos($realestateurl, 'settings') === false)
          add_action( 'admin_notices', 'realestaterightnow_ask_for_upgrade' );
 }
function RealEstate_add_admin_files()
{
   wp_enqueue_style('pluginStyleAdmin', REALESTATEURL . 'settings/styles/admin-settings.css');    
}
add_action('admin_enqueue_scripts', 'RealEstate_add_admin_files');
function realestate_control_availablememory()
{
    $realestate_memory = realestate_check_memory();
    if ( $realestate_memory['msg_type'] == 'notok')
       return;
     if ($realestate_memory['percent'] > .7) 
      add_action( 'admin_notices', 'RealEstate_message_low_memory' ); 
}
if (wp_get_theme() <> 'Real Estate Right Now')     
   add_action( 'wp_loaded', 'realestate_control_availablememory' );


function realestate_change_note_submenu_order( $menu_ord ) {
      global $submenu;
      
    function realestate_str_replace_json($search, $replace, $subject) 
    {
        return json_decode(str_replace($search, $replace, json_encode($subject)), true);
    }
      $key = 'Real Estate';
      $val = 'Dashboard';
      $submenu = realestate_str_replace_json($key, $val, $submenu);
}
add_filter( 'custom_menu_order', 'realestate_change_note_submenu_order' );
function realestate_gopro2_callback() {
    $urlgopro = "http://realestateplugin.eu/premium/";
    ?>
    <script type="text/javascript">
    <!--
     window.location  = "<?php echo $urlgopro;?>";
    -->
    </script>
<?php
}
function realestate_add_menu_gopro2()
{
        $realestate_gopro_page = add_submenu_page('real_estate_plugin', // $parent_slug
            'Go Pro', // string $page_title
            '<font color="#FF6600">Go Pro</font>', // string $menu_title
            'manage_options', // string $capability
            'realestate_my-custom-submenu-page3', 'realestate_gopro2_callback');
}?>