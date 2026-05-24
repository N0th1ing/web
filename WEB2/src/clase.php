<?php
include_once "connect.php";

class User 
{
    private $con;

    public function __construct($con)
    {
        $this->con = $con;
    }
    public function getAll()
    {
        $sql = "SELECT * FROM user";
        $result = mysqli_query($this->con, $sql);
        return $result;
    }
    public function delete($id)
    {
        $sql = "DELETE FROM user WHERE id=$id";
        return mysqli_query($this->con, $sql);
    }
}


class Imagine 
{
    private $con;

    public function __construct($con)
    {
        $this->con = $con;
    }
    public function getAll()
    {
        $sql = "SELECT * FROM imagini ORDER BY data_upload DESC";
        $result = mysqli_query($this->con, $sql);
        return $result;
    }
    public function insert($username, $nume_fisier)
    {
        $sql = "INSERT INTO imagini (username, nume_fisier) VALUES ('$username', '$nume_fisier')";
        return mysqli_query($this->con, $sql);
    }
}
?>