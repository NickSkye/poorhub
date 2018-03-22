<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

if(!isset($_GET['i']))
{
	exit('Error: Invalid Payment Processor');
}

if(isset($_GET['i']))
{
    if(!isset($_POST['TXN_AMOUNT']))
    {
        error($lang['ERROR'], __LINE__, __FILE__, 1,$lang,$config,$link);
        exit();
    }
// following files need to be included
    require_once("./lib/config_paytm.php");
    require_once("./lib/encdec_paytm.php");

    $paytmChecksum = "";
    $paramList = array();
    $isValidChecksum = "FALSE";

    $paramList = $_POST;
    $paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application�s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
    $isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.

    $custom = $_POST["ORDER_ID"];   //Transaction ID

    if($isValidChecksum == "TRUE") {
        echo "<b>Checksum matched and following are the transaction details:</b>" . "<br/>";
        if ($_POST["STATUS"] == "TXN_SUCCESS") {
            echo "<b>Transaction status is success</b>" . "<br/>";
            echo "<b>Order ID</b>" .$_POST["ORDER_ID"]. "<br/>";
            echo "<b>Amount</b>" .$_POST["TXN_AMOUNT"]. "<br/>";
            //Process your transaction here as success transaction.
            //Verify amount & order id received from Payment gateway with your application's order id and amount.


        }
        else {
            echo "<b>Transaction status is failure</b>" . "<br/>";
        }

        if (isset($_POST) && count($_POST)>0 )
        {
            foreach($_POST as $paramName => $paramValue) {
                echo "<br/>" . $paramName . " = " . $paramValue;
            }
        }


    }
    else {
        echo "<b>Checksum mismatched.</b>";
        //Process transaction as suspicious.
    }
}
?>