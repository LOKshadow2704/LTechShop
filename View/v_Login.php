
<?php
class viewLogin{
    function showLoginPage(){
        if ( $_SESSION['isLogin'] == true) {
            echo "<script>alert('Đăng nhập thành công')</script>";
            header("Location: index.php");
        }
        if (isset($_POST['email']) && isset($_POST['password'])) {
            include_once "./Controller/c_auth.php";
            $auth = new controllerAuth();
            $auth->login();
        }

        echo
        '
        <body>
            <div class="login-container">
                <h1>Đăng nhập</h1>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Mật khẩu</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        Nếu bạn chưa có tài khoản, <a href="index.php?signup=1" style="color: skyblue"> Tạo tài khoản </a>
                    </div>
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION["csrf_token"]; ">
                    <div class="form-group">
                        <button type="submit" name="sub_login">Đăng nhập</button>
                    </div>
                </form>
            </div>
        </body>
        ';

        
    }
}
?>


