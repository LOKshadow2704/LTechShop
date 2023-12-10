<?php
class viewRegister{
    function showRegisterPage(){
        if (isset($_SESSION['isLogin']) && $_SESSION['isLogin'] == true) {
            header("Location: index.php?login");
            exit();
        } elseif (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['rePassword'])) {
            include_once "./Controller/c_Auth.php";
            $auth = new controllerAuth();
            $auth->register();
        }
        echo 
        '    
        <div class="login-container">
            <h1>Đăng kí tài khoản</h1>
            <?php if (isset($login_error)): ?>
            <p>
                <?php echo $login_error; ?>
            </p>
            <?php endif;?>
            <form action="" method="post">
                <div class="form-group">
                    <label for="name">Tên</label>
                    <input type="text" id="name" name="name">
                </div>
                <div class="form-group">
                    <label for="phone">Điện thoại</label>
                    <input type="text" id="phone" name="phone">
                </div>
                <div class="form-group">
                    <label for="address">Địa chỉ</label>
                    <input type="text" id="address" name="address">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="rePassword">Nhập lại mật khẩu</label>
                    <input type="password" id="rePassword" name="rePassword" required>
                </div>
                <div class="form-group">
                        Nếu bạn đã có tài khoản, <a href="index.php?login=1" style="color: skyblue"> Đăng nhập </a>
                </div>

                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION["csrf_token"]; ">
                <div class="form-group">
                        <button type="submit" name="sub_login">Đăng kí</button>
                    </div>
            </form>
        </div>';
    }


}
?>


