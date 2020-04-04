<?php
/**
 * @author William Sergio Minossi
 * @copyright 2016
 */

// If uninstall is not called from WordPress, exit
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit();
}
/*
my_radio_xml_rpc
antihacker_rest_api
antihacker_automatic_plugins
antihacker_automatic_themes
antihacker_replace_login_error_msg

antihacker_disallow_file_edit
antihacker_debug_is_true
antihacker_firewall
my_whitelist
my_email_to

my_checkbox_all_failed
my_radio_all_logins
antihacker_Blocked_Firewall
*/
$antihacker_option_name[0] = 'my_radio_xml_rpc';
$antihacker_option_name[1] = 'antihacker_rest_api';
$antihacker_option_name[2] = 'antihacker_automatic_plugins';
$antihacker_option_name[3] = 'antihacker_automatic_themes';
$antihacker_option_name[4] = 'antihacker_replace_login_error_msg';

$antihacker_option_name[5] = 'antihacker_disallow_file_edit';
$antihacker_option_name[6] = 'antihacker_debug_is_true';
$antihacker_option_name[7] = 'antihacker_firewall';
$antihacker_option_name[8] = 'my_whitelist';
$antihacker_option_name[9] = 'my_email_to';

$antihacker_option_name[10] = 'my_checkbox_all_failed';
$antihacker_option_name[11] = 'my_radio_all_logins';
$antihacker_option_name[12] = 'antihacker_Blocked_Firewall';

for ($i = 0; $i < 8; $i++)
{
 delete_option( $antihacker_option_name[$i] );
 // For site options in Multisite
 delete_site_option( $antihacker_option_name[$i] );    
}

// Drop a custom db table
global $wpdb;
$current_table = $wpdb->prefix . 'ah_stats';
$wpdb->query( "DROP TABLE IF EXISTS $current_table" );
?>