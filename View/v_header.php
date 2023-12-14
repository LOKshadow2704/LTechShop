<?php
session_start();
    class viewHeader{
        function showHeader(){
            echo "<header>
            <div class='top_header'>
                <div class='logo'>
                    <a href='index.php'>
                    <img src='https://drive.google.com/uc?id=1vyQx2ZQa5S5JWZeL-1TJF2mynjPmJAmS' alt='' width='70%' height='100%'>
                    </a>
                </div>
                <div class='search'>
                    <form action='index.php' method='GET' class='search' onsubmit='return validateSearch()'>
                    <input type='text'  id='txtsearch'  name='txtsearch' placeholder='Tìm kiếm'>
                    <button type='submit'><i class='fa-solid fa-magnifying-glass'></i></button>
                </form>
                </div>
                <div class='top_right_header'>
                    <div class='account'>
                        <a href='index.php?edit-profile'>
                            <i class='fa-solid fa-user' style='color: #ffffff;'></i>
                        </a>";
                        
                        if (isset($_SESSION['isLogin']) && $_SESSION['isLogin'] == true) {
                            echo "<a href='index.php?logout=1'>Đăng xuất</a>";
                        } 
                        if (isset($_REQUEST['logout']) && $_REQUEST['logout'] == 1 || !isset($_SESSION['isLogin']) || $_SESSION['isLogin'] == false) {
                            echo "<a href='index.php?login=1'>Đăng nhập</a><p>|</p><a href='index.php?signup=1'>Đăng ký</a>";
                            $_SESSION['isLogin'] = false;
                        }
                        if (isset($_REQUEST['logout']) && $_REQUEST['logout'] == 1) {
                            session_destroy();
                            echo "<script> window.location.replace('http://localhost:81/LTechShop/index.php');</script>";
                        }
                    echo "</div>
                    <div class='cart'>
                        <a href='index.php?cart'>
                            <i class='fa-solid fa-cart-plus' style='color: #ffffff;'></i>
                            Giỏ hàng
                        </a>
                    </div>
                </div>
            </div>
            <nav>
                <ul>
                    <li> <a href='index.php'>Trang chủ</li></a>
                    <li> <a href='index.php?seller'>Trang người bán</li></a>    
                    <li> <a href='index.php?PP=1'>Đơn mua</li></a>
                    <li> <a href='index.php?edit-profile'>Thông tin tài khoản</li></a>
                </ul>
            </nav>
            
        </header>";
        
        }
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- js điều kiện tìm kiếm -->
    <script>
                    function validateSearch() {
                        var searchTerm = document.getElementById('txtsearch').value;
                        if (searchTerm.trim() === '') {
                            alert('Vui lòng nhập từ khóa tìm kiếm');
                            return false; // Ngăn chặn gửi biểu mẫu nếu trường tìm kiếm trống
                        }
                        return true; // Cho phép gửi biểu mẫu nếu trường tìm kiếm không trống
                    }
            </script>
</body>
</html>