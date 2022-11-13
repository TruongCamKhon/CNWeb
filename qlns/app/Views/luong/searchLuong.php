<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Search lương</title>

    <link href="../../../public/Style/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
<?php $key = !empty($_POST['key'])?$_POST['key']:$_GET['key']; ?>
<div class="container">
    <h1 class="text-center text-danger" data-wow-duration="1s">Quản lý lương</h1>
    <h4 class="text-center text-danger" data-wow-duration="1s">Kết quả cho từ khóa "<?= $key ?>" là</h4>
    <div>
        <div class="float-start mb-2">
            <a href="http://localhost/qlns/" class="btn btn-success me-2" style="width: 76.05px; height: 38px;">Home</a>
            <a href="http://localhost/qlns/app/Views/luong/luong.php" class="btn btn-success" style="width: 76.05px; height: 38px;">Back</a>
        </div>
    </div>
    <table class="table table-bordered table-condensed">
        <thead>
        <tr>
            <th>MSNV</th>
            <th>Tên</th>
            <th>Giới tính</th>
            <th>Chức vụ</th>
            <th>Lương</th>
        </tr>
        </thead>
        <tbody>
        <?php
        include '../../Controllers/nhanvienController.php';
        $nhanvienController = new nhanvienController();
        $conn = $nhanvienController->createPDO();

        $per_page = !empty($_GET['per_page']) && $_GET['per_page']>0 ?$_GET['per_page']:5; //Số NV trên 1 trang
        $current_page = !empty($_GET['current_page'])?$_GET['current_page']:1; //trang hiện tại
        $offset = ($current_page - 1) * $per_page; //sản phẩm bất đầu

        $sql = "SELECT nhanvien.msnv, nhanvien.hoten, nhanvien.gioiTinh, chucvu.tenCV, luong.heSoLuong*1400000*119.5 DIV 100 AS tienLuong 
                    FROM nhanvien, chucvu, luong
                    WHERE nhanvien.maCV = chucvu.maCV 
	                AND nhanvien.maCV = luong.maCV
                    AND (nhanvien.msnv = '$key' OR nhanvien.hoten = '$key' OR nhanvien.gioitinh = '$key' OR nhanvien.maCV = '$key')";

        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $total = $stmt->rowCount();

        $num_page = ceil($total/$per_page);

        while($item = $stmt-> fetch(PDO::FETCH_ASSOC)) {
            echo
                "<tr>
                    <td>" . $item['msnv'] . "</td>
                    <td>" . $item['hoten'] . "</td>
                    <td>" . $item['gioiTinh'] . "</td>
                    <td>" . $item['tenCV'] . "</td>
                    <td>" . number_format($item['tienLuong'], 0, ',', '.') . " VND" . "</td>
                </tr>";
        }
        $conn = null;
        ?>
        </tbody>
    </table>
    <ul class="pagination" style="display: flex; justify-content: center; align-items: center;">
        <?php for ($i = 1; $i <= $num_page; $i++){ ?>
            <?php if($i != $current_page){ ?>
                <li class="page-item"><a class="page-link" href="?per_page=<?= $per_page ?>&current_page=<?= $i ?>"><?= $i ?></a></li>
            <?php } else { ?>
                <li class="page-item active"><a class="page-link" href="?per_page=<?= $per_page ?>&current_page=<?= $i ?>"><?= $i ?></a></li>
            <?php } ?>
        <?php } ?>
    </ul>
</div>
</body>
</html>

