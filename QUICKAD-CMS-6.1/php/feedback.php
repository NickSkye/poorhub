<?php
require_once('includes/config.php');
require_once('includes/classes/class.template_engine.php');
require_once('includes/classes/class.country.php');
require_once('includes/functions/func.global.php');
require_once('includes/functions/func.users.php');
require_once('includes/functions/func.sqlquery.php');
require_once('includes/lang/lang_'.$config['lang'].'.php');
if($config['mod_rewrite'] == 0)
    require_once('includes/simple-url.php');
else
    require_once('includes/seo-url.php');

$mysqli = db_connect($config);
sec_session_start();

$recaptcha_error = '';
if(isset($_POST['Submit']))
{
    if($config['recaptcha_mode'] == 1){
        if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
            //your site secret key
            $secret = $config['recaptcha_private_key'];
            //get verify response data
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
            $responseData = json_decode($verifyResponse);
            if ($responseData->success) {
                $recaptcha_responce = true;
            }else{
                $recaptcha_responce = false;
                $recaptcha_error = $lang['RECAPTCHA_ERROR'];
            }
        }else{
            $recaptcha_responce = false;
            $recaptcha_error = $lang['RECAPTCHA_CLICK'];
        }
    }else{
        $recaptcha_responce = true;
    }

    if($recaptcha_responce){
        $page = new HtmlTemplate ("templates/" . $config['tpl_name'] . "/email_feedback.tpl");
        $page->SetParameter ('SITE_TITLE', $config['site_title']);
        $page->SetParameter ('NAME', $_POST['name']);
        $page->SetParameter ('EMAIL', $_POST['email']);
        $page->SetParameter ('PHONE', $_POST['phone']);
        $page->SetParameter ('SUBJECT', $_POST['subject']);
        $page->SetParameter ('MESSAGE', $_POST['message']);
        $email_body = $page->CreatePageReturn($lang,$config,$link);

        email($_POST['email'],$lang['CONTACT_SUBJECT_START'] . $_POST['subject'],$email_body,$config);
        email($config['admin_email'],$lang['CONTACT_SUBJECT_START'] . $_POST['subject'],$email_body,$config);

        message($lang['THANKS'],$lang['FEEDBACKTHANKS']);
    }
}


$page = new HtmlTemplate ('templates/' . $config['tpl_name'] . '/feedback.tpl');
$page->SetParameter ('OVERALL_HEADER', create_header($lang['FEEDBACK']));
$page->SetParameter ('OVERALL_FOOTER', create_footer());
$page->SetParameter('RECAPTCH_ERROR', $recaptcha_error);
$page->CreatePageEcho();
?>