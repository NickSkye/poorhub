<?php
require_once('../includes/config.php');
?>
    <style>
        .install-widget {
            position: absolute;
            top: 30%;
            left: 25%;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            width: 50%;
            background-color: #333333;
            border-radius: 5px;
            color: white;
            display: table;
            font-size: 14px;
            height: 130px;
            padding: 20px 10px 10px;
        }
        .install-widget>p {
            padding: 10px;
            text-align: center;
            vertical-align: middle;
            line-height: 20px;
        }
        .btn {
            background-color: #82b440;
            color: #fff;
            font-size: 14px;
            padding: 5px 20px;
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            display: inline-block;
            margin: 0;
            border: none;
            border-radius: 4px;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
<?php
function install_error($error)
{
    if(!isset($_GET['ignore_errors']))
    {
        exit($error.'<br><Br><a href="'.$_SERVER['PHP_SELF'].'?ignore_errors=1&install=1">Click here</a> to run the upgrade and ignore errors');
    }
}

$installing_version = '5.6';

// Check to see if the script is already installed
if(isset($config['installed']))
{
    if($config['version'] == $installing_version)
    {
        // Exit the script
        exit('Quickad version '.$installing_version.' is already installed.');
    }
}

if(!isset($_GET['install']))
{
    echo '<div class="install-widget">
        <p>Note : Only 5.4 and 5.5 version can be upgrade to '.$installing_version.'. Older version need fresh installation.</p>
      <p>Before you run an upgrade it is recommended that you backup your Quickad database and storage folder.All customization will be lost on upgrade.Are you sure you want to upgrade your Quickad installation from '.$config['version'].' to '.$installing_version.'?</p>
    <p><a class="btn" href="upgrade_5.6.php?install=1">Yes do it</a></p>
    </div>';
}
else
{
    ignore_user_abort(1);

    echo '<pre>';



    // Check that config file is writtable
    echo "Checking config file is_writable... \t\t";
    if(@is_writable('../includes/config.php'))
    {
        echo "success<br>";
        // Try to connect to the databse
        echo "Connecting to database.... \t";
        $con = @mysqli_connect ($config['db']['host'], $config['db']['user'], $config['db']['pass']);
        $db_select = @mysqli_select_db ($con,$config['db']['name']) OR install_error('ERROR ('.mysqli_error($con).')');
        echo "success<br>";


        $q = "DROP TABLE IF EXISTS `".$config['db']['pre']."pages`";
        @mysqli_query($con,$q) or install_error('ERROR ('.mysqli_error($con).')');

        echo "Creating pages Table...  \t\t";
        $table_pages = "CREATE TABLE `".$config['db']['pre']."pages` (
          `id` int(10) UNSIGNED NOT NULL,
          `translation_lang` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
          `translation_of` int(10) UNSIGNED DEFAULT NULL,
          `parent_id` int(10) UNSIGNED DEFAULT NULL,
          `type` enum('0','1') NOT NULL DEFAULT '0',
          `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
          `slug` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
          `title` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
          `content` text COLLATE utf8_unicode_ci,
          `active` tinyint(1) DEFAULT '1',
          `created_at` timestamp NULL DEFAULT NULL,
          `updated_at` timestamp NULL DEFAULT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
        @mysqli_query($con,$table_pages) or install_error('ERROR ('.mysqli_error($con).')');
        echo "success<br>";

        $sql = "ALTER TABLE `".$config['db']['pre']."pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `translation_lang` (`translation_lang`),
  ADD KEY `translation_of` (`translation_of`),
  ADD KEY `parent_id` (`parent_id`)";
        @mysqli_query($con,$sql) or install_error('ERROR ('.mysqli_error($con).')');
        echo "success indexes<br>";

        $sql2 = "ALTER TABLE `".$config['db']['pre']."pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT";
        @mysqli_query($con,$sql2) or install_error('ERROR ('.mysqli_error($con).')');
        echo "success AUTO_INCREMENT<br>";


        $sql3 = "ALTER TABLE `".$config['db']['pre']."faq_entries`
        ADD `translation_lang` VARCHAR(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL AFTER `faq_id`, ADD `translation_of` INT(10) UNSIGNED NULL DEFAULT NULL AFTER `translation_lang`, ADD `parent_id` INT(10) UNSIGNED NULL DEFAULT NULL AFTER `translation_of`";
        @mysqli_query($con,$sql3) or install_error('ERROR ('.mysqli_error($con).')');

        $sql4 = "ALTER TABLE `".$config['db']['pre']."faq_entries`
        ADD INDEX( `translation_lang`, `translation_of`, `parent_id`)";
        @mysqli_query($con,$sql4) or install_error('ERROR ('.mysqli_error($con).')');

        $sql5 = "ALTER TABLE `".$config['db']['pre']."faq_entries`
        ADD `active` TINYINT(1) NULL DEFAULT '1' AFTER `faq_content`";
        @mysqli_query($con,$sql5) or install_error('ERROR ('.mysqli_error($con).')');
        echo "success ALTER TABLE faq_entries<br>";


    }
    else
    {
        echo 'ERROR (config.php permisions not set correctly)';
        exit;
    }


    // Start updating the config file with new variables
    echo "Writting config.php updates.. \t";
    $content = "<?php\n";
    $content.= "\$config['db']['host'] = '".$config['db']['host']."';\n";
    $content.= "\$config['db']['name'] = '".$config['db']['name']."';\n";
    $content.= "\$config['db']['user'] = '".$config['db']['user']."';\n";
    $content.= "\$config['db']['pass'] = '".$config['db']['pass']."';\n";
    $content.= "\$config['db']['pre'] = '".$config['db']['pre']."';\n";
    $content.= "\n";
    $content .= "\$config['version'] = '".$installing_version."';\n";
    $content .= "\$config['installed'] = '1';\n";
    $content.= "?>";

    // Open the includes/config.php for writting
    $handle = fopen('../includes/config.php', 'w');
    // Write the config file
    fwrite($handle, $content);
    // Close the file
    fclose($handle);
    echo "success<br>";

    echo "<br><Br><Br>Thank You! for upgrading Quickad, Please <a href=\"../index.php\">click here</a> to access your site";

    echo '</pre>';
}
?>