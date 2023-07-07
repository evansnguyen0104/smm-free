<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);
@ini_set('max_execution_time', 3300);

class Install
{
    private $error = '';
    public function go()
    {
        $debug = '';
        require_once 'includes/config.php';
        require_once 'includes/install_helper.php';
        if (isset($_POST) && !empty($_POST)) {
            install($config);
        }
    }
}
