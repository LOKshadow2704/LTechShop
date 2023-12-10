<?php
class viewForgetPassword
{
    public function showForgetPassword()
    {
        if (isset($_POST['email'])) {
            include_once "./Controller/c_Auth.php";
            $auth = new controllerAuth();
            $email = $_POST['email'];
            if ($auth->forgetPassword($email)) {
                echo '<script type="text/javascript">alert("Kiểm tra gmail của bạn để nhận mật khẩu");</script>';
            } else {
                echo '<script type="text/javascript">alert("Email không tìm thấy");</script>';
            }
        }
        echo
            '
        <body>
            <div class="login-container">
                <h1>Quên Mật Khẩu</h1>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" id="email" name="email" required>
                    </div>
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION["csrf_token"]; ">
                    <div class="form-group">
                        <button type="submit" name="sub_login">Xác nhận</button>
                    </div>
                </form>
            </div>
        </body>
        ';

    }
}
