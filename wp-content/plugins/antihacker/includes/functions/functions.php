<?php
/**
 * @author William Sergio Minozzi
 * @copyright 2016
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
if (is_admin()) {
    // Report new plugin installed...
    if (!function_exists('get_plugins')) {
        require_once ABSPATH . 'wp-admin/includes/plugin.php';
    }
    function antihacker_save_name_plugins()
    {
        $all_plugins = get_plugins();
        $all_plugins_keys = array_keys($all_plugins);
        if (count($all_plugins) < 1)
            return;
        $my_plugins = '';
        $loopCtr = 0;
        foreach ($all_plugins as $plugin_item) {
            if($my_plugins != '' )
              $my_plugins .= PHP_EOL; 
            $plugin_title = $plugin_item['Name'];
            $my_plugins .= $plugin_title;
            $loopCtr++;
        }
        if (!update_site_option('antihacker_name_plugins', $my_plugins))
            add_site_option('antihacker_name_plugins', $my_plugins);
    }
    function antihacker_q_plugins_now()
    {
        $all_plugins = get_plugins();
        $all_plugins_keys = array_keys($all_plugins);
        return count($all_plugins);
    }
    function antihacker_q_plugins()
    {
        $nplugins = get_site_option('antihacker_name_plugins', '');
        $nplugins = explode(PHP_EOL, $nplugins);
        return count($nplugins);
    }
    function antihacker_alert_plugin()
    {
        global $ah_admin_email, $antihacker_new_plugin;
        $dt = date("Y-m-d H:i:s");
        $dom = sanitize_text_field($_SERVER['SERVER_NAME']);
        $url = esc_url($_SERVER['PHP_SELF']);
        $msg = __('Alert: New Plugin was installed.' , "antihacker");
        $msg .= '<br>';
        $msg .= __('New Plugin Name: ', "antihacker");
        $msg .= $antihacker_new_plugin;
        $msg .= '<br>';
        $msg .= __('Date', "antihacker");
        $msg .= ': ';
        $msg .= $dt;
        $msg .= '<br>';
        $msg .= __('Domain', "antihacker");
        $msg .= ': ';
        $msg .= $dom;
        $msg .= '<br>';
        $msg .= '<br>';
        $msg .= __('This email was sent from your website', "antihacker");
        $msg .= ': ';
        $msg .= $dom .' ';
        $msg .= __('by Anti Hacker plugin.', "antihacker");
        $msg .= '<br>';
        $email_from = 'wordpress@' . $dom;
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= "From: " . $email_from . "\r\n" . 'Reply-To: ' . $ah_admin_email .
            "\r\n" . 'X-Mailer: PHP/' . phpversion();
        $to = $ah_admin_email;
        $subject = __('Alert: New Plugin was installed at: ', "antihacker") . $dom;
        wp_mail($to, $subject, $msg, $headers, '');
        return 1;
    }
    $qpluginsnow = antihacker_q_plugins_now();
    $qplugins = antihacker_q_plugins();
    if ( ($qplugins == 0 and $qpluginsnow > 0) or  ($qplugins > $qpluginsnow ) ) 
    {
         antihacker_save_name_plugins();
         $qplugins = antihacker_q_plugins();
    }
    if ($qpluginsnow > $qplugins) {
        $nplugins = get_site_option('antihacker_name_plugins', '');
        $nplugins = explode(PHP_EOL, $nplugins);
        $all_plugins = get_plugins();
        $all_plugins_keys = array_keys($all_plugins);
        if (count($all_plugins) < 1)
            return;
        $my_plugins_now = '';
        $loopCtr = 0;
        foreach ($all_plugins as $plugin_item) {
            $plugin_title = $plugin_item['Name'];
            $my_plugins_now[$loopCtr] = $plugin_title;
            $loopCtr++;
        }
         $antihacker_new_plugin = '';
         for ($i = 0; $i < $qpluginsnow; $i++) {
            $plugin_name = $my_plugins_now[$i]; 
            if ( ! in_array($plugin_name, $nplugins)) {
                $antihacker_new_plugin = $plugin_name;
                break;
            }
        }
        add_action('plugins_loaded', 'antihacker_alert_plugin');
        antihacker_save_name_plugins();
    }  //  if ($qpluginsnow > $qplugins)  
    if ($qpluginsnow < $qplugins) {
        antihacker_save_name_plugins();
    }
}     // End  Report new plugin installed...
if(is_admin())
{
    if(isset($_GET['page'])){
        if (sanitize_text_field($_GET['page']) == 'anti-hacker')
          {
              add_filter('contextual_help', 'ah_contextual_help', 10, 3);
              function ah_contextual_help($contextual_help, $screen_id, $screen)
                {
                    $myhelp = '<br><big>';
                    $myhelp .= __('Improve system security and help prevent unauthorized access to your account.', "antihacker");
                    $myhelp .= '<br>';
                    $myhelp .= __('Read the StartUp guide at Anti Hacker Settings page.', "antihacker");
                    $myhelp .= '<br>';
                    $myhelp .= __('Visit the', "antihacker");
                    $myhelp .= ' <a href="http://antihackerplugin.com" target="_blank">';
                    $myhelp .= __('plugin site', "antihacker");
                    $myhelp .= ' </a>';
                    $myhelp .= __('for more details.', "antihacker");
                    $myhelp .= '</big>';
                    $screen->add_help_tab(array(
                        'id' => 'wptuts-overview-tab',
                        'title' => __('Overview', 'plugin_domain'),
                        'content' => '<p>' . $myhelp . '</p>',
                        ));
                    return $contextual_help;
                } 
          }
    }
} 
function ahfindip()
{
    $ip = '';
		$headers = array(
            'HTTP_CLIENT_IP',        // Bill
            'HTTP_X_REAL_IP',        // Bill
            'HTTP_X_FORWARDED',      // Bill
            'HTTP_FORWARDED_FOR',    // Bill 
            'HTTP_FORWARDED',        // Bill
            'HTTP_X_CLUSTER_CLIENT_IP', //Bill
			'HTTP_CF_CONNECTING_IP', // CloudFlare
			'HTTP_X_FORWARDED_FOR',  // Squid and most other forward and reverse proxies
			'REMOTE_ADDR',           // Default source of remote IP
		);
		for ( $x = 0; $x < 8; $x++ ) {
			foreach ( $headers as $header ) {
                if(! isset($_SERVER[$header]))
                   continue;
                $myheader = trim(sanitize_text_field($_SERVER[$header]));
                if(empty($myheader))   
                  continue;
				$ip = trim(sanitize_text_field( $_SERVER[$header] ));
				if ( empty( $ip ) ) {
					continue;
				}
				if ( false !== ( $comma_index = strpos( sanitize_text_field($_SERVER[$header]), ',' ) ) ) {
					$ip = substr( $ip, 0, $comma_index );
				}
    			// First run through. Only accept an IP not in the reserved or private range.
				if($ip == '127.0.0.1')
                       {
                        $ip='';
                         continue;
                       }
				if ( 0 === $x ) {
					$ip = filter_var( $ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_RES_RANGE | FILTER_FLAG_NO_PRIV_RANGE );
				} else {
					$ip = filter_var( $ip, FILTER_VALIDATE_IP );
				}
				if ( ! empty( $ip ) ) {
					break;
				}
			}
			if ( ! empty( $ip ) ) {
				break;
			}
		}
    if (!empty($ip))
        return $ip;
    else
        return 'unknow';
 }
 function ah_whitelisted($antihackerip, $amy_whitelist)
{
    for ($i = 0; $i < count($amy_whitelist); $i++) {
        if (trim($amy_whitelist[$i]) == $antihackerip)
            return 1;
    }
    return 0;
}
function ah_successful_login($user_login)
{
    global $amy_whitelist;
    global $my_radio_all_logins;
    global $antihackerip;
    global $ah_admin_email;
    if (ah_whitelisted($antihackerip, $amy_whitelist) and $my_radio_all_logins <> 'Yes' )
        { return 1;}
        $dt = date("Y-m-d H:i:s");
        $dom = sanitize_text_field($_SERVER['SERVER_NAME']);
        $msg = __('This email was sent from your website', "antihacker").' ';
        $msg .= $dom. '&nbsp; '. __('by the AntiHacker plugin.', "antihacker");
        $msg .= '<br>';
        $msg .= __('Date', "antihacker") .': ' . $dt . '<br>';
        $msg .= __('Ip', "antihacker"). ': ' . $antihackerip . '<br>';
        $msg .= __('Domain', "antihacker").': ' . $dom . '<br>';
        $msg .= __('User', "antihacker") .': ' . $user_login;
        $msg .= '<br>';
        $msg .= __('Add this IP to your withelist to stop this email and change your Notification Settings.', "antihacker");  
        $email_from = 'wordpress@'.$dom;
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= "From: ".$email_from. "\r\n" . 'Reply-To: ' . $user_login . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
        $to = $ah_admin_email;
        $subject = __('Login Successful at', "antihacker").': '.$dom;
        wp_mail( $to, $subject, $msg, $headers, '' );
    return 1;
}
function ah_activ_message()
{
        echo '<div class="updated"><p>';
        $bd_msg = '<img src="'.ANTIHACKERURL.'/images/infox350.png" />';
        $bd_msg .= '<h2>';
        $bd_msg .= __('Anti Hacker Plugin was activated!', "antihacker");
        $bd_msg .= '</h2>';
        $bd_msg .= '<h3>';
        $bd_msg .= __('For details and help, take a look at Anti Hacker at your left menu', "antihacker");
        $bd_msg .= '<br />';
        $bd_msg .= ' <a class="button button-primary" href="admin.php?page=anti-hacker">';
        $bd_msg .= __('or click here', "antihacker");
        $bd_msg .= '</a>';
        echo $bd_msg;
        echo "</p></h3></div>";
}        

function ah_my_deactivation()
{
   // require_once (ANTIHACKERPATH . "includes/feedback/feedback.php");
    global $ah_admin_email, $antihackerip;
    $current_user = wp_get_current_user();
    $user_login = $current_user->user_login;
    $dt = date("Y-m-d H:i:s");
    $dom = sanitize_text_field($_SERVER['SERVER_NAME']);
    $url = esc_url($_SERVER['PHP_SELF']);
    $msg = __('Alert: the Anti Hacker plugin was been deactivated from plugins page.', "antihacker");
    $msg .= '<br>';
    $msg .= __('Date', "antihacker") .': ' . $dt . '<br>';
    $msg .= __('Ip', "antihacker"). ': ' . $antihackerip . '<br>';
    $msg .= __('Domain', "antihacker"). ': ' . $dom . '<br>';
    $msg .= __('User', "antihacker").': ' . $user_login;
    $msg .= '<br>';
    $msg .= __('This email was sent from your website', "antihacker"). ' ' . $dom .' ';
    $msg .= __('by Anti Hacker plugin.', "antihacker"). '<br>';
    $email_from = 'wordpress@' . $dom;
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= "From: " . $email_from . "\r\n" . 'Reply-To: ' . $user_login . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    $to = $ah_admin_email;
    $subject = __('Plugin Deactivated at', "antihacker") .': ' . $dom;
    wp_mail($to, $subject, $msg, $headers, '');
    return 1;   
}
function ah_email_display()
    { ?>
        <!-- <INPUT TYPE=CHECKBOX NAME="my_captcha">Yes, i'm a human! -->
        <? echo __('My Wordpress user email:', "antihacker"); ?>
        <br />
        <input type="text" id="myemail" name="myemail" value="" placeholder="" size="100" />
        <br />
        <?php     
    }
function ah_failed_login($user_login)
{
    global $amy_whitelist;
    global $my_checkbox_all_failed;
    global $antihackerip;
    global $ah_admin_email;
    antihacker_stats_moreone('qlogin');
   
    if (ah_whitelisted($antihackerip, $amy_whitelist) or $my_checkbox_all_failed <> '1' )
        { return;}
        $dt = date("Y-m-d H:i:s");
        $dom = sanitize_text_field($_SERVER['SERVER_NAME']);
        $msg =  __('This email was sent from your website', "antihacker");
        $msg .= ': '.$dom.' ';
        $msg .=  __('by the AntiHacker plugin.', "antihacker");
        $msg .= '<br> ';
        $msg .= __('Date', "antihacker");
        $msg .= ': ' . $dt . '<br>';
        $msg .= __('Ip', "antihacker").': ' . $antihackerip . '<br>';
        $msg .= __('Domain', "antihacker").': ' . $dom . '<br>';
        $msg .= __('User', "antihacker").': ' . $user_login;
        $msg .= '<br>';
        $msg .= __('Failed login', "antihacker");
        $msg .= '<br>';
        $msg .= '<br>';
        $msg .= __('You can stop emails at the Notifications Settings Tab.', "antihacker");
        $msg .= '<br>';
        $msg .= __('Dashboard => Anti Hacker => Notifications Settings.', "antihacker");
        $email_from = 'wordpress@'.$dom;
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= "From: ".$email_from. "\r\n" . 'Reply-To: ' . $user_login . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
        $to = $ah_admin_email;
        $subject = __('Failed Login at:', "antihacker").' '.$dom;
        wp_mail( $to, $subject, $msg, $headers, '' );
    return;
}
if (get_site_option('my_radio_xml_rpc', 'No') == 'Yes')
      add_filter( 'xmlrpc_enabled', '__return_false' );
if (get_site_option('my_radio_xml_rpc', 'No') == 'Pingback')
     add_filter( 'xmlrpc_methods', 'ahpremove_xmlrpc_pingback_ping' );
function ahpremove_xmlrpc_pingback_ping( $methods ) {
   unset( $methods['pingback.ping'] );
   return $methods;
} ;
/////////////////////////////////////////
// Disable Json WordPress Rest API (also embed from WordPress 4.7). 
// Take a look our faq page (at our site) for details.'
function antihacker_after_inic()
{
     $ah_current_WP_version = get_bloginfo('version');
     function ah_Force_Auth_Error() {
        add_filter( 'rest_authentication_errors', 'ah_only_allow_logged_in_rest_access' );
     }
     function ah_Disable_Via_Filters() {
    	// Filters for WP-API version 1.x
        add_filter( 'json_enabled', '__return_false' );
        add_filter( 'json_jsonp_enabled', '__return_false' );
        // Filters for WP-API version 2.x
        add_filter( 'rest_enabled', '__return_false' );
        add_filter( 'rest_jsonp_enabled', '__return_false' );
        // Remove REST API info from head and headers
        remove_action( 'xmlrpc_rsd_apis', 'rest_output_rsd' );
        remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
        remove_action( 'template_redirect', 'rest_output_link_header', 11 );
    }
    function ah_only_allow_logged_in_rest_access( $access ) {
        	if( ! is_user_logged_in() ) {
                return new WP_Error( 'rest_cannot_access', __( 'Only authenticated users can access API.', 'disable-json-api' ), array( 'status' => rest_authorization_required_code() ) );
            }
            return $access;
    	} 
    if ( version_compare( $ah_current_WP_version, '4.7', '>=' ) ) {
        ah_Force_Auth_Error();
    } else {
        ah_Disable_Via_Filters();
    }
}
   $antihacker_rest_api = trim(get_site_option('antihacker_rest_api', 'No'));
   if($antihacker_rest_api <> 'No')
        add_action( 'plugins_loaded', 'antihacker_after_inic' );
if(is_admin())
{
   if(get_option('ah_was_activated', '0') == '1')
   {
     add_action( 'admin_notices', 'ah_activ_message' );
     $r =  update_option('ah_was_activated', '0'); 
     if ( ! $r )
        add_option('ah_was_activated', '0');
   } 
}
function ah_debug_enabled()
   {
            echo '<div class="notice notice-warning is-dismissible">';
            echo '<br /><b>';
            echo __('Message from Anti Hacker Plugin','antihacker');
            echo ':</b><br />';
            echo __('Looks like Debug mode is enabled. (WP_DEBUG is true)','antihacker');
            echo '.<br />';
            echo __('if enabled on a production website, it might cause information disclosure, allowing malicious users to view errors and additional logging information', 'antihacker');
            echo '.<br />';       
            echo __('Please, take a look in our site, FAQ page, item => Wordpress Debug Mode or disable this message at General Settings Tab. ', 'antihacker');
            echo '<br /><br /></div>';
    }
function antihacker_alertme3($antihacker_string)
{
    global $antihackerip, $amy_whitelist, $ah_admin_email;
    global $antihacker_Blocked_Firewall, $antihackerserver;
    if (ah_whitelisted($antihackerip, $amy_whitelist) or $antihacker_Blocked_Firewall <> 'yes' )
        { return;} 
    $subject = __("Detected Bot on ", "antihacker") . $antihackerserver;
    $message[] = __("Malicious bot was detected and blocked by firewall.", "antihacker");
    $message[] = "";
    $message[] = __('Date', 'antihacker') . "..............: " . date("F j, Y, g:i a");
    $message[] = __('Robot IP Address', 'antihacker') . "..: " . $antihackerip;
    $message[] = __('Malicious String Found:', 'antihacker') ." ". $antihacker_string;
    $message[] = "";
    $message[] = __('eMail sent by Anti Hacker Plugin.', 'antihacker');
    $message[] = __('You can stop emails at the Notifications Settings Tab.',
        'antihacker');
    $message[] = __('Dashboard => Anti Hacker => Settings.', 'antihacker');
    $message[] = "";
    $msg = join("\n", $message);
    mail($ah_admin_email, $subject, $msg);
    return;
}
function antihacker_alertme4($antihacker_string)
{
    global $antihackerip, $amy_whitelist, $ah_admin_email;
    global $antihacker_Blocked_Firewall, $antihackerserver;
    if (ah_whitelisted($antihackerip, $amy_whitelist) or $antihacker_Blocked_Firewall <> 'yes' )
        { return;} 
    $subject = __("Detected Bot on ", "antihacker") . $antihackerserver;
    $message[] = __("Malicious bot was detected and blocked by firewall.", "antihacker");
    $message[] = "";
    $message[] = __('Date', 'antihacker') . "..............: " . date("F j, Y, g:i a");
    $message[] = __('Robot IP Address', 'antihacker') . "..: " . $antihackerip;
    $message[] = __('Malicious User Agent Found:', 'antihacker') ." ". $antihacker_string;
    $message[] = "";
    $message[] = __('eMail sent by Anti Hacker Plugin.', 'antihacker');
    $message[] = __('You can stop emails at the Notifications Settings Tab.',
        'antihacker');
    $message[] = __('Dashboard => Anti Hacker => Settings.', 'antihacker');
    $message[] = "";
    $msg = join("\n", $message);
    mail($ah_admin_email, $subject, $msg);
    return;
}
function antihacker_change_note_submenu_order( $menu_ord ) {
    global $submenu;
    function antihacker_str_replace_json($search, $replace, $subject) 
    {
        return json_decode(str_replace($search, $replace, json_encode($subject)), true);
    }
      $key = 'Anti Hacker';
      $val = 'Dashboard';
      $submenu = antihacker_str_replace_json($key, $val, $submenu);
}
add_filter( 'custom_menu_order', 'antihacker_change_note_submenu_order' );

function antihacker_populate_stats()
{
 global $wpdb;
 require_once (ABSPATH . 'wp-admin/includes/upgrade.php');
 $table_name = $wpdb->prefix . "ah_stats";
 $my_query = $wpdb->get_results( "SELECT * FROM $table_name" );
 if($wpdb->num_rows > 360)
   return;
 for($i=01; $i<13; $i++)
 {
     for($k=01; $k<32; $k++)
     {
        // insert in table iikk
        //$intval = (int) $string;
        //$string = (string) $intval;
        $year = 2020;
        if( ! checkdate ( $i , $k ,  $year ))
          continue;
        $mdata = (string) $i;
        if(strlen($mdata) < 2)
          $mdata = '0'.$mdata;
        $ddata = (string) $k;
        if(strlen($ddata) < 2)
          $ddata = '0'.$ddata;
        $data = $mdata.$ddata;
        $query = "select COUNT(*) from " . $table_name . " WHERE date = '" . $data .
                "' LIMIT 1";
        if ($wpdb->get_var($query) > 0) 
          continue;
        $query = "INSERT INTO " . $table_name .
                " (date)
                  VALUES ('" . $data . "')";
        $r = $wpdb->get_results($query);
     }
 } 
}
function antihacker_stats_moreone($qtype)
{
    global $wpdb;
    // $qtype = qlogin or qfire
    if($qtype != "qlogin" and $qtype != "qfire"  )
      return;
    $qtoday = date("m")+date("d");
    $mdata = date("m");
    $ddata = date("d");
    $mdata = (string) $mdata;
    if(strlen($mdata) < 2)
      $mdata = '0'.$mdata;
    $ddata = (string) $ddata;
    if(strlen($ddata) < 2)
       $ddata = '0'.$ddata;
    $qtoday = $mdata.$ddata;
    require_once (ABSPATH . 'wp-admin/includes/upgrade.php');
    $table_name = $wpdb->prefix . "ah_stats";
    $query = "UPDATE " . $table_name .
        " SET " .$qtype. " = ". $qtype . " + 1, qtotal = qtotal+1 WHERE date = '" . $qtoday . "'";
    $wpdb->query($query);
}
function antihacker_create_db_stats()
{
    global $wpdb;
    require_once (ABSPATH . 'wp-admin/includes/upgrade.php');
    // creates my_table in database if not exists
    $table = $wpdb->prefix . "ah_stats";
    global $wpdb;
    $table_name = $wpdb->prefix . "ah_stats";
    if (antihacker_tablexist($table_name))
        return;
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE ".$table. " (
        `id` mediumint(9) NOT NULL AUTO_INCREMENT,
        `date` varchar(4) NOT NULL,
        `qlogin` text NOT NULL,
        `qfire` text NOT NULL,
        `qtotal` varchar(100) NOT NULL,
    UNIQUE (`id`),
    UNIQUE (`date`)
    ) $charset_collate;";
    dbDelta($sql);
}
function ah_activated()
{
    ob_start();
    global $my_whitelist;
    global $ah_admin_email;

    antihacker_create_db_stats();
    antihacker_populate_stats();

    add_option('ah_was_activated', '1');
    update_option('ah_was_activated', '1');
    $antihackerip = ahfindip() ;
    if(is_admin())
    {
        if (empty($my_whitelist)) {
            if ( get_site_option( 'my_whitelist') !== false ) {
               $return = update_site_option('my_whitelist', $antihackerip);
            }
            else
           {
                $return = add_site_option('my_whitelist', $antihackerip);
           }
        }
    } 
    $antihacker_installed = trim(get_option( 'antihacker_installed',''));
    if(empty($antihacker_installed)){
      add_option( 'antihacker_installed', time() );
      update_option( 'antihacker_installed', time() );
    }
   ob_end_clean();
}
function antihacker_response() {
	
    header('HTTP/1.1 403 Forbidden');
    header('Status: 403 Forbidden');
    header('Connection: Close');
    exit();
}
function antihacker_tablexist($table)
{
    global $wpdb;
    $table_name = $table;
    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name)
        return true;
    else
        return false;
}
Function antihacker_check_memory()
{
      global $antihacker_memory;
      $antihacker_memory['limit'] = (int) ini_get('memory_limit') ;	
      $antihacker_memory['usage'] = function_exists('memory_get_usage') ? round(memory_get_usage() / 1024 / 1024, 0) : 0;
      if(!defined("WP_MEMORY_LIMIT"))
      {
        $antihacker_memory['msg_type'] = 'notok';  
        return;
      }
      $antihacker_memory['wp_limit'] =  trim(WP_MEMORY_LIMIT) ;
    if ($antihacker_memory['wp_limit'] > 9999999)
        $antihacker_memory['wp_limit'] = ($antihacker_memory['wp_limit'] / 1024) / 1024;
    if (!is_numeric($antihacker_memory['usage'])) {
        $antihacker_memory['msg_type'] = 'notok';  
        return;
    }
    if (!is_numeric($antihacker_memory['limit'])) {
        $antihacker_memory['msg_type'] = 'notok';  
        return;
    }
    if ($antihacker_memory['usage'] < 1) {
        $antihacker_memory['msg_type'] = 'notok';  
        return;
    }
  $wplimit = $antihacker_memory['wp_limit'];  
  $wplimit = substr($wplimit,0,strlen($wplimit)-1);
  $antihacker_memory['wp_limit'] = $wplimit;
  $antihacker_memory['percent'] = $antihacker_memory['usage'] / $antihacker_memory['wp_limit'];
  $antihacker_memory['color'] = 'font-weight:normal;';
  if ($antihacker_memory['percent'] > .7) $antihacker_memory['color'] = 'font-weight:bold;color:#E66F00';
  if ($antihacker_memory['percent'] > .85) $antihacker_memory['color'] = 'font-weight:bold;color:red';
  $antihacker_memory['msg_type'] = 'ok';  
  return $antihacker_memory;
}?>