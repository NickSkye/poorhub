<?php
require_once('../includes/config.php');
require_once('../includes/functions/func.admin.php');
require_once('../includes/functions/func.sqlquery.php');
require_once('../includes/lang/lang_'.$config['lang'].'.php');
$mysqli = db_connect($config);
admin_session_start();
checkloggedadmin($config);

include("header.php");
?>

<main class="app-layout-content">

    <!-- Page Content -->
    <div class="container-fluid p-y-md">
        <!-- Partial Table -->
        <div class="card">
            <div class="card-header">
                <h4>Site setting</h4>
            </div>
            <div class="card-block">
                <!-- /row -->
                <div class="row">
                    <div class="col-sm-12">


                        <div id="quickad-tbs" class="wrap">
                            <div class="quickad-tbs-body">

                                <div class="row">
                                    <div id="quickad-sidebar" class="col-sm-4">
                                        <ul class="quickad-nav" role="tablist">
                                            <li class="quickad-nav-item active" data-target="#quickad_settings_general" data-toggle="tab">General</li>
                                            <li class="quickad-nav-item" data-target="#quickad_logo_watermark" data-toggle="tab">Logo / Watermark</li>
                                            <li class="quickad-nav-item" data-target="#quickad_international" data-toggle="tab">International</li>
                                            <li class="quickad-nav-item" data-target="#quickad_email" data-toggle="tab">Email Setting</li>

                                            <li class="quickad-nav-item" data-target="#quickad_theme_setting" data-toggle="tab">Theme Setting</li>
                                            <li class="quickad-nav-item" data-target="#quickad_frontend_submission" data-toggle="tab">Frontend Submission Form</li>
                                            <li class="quickad-nav-item" data-target="#quickad_social_login_setting" data-toggle="tab">Social Login Setting</li>
                                            <li class="quickad-nav-item" data-target="#quickad_recaptcha" data-toggle="tab">Google reCAPTCHA</li>
                                            <li class="quickad-nav-item" data-target="#quickad_purchase_code" data-toggle="tab">Purchase Code</li>
                                        </ul>
                                    </div>

                                    <div id="quickad_settings_controls" class="col-sm-8">
                                        <div class="panel panel-default quickad-main">
                                            <div class="panel-body">
                                                <div class="tab-content">

                                                    <div class="tab-pane active" id="quickad_settings_general">
                                                        <form method="post" action="ajax_sidepanel.php?action=SaveSettings" id="#quickad_settings_general">
                                                            <div class="form-group">
                                                                <label for="site_title">Site Title </label>
                                                                <p class="help-block">The site title is what you would like your website to be known as, this will be used in emails and in the title of your webpages.</p>
                                                                <div>
                                                                    <input name="site_title" class="form-control" type="Text" id="site_title" value="<?php echo get_option( $config, "site_title"); ?>">
                                                                </div>
                                                            </div>



                                                            <div class="form-group">
                                                                <label for="home_page">Home Page</label>
                                                                <select name="home_page" id="home_page" class="form-control">
                                                                    <option value="home-image" <?php if(get_option( $config, "home_page") == 'home-image'){ echo 'selected'; } ?>>Home with Image</option>
                                                                    <option value="home-map" <?php if(get_option( $config, "home_page") == 'home-map'){ echo 'selected'; } ?>>Home with Map</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="gmap_api_key">Google Map API Key</label>
                                                                <input name="gmap_api_key" class="form-control" type="Text" id="gmap_api_key" value="<?php echo get_option( $config, "gmap_api_key"); ?>">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="featured_fee">Featured Ad Fee</label>
                                                                <p class="help-block">This is the amount of money that it will cost user to post a featured ads.</p>
                                                                <div>
                                                                    <input name="featured_fee" class="form-control" type="Text" id="featured_fee" value="<?php echo get_option( $config, "featured_fee"); ?>">
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="urgent_fee">Urgent Ad Fee</label>
                                                                <p class="help-block">This is the amount of money that it will cost user to post a urgent ads.</p>
                                                                <input name="urgent_fee" class="form-control" type="Text" id="urgent_fee" value="<?php echo get_option( $config, "urgent_fee"); ?>">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="highlight_fee">Highlight Ad Fee</label>
                                                                <p class="help-block">This is the amount of money that it will cost user to post a highlight ads.</p>
                                                                <input name="highlight_fee" class="form-control" type="Text" id="highlight_fee" value="<?php echo get_option( $config, "highlight_fee"); ?>">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="inputPassword4">Allow User Language Selection</label>
                                                                <select name="userlangsel" class="form-control" id="userlangsel">
                                                                    <option value="1" <?php if(get_option( $config, "userlangsel") == 1){ echo "selected"; } ?>>Yes</option>
                                                                    <option value="0" <?php if(get_option( $config, "userlangsel") == 0){ echo "selected"; } ?>>No</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="inputPassword4">Allow User Theme Selection</label>
                                                                <select name="userthemesel" class="form-control" id="userthemesel">
                                                                    <option value="1" <?php if(get_option( $config, "userthemesel") == 1){ echo "selected"; } ?>>Yes</option>
                                                                    <option value="0" <?php if(get_option( $config, "userthemesel") == 0){ echo "selected"; } ?>>No</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="inputPassword4">Theme/Color switcher</label>
                                                                <select name="color_switcher" class="form-control" id="color_switcher">
                                                                    <option value="1" <?php if(get_option( $config, "color_switcher") == 1){ echo "selected"; } ?>>On</option>
                                                                    <option value="0" <?php if(get_option( $config, "color_switcher") == 0){ echo "selected"; } ?>>Off</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="transfer_filter">Transfer Filter</label>
                                                                <p class="help-block">Whether you should be shown a transfer screen between saving admin pages or not</p>
                                                                <select name="transfer_filter" class="form-control" id="transfer_filter">
                                                                    <option value="1" <?php if(get_option( $config, "transfer_filter") == 1){ echo "selected"; } ?>>Yes</option>
                                                                    <option value="0" <?php if(get_option( $config, "transfer_filter") == 0){ echo "selected"; } ?>>No</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="mod_rewrite">Enable SEO URL</label>
                                                                <select name="mod_rewrite" id="mod_rewrite" class="form-control">
                                                                    <option value="1" <?php if(get_option( $config, "mod_rewrite") == 1){ echo "selected"; } ?>>Yes</option>
                                                                    <option value="0" <?php if(get_option( $config, "mod_rewrite") == 0){ echo "selected"; } ?>>No</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="temp_php">Enable PHP in Template</label>
                                                                <select name="temp_php" id="temp_php" class="form-control">
                                                                    <option value="1" <?php if(get_option( $config, "temp_php") == 1){ echo "selected"; } ?>>Yes</option>
                                                                    <option value="0" <?php if(get_option( $config, "temp_php") == 0){ echo "selected"; } ?>>No</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="quickad_debug">Enable Developement Mode</label>
                                                                <select name="quickad_debug" id="quickad_debug" class="form-control">
                                                                    <option value="1" <?php if(get_option( $config, "quickad_debug") == 1){ echo "selected"; } ?>>Yes</option>
                                                                    <option value="0" <?php if(get_option( $config, "quickad_debug") == 0){ echo "selected"; } ?>>No</option>
                                                                </select>
                                                            </div>

                                                            <div class="panel-footer">
                                                                <button name="general_setting" type="submit" class="btn btn-primary btn-radius save-changes">Save</button>
                                                                <button class="btn btn-default" type="reset">Reset</button>
                                                            </div>

                                                        </form>
                                                    </div>

                                                    <div class="tab-pane" id="quickad_logo_watermark">
                                                        <form method="post" action="ajax_sidepanel.php?action=SaveSettings" id="#quickad_logo_watermark" enctype="multipart/form-data">
                                                            <!-- Favicon upload-->
                                                            <div class="form-group">

                                                                <label class="control-label">Favicon Icon<code>*</code></label>
                                                                <div class="screenshot"><img class="redux-option-image" id="favicon_uploader" src="../storage/logo/<?php echo $config['site_favicon']?>" alt="" target="_blank" rel="external"  style="border: 2px solid #eee;background-color: #000;max-width: 100%"></div>
                                                                <input class="form-control input-sm" type="file" name="favicon" onchange="readURL(this,'favicon_uploader')">
                                                                <span class="help-block">Ideal Size 16x16 PX</span>
                                                            </div>

                                                            <!-- Site Logo upload-->
                                                            <div class="form-group">
                                                                <label class="control-label">Logo<code>*</code></label>
                                                                <div class="screenshot"><img class="redux-option-image" id="image_logo_uploader" src="../storage/logo/<?php echo $config['site_logo']?>" alt="" target="_blank" rel="external"  style="border: 2px solid #eee;background-color: #000;max-width: 100%"></div>
                                                                <input class="form-control input-sm" type="file" name="file" onchange="readURL(this,'image_logo_uploader')">
                                                                <span class="help-block">Ideal Size 168x57 PX</span>
                                                            </div>
                                                            <!-- Site Logo upload-->

                                                            <!-- Home Banner upload-->
                                                            <div class="form-group">
                                                                <label class="control-label">Home Banner<code>*</code></label>
                                                                <div class="screenshot"><img class="redux-option-image" id="home_banner" src="../storage/banner/<?php echo $config['home_banner']?>" alt="" target="_blank" rel="external" width="400px"></div>
                                                                <input class="form-control input-sm" type="file" name="banner" onchange="readURL(this,'home_banner')">
                                                            </div>
                                                            <!-- Home Banner upload-->

                                                            <!-- Watermark Image upload-->
                                                            <div class="form-group">
                                                                <label class="control-label">Watermark Image</label>
                                                                <div class="screenshot"><img class="redux-option-image" id="watermark_logo" src="../storage/logo/watermark.png" alt=""  target="_blank" rel="external"  style="border: 2px solid #eee;background-color: #000;max-width: 100%"></div>
                                                                <input class="form-control input-sm" type="file" name="watermark" onchange="readURL(this,'watermark_logo')">
                                                                <span class="help-block">Must be png</span>
                                                            </div>
                                                            <!-- Watermark Image upload-->

                                                            <!-- Admin Logo upload-->
                                                            <div class="form-group">
                                                                <label class="control-label">Admin Logo</label>
                                                                <div class="screenshot"><img class="redux-option-image" id="adminlogo" src="../storage/logo/<?php echo $config['site_admin_logo']?>" alt="" target="_blank" rel="external"  style="border: 2px solid #eee;background-color: #000;max-width: 100%"></div>
                                                                <input class="form-control input-sm" type="file" name="adminlogo" onchange="readURL(this,'adminlogo')">
                                                                <span class="help-block">Ideal Size 235x62 PX</span>
                                                            </div>

                                                            <!-- Admin Logo upload-->
                                                            <div class="panel-footer">
                                                                <button name="logo_watermark" type="submit" class="btn btn-primary btn-radius save-changes">Save</button>
                                                                <button class="btn btn-default" type="reset">Reset</button>
                                                            </div>

                                                        </form>
                                                    </div>

                                                    <div class="tab-pane" id="quickad_international">
                                                        <form method="post" action="ajax_sidepanel.php?action=SaveSettings" id="#quickad_international">

                                                            <div class="form-group">
                                                                <label class="">Site Country Type:</label>
                                                                <div>
                                                                    <select name="country_type" class="form-control">
                                                                        <option <?php if(get_option( $config, "country_type") == 'single'){ echo "selected"; } ?> value="single">Single Country</option>
                                                                        <option <?php if(get_option( $config, "country_type") == 'multi'){ echo "selected"; } ?> value="multi">Multi Countries</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="specific_country">Default Country</label>
                                                                <p class="help-block">When user first time visit your website. Then the site run for that choosen default country.</p>
                                                                <div>
                                                                    <select  class="js-select2 form-control" name="specific_country" id="specific_country" style="width: 100%;">
                                                                        <?php

                                                                        $country = get_country_list($config,get_option( $config, "specific_country"));
                                                                        foreach ($country as $value){
                                                                            echo '<option value="'.$value['code'].'" '.$value['selected'].'>'.$value['name'].'</option>';
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="timezone">Timezone</label>
                                                                <p class="help-block">Set your website timezone.</p>
                                                                <div>
                                                                    <select name="timezone" id="timezone" class="js-select2 form-control"  style="width: 100%;">
                                                                        <?php
                                                                        $timezone = get_timezone_list($config,get_option( $config, "timezone"));

                                                                        foreach ($timezone as $value) {
                                                                            $id = $value['id'];
                                                                            $country_code = $value['country_code'];
                                                                            $time_zone_id = $value['time_zone_id'];
                                                                            $selected = $value['selected'];
                                                                            echo '<option value="'.$time_zone_id.'" '.$selected.' data-tokens="'.$time_zone_id.'">'.$time_zone_id.'</option>';
                                                                        }

                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="currency">Currency</label>
                                                                <p class="help-block">This is default currecny which used for payment method.</p>
                                                                <div>
                                                                    <select name="currency" id="currency"  class="js-select2 form-control" style="width: 100%;">
                                                                        <?php
                                                                        $currency = get_currency_list($config,get_option( $config, "currency_code"));

                                                                        foreach ($currency as $value)
                                                                        {
                                                                            $id          = $value['id'];
                                                                            $code        = $value['code'];
                                                                            $name       = $value['name'];
                                                                            $html_code   = $value['html_entity'];
                                                                            $selected =  $value['selected'];

                                                                            echo '<option value="'.$id.'" '.$selected.' data-tokens="'.$name.'">'.$name.' ('.$html_code.')</option>';
                                                                        }

                                                                        ?>

                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="inputEmail3">Language</label>
                                                                <select name="lang" id="lang" class="js-select2 form-control" style="width: 100%;">
                                                                    <?php
                                                                    $langs = array();

                                                                    if ($handle = opendir('../includes/lang/'))
                                                                    {
                                                                        while (false !== ($file = readdir($handle)))
                                                                        {
                                                                            if ($file != "." && $file != "..")
                                                                            {
                                                                                $lang2 = str_replace('.php','',$file);
                                                                                $lang2 = str_replace('lang_','',$lang2);

                                                                                $langs[] = $lang2;
                                                                            }
                                                                        }
                                                                        closedir($handle);
                                                                    }

                                                                    sort($langs);

                                                                    foreach ($langs as $key => $lang2)
                                                                    {
                                                                        if(get_option( $config, "lang") == $lang2)
                                                                        {
                                                                            echo '<option value="'.$lang2.'" selected>'.ucwords($lang2).'</option>';
                                                                        }
                                                                        else
                                                                        {
                                                                            echo '<option value="'.$lang2.'">'.ucwords($lang2).'</option>';
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>

                                                            <div class="panel-footer">
                                                                <button name="international" type="submit" class="btn btn-primary btn-radius save-changes">Save</button>
                                                                <button class="btn btn-default" type="reset">Reset</button>
                                                            </div>

                                                        </form>
                                                    </div>

                                                    <div class="tab-pane" id="quickad_email">
                                                        <form method="post" action="ajax_sidepanel.php?action=SaveSettings" id="#quickad_email">

                                                            <div class="form-group">
                                                                <label for="admin_email">Admin Email</label>
                                                                <p class="help-block">This is the email address that the contact and report emails will be sent to, aswell as being the from address in signup and notification emails.</p>
                                                                <div>
                                                                    <input name="admin_email" class="form-control" type="Text" id="admin_email" value="<?php echo get_option( $config, "admin_email");?>">
                                                                </div>
                                                            </div>


                                                            <div class="form-group">
                                                                <label for="email_type">Email Send Type </label>
                                                                <p class="help-block">The Send Type is the method you would like Quickad Classified to use to send all emails.</p>
                                                                <div>
                                                                    <select name="email_type" id="email_type" class="form-control">
                                                                        <option <?php if(get_option( $config, "email_type") == 'mail'){ echo "selected"; } ?> value="mail">Mail</option>
                                                                        <option <?php if(get_option( $config, "email_type") == 'sendmail'){ echo "selected"; } ?> value="sendmail">SendMail</option>
                                                                        <option <?php if(get_option( $config, "email_type") == 'smtp'){ echo "selected"; } ?> value="smtp">SMTP</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="smtp_host">SMTP Host</label>
                                                                <p class="help-block">This is the host address for your smtp server, this is only needed if you are using SMTP as the Email Send Type.</p>
                                                                <div>
                                                                    <input name="smtp_host" type="Text" class="form-control" id="smtp_host" value="<?php echo get_option( $config, "smtp_host");?>">
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="smtp_host">SMTP Port</label>
                                                                <div>
                                                                    <input name="smtp_port" type="Text" class="form-control" id="smtp_port" value="<?php echo get_option( $config, "smtp_port");?>">
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="smtp_username">SMTP Username</label>
                                                                <p class="help-block">This is the username for your smtp server, this is only needed if you are using SMTP as the Email Send Type.</p>
                                                                <div>
                                                                    <input name="smtp_username" class="form-control" type="Text" id="smtp_username" value="<?php echo get_option( $config, "smtp_username");?>">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="smtp_password">SMTP Password</label>
                                                                <p class="help-block">This is the password for your smtp server, this is only needed if you are using SMTP as the Email Send Type.</p>
                                                                <input name="smtp_password" type="Text" class="form-control" id="smtp_password" value="<?php echo get_option( $config, "smtp_password");?>">
                                                            </div>

                                                            <div class="panel-footer">
                                                                <button name="email_setting" type="submit" class="btn btn-primary btn-radius save-changes">Save</button>
                                                                <button class="btn btn-default" type="reset">Reset</button>
                                                            </div>

                                                        </form>
                                                    </div>

                                                    <div class="tab-pane" id="quickad_theme_setting">
                                                        <form method="post" action="ajax_sidepanel.php?action=SaveSettings" id="#quickad_theme_setting">

                                                            <div class="form-group">
                                                                <label class="">Home Map Latitude:</label>
                                                                <div>
                                                                    <input name="home_map_latitude" type="text" class="form-control" value="<?php echo get_option( $config, "home_map_latitude"); ?>">
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="">Home Map Longitude:</label>
                                                                <div>
                                                                    <input name="home_map_longitude" type="text" class="form-control" value="<?php echo get_option( $config, "home_map_longitude"); ?>">
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="">Home Map Zoom:</label>
                                                                <div>
                                                                    <input name="home_map_zoom" type="text" class="form-control" value="<?php echo get_option( $config, "home_map_zoom"); ?>">
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="">Theme Color:</label>
                                                                <div>
                                                                    <input name="theme_color" type="color" class="form-control" value="<?php echo get_option( $config, "theme_color"); ?>">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="">Map Color:</label>
                                                                <div>
                                                                    <input name="map_color" type="color" class="form-control" value="<?php echo get_option( $config, "map_color"); ?>">
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="">Meta Keywords:</label>
                                                                <div>
                                                                    <input name="meta_keywords" type="text" class="form-control" value="<?php echo get_option( $config, "meta_keywords"); ?>">
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="">Meta Description:</label>
                                                                <div>
                                                                    <input name="meta_description" type="text" class="form-control" value="<?php echo get_option( $config, "meta_description"); ?>">
                                                                </div>
                                                            </div>

                                                            <!--Default Horizontal Form-->
                                                            <div class="form-group">
                                                                <label class="">Contact Address:</label>
                                                                <div>
                                                                    <input name="contact_address" type="text" class="form-control" value="<?php echo get_option( $config, "contact_address"); ?>">
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="">Contact Map Latitude:</label>
                                                                <div>
                                                                    <input name="contact_latitude" type="text" class="form-control" value="<?php echo get_option( $config, "contact_latitude"); ?>">
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="">Contact Map Longitude:</label>
                                                                <div>
                                                                    <input name="contact_longitude" type="text" class="form-control" value="<?php echo get_option( $config, "contact_longitude"); ?>">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="">Contact Email:</label>
                                                                <div>
                                                                    <input name="contact_email" type="text" class="form-control" value="<?php echo get_option( $config, "contact_email"); ?>">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="">Contact Phone:</label>
                                                                <div>
                                                                    <input name="contact_phone" type="text" class="form-control" value="<?php echo get_option( $config, "contact_phone"); ?>">
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="">Copyright Text:</label>
                                                                <div>
                                                                    <input name="copyright_text" type="text" class="form-control" value="<?php echo get_option( $config, "copyright_text"); ?>">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="">Footer Text:</label>
                                                                <div>
                                                                    <textarea name="footer_text" class="form-control"><?php echo get_option( $config, "footer_text"); ?></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Footer Facebook Page Link:</label>
                                                                <div>
                                                                    <input name="facebook_link" type="text" class="form-control" value="<?php echo get_option( $config, "facebook_link"); ?>">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Footer Twitter Page Link:</label>
                                                                <div>
                                                                    <input name="twitter_link" type="text" class="form-control" value="<?php echo get_option( $config, "twitter_link"); ?>">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Footer Google+ Page Link:</label>
                                                                <div>
                                                                    <input name="googleplus_link" type="text" class="form-control" value="<?php echo get_option( $config, "googleplus_link"); ?>">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Footer Youtube Page/Video Link:</label>
                                                                <div>
                                                                    <input name="youtube_link" type="text" class="form-control" value="<?php echo get_option( $config, "youtube_link"); ?>">
                                                                </div>
                                                            </div>

                                                            <div class="panel-footer">
                                                                <button name="theme_setting" type="submit" class="btn btn-primary btn-radius save-changes">Save</button>
                                                                <button class="btn btn-default" type="reset">Reset</button>
                                                            </div>

                                                        </form>
                                                    </div>

                                                    <div class="tab-pane" id="quickad_frontend_submission">
                                                        <form method="post" action="ajax_sidepanel.php?action=SaveSettings" id="#quickad_frontend_submission">
                                                            <div class="form-group">
                                                                <h4>Modify Post form fields</h4>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Tags Field :</label>
                                                                <div>
                                                                    <select name="post_tags_mode" class="form-control">
                                                                        <option <?php if(get_option( $config, "post_tags_mode") == '1'){ echo "selected"; } ?> value="1">Enable</option>
                                                                        <option <?php if(get_option( $config, "post_tags_mode") == '0'){ echo "selected"; } ?> value="0">Disable</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Address Field :</label>
                                                                <div>
                                                                    <select name="post_address_mode" class="form-control">
                                                                        <option <?php if(get_option( $config, "post_address_mode") == '1'){ echo "selected"; } ?> value="1">Enable</option>
                                                                        <option <?php if(get_option( $config, "post_address_mode") == '0'){ echo "selected"; } ?> value="0">Disable</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Ads Auto Approve :</label>
                                                                <div>
                                                                    <select name="post_auto_approve" class="form-control">
                                                                        <option <?php if(get_option( $config, "post_auto_approve") == '1'){ echo "selected"; } ?> value="1">Enable</option>
                                                                        <option <?php if(get_option( $config, "post_auto_approve") == '0'){ echo "selected"; } ?> value="0">Disable</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label>Watermark :</label>
                                                                <div>
                                                                    <select name="post_watermark" class="form-control">
                                                                        <option <?php if(get_option( $config, "post_watermark") == '1'){ echo "selected"; } ?> value="1">Enable</option>
                                                                        <option <?php if(get_option( $config, "post_watermark") == '0'){ echo "selected"; } ?> value="0">Disable</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Premium Listing Option :</label>
                                                                <div>
                                                                    <select name="post_premium_listing" class="form-control">
                                                                        <option <?php if(get_option( $config, "post_premium_listing") == '1'){ echo "selected"; } ?> value="1">Enable</option>
                                                                        <option <?php if(get_option( $config, "post_premium_listing") == '0'){ echo "selected"; } ?> value="0">Disable</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="panel-footer">
                                                                <button name="frontend_submission" type="submit" class="btn btn-primary btn-radius save-changes">Save</button>
                                                                <button class="btn btn-default" type="reset">Reset</button>
                                                            </div>

                                                        </form>
                                                    </div>

                                                    <div class="tab-pane" id="quickad_social_login_setting">
                                                        <form method="post" action="ajax_sidepanel.php?action=SaveSettings" id="#quickad_social_login_setting">
                                                            <!--Default Horizontal Form-->
                                                            <div class="form-group">
                                                                <label>Facebook app id:</label>
                                                                <div>
                                                                    <input name="facebook_app_id" type="text" class="form-control" value="<?php echo get_option( $config, "facebook_app_id"); ?>">
                                                                </div>
                                                            </div>
                                                            <!--Default Horizontal Form-->

                                                            <!--Default Horizontal Form-->
                                                            <div class="form-group">
                                                                <label>Facebook app secret:</label>
                                                                <div>
                                                                    <input name="facebook_app_secret" type="text" class="form-control" value="<?php echo get_option( $config, "facebook_app_secret"); ?>">
                                                                </div>
                                                            </div>
                                                            <!--Default Horizontal Form-->

                                                            <!--Default Horizontal Form-->
                                                            <div class="form-group">
                                                                <label>Facebook callback url:</label>
                                                                <p class="help-block">Use this redirect url in facebook app.</p>
                                                                <div>
                                                                    <input type="text" class="form-control" disabled value="<?php echo $config['site_url']; ?>includes/social_login/facebook/index.php">
                                                                </div>
                                                            </div>
                                                            <!--Default Horizontal Form-->

                                                            <!--Default Horizontal Form-->
                                                            <div class="form-group">
                                                                <label>Google+ app id:</label>
                                                                <div>
                                                                    <input name="google_app_id" type="text" class="form-control" value="<?php echo get_option( $config, "google_app_id"); ?>">
                                                                </div>
                                                            </div>
                                                            <!--Default Horizontal Form-->

                                                            <!--Default Horizontal Form-->
                                                            <div class="form-group">
                                                                <label>Google+ app secret:</label>
                                                                <div>
                                                                    <input name="google_app_secret" type="text" class="form-control" value="<?php echo get_option( $config, "google_app_secret"); ?>">
                                                                </div>
                                                            </div>
                                                            <!--Default Horizontal Form-->
                                                            <!--Default Horizontal Form-->
                                                            <div class="form-group">
                                                                <label>Google+ callback url:</label>
                                                                <div>
                                                                    <input type="text" class="form-control" disabled value="<?php echo $config['site_url']; ?>includes/social_login/google/index.php">
                                                                </div>
                                                            </div>
                                                            <!--Default Horizontal Form-->

                                                            <div class="panel-footer">
                                                                <button name="social_login_setting" type="submit" class="btn btn-primary btn-radius save-changes">Save</button>
                                                                <button class="btn btn-default" type="reset">Reset</button>
                                                            </div>

                                                        </form>
                                                    </div>

                                                    <div class="tab-pane" id="quickad_recaptcha">
                                                        <form method="post" action="ajax_sidepanel.php?action=SaveSettings" id="#quickad_recaptcha">
                                                            <div class="form-group">
                                                                <h4>Get reCAPTCHA API keys</h4>
                                                                <p class="help-block">For adding reCAPTCHA to your site, you need to register your site and get reCAPTCHA API keys.<br>Register your site at Google from this link – <a href="https://www.google.com/recaptcha/admin" target="_blank">Click Here</a>.</p>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>reCAPTCHA Enable/Disable:</label>
                                                                <div>
                                                                    <select name="recaptcha_mode" id="recaptcha_mode" class="form-control">
                                                                        <option <?php if(get_option( $config, "recaptcha_mode") == '1'){ echo "selected"; } ?> value="1">Enable</option>
                                                                        <option <?php if(get_option( $config, "recaptcha_mode") == '0'){ echo "selected"; } ?> value="0">Disable</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>reCAPTCHA Public Key:</label>
                                                                <div>
                                                                    <input name="recaptcha_public_key" type="text" class="form-control" value="<?php echo get_option( $config, "recaptcha_public_key"); ?>">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>reCAPTCHA Private Key:</label>
                                                                <div>
                                                                    <input name="recaptcha_private_key" type="text" class="form-control" value="<?php echo get_option( $config, "recaptcha_private_key"); ?>">
                                                                </div>
                                                            </div>

                                                            <div class="panel-footer">
                                                                <button name="recaptcha_setting" type="submit" class="btn btn-primary btn-radius save-changes">Save</button>
                                                                <button class="btn btn-default" type="reset">Reset</button>
                                                            </div>

                                                        </form>
                                                    </div>

                                                    <div class="tab-pane" id="quickad_purchase_code">
                                                        <form method="post" action="ajax_sidepanel.php?action=SaveSettings" id="#quickad_purchase_code">
                                                            <!--Default Horizontal Form-->
                                                            <div class="form-group">
                                                                <h4>Instructions</h4>
                                                                <p class="help-block">Verify the purchase code you will have access to free updates of Quickad. Updates may contain functionality improvements and important security fixes. <br>For more information on where to find your purchase code see this <a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-can-I-find-my-Purchase-Code-" target="_blank">page</a>.</p>
                                                            </div>
                                                            <?php
                                                            if(isset($config['purchase_key']) && $config['purchase_key'] != ""){
                                                                ?>
                                                                <div class="alert alert-success">
                                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                                    <strong>Success!</strong>   Purchase code verified.
                                                                </div>

                                                            <?php
                                                            }
                                                            ?>
                                                            <div class="form-group">
                                                                <label>Quickad Classified Purchase Code:</label>
                                                                <div>
                                                                    <input name="purchase_key" type="text" class="form-control" value="">
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label>Buyer Email:</label>
                                                                <div>
                                                                    <input name="buyer_email" type="text" class="form-control" value="">
                                                                </div>
                                                            </div>
                                                            <div class="panel-footer">
                                                                <button name="valid_purchase_setting" type="submit" class="btn btn-primary btn-radius save-changes">Save</button>
                                                                <button class="btn btn-default" type="reset">Reset</button>
                                                            </div>

                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <!-- /.row -->
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
<script>
    var url = window.location.href;
    var activeTab = url.substring(url.indexOf("#") + 1);
    if(url.indexOf("#") > -1){
        if(activeTab.length > 0){
            $(".quickad-nav-item").removeClass("active");
            $(".tab-pane").removeClass("active in");
            $("li[data-target = #"+activeTab+"]").addClass("active");
            $("#" + activeTab).addClass("active in");
            $('a[href="#'+ activeTab +'"]').tab('show')
        }
    }

    $(".save-changes").click(function(){
        $(".save-changes").addClass("bookme-progress");
    });
</script>
<script>
    // wait for the DOM to be loaded
    $(document).ready(function() {
        // bind 'myForm' and provide a simple callback function
        $('form').ajaxForm(function(data) {
            if (data == 0) {
                alertify.error("Unknown Error generated.");
            } else {
                data = JSON.parse(data);
                if (data.status == "success") {
                    alertify.success(data.message);
                }
                else {
                    alertify.error(data.message);
                }
            }
            $(".save-changes").removeClass('bookme-progress');
        });
    });
</script>
<!-- Page JS Code -->
<script>
    $(function()
    {
        // Init page helpers (BS Datepicker + BS Colorpicker + Select2 + Masked Input + Tags Inputs plugins)
        App.initHelpers('select2');
    });
</script>
</body></html>