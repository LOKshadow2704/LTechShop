<?php
class viewProfile
{
    public function showPage()
    {
        if (isset($_SESSION['isLogin']) && $_SESSION['isLogin'] == true) {
            include_once "./Controller/c_Auth.php";
            $c_Auth = new controllerAuth();
            $user = $c_Auth->getUserInfo($_SESSION['uname']);
            $row = mysql_fetch_assoc($user);
        } else {
            header("Location: index.php?login=1");
        }

        if (isset($_POST['submit'])) {
            include_once "./Controller/c_Auth.php";
            $c_Auth = new controllerAuth();
            if (isset($_REQUEST['action'])&& $_REQUEST['action']) {
                if ($_POST['password'] == $_POST['confirm_password']) {
                    $pass = $_POST['password'];
                    if(strlen($pass) < 6)
                    {
                        echo '<script type="text/javascript">alert("Mật khẩu phải nhiều hơn 6 kí tự");</script>';
                        echo '<script type="text/javascript">window.location.href = "index.php?edit-profile";</script>';
                        return;
                    }
                    $c_Auth->updateInforUserHasPass($_SESSION['uname'], $_POST['name'], $_POST['address'], $_POST['password'], $_POST['phone']);
                    echo '<script type="text/javascript">alert("Cập nhật  mật khẩu thành công");</script>';
                    echo '<script type="text/javascript">window.location.href = "index.php?edit-profile";</script>';
                } else {
                    echo '<script type="text/javascript">alert("Xác nhận mật khẩu không đúng");</script>';
                }
            } else {
                $c_Auth->updateProfile($_SESSION['uname'], $_POST['name'], $_POST['address'], $_POST['phone']);
                echo '<script type="text/javascript">alert("Cập nhật thành công");</script>';
                echo '<script type="text/javascript">window.location.href = "index.php?edit-profile";</script>';
            }
        }

        echo '
    <div class="profile">
        <img src=' .
            $row['avt'] .
            ' alt="Avatar" class="avatar">
        <h2>Chỉnh sửa thông tin của bạn</h2>
        <form method="post">
            <div class="mb-3 row">
                <label for="name" class="col-md-2 col-form-label">Họ Tên:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" value="' .
            $row['HoTen'] .
            '">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="address" class="col-md-2 col-form-label">Địa Chỉ:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="address" name="address" value="' .
            $row['DiaChi'] .
            '">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="phone" class="col-md-2 col-form-label">Điện Thoại:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="phone" name="phone" value="' .
            $row['DienThoai'] .
            '">
                </div>
            </div>
    ';
        if (isset($_REQUEST['action'])) {
            echo '
            <div class="mb-3 row">
                <label for="password" class="col-md-2 col-form-label">Mật Khẩu Mới:</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="confirm_password" class="col-md-2 col-form-label">Nhập Lại Mật Khẩu:</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                </div>
            </div>
            ';
        }

        echo '

            <div class="mb-3 row">
                <div class="offset-sm-2 col-sm-10">
                    <button name="submit" type="submit" class="btn btn-primary">Lưu</button>
                </div>
               
            </div>
            <div class="form-group">
                Đổi mật khẩu <a href="index.php?edit-profile&action=change-password" style="color: skyblue"> Đổi mật khẩu </a>
            </div>
    </form>

    </div>
';
    }
}
?>
