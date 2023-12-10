<?php
    class viewHeader{
        function showHeader(){
            echo "<header>
            <div class='top_header'>
                <div class='logo'>
                    <a href='index.php'>
                    <img src='https://drive.google.com/uc?id=1aUYwPUSM7I2EwjLx_XuUB75XkRmrWF2t' alt='' width='70%' height='100%'>
                    </a>
                </div>
                <div class='search'>
                    <form action='index.php' method='GET' class='search'>
                    <input type='text' name='txtsearch' placeholder='Tìm kiếm'>
                    <i class='fa-solid fa-magnifying-glass'></i>
                </form>
                </div>
                <div class='top_right_header'>
                    <div class='account'>
                        <a href=''>
                            <i class='fa-solid fa-user' style='color: #ffffff;'></i>
                        </a>";
                        
                        if($_SESSION['isLogin']==true){
                            echo "<a href='index.php?logout=1'>Đăng xuất</a>";
                        }
        
                        if($_REQUEST['logout']==1 || $_SESSION['isLogin'] == false) {
                            echo "<a href='index.php?login=1'>Đăng nhập</a><p>|</p><a href='index.php?signup=1'>Đăng ký</a>";
                            $_SESSION['isLogin'] = false;
                        }
        
                        if($_REQUEST['logout']==1){
                            session_destroy();
                            header("Location:index.php");
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
                    <li> <a href='index.php?PP'>Đơn mua</li></a>
                </ul>
            </nav>
            
        </header>";
        }
    }
    //<li> <a href='index.php?MP=1'>Quản lý sản phẩm của bạn</li></a>
    //<li> <a href='index.php?MPO=1'>Đơn bán</li></a>
   
?>