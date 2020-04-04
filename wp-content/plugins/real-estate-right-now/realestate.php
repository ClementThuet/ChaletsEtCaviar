<?php /*
Plugin Name: Real Estate Right Now 
Plugin URI: http://realestateplugin.eu
Description: Real Estate Plugin for Real Estate agency.
Version: 3.73
Text Domain: realestate
Domain Path: /language
Author: Bill Minozzi
Author URI: http://billminozzi.com
License:     GPL2
Copyright (c) 2017 Bill Minozzi
Real Estate Right Away is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
realestate is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with realestate. If not, see {License URI}.
Permission is hereby granted, free of charge subject to the following conditions:
The above copyright notice and this FULL permission notice shall be included in
all copies or substantial portions of the Software.
THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
DEALINGS IN THE SOFTWARE.
*/
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
define('REALESTATEVERSION', '3.73');
define('REALESTATEPATH', plugin_dir_path(__file__));
define('REALESTATEURL', plugin_dir_url(__file__));
define('REALESTATEIMAGES', plugin_dir_url(__file__) . 'assets/images/');
include_once (ABSPATH . 'wp-includes/pluggable.php');
function realestate_plugin_settings_link($links)
{
    $settings_link = '<a href="options.php?page=rep_settings">Settings</a>';
    array_unshift($links, $settings_link);
    return $links;
}
$plugin = plugin_basename(__file__);
if (is_admin()) {
    $path = basename( dirname( __FILE__ ) ) . '/language';
    $loaded = load_plugin_textdomain('realestate', false, $path);
    if (!$loaded and get_locale() <> 'en_US') {
        if (function_exists('RealEstate_localization_init_fail'))
            add_action('admin_notices', 'RealEstate_localization_init_fail');
    }
} else {
    add_action('plugins_loaded', 'RealEstate_localization_init');
}
add_filter("plugin_action_links_$plugin", 'realestate_plugin_settings_link');
require_once (REALESTATEPATH . "settings/load-plugin.php");
require_once (REALESTATEPATH . "settings/options/plugin_options_tabbed.php");
//require_once (REALESTATEPATH . 'includes/contact-form/multi-contact-form.php');
require_once (REALESTATEPATH . 'includes/help/help.php');
require_once (REALESTATEPATH . 'includes/functions/functions.php');
require_once (REALESTATEPATH . 'includes/post-type/meta-box.php');
require_once (REALESTATEPATH . 'includes/post-type/post-functions.php');
require_once (REALESTATEPATH . 'includes/templates/template-functions.php');
require_once (REALESTATEPATH . 'includes/templates/redirect.php');
require_once (REALESTATEPATH . 'includes/widgets/widgets.php');
require_once (REALESTATEPATH . 'includes/search/search-function.php');
require_once (REALESTATEPATH . 'includes/multi/multi.php');
require_once (REALESTATEPATH . 'dashboard/main.php');
// require_once (REALESTATEPATH . 'includes/templates/template-showroom1.php');
require_once (REALESTATEPATH . 'includes/multi/multi-functions.php');
require_once (REALESTATEPATH . 'includes/contact-form/multi-contact-form.php');
require_once (REALESTATEPATH . 'assets/inc/aq_resizer.php');
require_once (REALESTATEPATH . 'includes/team/team.php');
$realestate_template_gallery = trim(get_option('realestate_template_gallery',
    'no'));
if ($realestate_template_gallery == 'yes')
   require_once (REALESTATEPATH . 'includes/templates/template-showroom.php');
else
   require_once (REALESTATEPATH . 'includes/templates/template-showroom1.php');
$realestateurl = esc_url($_SERVER['REQUEST_URI']);
if (strpos($realestateurl, 'product') !== false) {
    $RealEstate_overwrite_gallery = strtolower(get_option('RealEstate_overwrite_gallery',
        'yes'));
    if ($RealEstate_overwrite_gallery == 'yes')
        require_once (REALESTATEPATH . 'includes/gallery/gallery.php');
}
function RealEstate_add_files()
{
    wp_enqueue_style('show-room', REALESTATEURL . 'includes/templates/show-room.css');
    wp_enqueue_style('pluginStyleGeneral', REALESTATEURL .
        'includes/templates/template-style.css');
    wp_enqueue_style('pluginStyleSearch2', REALESTATEURL .
        'includes/search/style-search-box.css');
    wp_enqueue_style('pluginStyleSearchwidget', REALESTATEURL .
        'includes/widgets/style-search-widget.css');
    wp_enqueue_style('pluginStyleGeneral4', REALESTATEURL .
        'includes/gallery/css/flexslider.css');
    wp_enqueue_style('pluginStyleGeneral5', REALESTATEURL .
        'includes/contact-form/css/multi-contact-form.css');
     wp_enqueue_style('pluginTeam2', REALESTATEURL .
        'includes/team/team-custom.css'); 
    wp_enqueue_style('pluginTeam1', REALESTATEURL .
        'includes/team/team-custom-bootstrap.css');
    wp_register_style('jqueryuiSkin', REALESTATEURL . 'assets/jquery/jqueryui.css',
        array(), '1.12.1');
    wp_enqueue_style('jqueryuiSkin');
    wp_enqueue_style( 'bill-caricons' , REALESTATEURL .'assets/icons/icons-style.css');
    wp_enqueue_script('jquery-ui-slider');
//    wp_enqueue_script('jquery-ui-core');
    wp_register_style('fontawesome-css', REALESTATEURL . '/assets/fonts/font-awesome/css/font-awesome.min.css', array(), REALESTATEVERSION);
    wp_enqueue_style('fontawesome-css');
    //  wp_enqueue_style( 'load-fa', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );   
}
add_action('wp_enqueue_scripts', 'RealEstate_add_files');
function RealEstate_activated()
{
    $w = update_option('RealEstate_activated', '1');
    if (!$w)
        add_option('RealEstate_activated', '1');
    $admin_email = get_option('admin_email');
    $old_admin_email = trim(get_option('RealEstate_recipientEmail', ''));
    if (empty($old_admin_email)) {
        $w = update_option('RealEstate_recipientEmail', $admin_email);
        if (!$w)
            add_option('RealEstate_recipientEmail', $admin_email);
    }
}
register_activation_hook(__file__, 'RealEstate_activated');
function RealEstate_localization_init()
{
    $path = basename( dirname( __FILE__ ) ) . '/language';
    $loaded = load_plugin_textdomain('realestate', false, $path);
}
function realestateplugin_load_bill_stuff()
{
    //wp_enqueue_script('jquery-ui-core');
    if( is_admin())
    {
       if( isset( $_GET[ 'taxonomy' ] ) ) 
          $active_tax = sanitize_text_field($_GET[ 'taxonomy' ]);
       if(isset($active_tax))
         if($active_tax == 'agents')
             wp_enqueue_media();
        // did_action( 'wp_enqueue_media' );
    }
}
add_action('wp_loaded', 'realestateplugin_load_bill_stuff'); 
function realestate_load_activate()
{
    
    wp_enqueue_script('jquery-ui-core');

    if (is_admin()) {
        require_once (REALESTATEPATH . 'includes/feedback/activated-manager.php');
    }
}
add_action('in_admin_footer', 'realestate_load_activate'); 
add_action( 'admin_menu', 'realestate_add_menu_gopro2' );
?>