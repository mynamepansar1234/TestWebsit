<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "register_db";

// เชื่อมต่อฐานข้อมูล
$conn = mysqli_connect($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error()); // ถ้าการเชื่อมต่อล้มเหลว ให้แสดงข้อความข้อผิดพลาด
}

?>
