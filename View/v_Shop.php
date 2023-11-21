<?php
    include_once("./Controller/c_Shop.php");

    class viewShop{
        function viewSuggestShop(){
            $pro = new controllShop();
            $table = $pro-> getSuggestShop();
            if(!$table){
                echo "ERROR";
            }elseif(mysql_num_rows($table)==0){
                echo "0 result";
            }else{
                echo "<div class='suggest_shop w-100'> <h1>Shop gợi ý cho bạn</h1>";
                $dem=0;
                echo "<ul>";
                while($row = mysql_fetch_assoc($table)){
                    echo "<li> <a href='index.php?idshop=".$row['IDTaiKhoan']."'>";
                    echo "<h6>".$row['TenDangNhap']."</h6> <br>";
                    echo "<img src=".$row['avt']." alt=".$row['TenDangNhap']." width='280px' height='200px' /> <br>";
                    echo "<a href='#'>Xem Shop </a><br>";
                    $dem++;
                    if($dem==3){
                        echo "</a></li>";
                        $dem=0;
                    }
                }
                
                echo "</ul>";
                echo "</div>";
             }
        }

        function viewoneShop($tk) {
            $Product = new controllShop();
            $tableProduct = $Product->getoneShop($tk);
                if(mysql_num_rows($tableProduct) > 0) {
                    $count = 0;
                    echo "<div class='shop_one'>";
                    while($row = mysql_fetch_assoc($tableProduct)) {
                        
                        if($count == 0) {
                         
                            echo "<ul>"; 
                        }
                        echo "<li> <a href='index.php?pi=".$row['IDSanPham']."'>";
                        echo "<br>";
                        echo "<img width=280px height=200px src=".$row['HinhAnhSP'].">";
                        echo "<br> <p style='color: black'><b>".$row["TenSP"]."</b></p>";  
                        echo "<br><br>";
                        echo  "<p style= 'color: red'>".number_format($row["DonGia"],0 , ",",".")." VNĐ</p>";
                        echo "<br><br><li> <a href=''></li>";
                        $count++;
                        if($count % 4 == 0 ) {
                            echo "</ul>";
                            $count = 0;
                        }
                    }
                    echo"</div>";
                } else {
                    echo "o result";
                }
        }
    }

?>