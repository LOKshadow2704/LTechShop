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
        <h1>Account Login</h1>
        <?php if (isset($login_error)): ?>
        <p>
            <?php echo $login_error; ?>
        </p>
        <?php endif; ?>
        <form action="login.php" method="post">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <div class="form-group">
                <input type="submit" value="Sign in">
            </div>
        </form>
    </div>
</body>

</html>