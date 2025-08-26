<?php 
require 'environment.php';
require 'vendor/autoload.php';
$config = array();
define("BASE_URL","http://localhost/filmes");

use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();


?>