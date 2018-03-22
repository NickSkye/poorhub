<?php
require_once('includes/config.php');
require_once('includes/classes/class.template_engine.php');
require_once('includes/classes/class.country.php');
require_once('includes/functions/func.global.php');
require_once('includes/functions/func.users.php');
require_once('includes/functions/func.sqlquery.php');
require_once('includes/lang/lang_'.$config['lang'].'.php');
require_once("includes/lib/curl/curl.php");
require_once("includes/lib/curl/CurlResponse.php");
if($config['mod_rewrite'] == 0)
    require_once('includes/simple-url.php');
else
    require_once('includes/seo-url.php');
$mysqli = db_connect($config);
sec_session_start();
if(!isset($_GET['i']))
{
    error($lang['INVALID-PAYMENT_PROCESS'], __LINE__, __FILE__, 1);
    exit();
}

$_GET['i'] = str_replace('.','',$_GET['i']);
$_GET['i'] = str_replace('/','',$_GET['i']);
$_GET['i'] = strip_tags($_GET['i']);

if(preg_match('[^A-Za-z0-9_]',$_GET['i']))
{
    error($lang['INVALID-PAYMENT_PROCESS'], __LINE__, __FILE__, 1);
    exit();
}

if(trim($_GET['i']) == '')
{
    error($lang['INVALID-PAYMENT_PROCESS'], __LINE__, __FILE__, 1);
    exit();
}

if(isset($_GET['i']))
{
    $payment_settings = mysqli_fetch_array(mysqli_query($mysqli,"SELECT payment_folder FROM ".$config['db']['pre']."payments WHERE payment_folder='".$_GET['i']."' LIMIT 1"));

    if(!isset($payment_settings['payment_folder']))
    {
        error($lang['NOT-FOUND-PAYMENT'], __LINE__, __FILE__, 1);
        exit();
    }

    require_once('includes/payments/'.$payment_settings['payment_folder'].'/ipn.php');
}
?>
