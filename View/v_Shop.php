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
                $dem=0;
                echo "<ul>";
                while($row = mysql_fetch_assoc($table)){
                    echo "<li> <a href='#'>";
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
             }
        }
        }

?>