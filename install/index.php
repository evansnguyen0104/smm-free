<?php
$project_name            = "SmartPanel SMM Script By Mfb.vn";
$php_version_success     = false;
$mysql_success           = false;
$curl_success            = false;
$gd_success              = false;
$zip_success             = false;
$allow_url_fopen_success = false;
$allow_install_success   = false;
$php_version_required    = "5.6.0";
$current_php_version     = PHP_VERSION;

//check required php version
if (version_compare($current_php_version, $php_version_required) >= 0) {
    $php_version_success = true;
}

//check mySql
if (function_exists("mysqli_connect")) {
    $mysql_success = true;
}

//check curl
if (function_exists("curl_version")) {
    $curl_success = true;
}

//check gd
if (extension_loaded('gd') && function_exists('gd_info')) {
    $gd_success = true;
}

//check PHP zip
if (extension_loaded('zip')) {
    $zip_success = true;
}

//check allow_url_fopen
if (ini_get('allow_url_fopen')) {
    $allow_url_fopen_success = true;
}

//check if all requirement is success
if ($php_version_success && $mysql_success && $curl_success && $gd_success && $allow_url_fopen_success && $zip_success) {
    $all_requirement_success = true;
} else {
    $all_requirement_success = false;
}
$writeable_directories = array(
    'config' => '/app/config.php',
    'index' => '/index.php',
);
foreach ($writeable_directories as $value) {
    if (!is_writeable(".." . $value)) {
        $all_requirement_success = false;
    }
}
$dashboard_url = $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'];
$dashboard_url = explode('/install/', $dashboard_url)[0]; //remove everything after index.php
if (!empty($_SERVER['HTTPS'])) {
    $dashboard_url = 'https://' . $dashboard_url;
} else {
    $dashboard_url = 'http://' . $dashboard_url;
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge" >
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="fairsketch">
        <link rel="icon" href="assets/images/favicon.png" />
        <title><?php echo $project_name ?> Installation</title>
        <link rel='stylesheet' type='text/css' href='assets/bootstrap/css/bootstrap.min.css' />
        <link rel='stylesheet' type='text/css' href='assets/js/font-awesome/css/font-awesome.min.css' />

        <link rel='stylesheet' type='text/css' href='assets/css/install.css' />

        <script type='text/javascript'  src='assets/js/jquery-1.11.3.min.js'></script>
        <script type='text/javascript'  src='assets/js/jquery-validation/jquery.validate.min.js'></script>
        <script type='text/javascript'  src='assets/js/jquery-validation/jquery.form.js'></script>
        <style>
            #finished-tab .section .status{
                font-size: 50px;
            }
            #finished-tab .section span.pull-left{
                line-height: 50px;
            }
            #finished-tab .section .note{
                margin: 15px 0 15px 60px;
                color: #d73b3b;
            }
            #finished-tab .section .login-icon{
                font-size: 100px;
            }
        </style>
    </head>
    <body>
        <div class="install-box">
            <div class="panel panel-install">
                <div class="app-name-img">
                    <img src="assets/images/logo.png" alt="<?php echo $project_name ?>" class="img-responsive center-block" >
                </div>
                <div class="panel-heading text-center">
                    <h2> <?php echo $project_name ?> Installation</h2>
                </div>
                <div class="panel-body no-padding">
                    <div class="tab-container clearfix">
                        <div id="pre-installation" class="tab-title col-sm-4 active"><i class="fa fa-circle-o"></i><strong> Pre-Installation</strong></span></div>
                        <div id="configuration" class="tab-title col-sm-4"><i class="fa fa-circle-o"></i><strong> Configuration</strong></div>
                        <div id="finished" class="tab-title col-sm-4"><i class="fa fa-circle-o"></i><strong> Finished</strong></div>
                    </div>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="pre-installation-tab">
                            <?php include 'views/Pre-Installation.php'; ?>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="configuration-tab">
                            <?php include 'views/Configuration.php'; ?>
                        </div>

                        <div role="tabpanel" class="tab-pane" id="finished-tab">
                            <?php include 'views/Finished.php'; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<script type="text/javascript">
    var onFormSubmit = function ($form) {
        $form.find('[type="submit"]').attr('disabled', 'disabled').find(".loader").removeClass("hide");
        $form.find('[type="submit"]').find(".button-text").addClass("hide");
        $("#alert-container").html("");
    };
    var onSubmitSussess = function ($form) {
        $form.find('[type="submit"]').removeAttr('disabled').find(".loader").addClass("hide");
        $form.find('[type="submit"]').find(".button-text").removeClass("hide");
    };
    $(document).ready(function () {
        var $preInstallationTab = $("#pre-installation-tab"),
            $configurationTab = $("#configuration-tab");

        $(document).on('click','.form-next', function(){
            if ($preInstallationTab.hasClass("active")) {
                $preInstallationTab.removeClass("active");
                $configurationTab.addClass("active");
                $("#pre-installation").find("i").removeClass("fa-circle-o").addClass("fa-check-circle");
                $("#configuration").addClass("active");
                $("#host").focus();
            }
        });
        $(document).on('submit','#config-form', function(){
            var $form = $(this);
            onFormSubmit($form);
            $form.ajaxSubmit({
                dataType: "json",
                success: function (result) {
                    onSubmitSussess($form, result);
                    if (result.status == 'success') {
                        $configurationTab.removeClass("active");
                        $("#configuration").find("i").removeClass("fa-circle-o").addClass("fa-check-circle");
                        $("#finished").find("i").removeClass("fa-circle-o").addClass("fa-check-circle");
                        $("#finished").addClass("active");
                        $("#finished-tab").addClass("active");
                    } else {
                        $("#alert-container").html('<div class="alert alert-danger" role="alert">' + result.message + '</div>');
                    }
                }
            });
            return false;
        });
    });
</script>
