<?php
    include_once("./Controller/c_Product.php");
    class viewProductinfo{
        function viewOneProduct($id){
            $Product = new controllProduct();
            $tableProduct = $Product -> getOneProduct($id);
            if(!$tableProduct){
                echo("Have some error");
            }elseif($tableProduct==0){
                    echo("0 result");
            }else{
                echo "<div class='product_info'>";
                echo "<h1>Chi tiết sản phẩm</h1>";
                while($row = mysql_fetch_assoc($tableProduct)) { 
                    if($count == 0) {
                        echo "<ul>"; 
                    }
                    echo "<br>";
                    echo "<img width=280px height=200px src=".$row['HinhAnhSP'].">";
                    echo "<br> <p style='color: black'><b>".$row["TenSP"]."</b></p>"; 
                    echo "<br><br>";
                    echo "<br> <p style='color: black'><b>".$row["Mota"]."</b></p>";  
                    echo "<br><br>";
                    echo  "<p style= 'color: red'>".number_format($row["DonGia"],0 , ",",".")." VNĐ</p>";
                    /*echo $Product->displayPrice($row["DonGia"])." VNĐ";*/
                    echo "<br><br> <a href='#'></li>";
                    $count++;
                    if($count % 4 == 0 ) {
                        echo "</ul>";
                        $count = 0;
                    }
                }
                echo"</div>";
                   
                }
            }
        }
    
?>