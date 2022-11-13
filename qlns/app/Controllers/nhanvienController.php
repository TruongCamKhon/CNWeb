<?php
class nhanvienController
{
    public function createPDO()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "qlnhansu";

        $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $conn;
    }

    public function showDBEdit($msnv){
        $conn = $this->createPDO();
        $sql = "SELECT *
                FROM nhanvien
                WHERE msnv = '$msnv' ";

        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $conn = null;
        return $stmt;
    }

    public function edit()
    {
        if(isset($_POST['edit'])){
            $msnv = $_POST['msnv'];
            $hoten = $_POST['hoten'];
            $gioiTinh = $_POST['gioiTinh'];
            $ngaySinh = $_POST['ngaySinh'];
            $noiSinh = $_POST['noiSinh'];
            $diaChi = $_POST['diaChi'];
            $sdt = $_POST['sdt'];
            $maCV = $_POST['maCV'];

            $per_page = "?per_page=" . $_GET['per_page'];
            $current_page = "&current_page=" . $_GET['current_page'];

            $conn = $this->createPDO();

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "UPDATE nhanvien
                SET hoten = '$hoten',
                    gioiTinh = '$gioiTinh',
                    ngaySinh = '$ngaySinh',
                    noiSinh = '$noiSinh',
                    diaChi = '$diaChi',
                    sdt = '$sdt',
                    maCV = '$maCV'
                WHERE msnv = '$msnv'";

            $stmt = $conn->prepare($sql);

            $stmt->execute();

            $conn = null;

            header("location: http://localhost/qlns/app/Views/nhanvien/nhanvien.php$per_page$current_page");
        }
    }

    public function add()
    {
        if(isset($_POST['add'])){
            $hoten = $_POST['hoten'];
            $gioiTinh = $_POST['gioiTinh'];
            $ngaySinh = $_POST['ngaySinh'];
            $noiSinh = $_POST['noiSinh'];
            $diaChi = $_POST['diaChi'];
            $sdt = $_POST['sdt'];
            $maCV = $_POST['maCV'];

            $conn = $this->createPDO();

            $sql = "SELECT msnv INTO @last_msnv FROM nhanvien ORDER BY msnv DESC LIMIT 1;
                INSERT INTO nhanvien (msnv, hoten, gioiTinh, ngaySinh, noiSinh, diaChi, sdt, maCV)
                VALUES (@last_msnv+1,'$hoten', '$gioiTinh', '$ngaySinh', '$noiSinh', '$diaChi', '$sdt', '$maCV')";

            $conn->exec($sql);

            $sql1 = "SELECT * FROM nhanvien";
            $total = $conn->prepare($sql1);
            $total->execute();
            $total = $total->rowCount(); //tổng số nhân viên

            $per_page= "?per_page=5";
            $current_page = "&current_page=" . ceil($total/5);

            $conn = null;
            header("location: http://localhost/qlns/app/Views/nhanvien/nhanvien.php$per_page$current_page");
        }
    }

    public function delete()
    {
        $id = $_GET['id'];

        $conn = $this->createPDO();

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "DELETE FROM nhanvien WHERE msnv=$id";

        $conn->exec($sql);

        $conn = null;
    }

}