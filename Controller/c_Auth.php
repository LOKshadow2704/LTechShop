<?php
include_once "./Model/m_Auth.php";
class controllProduct
{
    public function getAllProduct($user, $pass)
    {
        $auth = new modelAuth();
        $isLogin = $auth->login($user, $pass);
        return $isLogin;
    }

    public function register($user, $pass, $repass, $name, $add, $phone)
    {
        $auth = new modelAuth();
        return $auth->register($user, $pass, $repass, $name, $add, $phone);
    }

}
