<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Edit Chức Vụ</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
<?php
include '../../Controllers/chucvuController.php';
$macv = $_GET['macv'];
$chucvuController = new chucvuController();
$showDBEdit = $chucvuController->showDBEdit($macv);

$chucvuController->edit($macv);
?>
<div class="container">
    <h1 class="text-center text-danger" data-wow-duration="1s">Edit chức vụ</h1>

    <form method="POST" action="">
        <?php $row = $showDBEdit->fetch() ?>
        <div class="row m-2">
            <label class="col-md-2" for="maCV">Mã chức vụ:</label>
            <input type="text" id="maCV" class="col-md-10" name="maCV" value="<?php echo htmlspecialchars($row['maCV']); ?>">
        </div>
        <div class="row m-2">
            <label class="col-md-2" for="tenCV">Tên chức vụ:</label>
            <input type="text" id="tenCV" class="col-md-10" name="tenCV" value="<?php echo htmlspecialchars($row['tenCV']); ?>">
        </div>
        <div class="row m-2">
            <label class="col-md-2" for="heSoLuong">Hệ số lương:</label>
            <input type="text" id="heSoLuong" class="col-md-10" name="heSoLuong" value="<?php echo htmlspecialchars($row['heSoLuong']); ?>">
        </div>
        <button type="submit" class="btn btn-primary m-2 float-end" name="edit">Submit</button>
    </form>
</div>
</body>

</html>

