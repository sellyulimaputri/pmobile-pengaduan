<?php

$host = "localhost"; 
$user = "root"; 
$pass = "";

$db = "if0_41601090_pemrograman_mobile";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
die("Koneksi gagal: ". mysqli_connect_error());}
?>