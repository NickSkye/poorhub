<?php
require_once('../includes/config.php');
require_once('../includes/functions/func.admin.php');
require_once('../includes/functions/func.sqlquery.php');

$mysqli = db_connect($config);
admin_session_start();
checkloggedadmin($config);

include("header.php");
?>
    <!-- Google web fonts -->
    <link href="http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700" rel='stylesheet' />

    <!-- The mini-upload-form main CSS file -->
    <link href="plugins/mini-upload-form/assets/css/style.css" rel="stylesheet" />

<main class="app-layout-content">

    <!-- Page Content -->
    <div class="container-fluid p-y-md">
        <!-- Partial Table -->
        <div class="card">
            <div class="card-header">
                <h4>Update Quickad CMS</h4>
            </div>
            <div class="card-block">


<?php
ini_set('max_execution_time',3600);
$server_file_path = "https://bylancer.com/api/quickad-release/";
$update_dir = "uploads/";
$installable_dir = "../";

//Check For An Update
$getVersions = file_get_contents('https://bylancer.com/api/quickad-release-versions.php') or die ('ERROR');
if ($getVersions != '')
{
    echo '<p>CURRENT VERSION: <span id="version">'.$config['version'].'</span></p>';
    $versionList = explode("\n", $getVersions);
    foreach ($versionList as $aV)
    {
        if ( $aV > $config['version']) {
            if (!isset($_GET['doUpdate']))
            echo '<p>New Update Found: <label class="label label-success">v'.$aV.'</label></p>';
            $found = true;

            if ( !is_file(  $update_dir.'QUICKAD-CMS-'.$aV.'.zip' )) {

                if ( !is_dir( $update_dir ) ) mkdir ( $update_dir );
                ?>
                <form id="upload" method="post" action="upload.php" enctype="multipart/form-data">
                    <div id="drop">
                        Drop Here <br>QUICKAD-CMS-<?php echo $aV ?>.zip
                        <a>Browse</a>
                        <input type="file" name="upl" multiple />
                    </div>
                    <ul>
                        <!-- The file uploads will be shown here -->
                    </ul>

                </form>
                <?php
                break;
            }else{
                if (!isset($_GET['doUpdate']))
                echo '<p>Update already downloaded.</p>';
            }


            if (isset($_GET['doUpdate']) && $_GET['doUpdate'] == true) {
                //Open The File And Do Stuff
                $zipHandle = zip_open($update_dir.'QUICKAD-CMS-'.$aV.'.zip');
                echo '<div id="updating">Updating Please wait...</div>';
                echo '<div id="update-completed"></div>';
                echo '<ul style="height: 350px;overflow-y: scroll;">';
                while ($aF = zip_read($zipHandle) )
                {
                    $thisFileName = zip_entry_name($aF);
                    $thisFileDir = dirname($thisFileName);

                    $filename = explode('/',$thisFileName);
                    $filename = end($filename);

                    if($thisFileDir != ""){
                        $basedir = explode('/',$thisFileDir);
                        if($basedir[0] == "storage") continue;
                        if($basedir[0] == "install" && $filename != 'upgrade.php') continue;
                        //if($basedir[0] == "admin" && $filename != '.htaccess') continue;
                    }else{
                        if($filename != 'htaccess.txt') continue;
                    }

                    //Continue if its not a file
                    if ( substr($thisFileName,-1,1) == '/') continue;


                    //Make the directory if we need to...
                    if ( !is_dir ( $installable_dir.$thisFileDir ) )
                    {
                        mkdir ( $installable_dir.$thisFileDir, 0755, true );
                        echo '<li>Created Directory '.$thisFileDir.'</li>';
                    }

                    //Overwrite the file
                    if ( !is_dir($installable_dir.$thisFileName) ) {
                        echo '<li>'.$thisFileName.'...........';
                        $contents = zip_entry_read($aF, zip_entry_filesize($aF));
                        $contents = str_replace("\r\n", "\n", $contents);
                        $updateThis = '';

                        //If we need to run commands, then do it.
                        if ( $filename == 'upgrade.php' )
                        {
                            $upgradeExec = fopen ('upgrade.php','w');
                            fwrite($upgradeExec, $contents);
                            fclose($upgradeExec);
                            include ('upgrade.php');
                            unlink('upgrade.php');
                            echo' EXECUTED</li>';
                        }
                        else if ( $filename == 'config.php' )
                        {
                            echo' Leave this file as it is</li>';
                        }
                        else
                        {
                            $updateThis = fopen($installable_dir.$thisFileName, 'w');
                            fwrite($updateThis, $contents);
                            fclose($updateThis);
                            unset($contents);
                            echo' UPDATED</li>';
                        }
                    }
                }
                echo '</ul>';
                $updated = TRUE;
                $installing_version = $aV;

                echo '<script>document.getElementById("updating").style.visibility = "hidden"; </script>';
                echo '<script>document.getElementById("update-completed").innerHTML = "Completed 100%"; </script>';
                echo '<script>document.getElementById("version").innerHTML = "'.$installing_version.'"; </script>';

                // Content that will be written to the config file
                $content = "<?php\n";
                $content .= "\$config['db']['host'] = '" . $config['db']['host'] . "';\n";
                $content .= "\$config['db']['name'] = '" . $config['db']['name'] . "';\n";
                $content .= "\$config['db']['user'] = '" . $config['db']['user'] . "';\n";
                $content .= "\$config['db']['pass'] = '" . $config['db']['pass'] . "';\n";
                $content .= "\$config['db']['pre'] = '" . $config['db']['pre'] . "';\n";
                $content .= "\n";
                $content .= "\$config['version'] = '" . $installing_version . "';\n";
                $content .= "\$config['installed'] = '1';\n";
                $content .= "?>";

                // Open the config.php for writting
                $handle = fopen('../includes/config.php', 'w');
                // Write the config file
                fwrite($handle, $content);
                // Close the file
                fclose($handle);
                //unlink($update_dir.'QUICKAD-CMS-'.$aV.'.zip');
                //unlink($update_dir);
            }
            else{
                echo '<p>Update ready. &raquo; <a href="?doUpdate=true" class="btn btn-success">Install Now?</a></p>';
                break;
            }
        }else{
            $found = false;
        }
    }

    if (isset($updated) && $updated == true) {
        //set_setting('site','CMS',$aV);
        echo '<p class="success">&raquo; CMS Updated to v'.$aV.'</p>';
    }
    else if (isset($found) && $found == false) echo '<p>&raquo; No update is available.</p>';


}
else echo '<p>Could not find latest realeases.</p>';

?>

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

<!-- JavaScript Includes -->

<script src="plugins/mini-upload-form/assets/js/jquery.knob.js"></script>

<!-- jQuery File Upload Dependencies -->
<script src="plugins/mini-upload-form/assets/js/jquery.ui.widget.js"></script>
<script src="plugins/mini-upload-form/assets/js/jquery.iframe-transport.js"></script>
<script src="plugins/mini-upload-form/assets/js/jquery.fileupload.js"></script>

<!-- Our mini-upload-form main JS file -->
<script src="plugins/mini-upload-form/assets/js/script.js"></script>