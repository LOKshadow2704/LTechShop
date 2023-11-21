<?php
include_once "./Model/m_Auth.php";
class controllerAuth
{
    public function login()
    {
        $auth = new modelAuth();
        $email = $_POST['email'];
        $password = $_POST['password'];
        $isLogin = $auth->login($email, $password);
        if ($isLogin) {
            $_SESSION['isLogin'] = true;
            header("Location: index.php");
        } else {
            $_SESSION['isLogin'] = false;
            $login_error = "Đăng nhập không thành công. Kiểm tra lại thông tin!";
            echo '<script type="text/javascript">alert("' . $login_error . '");</script>';
        }
    }

    public function register()
    {
        $auth = new modelAuth();
        $email = $_POST['email'];
        $password = $_POST['password'];
        $repassword = $_POST['rePassword'];
        $name = $_POST['name'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        if(strlen($password) < 6) {
            $login_error = "Mật khẩu ít nhất là 6 kí tự.";
            echo '<script type="text/javascript">alert("' . $login_error . '");</script>';
            return;
        }
        if ($password != $repassword) {
            $login_error = "Xin vui lý nhập lại đúng mật khẩu";
            echo '<script type="text/javascript">alert("' . $login_error . '");</script>';
            return;
        }
        $rs = $auth->register($email, $password, $repassword, $name, $address, $phone);
        if ($rs) {
            $_SESSION['isLogin'] = true;
            header("Location: index.php");
        } else {
            $_SESSION['isLogin'] = false;
            $login_error = "Lỗi hệ thống vui lòng kiểm tra lại";
            
        }

    }
}
