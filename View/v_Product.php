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
                    echo "<table>";
                    echo "<tr>";
                    echo "<td>Mã sản phẩm</td><td>Tên sản phẩm</td><td>Loại sản phẩm</td><td>Đơn giá </td><td>Link ảnh sản phẩm </td><td>Nhà cung cấp</td><td>Mô tả</td><td>tác vụ</td>";
                    echo "</tr>";
                    while($row = mysql_fetch_assoc($table)){
                        echo "<tr>";
                        echo "<td>".$row['IDSanPham']."</td><td>".$row['TenSP']."</td><td>".$row['TenDanhMuc']."</td><td>".$row['DonGia']."</td><td>".$row['HinhAnhSP']."</td><td>".$row['NCC']."</td><td>".$row['MoTa']."</td><td><a href='admin.php?update=".$row['ProdID']."'>sửa</a></td><td><a href='admin.php?delete=".$row['ProdID']."' onclick='return confirm(\""."Are you sure you want to Remove?"."\");'>xóa</a></td>";
                        echo "</tr>";
                    }
                    echo "</table>";    
                 }
        }
    }
?>