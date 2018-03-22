<?php
/**
 * Quickad Rating & Reviews - jQuery & Ajax php
 * @author Bylancer
 * @version 1.0
 */

global $db;
global $productid;

require_once('../../includes/config.php');
require_once('../../includes/functions/func.global.php');
require_once('../../includes/functions/func.users.php');
require_once('../../includes/lang/lang_'.$config['lang'].'.php');
sec_session_start();

$db = db_connect($config);

if (isset($_GET['productid'])) {
    if (!empty($_GET['productid'])) {
         $productid = $_GET['productid'];  
    } else {
       $productid = '';  
    }
} else {
    $productid = '';
}
?>