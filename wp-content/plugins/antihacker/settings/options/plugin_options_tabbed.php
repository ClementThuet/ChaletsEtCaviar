<?php namespace Antihacker\WP\Settings;


// $mypage = new Page('Anti Hacker', array('type' => 'menu'));
$mypage = new Page('Anti Hacker', array('type' => 'submenu', 'parent_slug' => 'anti_hacker_plugin'));

      
$settings = array();

$myip = ahfindip();  

require_once (ANTIHACKERPATH. "guide/guide.php");


$settings['Startup Guide']['Startup Guide'] = array('info' => $ah_help );
$fields = array();   

        
$settings['Startup Guide']['Startup Guide']['fields'] = $fields;

$msg2 = __('Just check yes or not. After that, click SAVE changes. ', "antihacker");
$msg2 .= '<b>';
$msg2 .= __('We suggest click Yes for all. ', "antihacker");
$msg2 .= '</b>';
$msg2 .= '<br />';$msg2 .= __('Please, visit our Faq page for more details (button at Startup Guide Tab).', "antihacker");

$msg2 .= '<br />';

$settings['General Settings']['settings'] = array('info' => $msg2);

    
    
$fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'my_radio_xml_rpc',
	'label' => __('Disable xml-rpc API', "antihacker"),
	'radio_options' => array(
		array('value'=>'Yes', 'label' => __('Yes, disable All', "antihacker")),
  		array('value'=>'Pingback', 'label' => __('Yes, disable only Ping Back', "antihacker")),
		array('value'=>'No', 'label' => __('No', "antihacker")),
		)			
	); 

$fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'antihacker_rest_api',
	'label' => __('Disable Json WordPress Rest API (also new WordPress 4.7 Rest API). Take a look our faq page (at our site) for details.', "antihacker"),
	'radio_options' => array(
		array('value'=>'Yes', 'label' => __('Yes, disable', "antihacker")),
		array('value'=>'No', 'label' => __('No', "antihacker")),
		)			
	); 
    
$fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'antihacker_automatic_plugins',
	'label' => __('Sets WordPress to automatically download and install plugin updates.', "antihacker"),
	'radio_options' => array(
		array('value'=>'yes', 'label' => __('Yes', "antihacker")),
		array('value'=>'no', 'label' => __('No', "antihacker")),
		)			
	); 
 
$fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'antihacker_automatic_themes',
	'label' => __('Sets WordPress to automatically download and install themes updates.', "antihacker"),
	'radio_options' => array(
		array('value'=>'yes', 'label' => __('Yes', "antihacker")),
		array('value'=>'no', 'label' => __('No', "antihacker")),
		)			
	);     
    
$fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'antihacker_replace_login_error_msg',
	'label' => __('Sets WordPress to replace the login error message to Wrong Username or Password', "antihacker"),
	'radio_options' => array(
		array('value'=>'yes', 'label' => __('Yes', "antihacker")),
		array('value'=>'no', 'label' => __('No', "antihacker")),
		)			
	);

$fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'antihacker_disallow_file_edit',
	'label' => __('Disable file editing within the WordPress dashboard', "antihacker"),
	'radio_options' => array(
		array('value'=>'yes', 'label' => __('Yes', "antihacker")),
		array('value'=>'no', 'label' => __('No', "antihacker")),
		)			
	);
 
$fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'antihacker_debug_is_true',
	'label' => __('Enable dashboard warning message when Debug is true', "antihacker"),
	'radio_options' => array(
		array('value'=>'yes', 'label' => __('Yes', "antihacker")),
		array('value'=>'no', 'label' => __('No', "antihacker")),
		)			
	);
       
$fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'antihacker_firewall',
	'label' => __('Enable Firewall? (Block Malicious Requests, Queries, User Agents and URLS. 100% Plug-n-play, no configuration required.)','antihacker'),
	'radio_options' => array(
		array('value'=>'yes', 'label' => __('Yes', "antihacker")),
		array('value'=>'no', 'label' => __('No', "antihacker"))
		)			
	);    
    
      
    
$settings['General Settings']['settings']['fields'] = $fields;
    

$msg2 = __('Add your current ip to your whitelist, then click SAVE CHANGES.', "antihacker");
$msg2 .= '<br />';
$msg2 .= __('If necessary add more than one, use only one ip by line.', "antihacker");
$msg2 .= '<br />';
$msg2 .=  '<b>';
$msg2 .=  __('Your current ip is: ', "antihacker" );
$msg2 .= $myip;
$msg2 .=  '</b>';

$settings['Whitelist']['whitelist'] = array('info' => $msg2);
    
$fields = array();   
$fields[] = array(
	'type' 	=> 'textarea',
	'name' 	=> 'my_whitelist',
	'label' => 'whitelist'
	);
    
$settings['Whitelist']['whitelist']['fields'] = $fields; 


$admin_email_wp = get_option( 'admin_email' ); 
$msg_email = __('Fill out the email address to send messages.', "antihacker");
$msg_email .= '<br />';
$msg_email = __('Left Blank to use your default Wordpress email.', "antihacker");
$msg_email .= '<br />';
$msg_email .= __('Then, click save changes.', "antihacker");

 
$settings['Email Settings']['email'] = array('info' => $msg_email );
$fields = array();
$fields[] = array(
	'type' 	=> 'text',
	'name' 	=> 'my_email_to',
	'label' => 'email'
	);
$settings['Email Settings']['email']['fields'] = $fields;




//$admin_email = get_option( 'admin_email' ); 
$notificatin_msg = __('Do you want receive alerts? ', "antihacker");
 
$settings['Notifications Settings']['Notifications'] = array('info' => $notificatin_msg );
$fields = array();


$fields[] = array(
	'type' 	=> 'checkbox',
	'name' 	=> 'my_checkbox_all_failed',
	'label' => __('Alert me all Failed Login Attempts', "antihacker")
	);
        
    
$fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'my_radio_all_logins',
	'label' => __('Alert me All Logins', "antihacker"),
	'radio_options' => array(
		array('value'=>'Yes', 'label' => __('Yes, All', "antihacker")),
		array('value'=>'No', 'label' => __('No, Alert me Only Not White listed', "antihacker")),
		)			
	);    
    

$fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'antihacker_Blocked_Firewall',
	'label' => __('Alert me All Times Firewall Block Something.', "antihacker"),
	'radio_options' => array(
		array('value'=>'yes', 'label' => __('Yes', "antihacker")),
		array('value'=>'no', 'label' => __('No', "antihacker")),
		)			
	);    
    
    
$settings['Notifications Settings']['Notifications']['fields'] = $fields;

$msg = '<big>';
$msg .= __('Do you want Report Attacks to the respective abuse departments?' , 'reportattacks');
$msg .= '<br />';
$msg .= '<a href="https://wordpress.org/plugins/reportattacks/" target="_self">';
$msg .= __('Just Replace this plugin with this one (free)', "antihacker");
$msg .= '</a>';
$msg .= '</big>';

$settings['Report Attacks']['Report Attacks'] = array('info' => $msg );
$fields = array();
 
       
$settings['Report Attacks']['Report Attacks']['fields'] = $fields;



new OptionPageBuilderTabbed($mypage, $settings);


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
				if ( ! isset( $_SERVER[$header] ) ) {
					continue;
				}
				$ip = trim(sanitize_text_field( $_SERVER[$header] ));
				if ( empty( $ip ) ) {
					continue;
				}
				if ( false !== ( $comma_index = strpos(sanitize_text_field( $_SERVER[$header]), ',' ) ) ) {
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