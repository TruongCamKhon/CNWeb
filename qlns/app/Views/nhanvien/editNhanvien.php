<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Edit Nhân viên</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
<?php
include '../../Controllers/nhanvienController.php';
$id = $_GET['id'];
$nhanvienController = new nhanvienController();
$showDBEdit = $nhanvienController->showDBEdit($id);

$nhanvienController->edit();
?>
<div class="container">
    <h1 class="text-center text-danger" data-wow-duration="1s">Edit nhân viên</h1>

    <form method="POST" action="">
        <?php $row = $showDBEdit->fetch() ?>
        <div class="row m-2 mx-autu">
            <label class="col-md-2" for="msnv">MSNV:</label>
            <input type="number" id="msnv" class="col-md-10" name="msnv" value="<?php echo htmlspecialchars($row['msnv']); ?>">
        </div>
        <div class="row m-2">
            <label class="col-md-2" for="hoten">Tên:</label>
            <input type="text" id="hoten" class="col-md-10" name="hoten" value="<?php echo htmlspecialchars($row['hoten']); ?>">
        </div>
        <div class="row m-2">
            <p class="col-2">Giới tính:</p>
            <div class="col-1">
                <input type="radio" id="nam" name="gioiTinh" value="Nam" <?php if($row['gioiTinh']=='Nam'){echo 'checked';} ?>>
                <label for="nam">Nam</label>
            </div>
            <div class="col-1">
                <input type="radio" id="nu" name="gioiTinh" value="Nữ" <?php if($row['gioiTinh']=='Nữ'){echo 'checked';} ?>>
                <label for="nu">Nữ</label>
            </div>
        </div>
        <div class="row m-2">
            <label class="col-md-2" for="ngaySinh">Ngày sinh:</label>
            <input type="date" id="ngaySinh" class="col-md-10" name="ngaySinh" value="<?php echo htmlspecialchars($row['ngaySinh']); ?>">
        </div>
        <div class="row m-2">
            <label class="col-md-2" for="noiSinh">Nơi sinh:</label>
            <input type="text" id="noiSinh" class="col-md-10" name="noiSinh" value="<?php echo htmlspecialchars($row['noiSinh']); ?>">
        </div>
        <div class="row m-2">
            <label class="col-md-2" for="diaChi">Địa chỉ:</label>
            <input type="text" id="diaChi" class="col-md-10" name="diaChi" value="<?php echo htmlspecialchars($row['diaChi']); ?>">
        </div>
        <div class="row m-2">
            <label class="col-md-2" for="sdt">SDT:</label>
            <input type="number" id="sdt" class="col-md-10" name="sdt" value="<?php echo htmlspecialchars($row['sdt']); ?>">
        </div>
        <div class="row m-2">
            <label for="maCV" class="col-2">Chức vụ:</label>
            <select class="col-2" name="maCV" id="maCV">
                <?php
                $conn = $nhanvienController->createPDO();
                $sql = "SELECT tenCV, maCV FROM chucvu";
                $stml = $conn->prepare($sql);
                $stml->execute();
                while($item = $stml-> fetch(PDO::FETCH_ASSOC)) {
                    if($item['maCV'] == $row['maCV']){
                        echo "<option selected='selected' value='" . $item['maCV'] . "'>" . $item['tenCV'] . "</option>";
                    }else{
                        echo "<option value='" . $item['maCV'] . "'>" . $item['tenCV'] . "</option>";
                    }
                }
                $conn = null;
                ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary m-2 float-end" name="edit">Submit</button>
    </form>
</div>
</body>

</html>

