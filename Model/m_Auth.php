<?php
include_once "connect_db.php";
class modelAuth
{
    public function login($user, $pass)
    {
        $connect;
        $cn_Auth = new clsconnect();
        if ($cn_Auth->connect($connect)) {
            $query = "SELECT * FROM taikhoan WHERE TenDangNhap = '$user' AND MatKhau = '$pass'";
            $table = mysql_query($query);
            $cn_Auth->disconnect($connect);
            return $table;
        }
        return false;
    }

    public function register($user, $pass, $repass, $name, $add, $phone)
    {
        $connect;
        $cn_Auth = new clsconnect();
        if ($cn_Auth->connect($connect)) {
            $query = "INSERT INTO taikhoan(TenDangNhap, MatKhau, HoTen, DiaChi, DienThoai) VALUES('$user', '$pass', '$name', '$add', '$phone')";
            $table = mysql_query($query);
            $cn_Auth->disconnect($connect);
            if ($table) {
                return true;
            }
        }
        return false;

    }
}
