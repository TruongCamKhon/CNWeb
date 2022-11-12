<?php
include '../../Controllers/nhanvienController.php';
$nhanvienController = new nhanvienController();
$nhanvienController->delete();
$per_page = "?per_page=" . $_GET['per_page'];
$current_page = "&current_page=" . $_GET['current_page'];
header("location: http://localhost/qlns/app/Views/nhanvien/nhanvien.php$per_page$current_page");
?>