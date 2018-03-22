<?php
require_once('includes/config.php');
require_once('includes/classes/class.template_engine.php');
require_once('includes/classes/class.country.php');
require_once('includes/functions/func.global.php');
require_once('includes/lib/password.php');
require_once('includes/functions/func.users.php');
require_once('includes/functions/func.sqlquery.php');
require_once('includes/lang/lang_'.$config['lang'].'.php');
if($config['mod_rewrite'] == 0)
    require_once('includes/simple-url.php');
else
    require_once('includes/seo-url.php');
$mysqli = db_connect($config);
sec_session_start();


if(isset($_GET['confirm']))
{
    $check_confirm = 0;

    $check_confirm = mysqli_num_rows(mysqli_query($mysqli,"SELECT 1 FROM `".$config['db']['pre']."user` WHERE id='".mysqli_real_escape_string($mysqli,$_GET['user'])."' AND confirm='".mysqli_real_escape_string($mysqli,$_GET['confirm'])."' LIMIT 1"));

    if($check_confirm)
    {
        mysqli_query($mysqli,"UPDATE `".$config['db']['pre']."user` SET `status` = '1', `confirm` = '' WHERE id='".mysqli_real_escape_string($mysqli,$_GET['user'])."' AND confirm='".mysqli_real_escape_string($mysqli,$_GET['confirm'])."' LIMIT 1 ;");


        $user_info = get_user_data($config,null,$_GET['user']);
        $user_email = $user_info['email'];


        message($lang['SUCCESS'],$lang['THANKSIGNUP'], 'login');
    }
    else
    {
        message($lang['ERROR'],$lang['CONFUSED'],'',false);
    }

    exit;
}

if(checkloggedin($config))
{
    header("Location: ".$config['site_url']."dashboard");
    exit;
}
// Check if this is an Name availability check from signup page using ajax

if(isset($_POST["submit"])) {
    $errors = 0;
    $name_error = '';
    $username_error = '';
    $email_error = '';
    $password_error = '';
    $recaptcha_error = '';

    if(empty($_POST["name"])) {
        $errors++;
        $name_error = $lang['ENTER_FULL_NAME'];
        $name_error = "<span class='status-not-available'> ".$name_error."</span>";
    }
    elseif(preg_match('/[^A-Za-z\s]/',$_POST['name']))
    {
        $errors++;
        $name_error = $lang['ONLY_LETTER_SPACE'];
        $name_error = "<span class='status-not-available'> ".$name_error." [A-Z,a-z,0-9]</span>";
    }
    elseif( (strlen($_POST['name']) < 4) OR (strlen($_POST['name']) > 21) )
    {
        $errors++;
        $name_error = $lang['NAMELEN'];
        $name_error = "<span class='status-not-available'> ".$name_error.".</span>";
    }



    // Check if this is an Username availability check from signup page using ajax


    if(empty($_POST["username"]))
    {
        $errors++;
        $username_error = $lang['ENTERUNAME'];
        $username_error = "<span class='status-not-available'> ".$username_error."</span>";
    }
    elseif(preg_match('/[^A-Za-z0-9]/',$_POST['username']))
    {
        $errors++;
        $username_error = $lang['USERALPHA'];
        $username_error = "<span class='status-not-available'> ".$username_error." [A-Z,a-z,0-9]</span>";
    }
    elseif( (strlen($_POST['username']) < 4) OR (strlen($_POST['username']) > 16) )
    {
        $errors++;
        $username_error = $lang['USERLEN'];
        $username_error = "<span class='status-not-available'> ".$username_error.".</span>";
    }
    else{
        $user_count = check_username_exists($config,$_POST["username"]);
        if($user_count>0) {
            $errors++;
            $username_error = $lang['USERUNAV'];
            $username_error = "<span class='status-not-available'>".$username_error."</span>";
        }
        else {
            $username_error = $lang['USERUAV'];
            $username_error = "<span class='status-available'>".$username_error."</span>";
        }
    }


    // Check if this is an Email availability check from signup page using ajax

    $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';

    if(empty($_POST["email"]))
    {
        $errors++;
        $email_error = $lang['ENTEREMAIL'];
        $email_error = "<span class='status-not-available'> ".$email_error."</span>";
    }
    elseif(!preg_match($regex, $_POST['email']))
    {
        $errors++;
        $email_error = $lang['EMAILINV'];
        $email_error = "<span class='status-not-available'> ".$email_error.".</span>";
    }
    else{
        $user_count = check_account_exists($config,$_POST["email"]);
        if($user_count>0) {
            $errors++;
            $email_error = $lang['ACCAEXIST'];
            $email_error = "<span class='status-not-available'>".$email_error."</span>";
        }
    }


    // Check if this is an Password availability check from signup page using ajax


    if(empty($_POST["password"]))
    {
        $errors++;
        $password_error = $lang['ENTERPASS'];
        $password_error = "<span class='status-not-available'> ".$password_error."</span>";
    }
    elseif( (strlen($_POST['password']) < 4) OR (strlen($_POST['password']) > 21) )
    {
        $errors++;
        $password_error = $lang['PASSLENG'];
        $password_error = "<span class='status-not-available'> ".$password_error.".</span>";
    }
    if($config['recaptcha_mode'] == 1) {
        if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
            //your site secret key
            //$secret = '6Lci1yMTAAAAAFjUEeYUBIXvOxsYDXkqL45dtoch';
            $secret = $config['recaptcha_private_key'];
            //get verify response data
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
            $responseData = json_decode($verifyResponse);
            if (!$responseData->success) {
                $errors++;
                $recaptcha_error = $lang['RECAPTCHA_ERROR'];
                $recaptcha_error = "<span class='status-not-available'> " . $recaptcha_error . ".</span>";
            }
        } else {
            $errors++;
            $recaptcha_error = $lang['RECAPTCHA_CLICK'];
            $recaptcha_error = "<span class='status-not-available'> " . $recaptcha_error . ".</span>";
        }
    }

    if($errors == 0) {

        $confirm_id = get_random_id();
        $location = getLocationInfoByIp();
        $password = $_POST["password"];
        $pass_hash = password_hash($password, PASSWORD_DEFAULT, ['cost' => 13]);

        $query = "INSERT into `".$config['db']['pre']."user` set
        name='" . $_POST["name"] . "',
        username='" . $_POST["username"] . "',
        password_hash='" . $pass_hash . "',
        email='" . $_POST["email"] . "',
        confirm='" . $confirm_id . "',
        created_at= '".date("Y-m-d H:i:s")."' ,
        updated_at= '".date("Y-m-d H:i:s")."' ,
        country = '".$location['country']."',
        city = '".$location['city']."'";

        $mysqli->query($query) OR error(mysqli_error($mysqli));

        $user_id = $mysqli->insert_id;

        $page = new HtmlTemplate ("templates/" . $config['tpl_name'] . "/email_signup_confirm.tpl");
        $page->SetParameter ('ID', $confirm_id);
        $page->SetParameter ('USER_ID', $user_id);
        $page->SetParameter ('USER_TYPE', "New User");
        $page->SetParameter ('SITE_URL', $config['site_url']);
        $page->SetParameter ('EMAIL', $_POST['email']);
        $page->SetParameter ('SITE_TITLE', $config['site_title']);
        $email_body = $page->CreatePageReturn($lang,$config,$link);

        email($_POST['email'],$config['site_title'].' - '.$lang['EMAILCONFIRM'],$email_body,$config);

        $loggedin = userlogin($config,$_POST['username'], $_POST['password']);

        create_user_session($loggedin['id'],$loggedin['username'],$loggedin['password']);

        message($lang['WELCOME'],$lang['WELCOMETOSITE'],'dashboard',false);
        exit;
    }
}



// Output to template



$page = new HtmlTemplate ("templates/" . $config['tpl_name'] . "/signup.tpl");
$page->SetParameter ('OVERALL_HEADER', create_header($lang['CREATE-AN-ACCOUNT']));

if(isset($_POST['submit']))
{
    $page->SetParameter ('NAME_FIELD', $_POST['name']);
    $page->SetParameter ('USERNAME_FIELD', $_POST['username']);
    $page->SetParameter ('EMAIL_FIELD', $_POST['email']);

    $page->SetParameter ('NAME_ERROR', $name_error);
    $page->SetParameter ('USERNAME_ERROR', $username_error);
    $page->SetParameter ('EMAIL_ERROR', $email_error);
    $page->SetParameter ('PASSWORD_ERROR', $password_error);
    $page->SetParameter ('RECAPTCH_ERROR', $recaptcha_error);
}
else
{
    $page->SetParameter ('NAME_FIELD', '');
    $page->SetParameter ('USERNAME_FIELD', '');
    $page->SetParameter ('EMAIL_FIELD', '');

    $page->SetParameter ('NAME_ERROR', '');
    $page->SetParameter ('USERNAME_ERROR', '');
    $page->SetParameter ('EMAIL_ERROR', '');
    $page->SetParameter ('PASSWORD_ERROR', '');
    $page->SetParameter ('RECAPTCH_ERROR', '');
}
$page->SetParameter ('OVERALL_FOOTER', create_footer());
$page->CreatePageEcho();
?>