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
        if (!$isLogin) {
            $_SESSION['isLogin'] = false;
            $login_error = "Đăng nhập không thành công. Kiểm tra lại thông tin!";
            echo '<script type="text/javascript">alert("' . $login_error . '");</script>';
        } else {
            $row = mysql_fetch_assoc($isLogin);
            if ($isLogin) {
                $_SESSION['isLogin'] = true;
                $_SESSION['idLogin'] = $row['IDTaiKhoan'];
                $_SESSION['uname'] = $email;
                echo "<script>alert('Đăng nhập tài khoản thành công!')</script>";
                echo "<script>window.location.href = 'index.php';</script>";
    
            }
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
        
        $rs = $auth->register($email, $password, $repassword, $name, $address, $phone);
        if ($rs) {
            $_SESSION['isLogin'] = true;
            $_SESSION['uname'] = $email;
            echo "<script>alert('Đăng kí thành công!')</script>";
            echo "<script>window.location.href = 'index.php';</script>";
        } else {
            $_SESSION['isLogin'] = false;
            echo "<script>alert('Đăng kí tài khoản thất bại. Vui lòng đăng kí lại!')</script>";
            echo "<script>window.location.href = 'index.php?signup=1';</script>";

        }

    }

    public function forgetPassword($email)
    {
        $auth = new modelAuth();
        return $auth->forgetPassword($email);
    }

    public function getUserInfo($uname)
    {
        $auth = new modelAuth();
        return $auth->getInforUser($uname);
    }

    public function updateProfile($uname, $name, $add, $phone)
    {
        $auth = new modelAuth();
        return $auth->updateInforUser($uname, $name, $add, $phone);
    }

    public function updateInforUserHasPass($uname, $name, $add, $pass,$phone){
        $auth = new modelAuth();
        return $auth->updateInforUserHasPass($uname, $name, $add, $pass,$phone);
    }
}
