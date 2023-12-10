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
            if ($table) {
                if (mysql_num_rows($table) > 0) {
                    return true;
                }
            }

        }
        return false;
    }

    public function register($user, $pass, $repass, $name, $add, $phone)
    {
        $connect;
        $cn_Auth = new clsconnect();
        if ($cn_Auth->connect($connect)) {
            $query_check = "SELECT * FROM taikhoan WHERE TenDangNhap = '$user'";
            $result_check = mysql_query($query_check);
            if (mysql_num_rows($result_check) > 0) {
                echo "<script>alert('Gmail đã được sử dụng')</script>";
                return false;
            }

            $query = "INSERT INTO taikhoan(TenDangNhap, MatKhau, HoTen, DiaChi, DienThoai) VALUES('$user', '$pass', '$name', '$add', '$phone')";
            $table = mysql_query($query);
            $cn_Auth->disconnect($connect);
            if ($table) {
                return true;
            }
        }
        return false;

    }

    public function forgetPassword($email)
    {
        $connect;
        $cn_Auth = new clsconnect();
        if ($cn_Auth->connect($connect)) {
            $query = "SELECT * FROM taikhoan WHERE TenDangNhap = '$email'";
            $haveUser = mysql_query($query);

            if ($haveUser) {
                if (mysql_num_rows($haveUser) > 0) {
                    $newPass = $this->generateRandomString();
                    $query = "UPDATE taikhoan SET MatKhau = '$newPass' WHERE TenDangNhap = '$email'";
                    $table = mysql_query($query);
                    include_once './services/email_service.php';
                    sendEmail($email, 'Reset Password', 'Your new password is: ' . $newPass);
                    if ($table) {
                        $cn_Auth->disconnect($connect);
                        return true;
                    }
                }
                $cn_Auth->disconnect($connect);
                return false;
            }
        }
        $cn_Auth->disconnect($connect);

        return false;

    }

    public function generateRandomString($length = 6)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $randomString;
    }

    public function getInforUser($uname)
    {
        $connect;
        $cn_Auth = new clsconnect();
        if ($cn_Auth->connect($connect)) {
            $query = "SELECT HoTen,  DiaChi,  DienThoai, avt FROM taikhoan WHERE TenDangNhap = '$uname'";
            $table = mysql_query($query);
            $cn_Auth->disconnect($connect);
            if ($table) {
                if (mysql_num_rows($table) > 0) {
                    return $table;
                }
            }
        }
    }

    public function updateInforUser($uname, $name, $add, $phone)
    {
        $connect;
        $cn_Auth = new clsconnect();
        if ($cn_Auth->connect($connect)) {
            $query = "UPDATE `taikhoan` SET `HoTen` = '$name', `DiaChi` = '$add', `DienThoai` = '$phone' WHERE `TenDangNhap` = '$uname'";
            $table = mysql_query($query);
            $cn_Auth->disconnect($connect);
            if ($table) {
                return true;
            }
        }
    }

    public function updateInforUserHasPass($uname, $name, $add, $pass, $phone)
    {
        $connect;
        $cn_Auth = new clsconnect();
        if ($cn_Auth->connect($connect)) {
            $query = "UPDATE `taikhoan` SET `HoTen` = '$name', `DiaChi` = '$add', `DienThoai` = '$phone', `MatKhau` = '$pass' WHERE `TenDangNhap` = '$uname'";
            $table = mysql_query($query);
            $cn_Auth->disconnect($connect);
            if ($table) {
                return true;
            }
        }
    }

}
