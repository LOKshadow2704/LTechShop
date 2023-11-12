<?php
    include_once("./Controller/c_Product.php");
    class viewProduct{
        function getProductbyManager(){
                $pro = new controllProduct();
                $table = $pro->getProductbyManager();
                if(!$table){
                    echo "ERROR";
                }elseif(mysql_num_rows($table)==0){
                    echo "0 result";
                }else{
                    echo "<button class='button-68 add' role='button'>Thêm sản phẩm mới</button>";
                    echo "<table class='table_product'>";
                    echo "<thead>";
                    echo "<tr>";
                    echo "<td>Mã sản phẩm</td><td>Tên sản phẩm</td><td>Loại sản phẩm</td><td>Đơn giá </td><td>Ảnh sản phẩm </td><td>Nhà cung cấp</td><td>Tác vụ</td>";
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    while($row = mysql_fetch_assoc($table)){
                        echo "<tr>";
                        echo "<td>".$row['IDSanPham']."</td><td>".$row['TenSP']."</td><td>".$row['TenDanhMuc']."</td><td>".$row['DonGia']."</td><td><img src='".$row['HinhAnhSP']."' width='100%'></td><td>".$row['NCC']."</td><td><div class='act'><a href='admin.php?update=".$row['ProdID']."'><button class='button-68 update' role='button'>Chỉnh sửa</button></a> <a href='admin.php?delete=".$row['ProdID']."' onclick='return confirm(\""."Are you sure you want to Remove?"."\");'><button class='button-68 delete' role='button'>Xóa</button></a></div></td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";    
                 }
        }

        function viewSuggestProduct() {
            $Product = new controllProduct();
            $tableProduct = $Product->getSuggestProduct();
                if(mysql_num_rows($tableProduct) > 0) {
                    $count = 0;
                    while($row = mysql_fetch_assoc($tableProduct)) {
                        echo "<div class='Suggest_product'>";
                        if($count == 0) {
                            echo "<ul>"; 
                        }
                        echo "<li> <a href='index.php?pi=".$row['IDSanPham']."'>";
                        echo "<br>";
                        echo "<img width=280px height=200px src=".$row['HinhAnhSP'].">";
                        echo "<br> <p style='height: 15px'><b>".$row["TenSP"]."</b></p>";  
                        echo "<br><br>";
                        echo $Product->$row["DonGia"]." VNĐ";
                        echo "<br><br> <a href='#'></li>";
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