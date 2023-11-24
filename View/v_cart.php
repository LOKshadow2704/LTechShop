<?php
include_once("./Controller/c_cart.php");
class viewCart{
    function Cart(){
        $Cart = new controllerCart();
        $table = $Cart-> getCart();
        if(!$table){
            echo "ERROR";
        } else {
            // Kiểm tra dữ liệu nhận được từ giỏ hàng:
            // Nếu không có dữ liệu ($table là falsy), in ra "ERROR".
            // Nếu có dữ liệu nhưng không có hàng hóa nào trong giỏ (mysql_num_rows($table)==0), in ra "0 result".
            // Nếu có dữ liệu và có hàng hóa trong giỏ, hiển thị một bảng chứa thông tin về từng sản phẩm trong giỏ.
            $count=0;
            echo "<a href=''><button class='button-68 cart' role='button'>Giỏ hàng</button></a>";
            echo "<br><br>";

            if(mysql_num_rows($table) > 0){
                echo "<table class='table_cart'>";
                echo "<thead>";
                echo"<tr>";      
                       echo "<td>STT</td>";
                       echo "<td>Sản phẩm</td>";
                       echo "<td>Số lượng</td>";
                       echo "<td>Tên sản phẩm</td>";
                       echo "<td>Giá</td>";
                       echo "<td>Giá tổng</td>";
                       echo "<td>Quản lý</td>";
                echo"</tr>";
                echo "</thead>";
                echo "<tbody>";

                while($row = mysql_fetch_assoc($table)){
                    $count++;
                    $tong = $row['SoLuong']*$row['DonGia'];
                    echo "<tr>";
                        echo "<td style='width: 20px'><input type='checkbox' name='selectedProducts[]' value='".$row['IDSanPham']."'></td>";
                        echo "<td>'<img width=240px height=200px src=".$row['HinhAnhSP'].">'</td>";
                        echo "<td>".$row['SoLuong']."</td>";
                        echo "<td>".$row['TenSP']."</td>";
                        echo "<td>".number_format($row["DonGia"],0 , ",",".")."VNĐ</td>";
                        echo "<td>".number_format($tong,0 , ",",".")."VNĐ</td>";
                        echo "<td> <div class='act'>
                        <a href='index.php?delete_cart_item=".$row['IDSanPham']."' onclick='return confirm(\""."Bạn có chắc chắn muốn xóa sản phẩm ".$row['TenSP']." ?"."\");'>
                        <button class='button-68 cart' role='button'>Xóa</button></a>
                        </div> </td>";
                    echo"</tr>";
                }

                echo "</tbody>";
                echo "</table>";
                // echo " <button class='button-68 total' onclick='addToCart()'>Thêm vào giỏ hàng</button>";
                echo" <a href='".$table['ProdID']."'><button class='button-68 total' role='button'>Thanh toán</button></a>";
            } else {
                echo "Giỏ hàng của bạn đang trống.";
            }
        }
    }
}
?>
