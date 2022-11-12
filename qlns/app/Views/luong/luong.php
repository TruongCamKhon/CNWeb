<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Lương</title>

    <link href="../../../public/Style/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
<div class="container">
    <h1 class="text-center text-danger" data-wow-duration="1s">Quản lý lương</h1>
    <div class="d-flex mb-2 center">
        <a href="http://localhost/qlns/" class="btn btn-success me-2" style="width: 76.05px; height: 38px;">Home</a>
        <form method="POST" action="http://localhost/qlns/app/Views/luong/searchLuong.php" class="d-flex">
            <input class="form-control me-2" name="key" style="width: 600px;">
            <button class="btn btn-success" type="submit">Search</button>
        </form>
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
        include '../../Controllers/luongController.php';
        $luongController = new luongController();
        $conn = $luongController->createPDO();

        $per_page = !empty($_GET['per_page']) && $_GET['per_page']>0 ?$_GET['per_page']:5; //Số NV trên 1 trang
        $current_page = !empty($_GET['current_page'])?$_GET['current_page']:1; //trang hiện tại
        $offset = ($current_page - 1) * $per_page; //bất đầu
        $sql = "SELECT nhanvien.msnv, nhanvien.hoten, nhanvien.gioiTinh, chucvu.tenCV, luong.heSoLuong*1400000*119.5 DIV 100 AS tienLuong 
                        FROM nhanvien 
                        JOIN chucvu ON nhanvien.maCV = chucvu.maCV 
                        JOIN luong ON luong.maCV = chucvu.maCV
                        ORDER BY nhanvien.msnv ASC LIMIT " . $per_page . " OFFSET " . $offset ;

        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $sql1 = "SELECT * FROM nhanvien";
        $total = $conn->prepare($sql1);
        $total->execute();
        $total = $total->rowCount(); //tổng số nhân viên

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

