<?php
include '../../Controllers/chucvuController.php';
$chucvuController = new chucvuController();
$id = $_GET['id'];
$macv = $_GET['macv'];
$chucvuController->delete($id, $macv);
$per_page = "?per_page=" . $_GET['per_page'];
$current_page = "&current_page=" . $_GET['current_page'];
header("location: http://localhost/qlns/app/Views/chucvu/chucvu.php$per_page$current_page");
?>