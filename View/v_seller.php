<?php
    class viewSeller{
        function leftMenu(){
            echo "
                <div class='leftMenu'>
                 <h4> <i class='fa-solid fa-bars'></i> Danh mục</h4>
                    <ul>
                        <li> <a href='index.php?MP=1'><i class='fa-solid fa-briefcase'></i>&ensp;Quản lý sản phẩm của bạn</a></li>
                        <li> <a href='index.php?MPO=1'> <i class='fa-solid fa-basket-shopping'></i>&ensp;Đơn bán</a></li>
                        <li> <a href='index.php?show=1'><i class='fa-solid fa-sack-dollar'></i>&ensp;Doanh thu</a></li>
                        <li> <a href='index.php?salesproduct=1'><i class='fa-brands fa-sellsy'></i>&ensp;Sản phẩm đã bán ra</a></li>
                    </ul>
                </div>

            ";
        }
    }
?>