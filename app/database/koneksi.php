<?php 
// error_reporting(0);
date_default_timezone_set("Asia/Jakarta");

$konfigs = mysqli_connect("localhost", "root", "", "aplikasi-perpus") or mysqli_connect_error();
try {
    $config = new PDO("mysql:host=localhost;dbname=aplikasi-perpus;", "root", "");
} catch (Exception $e){
    echo "Database Gagal terhubung : ".$e->getMessage();
    die;
}

?>