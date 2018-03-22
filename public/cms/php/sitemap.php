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
$maincat = array();
$var = 0;
$query = "SELECT * FROM ".$config['db']['pre']."catagory_main ORDER by cat_order ASC";
$query_result = mysqli_query($mysqli,$query);
while ($info1 = mysqli_fetch_array($query_result))
{
    if($config['lang_code'] != 'en'){
        $info1['cat_name'] = get_category_translation($config,"main",$info1['cat_id']);
    }
    $maincat[$info1['cat_id']]['icon'] = $info1['icon'];
    $maincat[$info1['cat_id']]['main_title'] = $info1['cat_name'];
    $maincat[$info1['cat_id']]['main_id'] = $info1['cat_id'];
    $var++;
}

$subcat = array();
$query = "SELECT * FROM ".$config['db']['pre']."catagory_main ORDER by cat_order ASC";
$query_result = mysqli_query($mysqli,$query);
while ($info = mysqli_fetch_array($query_result))
{
    if($config['lang_code'] != 'en'){
        $info['cat_name'] = get_category_translation($config,"main",$info['cat_id']);
    }
    $subcat[$info['cat_id']]['icon'] = $info['icon'];
    $subcat[$info['cat_id']]['main_title'] = $info['cat_name'];
    $subcat[$info['cat_id']]['main_id'] = $info['cat_id'];
    $cat_url = create_slug($info['cat_name']);
    $subcat[$info['cat_id']]['catlink'] = $config['site_url'].'category/'.$info['cat_id'].'/'.$cat_url;

    $totalAdsMaincat = get_items_count($config,false,"active",false,null,$info['cat_id'],true);
    $subcat[$info['cat_id']]['main_ads_count'] = $totalAdsMaincat;
    $count = 1;
    $query1 = "SELECT * FROM ".$config['db']['pre']."catagory_sub WHERE `main_cat_id` = '".$info['cat_id']."' ORDER by cat_order ASC";
    $query_result1 = mysqli_query($mysqli,$query1);
    while ($info1 = mysqli_fetch_array($query_result1))
    {
        if($config['lang_code'] != 'en'){
            $info1['sub_cat_name'] = get_category_translation($config,"sub",$info1['sub_cat_id']);
        }

        $totalads = get_items_count($config,false,"active",false,$info1['sub_cat_id'],null,true);
        $subcat_url = create_slug($info1['sub_cat_name']);
        $subcat_tpl = '<li><a href="sub-category/'.$info1['sub_cat_id'].'/'.$subcat_url.'">'.$info1['sub_cat_name'].' ('.$totalads.')</a></li>';

        if($count == 1)
            $subcat[$info['cat_id']]['sub_title'] = $subcat_tpl;
        else
            $subcat[$info['cat_id']]['sub_title'] .= $subcat_tpl;

        $count++;
    }
}

$page = new HtmlTemplate ('templates/'.$config['tpl_name'].'/sitemap.tpl');
$page->SetParameter ('OVERALL_HEADER', create_header($lang['SITEMAP']));
$page->SetLoop ('CAT',$maincat);
$page->SetLoop ('SUBCAT',$subcat);
$page->SetParameter ('OVERALL_FOOTER', create_footer());
$page->CreatePageEcho();
?>