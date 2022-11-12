<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Nhân viên</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>

<body>
<?php
include '../../Controllers/chucvuController.php';
$chucvuController = new chucvuController();
$chucvuController->add();
?>
<div class="container">
    <h1 class="text-center text-danger" data-wow-duration="1s">Add chức vụ</h1>

    <form method="POST" action="">
        <div class="row m-2">
            <label class="col-md-2" for="maCV">Mã chức vụ:</label>
            <input type="text" id="maCV" class="col-md-10" name="maCV">
        </div>

        <div class="row m-2">
            <label class="col-md-2" for="tenCV">Tên chức vụ:</label>
            <input type="text" id="tenCV" class="col-md-10" name="tenCV">
        </div>

        <div class="row m-2">
            <label class="col-md-2" for="heSoLuong">Hệ số lương:</label>
            <input type="text" id="heSoLuong" class="col-md-10" name="heSoLuong">
        </div>
        <button type="submit" class="btn btn-primary m-2 float-end" name="add">Submit</button>
    </form>
</div>
</body>

</html>

