<?php
class luongController
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
}