<?php
require_once('../includes/config.php');
require_once('../includes/functions/func.admin.php');
require_once('../includes/functions/func.sqlquery.php');
require_once('../includes/functions/func.users.php');
require_once('../includes/lang/lang_'.$config['lang'].'.php');
$mysqli = db_connect($config);
admin_session_start();
checkloggedadmin($config);

include("header.php");


if(isset($_GET['resubmit'])) {
    $query = "SELECT * FROM ".$config['db']['pre']."product_resubmit WHERE product_id='".$_GET['id']."' LIMIT 1";
}else{
    $query = "SELECT * FROM ".$config['db']['pre']."product WHERE id='".$_GET['id']."' LIMIT 1";
}

$result = mysqli_query($mysqli, $query);

$item_custom = array();
$item_checkbox = array();

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    //update_itemview($_GET['id'],$config);

    $info = mysqli_fetch_assoc($result);

    if(isset($_GET['resubmit'])) {
        $item_id = $info['product_id'];

    }
    else{
        $item_id = $info['id'];

    }

    $item_title = $info['product_name'];
    $item_description = $info['description'];
    $item_catid = $info['category'];
    $item_featured = $info['featured'];
    $item_urgent = $info['urgent'];
    $item_highlight = $info['highlight'];
    $item_price = $info['price'];
    $item_tag = $info['tag'];
    $item_location = $info['location'];
    $item_city = $info['city'];
    $item_state = $info['state'];
    $item_country = $info['country'];
    $item_status = $info['status'];
    $item_view = $info['view'];
    $item_created_at = timeAgo($info['created_at']);
    $item_updated_at = date('d M Y', $info['updated_at']);

    $get_main = get_maincat_by_id($config,$info['category']);
    $get_sub = get_subcat_by_id($config,$info['sub_category']);
    $item_category = $get_main['cat_name'];
    $item_sub_category = $get_sub['sub_cat_name'];

    $status = '';
    if ($item_status == "active"){
        $status = '<span class="label label-success">Approved</span>';
    }
    elseif($item_status == "pending")
    {
        $status = '<span class="label label-warning">Pending</span>';
    }
    elseif($item_status == "hide")
    {
        $status = '<span class="label label-info">Hidden</span>';
    }

    if(isset($_GET['resubmit'])) {
        $status = '<span class="label label-warning">Re-Submitted</span>';
    }

    if($info['negotiable'] == '0'){
        $item_negotiable = "No";
    }else{
        $item_negotiable = "Yes";
    }

    $item_phone = $info['phone'];
    $item_hide_phone = $info['hide_phone'];

    if($item_phone != "" && $item_hide_phone == '0'){
        $item_hide_phone = "No";
    }else{
        $item_hide_phone = "Yes";
    }


    if($config['mod_rewrite'] == 0)
        $item_catlink = $config['site_url'].'listing?cat='.$info['category'];
    else{
        $item_catlink = $config['site_url'].'category/'.$info['category'].'/'.create_slug($item_category);
    }

    if($config['mod_rewrite'] == 0)
        $item_subcatlink = $config['site_url'].'listing?subcat='.$info['category'];
    else{
        $item_subcatlink = $config['site_url'].'sub-category/'.$info['category'].'/'.create_slug($item_sub_category);
    }

    $latlong = $info['latlong'];
    $map = explode(',', $latlong);
    $lat = $map[0];
    $long = $map[1];

    $item_author_id = $info['user_id'];
    $info2 = get_user_data($config,null,$item_author_id);

    $item_author_username = ucfirst($info2['username']);
    $item_author_email = $info2['email'];
    $item_author_image = $info2['image'];
    $item_author_country = $info2['country'];
    $item_author_joined = $info2['created_at'];

    $author_url = create_slug($info2['username']);
    if($config['mod_rewrite'] == 0)
    {
        $item_author_link = $config['site_url'].'profile?username='.$author_url;
    }
    else
    {
        $item_author_link = $config['site_url'].'profile/'.$author_url;
    }

    $pro_url = create_slug($info['product_name']);
    if($config['mod_rewrite'] == 0)
    {
        $item_link = $config['site_url'].'ad-detail?id=' . $info['id'] . '/'.$pro_url;
    }
    else
    {
        $item_link = $config['site_url'].'/ad/' . $info['id'] . '/'.$pro_url;
    }


    $tag = explode(',', $info['tag']);
    $tag2 = array();
    foreach ($tag as $val)
    {
        //REMOVE SPACE FROM $VALUE ----
        $val = trim($val);
        $tag2[] = '<a href="'.$config['site_url'].'listing?keywords='.$val.'" class="bylabel bylabelmini" target="_blank">'.$val.'</a>';
    }
    $item_tag = implode('  ', $tag2);

    //For Classic Theme
    if($info['screen_shot'] != "") {
        $show_image_slider = 1;
        $i = 0;
        $screen_classicb = explode(',', $info['screen_shot']);
        foreach ($screen_classicb as $value) {
            //REMOVE SPACE FROM $VALUE ----
            $value = trim($value);
            $active = ($i == 0) ? "active" : "";
            $screen_classicb2[] = '<div class="item ' . $active . '"><div class="carousel-image"><img src="' . $config['site_url'] . 'storage/products/' . $value . '" alt="' . $item_title . '" class="img-responsive"></div></div>';
            $i++;
        }
        $screen_classicb = implode('', $screen_classicb2);

        $i = 0;
        $screen_classicsm = explode(',', $info['screen_shot']);
        foreach ($screen_classicsm as $value) {
            //REMOVE SPACE FROM $VALUE ----
            $value = trim($value);
            $screen_classicsm2[] = '<li data-target="#product-carousel" data-slide-to="' . $i . '" class="active"><img src="' . $config['site_url'] . 'storage/products/thumb/' . $value . '" alt="' . $item_title . '" class="img-responsive"></li>';
            $i++;
        }
        $screen_classicsm = implode('  ', $screen_classicsm2);
    }else{
        $show_image_slider = 0;
        $screen_sm = "";
        $screen_big = "";
        $screen_classicb = "";
        $screen_classicsm = "";
    }

}
else {
    header('Location: 404.php');
    exit();
}




?>

<link href="assets/css/user-html.css" rel="stylesheet">
<main class="app-layout-content">

    <!-- Page Content -->
    <div class="container-fluid p-y-md">
        <!-- Partial Table -->
        <div class="card">
            <div class="card-header">
                <h4><?php echo $item_title; ?>
                    <span class="label-wrap hidden-sm hidden-xs">
                                    <?php
                                    if($item_featured == "1")
                                        echo '<span class="label featured"> Featured</span>';
                                    if($item_urgent == "1")
                                        echo '<span class="label urgent"> Urgent</span>';
                                    if($item_highlight == "1")
                                        echo '<span class="label highlight"> Highlight</span>';
                                    ?>
                                </span></h4>
            </div>
            <div class="card-block">

                <section class="content">
                    <div class="row">
                        <div class="col-sm-8" style="border: 0px solid #000;">
                            <?php
                            if($show_image_slider == 1) {
                                ?>
                                <div class="item-box">
                                    <div id="product-carousel" class="carousel slide" data-ride="carousel">
                                        <!-- Indicators -->
                                        <ol class="carousel-indicators">
                                            <?php echo $screen_classicsm; ?>
                                        </ol>
                                        <!-- Wrapper for slides -->
                                        <?php
                                        if($info['price'] != '0'){
                                            $currency_info = set_user_currency($config,$info['country']);
                                            $config['currency_code'] = $currency_info['code'];
                                            $config['currency_sign'] = $currency_info['html_entity'];
                                            $config['currency_pos'] = $currency_info['in_left'];

                                            if($currency_info['in_left'] == 1){
                                                $price = $info['price']." ".$currency_info['html_entity'];
                                            }else{
                                                $price = $currency_info['html_entity']." ".$info['price'];
                                            }
                                        }else{
                                            $price = 0;
                                        }

                                        ?>
                                        <div class="ribbon ribbon-clip ribbon-reverse">
                                            <span class="ribbon-inner"><?php echo $price; ?></span>
                                        </div>
                                        <div class="carousel-inner" role="listbox">
                                            <?php echo $screen_classicb; ?>
                                        </div><!-- carousel-inner -->
                                        <!-- Controls -->
                                        <a class="left carousel-control" href="#product-carousel" role="button"
                                           data-slide="prev">
                                            <i class="fa fa-chevron-left"></i>
                                        </a>
                                        <a class="right carousel-control" href="#product-carousel" role="button"
                                           data-slide="next">
                                            <i class="fa fa-chevron-right"></i>
                                        </a><!-- Controls -->
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                            <div class="item-box" style="margin-top: 20px">
                                <ul class="nav nav-tabs dark">
                                    <li class="active">
                                        <a data-toggle="tab" href="#4" aria-expanded="true">Item Details</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div id="4" class="tab-pane active fade in">
                                        <div>

                                            <?php
                                            $item_custom = array();
                                            $item_custom_textarea = array();
                                            $item_checkbox = array();
                                            $query = "SELECT * FROM `".$config['db']['pre']."custom_data` where product_id = '".$item_id."'";
                                            $query_result = mysqli_query($mysqli, $query);
                                            while($customdata = mysqli_fetch_array($query_result)){
                                                $field_id = $customdata['field_id'];
                                                $field_type = $customdata['field_type'];
                                                $field_data = $customdata['field_data'];

                                                $custom_fields_title = get_customField_title_by_id($config,$field_id);

                                                if($field_type == 'checkboxes'){

                                                    $checkbox_value = explode(',', $field_data);
                                                    $checkbox_value2 = array();
                                                    foreach ($checkbox_value as $val)
                                                    {
                                                        $val = get_customOption_by_id(trim($val));
                                                        $checkbox_value2[] = '<div class="col-md-4 col-sm-4"><div style="line-height: 30px;"><i class="fa fa-check"></i> '.$val.'</div></div>';
                                                    }
                                                    if($custom_fields_title != ""){
                                                        $item_checkbox[$field_id]['title'] = $custom_fields_title;
                                                        $item_checkbox[$field_id]['value'] = implode('  ', $checkbox_value2);
                                                    }

                                                }
                                                elseif($field_type == 'textarea') {
                                                    $item_custom_textarea[$field_id]['title'] = $custom_fields_title;
                                                    $item_custom_textarea[$field_id]['value'] = stripslashes($field_data);
                                                }
                                                else{
                                                    if($field_type == 'radio-buttons' or  $field_type == 'drop-down') {
                                                        $custom_fields_data = get_customOption_by_id($field_data);
                                                    }else{
                                                        $custom_fields_data = stripslashes($field_data);
                                                    }
                                                    $item_custom[$field_id]['title'] = $custom_fields_title;
                                                    $item_custom[$field_id]['value'] = $custom_fields_data;
                                                }
                                            }

                                            ?>
                                            <div class="quick-info">
                                                <div class="detail-title">
                                                    <h2 class="title-left">Additional Details</h2>
                                                </div>
                                                <ul class="clearfix">
                                                    <?php
                                                    foreach($item_custom as $value)
                                                    {
                                                        echo '<li>
                                                                    <div class="inner clearfix">
                                                                        <span class="label">'.$value['title'].'</span>
                                                                        <span class="desc">'.$value['value'].'</span>
                                                                    </div>
                                                                </li>';
                                                    }
                                                    ?>
                                                </ul>
                                            </div>
                                            <?php
                                            foreach($item_custom_textarea as $value)
                                            {
                                                echo '<div class="text-widget">
                                                                <div class="detail-title">
                                                                    <h2 class="title-left">'.$value['title'].'</h2>
                                                                </div>
                                                                <div class="inner row">
                                                                    <div class="user-html">'.$value['value'].'</div>
                                                                </div>
                                                            </div>';
                                            }

                                            foreach($item_checkbox as $value)
                                            {
                                                echo '<div class="text-widget">
                                                                <div class="detail-title">
                                                                    <h2 class="title-left">'.$value['title'].'</h2>
                                                                </div>
                                                                <div class="inner row">
                                                                    '.$value['value'].'
                                                                </div>
                                                            </div>';
                                            }
                                            ?>
                                            <div class="description">
                                                <div class="detail-title">
                                                    <h2 class="title-left">Description</h2>
                                                </div>
                                                <div class="user-html"><?php echo $item_description;?></div>

                                            </div>

                                        </div>
                                    </div>
                                    <!--<div id="5" class="tab-pane fade">
                                        <p>0</p>
                                    </div>
                                    <div id="6" class="tab-pane fade">
                                        <p></p>
                                    </div>-->
                                </div>

                            </div>
                        </div><!-- end col -->
                        <div class="col-sm-4" style="border: 0px solid #000;">
                            <div class="pad-bot-20" id="js-delete-single">
                                <div class="item-box fbold">
                                    <div class="pad-20 item-sale text-center ajax-item-listing" data-item-id="<?php echo $item_id ?>">

                                        <?php
                                        if(isset($_GET['resubmit'])) {

                                            echo '<button class="btn btn-success btn-rounded waves-effect waves-light m-r-5 btn-sm item-js-action" type="button" data-ajax-action="approveResubmitItem" data-ajax-type="approve"><span class="btn-label"><i class="ti-check"></i></span>Approve</button>';

                                            echo '<button class="btn btn-danger btn-rounded waves-effect waves-light btn-sm  m-r-5 item-js-action" type="button" data-ajax-action="deleteResubmitItem" data-ajax-type="reject"><span class="btn-label"><i class="ti-trash"></i></span>Reject</button>';

                                        }
                                        else{
                                            if ($item_status == "pending") {
                                                echo '<button class="btn btn-success btn-rounded waves-effect waves-light m-r-5 btn-sm item-js-action" type="button" data-ajax-action="approveitem" data-ajax-type="approve"><span class="btn-label"><i class="ti-check"></i></span>Approve</button>';
                                            }

                                            echo '<button class="btn btn-danger btn-rounded waves-effect waves-light  m-r-5 btn-sm item-js-action" type="button" data-ajax-action="deleteads" data-ajax-type="delete"><span class="btn-label"><i class="ti-trash"></i></span>Delete</button>';


                                        }

                                        echo '<a class="btn btn-info btn-rounded waves-effect waves-light btn-sm mar-10" href="#" data-url="panel/post_edit.php?id='.$item_id.'" data-toggle="slidePanel"><span class="btn-label"><i class="ti-pencil"></i></span>edit</a>';
                                        ?>





                                    </div>
                                </div>
                            </div>
                            <?php
                            if(isset($_GET['resubmit'])) {
                                ?>
                                <div class="item-box">
                                    <div class="item-price">
                                        <div class="fbold">Message to reviewer</div>

                                        <p style="padding-top: 10px"><?php echo $info['comments'] ?></p>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                            <div class="pad-top-20 pad-bot-20">
                                <div class="item-box">
                                    <div class="pad-20">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="profile-picture medium-profile-picture mpp XxGreen">
                                                    <a href="<?php echo $item_author_link ?>" target="_blank">

                                                        <img width="70px" style="min-height:70px" alt="<?php echo $item_author_username ?>" src="<?php echo $config['site_url'] ?>storage/profile/<?php echo $item_author_image ?>"></a>
                                                </div>
                                            </div>
                                            <div class="col-sm-9">
                                                <div>
                                                    <div class="align-left fbold">
                                                        <a href="<?php echo $item_author_link ?>" style="text-decoration:none" target="_blank"><?php echo $item_author_username ?></a>
                                                    </div>
                                                    <div class="align-left font13 pad-3"><?php echo $item_author_country ?> <span class="flags flag-br"></span></div>
                                                    <div class="align-left"><a href="<?php echo $item_author_link ?>" class="bylabel bylabelLarge" target="_blank">View Profile</a></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item-box meta-attributes">
                                <div class="pad-20">
                                    <table class="meta-attributes__table align-left" cellspacing="0" cellpadding="10" border="0">
                                        <tbody>
                                        <tr>
                                            <td class="meta-attributes__attr-name">Ad ID</td>
                                            <td class="meta-attributes__attr-detail"><?php echo $item_id ?></td>
                                        </tr>
                                        <tr>
                                            <td class="meta-attributes__attr-name">Views</td>
                                            <td class="meta-attributes__attr-detail"><?php echo $item_view ?></td>
                                        </tr>
                                        <tr>
                                            <td class="meta-attributes__attr-name">Status</td>
                                            <td class="meta-attributes__attr-detail"><?php echo $status ?></td>
                                        </tr>
                                        <tr>
                                            <td class="meta-attributes__attr-name">Posted</td>
                                            <td class="meta-attributes__attr-detail">
                                                <time itemprop="dateCreated" datetime="<?php echo $item_created_at ?>">
                                                    <?php echo $item_created_at ?>
                                                </time>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="meta-attributes__attr-name">Category</td>
                                            <td class="meta-attributes__attr-detail">
                                                <a class="bylabel bylabelmini" href="<?php echo $item_catlink ?>" target="_blank"><?php echo $item_category ?></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="meta-attributes__attr-name">SubCategory</td>
                                            <td class="meta-attributes__attr-detail">
                                                <a class="bylabel bylabelmini" href="#"><?php echo $item_sub_category ?></a></td>
                                        </tr>
                                        <tr>
                                            <td class="meta-attributes__attr-name">Location</td>
                                            <td class="meta-attributes__attr-detail"><?php echo $item_location ?></td>
                                        </tr>
                                        <tr>
                                            <td class="meta-attributes__attr-name">City</td>
                                            <td class="meta-attributes__attr-detail"><?php echo get_cityName_by_id($config,$item_city); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="meta-attributes__attr-name">State</td>
                                            <td class="meta-attributes__attr-detail"><?php echo get_stateName_by_id($config,$item_state); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="meta-attributes__attr-name">Country</td>
                                            <td class="meta-attributes__attr-detail"><?php echo get_countryName_by_id($config,$item_country); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="meta-attributes__attr-name">Phone</td>
                                            <td class="meta-attributes__attr-detail"><?php echo $item_phone ?></td>
                                        </tr>
                                        <tr>
                                            <td class="meta-attributes__attr-name">Hide Phone</td>
                                            <td class="meta-attributes__attr-detail"><?php echo $item_hide_phone; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="meta-attributes__attr-name">Price Negotiated</td>
                                            <td class="meta-attributes__attr-detail"><?php echo $item_negotiable; ?></td>
                                        </tr>

                                        <tr>
                                            <td class="meta-attributes__attr-name">Tags</td>
                                            <td>
                                                    <span class="meta-attributes__attr-tags">
                                                        <?php echo $item_tag; ?>
                                                    </span>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div><!-- end col -->
                    </div><!-- end row -->
                </section>

            </div>
            <!-- .card-block -->
        </div>
        <!-- .card -->
        <!-- End Partial Table -->

    </div>
    <!-- .container-fluid -->
    <!-- End Page Content -->

</main>



<?php include("footer.php"); ?>
<script src="js/admin-ajax.js"></script>
<script src="js/alert.js"></script>

</body>

</html>

