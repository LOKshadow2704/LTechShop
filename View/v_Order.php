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
                echo "<table style='width: 100%' border='1' style= 'border-collapse: collapese'>";
                echo"<tr>";
                       echo "<th>STT</th>";
                       echo "<th>Mã đơn hàng</th>";
                       echo "<th>Tên Khách hàng</th>";
                       echo "<th>Địa chỉ</th>";
                       echo "<th>Số điện thoại</th>";
                       echo "<th>Quản lý</th>";
                echo"</tr>";
                while($row = mysql_fetch_assoc($table)){
                    $count++;
                    echo "<tr style='text-align: center'>";
                        echo "<td>".$count."</td>";
                        echo "<td>".$row['IDDonHang']."</td>";
                        echo "<td>".$row['HoTen']."</td>";
                        echo "<td>".$row['DiaChi']."</td>";
                        echo "<td>".$row['DienThoai']."</td>";
                        echo "<td> <a href='index.php?DO=1' style= 'color: Blue'>Xem đơn hàng</a> </td>";
                    echo"</tr>";

                }
                echo "</table>";
            }
        }

        function viewPuchaseOrder(){
            $Order = new controllOrder();
            $table = $Order-> getPucchaseOrder();
            if(!$table){
                echo "ERROR";
            }elseif(mysql_num_rows($table)==0){
                echo "0 result";
            }else{
                $count=0;
                echo "<h1 style= 'font-size: 200%'>Đơn hàng</h1>";
                echo"<br><br>";
                echo "<table style='width: 100%' border='1' style= 'border-collapse: collapese'>";
                echo"<tr>";
                    echo "<th>STT</th>";
                    echo "<th>Ảnh sản phẩm</th>";
                    echo "<th>Tên sản Phẩm</th>";
                    echo "<th>Đơn giá</th>";
                    //echo "<th>Ngày đặt</th>";
                    echo "<th>Trạng thái thanh toán</th>";
                    echo "<th>Quản lý</th>";
                echo"</tr>";
                while($row = mysql_fetch_assoc($table)){
                    $count++;
                    echo "<tr style=' text-align: center'>";
                        echo "<td style='width: 20px'>".$count."</td>";
                        echo "<td>'<img width=240px height=200px src=".$row['HinhAnhSP'].">'</td>";
                        echo "<td>".$row['TenSP']."</td>";
                        echo "<td>".number_format($row["DonGia"],0 , ",",".")."VNĐ</td>";
                        //echo "<td>".$row['Ngaydat']."</td>";
                        echo "<td>".$row['TrangThaiThanhToan']."</td>";
                        echo "<td> <a href='#' style= 'color: Blue'>Chi tiết đơn hàng</a> </td>";
                    echo"</tr>";

                }
                echo "</table>";
            }
        }

        function viewSalesOrder(){
            $Order = new controllOrder();
            $table = $Order-> getSalesOrder();
            if(!$table){
                echo "ERROR";
            }elseif(mysql_num_rows($table)==0){
                echo "0 result";
            }else{
                $count=0;
                echo "<h1 style= 'font-size: 200%'>Đơn hàng</h1>";
                echo "<br><br>";
                echo "<table style='width: 100%' border='1' style= 'border-collapse: collapese'>";
                echo"<tr>";
                       echo "<th>STT</th>";
                       echo "<th>Ảnh sản phẩm</th>";
                       echo "<th>Tên sản Phẩm</th>";
                       echo "<th>Đơn giá</th>";
                       //echo "<th>Ngày đặt</th>";
                       echo "<th>Trạng thái thanh toán</th>";
                       echo "<th>Quản lý</th>";
                echo"</tr>";
                while($row = mysql_fetch_assoc($table)){
                    $count++;
                    echo "<tr style='text-align: center'>";
                        echo "<td style='width: 20px'>".$count."</td>";
                        echo "<td>'<img width=240px height=200px src=".$row['HinhAnhSP'].">'</td>";
                        echo "<td>".$row['TenSP']."</td>";
                        echo "<td>".number_format($row["DonGia"],0 , ",",".")."VNĐ</td>";
                        //echo "<td>".$row['Ngaydat']."</td>";
                        echo "<td>".$row['TrangThaiThanhToan']."</td>";
                        echo "<td> <a href='#' style= 'color: Blue'>Chi tiết đơn hàng</a> </td>";
                    echo"</tr>";

                }
                echo "</table>";
            }
        }
    }
?>
