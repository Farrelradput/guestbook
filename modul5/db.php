<?php
$host = "127.0.0.1";
$user = "root";
$pass = "";
$dbname = "guestbook_db";
$port = 3307;

$conn = new mysqli($host, $user, $pass, $dbname, $port);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
