<?php
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
                        <input type='text' name='txtsearch' id='txtsearch' placeholder='Tìm kiếm'>
                        <button type='submit'><i class='fa-solid fa-magnifying-glass'></i></button>
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
                    <li> <a href='index.php?PP=1'>Đơn mua</li></a>
                </ul>
            </nav>
            
        </header>";
        }
    }
    ?>
