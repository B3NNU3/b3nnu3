<?php
define('__ROOTDIR__', __DIR__);
error_reporting(E_ALL);
ini_set('log_errors', 1);
ini_set('display_errors', 1);
require_once('vendor/autoload.php');
$b3nnu3 = new b3nnu3\app();
$b3nnu3->start();