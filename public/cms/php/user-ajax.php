<?php
require_once('../includes/config.php');
require_once('../includes/classes/class.template_engine.php');
require_once('../includes/classes/class.country.php');
require_once('../includes/functions/func.global.php');
require_once('../includes/functions/func.sqlquery.php');
require_once('../includes/functions/func.users.php');
require_once('../includes/lang/lang_'.$config['lang'].'.php');

// Check if SSL enabled
$ssl = isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] && $_SERVER["HTTPS"] != "off"
    ? true
    : false;
define("SSL_ENABLED", $ssl);

// Define SITEURL
$site_url = (SSL_ENABLED ? "https" : "http")
    . "://"
    . $_SERVER["SERVER_NAME"]
    . (dirname($_SERVER["SCRIPT_NAME"]) == DIRECTORY_SEPARATOR ? "" : "/")
    . trim(str_replace("\\", "/", dirname($_SERVER["SCRIPT_NAME"])), "/");

define("SITEURL", $site_url);
$config['site_url'] = dirname($site_url)."/";

if($config['mod_rewrite'] == 0)
    require_once('../includes/simple-url.php');
else
    require_once('../includes/seo-url.php');

$con = db_connect($config);
sec_session_start();
if (isset($_GET['action'])){
    if ($_GET['action'] == "deleteMyAd") { deleteMyAd($con,$config); }
    if ($_GET['action'] == "deleteResumitAd") { deleteResumitAd($con,$config); }

    if ($_GET['action'] == "openlocatoionPopup") { openlocatoionPopup($con,$config); }
    if ($_GET['action'] == "getlocHomemap") { getlocHomemap($con,$config); }
    if ($_GET['action'] == "searchCityFromCountry") {searchCityFromCountry($con,$config);}
}

if(isset($_POST['action'])){
    if ($_POST['action'] == "removeImage") { removeImage(); }
    if ($_POST['action'] == "hideItem") { hideItem($con,$config); }
    if ($_POST['action'] == "removeAdImg") { removeAdImg($con,$config); }
    if ($_POST['action'] == "setFavAd") {setFavAd($con,$config);}
    if ($_POST['action'] == "removeFavAd") {removeFavAd($con,$config);}
    if ($_POST['action'] == "getsubcatbyidList") { getsubcatbyidList($con,$config); }
    if ($_POST['action'] == "getsubcatbyid") {getsubcatbyid($con,$config);}
    if ($_POST['action'] == "getCustomFieldByCatID") {getCustomFieldByCatID($con,$config);}

    if ($_POST['action'] == "getStateByCountryID") {getStateByCountryID($con,$config);}
    if ($_POST['action'] == "getCityByStateID") {getCityByStateID($con,$config);}
    if ($_POST['action'] == "ModelGetStateByCountryID") {ModelGetStateByCountryID($con,$config);}
    if ($_POST['action'] == "ModelGetCityByStateID") {ModelGetCityByStateID($con,$config);}
    if ($_POST['action'] == "searchStateCountry") {searchStateCountry($con,$config);}
    if ($_POST['action'] == "searchCityStateCountry") {searchCityStateCountry($con,$config);}
    if ($_POST['action'] == "ajaxlogin") {ajaxlogin();}
    if ($_POST['action'] == "email_verify") {email_verify();}
}

function ajaxlogin(){
    global $config,$lang;
    $loggedin = userlogin($config,$_POST['username'], $_POST['password']);

    if(!is_array($loggedin))
    {
        echo $lang['USERNOTFOUND'];
    }
    elseif($loggedin['status'] == 2)
    {
        echo $lang['ACCOUNTBAN'];
    }
    else
    {
        $user_browser = $_SERVER['HTTP_USER_AGENT']; // Get the user-agent string of the user.
        $user_id = preg_replace("/[^0-9]+/", "", $loggedin['id']); // XSS protection as we might print this value
        $_SESSION['user']['id']  = $user_id;
        $username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $loggedin['username']); // XSS protection as we might print this value
        $_SESSION['user']['username'] = $username;
        $_SESSION['user']['login_string'] = hash('sha512', $loggedin['password'] . $user_browser);

        update_lastactive($config);

        echo "success";
    }
    die();

}

function removeImage(){
    global $config,$lang;
    if(isset($_POST['product_id'])){
        $sql = "SELECT screen_shot FROM " . $config['db']['pre'] . "product where id = '" .validate_input($_POST['product_id']) . "' limit 1";
        $result = mysqli_query(db_connect($config), $sql);
        $info = mysqli_fetch_assoc($result);
        $screen_shot = $info['screen_shot'];
        $screnshots = explode(',',$info['screen_shot']);
        if($key = array_search($_POST['imagename'],$screnshots) != -1){
            unset($screnshots[$key]);
            $screens = implode(',',$screnshots);
            $sql = "UPDATE " . $config['db']['pre'] . "product set screen_shot='".validate_input($screens)."' where id = '" .validate_input($_POST['product_id']) . "' limit 1";
            mysqli_query(db_connect($config), $sql);
        }
    }

}

function email_verify(){
    global $config,$lang,$link;

    if(checkloggedin($config))
    {
        $get_userdata = get_user_data($config,$_SESSION['user']['username']);
        $resendconfirm = $get_userdata['confirm'];
        $resendemail = $get_userdata['email'];

        $page = new HtmlTemplate ("../templates/" . $config['tpl_name'] ."/email_signup_confirm.tpl");
        $page->SetParameter ('ID', $resendconfirm);
        $page->SetParameter ('USER_ID', $_SESSION['user']['id']);
        $page->SetParameter ('USER_TYPE', "user");
        $page->SetParameter ('SITE_URL', $config['site_url']);
        $page->SetParameter ('EMAIL', $resendemail);
        $page->SetParameter ('SITE_TITLE', $config['site_title']);
        $email_body = $page->CreatePageReturn($lang,$config,$link);

        email($resendemail,$config['site_title'].' - '.$lang['EMAILCONFIRM'],$email_body,$config);

        echo '<a class="uiButton uiButtonLarge resend" style="box-sizing:content-box;"><span class="uiButtonText">'.$lang['SENT'].'</span></a>';
        die();

    }
    else
    {
        header("Location: ".$config['site_url']."login");
        exit;
    }

}

function getStateByCountryID($con,$config)
{
    $country_id = isset($_POST['id']) ? $_POST['id'] : 0;
    $selectid = isset($_POST['selectid']) ? $_POST['selectid'] : "";

    $query = "SELECT id,code,asciiname FROM `".$config['db']['pre']."subadmin1` WHERE code like '%".$country_id."%' ORDER BY asciiname";
    if ($result = $con->query($query)) {

        $list = '<option value="">Select State</option>';
        while ($row = mysqli_fetch_assoc($result)) {
            $name = $row['asciiname'];
            $state_id = $row['id'];
            $state_code = $row['code'];
            if($selectid == $state_code){
                $selected_text = "selected";
            }
            else{
                $selected_text = "";
            }
            $list .= '<option value="'.$state_code.'" '.$selected_text.'>'.$name.'</option>';
        }

        echo $list;
    }
}

function getCityByStateID($con,$config)
{

    $state_id = isset($_POST['id']) ? $_POST['id'] : 0;
    $selectid = isset($_POST['selectid']) ? $_POST['selectid'] : "";

    $query = "SELECT id ,asciiname FROM `".$config['db']['pre']."cities` WHERE subadmin1_code = " . substr($state_id,3);
    $result = mysqli_query($con,$query);
    $total = mysqli_num_rows($result);
    if ($result = $con->query($query)) {

        $list = '<option value="">Select City</option>';
        while ($row = mysqli_fetch_assoc($result)) {
            $name = $row['asciiname'];
            $id = $row['id'];
            if($selectid == $id){
                $selected_text = "selected";
            }
            else{
                $selected_text = "";
            }
            $list .= '<option value="'.$id.'" '.$selected_text.'>'.$name.'</option>';
        }
        echo $list;
    }
}

function ModelGetStateByCountryID($con,$config)
{
    $country_id = isset($_POST['id']) ? $_POST['id'] : 0;
    $countryName = get_countryName_by_id($config,$country_id);

    $query = "SELECT id,code,asciiname FROM `".$config['db']['pre']."subadmin1` WHERE code like '%".$country_id."%' ORDER BY asciiname";
    $result = mysqli_query($con,$query);
    $total = mysqli_num_rows($result);
    $list = '<ul class="column col-md-12 col-sm-12 cities">';
    $count = 1;
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $name = $row['asciiname'];
            $id = $row['code'];

            if($count == 1)
            {
                $list .=  '<li class="selected"><a class="selectme" data-id="'.$country_id.'" data-name="All '.$countryName.'" data-type="country"><strong>All '.$countryName.'</strong></a></li>';
            }
            $list .= '<li class=""><a id="region'.$id.'" class="statedata" data-id="'.$id.'" data-name="'.$name.'"><span>'.$name.' <i class="fa fa-angle-right"></i></span></a></li>';

            $count++;
        }
        echo $list."</ul>";
    }
}

function ModelGetCityByStateID($con,$config)
{
    $state_id = isset($_POST['id']) ? $_POST['id'] : 0;
    $stateName = get_stateName_by_id($config,$state_id);
    $state_code = substr($state_id,3);
    $country_code = substr($state_id,0,2);
    $query = "SELECT id ,asciiname FROM `".$config['db']['pre']."cities` WHERE subadmin1_code = '".substr($state_id,3)."' and country_code = '$country_code'" ;

    $result = mysqli_query($con,$query);
    if($result){
        $total = mysqli_num_rows($result);
        $total = mysqli_num_rows($result);
        $list = '<ul class="column col-md-12 col-sm-12 cities">';
        $count = 1;
        if ($total > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $name = $row['asciiname'];
                $id = $row['id'];
                if($count == 1)
                {
                    $list .=  '<li class="selected"><a id="changeState"><strong><i class="fa fa-arrow-left"></i> Change State</strong></a></li>';
                    $list .=  '<li class="selected"><a class="selectme" data-id="'.$state_id.'" data-name="'.$stateName.', State" data-type="state"><strong>Whole '.$stateName.'</strong></a></li>';
                }

                $list .= '<li class=""><a id="region'.$id.'" class="selectme" data-id="'.$id.'" data-name="'.$name.', City" data-type="city"><span>'.$name.' <i class="fa fa-angle-right"></i></span></a></li>';
                $count++;
            }

            echo $list."</ul>";
        }

    }else{
        echo '<ul class="column col-md-12 col-sm-12 cities">
            <li class="selected"><a id="changeState"><strong><i class="fa fa-arrow-left"></i> Change State</strong></a></li>
            <li><a> No city available</a></li>
            </ul>';
    }

}

function searchCityFromCountry($con,$config)
{

    $dataString = isset($_GET['q']) ? $_GET['q'] : "";
    $sortname = check_user_country($config);

    $perPage = 10;
    $page = isset($_GET['page']) ? $_GET['page'] : "1";
    $start = ($page-1)*$perPage;
    if($start < 0) $start = 0;

    $total = mysqli_num_rows(mysqli_query($con,"select 1 from `".$config['db']['pre']."cities` where asciiname like '$dataString%' and  country_code = '$sortname'"));

    $sql = "SELECT c.id, c.asciiname, c.latitude, c.longitude, c.subadmin1_code, s.asciiname AS statename
FROM `".$config['db']['pre']."cities` AS c
INNER JOIN `".$config['db']['pre']."subadmin1` AS s ON s.code = CONCAT(c.country_code,'.',c.subadmin1_code)
 WHERE c.asciiname like '$dataString%' and c.country_code = '$sortname'
 ORDER BY
  CASE
    WHEN c.asciiname = '$dataString' THEN 1
    WHEN c.asciiname LIKE '$dataString%' THEN 2
    ELSE 3
  END ";
    $query =  $sql . " limit " . $start . "," . $perPage;
    $query = $con->query($query);

    if(empty($_GET["rowcount"])) {
        $_GET["rowcount"] = $rowcount = mysqli_num_rows(mysqli_query($con, $sql));
    }

    $pages  = ceil($_GET["rowcount"]/$perPage);

    $items = '';
    $i = 0;
    $MyCity = array();

    while ($row = mysqli_fetch_array($query)) {
        $cityid = $row['id'];
        $cityname = $row['asciiname'];
        $latitude = $row['latitude'];
        $longitude = $row['longitude'];
        $statename = $row['statename'];

        $MyCity[$i]["id"]   = $cityid;
        $MyCity[$i]["text"] = $cityname.", ".$statename;
        $MyCity[$i]["latitude"]   = $latitude;
        $MyCity[$i]["longitude"]   = $longitude;
        $i++;
    }

    echo $json = '{"items" : '.json_encode($MyCity, JSON_UNESCAPED_SLASHES).',"totalEntries" : '.$total.'}';
    die();
}

function searchStateCountry($con,$config)
{
    $dataString = isset($_POST['dataString']) ? $_POST['dataString'] : "";
    $sortname = check_user_country($config);
    $query = "SELECT c.id, c.asciiname, c.subadmin1_code, s.asciiname AS statename
FROM `".$config['db']['pre']."cities` AS c
INNER JOIN `".$config['db']['pre']."subadmin1` AS s ON s.code = CONCAT(c.country_code,'.',c.subadmin1_code)
 WHERE c.asciiname like '%$dataString%' and c.country_code = '$sortname'
 ORDER BY
  CASE
    WHEN c.asciiname = '$dataString' THEN 1
    WHEN c.asciiname LIKE '$dataString%' THEN 2
    WHEN c.asciiname LIKE '%$dataString' THEN 4
    ELSE 3
  END
 LIMIT 20";

    $result = mysqli_query($con,$query);
    $total = mysqli_num_rows($result);
    $list = '<ul class="searchResgeo"><li><a href="#" class="title selectme" data-id="" data-name="" data-type="">Any City</span></a></li>';
    if ($total > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $cityid = $row['id'];
            $cityname = $row['asciiname'];
            $stateid = $row['subadmin1_code'];
            $statename = $row['statename'];

            $list .= '<li><a href="#" class="title selectme" data-id="'.$cityid.'" data-name="'.$cityname.'" data-type="city">'.$cityname.', <span class="color-9">'.$statename.'</span></a></li>';
        }
        $list .= '</ul>';
        echo $list;
    }
    else{
        echo '<ul class="searchResgeo"><li><span class="noresult">No results found</span></li>';
    }
}

function searchCityStateCountry($con,$config)
{
    $dataString = isset($_POST['dataString']) ? $_POST['dataString'] : "";
    $sortname = check_user_country($config);

    $query = "SELECT c.id, c.asciiname, c.subadmin1_code, s.asciiname AS statename
FROM `".$config['db']['pre']."cities` AS c
INNER JOIN `".$config['db']['pre']."subadmin1` AS s ON s.code = CONCAT(c.country_code,'.',c.subadmin1_code)
 WHERE c.asciiname like '%$dataString%' and c.country_code = '$sortname'
 ORDER BY
  CASE
    WHEN c.asciiname = '$dataString' THEN 1
    WHEN c.asciiname LIKE '$dataString%' THEN 2
    WHEN c.asciiname LIKE '%$dataString' THEN 4
    ELSE 3
  END
 LIMIT 20";

    $result = mysqli_query($con,$query);
    $total = mysqli_num_rows($result);
    $list = '<ul class="searchResgeo">';
    if ($total > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $cityid = $row['id'];
            $cityname = $row['asciiname'];
            $stateid = $sortname.".".$row['subadmin1_code'];
            $countryid = $sortname;
            $statename = $row['statename'];

            $list .= '<li><a href="#" class="title selectme" data-cityid="'.$cityid.'" data-stateid="'.$stateid.'"data-countryid="'.$countryid.'" data-name="'.$cityname.', '.$statename.'">'.$cityname.', <span class="color-9">'.$statename.'</span></a></li>';
        }
        $list .= '</ul>';
        echo $list;
    }
    else{
        echo '<ul class="searchResgeo"><li><span class="noresult">No results found</span></li>';
    }
}

function hideItem($con,$config)
{
    $id = $_POST['id'];
    if (trim($id) != '') {
        $query = "SELECT status FROM ".$config['db']['pre']."product WHERE id='" . $id . "' LIMIT 1";
        $query_result = mysqli_query($con, $query);
        $info = mysqli_fetch_assoc($query_result);
        $status = $info['status'];
        if($status != "pending"){
            if($status != "hide"){
                $con->query("UPDATE `".$config['db']['pre']."product` set status='hide' WHERE `id` = '".$id."' and `user_id` = '".$_SESSION['user']['id']."' ");
                echo 1;
            }else{
                $con->query("UPDATE `".$config['db']['pre']."product` set status='active' WHERE `id` = '".$id."' and `user_id` = '".$_SESSION['user']['id']."' ");
                echo 2;
            }
        }else{
            echo 0;
        }
        die();
    } else {
        echo 0;
        die();
    }

}

function removeAdImg($con,$config){
    $id = $_POST['id'];
    $img = $_POST['img'];


    $sql = "SELECT screen_shot FROM `".$config['db']['pre']."product` WHERE `id` = '" . $id . "' LIMIT 1";
    if ($result = $con->query($sql)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $screen = "";
            $uploaddir =  "storage/products/";
            $screen_sm = explode(',',$row['screen_shot']);
            $count = 0;
            foreach ($screen_sm as $value)
            {
                $value = trim($value);

                if($value == $img){
                    //Delete Image From Storage ----
                    $filename1 = $uploaddir.$value;
                    if(file_exists($filename1)){
                        $filename1 = $uploaddir.$value;
                        $filename2 = $uploaddir."small_".$value;
                        unlink($filename1);
                        unlink($filename2);
                    }
                }
                else{
                    if($count == 0){
                        $screen .= $value;
                    }else{
                        $screen .= ",".$value;
                    }
                    $count++;
                }
            }
        }
        $sql2 = "UPDATE `".$config['db']['pre']."product` set screen_shot='".$screen."' WHERE `id` = '" . $id . "' LIMIT 1";
        mysqli_query($con,$sql2);

        echo 1;
        die();
    }
    else{
        echo 0;
        die();
    }





}

function setFavAd($con,$config)
{
    $dupesql = "SELECT 1 FROM `".$config['db']['pre']."favads` where (user_id = '".$_POST['userId']."' and product_id = '".$_POST['id']."') limit 1";

    $duperaw = $con->query($dupesql);

    if (mysqli_num_rows($duperaw) == 0) {
        $sql = "INSERT INTO `".$config['db']['pre']."favads` set user_id = '".$_POST['userId']."', product_id = '".$_POST['id']."'";
        $result = $con->query($sql);
        if ($result)
            echo 1;
        else
            echo 0;
    }
    else{
        $sql = "DELETE FROM `".$config['db']['pre']."favads` WHERE `user_id` = '" . $_POST['userId'] . "' AND `product_id` ='" . $_POST['id'] . "'";
        $result = $con->query($sql);
        if ($result)
            echo 2;
        else
            echo 0;
    }
    die();
}

function removeFavAd($con,$config)
{
    $sql = "DELETE FROM `".$config['db']['pre']."favads` WHERE `user_id` = '" . $_POST['userId'] . "' AND `product_id` ='" . $_POST['id'] . "'";
    $result = $con->query($sql);
    if ($result)
        echo 1;
    else
        echo 0;

    die();
}

function deleteMyAd($con,$config)
{
    if(isset($_POST['id']))
    {
        $sql2 = "SELECT screen_shot FROM `".$config['db']['pre']."product` WHERE `id` = '" . $_POST['id'] . "' AND `user_id` = '" . $_SESSION['user']['id'] . "' LIMIT 1";

        if ($result = $con->query($sql2)) {
            $row = mysqli_fetch_assoc($result);

            $uploaddir =  "storage/products/";
            $screen_sm = explode(',',$row['screen_shot']);
            foreach ($screen_sm as $value)
            {
                $value = trim($value);
                //Delete Image From Storage ----
                $filename1 = $uploaddir.$value;
                if(file_exists($filename1)){
                    $filename1 = $uploaddir.$value;
                    $filename2 = $uploaddir."small_".$value;
                    unlink($filename1);
                    unlink($filename2);
                }
            }

            $sql = "DELETE FROM `".$config['db']['pre']."product` WHERE `id` = '" . $_POST['id'] . "' AND `user_id` = '" . $_SESSION['user']['id'] . "' LIMIT 1";
            mysqli_query($con,$sql);
        }

        echo 1;
        die();
    }else {
        echo 0;
        die();
    }

}

function deleteResumitAd($con,$config)
{
    if(isset($_POST['id']))
    {
        $sql = "SELECT screen_shot FROM `".$config['db']['pre']."product` WHERE `id` = '" . $_POST['id'] . "' AND `user_id` = '" . $_SESSION['user']['id'] . "' LIMIT 1";

        $sql2 = "SELECT screen_shot FROM `".$config['db']['pre']."product_resubmit` WHERE `id` = '" . $_POST['id'] . "' AND `user_id` = '" . $_SESSION['user']['id'] . "' LIMIT 1";


        if ($result = $con->query($sql)) {
            $row = mysqli_fetch_assoc($result);

            $result2 = $con->query($sql2);
            $row2 = mysqli_fetch_assoc($result2);

            $uploaddir =  "storage/products/";
            $screen_sm = explode(',',$row['screen_shot']);
            $re_screen = explode(',',$row2['screen_shot']);

            $arr = array_diff($re_screen,$screen_sm);

            foreach ($arr as $value)
            {
                $value = trim($value);

                //Delete Image From Storage ----
                $filename1 = $uploaddir.$value;
                if(file_exists($filename1)){
                    $filename1 = $uploaddir.$value;
                    $filename2 = $uploaddir."small_".$value;
                    unlink($filename1);
                    unlink($filename2);
                }
            }

            $sql = "DELETE FROM `".$config['db']['pre']."product_resubmit` WHERE `product_id` = '" . $_POST['id'] . "' AND `user_id` = '" . $_SESSION['user']['id'] . "' LIMIT 1";
            mysqli_query($con,$sql);
        }

        echo 1;
        die();
    }else {
        echo 0;
        die();
    }

}

function getsubcatbyid($con,$config)
{
    $id = isset($_POST['catid']) ? $_POST['catid'] : 0;
    $selectid = isset($_POST['selectid']) ? $_POST['selectid'] : "";

    $query = "SELECT * FROM `" . $config['db']['pre'] . "catagory_sub` WHERE main_cat_id = " . $id;
    if ($result = $con->query($query)) {

        while ($row = mysqli_fetch_assoc($result)) {
            $name = $row['sub_cat_name'];
            $sub_id = $row['sub_cat_id'];
            $photo_show = $row['photo_show'];
            $price_show = $row['price_show'];
            if($selectid == $sub_id){
                $selected_text = "selected";
            }
            else{
                $selected_text = "";
            }
            echo '<option value="'.$sub_id.'" data-photo-show="'.$photo_show.'" data-price-show="'.$price_show.'" '.$selected_text.'>'.$name.'</option>';
        }
    }else{
        echo 0;
    }
    die();
}

function getsubcatbyidList($con,$config)
{
    $id = isset($_POST['catid']) ? $_POST['catid'] : 0;
    $selectid = isset($_POST['selectid']) ? $_POST['selectid'] : "";

    $query = "SELECT * FROM `" . $config['db']['pre'] . "catagory_sub` WHERE main_cat_id = " . $id;
    if ($result = $con->query($query)) {

        while ($row = mysqli_fetch_assoc($result)) {
            $name = $row['sub_cat_name'];
            $sub_id = $row['sub_cat_id'];
            $photo_show = $row['photo_show'];
            $price_show = $row['price_show'];
            if($selectid == $sub_id){
                $selected_text = "link-active";
            }
            else{
                $selected_text = "";
            }

            if($config['lang_code'] != 'en'){
                $name = get_category_translation($config,"sub",$row['sub_cat_id']);
            }else{
                $name = $row['sub_cat_name'];
            }

            echo '<li data-ajax-subcatid="'.$sub_id.'" data-photo-show="'.$photo_show.'" data-price-show="'.$price_show.'" class="'.$selected_text.'"><a href="#">'.$name.'</a></li>';
        }

    }else{
        echo 0;
    }
    die();
}

function getCustomFieldByCatID($con,$config)
{
    global $lang;
    $maincatid = isset($_POST['catid']) ? $_POST['catid'] : 0;
    $subcatid = isset($_POST['subcatid']) ? $_POST['subcatid'] : 0;

    if ($maincatid > 0) {
        $custom_fields = get_customFields_by_catid($config,$con,$maincatid,$subcatid);
        $showCustomField = (count($custom_fields) > 0) ? 1 : 0;
    } else {
        die();
    }
    $tpl = '';
    if ($showCustomField) {
        foreach ($custom_fields as $row) {
            $id = $row['id'];
            $name = $row['title'];
            $type = $row['type'];
            $required = $row['required'];

            if($type == "text-field"){
                $lookFront = $row['textbox'];
                $tpl .= '<div class="row form-group">
                            <label class="col-sm-3 label-title">'.$name.' '.($required === "1" ? '<span class="required">*</span>' : "").'</label>
                            <div class="col-sm-9">
                                '.$lookFront.'
                            </div>
                        </div>';
            }
            elseif($type == "textarea"){
                $lookFront = $row['textarea'];
                $tpl .= '<div class="row form-group">
                                <label class="col-sm-3 label-title">'.$name.' '.($required === "1" ? '<span class="required">*</span>' : "").'</label>
                                <div class="col-sm-9">
                                    '.$lookFront.'
                                </div>
                            </div>';
            }
            elseif($type == "radio-buttons"){
                $lookFront = $row['radio'];
                $tpl .= '<div class="row form-group">
                                <label class="col-sm-3 label-title">'.$name.' '.($required === "1" ? '<span class="required">*</span>' : "").'</label>
                                <div class="col-sm-9">'.$lookFront.'</div>
                            </div>';
            }
            elseif($type == "checkboxes"){
                $lookFront = $row['checkboxBootstrap'];
                $tpl .= '<div class="row form-group">
                                <label class="col-sm-3 label-title">'.$name.' '.($required === "1" ? '<span class="required">*</span>' : "").'</label>
                                <div class="col-sm-9">'.$lookFront.'</div>
                            </div>';
            }
            elseif($type == "drop-down"){
                $lookFront = $row['selectbox'];
                $tpl .= '<div class="row form-group">
                                <label class="col-sm-3 label-title">'.$name.' '.($required === "1" ? '<span class="required">*</span>' : "").'</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="custom['.$id.']" '.$required.'>
                                        <option value="" selected>'.$lang['SELECT'].' '.$name.'</option>
                                        '.$lookFront.'
                                    </select>
                                </div>
                            </div>';
            }
        }
        echo $tpl;
        die();
    } else {
        echo 0;
        die();
    }
}

function getlocHomemap($con,$config)
{
    $appr = 'active';

    if(isset($_GET['serachStr'])){
        $serachStr = $_GET['serachStr'];
    }
    else{
        $serachStr = '';
    }
    /*if(isset($_GET['location'])){
        $location = $_GET['location'];
    }
    else{
        $location = '';
    }*/
    if(isset($_GET['country'])){
        $country = $_GET['country'];
    }
    else{
        $country = '';
    }
    if(isset($_GET['state'])){
        $state = $_GET['state'];
    }
    else{
        $state = '';
    }
    if(!empty($_GET['city'])){
        $city = $_GET['city'];
    }
    else{
        if(!empty($_GET['locality'])){
            $city = $_GET['locality'];
        }else{
            $city = '';
        }
    }
    if(isset($_GET['searchBox'])){
        $searchBox = $_GET['searchBox'];
    }
    else{
        $searchBox = '';
    }

    if(isset($_GET['catid'])){
        $catid = $_GET['catid'];
    }
    else{
        $catid = '';
    }


    $where = "";



    if ($city != '') {

        if ($serachStr != '') {
            $where .= "AND p.product_name LIKE '%$serachStr%'";
        }

        if ($searchBox != '') {
            $where .= " AND p.category = '$searchBox' ";
        }

        if ($catid != '') {
            $where .= " AND p.sub_category = '$catid' ";
        }

        $query = "SELECT p.*,c.name AS cityname, s.name AS statename, a.name AS countryname
        FROM `".$config['db']['pre']."countries` AS a
        INNER JOIN `".$config['db']['pre']."states` AS s ON s.country_id = a.id
        INNER JOIN `".$config['db']['pre']."cities` AS c ON c.state_id = s.id
        INNER JOIN `".$config['db']['pre']."product` AS p ON p.city = c.id Where c.name = '$city' and p.status = 'active' $where";
    }
    else{

        if ($serachStr != '') {
            $where .= "AND product_name LIKE '%$serachStr%'";
        }

        if ($searchBox != '') {
            $where .= " AND category = '$searchBox' ";
        }

        if ($catid != '') {
            $where .= " AND sub_category = '$catid' ";
        }

        $query = "SELECT * FROM `".$config['db']['pre']."product`  WHERE `status` = '$appr' $where ";
    }

    $query_result = mysqli_query ($con, $query);

    $data = array();
    $i = 0;
    if ($query_result->num_rows > 0) {

        while ($row = mysqli_fetch_array($query_result))
            $results[] = $row;

        foreach($results as $result){
            $id = $result['id'];
            $featured = $result['featured'];
            $urgent = $result['urgent'];
            $highlight = $result['highlight'];
            $title = $result['product_name'];
            $cat = $result['category'];
            $price = $result['price'];
            $pics = $result['screen_shot'];
            $location = $result['location'];
            $latlong = $result['latlong'];
            $desc = $result['description'];
            $url = $config['site_url'].$id;

            $caticonquery = "SELECT * FROM `".$config['db']['pre']."catagory_main`  WHERE `cat_id` = '$cat' LIMIT 1";
            $caticonres = mysqli_query ($con, $caticonquery);
            $fetch = mysqli_fetch_array($caticonres);
            $catIcon = $fetch['icon'];
            $catname = $fetch['cat_name'];

            $map = explode(',', $latlong);
            $lat = $map[0];
            $long = $map[1];

            $p = explode(',', $pics);
            $pic = $p[0];
            $pic = 'storage/products/'.$pic;

            $data[$i]['id'] = $id;
            $data[$i]['latitude'] = $lat;
            $data[$i]['longitude'] = $long;
            $data[$i]['featured'] = $featured;
            $data[$i]['title'] = $title;
            $data[$i]['location'] = $location;
            $data[$i]['category'] = $catname;
            $data[$i]['cat_icon'] = $catIcon;
            $data[$i]['marker_image'] = $pic;
            $data[$i]['url'] = $url;
            $data[$i]['description'] = $desc;


            $i++;
        }
        echo json_encode($data);
    } else {
        echo '0';
    }
    die();
}

function openlocatoionPopup($con,$config)
{
    /*$query = "SELECT a.*, b.name AS cat FROM `".$config['db']['pre']."product` AS a INNER JOIN `".$config['db']['pre']."category` AS b ON a.category = b.id WHERE a.id = '" . $_POST['id'] . "' LIMIT 1";*/
    $query = "SELECT * FROM `".$config['db']['pre']."product` WHERE id = '" . $_POST['id'] . "' LIMIT 1";
    $query_result = mysqli_query ($con, $query);
    $data = array();
    $i = 0;
    if ($query_result->num_rows > 0) {
        while ($result = mysqli_fetch_array($query_result)) {
            $id = $result['id'];
            $featured = $result['featured'];
            $urgent = $result['urgent'];
            $highlight = $result['highlight'];
            $title = $result['product_name'];
            $cat = $result['category'];
            $price = $result['price'];
            $pics = $result['screen_shot'];
            $location = $result['location'];
            $latlong = $result['latlong'];
            $desc = $result['description'];
            $url = $config['site_url']."ad/".$id;

            $caticonquery = "SELECT * FROM `".$config['db']['pre']."catagory_main`  WHERE `cat_id` = '$cat' LIMIT 1";
            $caticonres = mysqli_query ($con, $caticonquery);
            $fetch = mysqli_fetch_array($caticonres);
            $catIcon = $fetch['icon'];
            $catname = $fetch['cat_name'];

            $map = explode(',', $latlong);
            $lat = $map[0];
            $long = $map[1];

            $p = explode(',', $pics);
            $pic = $p[0];
            $pic = 'storage/products/'.$pic;


            echo '<div class="item gmapAdBox" data-id="' . $id . '" style="margin-bottom: 0px;">
                    <a href="' . $url . '" style="display: block;position: relative;">
                     <div class="card small">
                        <div class="card-image waves-effect waves-block waves-light">
                          <img class="activator" src="' . $pic . '">
                        </div>
                        <div class="card-content">
                            <div class="label label-default">' . $catname . '</div>
                          <span class="card-title activator grey-text text-darken-4 mapgmapAdBoxTitle">' . $title . '</span>
                          <p class="mapgmapAdBoxLocation">' . $location . '</p>
                        </div>
                      </div>

                    </a>
                </div>';

        }
    } else {
        echo false;
    }
    die();
}
?>