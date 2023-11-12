<?php
if (isset($_SESSION['isLogin']) && $_SESSION['isLogin'] == true) {
    header("Location: index.php");
    exit();
} elseif (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['rePassword'])) {
    include_once "./Model/m_auth.php";
    $auth = new modelAuth();
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repassword = $_POST['rePassword'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    if ($password != $repassword) {
        $login_error = "Xin vui lý nhập lại đúng mật khẩu";
        echo '<script type="text/javascript">alert("' . $login_error . '");</script>';
        return;
    }
    $rs = $auth->register($email, $password, $repassword, $name, $address, $phone);
    if ($rs) {
        $_SESSION['isLogin'] = true;
        header("Location: index.php");
        exit();
    } else {
        $_SESSION['isLogin'] = false;
        $login_error = "Lỗi hệ thống vui lòng kiểm tra lại";
        echo '<script type="text/javascript">alert("' . $login_error . '");</script>';
    }

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Amazon Style Login Page</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #fff;
        }

        .login-container {
            width: 350px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .login-container h1 {
            font-size: 28px;
            font-weight: 400;
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 14px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #111;
        }

        .form-group input {
            width: 100%;
            height: 31px;
            padding: 3px 7px;
            font-size: 13px;
            line-height: normal;
            border: 1px solid #a6a6a6;
            border-top-color: #949494;
            border-radius: 3px;
        }

        .form-group input[type="submit"] {
            background-color: #f0c14b;
            border-color: #a88734 #9c7e31 #846a29;
            color: #111;
        }

        .form-group input[type="submit"]:hover {
            background-color: #e7b50d;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h1>Account Register</h1>
        <?php if (isset($login_error)): ?>
        <p>
            <?php echo $login_error; ?>
        </p>
        <?php endif;?>
        <form action="" method="post">
            <div class="form-group">
                <label for="name">Your Name</label>
                <input type="text" id="name" name="name">
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" id="phone" name="phone">
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="rePassword">Re Password</label>
                <input type="password" id="rePassword" name="rePassword" required>
            </div>

            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <div class="form-group">
                <input type="submit" value="Sign up">
            </div>
        </form>
    </div>
</body>

</html>