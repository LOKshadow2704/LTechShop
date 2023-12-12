<?php
class viewCart{
    function Cart(){
            include_once('./Controller/c_cart.php');
            $product = new controllerCart();
            $result_cart = $product->getCart();

            include_once('./Controller/c_Shop.php');
            $shop = new controllShop();
            $result_shop = $shop->getShop($_SESSION['idLogin']);
            if(!$result_cart || !$result_shop){
                echo "ERROR";
            }elseif(mysql_num_rows($result_cart)==0){
                echo "<h1>Không có sản phẩm trong giỏ hàng!</h1>";
            }elseif(mysql_num_rows($result_shop)==0){
                echo "Vui lòng đăng nhập";
            }else{

                echo "
                    <div class='wrap_buy'>
                        <div class='cart'>
                            <h4>Giỏ hàng của bạn</h4>
                        </div>";
                        echo "<form class='form-cart'  method='GET' action='#'>";
                        echo "<table class='table_oderlist  table '>";
                        echo "<thead class='thead-dark'>";
                        echo "<tr>";
                        echo "<th scope='col'>Sản phẩm</th><th scope='col'>Loại sản phẩm</th><th scope='col'>Đơn giá </th><th scope='col'>Hãng sản xuất</th><th scope='col'>Số lượng</th><th scope='col'>Thành tiền</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        $newquan;
                        $prevIDShop = 0;
                        while($row_prod = mysql_fetch_assoc($result_cart)){
                            $thanhtien = 0;
                            if($prevIDShop!= $row_prod['Shop']){
                                echo "<tr>";
                                echo "<td><a href='index.php?idshop=".$row_prod['Shop']."'><h2 style ='font-size:18px; text-align:left;'>Cửa hàng:".$row_prod['HoTen']."</h2></a></td><td></td><td></td><td></td><td></td><td></td><td></td>";
                                echo "</td>";
                            }
                            echo "<tr>";
                            echo "<td><input type='checkbox'  name='oder_prod[]' value='".$row_prod['IDSanPham']."'><img src='".$row_prod['HinhAnhSP']."' ><p>".$row_prod['TenSP']."</p></td><td>".$row_prod['TenDanhMuc']."</td><td>".number_format($row_prod["DonGia"],0 , ",",".")."</td><td>".$row_prod['NCC']."</td>
                                <td><input type='number' min='1' id='quantity' oninput='update_quantity(this.value,".$row_prod['IDSanPham'].",".$row_prod['DonGia'].")' name='quan_prod[]' value='".$row_prod['SoLuong']."'>
                                </td>
                            <td class='total_amount ".$row_prod['IDSanPham']."'>"; echo(number_format($thanhtien+=$row_prod["DonGia"]*$row_prod['SoLuong'],0 , ",","."))."</td>";
                            echo "<td><a href='index.php?delete_cartitem=".$row_prod['IDSanPham']."'><i class='fa-solid fa-xmark'></i></a></td>";
                            echo "</tr>";
                            $prevIDShop= $row_prod['Shop'];
                        }
                        echo "</tbody>";
                        echo "</table>";
                        echo  " <button type='submit'  name='goBuy' class='btn btn-danger' style='  float: right;'>Đặt hàng</button>
                        </form>";       
                echo "</div>
                ";
        }

    }
}
?>
