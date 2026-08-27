<?php 
require 'environment.php';
require 'vendor/autoload.php';
$config = array();
define("BASE_URL","http://54.207.229.254/FilmesOnline");

use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();


?>