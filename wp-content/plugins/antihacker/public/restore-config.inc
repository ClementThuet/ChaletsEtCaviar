<?php /**
 * @author William Sergio Minossi
 * @copyright 2017
 */

/*
error_reporting(E_ALL);
ini_set('display_errors', 1);
*/

define('Error_config', 'Error to Restore Config. ');
$showmyForm = true;




$mypath = getcwd();
$pos = strpos($mypath, '/wp-content/plugins/');
if ($pos === false)
    die(Error_config . 'Unable to find plugin path. Aborted.');
$pluginroot = substr($mypath, 0, $pos + 1);
$pos = strpos($mypath, '/public');
if ($pos === false)
    die(Error_config . 'Unable to find plugin path. Aborted.');
$pluginpublic = $mypath.'/';
$configFilePath = $pluginroot . 'wp-config.php';
$configBackup = $pluginpublic . 'wp-config.php';
if (!is_readable($configBackup)) {
    die(Error_config . 'Invalid Backup File: ' . $configBackup . '  Aborted.');
}
$bkpsize = filesize($configBackup);
if ($bkpsize < 1000)
    die(Error_config . 'Backup file size error! Aborted');

$oldconfigContent = file_get_contents($configBackup);

$lenfile = strlen($oldconfigContent);
if ($lenfile < 1000)
    die('Backup file invalid. Aborted!');


//////////////// GET ///////////////////
$realkey = get_key();

$key = '';
if (isset($_GET['key']))
	$key = $_GET['key'];
else
    die('Invalid Link!');

//$key = strip_tags(urldecode($key));
//$key = urldecode($key);

if(strlen($key) != 10)
    die('Invalid Link!'); 


if ($realkey != $key)
    die('Wrong Link! Aborted.');

////  END ///////




if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mymessage = 'Backup File Restored!';
    try {
        if (!file_put_contents($configFilePath, $oldconfigContent)) {
           die(Error_config . 'Could not Restore Backup file: ' . $configBackup . ' Aborted.');
        }
        else
        $mymessage = 'Backup File Restored!';
    }
    catch (exception $e) {
        $mymessage = $e->getMessage();
    }
    $showmyForm = false;
}
//////////
function get_key()
{
    global $oldconfigContent;
    $pos = strpos($oldconfigContent, "define('NONCE_KEY',");
    if ($pos === false)
        die(Error_config . 'Fail to find key constant. Aborted.');
    $key = trim(substr($oldconfigContent, $pos + 20, 25));
    $key = substr($key, 1, 10);
    return $key;
} ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<head>
		<title>Config File Emergency Restore Interface</title>
		<style type="text/css">
			body 
			{
				background-color: #454444;
				color: white;
				font-family: arial;
				font-size: 18px;
                padding: 50px;
			}
			div#bill-restore-tools 
			{
		    margin: 50px auto;
		    width: 600px;
		    height: 300px;
		    text-align: center;
			}
			#bill-restore-tools .restore-button
			{
		    margin-top: 50px;
		    width: 300px;
		    height: 100px;
		    background-color: red;
		    font-size: 38px;
		    border-color: gray;
		    color: white;
            cursor: pointer;
			}
		</style>
	</head>
	<body>
<?php if ($showmyForm): ?>
		<div id="bill-restore">			
			<div id="bill-restore-tools">
              <h2>Click RESTORE FILE to Restore the original WP-CONFIG.PHP</h2>
              <?php 
              if(! empty($configBackup))
               echo '<h3> Path of Backup: <br /> '.$configBackup.'</h3>';
              ?>
				<form method="post">
					<input class="restore-button" type="submit" name="Restore" value="Restore File" />
                    <input type="hidden" value="<?php echo $key; ?>" />
			</form>
			</div>
		</div>
<?php else: ?>
	<span><h2><?php echo $mymessage; ?></h2></span>
<?php endif; ?>
	</body>
</html>