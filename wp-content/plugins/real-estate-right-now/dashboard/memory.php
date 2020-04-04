<?php
/**
 * @author William Sergio Minozzi
 * @copyright 2017
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly 

    ///////////// Fix Config ///////////////// 
$REALESTATEkey = urlencode(substr(NONCE_KEY,0,10));
$realestatemypath = REALESTATEURL.'/dashboard/fixconfig.php';
$realestatemyrestore = REALESTATEURL.'/public/restore-config.php?key='.$REALESTATEkey;
?>

    ?>
    <div id="pluginfix-wpconfig" style="display: none;">
    <div class="bill-fix-realestate-wrap" style="">
    <div class="pluginfix-message" style="">
    If your server allow us, we can try to fix your file wp-config.php to release more memory.
    <br />
    <strong>Please, copy the url blue below to safe place before to proceed.</strong>
    <br />  
    Use the url only to undo this operation if you've problem accessing your site after the update.
    <br />
    <br />
    After Copy the URL, click UPDATE to proceed or Cancel to abort.
    <br />   <br />
    <textarea rows="3" id="restore_wpconfig" name="restore_wpconfig" style="width:100%; color: blue;"><?php echo $realestatemyrestore;?></textarea>
    <textarea rows="6" id="feedback_wpconfig" name="feedback_wpconfig" style="width:100%; font-weight: bold;" ></textarea>
    <br /><br /> 			
                        <a href="#" class="button button-primary button-close-wpconfig"><?php _e("Update","kardealer");?></a>
                        <a href="#" class="button button-primary button-cancell-wpconfig"><?php _e("Cancel","kardealer");?></a>
                        <img alt="aux" src="/wp-admin/images/wpspin_light-2x.gif" id="bill-imagewait20" />
                        <input type="hidden" id="email" name="email" value="<?php echo $email;?>" />
                        <input type="hidden" id="url_config" name="url_config" value="<?php echo $realestatemypath;?>" />
                        <input type="hidden" id="REALESTATEURLkey" name="REALESTATEURLkey" value="<?php echo $REALESTATEURLkey;?>" />
                        <input type="hidden" id="server_memory" name="server_memory" value="<?php echo (int) ini_get('memory_limit')?>" />
    </div>
    </div>
</div>
<!-- ///////////// End Fix config /////////////////  -->
<?php
 
$realestate_memory = realestate_check_memory();

echo '<div id="realestate-memory-page">';
echo '<div class="realestate-block-title">';

    if ( $realestate_memory['msg_type'] == 'notok')
       {
        echo 'Unable to get your Memory Info';
        echo '</div>';

    }
    else
    {
        
echo 'Memory Info';
echo '</div>';
echo '<div id="memory-tab">';
echo '<br />';
if($realestate_memory['msg_type']  == 'ok')
 $mb = 'MB';
else
 $mb = '';
echo 'Current memory WordPress Limit: ' . $realestate_memory['wp_limit'] . $mb .
    '&nbsp;&nbsp;&nbsp;  |&nbsp;&nbsp;&nbsp;';
$perc = $realestate_memory['usage'] / $realestate_memory['wp_limit'];
if ($perc > .7)
   echo '<span style="'.$realestate_memory['color'].';">';
echo 'Your usage now: ' . $realestate_memory['usage'] .
    'MB &nbsp;&nbsp;&nbsp;';
if ($perc > .7)
   echo '</span>';    
echo '|&nbsp;&nbsp;&nbsp;   Total Server Memory: ' . $realestate_memory['limit'] .
    'MB';
// echo 'Current memory WordPress Limit: '.$realestate_memory['wp_limit'].$mb.'&nbsp;&nbsp;&nbsp;  |&nbsp;&nbsp;&nbsp;   Your usage: '.$realestate_memory['usage'].'MB of '.$realestate_memory['limit'];
   echo '<br />';    
   echo '<br />'; 
   echo '<br />';
?>  
   </strong>
<!-- <div id="memory-tab"> -->

<!-- <div id="memory-tab"> -->
<?php
///////////////////////////
    // Fix it...
    if (! is_bill_theme())
    {
        $wplimit = $realestate_memory['wp_limit'];
        if (!is_multisite() and $realestate_memory['limit'] >= 128 and $wplimit < 128) {
            echo 'WordPress memory limit looks low. <br />We can try to fix and increase the memory with just one click:';
            echo '<br />';
            echo '<a href="#" id="pluginfix-wpconfig-button" class="button button-primary">Fix it Now!</a>';
            echo '<br />';
            echo '<br />';
            echo '<hr>';
            echo 'Follow this instructions to do it manually:';
            echo '<br />';
        }
    }
    //////////////////////////////
?>
    <br />
    To increase the WordPress memory limit, add this info to your file wp-config.php (located at root folder of your server)
    <br />
    (just copy and paste)
    <br />    <br />
<strong>    
define('WP_MEMORY_LIMIT', '128M');
</strong>
    <br />    <br />
    before this row:
    <br />
    /* That's all, stop editing! Happy blogging. */
    <br />
    <br />
    If you need more, just replace 128 with the new memory limit.
    <br /> 
    To increase your total server memory, talk with your hosting company.
    <br />   <br />
    <hr />
    <br />    
<strong>    How to Tell if Your Site Needs a Shot of more Memory:</strong>
        <br />    <br />
    If your site is behaving slowly, or pages fail to load, you 
    get random white screens of death or 500 
    internal server error you may need more memory. 
Several things consume memory, such as WordPress itself, the plugins installed, the 
theme you're using and the site content.
     <br />  
Basically, the more content and features you add to your site, 
the bigger your memory limit has to be.
if you're only running a small 
site with basic functions without a Page Builder and Theme 
Options (for example the native Twenty Sixteen). However, once 
you use a Premium WordPress theme and you start encountering 
unexpected issues, it may be time to adjust your memory limit 
to meet the standards for a modern WordPress installation.
     <br /> <br />    
    Increase the WP Memory Limit is a standard practice in 
WordPress and you find instructions also in the official 
WordPress documentation (Increasing memory allocated to PHP).
    <br /><br />
Here is the link:    
<br />
<a href="https://codex.wordpress.org/Editing_wp-config.php" target="_blank">https://codex.wordpress.org/Editing_wp-config.php</a>
<br /><br />
</div>
</div>
<?php
}
?>