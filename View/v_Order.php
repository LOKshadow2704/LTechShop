<?php
     include_once("./Controller/c_Order.php");
     class viewOrder{
        function viewManagermentSalesOrder(){
            $Order = new controllOrder();
            $table = $Order-> getManagermentSalesOrder();
            if(!$table){
                echo "ERROR";
            }elseif(mysql_num_rows($table)==0){
                echo "0 result";
            }else{
                $count=0;
                echo "<h1 style= 'font-size: 200%'>Danh sách đơn bán</h1>";
                echo "<br><br>";
              
                echo "<table class='M_SalesOrder'>";
                echo"<thead>";
                echo"<tr>";
                       echo "<th>STT</th>";
                       echo "<th>Mã đơn hàng</th>";
                       echo "<th>Tên Khách hàng</th>";
                       echo "<th>Địa chỉ</th>";
                       echo "<th>Số điện thoại</th>";
                       echo "<th>Ngày đặt</th>";
                       echo "<th>Trạng thái thanh toán</th>";
                       echo "<th>Quản lý</th>";
                    
                echo"</tr>";
                echo"</thead>";
                echo"<tbody>";
                while($row = mysql_fetch_assoc($table)){
                    $count++;
                    echo "<tr style='text-align: center'>";
                        echo "<td>".$count."</td>";
                        echo "<td>".$row['IDDonHang']."</td>";
                        echo "<td>".$row['HoTen']."</td>";
                        echo "<td>".$row['DiaChi']."</td>";
                        echo "<td>".$row['DienThoai']."</td>";
                        echo "<td>".$row['NgayDat']."</td>";
                        echo "<td>".$row['TrangThaiThanhToan']."</td>";
                        echo "<td> <a href='index.php?DO=".$row['IDDonHang']."'><button class='button-68'>Xem chi tiết</button></a> </td>";
                    echo"</tr>";
                }
                echo"</tbody>";
                echo "</table>";
            
            }
        }
// Đã sửa trang đơn mua
        function viewPuchaseOrder(){
            $Order = new controllOrder();
            $table = $Order-> getPucchaseOrder();
            if(!$table){
                echo "ERROR";
            }elseif(mysql_num_rows($table)==0){
                echo "0 result";
            }else{
                $count=0;
                echo "<h1 style= 'font-size: 200%'>Đơn hàng của tôi</h1>";
                echo"<br><br>";
                echo "<div class='PuchaseOrder' style = 'width: 80% !important'>";
                echo "<div tag='order-component'>";
      
                while($row = mysql_fetch_assoc($table)){
                $count++;
                $Thanhtien= $row['SoLuong']*$row['DonGia'];
            
                 echo"<div class = 'row' style='margin-bottom: 15px; box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3);'>";
                    echo"<div class = 'header' style= 'border-bottom: 1px solid #EFF0F5'>";
                        echo"<p style= 'text-align: center; margin:10px 10px 10px 990px; ;border-radius: 40px; border: 1px solid black;' >".$row['TrangThaiThanhToan']."</p>";
                    echo"</div>";
                    echo"<div class = 'body' style='margin: 10px'>
                        <a href='index.php?OrD=".$row['IDDonHang']."' style='color:black'>";
                        echo"<div class = 'col-lg-3'>
                         <img width=240px height=200px src=".$row['HinhAnhSP'].">
                         </div>";
                        echo"<div class = 'col-lg-4'>
                         ".$row['TenSP']."
                         </div>";
                        echo"<div class = 'col-lg-3'>
                         ".number_format($Thanhtien,0 , ",",".")."VNĐ
                         </div>";
                        echo"<div class = 'col-lg-2'><p> Số lượng: ".$row['SoLuong']."</p>
                         </div> </a>";
                    echo"</div>";
                echo"</div>";
         }   
            echo"</div>";
            echo"</div>";
            }
        }
// Đã sửa trang đơn bán
        function viewSalesOrder($idorder){
            $Order = new controllOrder();
            $table = $Order-> getSalesOrder($idorder);
            if(!$table){
                echo "ERROR";
            }elseif($table==0){
                echo "0 result";
            }else{
                $count=0;
                echo "<h1 style= 'font-size: 200%'>Đơn hàng</h1>";
                echo "<br><br>";
                echo "<div class='SalesOrder' style = 'width: 80% !important'>";
                echo "<div tag='order-component'>";
      
                while($row = mysql_fetch_assoc($table)){
                $count++;
                $Thanhtien= $row['SoLuong']*$row['DonGia'];
            
                 echo"<div class = 'row' style='margin-bottom: 15px; box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3);'>";
                    echo"<div class = 'header' style= 'border-bottom: 1px solid #EFF0F5'>";
                        echo"<p style= 'text-align: center; margin:10px 10px 10px 990px; ;border-radius: 40px; border: 1px solid black;' >".$row['TrangThaiThanhToan']."</p>";
                    echo"</div>";
                    echo"<div class = 'body' style='margin: 10px'>
                        <a href='index.php?OrD=".$row['IDDonHang']."' style='color:black'>";
                        echo"<div class = 'col-lg-3'>
                         <img width=240px height=200px src=".$row['HinhAnhSP'].">
                         </div>";
                        echo"<div class = 'col-lg-4'>
                         ".$row['TenSP']."
                         </div>";
                        echo"<div class = 'col-lg-3'>
                         ".number_format($Thanhtien,0 , ",",".")."VNĐ
                         </div>";
                        echo"<div class = 'col-lg-2'><p> Số lượng: ".$row['SoLuong']."</p>
                         </div> </a>";
                    echo"</div>";
                echo"</div>";
         }   
            echo"</div>";
            echo"</div>";
            }
        }
// Đã thêm chi tiết sản phẩm 
        function viewOrderDetail($idorder){
            $Order = new controllOrder();
            $table = $Order-> getOrderDetail($idorder);
            if(!$table){
                echo "ERROR";
            }elseif($table==0){
                echo "0 result";
            }else{
                $count=0;
                echo "<h1 style= 'font-size: 200%'>Chi tiết đơn hàng</h1>";
                echo "<br><br>";
                echo "<div class='Order' style = 'width: 80% !important; margin-left: 10%'>";
                    echo "<div tag='order-component'>";
                    
                        while($row = mysql_fetch_assoc($table)){
                            $count++;
                            $PhiShip = 15000; 
                            $Thanhtien= $row['SoLuong']*$row['DonGia'];
                            $Tong= $Thanhtien + $PhiShip;
                        echo"<div class = 'row' style='margin-bottom: 15px; box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3);'>";
                            echo"<div class = 'header' style= 'border-bottom: 1px solid #EFF0F5'>";
                                echo"<p style= 'text-align: center; margin:10px 10px 10px 990px; ;border-radius: 40px; border: 1px solid black;' >".$row['TrangThaiThanhToan']."</p>";
                            echo"</div>";
                            echo"<div class = 'body' style='margin: 10px'>";
                                echo"<div class = 'col-lg-3'>
                                 <img width=240px height=200px src=".$row['HinhAnhSP'].">
                                 </div>";
                                echo"<div class = 'col-lg-4'>
                                 ".$row['TenSP']."
                                 </div>";
                                echo"<div class = 'col-lg-3'>
                                 ".number_format($Thanhtien,0 , ",",".")."VNĐ
                                 </div>";
                                echo"<div class = 'col-lg-2'><p> Số lượng: ".$row['SoLuong']."</p>
                                 </div> ";
                            echo"</div>";
                        echo"</div>";
                        }
                        echo"<div class='row' style='margin-bottom: 15px; box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3);'>";
                            echo"<div class= 'header-2' >";
                                echo"<div class= 'col-lg-12'>";
                                    echo"<p>Đơn hàng: ".$row['IDDonHang']."</p>";
                                    echo"<p>Ngày đặt: ".$row['Ngaydat']."</p>";
                                echo"</div>";
                            echo"</div>";
                        echo"</div>";

                        echo"<div class='row'>";
                            echo"<div class= 'col-lg-6' style='margin-bottom: 15px; box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3); width: 49%'>";
                                echo"<p>Tên khách hàng: ".$row['HoTen']."</p>";
                                echo"<p>Địa chỉ: ".$row['DiaChi']."</p>";
                            echo"</div>";
                            echo"<div class= 'col-lg-6' style='margin: 0 0 15px 10px; box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3);width: 50%'>";
                                echo"<h4>Tổng cộng</h4> <br>";
                                echo "<div class='footer-1'>";
                                    echo"<p>Tổng tiền (".$row['SanPham']." Sản phẩm):  ".number_format($Thanhtien,0 , ",",".")."VNĐ</p>";
                                    echo"<p>Phí vận chuyển: ".number_format($PhiShip,0 , ",",".")."VNĐ</p";
                                echo"</div>";
                                echo "<div class='footer-2'>";
                                    echo"<p>Tổng cộng:  ".number_format($Tong,0 , ",",".")."VNĐ</p>";
                                echo"</div>";
                            echo"</div>";
                        echo"</div>";
                    echo"</div>";
                echo"</div>";
            }
            
        }
    }
?>
