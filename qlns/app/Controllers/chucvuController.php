<?php
class chucvuController
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

    public function showDBEdit($maCV){
        $conn = $this->createPDO();
        $sql = "SELECT chucvu.maCV, chucvu.tenCV, luong.heSoLuong
                FROM chucvu, luong
                WHERE chucvu.maCV = luong.maCV AND chucvu.maCV = '$maCV'";

        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $conn = null;
        return $stmt;
    }

    public function edit($macv)
    {
        if(isset($_POST['edit'])){
            $maCV = $_POST['maCV'];
            $tenCV = $_POST['tenCV'];
            $heSoLuong = $_POST['heSoLuong'];

            $id = $_GET['id'];

            $per_page = "?per_page=" . $_GET['per_page'];
            $current_page = "&current_page=" . $_GET['current_page'];

            $conn = $this->createPDO();
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "DELETE FROM luong WHERE luong.id = '$id';
                    DELETE FROM chucvu WHERE chucvu.maCV = '$macv';
                    INSERT INTO chucvu(chucvu.maCV, chucvu.tenCV)
                        VALUES ('$maCV', '$tenCV');
                    INSERT INTO luong(luong.id, luong.heSoLuong, luong.maCV)
                        VALUES ('$id', '$heSoLuong', '$maCV');";
            $conn->exec($sql);

            $conn = null;

            header("location: http://localhost/qlns/app/Views/chucvu/chucvu.php$per_page$current_page");
        }
    }

    public function add()
    {
        if(isset($_POST['add'])){
            $tenCV = $_POST['tenCV'];
            $maCV = $_POST['maCV'];
            $heSoLuong = $_POST['heSoLuong'];

            $conn = $this->createPDO();

            $sql = "INSERT INTO chucvu (tenCV, maCV)
                    VALUES ('$tenCV', '$maCV')";

            $conn->exec($sql);

            $sql1 = "SELECT id INTO @last_id FROM luong ORDER BY id DESC LIMIT 1;
                    INSERT INTO luong (id, heSoLuong, maCV)
                    VALUES (@last_id+1,'$heSoLuong', '$maCV')";

            $conn->exec($sql1);

            $sql2 = "SELECT * FROM `chucvu`";
            $stmt = $conn->prepare($sql2);
            $stmt->execute();
            $total = $stmt->rowCount(); //tổng số nhân viên

            $per_page= "?per_page=5";
            $current_page = "&current_page=" . ceil($total/5);

            $conn = null;
            header("location: http://localhost/qlns/app/Views/chucvu/chucvu.php$per_page$current_page");
        }
    }

    public function delete($id, $macv)
    {
        $conn = $this->createPDO();

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "DELETE FROM luong WHERE id='$id';
                DELETE FROM chucvu WHERE maCV='$macv'";

        $conn->exec($sql);

        $conn = null;
    }
}