<?php
ob_start(); 
    session_start();
    class viewOderpage{
        function Buypage(){

            include_once('./Controller/c_Payment.php');
            $Payment = new controllPayment();
            $result_pay = $Payment->getAllPayment();

            include_once('./Controller/c_Product.php');
            $product = new controllProduct();
            $result_prod = $product->getListProduct();

            include_once('./Controller/c_Shop.php');
            $shop = new controllShop();
            $result_shop = $shop->getShop($_SESSION['idLogin']);
            if(!$result_prod || !$result_shop){
                echo "ERROR";
            }elseif(mysql_num_rows($result_prod)==0){
                echo "Sản phẩm không tồn tại hoặc không đủ số lượng";
            }elseif(mysql_num_rows($result_shop)==0){
                echo "Vui lòng đăng nhập";
            }else{
                $row_shop = mysql_fetch_assoc($result_shop);
                echo "
                    <div class='wrap_buy'>
                        <div class='delivery_address'>
                            <h4><i class='fa-solid fa-map-location-dot'></i> &ensp;Địa chỉ nhận hàng</h4>
                            <p>".$row_shop['HoTen']." ".$row_shop['DienThoai']." ".$row_shop['DiaChi']."</p>
                        </div>";
                        echo "<table class='table_oderlist table-striped table '>";
                        echo "<thead class='thead-dark'>";
                        echo "<tr>";
                        echo "<th scope='col'>Sản phẩm</th><th scope='col'>Loại sản phẩm</th><th scope='col'>Đơn giá </th><th scope='col'>Hãng sản xuất</th><th scope='col'>Số lượng</th><th scope='col'>Thành tiền</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        $i=0;
                        $ship=0;
                        $thanhtien = 0;
                        while($row_prod = mysql_fetch_assoc($result_prod)){
                            echo "<tr>";
                            echo "<td><img src='".$row_prod['HinhAnhSP']."' ><p>".$row_prod['TenSP']."</p></td><td>".$row_prod['TenDanhMuc']."</td><td>".number_format($row_prod["DonGia"],0 , ",",".")."</td><td>".$row_prod['NCC']."</td><td>".$_SESSION['buyinf'][1][$i]."</td><td>"; echo(number_format($thanhtien+=$row_prod["DonGia"]*$_SESSION['buyinf'][1][$i],0 , ",","."))."</td>";
                            echo "</tr>";
                            $i++;
                        }
                        echo "</tbody>";
                        echo "</table>";
                        echo "<form class='Payment'  method='POST' enctype='application/x-www-form-urlencoded' action='./Controller/Payment_momo.php'>
                                <label for='payment'>Phương thức thanh toán</label>
                                <select name='payment' class='form-select' id='payment'>";
                                while($row_pay = mysql_fetch_assoc($result_pay)){
                                    echo "<option value='".$row_pay['IDLoaiThanhToan']."'>".$row_pay['LoaiThanhToan']."</option>";
                                }
                                $total_money = $thanhtien + $ship;
                                echo "</select> <br>";
                                echo "
                                <label for='commodity_money' >Tổng tiền hàng:</label>
                                <input type='number' id='commodity_money' name='commodity_money' readonly placeholder='$thanhtien' > <br>

                                <label for='ship_money'>Phí vận chuyển:</label>
                                <input type='number' id='ship_money' name='ship_money' readonly placeholder='$ship'> <br>

                                <label for='total_money'>Tổng thanh toán:</label>
                                <input type='number' id='total_money' name='total_money' readonly placeholder='$total_money' value='$total_money'> <br>


                                <button type='submit'  name='Buy' class='btn btn-danger'>Đặt hàng</button>
                        </form>";       
                echo "</div>
                ";
                include_once('./Controller./Payment_momo.php');
        }

    }
}
ob_end_flush();?>