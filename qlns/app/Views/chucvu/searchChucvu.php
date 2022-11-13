<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Nhân viên</title>

    <link href="../../../public/Style/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
<?php $key = !empty($_POST['key'])?$_POST['key']:$_GET['key']; ?>
<div class="container">
    <h1 class="text-center text-danger" data-wow-duration="1s">Quản lý chức vụ</h1>
    <h4 class="text-center text-danger" data-wow-duration="1s">Kết quả cho từ khóa "<?= $key ?>" là</h4>
    <div>
        <div class="float-start mb-2">
            <a href="http://localhost/qlns/" class="btn btn-success me-2" style="width: 76.05px; height: 38px;">Home</a>
            <a href="http://localhost/qlns/app/Views/chucvu/chucvu.php" class="btn btn-success" style="width: 76.05px; height: 38px;">Back</a>
        </div>
        <a href="http://localhost/qlns/app/Views/chucvu/addChucvu.php" class="float-end btn btn-success mb-2" style="width: 76.05px; height: 38px;">Add</a>
    </div>
    <table class="table table-bordered table-condensed">
        <thead>
        <tr>
            <th>Mã chức vụ</th>
            <th>Tên chức vụ</th>
            <th>Hệ số lương</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        include '../../Controllers/chucvuController.php';
        $chucvuController = new chucvuController();
        $conn = $chucvuController->createPDO();

        $per_page = !empty($_GET['per_page']) && $_GET['per_page']>0 ?$_GET['per_page']:5; //Số NV trên 1 trang
        $current_page = !empty($_GET['current_page'])?$_GET['current_page']:1; //trang hiện tại
        $offset = ($current_page - 1) * $per_page; // bất đầu

        $sql = "SELECT chucvu.maCV, chucvu.tenCV, luong.heSoLuong, luong.id
                FROM chucvu, luong
                WHERE chucvu.maCV = luong.maCV AND (chucvu.maCV = '$key' OR chucvu.tenCV = '$key')";

        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $total = $stmt->rowCount();

        $num_page = ceil($total/$per_page);

        while($item = $stmt-> fetch(PDO::FETCH_ASSOC)) {
            echo
                "<tr>
                    <td>" . $item['maCV'] . "</td>
                    <td>" . $item['tenCV'] . "</td>
                    <td>" . $item['heSoLuong'] . "</td>
                    <td><a class='btn btn-danger' href='http://localhost/qlns/app/Views/chucvu/editChucvu.php
                        /?macv=" . $item['maCV'] . "&id=" . $item['id'] . "&per_page=" . $per_page . "&current_page=" . $current_page . "'>Edit</a>
                        <a class='btn btn-danger' href='http://localhost/qlns/app/Views/chucvu/deleteChucvu.php
                        /?macv=" . $item['maCV'] . "&id=" . $item['id'] . "&per_page=" . $per_page . "&current_page=" . $current_page . "'>Delete</a>
                    </td>
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

